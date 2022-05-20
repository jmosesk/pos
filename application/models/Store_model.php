<?php

class Store_model extends CI_Model {

    private $tbl_user = 'tbl_stores';

    function __construct() {
        parent::__construct();
    }

    function list_all() {
        $this->db->order_by('grid_id', 'asc');
        return $this->db->get('tbl_grids');
    }

//Get List of All Stores
    function get_list_stores() {
        $this->db->order_by('tbl_stores.store_name', 'asc');
        return $this->db->get('tbl_stores');
    }

//Get List of Non Fuel Stores
    function get_list_NonFuel_stores() {
        $this->db->order_by('tbl_stores.store_name', 'asc');
        $this->db->where('tbl_stores.store_type_id', 2);
        $this->db->where('tbl_stores.deleted', 0);
        return $this->db->get('tbl_stores');
    }

//List of all Fuel Stores
    function get_list_fuel_stores() {
        $this->db->order_by('tbl_stores.store_name', 'asc');
        $this->db->select('tbl_stores.store_id as store_id, tbl_stores.store_name, tbl_stores.store_type_id, tbl_stores.description,
		 	tbl_stores.date_created, tbl_stores.active_status, tbl_fuel_stores.last_dipping, tbl_fuel_stores.capacity, tbl_fuel_stores.previous_bcf,
		 	tbl_items.item_name, tbl_fuel_stores.fuel_store_id as fuel_store_id, tbl_fuel_stores.item_id');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_fuel_stores.store_id', 'left');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_fuel_stores.item_id', 'left');
        $this->db->join('tbl_store_type', 'tbl_store_type.type_id = tbl_stores.store_type_id', 'left');
        $this->db->where('tbl_stores.deleted', 0)->where('tbl_stores.active_status', 1);
        return $this->db->get('tbl_fuel_stores');
    }

//List of all Fuel Stores used for dippings
    function get_list_fuel_stores_dippings() {
        $this->db->order_by('tbl_stores.store_name', 'asc');
        $this->db->select('tbl_stores.store_id as store_id, tbl_stores.store_name, tbl_stores.store_type_id, tbl_stores.active_status, tbl_fuel_stores.previous_bcf, tbl_fuel_stores.last_dipping, tbl_fuel_stores.capacity, tbl_items.item_name, tbl_fuel_stores.fuel_store_id as fuel_store_id');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_fuel_stores.store_id', 'left');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_fuel_stores.item_id', 'left');
        $this->db->join('tbl_store_type', 'tbl_store_type.type_id = tbl_stores.store_type_id', 'left')
                ->where('tbl_stores.active_status', 1)
                ->where('tbl_stores.deleted', 0);
        return $this->db->get('tbl_fuel_stores');
    }

//List of all Fuel Stores used for dippings to edit Dippings
    function get_list_fuel_stores_Editdippings($shift_id) {
        $this->db->order_by('tbl_stores.store_name', 'asc');
        $this->db->select('tbl_shifts.shift_date, tbl_stores.store_id as store_id, tbl_stores.store_name, tbl_stores.active_status, tbl_close_shift_dippings.previous_dippings, tbl_close_shift_dippings.bbf,  tbl_close_shift_dippings.dippings, 
			tbl_close_shift_dippings.close_shift_id, tbl_close_shift_dippings.bcf, tbl_close_shift_dippings.reciepts, tbl_close_shift_dippings.sales,
			tbl_fuel_stores.previous_bcf, tbl_fuel_stores.last_dipping, tbl_fuel_stores.capacity, tbl_stores.store_type_id, 
			tbl_items.item_name, tbl_fuel_stores.fuel_store_id as fuel_store_id');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_fuel_stores.store_id', 'left');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_fuel_stores.item_id', 'left');
        $this->db->join('tbl_close_shift_dippings', 'tbl_close_shift_dippings.store_id = tbl_stores.store_id', 'left')->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_dippings.shift_id');
        $this->db->where('tbl_close_shift_dippings.shift_id', $shift_id);
        $query = $this->db->get('tbl_fuel_stores');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//List of all allocated Fuel Stores
    function get_list_allocatedfuel_pumps($id) {
        $this->db->select('tbl_centres.centre_name, tbl_centres.centre_id, tbl_pumps.pump_id, tbl_pumps.name as pump_name, tbl_assigned_centres.shift_id, 
			tbl_pumps.electronic_cash_reading, tbl_pumps.electronic_meter_reading, tbl_pumps.manual_meter_reading');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_assigned_centres.centre_id', 'left');
        $this->db->join('tbl_pumps', 'tbl_pumps.centre_id = tbl_centres.centre_id', 'left');
        $this->db->where('tbl_pumps.name !=', null);
        $this->db->where('tbl_pumps.status ', 1);
        $this->db->where('tbl_assigned_centres.shift_id', $id);
        return $this->db->get('tbl_assigned_centres');
    }

//Save Close Shift Fuels
    function saveCloseMeterReading($admin) {
        $this->db->insert('tbl_close_shift_fuels', $admin);
        return $this->db->insert_id();
    }

//Update Close Shift Dippings
    function updateCloseDippings($id, $user) {
        $this->db->where('close_shift_id', $id);
        $this->db->update('tbl_close_shift_dippings', $user);
    }

//Save Close Shift Lubes
    function saveCloseLubes($admin) {
        $this->db->insert('tbl_close_shift_lubes', $admin);
        return $this->db->insert_id();
    }

//Update Close Shift Lubes
    function updateCloseLubes($id, $user) {
        $this->db->where('close_shift_id', $id);
        $this->db->update('tbl_close_shift_lubes', $user);
    }

//Save Close Shift Other Products
    function saveCloseOtherProducts($admin) {
        $this->db->insert('tbl_close_shift_products', $admin);
        return $this->db->insert_id();
    }

//Update Close Shift Other Products
    function updateCloseOtherProducts($id, $user) {
        $this->db->where('close_shift_id', $id);
        $this->db->update('tbl_close_shift_products', $user);
    }

//List of Close Lubes so as to edit the values
    function get_list_CloseLubes($shift_id) {
        //Select item name then link with close shift lubes
        $this->db->select('tbl_close_shift_lubes.*, tbl_items.item_name, SUM((tbl_close_shift_lubes.opening_quantity + tbl_close_shift_lubes.receipts - tbl_close_shift_lubes.closing_quantity)) as total_qty, SUM((tbl_close_shift_lubes.opening_quantity + tbl_close_shift_lubes.receipts - tbl_close_shift_lubes.closing_quantity) * tbl_close_shift_lubes.price) as total_sales_amt_lubes');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_lubes.item_id', 'left')
                ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id')->where('tbl_products.category_id', 1);
        $this->db->where('tbl_close_shift_lubes.shift_id', $shift_id)->group_by('tbl_items.item_id');
        $query = $this->db->get('tbl_close_shift_lubes');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//List of Meter Readings so as to edit the values
    function get_list_MeterReadings($id) {
        $this->db->select('tbl_pumps.centre_id, tbl_users.name as username, tbl_pumps.pump_id, tbl_pumps.name as pump_name, tbl_close_shift_fuels.shift_id, tbl_close_shift_fuels.close_shift_fuel_id, 
			tbl_close_shift_fuels.opening_electronic_cash_reading, tbl_close_shift_fuels.opening_electronic_meter_reading, tbl_close_shift_fuels.opening_manual_meter_reading,
			tbl_close_shift_fuels.closing_electronic_cash_reading, tbl_close_shift_fuels.closing_electronic_meter_reading, tbl_close_shift_fuels.closing_manual_meter_reading,
			tbl_close_shift_fuels.rtt, tbl_close_shift_fuels.sales_elec_cash, tbl_close_shift_fuels.sales_elec_meter, tbl_close_shift_fuels.sales_manual_meter, tbl_items.item_id, (tbl_close_shift_fuels.sales_elec_cash / tbl_close_shift_fuels.unit_price) as amnt_cash_elec,
			tbl_items.unit_price as price');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_close_shift_fuels.employee_id', 'left');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'left');
        $this->db->where('tbl_pumps.status ', 1);
        $this->db->where('tbl_close_shift_fuels.shift_id', $id);
        $query = $this->db->get('tbl_close_shift_fuels');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get Sales per Store
    function sales_store_dippings($id) {
        $this->db->select('tbl_pumps.store_id, (tbl_close_shift_fuels.sales_elec_meter) as sales_elec_meter, (tbl_close_shift_fuels.sales_manual_meter) as sales_manual_meter, (tbl_close_shift_fuels.sales_elec_cash / unit_price) as amnt_cash_elec, tbl_close_shift_fuels.rtt');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left');
        $this->db->where('tbl_pumps.status ', 1);
        $this->db->where('tbl_close_shift_fuels.shift_id', $id);
        $query = $this->db->get('tbl_close_shift_fuels')->result_array();
        return $query;
    }

//Get Sales per Store Group
    function Sales_store_group($id) {
        $this->db->select('tbl_pumps.store_id, (tbl_close_shift_fuels.sales_elec_meter) as sales_elec_meter, (tbl_close_shift_fuels.sales_manual_meter) as sales_manual_meter, (tbl_close_shift_fuels.sales_elec_cash/(tbl_close_shift_fuels.unit_price)) as amnt_cash_elec, tbl_close_shift_fuels.rtt, tbl_items.item_name');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left')
                ->join('tbl_fuel_products', 'tbl_fuel_products.product_id = tbl_pumps.fuel_product_id', 'left')
                ->join('tbl_items', 'tbl_items.item_id = tbl_fuel_products.item_id', 'left');
        $this->db->where('tbl_close_shift_fuels.shift_id', $id)
                    ->group_by('tbl_pumps.store_id');
        $query = $this->db->get('tbl_close_shift_fuels')->result_array();
        return $query;
    }

//Get Sales per Allocated User
    function sales_employee_fuel($id) {
        $this->db->select('tbl_assigned_centres.employee_id, (tbl_close_shift_fuels.sales_elec_cash), (tbl_close_shift_fuels.sales_manual_cash), (tbl_close_shift_fuels.sales_elec_meter * unit_price) as sales_elec_meter, tbl_close_shift_fuels.rtt, unit_price');
        $this->db->join('tbl_close_shift_fuels', 'tbl_close_shift_fuels.centre_id = tbl_assigned_centres.centre_id', 'left')
                ->where('tbl_close_shift_fuels.shift_id', $id)
                ->where('tbl_assigned_centres.shift_id', $id);
        $query = $this->db->get('tbl_assigned_centres')->result_array();
        return $query;
    }

//Get if closed readings
    function get_readings_values($shift_id) {
        $meter_query = $this->db->select('tbl_close_shift_fuels.shift_id')
                    ->where('tbl_close_shift_fuels.shift_id', $shift_id)
                    ->limit(1)
                    ->get('tbl_close_shift_fuels');
        if ($meter_query->num_rows() > 0) {
            $meter_array = $meter_query->result()[0]->shift_id;
        } else {
            $meter_array = null;
        }
        $dippings_query = $this->db->select('tbl_close_shift_dippings.shift_id')
                    ->where('tbl_close_shift_dippings.shift_id', $shift_id)
                    ->limit(1)
                    ->get('tbl_close_shift_dippings');
        if ($dippings_query->num_rows() > 0) {
            $dippings_array = $dippings_query->result()[0]->shift_id;
        } else {
            $dippings_array = null;
        }
        $lubes_query = $this->db->select('tbl_close_shift_lubes.shift_id')
                    ->where('tbl_close_shift_lubes.shift_id', $shift_id)
                    ->limit(1)
                    ->get('tbl_close_shift_lubes');
        if ($lubes_query->num_rows() > 0) {
            $lubes_array = $lubes_query->result()[0]->shift_id;
        } else {
            $lubes_array = null;
        }
        $products_query = $this->db->select('tbl_close_shift_products.shift_id')
                    ->where('tbl_close_shift_products.shift_id', $shift_id)
                    ->limit(1)
                    ->get('tbl_close_shift_products');
        if ($products_query->num_rows() > 0) {
            $products_array = $products_query->result()[0]->shift_id;
        } else {
            $products_array = null;
        }
        $drops_query = $this->db->select('tbl_close_shift_drops.shift_id')
                    ->where('tbl_close_shift_drops.shift_id', $shift_id)
                    ->limit(1)
                    ->get('tbl_close_shift_drops');
        if ($drops_query->num_rows() > 0) {
            $drops_array = $drops_query->result()[0]->shift_id;
        } else {
            $drops_array = null;
        }

        return array('meter' => $meter_array, 'dippings' => $dippings_array, 'lubes' => $lubes_array, 'products' => $products_array, 'drops' => $drops_array);
    }

//Update Meter Readings	
    function updateCloseMeterReading($id, $user) {
        $this->db->where('close_shift_fuel_id', $id);
        $this->db->update('tbl_close_shift_fuels', $user);
    }

//Get Values Close Shift Fuels
    function get_listCloseMeterReading($shift_id) {
        $this->db->select('tbl_close_shift_fuels.*, tbl_pumps.store_id');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left');
        $this->db->where('tbl_close_shift_fuels.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_fuels');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get Values Close Shift Dippings
    function get_list_PreviousDippings($store_id) {
        $this->db->order_by('tbl_close_shift_dippings.close_shift_id', 'desc');
        $this->db->where('tbl_close_shift_dippings.store_id', $store_id);
        $query = $this->db->get('tbl_close_shift_dippings');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

//Get Values Close Shift Dippings not for current shift
    function get_list_PreviousShiftDippings($store_id, $shift_id) {
        $this->db->order_by('tbl_close_shift_dippings.close_shift_id', 'desc');
        $this->db->where('tbl_close_shift_dippings.store_id', $store_id)
                ->where('tbl_close_shift_dippings.shift_id !=', $shift_id);
        $query = $this->db->get('tbl_close_shift_dippings');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

//Get Values Current Close Shift Dippings
    function get_list_CurrentShiftDippings($store_id, $shift_id) {
        $this->db->order_by('tbl_close_shift_dippings.close_shift_id', 'desc');
        $this->db->where('tbl_close_shift_dippings.store_id', $store_id)
                ->where('tbl_close_shift_dippings.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_dippings');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

//Get List Dippings
    function get_list_Dippings() {
        $this->db->order_by('tbl_close_shift_dippings.close_shift_id', 'desc');
        $query = $this->db->get('tbl_close_shift_dippings');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get Values Close Shift Dippings
    function get_listCloseDippingsReading($shift_id) {
        $this->db->where('tbl_close_shift_dippings.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_dippings');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get Values Close Shift Lubes
    function get_listCloseLubesReading($shift_id) {
        $this->db->where('tbl_close_shift_lubes.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_lubes');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get Values Close Shift Lubes Item
    function get_listCloseLubesReadingItem($shift_id, $item_id) {
        $this->db->where('tbl_close_shift_lubes.shift_id', $shift_id)->where('tbl_close_shift_lubes.item_id', $item_id);
        $query = $this->db->get('tbl_close_shift_lubes');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//List of Close Other products Readings so as to edit the values
    function get_list_CloseProducts($shift_id) {
        //Select item name then link with close shift lubes
        $this->db->select('tbl_close_shift_products.*, tbl_items.item_name');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_products.item_id', 'left');
        $this->db->where('tbl_close_shift_products.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_products');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//List of Close Other Products Readings Per Item
    function get_list_CloseProductsItem($shift_id, $item_id) {
        $this->db->where('tbl_close_shift_products.shift_id', $shift_id)->where('tbl_close_shift_products.item_id', $item_id);
        $query = $this->db->get('tbl_close_shift_products');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get Values Close Shift Products
    function get_listCloseProductsReading($shift_id) {
        $this->db->order_by('item_id', 'asc');
        $this->db->select('tbl_close_shift_products.*, tbl_items.item_name');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_products.item_id', 'left');
        $this->db->where('tbl_close_shift_products.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_products');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get Values Close Shift Drops
    function get_listCloseDropsReading($shift_id) {
        $this->db->select('tbl_close_shift_drops.*, tbl_users.name as name');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_close_shift_drops.user_id', 'left');
        $this->db->where('tbl_close_shift_drops.shift_id', $shift_id);
        $this->db->group_by('tbl_close_shift_drops.user_id');
        $query = $this->db->get('tbl_close_shift_drops');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get Values Close Shift Drops
    function get_listCloseDropsDetails($shift_id) {
        $this->db->order_by('centre_name', 'asc');
        $this->db->select('tbl_close_shift_drops.amount, tbl_close_shift_drops.user_id,  tbl_users.name as name, tbl_close_shift_drops.centre_id, tbl_centres.centre_name, tbl_centres.centre_type_id, tbl_centre_type.name as centre_type, tbl_centres.lubes_type, tbl_centres.fuel_centre, tbl_employee_excess.amount as excess, tbl_close_shift_drops.close_shift_drops_id');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_close_shift_drops.user_id', 'left')
                ->join('tbl_transactions', 'tbl_transactions.shift_id = tbl_close_shift_drops.shift_id', 'left outer');
        $this->db->join('tbl_employee_excess', 'tbl_employee_excess.transaction_id = tbl_transactions.transaction_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_close_shift_drops.centre_id', 'left');
        $this->db->join('tbl_centre_type', 'tbl_centre_type.centre_type_id = tbl_centres.centre_type_id', 'left');
        $this->db->where('tbl_close_shift_drops.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_drops');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }


//Get Values Close Shift Drops
    function get_listCloseDropsList($shift_id) {
        $this->db->order_by('centre_name', 'asc');
        $this->db->select('DATE_FORMAT(datetime, "%D, %b %Y") as shift_date, tbl_close_shift_drops.excess, tbl_users.name as name, tbl_centres.centre_name');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_close_shift_drops.user_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_close_shift_drops.centre_id', 'left');
        $this->db->where('tbl_close_shift_drops.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_drops');
        if($query->num_rows() > 0){
            return $query->result();
        } else {
            return null;
        }
        /*if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }*/
    }

//Get Values Close Shift Drops - User
    function get_UserCloseDropsDetails($close_shift_id = null) {
        $this->db->select('tbl_close_shift_drops.amount as cash_dropped, tbl_employee_excess.amount as excess, tbl_close_shift_drops.user_id,  tbl_users.name as name, tbl_close_shift_drops.close_shift_drops_id as close_shift_id');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_close_shift_drops.user_id', 'left');
        $this->db->join('tbl_employee_excess', 'tbl_employee_excess.employee_id = tbl_close_shift_drops.user_id', 'left');
        $this->db->where('tbl_close_shift_drops.close_shift_drops_id', $close_shift_id);
        $query = $this->db->get('tbl_close_shift_drops');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get Values Close Shift Drops for a user - Used in Shortages
    function get_userCloseDropsReading($shift_id, $user_id) {
        $this->db->select('tbl_close_shift_drops.*, tbl_users.name as name');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_close_shift_drops.user_id', 'left');
        $this->db->where('tbl_close_shift_drops.shift_id', $shift_id);
        $this->db->where('tbl_close_shift_drops.user_id', $user_id);
        $query = $this->db->get('tbl_close_shift_drops');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

//Sum Drops per employee per shift
    function sum_drops($shift_id, $user_id) {
        $this->db->select('SUM(tbl_close_shift_drops.amount) as new_amount, SUM(tbl_close_shift_drops.expected_amount) as new_expected_amount,
						SUM(tbl_close_shift_drops.variance) as new_variance, tbl_close_shift_drops.user_id as user, tbl_users.name as name');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_close_shift_drops.user_id', 'left');
        $this->db->where('tbl_close_shift_drops.shift_id', $shift_id);
        $this->db->where('tbl_close_shift_drops.user_id', $user_id);
        $query = $this->db->get('tbl_close_shift_drops');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Drops to close Shift
    function sum_all_drops($shift_id) {
        $this->db->select('SUM(tbl_close_shift_drops.amount) as new_amount, SUM(tbl_close_shift_drops.expected_amount) as new_expected_amount,
						SUM(tbl_close_shift_drops.variance) as new_variance');
        $this->db->where('tbl_close_shift_drops.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_drops');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Sales in close shift fuels with tank id
    function sum_sales($store_id, $shift_id) {
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

//Sum Sales in close shift fuels
    function sum_sales_fuel($shift_id) {
        $this->db->select('SUM((tbl_close_shift_fuels.closing_electronic_meter_reading) - (tbl_close_shift_fuels.opening_electronic_meter_reading)) as total_sales, tbl_pumps.store_id');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_pumps.store_id', 'left outer');
        $this->db->where('tbl_close_shift_fuels.shift_id', $shift_id);
        $this->db->group_by('store_id');
        $query = $this->db->get('tbl_close_shift_fuels');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Recieving Fuels in close shift fuels
    function fuel_purchase($store_id, $shift_id) {
        $this->db->select('SUM(tbl_recieving_items_fuel.recieving_quantity) as rec');
        $this->db->join('tbl_receivings', 'tbl_receivings.receiving_id = tbl_recieving_items_fuel.recieving_id', 'left');
        $this->db->where('tbl_recieving_items_fuel.store_id', $store_id);
        $this->db->where('tbl_receivings.shift_id', $shift_id);
        $query = $this->db->get('tbl_recieving_items_fuel');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Recieving Fuels in close shift fuels - Purchases plus reciepts
    function tank_transfers($store_id, $shift_id) {
        $this->db->select('SUM(IF((tbl_stock_transfers.transfer_type = "Tank to Tank" AND tbl_stock_transfers.dispatch_store_id = ' . $store_id . '), tbl_stock_transfers_items.quantity,0)) as dispatch_quantity, SUM(IF((tbl_stock_transfers.transfer_type = "Tank to Tank" AND tbl_stock_transfers.recieving_store_id = ' . $store_id . '), tbl_stock_transfers_items.quantity,0)) as recieving_quantity, ');
        $this->db->join('tbl_stock_transfers', 'tbl_stock_transfers.transfer_id = tbl_stock_transfers_items.stock_transfer_id', 'left');
        //$this->db->where('tbl_recieving_items_fuel.store_id', $store_id);
        $this->db->where('tbl_stock_transfers.shift_id', $shift_id);
        $query = $this->db->get('tbl_stock_transfers_items');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

//Sum Purchases in close shift lubes and other products
    function SumPurchases($shift_id) {
        $this->db->select('SUM(IF(tbl_receivings.shift_id = ' . $shift_id . ', tbl_recieving_items.recieving_quantity,0)) as purchased_qty, tbl_recieving_items.item_id');
        $this->db->join('tbl_receivings', 'tbl_receivings.receiving_id = tbl_recieving_items.recieving_id', 'left');
        $this->db->where('tbl_receivings.shift_id', $shift_id)->group_by('tbl_recieving_items.item_id');
        $query = $this->db->get('tbl_recieving_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Transfers in close shift lubes and other products
    function SumTransfers($shift_id) {
        $this->db->select('SUM(IF((tbl_stock_transfers.transfer_type = "Store to Centre" AND tbl_stock_transfers.shift_id = ' . $shift_id . '), tbl_stock_transfers_items.quantity,0)) as transfer_quantity_store_centre, SUM(IF((tbl_stock_transfers.transfer_type = "Centre to Store" AND tbl_stock_transfers.shift_id = ' . $shift_id . '), tbl_stock_transfers_items.quantity,0)) as transfer_quantity_centre_store,
			tbl_stock_transfers_items.item_id');
        $this->db->join('tbl_stock_transfers', 'tbl_stock_transfers.transfer_id = tbl_stock_transfers_items.stock_transfer_id', 'left');
        $this->db->where('tbl_stock_transfers.shift_id', $shift_id)->group_by('tbl_stock_transfers_items.item_id');
        $query = $this->db->get('tbl_stock_transfers_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Transfers in close shift lubes and other products
    function sum_stock_transfers($item_id, $shift_id) {
        $this->db->select('SUM(IF(tbl_stock_transfers.transfer_type = "Store to Centre", tbl_stock_transfers_items.quantity,0)) as transfer_quantity_store_centre, SUM(IF(tbl_stock_transfers.transfer_type = "Centre to Store", tbl_stock_transfers_items.quantity,0)) as transfer_quantity_centre_store');
        $this->db->join('tbl_stock_transfers', 'tbl_stock_transfers.transfer_id = tbl_stock_transfers_items.stock_transfer_id', 'left');
        $this->db->where('item_id', $item_id);
        $this->db->where('tbl_stock_transfers.shift_id', $shift_id);
        $query = $this->db->get('tbl_stock_transfers_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Recievings
    function sum_reciepts($item_id, $shift_id) {
        $this->db->select('SUM(tbl_recieving_items.recieving_quantity) as recieving_quantity');
        $this->db->join('tbl_receivings', 'tbl_receivings.receiving_id = tbl_recieving_items.recieving_id', 'left')
                ->join('tbl_items', 'tbl_items.item_id = tbl_recieving_items.item_id', 'left')
                ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left');
        $this->db->where('tbl_recieving_items.item_id', $item_id);
        $this->db->where('tbl_products.recieve_forecourt', 1);
        $this->db->where('tbl_receivings.shift_id', $shift_id);
        $query = $this->db->get('tbl_recieving_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Items bought on Credit in close shift fuels
    function sum_credit_qty($item_id, $shift_id) {
        $this->db->select('SUM(tbl_sales_items.quantity_sold) as quantity_sold, SUM(tbl_sales_items.total) as total_sold');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left');
        $this->db->where('item_id', $item_id);
        $this->db->where('tbl_sales.shift_id', $shift_id);
        $this->db->where('tbl_sales.payment_type !=', "Cash");
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Items purchased on Credit per pump
    function sum_credit_sales_pump($pump_id, $shift_id) {
        $this->db->select('SUM(tbl_sales_items.quantity_sold) as quantity_sold, SUM(tbl_sales_items.total) as total_sold');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left');
        $this->db->where('pump_id', $pump_id);
        $this->db->where('tbl_sales.shift_id', $shift_id);
        $this->db->where('tbl_sales.payment_type !=', "Cash");
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Items purchased on Credit per Centre
    function sum_credit_sales_centre($centre_id, $shift_id) {
        $condition = "(tbl_sales.shift_id = '$shift_id' AND tbl_sales.payment_type != 'Cash' AND (tbl_pumps.centre_id = '$centre_id' OR tbl_products.centre_id = '$centre_id'))";
        $this->db->select('SUM(tbl_sales_items.quantity_sold) as quantity_sold, SUM(tbl_sales_items.total) as total_sold');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left')
                ->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id', 'left')
                ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left')
                ->join('tbl_fuel_products', 'tbl_fuel_products.item_id = tbl_items.item_id', 'left')
                ->join('tbl_pumps', 'tbl_pumps.fuel_product_id = tbl_fuel_products.product_id', 'left');
        $this->db->where($condition);
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    function GetAssignedCentres($shift_id) {
        $this->db->select('tbl_assigned_centres.shift_id, tbl_assigned_centres.centre_id, tbl_centres.centre_name')
                ->join('tbl_centres', 'tbl_centres.centre_id = tbl_assigned_centres.centre_id')
                ->where('tbl_assigned_centres.shift_id', $shift_id);
        $query = $this->db->get('tbl_assigned_centres');
        if ($query->num_rows() > 0)
            return $query;
        else
            return NULL;
    }

    //Sum Items purchased on Credit per User
    function sum_credit_sales_per_user($shift_id) {
        $condition = "(tbl_sales.shift_id = '$shift_id' AND tbl_sales.payment_type != 'Cash' AND (tbl_assigned_centres.user_id = '$user_id'))";
        $this->db->select('SUM(tbl_sales_items.quantity_sold) as quantity_sold, SUM(tbl_sales_items.total) as total_sold, tbl_users.name');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left')
                ->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id', 'left')
                ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left')
                ->join('tbl_fuel_products', 'tbl_fuel_products.item_id = tbl_items.item_id', 'left')
                ->join('tbl_users')
                ->join('tbl_pumps', 'tbl_pumps.fuel_product_id = tbl_fuel_products.product_id', 'left');
        $this->db->where($condition);
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Sum Items purchased on Credit per User
    function sum_credit_sales_User($shift_id, $user_id) {
        $this->db->select('tbl_users.name, tbl_users.user_id, 
							SUM(IF((tbl_sales.payment_type = "Invoice" AND tbl_assigned_centres.employee_id = ' . $user_id . '), tbl_sales.total_amount, 0)) as total_invoice, 
							SUM(IF((tbl_sales.payment_type = "Credit Card" AND tbl_assigned_centres.employee_id = ' . $user_id . '), tbl_sales.total_amount, 0)) as total_credit_card, 
							SUM(IF((tbl_sales.payment_type = "Mpesa" AND tbl_assigned_centres.employee_id = ' . $user_id . '), tbl_sales.total_amount, 0)) as total_mpesa, 
							SUM(IF((tbl_sales.payment_type = "Fuel Card" AND tbl_assigned_centres.employee_id = ' . $user_id . '), tbl_sales.total_amount, 0)) as total_fuel_card, 
							SUM(IF(tbl_assigned_centres.employee_id = ' . $user_id . ', tbl_sales.total_amount, 0)) as total_credit');
        $this->db->join('tbl_assigned_centres', 'tbl_assigned_centres.shift_id = tbl_sales.shift_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id', 'left');
        //$this->db->where('tbl_assigned_centres.employee_id', $user_id);
        $this->db->where(['tbl_sales.shift_id' => $shift_id,
            'tbl_assigned_centres.employee_id' => $user_id]);
        $this->db->group_by('tbl_assigned_centres.employee_id, sales_id');
        $query = $this->db->get('tbl_sales');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Calculate sum Sales per fuel Centre - Metered/ Pumps using a helper
    function sum_sales_per_fuel_centre($centre_id, $shift_id) {
        $this->db->select('SUM(tbl_close_shift_fuels.sales_elec_cash) as sales_elec_cash, SUM(tbl_close_shift_fuels.sales_elec_meter) as sales_elec_meter,
			SUM(tbl_close_shift_fuels.sales_manual_cash) as sales_manual_cash, SUM(tbl_close_shift_fuels.sales_manual_meter) as sales_manual_meter');
        $this->db->where('tbl_close_shift_fuels.centre_id', $centre_id);
        $this->db->where('tbl_close_shift_fuels.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_fuels');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Items bought on Via Sales
    function sum_total_credit_sales($shift_id) {
        $this->db->select('SUM(tbl_sales_items.quantity_sold) as quantity_sold, SUM(tbl_sales_items.total) as total_sold, tbl_sales.payment_type, tbl_sales_items.item_id');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left');
        $this->db->where('tbl_sales.shift_id', $shift_id);
        $this->db->where('tbl_sales.payment_type !=', "cash");
        $this->db->group_by('tbl_sales_items.item_id');
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Calculate sum Sales per Centre - None Metered/ Pumps
    function sum_sales_per_centre_lubes($shift_id) {
        //$this->db->select('tbl_close_shift_lubes');
        $this->db->select('SUM((tbl_close_shift_lubes.opening_quantity + tbl_close_shift_lubes.receipts - tbl_close_shift_lubes.closing_quantity) *tbl_close_shift_lubes.price) as total_sales_amt, SUM(IF(tbl_stock_transfers.transfer_type = "Store to Centre", tbl_stock_transfers_items.quantity,0)) as transfer_store_centre, SUM(IF(tbl_stock_transfers.transfer_type = "Centre to Store", tbl_stock_transfers_items.quantity,0)) as transfer_centre_store');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_close_shift_lubes.centre_id');
        $this->db->join('tbl_centre_type', 'tbl_centre_type.centre_type_id = tbl_centres.centre_type_id');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_lubes.item_id');
        $this->db->join('tbl_stock_transfers_items', 'tbl_stock_transfers_items.item_id = tbl_items.item_id', 'left');
        $this->db->join('tbl_stock_transfers', 'tbl_stock_transfers.transfer_id = tbl_stock_transfers_items.stock_transfer_id', 'left');
        $this->db->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left');
        $this->db->where('tbl_close_shift_lubes.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_lubes');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Calculate sum Sales per Centre - Other Products
    function sum_sales_per_centre_products($centre_id = null, $shift_id) {
        //$this->db->select('tbl_close_shift_lubes');
        $this->db->select('tbl_products.centre_id, tbl_centres.centre_type_id, SUM((tbl_close_shift_products.opening_quantity + tbl_close_shift_products.receipts - tbl_close_shift_products.closing_quantity) *tbl_close_shift_products.price) as total_sales_amt', false);
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_products.item_id');
        $this->db->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_products.centre_id');
        $this->db->join('tbl_centre_type', 'tbl_centre_type.centre_type_id = tbl_centres.centre_type_id');
        $this->db->where('tbl_close_shift_products.shift_id', $shift_id);
        //$this->db->where('tbl_products.centre_id', $centre_id);
        $this->db->group_by('tbl_products.centre_id');
        $query = $this->db->get('tbl_close_shift_products');
        /*
          'SELECT products.centre_id, SUM((tbl_close_shift_products.opening_quantity + tbl_close_shift_products.receipts - tbl_close_shift_products.closing_quantity) *tbl_close_shift_products.price) as total_sales_amt FROM `tbl_close_shift_products` JOIN `tbl_centres` ON `tbl_centres`.`centre_id` = `tbl_close_shift_products`.`centre_id` JOIN `tbl_centre_type` ON `tbl_centre_type`.`centre_type_id` = `tbl_centres`.`centre_type_id` JOIN `tbl_items` ON `tbl_items`.`item_id` = `tbl_close_shift_products`.`item_id` LEFT JOIN `tbl_products` ON `tbl_products`.`item_id` = `tbl_items`.`item_id` WHERE `tbl_close_shift_products`.`shift_id` = '1' GROUP BY `tbl_products`.`centre_id`' */
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Calculate sum Sales per Centre - Metered/ Pumps
    function sum_sales_per_island($centre_id, $shift_id) {
        $this->db->select('SUM(tbl_close_shift_fuels.sales_elec_cash) as sales_elec_cash, SUM(tbl_close_shift_fuels.sales_elec_meter) as sales_elec_meter,
			SUM(tbl_close_shift_fuels.sales_manual_cash) as sales_manual_cash, SUM(tbl_close_shift_fuels.sales_manual_meter) as sales_manual_meter');
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

//Calculate Total Sales per Item Type - Fuel and Non Fuel
    function sum_total_fuel_sales($shift_id) {
        $this->db->select('SUM(tbl_close_shift_fuels.sales_elec_cash) as sales_elec_cash, SUM((tbl_close_shift_fuels.sales_elec_cash) / unit_price) as calc_sales_elec_cash, SUM(unit_price * (tbl_close_shift_fuels.sales_elec_meter)) as cal_sales_elec_meter, SUM(tbl_close_shift_fuels.sales_elec_meter) as sales_elec_meter,
			SUM(tbl_close_shift_fuels.sales_manual_cash) as sales_manual_cash, SUM(tbl_close_shift_fuels.sales_manual_meter) as sales_manual_meter');
        $this->db->where('tbl_close_shift_fuels.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_fuels');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Calculate Total Credit Sales per Item Type - Fuel and Non Fuel
    function sum_total_credit_fuel_sales($shift_id) {
        $this->db->select('SUM(tbl_sales_items.quantity_sold) as quantity_sold, SUM(tbl_sales_items.total) as total_sold');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left');
        $this->db->where('tbl_sales.shift_id', $shift_id);
        $this->db->where('tbl_sales.payment_type !=', "Cash");
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else
            return null;
    }

//Calculate sum Sales per Item for Fuel
    function sum_sales_item_fuel($item_id, $shift_id) {
        $this->db->select('SUM(tbl_close_shift_fuels.sales_elec_cash) as sales_elec_cash, SUM((tbl_close_shift_fuels.sales_elec_cash) / unit_price) as calc_amt_elec_cash, SUM(tbl_close_shift_fuels.sales_elec_meter) as sales_elec_meter, SUM(unit_price * (tbl_close_shift_fuels.sales_elec_meter)) as cal_sales_elec_meter, SUM(tbl_close_shift_fuels.sales_manual_cash) as sales_manual_cash, SUM(tbl_close_shift_fuels.sales_manual_meter) as sales_manual_meter');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left');
        $this->db->where('tbl_pumps.fuel_product_id', $item_id);
        $this->db->where('tbl_close_shift_fuels.shift_id', $shift_id)->group_by('tbl_close_shift_fuels.pump_id');
        $query = $this->db->get('tbl_close_shift_fuels');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Calculate sum Credit Sales per Item for Fuel
    function sum_credit_sales_item_fuel($item_id, $shift_id) {
        $this->db->select('SUM(tbl_sales_items.sales_elec_cash) as sales_elec_cash, SUM(tbl_close_shift_fuels.sales_elec_meter) as sales_elec_meter,
			SUM(tbl_close_shift_fuels.sales_manual_cash) as sales_manual_cash, SUM(tbl_close_shift_fuels.sales_manual_meter) as sales_manual_meter');
        $this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left');
        $this->db->where('tbl_pumps.fuel_product_id', $item_id);
        $this->db->where('tbl_close_shift_fuels.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_fuels');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Calculate sum Sales for drops to add to banking
    function sum_sales_drops_for_banking($shift_id) {
        $this->db->select('SUM(tbl_close_shift_drops.amount) as amount');
        $this->db->where('tbl_close_shift_drops.shift_id', $shift_id);
        $query = $this->db->get('tbl_close_shift_drops');
        if ($query->num_rows() > 0) {
            return $query->result()[0]->amount;
        } else
            return null;
    }

//calculate expenses - unbanked
    function sum_unbanked_expenses($shift_id = null) {
        $this->db->select('SUM(tbl_petty_cash_expenses.total) as expenses')
                ->where('tbl_petty_cash_expenses.shift_id', $shift_id)->where('approved', 1);
        $query = $this->db->get('tbl_petty_cash_expenses')->result_array()[0]['expenses'];
        return $query;
    }

//Calculate sum Excess or Shortage
    function sum_excess_short_for_banking($shift_id) {
        $this->db->select('SUM(tbl_employee_shortage.amount) as short_amount, SUM(tbl_employee_excess.amount) as excess_amount, tbl_transactions.shift_id');
        $this->db->join('tbl_employee_excess', 'tbl_employee_excess.transaction_id = tbl_transactions.transaction_id', 'left');
        $this->db->join('tbl_employee_shortage', 'tbl_employee_shortage.transaction_id = tbl_transactions.transaction_id', 'left');
        $this->db->where('tbl_transactions.shift_id', $shift_id);
        $query = $this->db->get('tbl_transactions');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Sum Items bought on Credit per User
    function total_sum_credit_amount($user_id, $shift_id, $payment_type) {
        $this->db->select('SUM(tbl_sales_items.total) as total_sold, tbl_sales.user_id, tbl_sales.shift_id');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left');
        $this->db->where('tbl_sales.user_id', $user_id);
        $this->db->where('tbl_sales.shift_id', $shift_id);
        $this->db->where('tbl_sales.payment_type ', $payment_type);
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    function get_list_store_types() {
        return $this->db->get('tbl_store_type');
    }

    function count_all() {
        return $this->db->count_all($this->tbl_user);
    }

    function get_paged_list($limit = 10, $offset = 0) {
        $this->db->order_by('id', 'asc');
        return $this->db->get($this->tbl_user, $limit, $offset);
    }

    function get_by_id($id) {
        $this->db->where('store_id', $id);
        return $this->db->get('tbl_stores');
    }

//Get Fuel Store By Fuel_store_ID
    function get_fuel_store_by_id($id) {
        $this->db->select('tbl_stores.store_id as store_id, tbl_stores.store_name, tbl_stores.store_type_id, tbl_stores.description,
		 tbl_stores.date_created, tbl_stores.active_status, tbl_fuel_stores.last_dipping, tbl_fuel_stores.capacity, tbl_items.item_id,
		 tbl_items.item_name, tbl_fuel_stores.item_id, tbl_fuel_stores.fuel_store_id as fuel_store_id');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_fuel_stores.store_id', 'left');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_fuel_stores.item_id', 'left');
        $this->db->join('tbl_store_type', 'tbl_store_type.type_id = tbl_stores.store_type_id', 'left');
        $this->db->where('tbl_stores.store_id', $id);
        return $this->db->get('tbl_fuel_stores');
    }

//Get Fuel Type from Store By Fuel_store_ID
    function get_fuelType_storeID($id) {
        $this->db->select('tbl_items.item_name, tbl_fuel_stores.item_id, tbl_stores.store_id, tbl_stores.store_name, tbl_tax_type.name as tax');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_fuel_stores.store_id', 'left');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_fuel_stores.item_id', 'left')
                ->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left');
        $this->db->where('tbl_stores.store_id', $id);
        $query = $this->db->get('tbl_fuel_stores');
        if ($query->num_rows() > 0) {
            return $query;
        } else
            return null;
    }

//Get Fuel Store By Store_ID
    function get_dippings($id) {
        $this->db->select('tbl_stores.store_id as store_id, tbl_fuel_stores.last_dipping, tbl_fuel_stores.previous_bcf');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_fuel_stores.store_id', 'left');
        $this->db->where('tbl_stores.store_id', $id);
        $query = $this->db->get('tbl_fuel_stores');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Update Store	
    function update($id, $user) {
        $this->db->where('store_id', $id);
        $this->db->update($this->tbl_user, $user);
    }

//Update Fuel Store
    function updateFuelStore($id, $user) {
        $this->db->where('fuel_store_id', $id);
        $this->db->update('tbl_fuel_stores', $user);
    }

//Update Fuel Store using store id
    function updateFuelStoreID($id, $user) {
        $this->db->where('store_id', $id);
        $this->db->update('tbl_fuel_stores', $user);
    }

//Save Store
    function save($admin) {
        $this->db->insert($this->tbl_user, $admin);
        return $this->db->insert_id();
    }

//Save Fuel Stores
    function saveFuelStore($admin) {
        $this->db->insert('tbl_fuel_stores', $admin);
        return $this->db->insert_id();
    }

//Save Close Shift Dippings
    function saveCloseDippings($admin) {
        $this->db->insert('tbl_close_shift_dippings', $admin);
        return $this->db->insert_id();
    }

//Save Close Shift Drops
    function saveCloseDrops($admin) {
        $this->db->insert('tbl_close_shift_drops', $admin);
        return $this->db->insert_id();
    }

//Update Close Shift Drops
    function updateCloseDrops($id, $user) {
        $this->db->where('close_shift_drops_id', $id);
        $this->db->update('tbl_close_shift_drops', $user);
    }

//Check if Store Name exists
    function store_name_exists($store_name) {
        $this->db->where('store_name', $store_name);
        $query = $this->db->get('tbl_stores');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

//Get list of pumps
    function get_list_fuel_pumps() {
        $this->db->order_by('tbl_pumps.name', 'asc');
        $this->db->select('tbl_pumps.pump_id, tbl_pumps.fuel_product_id, tbl_pumps.name as pump_name, tbl_pumps.centre_id,
		tbl_pumps.electronic_cash_reading, tbl_pumps.electronic_meter_reading, tbl_pumps.manual_meter_reading, tbl_pumps.status,
		tbl_centres.centre_name, tbl_stores.store_name, tbl_fuel_products.product_id, tbl_items.item_name');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_pumps.centre_id', 'left');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_pumps.store_id', 'left');
        $this->db->join('tbl_fuel_products', 'tbl_fuel_products.product_id = tbl_pumps.fuel_product_id', 'left');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'left');
        $this->db->where('tbl_pumps.deleted', 0);
        return $this->db->get('tbl_pumps');
    }

//Get list of active pumps
    function get_listActive_fuel_pumps() {
        $this->db->order_by('tbl_pumps.name', 'asc');
        $this->db->select('tbl_pumps.pump_id, tbl_pumps.fuel_product_id, tbl_pumps.name as pump_name, tbl_pumps.centre_id,
		tbl_pumps.electronic_cash_reading, tbl_pumps.electronic_meter_reading, tbl_pumps.manual_meter_reading, tbl_pumps.status,
		tbl_centres.centre_name, tbl_stores.store_name, tbl_fuel_products.product_id, tbl_items.item_name, tbl_items.unit_price as price, tbl_tax_type.value as tax');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_pumps.centre_id', 'left');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_pumps.store_id', 'left');
        $this->db->join('tbl_fuel_products', 'tbl_fuel_products.product_id = tbl_pumps.fuel_product_id', 'left');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'left')
                ->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id');
        $this->db->where('tbl_pumps.deleted', 0);
        $this->db->where('tbl_pumps.status', 1);
        return $this->db->get('tbl_pumps');
    }

//Save Pump details
    function savePump($admin) {
        $this->db->insert('tbl_pumps', $admin);
        return $this->db->insert_id();
    }

//Update Pump	
    function updatePump($id, $user) {
        $this->db->where('pump_id', $id);
        $this->db->update('tbl_pumps', $user);
    }

//Get Pump by ID
    function get_pump_by_id($id) {
        $this->db->order_by('tbl_pumps.name', 'asc');
        $this->db->select('tbl_pumps.pump_id, tbl_pumps.fuel_product_id, tbl_pumps.name as pump_name, tbl_pumps.centre_id,
		tbl_pumps.electronic_cash_reading, tbl_pumps.electronic_meter_reading, tbl_pumps.manual_meter_reading, tbl_pumps.status,
		tbl_centres.centre_name, tbl_pumps.store_id, tbl_fuel_products.product_id, tbl_items.item_name');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_pumps.centre_id', 'left');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_pumps.store_id', 'left');
        $this->db->join('tbl_fuel_products', 'tbl_fuel_products.product_id = tbl_pumps.fuel_product_id', 'left');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_pumps.fuel_product_id', 'left');
        $this->db->where('pump_id', $id);
        return $this->db->get('tbl_pumps');
    }

//Check if Pump Name exists
    function pump_name_exists($pump_name) {
        $this->db->where('name', $pump_name);
        $query = $this->db->get('tbl_pumps');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Delete Store	
    function deleteStore($id, $status) {
        $this->db->where('store_id', $id);
        $this->db->update($this->tbl_user, $status);
    }

    //Delete Pump	
    function deletePump($id, $status) {
        $this->db->where('pump_id', $id);
        $this->db->update('tbl_pumps', $status);
    }

}

?>