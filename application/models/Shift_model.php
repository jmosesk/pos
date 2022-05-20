<?php

class Shift_model extends CI_Model {

    private $tbl_user = 'tbl_shifts';

//tbl_shifts => If status = 0, open, 1 == closed, 2 == First Shift
    function __construct() {
        parent::__construct();
    }

//Shift Name
    function get_shiftName_list() {
        $this->db->order_by('name', 'asc');
        $this->db->where('deleted', 0);
        return $this->db->get('tbl_shifts_names');
    }

    function updateShiftName($id, $user) {
        $this->db->where('shift_name_id', $id);
        $this->db->update('tbl_shifts_names', $user);
    }

    function saveShiftName($admin) {
        $this->db->insert('tbl_shifts_names', $admin);
        return $this->db->insert_id();
    }

    function get_ShiftName_by_id($id) {
        $this->db->where('shift_name_id', $id);
        return $this->db->get('tbl_shifts_names');
    }

//Shift Allocation
    function get_list_allocation() {
        $this->db->order_by('assign_id', 'desc');
        return $this->db->get('tbl_assigned_centres');
    }

    function saveShiftAllocation($admin) {
        $this->db->insert('tbl_assigned_centres', $admin);
        return $this->db->insert_id();
    }

//Get Allocated Users and Users by ID
    function get_Allocation_by_id($id) {
        $this->db->where('tbl_assigned_centres.shift_id', $id);
        $this->db->select('tbl_shifts.shift_id, tbl_shifts.close_user_id, tbl_shifts.status, tbl_shifts_names.name as shift_name, tbl_users.name as username, tbl_centres.centre_name, tbl_users.user_id, tbl_assigned_centres.centre_id');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_assigned_centres.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_assigned_centres.centre_id', 'left');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Get Allocated Centres and Users by ID
    function getAllocatedUserById($id) {
        $this->db->order_by('tbl_users.name', 'tbl_assigned_centres.centre_id');
        $this->db->where('tbl_assigned_centres.shift_id', $id);
        $this->db->select('tbl_users.name as username, tbl_users.user_id, tbl_assigned_centres.centre_id');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id', 'left')
                ->group_by('tbl_assigned_centres.employee_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Get Allocated Centres and Users by ID for cash reconcilliation
    function get_drops_by_shiftId($id) {
        $this->db->where('tbl_close_shift_drops.shift_id', $id);
        $this->db->select('tbl_shifts.shift_id, tbl_shifts.shift_date, tbl_shifts_names.name as shift_name, tbl_users.name as username, tbl_close_shift_drops.amount as actual_amount, tbl_close_shift_drops.status as status, tbl_close_shift_drops.user_id');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_drops.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_close_shift_drops.user_id', 'left');
        $this->db->group_by('tbl_close_shift_drops.user_id');
        $query = $this->db->get('tbl_close_shift_drops');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Credit Sales
    function sum_credit_sales_employee($shift_id) {
        $this->db->select('SUM(tbl_sales.total_amount) as total_credit_amount');

        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_assigned_centres.shift_id', 'left')
                ->join('tbl_sales', 'tbl_sales.shift_id = tbl_assigned_centres.shift_id');

        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_assigned_centres.centre_id', 'left');
        $this->db->join('tbl_centre_type', 'tbl_centre_type.centre_type_id = tbl_centres.centre_type_id', 'left');
        $this->db->where('tbl_assigned_centres.shift_id', $shift_id)->group_by('tbl_users.user_id')->group_by('tbl_sales.payment_type');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Credit Sales per Centre  per Shift
    function sum_credit_sales_products($shift_id) {
        $this->db->select('tbl_centres.centre_id, SUM(tbl_sales_items.total) as total_credit_amount');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id')
                ->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id')
                ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id')
                ->join('tbl_centres', 'tbl_centres.centre_id = tbl_products.centre_id');
        $this->db->where('tbl_sales.shift_id', $shift_id)
                ->where('tbl_sales.payment_type !=', "Cash")
                ->where('tbl_items.item_type !=1')->group_by('tbl_centres.centre_id');
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Credit Sales per Centre Per Shift
    function SumAllCreditSales($shift_id) {
        $this->db->select('tbl_sales_items.centre_id, SUM(tbl_sales_items.total) as total_credit_sales')
                ->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id')
                ->where('tbl_sales.status', 0)
                ->where('tbl_sales.shift_id', $shift_id)
                ->where('tbl_sales.payment_type !=', "Cash")
                ->group_by('centre_id');
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

//Sum Sales FC Job Cards per Shift per Centre ID
    function SalesJobCards($shift_id) {
        $this->db->select('centre_id,
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
        $this->db->select('employee_id as user_id,
			SUM(IF((tbl_close_shift_job_card.shift_id = ' . $shift_id . '), (unit_price * quantity), 0)) as job_card_sales')
                ->join('tbl_assigned_centres', 'tbl_assigned_centres.centre_id = tbl_close_shift_job_card.centre_id AND 
						tbl_assigned_centres.shift_id = tbl_close_shift_job_card.shift_id')
                ->group_by('employee_id')
                ->where('tbl_close_shift_job_card.shift_id', $shift_id); /*
          $query = $this->db->query('SELECT `employee_id` as `user_id`, SUM(IF((tbl_close_shift_job_card.shift_id = '.$shift_id.'), (unit_price * quantity), 0)) as job_card_sales FROM `tbl_close_shift_job_card` INNER JOIN `tbl_assigned_centres` ON `tbl_assigned_centres`.`centre_id` = `tbl_close_shift_job_card`.`centre_id` AND tbl_assigned_centres.shift_id = tbl_close_shift_job_card.shift_id WHERE `tbl_close_shift_job_card`.`shift_id` = '.$shift_id.' GROUP BY `employee_id`'); */
        $query = $this->db->get('tbl_close_shift_job_card');
        if ($query->num_rows() > 0)
            return $query;
        else
            return NULL;
    }

//Sum Credit Sales per Island per Shift
    function sum_credit_sales_island($shift_id) {
        $this->db->select('tbl_centres.centre_id, SUM(tbl_sales_items.total) as total_credit_amount');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id')
                ->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_sales_items.pump_id', 'left outer')
                ->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id')
                ->join('tbl_centres', 'tbl_centres.centre_id = tbl_pumps.centre_id', 'left outer');
        $this->db->where('tbl_sales.shift_id', $shift_id)
                ->where('tbl_sales.payment_type !=', "Cash")->where('tbl_sales.status', 0)
                ->group_by('tbl_centres.centre_id');
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Credit Sales per Person per Shift per Payment Type
    function CreditSalesPerUser($shift_id) {
        $this->db->select('tbl_assigned_centres.employee_id as user_id,
			SUM(IF((tbl_sales.payment_type = "Invoice" AND tbl_sales.status = 0 AND tbl_sales.shift_id = ' . $shift_id . '), `tbl_sales_items`.`total`, 0)) as invoice_credit,
			SUM(IF((tbl_sales.payment_type = "Mpesa" AND tbl_sales.status = 0 AND tbl_sales.shift_id = ' . $shift_id . '), `tbl_sales_items`.`total`, 0)) as mpesa_credit,
			SUM(IF((tbl_sales.payment_type = "Fuel Card" AND tbl_sales.status = 0 AND tbl_sales.shift_id = ' . $shift_id . '), `tbl_sales_items`.`total`, 0)) as fuel_card_credit,
			SUM(IF((tbl_sales.payment_type = "Credit Card" AND tbl_sales.status = 0 AND tbl_sales.shift_id = ' . $shift_id . '), `tbl_sales_items`.`total`, 0)) as credit_card_credit, 
			SUM(tbl_sales_items.total) as total_credit_amount');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id')
                ->join('tbl_assigned_centres', 'tbl_assigned_centres.centre_id = tbl_sales_items.centre_id', 'inner');
        $this->db->where('tbl_sales.shift_id', $shift_id)
                ->where('tbl_sales.payment_type !=', "Cash")->where('tbl_sales.status', 0)
                ->where('tbl_assigned_centres.shift_id', $shift_id)
                ->group_by('tbl_assigned_centres.employee_id');
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Credit Sales per Person per Shift per Payment Type
    function CreditIslandPaymentType($shift_id) {
        $this->db->select('tbl_centres.centre_id, tbl_users.user_id, tbl_users.name as user,
			SUM(IF((tbl_sales.payment_type = "Invoice" AND tbl_sales.shift_id = ' . $shift_id . '), tbl_sales_items.total,0)) as invoice_credit,
			SUM(IF((tbl_sales.payment_type = "Mpesa" AND tbl_sales.shift_id = ' . $shift_id . '), tbl_sales_items.total,0)) as mpesa_credit,
			SUM(IF((tbl_sales.payment_type = "Fuel Card" AND tbl_sales.shift_id = ' . $shift_id . '), tbl_sales_items.total,0)) as fuel_card_credit,
			SUM(IF((tbl_sales.payment_type = "Credit Card" AND tbl_sales.shift_id = ' . $shift_id . '), tbl_sales_items.total,0)) as credit_card_credit,
			SUM(tbl_sales_items.total) as total_credit_amount');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id')
                ->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_sales_items.pump_id', 'left outer')
                ->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id')
                ->join('tbl_centres', 'tbl_centres.centre_id = tbl_pumps.centre_id', 'left outer')
                ->join('tbl_assigned_centres', 'tbl_assigned_centres.centre_id = tbl_centres.centre_id')
                ->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id');
        $this->db->where('tbl_sales.shift_id', $shift_id)
                ->where('tbl_sales.payment_type !=', "Cash")
                ->group_by('tbl_assigned_centres.employee_id');
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    //Sum Reciepts and Payments per Shift - Group per User
    function SumEmpPayments($shift_id = NULL) {
        $this->db->select('
			tbl_close_shift_debit_user.employee_id as user_id,
			SUM(IF((tbl_close_shift_debit_user.shift_id = ' . $shift_id . ' AND tbl_close_shift_debit_user.transaction_type = 2 AND payment_type = 1), ((tbl_close_shift_debit_user.figure)),0)) as employee_payment_amt')
                ->where('tbl_close_shift_debit_user.shift_id', $shift_id)
                ->group_by('tbl_close_shift_debit_user.employee_id');
        $query = $this->db->get('tbl_close_shift_debit_user');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    //Sum Reciepts and Payments per Shift - Group per User
    function SumRecievingsEmpPayments($shift_id = NULL) {
        $this->db->select('
			tbl_close_shift_debit_user.employee_id as user_id, tbl_employee_payments.centre_id,
			SUM(IF((tbl_close_shift_debit_user.shift_id = ' . $shift_id . ' AND tbl_close_shift_debit_user.transaction_type = 2 AND payment_type = 1), ((tbl_close_shift_debit_user.figure)),0)) as customer_payment_amt')
                ->join('tbl_employee_payments', 'tbl_employee_payments.employee_transactions_id = tbl_close_shift_debit_user.adjust_amt_id')
                ->where('tbl_close_shift_debit_user.shift_id', $shift_id)
                ->group_by('tbl_employee_payments.centre_id');
        $query = $this->db->get('tbl_close_shift_debit_user');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
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
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Reciepts and Payments per Shift - Group per User
    function SumRecievingsPayments($shift_id = NULL) {
        $this->db->select('
			tbl_receivings.payment_user_id as user_id, tbl_receivings.centre_id,
			SUM(IF((tbl_receivings.shift_id = ' . $shift_id . ' AND tbl_receivings.payment_method = "CASH"), ((tbl_receivings.total_amount)),0)) as recieving_payment')
                ->where('tbl_receivings.shift_id', $shift_id)
                ->group_by('tbl_receivings.centre_id');
        $query = $this->db->get('tbl_receivings');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Drops and Excess User  per Shift
    function DropsExcessPerCentre($shift_id = NULL) {
        $this->db->select('tbl_close_shift_drops.close_shift_drops_id, tbl_close_shift_drops.centre_id, tbl_close_shift_drops.amount as drops, tbl_close_shift_drops.excess as excess');
        $this->db->where('tbl_close_shift_drops.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_drops');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Drops and Excess User  per Shift
    function DebitReversalPerUser($shift_id = NULL) {
        $this->db->select('SUM(tbl_close_shift_debit_user_reversal.amount) as amnt, user_id');
        $this->db->where('tbl_close_shift_debit_user_reversal.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_debit_user_reversal')->result_array();
        return $query;
    }

//Sum Fuel Sales per employee per centre
    function SalesPerFuelCentre($shift_id = null) {
        //$this->db->order_by('tbl_centres.centre_name', 'asc');
        $this->db->select('tbl_close_shift_fuels.centre_id, SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_electronic_meter_reading) - (tbl_close_shift_fuels.opening_electronic_meter_reading) - tbl_close_shift_fuels.rtt) * tbl_items.unit_price),0)) as elec_meter_cash_sales,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), ((tbl_close_shift_fuels.closing_electronic_cash_reading) - (tbl_close_shift_fuels.opening_electronic_cash_reading) - tbl_close_shift_fuels.rtt),0)) as elec_cash_sales,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_manual_meter_reading) - (tbl_close_shift_fuels.opening_manual_meter_reading) - tbl_close_shift_fuels.rtt) * tbl_items.unit_price),0)) as manual_cash_sales');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'inner')
                ->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'inner');
        $this->db->where('tbl_close_shift_fuels.shift_id', $shift_id)
                //->where('tbl_close_shift_drops.shift_id', $shift_id)
                //->where('tbl_close_shift_drops.shift_id', $shift_id)
                ->group_by('tbl_close_shift_fuels.centre_id');
        $query = $this->db->get('tbl_close_shift_fuels');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

    //Sum of LPG per centre
    function SalesPerLpgCentre($shift_id = null) {
        $this->db->select('tbl_assigned_centres.centre_id, tbl_centres.centre_name, tbl_centres.fuel_centre, tbl_assigned_centres.employee_id as user_id, tbl_users.name,
			SUM(IF((tbl_close_shift_products.shift_id = ' . $shift_id . '), ((tbl_close_shift_products.opening_quantity + tbl_close_shift_products.receipts - tbl_close_shift_products.closing_quantity) * tbl_close_shift_products.price) ,0)) as total_sales_amount_lpg');
        $this->db->join('tbl_close_shift_products', 'tbl_close_shift_products.centre_id = tbl_assigned_centres.centre_id', 'left')
                ->join('tbl_centres', 'tbl_centres.centre_id = tbl_assigned_centres.centre_id')
                ->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id');
        $this->db->where('tbl_assigned_centres.shift_id', $shift_id)
                ->group_by('tbl_assigned_centres.centre_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Non Fuel per employee per centre
    function SalesPerLubeCentre($shift_id = null) {
        $this->db->select('tbl_assigned_centres.centre_id, 
            SUM(IF((tbl_close_shift_lubes.shift_id = ' . $shift_id . '), ((tbl_close_shift_lubes.opening_quantity + tbl_close_shift_lubes.receipts - tbl_close_shift_lubes.closing_quantity) * tbl_close_shift_lubes.price) ,0)) as total_sales_amt_lubes');
        $this->db->join('tbl_close_shift_lubes', 'tbl_close_shift_lubes.centre_id = tbl_assigned_centres.centre_id', 'left');
        $this->db->where('tbl_assigned_centres.shift_id', $shift_id)
                ->group_by('tbl_assigned_centres.employee_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

    /* ---------Start Per User Drops -------------------- */

    //Sum of LPG per User
    function SalesPerLpgUser($shift_id = null) {
        $this->db->select('tbl_assigned_centres.employee_id as user_id, tbl_users.name, tbl_assigned_centres.centre_id,
            SUM(IF((tbl_close_shift_products.shift_id = ' . $shift_id . '), ((tbl_close_shift_products.opening_quantity + tbl_close_shift_products.receipts - tbl_close_shift_products.closing_quantity) * tbl_close_shift_products.price) ,0)) as total_sales_amount_lpg');
        $this->db->join('tbl_close_shift_products', 'tbl_close_shift_products.centre_id = tbl_assigned_centres.centre_id', 'left')
                ->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id');
        $this->db->where('tbl_assigned_centres.shift_id', $shift_id)
                ->group_by('tbl_assigned_centres.employee_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Drops and Excess User  per Shift
    function DropsExcessPerUser($shift_id = NULL) {
        $this->db->select('tbl_close_shift_drops.user_id, SUM(tbl_close_shift_drops.amount) as drops, SUM(tbl_close_shift_drops.excess) as excess, close_shift_drops_id');
        $this->db->where('tbl_close_shift_drops.shift_id', $shift_id)
                ->group_by('tbl_close_shift_drops.user_id');
        $query = $this->db->get('tbl_close_shift_drops');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Fuel Sales per employee per centre
    function SalesPerFuelUser($shift_id = null) {
        //$this->db->order_by('tbl_centres.centre_name', 'asc');
        $this->db->select('tbl_assigned_centres.employee_id as user_id, SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_electronic_meter_reading) - (tbl_close_shift_fuels.opening_electronic_meter_reading) - tbl_close_shift_fuels.rtt) * tbl_items.unit_price),0)) as elec_meter_cash_sales,
            SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), ((tbl_close_shift_fuels.closing_electronic_cash_reading) - (tbl_close_shift_fuels.opening_electronic_cash_reading) - tbl_close_shift_fuels.rtt),0)) as elec_cash_sales,
            SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_manual_meter_reading) - (tbl_close_shift_fuels.opening_manual_meter_reading) - tbl_close_shift_fuels.rtt) * tbl_items.unit_price),0)) as manual_cash_sales');
        $this->db->join('tbl_close_shift_fuels', 'tbl_close_shift_fuels.centre_id = tbl_assigned_centres.centre_id', 'left');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'inner')
                ->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'inner')
                ->where('tbl_assigned_centres.shift_id', $shift_id)
                ->group_by('tbl_assigned_centres.employee_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Non Fuel per employee per centre
    function SalesPerLubeUser($shift_id = null) {
        $this->db->select('tbl_assigned_centres.centre_id, tbl_assigned_centres.employee_id as user_id,
            SUM(IF((tbl_close_shift_lubes.shift_id = ' . $shift_id . '), ((tbl_close_shift_lubes.opening_quantity + tbl_close_shift_lubes.receipts - tbl_close_shift_lubes.closing_quantity) * tbl_close_shift_lubes.price) ,0)) as total_sales_amt_lubes');
        $this->db->join('tbl_close_shift_lubes', 'tbl_close_shift_lubes.centre_id = tbl_assigned_centres.centre_id', 'left');
        $this->db->where('tbl_assigned_centres.shift_id', $shift_id)
                ->group_by('tbl_assigned_centres.employee_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Reciepts and Payments per Shift - Group per User
    function SumPaymentsUser($shift_id = NULL) {
        $this->db->select('
            tbl_customers_transactions.employee_id as user_id,
            SUM(IF((tbl_customers_transactions.shift_id = ' . $shift_id . ' AND tbl_customers_transactions.transaction_type = 2 AND payment_type = 1), ((tbl_customers_transactions.amount)),0)) as customer_payment_amt')
                ->where('tbl_customers_transactions.shift_id', $shift_id)
                ->group_by('tbl_customers_transactions.employee_id');
        $query = $this->db->get('tbl_customers_transactions');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Reciepts and Payments per Shift - Group per User
    function SumRecievingsPaymentsUser($shift_id = NULL) {
        $this->db->select('
            tbl_receivings.employee_id as user_id,
            SUM(IF((tbl_receivings.shift_id = ' . $shift_id . ' AND tbl_receivings.payment_method = "CASH"), ((tbl_receivings.total_amount)),0)) as recieving_payment')
                ->where('tbl_receivings.shift_id', $shift_id)
                ->group_by('tbl_receivings.employee_id');
        $query = $this->db->get('tbl_receivings');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    //Sum Credit Sales per Centre Per User
    function SumAllCreditSalesUser($shift_id) {
        $this->db->select('SUM(tbl_sales_items.total) as total_credit_sales, tbl_assigned_centres.employee_id as user_id')
                ->join('tbl_sales_items', 'tbl_sales_items.centre_id = tbl_assigned_centres.centre_id', 'left')
                ->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left');
        $this->db->where('tbl_sales.shift_id', $shift_id)->where('tbl_assigned_centres.shift_id', $shift_id)
                ->where('tbl_sales.payment_type !=', "Cash")->where('tbl_sales.status', 0)
                ->group_by('tbl_assigned_centres.employee_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

//Sum expenses Centre Per User
    function SumAllExpenses($shift_id) {
        $this->db->select('tbl_petty_cash_expenses.cashier as user_id, SUM(tbl_petty_cash_expenses.total) as total_expenses_sales')
                ->where('tbl_petty_cash_expenses.shift_id', $shift_id)->where('approved', 1)
                ->group_by('cashier');
        $query = $this->db->get('tbl_petty_cash_expenses')->result_array();
        return $query;
    }

//Sum Sales FC Job Cards per Shift per Centre ID
    function Sales_JobCards_user($shift_id) {
        $this->db->select('tbl_assigned_centres.centre_id, tbl_assigned_centres.employee_id as user_id,
            SUM(IF((tbl_close_shift_job_card.shift_id = ' . $shift_id . '), (unit_price * quantity), 0)) as job_card_sales')
                ->join('tbl_close_shift_job_card', 'tbl_close_shift_job_card.centre_id = tbl_assigned_centres.centre_id', 'left')
                ->where('tbl_assigned_centres.shift_id', $shift_id)
                ->group_by('tbl_assigned_centres.employee_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return NULL;
        }
    }

    /* ------------------- END of Drops ------------------- */

//Sum sales per employee per centre
    function SalesPerCentre($shift_id = null) {
        $this->db->order_by('tbl_centres.centre_name', 'asc');
        $this->db->select('tbl_shifts.status as shift_status, tbl_shifts.shift_id, tbl_shifts.shift_date, tbl_shifts_names.name as shift_name, tbl_users.user_id, tbl_users.name, tbl_centres.centre_name, tbl_centres.centre_type_id, tbl_centres.lubes_type, tbl_centres.fuel_centre,
			tbl_centre_type.name as centre_type, tbl_centres.centre_id,			
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_electronic_meter_reading) - (tbl_close_shift_fuels.opening_electronic_meter_reading) - tbl_close_shift_fuels.rtt) * tbl_items.unit_price),0)) as elec_meter_cash_sales,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), ((tbl_close_shift_fuels.closing_electronic_cash_reading) - (tbl_close_shift_fuels.opening_electronic_cash_reading) - tbl_close_shift_fuels.rtt),0)) as elec_cash_sales,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_manual_meter_reading) - (tbl_close_shift_fuels.opening_manual_meter_reading) - tbl_close_shift_fuels.rtt) * tbl_items.unit_price),0)) as manual_cash_sales,
			SUM(IF((tbl_close_shift_lubes.shift_id = ' . $shift_id . '), ((tbl_close_shift_lubes.opening_quantity + tbl_close_shift_lubes.receipts - tbl_close_shift_lubes.closing_quantity) *tbl_close_shift_lubes.price) ,0)) as total_sales_amt_lubes,
			SUM(IF((tbl_close_shift_products.shift_id = ' . $shift_id . '), ((tbl_close_shift_products.opening_quantity + tbl_close_shift_products.receipts - tbl_close_shift_products.closing_quantity) *tbl_close_shift_products.price),0)) as total_sales_products');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_assigned_centres.shift_id', 'left')
                ->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                ->join('tbl_close_shift_fuels', 'tbl_close_shift_fuels.centre_id = tbl_assigned_centres.centre_id', 'left outer')
                ->join('tbl_close_shift_lubes', 'tbl_close_shift_lubes.centre_id = tbl_assigned_centres.centre_id', 'left outer')
                ->join('tbl_close_shift_products', 'tbl_close_shift_products.centre_id = tbl_assigned_centres.centre_id', 'left outer');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_assigned_centres.centre_id', 'left');
        $this->db->join('tbl_centre_type', 'tbl_centre_type.centre_type_id = tbl_centres.centre_type_id', 'left');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left')
                ->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'left');
        $this->db->where('tbl_assigned_centres.shift_id', $shift_id)
                //->where('tbl_close_shift_drops.shift_id', $shift_id)
                //->where('tbl_close_shift_drops.shift_id', $shift_id)
                ->group_by('tbl_centres.centre_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum sales per employee per centre for reconcilliation
    function ShiftUsers($shift_id = null) {
        $this->db->order_by('tbl_users.name', 'asc');
        $this->db->select('tbl_shifts.shift_date, tbl_shifts_names.name as shift_name, tbl_shifts.datetime, tbl_shifts.reading, tbl_shifts.status as shift_status, tbl_users.user_id, tbl_users.name, tbl_centres.centre_name, tbl_assigned_centres.centre_id, tbl_shifts.reading');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_assigned_centres.shift_id', 'left')
                ->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_assigned_centres.centre_id', 'left');        
        $this->db->where('tbl_assigned_centres.shift_id', $shift_id)->group_by('tbl_users.user_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum sales per employee per centre for reconcilliation
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

    //Sum of LPG per centre
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

//Sum Non Fuel per employee per centre
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

//Sum sales per employee per centre for reconcilliation
    function SalesPerUser($shift_id = null) {
        $this->db->order_by('tbl_centres.centre_name', 'asc');
        $this->db->select('tbl_shifts.shift_date, tbl_shifts_names.name as shift_name, tbl_shifts.status as shift_status, tbl_users.user_id, tbl_users.name, tbl_centres.centre_name, tbl_centres.centre_type_id, tbl_centre_type.name as centre_type, tbl_centres.centre_id, tbl_centres.fuel_centre,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_electronic_meter_reading) - (tbl_close_shift_fuels.opening_electronic_meter_reading) - tbl_close_shift_fuels.rtt) * tbl_items.unit_price),0)) as elec_meter_cash_sales,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), ((tbl_close_shift_fuels.closing_electronic_cash_reading) - (tbl_close_shift_fuels.opening_electronic_cash_reading) - tbl_close_shift_fuels.rtt),0)) as elec_cash_sales,
			SUM(IF((tbl_close_shift_fuels.shift_id = ' . $shift_id . '), (((tbl_close_shift_fuels.closing_manual_meter_reading) - (tbl_close_shift_fuels.opening_manual_meter_reading) - tbl_close_shift_fuels.rtt) * tbl_items.unit_price),0)) as manual_cash_sales,
			SUM(IF((tbl_close_shift_lubes.shift_id = ' . $shift_id . '), ((tbl_close_shift_lubes.opening_quantity + tbl_close_shift_lubes.receipts - tbl_close_shift_lubes.closing_quantity) *tbl_close_shift_lubes.price) ,0)) as total_sales_amt_lubes,
			SUM(IF((tbl_close_shift_products.shift_id = ' . $shift_id . '), ((tbl_close_shift_products.opening_quantity + tbl_close_shift_products.receipts - tbl_close_shift_products.closing_quantity) *tbl_close_shift_products.price),0)) as total_sales_products');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_assigned_centres.shift_id', 'left')
                ->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                ->join('tbl_close_shift_fuels', 'tbl_close_shift_fuels.centre_id = tbl_assigned_centres.centre_id', 'left outer')
                ->join('tbl_close_shift_lubes', 'tbl_close_shift_lubes.centre_id = tbl_assigned_centres.centre_id', 'left outer')
                ->join('tbl_close_shift_products', 'tbl_close_shift_products.centre_id = tbl_assigned_centres.centre_id', 'left outer');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_assigned_centres.centre_id', 'left');
        $this->db->join('tbl_centre_type', 'tbl_centre_type.centre_type_id = tbl_centres.centre_type_id', 'left');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left')
                ->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'left');
        $this->db->where('tbl_assigned_centres.shift_id', $shift_id)->group_by('tbl_users.user_id');
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Total excess per shift per Employee
    function sum_total_excess_employee($user_id, $shift_id) {
        $this->db->select('SUM(tbl_employee_excess.amount) as excess_amount, tbl_transactions.shift_id');
        $this->db->join('tbl_employee_excess', 'tbl_employee_excess.transaction_id = tbl_transactions.transaction_id', 'left');
        $this->db->where('tbl_employee_excess.employee_id', $user_id);
        $this->db->where('tbl_transactions.shift_id', $shift_id);
        $query = $this->db->get('tbl_transactions');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Total Shortage per Shift per Employee
    function sum_total_short_employee($user_id, $shift_id) {
        $this->db->select('SUM(tbl_employee_shortage.amount) as shortage_amount, tbl_transactions.shift_id');
        $this->db->join('tbl_employee_shortage', 'tbl_employee_shortage.transaction_id = tbl_transactions.transaction_id', 'left');
        $this->db->where('tbl_employee_shortage.employee_id', $user_id);
        $this->db->where('tbl_transactions.shift_id', $shift_id);
        $query = $this->db->get('tbl_transactions');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Shifts List
    function get_list_shifts() {
        $this->db->order_by('shift_id', 'desc');
        $this->db->select('tbl_shifts.shift_id, tbl_shifts.assigned, tbl_shifts.shift_date, tbl_shifts.close_user_id, tbl_shifts.status, tbl_shifts_names.name as shift_name, tbl_users.name as username');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_shifts.close_user_id', 'left');
        return $this->db->get('tbl_shifts');
    }

//Get DB Backup 
    function get_db_backup($shift_id = null) {
        $this->db->select('tbl_shifts_names.name as shift_name, tbl_users.name as username, tbl_shifts.datetime, tbl_shifts.shift_date, tbl_backup.shift_id, id, tbl_backup.datetime as backup_date');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_backup.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                ->where('tbl_shifts.status', 1);
        if ($shift_id != null) {
            $this->db->where('tbl_backup.shift_id', $shift_id);
        } else
            $this->db->group_by('tbl_backup.shift_id');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_shifts.close_user_id', 'left');
        return $this->db->get('tbl_backup')->result_array();
    }

//Get List of Closed Shifts
    function get_list_closed_shifts() {
        $this->db->order_by('shift_id', 'desc');
        $this->db->select('tbl_shifts.shift_id, tbl_shifts.assigned, tbl_shifts.shift_date, tbl_shifts.datetime, tbl_shifts.close_user_id, tbl_shifts.status, tbl_shifts_names.name as shift_name, tbl_users.name as username');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_shifts.close_user_id', 'left');
        $this->db->where('tbl_shifts.status !=', 0);
        return $this->db->get('tbl_shifts');
    }

//Shifts List of Open Shifts
    function get_list_open_shifts() {
        $this->db->order_by('shift_id', 'asc');
        $this->db->select('tbl_shifts.shift_id, tbl_shifts.assigned, tbl_shifts.shift_date, tbl_shifts.close_user_id, tbl_shifts.status, tbl_shifts_names.name as shift_name, tbl_users.name as username');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_shifts.close_user_id', 'left');
        $this->db->where('tbl_shifts.status', 0);
        return $this->db->get('tbl_shifts');
    }

//Used to open a shift
//Count number of Open Shifts; Open Shifts have status 0
    function count_open_shifts() {
        $this->db->where('tbl_shifts.status', 0);
        $query = $this->db->get('tbl_shifts');
        return $query->num_rows();
    }

//Get the last date
    function getLastDate_open_shifts() {
        $this->db->order_by('tbl_shifts.shift_id', 'desc');
        $this->db->where('tbl_shifts.mini_shift <', 1);
        $query = $this->db->get('tbl_shifts');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else
            return null;
    }

//Count number of shifts with that date
    function countDays_open_shifts($date) {
        $this->db->where('tbl_shifts.shift_date', $date);
        $this->db->where('tbl_shifts.mini_shift <', 1);
        $query = $this->db->get('tbl_shifts');
        return $query->num_rows();
    }

//Get current shift and allocate employees to shifts
    function get_first_open_shift() {
        $this->db->order_by('shift_id', 'asc');
        $this->db->select('tbl_shifts.shift_id, tbl_shifts.shift_name_id, tbl_shifts.shift_date, tbl_shifts.close_user_id, tbl_shifts.status, tbl_shifts_names.name as shift_name, tbl_shifts.assigned, tbl_shifts.var_ltrs_status, reading');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->where('tbl_shifts.status', 0);
        $query = $this->db->get('tbl_shifts');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else
            return null;
    }

    function get_invoice_shift($date) {
        $this->db->select('tbl_shifts.shift_id, tbl_shifts.shift_date');
        $from_date = "DATE(tbl_shifts.shift_date) = '" . date("Y-m-d", strtotime($date)) . "'";
        $this->db->where($from_date);
        $this->db->where('tbl_shifts.shift_name_id =', 1);
        $query = $this->db->get('tbl_shifts');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else
            return null;
    }

    function get_ShiftByID($inv_date, $shift) {
        $this->db->select('tbl_shifts.shift_id, tbl_shifts.shift_date');
        $from_date = "DATE(tbl_shifts.shift_date) = '" . date("Y-m-d", strtotime($inv_date)) . "'";
        $this->db->where($from_date);
        $this->db->where('tbl_shifts.shift_name_id =', $shift);
        $query = $this->db->get('tbl_shifts');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else
            return null;
    }

//Get Next Open shift and allocate employees to shifts
    function get_second_open_shift() {
        $this->db->order_by('shift_id', 'asc');
        $this->db->select('tbl_shifts.shift_id, tbl_shifts.assigned, tbl_shifts.shift_date, tbl_shifts.close_user_id, tbl_shifts.status, tbl_shifts_names.name as shift_name, tbl_shifts.assigned');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->where('tbl_shifts.status', 0);
        $this->db->where('tbl_shifts.assigned', 0);
        $query = $this->db->get('tbl_shifts');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else
            return null;
    }

//Calculate amount per Centre
    function amount_per_centre($shift_id) {
        $this->db->order_by('tbl_centres.centre_name', 'asc');
        $this->db->select('tbl_users.user_id, tbl_users.name, tbl_assigned_centres.shift_id as shift_id, tbl_assigned_centres.centre_id, tbl_centres.centre_name, tbl_centres.centre_type_id, tbl_centre_type.name as centre_type, tbl_centres.lubes_type, tbl_centres.fuel_centre');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_assigned_centres.centre_id', 'left');
        $this->db->join('tbl_centre_type', 'tbl_centre_type.centre_type_id = tbl_centres.centre_type_id', 'left');
        $this->db->where('tbl_assigned_centres.shift_id', $shift_id)->group_by('tbl_centres.centre_id');

        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Sales in close shift fuels with centre id
    function sum_sales_centre($store_id, $shift_id) {
        $this->db->select('SUM(tbl_close_shift_fuels.opening_electronic_meter_reading) as total_meter, SUM(tbl_close_shift_fuels.opening_manual_meter_reading) as total_manual,
			SUM(tbl_close_shift_fuels.closing_electronic_meter_reading) as closing_meter, SUM(tbl_close_shift_fuels.closing_manual_meter_reading) as closing_manual, tbl_pumps.store_id');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left');
        $this->db->where('store_id', $store_id);
        $this->db->where('tbl_close_shift_fuels.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_fuels');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Calculate Sales per Centre - Metered/ Pumps
    function sales_per_centre($centre_id, $shift_id) {
        $this->db->select('tbl_close_shift_fuels.centre_id, tbl_close_shift_fuels.pump_id, tbl_close_shift_fuels.sales_elec_cash, tbl_close_shift_fuels.sales_elec_meter, tbl_close_shift_fuels.sales_manual_cash, tbl_close_shift_fuels.sales_manual_meter');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_assigned_centres.centre_id', 'left');
        $this->db->join('tbl_close_shift_fuels', 'tbl_close_shift_fuels.centre_id = tbl_centres.centre_id', 'left');
        $this->db->where('tbl_close_shift_fuels.centre_id', $centre_id);
        $this->db->where('tbl_close_shift_fuels.shift_id', $shift_id);
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Calculate Sales per Centre - Lubes
    function sales_per_centre_lubes($centre_id, $shift_id) {
        //$this->db->select('tbl_close_shift_lubes');
        $this->db->select('tbl_products.category_id, SUM(tbl_close_shift_lubes.sales_qty * tbl_close_shift_lubes.price) as total_sales_amount_lubes');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_close_shift_lubes.centre_id', 'left');
        $this->db->join('tbl_centre_type', 'tbl_centre_type.centre_type_id = tbl_centres.centre_type_id', 'left');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_lubes.item_id', 'left');
        $this->db->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left');
        $this->db->where('tbl_close_shift_lubes.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_lubes');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Calculate Sales per Centre - Products
    function sales_per_centre_products($centre_id, $shift_id) {
        $this->db->select('tbl_products.category_id, SUM(tbl_close_shift_products.cash_sales_amount) as total_sales_amount_products');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_close_shift_products.centre_id', 'left');
        $this->db->join('tbl_centre_type', 'tbl_centre_type.centre_type_id = tbl_centres.centre_type_id', 'left');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_products.item_id', 'left');
        $this->db->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left');
        $this->db->where('tbl_products.centre_id', $centre_id);
        $this->db->where('tbl_close_shift_products.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_products');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Fuel Credit Items on Closing Shift // Should be on allocated centres
    function sum_sale_items_fuel($centre_id, $shift_id) {
        $this->db->order_by('sales_product_id', 'desc');
        $this->db->select('tbl_items.item_id, tbl_items.item_name, SUM(tbl_sales_items.total),tbl_centres.centre_id, tbl_pumps.pump_id');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id', 'left');
        $this->db->join('tbl_pumps', 'tbl_pumps.fuel_product_id = tbl_items.item_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_pumps.centre_id', 'left');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left');
        //$this->db->where('tbl_sales_items.centre_id', $centre_id);
        $this->db->where('tbl_sales.shift_id', $shift_id);
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Save Shifts
    function saveShifts($admin) {
        $this->db->insert('tbl_shifts', $admin);
        return $this->db->insert_id();
    }

//Update Shifts
    function updateShifts($id, $user) {
        $this->db->where('shift_id', $id);
        $this->db->update('tbl_shifts', $user);
    }

    function get_by_id($id) {
        $this->db->where('shift_id', $id);
        $this->db->select('tbl_shifts.*, tbl_shifts_names.name as shift_name');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        return $this->db->get('tbl_shifts');
    }

    function get_shift_data($id) {
        $this->db->where('shift_id', $id);
        $this->db->select('tbl_shifts.*, tbl_shifts_names.name as shift_name, tbl_users.name as user');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                ->join('tbl_users', 'tbl_users.user_id = tbl_shifts.close_user_id', 'left');
        return $this->db->get('tbl_shifts')->result_array();
    }

    function get_dippings_error($shift_id) {
        $svar = 'dippings - (previous_dippings + reciepts - sales)';
        $this->db->where('shift_id', $shift_id)
                ->group_start()
                ->where($svar . '<=', '-500')
                ->or_where($svar . '>=', '500')
                ->group_end();
        $this->db->select('dippings - (previous_dippings + reciepts - sales) as bbf, tbl_stores.store_name as store');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_close_shift_dippings.store_id', 'left');
        return $this->db->get('tbl_close_shift_dippings')->result_array();
    }

    function get_meters_error($shift_id) {
        $this->db->where('shift_id', $shift_id)
                ->group_start()
                ->where('(sales_elec_meter - sales_manual_meter) <=', '-5')
                ->or_where('(sales_elec_meter - sales_manual_meter) >=', '5')
                ->group_end();
        $this->db->select('tbl_pumps.name');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left');
        return $this->db->get('tbl_close_shift_fuels')->result_array();
    }

    function update($id, $user) {
        $this->db->where('item_id', $id);
        $this->db->update('tbl_shift', $user);
    }

    function saveRecord($user, $tbl) {
        $this->db->insert($tbl, $user);
        return $this->db->insert_id();
    }

    function updateRecord($id, $user, $tbl, $record) {
        $this->db->where($record, $id);
        $this->db->update($tbl, $user);
    }

    /* function saveShiftName($admin){
      $this->db->insert('tbl_shifts_names', $admin);
      return $this->db->insert_id();
      } */

//Check if Shift Name exists
    function shift_name_exists($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('tbl_shifts_names');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Delete Shift	
    function deleteShift($id, $status) {
        $this->db->where('shift_name_id', $id);
        $this->db->update('tbl_shifts_names', $status);
    }

    function deleteDrops($shift) {
        $this->db->where('shift_id', $shift);
        $this->db->delete('tbl_close_shift_drops');       
    }

    function deleteDropsDebitUser($shift) {
        $this->db->where('shift_id', $shift);
        $this->db->where('figure =', 0);
        $this->db->delete('tbl_close_shift_debit_user');
    }
    function deleteDropsAdj($shift){
        $this->db->where('shift_id', $shift);
        $this->db->delete('tbl_close_shift_adjust_amt');
    }

}

?>