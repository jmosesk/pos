<?php

class ShiftReports_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_list_shifts() {
        $this->db->order_by('shift_id', 'desc');
        $this->db->select('tbl_shifts.shift_id, tbl_shifts.shift_date, tbl_shifts_names.name as shift_name');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                ->where('tbl_shifts.status', 1);
        return $this->db->get('tbl_shifts');
    }

    function get_shift_names() {
        $this->db->order_by('name', 'desc');
        $this->db->select('tbl_shifts_names.name as shift_name, shift_name_id');
        return $this->db->get('tbl_shifts_names');
    }

    function last_closed_shift() {
        $this->db->order_by('shift_id', 'desc')->select('shift_id')->where('status', 1);
        $query = $this->db->get('tbl_shifts');
        if ($query->num_rows() > 0)
            return $query->row()->shift_id;
        else
            return null;
    }

    function get_allocation_users($shift_id = NULL) {
        $this->db->where('tbl_assigned_centres.shift_id', $shift_id);
        $this->db->select('tbl_shifts.shift_id, centre_user.name as cashier, tbl_shifts.status, tbl_shifts_names.name as shift_name, tbl_shifts.shift_date,
			operator.name as operator, tbl_assigned_centres.employee_id as user_id');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_assigned_centres.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->join('tbl_users centre_user', 'centre_user.user_id = tbl_assigned_centres.employee_id', 'left');
        $this->db->join('tbl_users operator', 'operator.user_id = tbl_shifts.close_user_id', 'left')
                ->group_by('tbl_assigned_centres.employee_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Drops and Excess User  per Shift
    function DropsExcessPerUser($shift_id = NULL) {
        $this->db->select('tbl_close_shift_drops.user_id, SUM(tbl_close_shift_drops.amount) as drops, SUM(tbl_close_shift_drops.excess) as excess');
        $this->db->where('tbl_close_shift_drops.shift_id', $shift_id)
                ->group_by('tbl_close_shift_drops.user_id');
        $query = $this->db->get('tbl_close_shift_drops');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    function FuelSalesPerUser($shift_id = null) {
        $this->db->order_by('tbl_users.name', 'asc');
        $this->db->select('tbl_users.user_id,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_electronic_meter_reading) - (tbl_close_shift_fuels.opening_electronic_meter_reading) - tbl_close_shift_fuels.rtt) * tbl_items.unit_price),0)) as elec_meter_cash_sales,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), ((tbl_close_shift_fuels.closing_electronic_cash_reading) - (tbl_close_shift_fuels.opening_electronic_cash_reading) - tbl_close_shift_fuels.rtt),0)) as elec_cash_sales,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_manual_meter_reading) - (tbl_close_shift_fuels.opening_manual_meter_reading) - tbl_close_shift_fuels.rtt) * tbl_items.unit_price),0)) as manual_cash_sales');
        $this->db->join('tbl_close_shift_fuels', 'tbl_close_shift_fuels.centre_id = tbl_assigned_centres.centre_id', 'left outer');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id', 'left');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left')
                ->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'left');
        $this->db->where('tbl_assigned_centres.shift_id', $shift_id)->group_by('tbl_users.user_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

    //Sum of LPG per User
    function LpgSalesPerUser($shift_id = null) {
        $this->db->select('tbl_assigned_centres.employee_id as user_id,
			SUM(IF((tbl_close_shift_products.shift_id = ' . $shift_id . '), ((tbl_close_shift_products.opening_quantity + tbl_close_shift_products.receipts - tbl_close_shift_products.closing_quantity) * tbl_close_shift_products.price) ,0)) as total_sales_amount_lpg');
        $this->db->join('tbl_close_shift_products', 'tbl_close_shift_products.centre_id = tbl_assigned_centres.centre_id', 'left')
                ->join('tbl_centres', 'tbl_centres.centre_id = tbl_assigned_centres.centre_id')->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id');
        $this->db->where('tbl_assigned_centres.shift_id', $shift_id)
                ->group_by('tbl_assigned_centres.employee_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Lubes per User
    function LubesSalesPerUser($shift_id = null) {
        $this->db->select('tbl_assigned_centres.employee_id as user_id, 
			SUM(IF((tbl_close_shift_lubes.shift_id = ' . $shift_id . '), ((tbl_close_shift_lubes.opening_quantity + tbl_close_shift_lubes.receipts - tbl_close_shift_lubes.closing_quantity) * tbl_close_shift_lubes.price) ,0)) as total_sales_amount_lubes');
        $this->db->join('tbl_close_shift_lubes', 'tbl_close_shift_lubes.centre_id = tbl_assigned_centres.centre_id', 'left')
                ->join('tbl_centres', 'tbl_centres.centre_id = tbl_assigned_centres.centre_id')->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id');
        ;
        $this->db->where('tbl_assigned_centres.shift_id', $shift_id)
                ->group_by('tbl_assigned_centres.employee_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Credit Sales per User
    function CreditSalesPerUser($shift_id) {
        $this->db->select('tbl_assigned_centres.employee_id as user_id,
			SUM(IF((tbl_sales.payment_type != "Cash" AND tbl_sales.status = 0 AND tbl_sales.shift_id = ' . $shift_id . '), `tbl_sales_items`.`total`, 0)) as total_sales_credit');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id')
                ->join('tbl_assigned_centres', 'tbl_assigned_centres.centre_id = tbl_sales_items.centre_id', 'inner');
        $this->db->where('tbl_sales.shift_id', $shift_id)
                ->where('tbl_sales.payment_type !=', "Cash")->where('tbl_sales.status', 0)
                ->where('tbl_assigned_centres.shift_id', $shift_id)
                ->group_by('tbl_assigned_centres.employee_id');
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

//Sum Sales FC Job Cards per Shift per Centre ID
    function SalesJobCards($shift_id) {
        $this->db->select('centre_id,
			SUM(IF((tbl_close_shift_job_card.shift_id = ' . $shift_id . '), (quantity), 0)) as job_card_sales_qty,
			SUM(IF((tbl_close_shift_job_card.shift_id = ' . $shift_id . '), (unit_price * quantity), 0)) as job_card_sales')
                ->group_by('centre_id')
                ->where('shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_job_card');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return NULL;
        }
    }

//Sum Sales FC Job Cards Per Shift per User
    function SumUserJobCards($shift_id) {
        $query = $this->db->query('SELECT `employee_id` as `user_id`, SUM(IF((tbl_close_shift_job_card.shift_id = ' . $shift_id . '), (unit_price * quantity), 0)) as job_card_sales FROM `tbl_close_shift_job_card` INNER JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`centre_id` = `tbl_close_shift_job_card`.`centre_id` AND tbl_assigned_centres.shift_id = tbl_close_shift_job_card.shift_id WHERE `tbl_close_shift_job_card`.`shift_id` = ' . $shift_id . ' GROUP BY `employee_id`');
        if ($query->num_rows() > 0)
            return $query;
        else
            return NULL;
    }

//Sum all Credit Sales per Centre per Shift
    function SumAllCreditSales($shift_id) {
        $this->db->select('tbl_sales_items.centre_id, SUM(tbl_sales_items.total) as total_credit_sales, SUM(tbl_sales_items.quantity_sold) as total_credit_sales_qty')
                ->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id')
                ->where('tbl_sales.shift_id', $shift_id)->where('tbl_sales.status', 0)
                ->where('tbl_sales.payment_type !=', "Cash")->where('tbl_sales.status', 0)
                ->group_by('centre_id');
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

//Sum Total Reciepts per Shift - Group per User
    function SumAllPayments($shift_id = NULL) {
        $this->db->select('
			SUM(IF((tbl_customers_transactions.shift_id = ' . $shift_id . ' AND tbl_customers_transactions.transaction_type = 2 AND payment_type = 1), ((tbl_customers_transactions.amount)),0)) as customer_payment_amt')
                ->join('tbl_customer_payments', 'tbl_customer_payments.customers_transactions_id = tbl_customers_transactions.customer_transaction_id')
                ->where('tbl_customers_transactions.shift_id', $shift_id);
        $query = $this->db->get('tbl_customers_transactions');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

//Sum Total Payments per Shift
    function SumAllRecievings($shift_id = NULL) {
        $this->db->select('
			SUM(IF((tbl_receivings.shift_id = ' . $shift_id . ' AND tbl_receivings.payment_method = "CASH"), ((tbl_receivings.total_amount)),0)) as recieving_payment')
                ->where('tbl_receivings.shift_id', $shift_id);
        $query = $this->db->get('tbl_receivings');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

//Sum Reciepts and Payments per Shift - Group per User
    function SumPayments($shift_id = NULL) {
        $this->db->select('
			tbl_customers_transactions.employee_id as user_id, tbl_customer_payments.centre_id,
			SUM(IF((tbl_customers_transactions.shift_id = ' . $shift_id . ' AND tbl_customers_transactions.transaction_type = 2 AND payment_type = 1), ((tbl_customers_transactions.amount)),0)) as customer_payment_amt')
                ->join('tbl_customer_payments', 'tbl_customer_payments.customers_transactions_id = tbl_customers_transactions.customer_transaction_id')
                ->where('tbl_customers_transactions.shift_id', $shift_id)
                ->group_by('tbl_customer_payments.centre_id');
        $query = $this->db->get('tbl_customers_transactions');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

//Sum Reciepts and Payments per Shift - Group per User
    function SumRecievingsPayments($shift_id = NULL) {
        $this->db->select('
			tbl_receivings.payment_user_id as user_id, tbl_receivings.centre_id,
			SUM(IF((tbl_receivings.shift_id = ' . $shift_id . ' AND tbl_receivings.payment_method = "CASH"), ((tbl_receivings.total_amount)),0)) as recieving_payment')
                ->where('tbl_receivings.shift_id', $shift_id)
                ->group_by('tbl_receivings.centre_id');
        $query = $this->db->get('tbl_receivings');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

    function NonFuelCentres() {
        $this->db->order_by('tbl_centres.centre_name')
                ->select('tbl_centres.centre_name as name, tbl_centres.centre_id')
                ->where('tbl_centres.fuel_centre !=', 1)
                ->where('tbl_centres.status', 1);
        $query = $this->db->get('tbl_centres');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

//Sum of LPG Sales
    function LpgSales($shift_id = null) {
        $this->db->select('tbl_close_shift_products.centre_id,
			SUM(IF((tbl_close_shift_products.shift_id = ' . $shift_id . '), (tbl_close_shift_products.opening_quantity + tbl_close_shift_products.receipts - tbl_close_shift_products.closing_quantity) ,0)) as sales_qty_lpg,
			SUM(IF((tbl_close_shift_products.shift_id = ' . $shift_id . '), ((tbl_close_shift_products.opening_quantity + tbl_close_shift_products.receipts - tbl_close_shift_products.closing_quantity) * tbl_close_shift_products.price) ,0)) as sales_lpg')
                ->group_by('tbl_close_shift_products.centre_id');
        $query = $this->db->get('tbl_close_shift_products');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Lubes Sales
    function LubesSales($shift_id = null) {
        $this->db->select('tbl_close_shift_lubes.centre_id, 
			SUM(IF((tbl_close_shift_lubes.shift_id = ' . $shift_id . '), ((tbl_close_shift_lubes.opening_quantity + tbl_close_shift_lubes.receipts - tbl_close_shift_lubes.closing_quantity) * tbl_close_shift_lubes.price) ,0)) as sales_lubes,
			SUM(IF((tbl_close_shift_lubes.shift_id = ' . $shift_id . '), (tbl_close_shift_lubes.opening_quantity + tbl_close_shift_lubes.receipts - tbl_close_shift_lubes.closing_quantity),0)) as sales_qty_lubes')
                ->group_by('tbl_close_shift_lubes.centre_id');
        $query = $this->db->get('tbl_close_shift_lubes');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

    function FuelSalesPerItem($shift_id = null) {
        $this->db->select('
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_electronic_meter_reading) - (tbl_close_shift_fuels.opening_electronic_meter_reading) - tbl_close_shift_fuels.rtt)),0)) as elec_meter_sales,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_electronic_meter_reading) - (tbl_close_shift_fuels.opening_electronic_meter_reading) - tbl_close_shift_fuels.rtt) * tbl_items.unit_price),0)) as elec_meter_cash_sales,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_electronic_cash_reading) - (tbl_close_shift_fuels.opening_electronic_cash_reading) - (tbl_close_shift_fuels.rtt * tbl_items.unit_price)) / tbl_items.unit_price),0)) as elec_sales,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), ((tbl_close_shift_fuels.closing_electronic_cash_reading) - (tbl_close_shift_fuels.opening_electronic_cash_reading) - (tbl_close_shift_fuels.rtt * tbl_items.unit_price)),0)) as elec_cash_sales,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_manual_meter_reading) - (tbl_close_shift_fuels.opening_manual_meter_reading) - tbl_close_shift_fuels.rtt)),0)) as manual_sales,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_manual_meter_reading) - (tbl_close_shift_fuels.opening_manual_meter_reading) - tbl_close_shift_fuels.rtt) * tbl_items.unit_price),0)) as manual_cash_sales');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left')
                ->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'left');
        $query = $this->db->get('tbl_close_shift_fuels');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else
            return null;
    }

//Sum Credit Sales per Category
    function CreditSalesFuel($shift_id) {
        $this->db->select('
			SUM(IF((tbl_sales.payment_type != "Cash" AND tbl_sales.status = 0 AND tbl_sales.shift_id = ' . $shift_id . '), `tbl_sales_items`.`total`, 0)) as total_sales_credit,
			SUM(IF((tbl_sales.payment_type != "Cash" AND tbl_sales.status = 0 AND tbl_sales.shift_id = ' . $shift_id . '), `tbl_sales_items`.`quantity_sold`, 0)) as qty_credit');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id')
                ->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id', 'inner');
        $this->db->where('tbl_sales.shift_id', $shift_id)
                ->where('tbl_sales.payment_type !=', "Cash")->where('tbl_sales.status', 0)
                ->where('tbl_items.item_type', 1)
                ->group_by('tbl_items.item_type');
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Credit Sales per Item
    function CreditSalesItem($shift_id) {
        $this->db->select('tbl_items.item_id,
			SUM(IF((tbl_sales.payment_type != "Cash" AND tbl_sales.status = 0 AND tbl_sales.shift_id = ' . $shift_id . '), `tbl_sales_items`.`total`, 0)) as sales_credit,
			SUM(IF((tbl_sales.payment_type != "Cash" AND tbl_sales.status = 0 AND tbl_sales.shift_id = ' . $shift_id . '), `tbl_sales_items`.`quantity_sold`, 0)) as qty_credit');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id')
                ->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id', 'inner');
        $this->db->where('tbl_sales.shift_id', $shift_id)
                ->where('tbl_sales.payment_type !=', "Cash")
                ->where('tbl_sales.status', 0)
                ->group_by('tbl_items.item_id');
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Credit Sales Per Centre
    function CreditSalesOther($shift_id) {
        $this->db->select('tbl_products.centre_id,
			SUM(IF((tbl_sales.payment_type != "Cash" AND tbl_sales.status = 0 AND tbl_sales.shift_id = ' . $shift_id . '), `tbl_sales_items`.`total`, 0)) as total_sales_credit,
			SUM(IF((tbl_sales.payment_type != "Cash" AND tbl_sales.status = 0 AND tbl_sales.shift_id = ' . $shift_id . '), `tbl_sales_items`.`quantity_sold`, 0)) as qty_credit');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id')
                ->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id', 'inner')
                ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id')
                ->where('tbl_sales.shift_id', $shift_id)
                ->where('tbl_sales.payment_type !=', "Cash")
                ->where('tbl_sales.status', 0)
                ->where('tbl_items.item_type !=', 1)
                ->group_by('tbl_products.centre_id');
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//LPG Inventory
    function get_list_CloseProducts($shift_id) {
        $this->db->order_by('tbl_products.category_id');
        $this->db->order_by('tbl_items.item_name');
        $this->db->select('tbl_items. item_id, tbl_close_shift_products.opening_quantity, tbl_close_shift_products.closing_quantity, tbl_close_shift_products.receipts, tbl_close_shift_products.price, tbl_items.item_name');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_products.item_id', 'left')
                ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id');
        $this->db->where('tbl_close_shift_products.shift_id', $shift_id)->where('tbl_items.deleted', 0);
        $query = $this->db->get('tbl_close_shift_products');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

//Lubes Inventory
    function get_list_CloseLubes($shift_id) {
        $this->db->order_by('tbl_items.item_name');
        $this->db->select('tbl_items. item_id, tbl_close_shift_lubes.opening_quantity, tbl_close_shift_lubes.closing_quantity, tbl_close_shift_lubes.receipts, tbl_close_shift_lubes.price, tbl_items.item_name');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_lubes.item_id', 'left')
                ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id');
        $this->db->where('tbl_close_shift_lubes.shift_id', $shift_id)->where('tbl_items.deleted', 0);
        $query = $this->db->get('tbl_close_shift_lubes');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

//Sum Reciepts and Excess User per Shift
    function RecieptsPerUser($shift_id = NULL) {
        $this->db->select('tbl_close_shift_drops.user_id, SUM(tbl_close_shift_drops.excess) as excess, users_drop.name as cashier')
                ->join('tbl_users users_drop', 'users_drop.user_id = tbl_close_shift_drops.user_id', 'left');
        $this->db->where('tbl_close_shift_drops.shift_id', $shift_id)->where('excess !=', 0)
                ->group_by('tbl_close_shift_drops.user_id');
        $query = $this->db->get('tbl_close_shift_drops');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Total Reciepts and Excess per Shift
    function TotalReciepts($shift_id = NULL) {
        $this->db->select('SUM(tbl_close_shift_drops.excess) as excess, tbl_shifts.bbf_amt');
        $this->db->where('tbl_shifts.shift_id', $shift_id)
                ->join('tbl_close_shift_drops', 'tbl_close_shift_drops.shift_id = tbl_shifts.shift_id')
                ->group_by('tbl_shifts.shift_id');
        $query = $this->db->get('tbl_shifts');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

//Sum Bankings per Shift
    function TotalBankings($shift_id = NULL) {
        $this->db->select('SUM(IF((tbl_bankings.shift_id = ' . $shift_id . '), (tbl_bankings.amount), 0)) as total_bankings', FALSE);
        $this->db->where('tbl_bankings.shift_id', $shift_id)
                ->group_by('shift_id');
        $query = $this->db->get('tbl_bankings');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

//Meter Variance Per Shift
    function meterVariance($shift_id = NULL) {
        $this->db->order_by('centre_name', 'asc');
        $this->db->select('(tbl_close_shift_fuels.closing_electronic_meter_reading - tbl_close_shift_fuels.opening_electronic_meter_reading) as ltrs_elec, tbl_items.unit_price, (tbl_close_shift_fuels.closing_manual_meter_reading - tbl_close_shift_fuels.opening_manual_meter_reading) as ltrs_manual, tbl_pumps.name as pump, tbl_centres.centre_name')
                ->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left')
                ->join('tbl_centres', 'tbl_centres.centre_id = tbl_close_shift_fuels.centre_id', 'left')
                ->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'left')
                ->where('tbl_close_shift_fuels.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_fuels');
        if ($query->num_rows() > 0)
            return $query;
        else
            return NULL;
    }

//Stock Transfer Per Shift
    function stockTransfer($shift_id = NULL) {
        $this->db->order_by('tbl_stock_transfers.transfer_id', 'desc');
        $this->db->select('tbl_stock_transfers.dispatch_store_id, tbl_stock_transfers.recieving_store_id, tbl_stock_transfers_items.quantity, dispatch.store_name as dispatch_name, receiving.store_name as receiving_name, tbl_stock_transfers.transfer_id, tbl_items.item_name, tbl_stock_transfers.transfer_type')
                ->join('tbl_stock_transfers', 'tbl_stock_transfers.transfer_id = tbl_stock_transfers_items.stock_transfer_id', 'left')
                ->join('tbl_stores dispatch', 'dispatch.store_id = tbl_stock_transfers.dispatch_store_id', 'left')
                ->join('tbl_stores receiving', 'receiving.store_id = tbl_stock_transfers.recieving_store_id', 'left')
                ->join('tbl_items', 'tbl_items.item_id = tbl_stock_transfers_items.item_id', 'left');
        $this->db->where('tbl_stock_transfers.shift_id', $shift_id);
        $query = $this->db->get('tbl_stock_transfers_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Stock Adjustment Per Shift
    function stockAdjustment($shift_id = NULL) {
        $this->db->order_by('tbl_stock_adjustments.stock_adjustment_id', 'desc');
        $this->db->select('tbl_stock_adjustments_items.stock_adjustment_items_id, tbl_stock_adjustments.datetime, tbl_users.name as user, 
			tbl_items.item_name as item, tbl_stock_adjustments.price, tbl_stock_adjustments.reason, tbl_stock_adjustments_items.type,
			tbl_stock_adjustments_items.bbf_qty, tbl_stock_adjustments_items.closing_qty, tbl_centres.centre_name as centre, tbl_stores.store_name as store')
                ->join('tbl_stock_adjustments', 'tbl_stock_adjustments.stock_adjustment_id = tbl_stock_adjustments_items.stock_adjustment_id', 'left')
                ->join('tbl_users', 'tbl_users.user_id = tbl_stock_adjustments.user_id', 'left')
                ->join('tbl_items', 'tbl_items.item_id = tbl_stock_adjustments.item_id', 'left')
                ->join('tbl_centres', 'tbl_centres.centre_id = tbl_stock_adjustments_items.location_id', 'left')
                ->join('tbl_stores', 'tbl_stores.store_id = tbl_stock_adjustments_items.location_id', 'left')
                ->where('tbl_stock_adjustments.shift_id', $shift_id);
        $query = $this->db->get('tbl_stock_adjustments_items');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

//Meter Movement Per Shift
    function meterMovement($post = NULL) {
        if (isset($post['shift']) && !empty($post['shift'])) {
            $this->db->where('tbl_shifts.shift_name_id', $post['shift']);
        }
        if (isset($post['range'])) {
            $date_array = explode(" - ", $post['range']);
            $post_range = "DATE(tbl_shifts.shift_date) >= '" . date("Y-m-d", strtotime($date_array[0])) . "' AND DATE(tbl_shifts.shift_date) <= '" . date("Y-m-d", strtotime($date_array[1])) . "'";
            $this->db->where($post_range);
        }
        $this->db->order_by('tbl_shifts.shift_id', 'desc')->select('CONCAT(tbl_shifts_names.name, " of " ,DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as shift_name, reading, tbl_shifts.shift_id, operator.name as operator', FALSE)
                ->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                ->join('tbl_users operator', 'operator.user_id = tbl_shifts.close_user_id', 'left');
        $shift_array = $this->db->get('tbl_shifts')->result_array();
        $shift_data_array = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $meter_array = array();
        if (count($shift_array) > 0) {
            $this->db->order_by('tbl_pumps.name', 'asc');
            $this->db->select('tbl_close_shift_fuels.shift_id, tbl_close_shift_fuels.closing_electronic_meter_reading as close_meter, tbl_close_shift_fuels.opening_electronic_meter_reading as open_meter, tbl_close_shift_fuels.unit_price, tbl_close_shift_fuels.closing_manual_meter_reading as close_manual, tbl_close_shift_fuels.opening_manual_meter_reading as open_manual, tbl_pumps.name as pump, tbl_close_shift_fuels.opening_electronic_cash_reading as open_cash, tbl_close_shift_fuels.closing_electronic_cash_reading as close_cash, tbl_close_shift_fuels.rtt')
                    ->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left')
                    ->where_in('tbl_close_shift_fuels.shift_id', $shift_data_array);
            $meter_array = $this->db->get('tbl_close_shift_fuels')->result_array();
        }
        return array('shifts' => $shift_array, 'data' => $meter_array);
    }

//Stock Calculation Per Shift
    function stockCalculation($post = NULL) {
        if (isset($post['shift']) && !empty($post['shift'])) {
            $this->db->where('tbl_shifts.shift_name_id', $post['shift']);
        }
        if (isset($post['range'])) {
            $date_array = explode(" - ", $post['range']);
            $post_range = "DATE(tbl_shifts.shift_date) >= '" . date("Y-m-d", strtotime($date_array[0])) . "' AND DATE(tbl_shifts.shift_date) <= '" . date("Y-m-d", strtotime($date_array[1])) . "'";
            $this->db->where($post_range);
        }
        $this->db->order_by('tbl_shifts.shift_id', 'desc')->select('CONCAT(tbl_shifts_names.name, " of " ,DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as shift_name, reading, tbl_shifts.shift_id, operator.name as operator', FALSE)
                ->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                ->join('tbl_users operator', 'operator.user_id = tbl_shifts.close_user_id', 'left');
        $shift_array = $this->db->get('tbl_shifts')->result_array();
        $shift_data_array = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $meter_array = array();
        if (count($shift_array) > 0) {
            $this->db->order_by('tbl_stores.store_name', 'asc');
            $this->db->select('tbl_close_shift_dippings.shift_id, tbl_stores.store_name, tbl_close_shift_dippings.previous_dippings, tbl_close_shift_dippings.bbf,  tbl_close_shift_dippings.dippings, tbl_close_shift_dippings.bcf, tbl_close_shift_dippings.reciepts, tbl_close_shift_dippings.sales,
				tbl_fuel_stores.capacity, tbl_items.item_name, mvar');
            $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_close_shift_dippings.store_id', 'left');
            $this->db->join('tbl_fuel_stores', 'tbl_fuel_stores.store_id = tbl_stores.store_id', 'left');
            $this->db->join('tbl_items', 'tbl_items.item_id = tbl_fuel_stores.item_id', 'left')
                    ->where_in('tbl_close_shift_dippings.shift_id', $shift_data_array);
            $meter_array = $this->db->get('tbl_close_shift_dippings')->result_array();
        }
        return array('shifts' => $shift_array, 'data' => $meter_array);
    }

    private function per_shift_range($post, $asc = 'desc') {
        if (isset($post['shift']) && !empty($post['shift'])) {
            $this->db->where('tbl_shifts.shift_name_id', $post['shift']);
        }
        if (isset($post['range'])) {

            $date_array = explode(" - ", $post['range']);
          
            $post_range = "DATE(tbl_shifts.shift_date) >= '" . date("Y-m-d", strtotime($date_array[0])) . "' AND DATE(tbl_shifts.shift_date) <= '" . date("Y-m-d", strtotime($date_array[1])) . "'";
            $this->db->where($post_range);
        }
        $this->db->order_by('tbl_shifts.shift_id', $asc)->select('CONCAT(tbl_shifts_names.name, " of " , DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as shift_name, reading, tbl_shifts.shift_id, operator.name as operator, bbf_amt, DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y") as shift_date', FALSE)
                ->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                ->join('tbl_users operator', 'operator.user_id = tbl_shifts.close_user_id', 'left');
        $shift_array = $this->db->get('tbl_shifts')->result_array();
        return $shift_array;
    }

    function inventoryReport($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post);
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        $lubes = array();
        $others = array();
        if (count($shift_array) > 0) {
            $this->db->order_by('tbl_items.item_name');
            $this->db->select('tbl_close_shift_lubes.opening_quantity, tbl_close_shift_lubes.closing_quantity, tbl_close_shift_lubes.receipts, tbl_close_shift_lubes.price, tbl_items.item_name, tbl_close_shift_lubes.shift_id');
            $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_lubes.item_id', 'left')
                    ->where_in('tbl_close_shift_lubes.shift_id', $shift_data_array);
            $lubes = $this->db->get('tbl_close_shift_lubes')->result_array();

            $this->db->order_by('tbl_items.item_name');
            $this->db->select('tbl_close_shift_products.opening_quantity, tbl_close_shift_products.closing_quantity, tbl_close_shift_products.receipts, tbl_close_shift_products.price, tbl_items.item_name, tbl_close_shift_products.shift_id');
            $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_products.item_id', 'left')
                    ->where_in('tbl_close_shift_products.shift_id', $shift_data_array);
            $others = $this->db->get('tbl_close_shift_products')->result_array();
        }
        return array('shifts' => $shift_array, 'data' => array('lubes' => $lubes, 'others' => $others));
    }

    function purchaseDetailedReport($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post);
        $reading_method_array = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        if (count($shift_data_array) > 0) {

            $this->db->select('invoice_number, type,'
                            . 'SUM(tbl_recieving_items.total_price) as net_amount,'
                            . 'SUM(tbl_recieving_items_fuel.net_amount) as fuel_net_amount, '
                            . 'total_amount,tbl_suppliers.company_name,tbl_receiving_fuel_meta.license_fees, DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y") as date')
                    ->join('tbl_suppliers', 'tbl_suppliers.supplier_id = tbl_receivings.supplier_id', 'left')
                    ->join('tbl_recieving_items_fuel', 'tbl_recieving_items_fuel.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_recieving_items', 'tbl_recieving_items.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_receiving_fuel_meta', 'tbl_receiving_fuel_meta.receiving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_receivings.shift_id', 'left')
                    ->where_in('tbl_receivings.shift_id', $shift_data_array)
                    ->group_by('tbl_receivings.receiving_id')
                    ->order_by('tbl_receivings.receiving_id', 'asc');
            $data = $this->db->get('tbl_receivings')->result_array();
        }
        return array('data' => $data);
    }

    function expense_report($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post);
        $reading_method_array = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        if (count($shift_data_array) > 0) {
            if ($this->input->post('reportType') == "summary") {
                $this->db->select('SUM(tbl_petty_cash_expense_items.amount) as amount, tbl_petty_cash_items.name')
                        ->join('tbl_petty_cash_expenses', 'tbl_petty_cash_expenses.id = tbl_petty_cash_expense_items.expense_id')
                        ->join('tbl_petty_cash_items', 'tbl_petty_cash_items.id = tbl_petty_cash_expense_items.item_id')
                        ->where('approved', 1)->where_in('tbl_petty_cash_expenses.shift_id', $shift_data_array)
                        ->group_by('tbl_petty_cash_expense_items.item_id');
                $data = $this->db->get('tbl_petty_cash_expense_items')->result_array();
            } else {
                $this->db->select('tbl_petty_cash_expense_items.amount, tbl_petty_cash_items.name, tbl_petty_cash_expenses.reason, DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y") as date')
                        ->join('tbl_petty_cash_expenses', 'tbl_petty_cash_expenses.id = tbl_petty_cash_expense_items.expense_id')
                        ->join('tbl_petty_cash_items', 'tbl_petty_cash_items.id = tbl_petty_cash_expense_items.item_id')
                        ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_petty_cash_expenses.shift_id', 'left')
                        ->where('approved', 1)->where_in('tbl_petty_cash_expenses.shift_id', $shift_data_array)
                        ->order_by('tbl_petty_cash_expenses.id', 'asc');
                $data = $this->db->get('tbl_petty_cash_expense_items')->result_array();
            }
        }
        return array('data' => $data);
    }

    function employee_sales_report($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post);
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        $this->db->select('tbl_products_category_type.type_id, name')->where('deleted', 0);
        $type = $this->db->get('tbl_products_category_type')->result_array();
        if (count($shift_data_array) > 0) {
            $jc_array = array('type_id' => "jc", 'name' => "Job Cards");
            array_unshift($type, $jc_array);
            $fuel_array = array('type_id' => 0, 'name' => "White Products");
            array_unshift($type, $fuel_array);
            $this->db->order_by('tbl_employees.emp_id');
            $this->db->select('tbl_employees.name,SUM(tbl_close_shift_lubes.sales_qty * tbl_measurement_type.value) as vol, SUM(tbl_close_shift_lubes.sales_qty *tbl_close_shift_lubes.price) as amnt, SUM(tbl_close_shift_lubes.sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, item_name, category_id, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat')
                    ->join('tbl_assigned_centres', 'tbl_assigned_centres.employee_id = tbl_employees.emp_id ', 'left')
                    ->join('tbl_close_shift_lubes', 'tbl_close_shift_lubes.centre_id = tbl_assigned_centres.centre_id AND tbl_close_shift_lubes.shift_id = tbl_assigned_centres.shift_id', 'left')
                    
                    ->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_lubes.item_id', 'left')
                    ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left')
                    ->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left')
                    ->join('tbl_close_shift_lubes_vat', 'tbl_close_shift_lubes_vat.id = tbl_close_shift_lubes.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_assigned_centres.shift_id', $shift_data_array)
                    ->where_in('tbl_close_shift_lubes.shift_id', $shift_data_array)->group_by('tbl_employees.emp_id');
            $lubes = $this->db->get('tbl_employees')->result_array();

            $this->db->order_by('tbl_employees.emp_id');
            $this->db->select('tbl_employees.name, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * price) as amnt, SUM(sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) as netamnt, item_name, category_id, SUM((sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) * tbl_close_shift_products_vat.vat) as vat');
                $this->db->join('tbl_assigned_centres', 'tbl_assigned_centres.employee_id = tbl_employees.emp_id ', 'left')
                    ->join('tbl_close_shift_products', 'tbl_close_shift_products.centre_id =  tbl_assigned_centres.centre_id AND tbl_close_shift_products.shift_id = tbl_assigned_centres.shift_id', 'left')
                    ->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_products.item_id', 'left')->where('category_id', 2)
                    ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left')
                    ->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left')
                    ->join('tbl_close_shift_products_vat', 'tbl_close_shift_products_vat.id = tbl_close_shift_products.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_products.shift_id', $shift_data_array)->group_by('tbl_employees.emp_id');
            $others = $this->db->get('tbl_employees')->result_array();

            $this->db->order_by('tbl_employees.emp_id');
            $this->db->select('tbl_employees.name, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * price) as amnt, SUM(sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) as netamnt, item_name, category_id, SUM((sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) * tbl_close_shift_products_vat.vat) as vat');
                $this->db->join('tbl_assigned_centres', 'tbl_assigned_centres.employee_id = tbl_employees.emp_id ', 'left')
                    ->join('tbl_close_shift_products', 'tbl_close_shift_products.centre_id =  tbl_assigned_centres.centre_id AND tbl_close_shift_products.shift_id = tbl_assigned_centres.shift_id', 'left')
                    ->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_products.item_id', 'left')->where('category_id <>', 2)
                    ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left')
                    ->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left')
                    ->join('tbl_close_shift_products_vat', 'tbl_close_shift_products_vat.id = tbl_close_shift_products.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_products.shift_id', $shift_data_array)->group_by('tbl_employees.emp_id');
            $accessoriess = $this->db->get('tbl_employees')->result_array();

            $this->db->order_by('tbl_assigned_centres.employee_id');
            $this->db->select('tbl_assigned_centres.employee_id,tbl_employees.name,SUM(tbl_close_shift_job_card.quantity * tbl_measurement_type.value) as vol, SUM(quantity * tbl_close_shift_job_card.unit_price) as amnt,SUM(quantity  * (tbl_close_shift_job_card.unit_price / (1+tbl_close_shift_job_card_vat.vat))) as netamnt, item_name, SUM((quantity * (tbl_close_shift_job_card.unit_price / (1+tbl_close_shift_job_card_vat.vat))) * tbl_close_shift_job_card_vat.vat) as vat, "jc" as category_id');
            $this->db->join('tbl_assigned_centres', 'tbl_assigned_centres.employee_id = tbl_employees.emp_id ', 'left')
                    ->join('tbl_close_shift_job_card', 'tbl_close_shift_job_card.centre_id = tbl_assigned_centres.centre_id AND tbl_close_shift_job_card.shift_id = tbl_assigned_centres.shift_id', 'left')
                    ->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_job_card.item_id', 'left')
                    ->join('tbl_close_shift_job_card_vat', 'tbl_close_shift_job_card_vat.id = tbl_close_shift_job_card.close_shift_id', 'left')->where('quantity >', 0)
                    ->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left')
                    ->where_in('tbl_close_shift_job_card.shift_id', $shift_data_array)->group_by('tbl_employees.emp_id');
            $j_cards = $this->db->get('tbl_employees')->result_array();

         $this->db->order_by('tbl_assigned_centres.employee_id');
            $this->db->select('tbl_assigned_centres.employee_id,tbl_employees.name,tbl_items.item_id, item_name, 0 as category_id, 
                              CASE reading
                              WHEN 4 THEN SUM(sales_manual_meter * tbl_measurement_type.value )
                              WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter * tbl_measurement_type.value)
                              WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price * tbl_measurement_type.value)
                              WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
                              ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
                            END as vol,
                            CASE reading
                              WHEN 4 THEN SUM(sales_manual_cash)
                              WHEN 3 THEN SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price)
                              WHEN 2 THEN SUM(sales_elec_cash)
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                              ELSE GREATEST(SUM(sales_manual_cash), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                            END as amnt,
                                                        CASE reading
                              WHEN 4 THEN SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat))
                              WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)))
                              WHEN 2 THEN SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat))
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
                              ELSE GREATEST(SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
                            END as netamnt,
                            CASE reading
                              WHEN 4 THEN SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
                              WHEN 3 THEN SUM((sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))) * tbl_close_shift_fuels_vat.vat)
                              WHEN 2 THEN SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
                              ELSE GREATEST(SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
                            END as vat')
                    ->join('tbl_assigned_centres', 'tbl_assigned_centres.employee_id = tbl_employees.emp_id ', 'left')
                    ->join('tbl_close_shift_fuels', 'tbl_close_shift_fuels.centre_id = tbl_assigned_centres.centre_id AND tbl_close_shift_fuels.shift_id = tbl_assigned_centres.shift_id ', 'left')
                    ->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id AND tbl_pumps.centre_id = tbl_close_shift_fuels.centre_id  ', 'left')
                    ->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'left')
                    ->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.shift_id', 'left')
                    ->join('tbl_close_shift_fuels_vat', 'tbl_close_shift_fuels_vat.id = tbl_close_shift_fuels.close_shift_fuel_id', 'left')
                    ->where_in('tbl_close_shift_fuels.shift_id', $shift_data_array)
                    ->group_by('tbl_employees.emp_id');
            $fuel_centres = $this->db->get('tbl_employees')->result_array();
            $data = array('accessoriess'=>$accessoriess, 'lubes' => $lubes, 'others' => $others, 'fuel' => $fuel_centres, 'jc' => $j_cards);
        }
        return array('type' => $type, 'data' => $data);
    }

    function total_sales_report($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post);
        $reading_method_array = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $type = $lubes = $others = $fuel_centres = $credit_sales_arr = $j_cards = array();
        $data = array();
        if (count($shift_array) > 0) {
            $this->db->select(' tbl_products_category_type.type_id, name')->where('deleted', 0);
            $type = $this->db->get('tbl_products_category_type')->result_array();
            $jc_array = array('type_id' => "jc", 'name' => "Job Cards");
            array_unshift($type, $jc_array);
            $fuel_array = array('type_id' => 0, 'name' => "White Products");
            array_unshift($type, $fuel_array);
            $this->db->select('tbl_items.item_id as item_id, 0 as category_id, item_name,
                            CASE reading
                              WHEN 4 THEN SUM(sales_manual_meter)
                              WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter)
                              WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price)
                              WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
                              ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
                            END as qty,
                            CASE reading
                              WHEN 4 THEN SUM(sales_manual_cash)
                              WHEN 3 THEN SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price)
                              WHEN 2 THEN SUM(sales_elec_cash)
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                              ELSE GREATEST(SUM(sales_manual_cash), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                            END as amnt')
                    ->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left')
                    ->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'left')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.shift_id', 'left')
                    ->where_in('tbl_close_shift_fuels.shift_id', $shift_data_array)
                    ->group_by('tbl_items.item_id');
            $fuel_centres = $this->db->get('tbl_close_shift_fuels')->result_array();

            $this->db->order_by('tbl_items.item_id');
            $this->db->select('SUM(tbl_close_shift_products.sales_qty) as qty, SUM(tbl_close_shift_products.sales_qty * tbl_close_shift_products.price) as amnt, item_name, category_id, tbl_close_shift_products.item_id');
            $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_products.item_id', 'left')
                    ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left')
                    ->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_products.shift_id', $shift_data_array)
                    ->group_by('tbl_close_shift_products.item_id');
            $others = $this->db->get('tbl_close_shift_products')->result_array();

            $this->db->order_by('tbl_items.item_id');
            $this->db->select('SUM(tbl_close_shift_lubes.sales_qty) as qty, SUM(tbl_close_shift_lubes.sales_qty * tbl_close_shift_lubes.price) as amnt, item_name, category_id, tbl_close_shift_lubes.item_id');
            $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_lubes.item_id', 'left')
                    ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left')
                    ->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_lubes.shift_id', $shift_data_array)
                    ->group_by('tbl_close_shift_lubes.item_id');
            $lubes = $this->db->get('tbl_close_shift_lubes')->result_array();

            $this->db->select('SUM(if((payment_type = "Credit Card" || payment_type = "Fuel Card"), tbl_sales_items.total,0)) AS credit_card, SUM(if(payment_type = "Mpesa", tbl_sales_items.total,0)) AS mpesa, SUM(if(payment_type = "Invoice", tbl_sales_items.total,0)) AS invoice, tbl_sales_items.item_id')
                    ->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left')
                    ->where_in('tbl_sales.shift_id', $shift_data_array)
                    ->where('tbl_sales.status', 0)
                    ->group_by('tbl_sales_items.item_id');
            $credit_sales = $this->db->get('tbl_sales_items')->result_array();

            foreach ($credit_sales as $sale) {
                $credit_sales_arr[$sale['item_id']] = $sale;
            }

            $this->db->order_by('tbl_items.item_name');
            $this->db->select('SUM(tbl_close_shift_job_card.quantity) as qty, SUM(quantity * tbl_close_shift_job_card.unit_price) as amnt, item_name, tbl_close_shift_job_card.item_id, "jc" as category_id');
            $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_job_card.item_id', 'left')
                    ->where('quantity >', 0)
                    ->where_in('tbl_close_shift_job_card.shift_id', $shift_data_array)
                    ->group_by('tbl_close_shift_job_card.item_id');
            $j_cards = $this->db->get('tbl_close_shift_job_card')->result_array();
        }
        return array('type' => $type, 'data' => array('lubes' => $lubes, 'others' => $others, 'fuel' => $fuel_centres, 'credits' => $credit_sales_arr, 'jc' => $j_cards));
    }

    function salesSummaryReport($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post);
        $reading_method_array = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        $this->db->select('tbl_products_category_type.type_id, name')->where('deleted', 0);
        $type = $this->db->get('tbl_products_category_type')->result_array();
        if (count($shift_data_array) > 0) {
            $jc_array = array('type_id' => "jc", 'name' => "Job Cards");
            array_unshift($type, $jc_array);
            $fuel_array = array('type_id' => 0, 'name' => "White Products");
            array_unshift($type, $fuel_array);
            $this->db->order_by('tbl_items.item_name');
            $this->db->select('SUM(tbl_close_shift_lubes.sales_qty) as qty,SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * price) as amnt, SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as netamnt, item_name, category_id, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as vat')
                    ->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_lubes.item_id', 'left')
                    ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left')
                    ->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left')
                    ->join('tbl_close_shift_lubes_vat', 'tbl_close_shift_lubes_vat.id = tbl_close_shift_lubes.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_lubes.shift_id', $shift_data_array)->group_by('tbl_close_shift_lubes.item_id');
            $lubes = $this->db->get('tbl_close_shift_lubes')->result_array();

            $this->db->order_by('tbl_items.item_name');
            $this->db->select('SUM(tbl_close_shift_products.sales_qty) as qty, SUM(sales_qty * tbl_measurement_type.value) as vol, SUM(sales_qty * price) as amnt, SUM(sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) as netamnt, item_name, category_id, SUM((sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) * tbl_close_shift_products_vat.vat) as vat');
            $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_products.item_id', 'left')
                    ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left')
                    ->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left')
                    ->join('tbl_close_shift_products_vat', 'tbl_close_shift_products_vat.id = tbl_close_shift_products.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_products.shift_id', $shift_data_array)->group_by('tbl_close_shift_products.item_id');
            $others = $this->db->get('tbl_close_shift_products')->result_array();

            $this->db->order_by('tbl_items.item_name');
            $this->db->select('SUM(tbl_close_shift_job_card.quantity) as qty, SUM(tbl_close_shift_job_card.quantity * tbl_measurement_type.value) as vol, SUM(quantity * tbl_close_shift_job_card.unit_price) as amnt,SUM(quantity  * (tbl_close_shift_job_card.unit_price / (1+tbl_close_shift_job_card_vat.vat))) as netamnt, item_name, SUM((quantity * (tbl_close_shift_job_card.unit_price / (1+tbl_close_shift_job_card_vat.vat))) * tbl_close_shift_job_card_vat.vat) as vat, "jc" as category_id');
            $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_job_card.item_id', 'left')
                    ->join('tbl_close_shift_job_card_vat', 'tbl_close_shift_job_card_vat.id = tbl_close_shift_job_card.close_shift_id', 'left')->where('quantity >', 0)
                    ->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left')
                    ->where_in('tbl_close_shift_job_card.shift_id', $shift_data_array)->group_by('tbl_close_shift_job_card.item_id');
            $j_cards = $this->db->get('tbl_close_shift_job_card')->result_array();

            $this->db->order_by('tbl_items.item_name');
            $this->db->select('tbl_items.item_id, item_name, 0 as category_id, 
							CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter)
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
					  		END as qty,
                                                      CASE reading
						      WHEN 4 THEN SUM(sales_manual_meter * tbl_measurement_type.value )
						      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter * tbl_measurement_type.value)
						      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price * tbl_measurement_type.value)
						      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
						      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) * tbl_measurement_type.value)
					  		END as vol,
					  		CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash)
						      WHEN 3 THEN SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price)
						      WHEN 2 THEN SUM(sales_elec_cash)
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
						      ELSE GREATEST(SUM(sales_manual_cash), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
					  		END as amnt,
                                                        CASE reading
						      WHEN 4 THEN SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)))
						      WHEN 2 THEN SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
						      ELSE GREATEST(SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
					  		END as netamnt,
					  		CASE reading
						      WHEN 4 THEN SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
						      WHEN 3 THEN SUM((sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))) * tbl_close_shift_fuels_vat.vat)
						      WHEN 2 THEN SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
						      ELSE GREATEST(SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
					  		END as vat')
                    ->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left')
                    ->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'left')
                    ->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.shift_id', 'left')
                    ->join('tbl_close_shift_fuels_vat', 'tbl_close_shift_fuels_vat.id = tbl_close_shift_fuels.close_shift_fuel_id', 'left')
                    ->where_in('tbl_close_shift_fuels.shift_id', $shift_data_array)
                    ->group_by('tbl_items.item_id');
            $fuel_centres = $this->db->get('tbl_close_shift_fuels')->result_array();
            $data = array('lubes' => $lubes, 'others' => $others, 'fuel' => $fuel_centres, 'jc' => $j_cards);
        }
//var_dump($others);exit();
        return array('type' => $type, 'data' => $data);
    }

    function dailyCashier($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post);
        $reading_method_array = array();
        $array_shift[] = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
            $array_shift[$shift['shift_id']] = $shift['shift_name'];
        }
        $real_shift_data = array();
        $data = array();
        if (count($shift_array) > 0) {
            $array_employee = array();
            $this->db->select('centre_user.name as cashier, tbl_assigned_centres.employee_id as user_id, tbl_assigned_centres.shift_id')
                    ->where_in('tbl_assigned_centres.shift_id', $shift_data_array);
            $this->db->join('tbl_users centre_user', 'centre_user.user_id = tbl_assigned_centres.employee_id', 'left')
                    ->group_by(array('tbl_assigned_centres.employee_id', 'shift_id'));
            $users = $this->db->get('tbl_assigned_centres')->result_array();

            $this->db->select('tbl_assigned_centres.employee_id, tbl_close_shift_fuels.shift_id,
	       				CASE reading      				
					      WHEN 4 THEN (tbl_close_shift_fuels.sales_manual_cash)
					      WHEN 3 THEN (tbl_close_shift_fuels.sales_elec_meter * unit_price)
					      WHEN 2 THEN (sales_elec_cash)
					      WHEN 5 THEN GREATEST((tbl_close_shift_fuels.sales_elec_meter * unit_price), (sales_elec_cash))
					      ELSE GREATEST((tbl_close_shift_fuels.sales_elec_meter * unit_price), (sales_elec_cash), (tbl_close_shift_fuels.sales_manual_cash))
				  		END as total_fuel')
                    ->join('tbl_assigned_centres', 'tbl_assigned_centres.centre_id = tbl_close_shift_fuels.centre_id', 'left')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.shift_id', 'left')
                    ->where_in('tbl_assigned_centres.shift_id', $shift_data_array)
                    ->where_in('tbl_close_shift_fuels.shift_id', $shift_data_array)
                    ->group_by(array('tbl_close_shift_fuels.shift_id', 'tbl_close_shift_fuels.pump_id'));
            $fuel_centres = $this->db->get('tbl_close_shift_fuels')->result_array();
            $fuel_totals = array();
            foreach ($fuel_centres as $fuel) {
                if (array_key_exists($fuel['employee_id'] . '-' . $fuel['shift_id'], $fuel_totals)) {
                    $fuel_totals[$fuel['employee_id'] . '-' . $fuel['shift_id']] = $fuel_totals[$fuel['employee_id'] . '-' . $fuel['shift_id']] + $fuel['total_fuel'];
                } else {
                    $fuel_totals[$fuel['employee_id'] . '-' . $fuel['shift_id']] = ($fuel['total_fuel']);
                }
            }
            $return_data = array();
            /* foreach ($shift_data_array as $shift) {
              $shift_ret_data = array();
              foreach ($users as $user) {

              $real_shift_data[$user['shift_id']] = $array_shift[$user['shift_id']];



              $shift_ret_data = $array_shift[$user['shift_id']];
              if(!(array_key_exists($user['user_id'].'-'.$user['shift_id'], $array_employee))) {
              $array_employee[$user['user_id'].'-'.$user['shift_id']] = ($user['cashier']);
              }

              $return_data['shift'] =$shift_ret_data;




              }
              }

              print_r($return_data); die(); */
            return array('shifts' => $real_shift_data, 'data' => array('employee' => $users, 'throughput' => $throughput));
        } else
            return array('shifts' => $shift_array);
    }

    function salesReport($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post);
        $reading_method_array = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        $this->db->select('tbl_products_category_type.type_id, name')->where('deleted', 0);
        $type = $this->db->get('tbl_products_category_type')->result_array();
        $fuel_array = array('type_id' => 0, 'name' => "White Products");
        array_unshift($type, $fuel_array);
        $this->db->order_by('tbl_items.item_name');
        $this->db->select('SUM(tbl_close_shift_lubes.sales_qty) as qty, SUM(credit_qty) as credit, SUM(cash_sales_amount) as cash, item_name, category_id');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_lubes.item_id', 'left')
                ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left')->where('sales_qty >', 0)
                ->where_in('tbl_close_shift_lubes.shift_id', $shift_data_array)->group_by('tbl_close_shift_lubes.item_id');
        $lubes = $this->db->get('tbl_close_shift_lubes')->result_array();

        $this->db->order_by('tbl_items.item_name');
        $this->db->select('tbl_close_shift_products.sales_qty as qty, SUM(credit_qty) as credit, SUM(cash_sales_amount) as cash, item_name, category_id');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_products.item_id', 'left')
                ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left')->where('sales_qty >', 0)
                ->where_in('tbl_close_shift_products.shift_id', $shift_data_array)->group_by('tbl_close_shift_products.item_id');
        $others = $this->db->get('tbl_close_shift_products')->result_array();
        $this->db->order_by('tbl_items.item_name');
        $this->db->select('tbl_items.item_id, item_name, 0 as category_id, 
						CASE reading
					      WHEN 4 THEN SUM(sales_manual_meter)
					      WHEN 3 THEN SUM(tbl_close_shift_fuels.sales_elec_meter)
					      WHEN 2 THEN SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price)
					      WHEN 5 THEN GREATEST(SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
					      ELSE GREATEST(SUM(sales_manual_meter), SUM(tbl_close_shift_fuels.sales_elec_meter), SUM(tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price))
				  		END as sales_qty,
				  		CASE reading
					      WHEN 4 THEN SUM(sales_manual_cash)
					      WHEN 3 THEN SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price)
					      WHEN 2 THEN SUM(sales_elec_cash)
					      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
					      ELSE GREATEST(SUM(sales_manual_cash), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
				  		END as sales_amnt')
                ->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left')
                ->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'left')
                ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.shift_id', 'left')
                ->where_in('tbl_close_shift_fuels.shift_id', $shift_data_array)
                ->group_by('tbl_items.item_id');
        $fuel_centres = $this->db->get('tbl_close_shift_fuels')->result_array();
        $this->db->order_by('tbl_items.item_name');
        $this->db->select('tbl_items.item_id, SUM(tbl_sales_items.total) as total_credits')
                ->join('tbl_sales_items', 'tbl_sales_items.sales_id = tbl_sales.sales_id', 'left')
                ->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id', 'left')
                ->where('tbl_sales.payment_type !=', 'Cash')->where('item_type', 1)->where('pump_id !=', 0)
                ->where('tbl_sales.status', 0)
                ->where_in('tbl_sales.shift_id', $shift_data_array)
                ->group_by('tbl_items.item_id');
        $credits_fuel = $this->db->get('tbl_sales')->result_array();
        return array('type' => $type, 'data' => array('lubes' => $lubes, 'others' => $others, 'fuel' => $fuel_centres, 'credits_fuel' => $credits_fuel));
    }

    function customerStatement($customer_id = NULL, $from = NULL, $to = NULL) {
        $this->db->order_by('tbl_customers_transactions.customer_transaction_id', 'asc');
        $this->db->select('tbl_customers_transactions.customer_transaction_id, tbl_customer_payments.payment_reason, tbl_customer_payments.remarks, 
			tbl_customers_transactions.datetime, tbl_customers_transactions.amount, tbl_customers_transactions.debit, tbl_customers_transactions.ref_number,
			tbl_customers_transactions.payment_type as payment_type_id, tbl_payment_type.name as payment_type, tbl_customers_transactions.transaction_type, tbl_transactions_types.name as transaction_type_name')
                ->join('tbl_customer_payments', 'tbl_customer_payments.customers_transactions_id = tbl_customers_transactions.customer_transaction_id', 'left outer')
                ->join('tbl_transactions_types', 'tbl_transactions_types.transaction_type_id = tbl_customers_transactions.transaction_type', 'left outer')
                ->join('tbl_payment_type', 'tbl_payment_type.type_id = tbl_customers_transactions.payment_type');
        $query = $this->db->get('tbl_customers_transactions');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

    public function cashSummaryReport($post = null) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post, 'asc');
        $reading_method_array = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $fuel_sales_arr = $credit_sale_arr = $lube_sale_arr = $other_sale_arr = $jc_sale_arr = array();
        $fuel_sales_arr = $shortages_arr = $excess_company_arr = $customer_payment_arr = array();
        if (count($shift_array) > 0) {
            $this->db->select('tbl_close_shift_fuels.shift_id,
                        CASE reading
                          WHEN 4 THEN SUM(sales_manual_cash)
                          WHEN 3 THEN SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price)
                          WHEN 2 THEN SUM(sales_elec_cash)
                          WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                          ELSE GREATEST(SUM(sales_manual_cash), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
                        END as fuel_amnt')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.shift_id', 'left')
                    ->where_in('tbl_close_shift_fuels.shift_id', $shift_data_array)
                    ->group_by('tbl_close_shift_fuels.shift_id');
            $fuel_sales = $this->db->get('tbl_close_shift_fuels')->result_array();
            foreach ($fuel_sales as $fuel) {
                $fuel_sales_arr[$fuel['shift_id']] = $fuel;
            }
            $this->db->select('SUM(IF(payment_type !="Cash" AND tbl_items.item_type = 1, tbl_sales_items.total, 0)) AS credit_sale_fuel, SUM(IF(payment_type !="Cash" AND tbl_products.category_id = 1, tbl_sales_items.total, 0)) AS credit_sale_lube, SUM(IF(payment_type !="Cash" AND tbl_items.item_type != 1 AND (tbl_products.category_id != null OR tbl_products.category_id != 1 OR tbl_products.category_id != ""), tbl_sales_items.total, 0)) AS credit_sale_others, tbl_sales.shift_id')
                    ->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left')
                    ->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id', 'left')
                    ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left')
                    ->where_in('tbl_sales.shift_id', $shift_data_array)
                    ->group_by('tbl_sales.shift_id');
            $credit_sales = $this->db->get('tbl_sales_items')->result_array();
            foreach ($credit_sales as $credit) {
                $credit_sale_arr[$credit['shift_id']] = $credit;
            }
            $this->db->select('tbl_close_shift_lubes.shift_id, SUM(tbl_close_shift_lubes.sales_qty * tbl_close_shift_lubes.price) as lubes_amnt')
                    ->where_in('tbl_close_shift_lubes.shift_id', $shift_data_array)
                    ->group_by('tbl_close_shift_lubes.shift_id');
            $lubes_sales = $this->db->get('tbl_close_shift_lubes')->result_array();
            foreach ($lubes_sales as $lube) {
                $lube_sale_arr[$lube['shift_id']] = $lube;
            }
            $this->db->select('tbl_close_shift_job_card.shift_id, SUM(tbl_close_shift_job_card.quantity * tbl_close_shift_job_card.unit_price) as jc_amnt')
                    ->where_in('tbl_close_shift_job_card.shift_id', $shift_data_array)
                    ->group_by('tbl_close_shift_job_card.shift_id');
            $jc_sales = $this->db->get('tbl_close_shift_job_card')->result_array();
            foreach ($jc_sales as $jc) {
                $jc_sale_arr[$jc['shift_id']] = $jc;
            }
            $this->db->select('tbl_close_shift_products.shift_id, SUM(tbl_close_shift_products.sales_qty * tbl_close_shift_products.price) as others_amnt')
                    ->where_in('tbl_close_shift_products.shift_id', $shift_data_array)
                    ->group_by('tbl_close_shift_products.shift_id');
            $others_sales = $this->db->get('tbl_close_shift_products')->result_array();
            foreach ($others_sales as $other) {
                $other_sale_arr[$other['shift_id']] = $other;
            }
            $this->db->select('tbl_customers_transactions.shift_id, SUM(amount) as amnt')
                    ->join('tbl_customers_transactions', 'tbl_customers_transactions.customer_transaction_id = tbl_customer_payments.customers_transactions_id', 'left')
                    ->where('payment_type', 1)
                    ->where_in('tbl_customers_transactions.shift_id', $shift_data_array)
                    ->group_by('tbl_customers_transactions.shift_id');
            $customer_payments = $this->db->get('tbl_customer_payments')->result_array();
            $this->db->select('tbl_close_shift_debit_user.shift_id, SUM(amount) as amnt')
                    ->where('status', 0)
                    ->where_in('tbl_close_shift_debit_user.shift_id', $shift_data_array)
                    ->group_by('tbl_close_shift_debit_user.shift_id');
            $debit_user = $this->db->get('tbl_close_shift_debit_user')->result_array();
            foreach ($debit_user as $user) {
                $shortages_arr[$user['shift_id']] = $user;
            }
            $this->db->select('tbl_close_shift_debit_company.shift_id, SUM(amount) as amnt')
                    ->where_in('tbl_close_shift_debit_company.shift_id', $shift_data_array)
                    ->group_by('tbl_close_shift_debit_company.shift_id');
            $excess_company_user = $this->db->get('tbl_close_shift_debit_company')->result_array();
            foreach ($excess_company_user as $company) {
                $excess_company_arr[$company['shift_id']] = $company;
            }
        }
        return array('shifts' => $shift_array, 'fuel_sales' => $fuel_sales_arr, 'credit_sales' => $credit_sale_arr, 'jc_sales' => $jc_sale_arr, 'lube_sales' => $lube_sale_arr, 'other_sales' => $other_sale_arr, 'customer_payment' => $customer_payment_arr, 'user_sales' => $shortages_arr, 'company_excess' => $excess_company_arr);
    }

    public function supplierSummaryReport($post = null) {
        //Customer, BBF last, SUM all debits, Total = bbf + debits, Sum paid, Balance
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post);
        $reading_method_array = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        if (count($shift_array) > 0) {
            $this->db->select('tbl_vendors_transactions.supplier_id, tbl_suppliers.company_name, tbl_vendors_transactions.bbf, SUM(IF((tbl_vendors_transactions.debit = 0), ((tbl_vendors_transactions.amount)),0)) as credit, SUM(IF((tbl_vendors_transactions.debit = 1), ((tbl_vendors_transactions.amount)),0)) as debit, tbl_vendors_transactions.amount, debit as debit_type')->join('tbl_suppliers', 'tbl_suppliers.supplier_id = tbl_vendors_transactions.supplier_id', 'left')
                    ->where_in('tbl_vendors_transactions.shift_id', $shift_data_array)->group_by('tbl_vendors_transactions.supplier_id');
            $data = $this->db->get('tbl_vendors_transactions')->result_array();
        }
        return $data;
    }

    public function supplierSummaryReport1($post = null) {
        //Customer, BBF last, SUM all debits, Total = bbf + debits, Sum paid, Balance
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post);
        $reading_method_array = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $debit_arr = array();
        $credit_arr = array();
        $suppliers_arr = array();
        if (count($shift_array) > 0) {
            $this->db->select('SUM(tbl_vendor_payments.amount) as debit, tbl_vendor_payments.amount as amnt, tbl_vendor_payments.vendor_id, bal, supplier_transaction_id')
                    ->join('tbl_suppliers_transactions', 'tbl_suppliers_transactions.payment_id = tbl_vendor_payments.payment_id', 'left')
                    ->where_in('tbl_vendor_payments.shift_id', $shift_data_array)
                    ->where_in('tbl_suppliers_transactions.shift_id', $shift_data_array)
                    ->group_by('tbl_vendor_payments.vendor_id')->order_by('supplier_transaction_id', 'desc');
            $debits = $this->db->get('tbl_vendor_payments')->result_array();
            $this->db->select('SUM(tbl_receivings.total_amount) as credit, tbl_receivings.total_amount as amnt, tbl_receivings.supplier_id, bal, supplier_transaction_id')
                    ->join('tbl_suppliers_transactions', 'tbl_suppliers_transactions.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->where_in('tbl_receivings.shift_id', $shift_data_array)
                    ->where_in('tbl_suppliers_transactions.shift_id', $shift_data_array)
                    ->group_by('tbl_receivings.supplier_id')->order_by('supplier_transaction_id', 'desc');
            $credits = $this->db->get('tbl_receivings')->result_array();
            $this->db->select('tbl_suppliers.supplier_id, tbl_suppliers.company_name');
            $suppliers_arr = $this->db->get('tbl_suppliers')->result_array();
        }

        foreach ($debits as $debit) {
            $debit_array_data = array('debit' => $debit['debit'], 'supplier_id' => $debit['vendor_id'], 'balance' => $debit['bal'], 'transaction_id' => $debit['supplier_transaction_id'], 'amnt' => $debit['amnt']);
            $debit_arr[$debit['vendor_id']] = $debit_array_data;
        }

        foreach ($credits as $credit) {
            $credit_array_data = array('credit' => $credit['credit'], 'supplier_id' => $credit['supplier_id'], 'balance' => $credit['bal'], 'transaction_id' => $credit['supplier_transaction_id'], 'amnt' => $credit['amnt']);
            $credit_arr[$credit['supplier_id']] = $credit_array_data;
        }
        return array('credit' => $credit_arr, 'debit' => $debit_arr, 'suppliers' => $suppliers_arr);
    }

    function employeeSummaryReport($post = null) {
        //Customer, BBF last, SUM all debits, Total = bbf + debits, Sum paid, Balance
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post);
        $reading_method_array = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        if (count($shift_array) > 0) {
            $this->db->select('tbl_close_shift_debit_user.user_id, tbl_employees.name, tbl_close_shift_debit_user.bbf, SUM(IF((tbl_close_shift_debit_user.debit = 1), ((tbl_close_shift_debit_user.amount)),0)) as debit, SUM(IF((tbl_close_shift_debit_user.debit = 0), ((tbl_close_shift_debit_user.amount)),0)) as credit, tbl_close_shift_debit_user.amount,SUM(tbl_close_shift_debit_user.figure) as payment, debit as debit_type')->join('tbl_employees', 'tbl_employees.emp_id = tbl_close_shift_debit_user.user_id', 'left')
                    ->where_in('tbl_close_shift_debit_user.shift_id', $shift_data_array)->group_by('tbl_close_shift_debit_user.user_id');
            $data = $this->db->get('tbl_close_shift_debit_user')->result_array();
        }
        return $data;
    }

    function customerSummaryReport($post = null) {
        //Customer, BBF last, SUM all debits, Total = bbf + debits, Sum paid, Balance
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post);
        $reading_method_array = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        if (count($shift_array) > 0) {
            $this->db->select('tbl_customers_transactions.customer_id, tbl_customers.company_name, tbl_customers_transactions.bbf, SUM(IF((tbl_customers_transactions.debit = 1), ((tbl_customers_transactions.amount)),0)) as debit, SUM(IF((tbl_customers_transactions.debit = 0), ((tbl_customers_transactions.amount)),0)) as credit, tbl_customers_transactions.amount, debit as debit_type')->join('tbl_customers', 'tbl_customers.customer_id = tbl_customers_transactions.customer_id', 'left')
                    ->where_in('tbl_customers_transactions.shift_id', $shift_data_array)->group_by('tbl_customers_transactions.customer_id');
            $data = $this->db->get('tbl_customers_transactions')->result_array();
        }
        return $data;
    }

    function supplierStatement($supplier_id = NULL, $from = NULL, $to = NULL) {
        $this->db->order_by('tbl_suppliers_transactions.supplier_transaction_id', 'asc');
        $this->db->select('DATE(tbl_suppliers_transactions.datetime) as datetime, tbl_receivings.invoice_number, tbl_receivings.delivery_note_number, 
			tbl_receivings.payment_method, tbl_receivings.total_amount, tbl_receivings.receiving_id, tbl_receivings.type, 
			tbl_vendor_payments.amount as vendor_amnt, tbl_payment_type.name as payment_type, tbl_suppliers_transactions.payment_id, 
			tbl_suppliers_transactions.bal, tbl_receivings.supplier_id, tbl_vendor_payments.vendor_id')
                ->join('tbl_receivings', 'tbl_receivings.shift_id = tbl_suppliers_transactions.shift_id AND tbl_receivings.receiving_id = tbl_suppliers_transactions.recieving_id', 'left')
                ->join('tbl_vendor_payments', 'tbl_vendor_payments.shift_id = tbl_suppliers_transactions.shift_id AND tbl_vendor_payments.payment_id =  tbl_suppliers_transactions.payment_id', 'left')
                ->join('tbl_payment_type', 'tbl_payment_type.type_id = tbl_vendor_payments.payment_method', 'left outer');
        if ($from != null) {
            $from_date = "DATE(tbl_suppliers_transactions.datetime) >= '" . date("Y-m-d", strtotime($from)) . "'";
            $this->db->where($from_date);
        }
        if ($to != null) {
            $to_date = "DATE(tbl_suppliers_transactions.datetime) <= '" . date("Y-m-d", strtotime($to)) . "'";
            $this->db->where($to_date);
        }
        $where = ('(tbl_receivings.supplier_id = ' . $supplier_id . ' OR tbl_vendor_payments.vendor_id =' . $supplier_id . ')');
        $this->db->where($where);
        $query = $this->db->get('tbl_suppliers_transactions');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

//Get Vendor Opening Amount
    function opening_balance($supplier_id = NULL, $from = NULL) {
        $this->db->order_by('tbl_suppliers_transactions.supplier_transaction_id', 'desc');
        $this->db->select('tbl_suppliers_transactions.bal')
                ->join('tbl_receivings', 'tbl_receivings.shift_id = tbl_suppliers_transactions.shift_id AND tbl_receivings.receiving_id = tbl_suppliers_transactions.recieving_id', 'left')
                ->join('tbl_vendor_payments', 'tbl_vendor_payments.shift_id = tbl_suppliers_transactions.shift_id AND tbl_vendor_payments.payment_id =  tbl_suppliers_transactions.payment_id', 'left');
        if ($from != null) {
            $from_date = "DATE(tbl_suppliers_transactions.datetime) < '" . date("Y-m-d", strtotime($from)) . "'";
            $this->db->where($from_date);
        }
        $where = ('(tbl_receivings.supplier_id = ' . $supplier_id . ' OR tbl_vendor_payments.vendor_id =' . $supplier_id . ')');
        $this->db->where($where);
        $query = $this->db->get('tbl_suppliers_transactions');
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return null;
    }

//Get Vendor Opening Amount from Today
    function opening_balance_today($supplier_id = NULL, $from = NULL) {
        $this->db->order_by('tbl_suppliers_transactions.supplier_transaction_id', 'desc');
        $this->db->select('tbl_suppliers_transactions.bal')
                ->join('tbl_receivings', 'tbl_receivings.shift_id = tbl_suppliers_transactions.shift_id AND tbl_receivings.receiving_id = tbl_suppliers_transactions.recieving_id', 'left')
                ->join('tbl_vendor_payments', 'tbl_vendor_payments.shift_id = tbl_suppliers_transactions.shift_id AND tbl_vendor_payments.payment_id =  tbl_suppliers_transactions.payment_id', 'left');
        if ($from != null) {
            $from_date = "DATE(tbl_suppliers_transactions.datetime) <= '" . date("Y-m-d", strtotime($from)) . "'";
            $this->db->where($from_date);
        }
        $where = ('(tbl_receivings.supplier_id = ' . $supplier_id . ' OR tbl_vendor_payments.vendor_id =' . $supplier_id . ')');
        $this->db->where($where);
        $query = $this->db->get('tbl_suppliers_transactions');
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return null;
    }

    function salesRegister($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post, 'asc');
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        if (count($shift_array) > 0) {
            $this->db->select('tbl_sales.payment_type, total_amount, discount, DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y") as date, card_name, lpo_number, ref_number, tbl_users.name as user, CONCAT(tbl_shifts_names.name, " of " , DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y")) as shift_name');
            $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_sales.shift_id', 'left')
                    ->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                    ->join('tbl_sales_card', 'tbl_sales_card.sales_id = tbl_sales.sales_id', 'left')
                    ->join('tbl_sales_invoice', 'tbl_sales_invoice.sales_id = tbl_sales.sales_id', 'left')
                    ->join('tbl_sales_mpesa', 'tbl_sales_mpesa.sales_id = tbl_sales.sales_id', 'left')
                    ->join('tbl_users', 'tbl_users.user_id = tbl_sales.user_id', 'left');
            $this->db->where_in('tbl_sales.shift_id', $shift_data_array)
                    ->where('tbl_sales.status', 0);
            $data = $this->db->get('tbl_sales')->result_array();
        }
        return array('data' => $data);
    }

    function creditRegisterByCustomer($cust, $from, $to) {
        $this->db->select('tbl_sales.payment_type, total_amount,tbl_customers.company_name, DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y") as date, CONCAT(tbl_shifts_names.name, " of " , DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y")) as shift_name, tbl_sales_invoice.customer_id, tbl_sales_invoice.driver, tbl_sales_invoice.lpo_number, tbl_sales_invoice.vehicle, tbl_users.name as user, CONCAT(tbl_shifts_names.name, " of " , DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y")) as shift_name');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_sales.shift_id', 'left')
                ->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                ->join('tbl_sales_invoice', 'tbl_sales_invoice.sales_id = tbl_sales.sales_id', 'left')
                ->join('tbl_customers', 'tbl_customers.customer_id = tbl_sales_invoice.customer_id', 'left')
                ->join('tbl_users', 'tbl_users.user_id = tbl_sales.user_id', 'left');
        if ($from != null) {
            $from_date = "DATE(tbl_shifts.shift_date) >= '" . date("Y-m-d", strtotime($from)) . "'";
            $this->db->where($from_date);
        }
        if ($to != null) {
            $to_date = "DATE(tbl_shifts.shift_date) <= '" . date("Y-m-d", strtotime($to)) . "'";
            $this->db->where($to_date);
        }
        $this->db->where('tbl_sales_invoice.customer_id', $cust)
                ->where('tbl_sales.status', 0);
        $data = $this->db->get('tbl_sales');
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return null;
        }
    }

    function wetStockSummary($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post, 'asc');
        $shift_day = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
            $shift_day[$shift['shift_id']] = $shift['shift_name'];
        }
        $data = array();
        if (count($shift_array) > 0) {
            $where = "";
            if (isset($post['item_id']) && !empty($post['item_id'])) {
                $where = $this->db->where('tbl_fuel_stores.item_id', $post['item_id']);
            }
            if ($this->input->post('reportType') == "cummulative") {
                $this->db->order_by('tbl_close_shift_dippings.shift_id', 'asc');

                $this->db->select('DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y") as date, tbl_close_shift_dippings.shift_id, SUM(tbl_close_shift_dippings.sales) as sales, SUM(tbl_close_shift_dippings.reciepts) as reciepts');
                $this->db->join('tbl_fuel_stores', 'tbl_fuel_stores.store_id = tbl_close_shift_dippings.store_id', 'left')
                        ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_dippings.shift_id', 'left');
                $this->db->where('tbl_fuel_stores.item_id', $post['item_id']);
                $this->db->where_in('tbl_close_shift_dippings.shift_id', $shift_data_array)
                        ->group_by('DATE(tbl_shifts.shift_date)')
                        ->group_by('tbl_fuel_stores.item_id');
                $data_array = $this->db->get('tbl_close_shift_dippings')->result_array();

                $this->db->select('(tbl_close_shift_dippings.previous_dippings) as previous_dippings, DATE(tbl_shifts.shift_date) as date, tbl_close_shift_dippings.shift_id, tbl_close_shift_dippings.store_id');
                $this->db->join('tbl_fuel_stores', 'tbl_fuel_stores.store_id = tbl_close_shift_dippings.store_id', 'left')
                        ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_dippings.shift_id', 'left');
                $this->db->where('tbl_fuel_stores.item_id', $post['item_id']);
                $this->db->where_in('tbl_close_shift_dippings.shift_id', $shift_data_array)
                        ->group_by(array('tbl_shifts.shift_date', 'store_id'));
                $data_opening = $this->db->get('tbl_close_shift_dippings')->result_array();

                // print_r($this->db->last_query());
                $this->db->select('MAX(tbl_close_shift_dippings.close_shift_id)')->from('tbl_close_shift_dippings')
                        ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_dippings.shift_id', 'left')
                        ->join('tbl_fuel_stores', 'tbl_fuel_stores.store_id = tbl_close_shift_dippings.store_id', 'left')
                        ->where('tbl_fuel_stores.item_id', $post['item_id'])
                        ->where_in('tbl_close_shift_dippings.shift_id', $shift_data_array)
                        ->group_by(array('tbl_close_shift_dippings.`store_id', 'DATE(shift_date)'));
                $sub_query = $this->db->get_compiled_select();

                $this->db->select('(tbl_close_shift_dippings.dippings) as dippings, DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y") as date, tbl_close_shift_dippings.shift_id, tbl_close_shift_dippings.store_id')
                        ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_dippings.shift_id', 'left');
                $this->db->where("close_shift_id IN ($sub_query)");
                $data_dippings = $this->db->get('tbl_close_shift_dippings')->result_array();

                $data_previous_array = array();
                foreach ($data_opening as $previous) {
                    $val = $previous['previous_dippings'];
                    if (array_key_exists($previous['shift_id'], $data_previous_array)) {
                        $val += $data_previous_array[$previous['shift_id']];
                    }
                    $data_previous_array[$previous['shift_id']] = $val;
                }
                $data_dippings_array = array();
                foreach ($data_dippings as $dips) {
                    $val = $dips['dippings'];
                    if (array_key_exists($dips['date'], $data_dippings_array)) {
                        $val += $data_dippings_array[$dips['date']];
                    }
                    $data_dippings_array[$dips['date']] = $val;
                }

                $results_array = array();
                foreach ($data_array as $data_arr) {
                    $data_arr['dippings'] = $data_dippings_array[$data_arr['date']];
                    $data_arr['previous_dippings'] = $data_previous_array[$data_arr['shift_id']];
                    $results_array[] = $data_arr;
                }

                $data = $results_array;
                //print_r($this->db->last_query());
            } else {
                $this->db->order_by('tbl_close_shift_dippings.shift_id', 'asc');
                $this->db->select('CONCAT(tbl_shifts_names.name, " of " , DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as date, 
                            SUM(tbl_close_shift_dippings.previous_dippings) as previous_dippings, SUM(tbl_close_shift_dippings.bbf) as bbf,  SUM(tbl_close_shift_dippings.dippings) as dippings, SUM(tbl_close_shift_dippings.bcf) as bcf, SUM(tbl_close_shift_dippings.reciepts) as reciepts, SUM(tbl_close_shift_dippings.sales) as sales, tbl_close_shift_dippings.shift_id, tbl_fuel_stores.item_id');
                $this->db->join('tbl_fuel_stores', 'tbl_fuel_stores.store_id = tbl_close_shift_dippings.store_id', 'left')
                        ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_dippings.shift_id', 'left')
                        ->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                        ->where_in('tbl_close_shift_dippings.shift_id', $shift_data_array)
                        ->group_by('tbl_close_shift_dippings.shift_id')
                        ->group_by('tbl_fuel_stores.item_id');
                $data = $this->db->get('tbl_close_shift_dippings')->result_array();
            }
        }
        return array('shifts' => $shift_array, 'data' => $data);
    }

    function wetStockDetailed($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post, 'asc');
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        if (count($shift_array) > 0) {
            if (isset($post['item_id']) && !empty($post['item_id'])) {
                $this->db->where('tbl_close_shift_dippings.store_id', $post['item_id']);
            }
            $this->db->order_by('tbl_close_shift_dippings.shift_id', 'asc');
            $this->db->select('tbl_close_shift_dippings.previous_dippings, tbl_close_shift_dippings.bbf,  tbl_close_shift_dippings.dippings, tbl_close_shift_dippings.bcf, tbl_close_shift_dippings.reciepts, tbl_close_shift_dippings.sales, tbl_close_shift_dippings.shift_id, tbl_close_shift_dippings.store_id')
                    ->where_in('tbl_close_shift_dippings.shift_id', $shift_data_array);
            $data = $this->db->get('tbl_close_shift_dippings')->result_array();
        }
        return array('shifts' => $shift_array, 'data' => $data);
    }

//Get Purchase Report
    function purchaseReport($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post, 'asc');
        foreach ($shift_array as $shift) {

            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        if (count($shift_array) > 0) {
            if (isset($post['invoice']) && !empty($post['invoice'])) {
                $this->db->like('tbl_receivings.invoice_number', $post['invoice']);
            }
            if (isset($post['ref']) && !empty($post['ref'])) {
                $this->db->like('tbl_receivings.delivery_note_number', $post['ref']);
            }
            $this->db->order_by('tbl_receivings.receiving_id', 'asc');
            $this->db->select('CONCAT(tbl_shifts_names.name, " of " ,DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as date, tbl_receivings.shift_id, tbl_receivings.receiving_id, tbl_recieving_items.quantity_purchased as recieving_quantity, tbl_recieving_items.item_unit_price as price, tbl_recieving_items.total_price as total, tbl_recieving_items_fuel.net_amount as total_fuel, tbl_recieving_items.tax_percentage as tax, tbl_recieving_items_fuel.recieving_quantity as recieving_quantity_fuel, tbl_recieving_items_fuel.item_unit_price as price_fuel, tbl_recieving_items_fuel.vat_amount as tax_fuel, tbl_items.item_name, fuel_items.item_name as fuel_name')
                    ->join('tbl_recieving_items_fuel', 'tbl_recieving_items_fuel.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_recieving_items', 'tbl_recieving_items.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_items', 'tbl_items.item_id = tbl_recieving_items.item_id', 'left')
                    ->join('tbl_items as fuel_items', 'fuel_items.item_id = tbl_recieving_items_fuel.item_id', 'left')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_receivings.shift_id', 'left')
                    ->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                    ->where_in('tbl_receivings.shift_id', $shift_data_array);
            $data = $this->db->get('tbl_receivings')->result_array();
        }
        return array('shifts' => $shift_array, 'data' => $data);
    }

    function purchaseSummaryReport($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post);
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        $this->db->select('tbl_products_category_type.type_id, name')->where('deleted', 0);
        $type = $this->db->get('tbl_products_category_type')->result_array();
        if (count($shift_data_array) > 0) {
            $fuel_array = array('type_id' => 0, 'name' => "White Products");
            array_unshift($type, $fuel_array);
            $this->db->order_by('tbl_receivings.receiving_id', 'asc');
            $this->db->select('tbl_receivings.shift_id, SUM(tbl_recieving_items_fuel.recieving_quantity) as qty, SUM(tbl_recieving_items_fuel.vat_amount) as vat, SUM(tbl_recieving_items_fuel.net_amount + tbl_recieving_items_fuel.vat_amount) as gross_amount, a.item_name as name, b.item_name as item_name,
                SUM(tbl_recieving_items.quantity_purchased) as qty_amnt, SUM(tbl_recieving_items.tax_percentage) as vat_amnt, SUM(tbl_recieving_items.total_price + tbl_recieving_items.tax_percentage) as gross_amnt,
                    CASE a.item_type
                    WHEN 1 THEN 0
                    ELSE tbl_products.category_id 
                    END as category_id', FALSE)
                    ->join('tbl_recieving_items_fuel', 'tbl_recieving_items_fuel.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_items a', 'a.item_id = tbl_recieving_items_fuel.item_id', 'left')
                    ->join('tbl_recieving_items', 'tbl_recieving_items.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_items b', 'b.item_id = tbl_recieving_items.item_id', 'left')
                    ->join('tbl_products', 'tbl_products.item_id = tbl_recieving_items.item_id', 'left')
                    ->where_in('tbl_receivings.shift_id', $shift_data_array)
                    ->group_start()
                    ->where('tbl_recieving_items_fuel.recieving_quantity >', 0)
                    ->or_where('tbl_recieving_items.recieving_quantity >', 0)
                    ->group_end()
                    ->group_by('tbl_recieving_items_fuel.item_id')
                    ->group_by('tbl_recieving_items.item_id');
            $data = $this->db->get('tbl_receivings')->result_array();
        }
        return array('type' => $type, 'fuels' => $data);
    }

//Get Employee Report
    function employeeReport($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post, 'asc');
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        if (count($shift_array) > 0) {
            if (isset($post['type']) && !empty($post['type'])) {
                if (isset($post['employee']) && !empty($post['employee'])) {
                    $this->db->where('tbl_close_shift_debit_user.user_id', $post['employee']);
                }
            }
            if (isset($post['reportType']) && !empty($post['reportType']) && ($post['reportType'] == "cummulative")) {
                $this->db->select('sum(if(tbl_close_shift_debit_user.amount > 0, tbl_close_shift_debit_user.amount,0)) AS credit_amount, sum(if(tbl_close_shift_debit_user.amount <= 0, tbl_close_shift_debit_user.amount,0)) AS debit_amount, operator.name as user')
                        ->join('tbl_users operator', 'operator.user_id = tbl_close_shift_debit_user.user_id', 'left')
                        ->where_in('tbl_close_shift_debit_user.shift_id', $shift_data_array)
                        ->where('tbl_close_shift_debit_user.status', 0)->group_by('tbl_close_shift_debit_user.user_id');
                $data = $this->db->get('tbl_close_shift_debit_user')->result_array();
            } else {
                $this->db->select('CONCAT(tbl_shifts_names.name, " of " ,DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as date, tbl_close_shift_debit_user.shift_id, tbl_close_shift_debit_user.amount, operator.name as user')
                        ->join('tbl_users operator', 'operator.user_id = tbl_close_shift_debit_user.user_id', 'left')
                        ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_debit_user.shift_id', 'left')
                        ->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                        ->where_in('tbl_close_shift_debit_user.shift_id', $shift_data_array)->where('tbl_close_shift_debit_user.status', 0);
                $data = $this->db->get('tbl_close_shift_debit_user')->result_array();
            }
        }
        return array('shifts' => $shift_array, 'data' => $data);
    }

    function getFuelProducts() {
        $this->db->select('tbl_items.item_id, tbl_items.item_name');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_fuel_products.item_id', 'left')
                ->where('tbl_items.deleted', 0);
        return $this->db->get('tbl_fuel_products');
    }

    function getFuelTanks() {
        $this->db->order_by('tbl_stores.store_name', 'asc');
        $this->db->select('tbl_stores.store_id as store_id, tbl_stores.store_name, tbl_fuel_stores.item_id, item_name');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_fuel_stores.store_id', 'left');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_fuel_stores.item_id', 'left');
        $this->db->join('tbl_store_type', 'tbl_store_type.type_id = tbl_stores.store_type_id', 'left');
        $this->db->where('tbl_stores.deleted', 0)->where('tbl_stores.active_status', 1);
        return $this->db->get('tbl_fuel_stores');
    }

    function getCustomers() {
        $this->db->order_by('tbl_persons.name', 'asc');
        $this->db->select('tbl_persons.person_id, tbl_persons.name');
        $this->db->join('tbl_persons', 'tbl_persons.person_id = tbl_customers.person_id', 'left');
        $this->db->where('tbl_persons.deleted', 0);
        $query = $this->db->get('tbl_customers');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    function getSuppliers() {
        $this->db->order_by('tbl_persons.name', 'asc');
        $this->db->select('tbl_persons.person_id, tbl_persons.name, tbl_suppliers.supplier_id, tbl_suppliers.company_name');
        $this->db->join('tbl_persons', 'tbl_persons.person_id = tbl_suppliers.person_id', 'left')
                ->where('tbl_persons.deleted', 0);
        return $this->db->get('tbl_suppliers');
    }

    //New
    function salesSummary($post) {
        if (isset($post['shift']) && !empty($post['shift'])) {
            $this->db->where('tbl_shifts.shift_name_id', $post['shift']);
        }
        if (isset($post['range'])) {
            $date_array = explode(" - ", $post['range']);
            $post_range = "DATE(tbl_shifts.shift_date) >= '" . date("Y-m-d", strtotime($date_array[0])) . "' AND DATE(tbl_shifts.shift_date) <= '" . date("Y-m-d", strtotime($date_array[1])) . "'";
            $this->db->where($post_range);
        }
        $this->db->order_by('tbl_shifts.shift_id', 'desc')->select('CONCAT(tbl_shifts_names.name, " of " ,DATE_FORMAT(tbl_shifts.shift_date, "%d-%b-%Y")) as shift_name, reading, tbl_shifts.shift_id, operator.name as operator', FALSE)
                ->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                ->join('tbl_users operator', 'operator.user_id = tbl_shifts.close_user_id', 'left');
        $shift_array = $this->db->get('tbl_shifts')->result_array();
        $shift_data_array = array();
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }

        $centres_array = array();
        $fuel_centres = array();
        $job_card_centres = array();
        $lube_centres = array();
        $other_centres = array();
        if (count($shift_array) > 0) {
            $this->db->select('tbl_assigned_centres.shift_id, tbl_centres.centre_name, tbl_centres.centre_id')
                    ->join('tbl_centres', 'tbl_centres.centre_id = tbl_assigned_centres.centre_id', 'left')
                    ->where_in('tbl_assigned_centres.shift_id', $shift_data_array);
            $centres_array = $this->db->get('tbl_assigned_centres')->result_array();

            $this->db->select('centre_id, shift_id, tbl_close_shift_fuels.sales_elec_meter, tbl_close_shift_fuels.sales_manual_meter, (tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) as amnt_cash_elec, unit_price as price')
                    ->where_in('tbl_close_shift_fuels.shift_id', $shift_data_array);
            $fuel_centres = $this->db->get('tbl_close_shift_fuels')->result_array();

            $this->db->select('centre_id, shift_id, tbl_close_shift_job_card.quantity, unit_price as price')
                    ->where_in('tbl_close_shift_job_card.shift_id', $shift_data_array);
            $job_card_centres = $this->db->get('tbl_close_shift_job_card')->result_array();

            $this->db->select('centre_id, shift_id, tbl_close_shift_lubes.opening_quantity, tbl_close_shift_lubes.closing_quantity, tbl_close_shift_lubes.credit_sales, receipts, price as price')
                    ->where_in('tbl_close_shift_lubes.shift_id', $shift_data_array);
            $lube_centres = $this->db->get('tbl_close_shift_lubes')->result_array();
            $this->db->select('centre_id, shift_id, tbl_close_shift_products.opening_quantity, tbl_close_shift_products.closing_quantity, tbl_close_shift_products.credit_sales, receipts, price as price')
                    ->where_in('tbl_close_shift_products.shift_id', $shift_data_array);
            $other_centres = $this->db->get('tbl_close_shift_products')->result_array();
        }
        $results_data = array('other' => $other_centres, 'lube' => $lube_centres, 'jc' => $job_card_centres, 'fuel' => $fuel_centres);
        return array('shifts' => $shift_array, 'centres' => $centres_array, 'data' => $results_data);
    }


    //VAT FULL REPORT 
    function vatDetailed($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post, 'asc');
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array('purchases' => array(), 'sales' => array());
        if (count($shift_array) > 0) {
            $this->db->order_by('tbl_recieving_items.tax', 'desc')->order_by('tbl_recieving_items_fuel.tax_percentage', 'desc')
                    ->select('SUM(tbl_recieving_items.total_price) as net_amount, SUM(tbl_recieving_items.tax_percentage) as tax_amount, tbl_recieving_items.tax as tax_perc, SUM(tbl_recieving_items_fuel.net_amount) as fuel_net_amount, SUM(tbl_recieving_items_fuel.vat_amount) as fuel_tax_amount, tbl_recieving_items_fuel.tax_percentage as fuel_tax_perc,SUM(tbl_receiving_fuel_meta.license_fees) as fee')
                    ->join('tbl_recieving_items_fuel', 'tbl_recieving_items_fuel.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_recieving_items', 'tbl_recieving_items.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_receiving_fuel_meta', 'tbl_receiving_fuel_meta.receiving_id = tbl_receivings.receiving_id', 'left')
                    ->where_in('tbl_receivings.shift_id', $shift_data_array)->group_by('tbl_recieving_items.tax, tbl_recieving_items_fuel.tax_percentage');
            $data['purchases'] = $this->db->get('tbl_receivings')->result_array();
            $this->db->select('SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as net_amount, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_lubes_vat', 'tbl_close_shift_lubes_vat.id = tbl_close_shift_lubes.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_lubes.shift_id', $shift_data_array)->group_by('vat');
            $lubes = $this->db->get('tbl_close_shift_lubes')->result_array();
            $this->db->select('SUM(sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) as net_amount, SUM((sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) * tbl_close_shift_products_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_products_vat', 'tbl_close_shift_products_vat.id = tbl_close_shift_products.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_products.shift_id', $shift_data_array)->group_by('vat');
            $others = $this->db->get('tbl_close_shift_products')->result_array();
            $this->db->select('SUM(quantity * (unit_price / (1+tbl_close_shift_job_card_vat.vat))) as net_amount, SUM((quantity * (unit_price / (1+tbl_close_shift_job_card_vat.vat))) * tbl_close_shift_job_card_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_job_card_vat', 'tbl_close_shift_job_card_vat.id = tbl_close_shift_job_card.close_shift_id', 'left')->where('quantity >', 0)
                    ->where_in('tbl_close_shift_job_card.shift_id', $shift_data_array)->group_by('vat');
            $jcs = $this->db->get('tbl_close_shift_job_card')->result_array();

//-------------------------------------------------------

 $this->db->select('SUM(tbl_petty_cash_expense_items.amount) as amount, tbl_petty_cash_items.name')
                        ->join('tbl_petty_cash_expenses', 'tbl_petty_cash_expenses.id = tbl_petty_cash_expense_items.expense_id')
                        ->join('tbl_petty_cash_items', 'tbl_petty_cash_items.id = tbl_petty_cash_expense_items.item_id')
                        ->where('approved', 1)->where_in('tbl_petty_cash_expenses.shift_id', $shift_data_array)
                        ->group_by('tbl_petty_cash_expense_items.item_id');
        $data['expensess'] = $this->db->get('tbl_petty_cash_expense_items')->result_array();
//-------------------------------------------------------


  $this->db->select('tbl_customers_transactions.shift_id, SUM(withholding_tax) as w_tax')
                    ->join('tbl_customers_transactions', 'tbl_customers_transactions.customer_transaction_id = tbl_customer_payments.customers_transactions_id', 'left')
                    ->where_in('tbl_customers_transactions.shift_id', $shift_data_array);
            $data['withholding'] = $this->db->get('tbl_customer_payments')->result_array();

                 // var_dump($data['withholding']);exit();

//-------------------------------------------------------
       // var_dump($expensess);exit();
            $this->db->select('vat,
                        CASE reading
                                  WHEN 4 THEN SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat))
                              WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)))
                              WHEN 2 THEN SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat))
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
                              ELSE GREATEST(SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
                            END as net_amount,
                        CASE reading
                          WHEN 4 THEN SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
                              WHEN 3 THEN SUM((sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))) * tbl_close_shift_fuels_vat.vat)
                              WHEN 2 THEN SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
                              ELSE GREATEST(SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
                            END tax_amount')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.shift_id', 'left')
                    ->join('tbl_close_shift_fuels_vat', 'tbl_close_shift_fuels_vat.id = tbl_close_shift_fuels.close_shift_fuel_id', 'left')
                    ->where_in('tbl_close_shift_fuels.shift_id', $shift_data_array)
                    ->group_by('vat');
            $fuels = $this->db->get('tbl_close_shift_fuels')->result_array();
            $taxes = $this->db->order_by('value', 'desc')->get('tbl_tax_type')->result_array();
            $final_array = array();
            foreach ($taxes as $tax) {
                $value = $vat = 0;
                foreach ($fuels as $fuel) {
                    if ($fuel['vat'] == $tax['value']) {
                        $value += $fuel['net_amount'];
                        $vat += $fuel['tax_amount'];
                    }
                }
                foreach ($lubes as $lube) {
                    if ($lube['vat'] == $tax['value']) {
                        $value += $lube['net_amount'];
                        $vat += $lube['tax_amount'];
                    }
                }
                foreach ($others as $other) {
                    if ($other['vat'] == $tax['value']) {
                        $value += $other['net_amount'];
                        $vat += $other['tax_amount'];
                    }
                }
                foreach ($jcs as $js) {
                    if ($js['vat'] == $tax['value']) {
                        $value += $js['net_amount'];
                        $vat += $js['tax_amount'];
                    }
                }
                $save_array = array('name' => $tax['name'], 'value' => $value, 'tax' => $vat);
                $final_array[] = $save_array;
            }
            $data['sales'] = $final_array;
        }

       // var_dump($data);exit();
        return array('data' => $data);
    }

function vatDetailedForPayment($post = NULL) {

        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post, 'asc');
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        
        $data = array('purchases' => array(), 'sales' => array());
        if (count($shift_array) > 0) {
            $this->db->order_by('tbl_recieving_items.tax', 'desc')->order_by('tbl_recieving_items_fuel.tax_percentage', 'desc')
                    ->select('SUM(tbl_recieving_items.total_price) as net_amount, SUM(tbl_recieving_items.tax_percentage) as tax_amount, tbl_recieving_items.tax as tax_perc, SUM(tbl_recieving_items_fuel.net_amount) as fuel_net_amount, SUM(tbl_recieving_items_fuel.vat_amount) as fuel_tax_amount, tbl_recieving_items_fuel.tax_percentage as fuel_tax_perc,SUM(tbl_receiving_fuel_meta.license_fees) as fee')
                    ->join('tbl_recieving_items_fuel', 'tbl_recieving_items_fuel.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_recieving_items', 'tbl_recieving_items.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_receiving_fuel_meta', 'tbl_receiving_fuel_meta.receiving_id = tbl_receivings.receiving_id', 'left')
                    ->where_in('tbl_receivings.shift_id', $shift_data_array)->group_by('tbl_recieving_items.tax, tbl_recieving_items_fuel.tax_percentage');
            $data['purchases'] = $this->db->get('tbl_receivings')->result_array();
            $this->db->select('SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as net_amount, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_lubes_vat', 'tbl_close_shift_lubes_vat.id = tbl_close_shift_lubes.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_lubes.shift_id', $shift_data_array)->group_by('vat');
            $lubes = $this->db->get('tbl_close_shift_lubes')->result_array();
            $this->db->select('SUM(sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) as net_amount, SUM((sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) * tbl_close_shift_products_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_products_vat', 'tbl_close_shift_products_vat.id = tbl_close_shift_products.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_products.shift_id', $shift_data_array)->group_by('vat');
            $others = $this->db->get('tbl_close_shift_products')->result_array();
            $this->db->select('SUM(quantity * (unit_price / (1+tbl_close_shift_job_card_vat.vat))) as net_amount, SUM((quantity * (unit_price / (1+tbl_close_shift_job_card_vat.vat))) * tbl_close_shift_job_card_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_job_card_vat', 'tbl_close_shift_job_card_vat.id = tbl_close_shift_job_card.close_shift_id', 'left')->where('quantity >', 0)
                    ->where_in('tbl_close_shift_job_card.shift_id', $shift_data_array)->group_by('vat');
            $jcs = $this->db->get('tbl_close_shift_job_card')->result_array();

//-------------------------------------------------------

 $this->db->select('SUM(tbl_petty_cash_expense_items.amount) as amount, tbl_petty_cash_items.name')
                        ->join('tbl_petty_cash_expenses', 'tbl_petty_cash_expenses.id = tbl_petty_cash_expense_items.expense_id')
                        ->join('tbl_petty_cash_items', 'tbl_petty_cash_items.id = tbl_petty_cash_expense_items.item_id')
                        ->where('approved', 1)->where_in('tbl_petty_cash_expenses.shift_id', $shift_data_array)
                        ->group_by('tbl_petty_cash_expense_items.item_id');
        $data['expensess'] = $this->db->get('tbl_petty_cash_expense_items')->result_array();
//-------------------------------------------------------
       // var_dump($expensess);exit();
            $this->db->select('vat,
                        CASE reading
                                  WHEN 4 THEN SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat))
                              WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)))
                              WHEN 2 THEN SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat))
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
                              ELSE GREATEST(SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
                            END as net_amount,
                        CASE reading
                          WHEN 4 THEN SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
                              WHEN 3 THEN SUM((sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))) * tbl_close_shift_fuels_vat.vat)
                              WHEN 2 THEN SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
                              ELSE GREATEST(SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
                            END tax_amount')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.shift_id', 'left')
                    ->join('tbl_close_shift_fuels_vat', 'tbl_close_shift_fuels_vat.id = tbl_close_shift_fuels.close_shift_fuel_id', 'left')
                    ->where_in('tbl_close_shift_fuels.shift_id', $shift_data_array)
                    ->group_by('vat');
            $fuels = $this->db->get('tbl_close_shift_fuels')->result_array();
            $taxes = $this->db->order_by('value', 'desc')->get('tbl_tax_type')->result_array();
            $final_array = array();
            foreach ($taxes as $tax) {
                $value = $vat = 0;
                foreach ($fuels as $fuel) {
                    if ($fuel['vat'] == $tax['value']) {
                        $value += $fuel['net_amount'];
                        $vat += $fuel['tax_amount'];
                    }
                }
                foreach ($lubes as $lube) {
                    if ($lube['vat'] == $tax['value']) {
                        $value += $lube['net_amount'];
                        $vat += $lube['tax_amount'];
                    }
                }
                foreach ($others as $other) {
                    if ($other['vat'] == $tax['value']) {
                        $value += $other['net_amount'];
                        $vat += $other['tax_amount'];
                    }
                }
                foreach ($jcs as $js) {
                    if ($js['vat'] == $tax['value']) {
                        $value += $js['net_amount'];
                        $vat += $js['tax_amount'];
                    }
                }
                $save_array = array('name' => $tax['name'], 'value' => $value, 'tax' => $vat);
                $final_array[] = $save_array;
            }
            $data['sales'] = $final_array;
        }

        
        $salestax= $purchasestax = $expensesstax =0;
        foreach($data['sales'] as $sale1){
            $salestax=$salestax+$sale1['tax'];
        }

       foreach($data['purchases'] as $purchase1){
            $purchasestax=$purchasestax+$purchase1['tax_amount']+$purchase1['fuel_tax_amount'];
        }

        
       foreach($data['expensess'] as $expensess1){
            $expensesstax=$expensesstax+$expensess1['amount'];
        }

        
      $res=$salestax- ($purchasestax+$expensesstax);
        return $res;
    }




    //Income Statement
    function incomeStatement($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post, 'asc');
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array('purchases' => array(), 'sales' => array());
        if (count($shift_array) > 0) {
            $this->db->order_by('tbl_recieving_items.tax', 'desc')->order_by('tbl_recieving_items_fuel.tax_percentage', 'desc')
                    ->select('SUM(tbl_recieving_items.total_price) as net_amount, SUM(tbl_recieving_items.tax_percentage) as tax_amount, tbl_recieving_items.tax as tax_perc, SUM(tbl_recieving_items_fuel.net_amount) as fuel_net_amount, SUM(tbl_recieving_items_fuel.vat_amount) as fuel_tax_amount, tbl_recieving_items_fuel.tax_percentage as fuel_tax_perc,SUM(tbl_receiving_fuel_meta.license_fees) as fee')
                    ->join('tbl_recieving_items_fuel', 'tbl_recieving_items_fuel.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_recieving_items', 'tbl_recieving_items.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_receiving_fuel_meta', 'tbl_receiving_fuel_meta.receiving_id = tbl_receivings.receiving_id', 'left')
                    ->where_in('tbl_receivings.shift_id', $shift_data_array)->group_by('tbl_recieving_items.tax, tbl_recieving_items_fuel.tax_percentage');
            $data['purchases'] = $this->db->get('tbl_receivings')->result_array();
            $this->db->select('SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as net_amount, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_lubes_vat', 'tbl_close_shift_lubes_vat.id = tbl_close_shift_lubes.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_lubes.shift_id', $shift_data_array)->group_by('vat');
            $lubes = $this->db->get('tbl_close_shift_lubes')->result_array();
            $this->db->select('SUM(sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) as net_amount, SUM((sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) * tbl_close_shift_products_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_products_vat', 'tbl_close_shift_products_vat.id = tbl_close_shift_products.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_products.shift_id', $shift_data_array)->group_by('vat');
            $others = $this->db->get('tbl_close_shift_products')->result_array();
            $this->db->select('SUM(quantity * (unit_price / (1+tbl_close_shift_job_card_vat.vat))) as net_amount, SUM((quantity * (unit_price / (1+tbl_close_shift_job_card_vat.vat))) * tbl_close_shift_job_card_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_job_card_vat', 'tbl_close_shift_job_card_vat.id = tbl_close_shift_job_card.close_shift_id', 'left')->where('quantity >', 0)
                    ->where_in('tbl_close_shift_job_card.shift_id', $shift_data_array)->group_by('vat');
            $jcs = $this->db->get('tbl_close_shift_job_card')->result_array();
            $this->db->select('vat,
                        CASE reading
                                  WHEN 4 THEN SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat))
                              WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)))
                              WHEN 2 THEN SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat))
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
                              ELSE GREATEST(SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
                            END as net_amount,
                        CASE reading
                          WHEN 4 THEN SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
                              WHEN 3 THEN SUM((sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))) * tbl_close_shift_fuels_vat.vat)
                              WHEN 2 THEN SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
                              ELSE GREATEST(SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
                            END tax_amount')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.shift_id', 'left')
                    ->join('tbl_close_shift_fuels_vat', 'tbl_close_shift_fuels_vat.id = tbl_close_shift_fuels.close_shift_fuel_id', 'left')
                    ->where_in('tbl_close_shift_fuels.shift_id', $shift_data_array)
                    ->group_by('vat');
            $fuels = $this->db->get('tbl_close_shift_fuels')->result_array();
            $taxes = $this->db->order_by('value', 'desc')->get('tbl_tax_type')->result_array();
            $final_array = array();
            foreach ($taxes as $tax) {
                $value = $vat = 0;
                foreach ($fuels as $fuel) {
                    if ($fuel['vat'] == $tax['value']) {
                        $value += $fuel['net_amount'];
                        $vat += $fuel['tax_amount'];
                    }
                }
                foreach ($lubes as $lube) {
                    if ($lube['vat'] == $tax['value']) {
                        $value += $lube['net_amount'];
                        $vat += $lube['tax_amount'];
                    }
                }
                foreach ($others as $other) {
                    if ($other['vat'] == $tax['value']) {
                        $value += $other['net_amount'];
                        $vat += $other['tax_amount'];
                    }
                }
                foreach ($jcs as $js) {
                    if ($js['vat'] == $tax['value']) {
                        $value += $js['net_amount'];
                        $vat += $js['tax_amount'];
                    }
                }
                $save_array = array('name' => $tax['name'], 'value' => $value, 'tax' => $vat);
                $final_array[] = $save_array;
            }
            $data['sales'] = $final_array;
        }
        return array('data' => $data);
    }


    //Trial Balance
    function trialBalance($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post, 'asc');
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array('purchases' => array(), 'sales' => array());
        if (count($shift_array) > 0) {
            $this->db->order_by('tbl_recieving_items.tax', 'desc')->order_by('tbl_recieving_items_fuel.tax_percentage', 'desc')
                    ->select('SUM(tbl_recieving_items.total_price) as net_amount, SUM(tbl_recieving_items.tax_percentage) as tax_amount, tbl_recieving_items.tax as tax_perc, SUM(tbl_recieving_items_fuel.net_amount) as fuel_net_amount, SUM(tbl_recieving_items_fuel.vat_amount) as fuel_tax_amount, tbl_recieving_items_fuel.tax_percentage as fuel_tax_perc,SUM(tbl_receiving_fuel_meta.license_fees) as fee')
                    ->join('tbl_recieving_items_fuel', 'tbl_recieving_items_fuel.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_recieving_items', 'tbl_recieving_items.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_receiving_fuel_meta', 'tbl_receiving_fuel_meta.receiving_id = tbl_receivings.receiving_id', 'left')
                    ->where_in('tbl_receivings.shift_id', $shift_data_array)->group_by('tbl_recieving_items.tax, tbl_recieving_items_fuel.tax_percentage');
            $data['purchases'] = $this->db->get('tbl_receivings')->result_array();
            $this->db->select('SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as net_amount, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_lubes_vat', 'tbl_close_shift_lubes_vat.id = tbl_close_shift_lubes.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_lubes.shift_id', $shift_data_array)->group_by('vat');
            $lubes = $this->db->get('tbl_close_shift_lubes')->result_array();
            $this->db->select('SUM(sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) as net_amount, SUM((sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) * tbl_close_shift_products_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_products_vat', 'tbl_close_shift_products_vat.id = tbl_close_shift_products.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_products.shift_id', $shift_data_array)->group_by('vat');
            $others = $this->db->get('tbl_close_shift_products')->result_array();
            $this->db->select('SUM(quantity * (unit_price / (1+tbl_close_shift_job_card_vat.vat))) as net_amount, SUM((quantity * (unit_price / (1+tbl_close_shift_job_card_vat.vat))) * tbl_close_shift_job_card_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_job_card_vat', 'tbl_close_shift_job_card_vat.id = tbl_close_shift_job_card.close_shift_id', 'left')->where('quantity >', 0)
                    ->where_in('tbl_close_shift_job_card.shift_id', $shift_data_array)->group_by('vat');
            $jcs = $this->db->get('tbl_close_shift_job_card')->result_array();
            $this->db->select('vat,
                        CASE reading
                                  WHEN 4 THEN SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat))
                              WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)))
                              WHEN 2 THEN SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat))
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
                              ELSE GREATEST(SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
                            END as net_amount,
                        CASE reading
                          WHEN 4 THEN SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
                              WHEN 3 THEN SUM((sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))) * tbl_close_shift_fuels_vat.vat)
                              WHEN 2 THEN SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
                              WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
                              ELSE GREATEST(SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
                            END tax_amount')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.shift_id', 'left')
                    ->join('tbl_close_shift_fuels_vat', 'tbl_close_shift_fuels_vat.id = tbl_close_shift_fuels.close_shift_fuel_id', 'left')
                    ->where_in('tbl_close_shift_fuels.shift_id', $shift_data_array)
                    ->group_by('vat');
            $fuels = $this->db->get('tbl_close_shift_fuels')->result_array();
            $taxes = $this->db->order_by('value', 'desc')->get('tbl_tax_type')->result_array();
            $final_array = array();
            foreach ($taxes as $tax) {
                $value = $vat = 0;
                foreach ($fuels as $fuel) {
                    if ($fuel['vat'] == $tax['value']) {
                        $value += $fuel['net_amount'];
                        $vat += $fuel['tax_amount'];
                    }
                }
                foreach ($lubes as $lube) {
                    if ($lube['vat'] == $tax['value']) {
                        $value += $lube['net_amount'];
                        $vat += $lube['tax_amount'];
                    }
                }
                foreach ($others as $other) {
                    if ($other['vat'] == $tax['value']) {
                        $value += $other['net_amount'];
                        $vat += $other['tax_amount'];
                    }
                }
                foreach ($jcs as $js) {
                    if ($js['vat'] == $tax['value']) {
                        $value += $js['net_amount'];
                        $vat += $js['tax_amount'];
                    }
                }
                $save_array = array('name' => $tax['name'], 'value' => $value, 'tax' => $vat);
                $final_array[] = $save_array;
            }
            $data['sales'] = $final_array;
        }
        return array('data' => $data);
    }

//Get VAT 3 Report
    function VatReturnFile($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post, 'asc');
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array('purchases' => array(), 'sales' => array());
        if (count($shift_array) > 0) {
            $this->db->order_by('tbl_recieving_items.tax', 'desc')->order_by('tbl_recieving_items_fuel.tax_percentage', 'desc')
                    ->select('SUM(tbl_recieving_items.total_price) as net_amount, SUM(tbl_recieving_items.tax_percentage) as tax_amount, tbl_recieving_items.tax as tax_perc, SUM(tbl_recieving_items_fuel.net_amount) as fuel_net_amount, SUM(tbl_recieving_items_fuel.vat_amount) as fuel_tax_amount, tbl_recieving_items_fuel.tax_percentage as fuel_tax_perc,SUM(tbl_receiving_fuel_meta.license_fees) as fee')
                    ->join('tbl_recieving_items_fuel', 'tbl_recieving_items_fuel.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_recieving_items', 'tbl_recieving_items.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_receiving_fuel_meta', 'tbl_receiving_fuel_meta.receiving_id = tbl_receivings.receiving_id', 'left')
                    ->where_in('tbl_receivings.shift_id', $shift_data_array)->group_by('tbl_recieving_items.tax, tbl_recieving_items_fuel.tax_percentage');
            $data['purchases'] = $this->db->get('tbl_receivings')->result_array();
            $this->db->select('SUM(sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) as net_amount, SUM((sales_qty * (price / (1+tbl_close_shift_lubes_vat.vat))) * tbl_close_shift_lubes_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_lubes_vat', 'tbl_close_shift_lubes_vat.id = tbl_close_shift_lubes.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_lubes.shift_id', $shift_data_array)->group_by('vat');
            $lubes = $this->db->get('tbl_close_shift_lubes')->result_array();
            $this->db->select('SUM(sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) as net_amount, SUM((sales_qty * (price / (1+tbl_close_shift_products_vat.vat))) * tbl_close_shift_products_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_products_vat', 'tbl_close_shift_products_vat.id = tbl_close_shift_products.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_products.shift_id', $shift_data_array)->group_by('vat');
            $others = $this->db->get('tbl_close_shift_products')->result_array();
            $this->db->select('SUM(quantity * (unit_price / (1+tbl_close_shift_job_card_vat.vat))) as net_amount, SUM((quantity * (unit_price / (1+tbl_close_shift_job_card_vat.vat))) * tbl_close_shift_job_card_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_job_card_vat', 'tbl_close_shift_job_card_vat.id = tbl_close_shift_job_card.close_shift_id', 'left')->where('quantity >', 0)
                    ->where_in('tbl_close_shift_job_card.shift_id', $shift_data_array)->group_by('vat');
            $jcs = $this->db->get('tbl_close_shift_job_card')->result_array();
            $this->db->select('vat,
				  		CASE reading
					              WHEN 4 THEN SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat))
						      WHEN 3 THEN SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)))
						      WHEN 2 THEN SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat))
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
						      ELSE GREATEST(SUM(sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))), SUM(sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)))
					  		END as net_amount,
				  		CASE reading
					      WHEN 4 THEN SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
						      WHEN 3 THEN SUM((sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat))) * tbl_close_shift_fuels_vat.vat)
						      WHEN 2 THEN SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat)
						      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
						      ELSE GREATEST(SUM((sales_manual_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_meter * (tbl_close_shift_fuels.unit_price/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat), SUM((sales_elec_cash/(1+tbl_close_shift_fuels_vat.vat)) * tbl_close_shift_fuels_vat.vat))
					  		END tax_amount')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.shift_id', 'left')
                    ->join('tbl_close_shift_fuels_vat', 'tbl_close_shift_fuels_vat.id = tbl_close_shift_fuels.close_shift_fuel_id', 'left')
                    ->where_in('tbl_close_shift_fuels.shift_id', $shift_data_array)
                    ->group_by('vat');
            $fuels = $this->db->get('tbl_close_shift_fuels')->result_array();
            $taxes = $this->db->order_by('value', 'desc')->get('tbl_tax_type')->result_array();
            $final_array = array();
            foreach ($taxes as $tax) {
                $value = $vat = 0;
                foreach ($fuels as $fuel) {
                    if ($fuel['vat'] == $tax['value']) {
                        $value += $fuel['net_amount'];
                        $vat += $fuel['tax_amount'];
                    }
                }
                foreach ($lubes as $lube) {
                    if ($lube['vat'] == $tax['value']) {
                        $value += $lube['net_amount'];
                        $vat += $lube['tax_amount'];
                    }
                }
                foreach ($others as $other) {
                    if ($other['vat'] == $tax['value']) {
                        $value += $other['net_amount'];
                        $vat += $other['tax_amount'];
                    }
                }
                foreach ($jcs as $js) {
                    if ($js['vat'] == $tax['value']) {
                        $value += $js['net_amount'];
                        $vat += $js['tax_amount'];
                    }
                }
                $save_array = array('name' => $tax['name'], 'value' => $value, 'tax' => $vat);
                $final_array[] = $save_array;
            }
            $data['sales'] = $final_array;
        }
        return array('data' => $data);
    }

    //Get VAT 3 Report
    function VatReturnFile1($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post, 'asc');
        foreach ($shift_array as $shift) {
            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array('purchases' => array(), 'sales' => array());
        if (count($shift_array) > 0) {
            $this->db->order_by('tbl_recieving_items.tax', 'desc')->order_by('tbl_recieving_items_fuel.tax_percentage', 'desc')
                    ->select('SUM(tbl_recieving_items.total_price) as net_amount, SUM(tbl_recieving_items.tax_percentage) as tax_amount, tbl_recieving_items.tax as tax_perc, SUM(tbl_recieving_items_fuel.net_amount) as fuel_net_amount, SUM(tbl_recieving_items_fuel.vat_amount) as fuel_tax_amount, tbl_recieving_items_fuel.tax_percentage as fuel_tax_perc')
                    ->join('tbl_recieving_items_fuel', 'tbl_recieving_items_fuel.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->join('tbl_recieving_items', 'tbl_recieving_items.recieving_id = tbl_receivings.receiving_id', 'left')
                    ->where_in('tbl_receivings.shift_id', $shift_data_array)->group_by('tbl_recieving_items.tax, tbl_recieving_items_fuel.tax_percentage');
            $data['purchases'] = $this->db->get('tbl_receivings')->result_array();
            $this->db->select('SUM(sales_qty * price) as net_amount, SUM((sales_qty * price) * tbl_close_shift_lubes_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_lubes_vat', 'tbl_close_shift_lubes_vat.id = tbl_close_shift_lubes.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_lubes.shift_id', $shift_data_array)->group_by('vat');
            $lubes = $this->db->get('tbl_close_shift_lubes')->result_array();
            $this->db->select('SUM(sales_qty * price) as net_amount, SUM((sales_qty * price) * tbl_close_shift_products_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_products_vat', 'tbl_close_shift_products_vat.id = tbl_close_shift_products.close_shift_id', 'left')->where('sales_qty >', 0)
                    ->where_in('tbl_close_shift_products.shift_id', $shift_data_array)->group_by('vat');
            $others = $this->db->get('tbl_close_shift_products')->result_array();
            $this->db->select('SUM(quantity * unit_price) as net_amount, SUM((quantity * unit_price) * tbl_close_shift_job_card_vat.vat) as tax_amount, vat')
                    ->join('tbl_close_shift_job_card_vat', 'tbl_close_shift_job_card_vat.id = tbl_close_shift_job_card.close_shift_id', 'left')->where('quantity >', 0)
                    ->where_in('tbl_close_shift_job_card.shift_id', $shift_data_array)->group_by('vat');
            $jcs = $this->db->get('tbl_close_shift_job_card')->result_array();
            $this->db->select('vat,
				  		CASE reading
					      WHEN 4 THEN SUM(sales_manual_cash)
					      WHEN 3 THEN SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price)
					      WHEN 2 THEN SUM(sales_elec_cash)
					      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
					      ELSE GREATEST(SUM(sales_manual_cash), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price), SUM(sales_elec_cash))
				  		END as net_amount,
				  		CASE reading
					      WHEN 4 THEN SUM(sales_manual_cash * tbl_close_shift_fuels_vat.vat)
					      WHEN 3 THEN SUM((sales_elec_meter * tbl_close_shift_fuels.unit_price) * tbl_close_shift_fuels_vat.vat)
					      WHEN 2 THEN SUM(sales_elec_cash * tbl_close_shift_fuels_vat.vat)
					      WHEN 5 THEN GREATEST(SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_cash * tbl_close_shift_fuels_vat.vat))
					      ELSE GREATEST(SUM(sales_manual_cash * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_meter * tbl_close_shift_fuels.unit_price * tbl_close_shift_fuels_vat.vat), SUM(sales_elec_cash * tbl_close_shift_fuels_vat.vat))
				  		END as tax_amount')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.shift_id', 'left')
                    ->join('tbl_close_shift_fuels_vat', 'tbl_close_shift_fuels_vat.id = tbl_close_shift_fuels.close_shift_fuel_id', 'left')
                    ->where_in('tbl_close_shift_fuels.shift_id', $shift_data_array)
                    ->group_by('vat');
            $fuels = $this->db->get('tbl_close_shift_fuels')->result_array();
            $taxes = $this->db->order_by('value', 'desc')->get('tbl_tax_type')->result_array();
            $final_array = array();
            foreach ($taxes as $tax) {
                $value = $vat = 0;
                foreach ($fuels as $fuel) {
                    if ($fuel['vat'] == $tax['value']) {
                        $value += $fuel['net_amount'];
                        $vat += $fuel['tax_amount'];
                    }
                }
                foreach ($lubes as $lube) {
                    if ($lube['vat'] == $tax['value']) {
                        $value += $lube['net_amount'];
                        $vat += $lube['tax_amount'];
                    }
                }
                foreach ($others as $other) {
                    if ($other['vat'] == $tax['value']) {
                        $value += $other['net_amount'];
                        $vat += $other['tax_amount'];
                    }
                }
                foreach ($jcs as $js) {
                    if ($js['vat'] == $tax['value']) {
                        $value += $other['net_amount'];
                        $vat += $other['tax_amount'];
                    }
                }
                $save_array = array('name' => $tax['name'], 'value' => $value, 'tax' => $vat);
                $final_array[] = $save_array;
            }
            $data['sales'] = $final_array;
        }
        return array('data' => $data);
    }

}

?>