<?php

class Product_model extends CI_Model {

    private $tbl_user = 'tbl_products';

    function __construct() {
        parent::__construct();
    }

    function list_all() {
        $this->db->order_by('grid_id', 'asc');
        return $this->db->get('tbl_grids');
    }

    function getListTable($row, $tbl) {
        $this->db->order_by('type_id', 'asc');
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    function get_list_sales($day = null) {
        //print_r($day); //die();
        $this->db->order_by('sales_id', 'desc');
        $this->db->select('tbl_users.name, tbl_shifts.shift_date, tbl_sales.sales_id, tbl_sales.datetime, tbl_sales.status, tbl_sales.payment_type,
            tbl_sales.total_amount');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_sales.user_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_sales.shift_id', 'left');
        if ($day != null)
            $this->db->where('(tbl_shifts.shift_id)', $day);
        $query = $this->db->get('tbl_sales');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    function get_list_sales_inv($day = null) {
        //print_r($day); //die();
        $this->db->order_by('sales_id', 'desc');
        $this->db->select('tbl_users.name, tbl_shifts.shift_date, tbl_sales.sales_id, tbl_sales.datetime, CONCAT(tbl_shifts_names.name, " of " , DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y")) as shift_name, tbl_sales.status, tbl_sales.payment_type,
            tbl_sales.total_amount,tbl_customers.company_name, tbl_customers.customer_id,tbl_sales_invoice.driver, tbl_sales_invoice.lpo_number, tbl_sales_invoice.vehicle');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_sales.user_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_sales.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->join('tbl_sales_invoice', 'tbl_sales_invoice.sales_id = tbl_sales.sales_id', 'left');
        $this->db->join('tbl_sales_mpesa', 'tbl_sales_mpesa.sales_id = tbl_sales.sales_id', 'left');
        $this->db->join('tbl_sales_card', 'tbl_sales_card.sales_id = tbl_sales.sales_id', 'left');
        $this->db->join('tbl_customers', 'tbl_customers.customer_id = tbl_sales_invoice.customer_id', 'left');
        $this->db->where('tbl_customers.customer_category_id', 1);
        if ($day != null)
            $this->db->where('(tbl_shifts.shift_id)', $day);
        $query = $this->db->get('tbl_sales');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    //Update Invoice by ID
    function updateInvoice($id, $user) {
        $this->db->where('sales_id', $id);
        $this->db->update('tbl_sales_invoice', $user);
    }

    function get_invoice_by_id($id) {
        $this->db->where('tbl_sales_invoice.sales_id', $id);
        $this->db->select('tbl_users.name, tbl_shifts.shift_date, tbl_sales_invoice.sales_id, tbl_sales.datetime, CONCAT(tbl_shifts_names.name, " of " , DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y")) as shift_name, tbl_sales.status, tbl_sales.payment_type,
            tbl_sales.total_amount,tbl_customers.company_name, tbl_customers.customer_id,tbl_sales_invoice.driver, tbl_sales_invoice.lpo_number, tbl_sales_invoice.vehicle');
        $this->db->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_invoice.sales_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_sales.user_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_sales.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->join('tbl_customers', 'tbl_customers.customer_id = tbl_sales_invoice.customer_id', 'left');
        return $this->db->get('tbl_sales_invoice');
    }

    function get_list_sales_mp($day = null) {
        //print_r($day); //die();
        $this->db->order_by('sales_id', 'desc');
        $this->db->select('tbl_users.name, tbl_shifts.shift_date, tbl_sales.sales_id, tbl_sales.datetime, tbl_sales.status, tbl_sales.payment_type,
            tbl_sales.total_amount,tbl_customers.company_name, tbl_customers.customer_id');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_sales.user_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_sales.shift_id', 'left');
        $this->db->join('tbl_sales_mpesa', 'tbl_sales_mpesa.sales_id = tbl_sales.sales_id', 'left');
        $this->db->join('tbl_customers', 'tbl_customers.customer_id = tbl_sales_mpesa.cust_id', 'left');
        $this->db->where('tbl_customers.customer_category_id', 3);
        if ($day != null)
            $this->db->where('(tbl_shifts.shift_id)', $day);
        $query = $this->db->get('tbl_sales');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    function get_list_sales_jc($day = null) {
        $this->db->order_by('close_shift_id', 'desc');
        $this->db->select('tbl_users.name, tbl_shifts.shift_date,tbl_items.item_name, tbl_close_shift_job_card.datetime, tbl_close_shift_job_card.close_shift_id, tbl_close_shift_job_card.quantity,
            tbl_close_shift_job_card.unit_price', 'tbl_close_shift_job_card.user_id');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_close_shift_job_card.user_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_job_card.shift_id', 'left');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_close_shift_job_card.item_id', 'left');
        if ($day != null)
            $this->db->where('(tbl_shifts.shift_id)', $day);
        $query = $this->db->get('tbl_close_shift_job_card');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    function get_list_sales_cad($day = null) {
        //print_r($day); //die();
        $this->db->order_by('sales_id', 'desc');
        $this->db->select('tbl_users.name, tbl_shifts.shift_date, tbl_sales.sales_id, tbl_sales.datetime, tbl_sales.status, tbl_sales.payment_type,
            tbl_sales.total_amount,tbl_customers.company_name, tbl_customers.customer_id');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_sales.user_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_sales.shift_id', 'left');

        $this->db->join('tbl_sales_card', 'tbl_sales_card.sales_id = tbl_sales.sales_id', 'left');

        $this->db->join('tbl_customers', 'tbl_customers.customer_id = tbl_sales_card.card_type', 'left');
        $this->db->where('tbl_customers.customer_category_id', 2);
        if ($day != null)
            $this->db->where('(tbl_shifts.shift_id)', $day);
        $query = $this->db->get('tbl_sales');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    function get_list_sale_items($id = null) {
        $this->db->order_by('sales_product_id', 'desc');
        $this->db->select('tbl_items.item_name, tbl_sales_items.quantity_sold, tbl_shifts.shift_date, tbl_sales.datetime, tbl_sales.payment_type, discount_amount as discount,
			tbl_sales_items.total, tbl_sales_items.unit_price, tbl_pumps.name as pump_name, tbl_sales.total_amount')
                ->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left')
                ->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id', 'left')
                ->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_sales_items.pump_id', 'left')
                ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_sales.shift_id', 'left')
                ->where('tbl_sales_items.sales_id', $id);
        $query = $this->db->get('tbl_sales_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    function print_sale_items($id = null) {
        $this->db->order_by('tbl_sales_items.sales_id', 'desc');
        $this->db->select('tbl_items.item_name, tbl_sales_items.quantity_sold, tbl_sales_items.total, tbl_sales_items.unit_price')
                ->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id', 'left')
                ->where('tbl_sales_items.sales_id', $id);
        $items = $this->db->get('tbl_sales_items')->result_array();
        $this->db->select('tbl_sales.payment_type, DATE_FORMAT(tbl_sales.datetime, "%d-%m-%Y") as datetime, total_amount, tbl_sales.payment_type as sale_type, tbl_users.name as user, shift_id, company_name as customer,')
                ->join('tbl_users', 'tbl_users.user_id = tbl_sales.user_id', 'left')
                ->join('tbl_sales_invoice', 'tbl_sales_invoice.sales_id = tbl_sales.sales_id', 'left')
                ->join('tbl_customers', 'tbl_customers.customer_id = tbl_sales_invoice.customer_id', 'left')
                ->where('tbl_sales.sales_id', $id);
        $sales = $this->db->get('tbl_sales')->result_array();
        return array('sales' => $sales, 'items' => $items);
    }

    function searchitem($search = null) {
        $this->db->order_by('tbl_items.item_name', 'asc');
        $this->db->select('tbl_items.item_id, tbl_items.description, tbl_items.item_name as name , tbl_products_category_type.name as category, 
			tbl_items.item_type, tbl_products.quantity_fourcourt as quantity, tbl_items.unit_price as price, tbl_items.item_type, tbl_products.centre_id,
			tbl_job_cards.centre_id as fc_centre, tbl_items.fc_job_card as fc_job')
                ->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left')
                ->join('tbl_products_category_type', 'tbl_products_category_type.type_id = tbl_products.category_id', 'left')
                ->join('tbl_job_cards', 'tbl_job_cards.item_id = tbl_items.item_id', 'left')
                ->where('tbl_items.deleted', 0)
                ->where('tbl_items.status', 1)
                ->where("(`tbl_items.item_name` LIKE '%$search%'")
                ->or_where("`tbl_products_category_type.name` LIKE '%$search%')");
        $query = $this->db->get('tbl_items');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function searchproduct($search = null) {
        $this->db->order_by('tbl_items.item_name', 'asc');
        $this->db->select('tbl_items.item_id, tbl_items.description, tbl_items.item_name as name, tbl_products_category_type.name as category, tbl_products.quantity_fourcourt as quantity, tbl_items.unit_price as price, tbl_items.item_type, tbl_tax_type.name as tax')
                ->join('tbl_items', 'tbl_items.item_id = tbl_products.item_id', 'left')
                ->join('tbl_products_category_type', 'tbl_products_category_type.type_id = tbl_products.category_id', 'left')
                ->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left')
                ->where('tbl_items.deleted', 0)
                ->where('tbl_items.status', 1)
                ->where("(`tbl_items.item_name` LIKE '%$search%'")
                ->or_where("`tbl_products_category_type.name` LIKE '%$search%')");
        $query = $this->db->get('tbl_products');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function searchJobCard($search = null) {
        $this->db->order_by('tbl_items.item_name', 'asc');
        $this->db->select('tbl_items.item_id, tbl_items.description, tbl_items.item_name as name, tbl_items.unit_price as price, centre_name, tbl_job_cards.centre_id, tbl_tax_type.value as tax')
                ->join('tbl_items', 'tbl_items.item_id = tbl_job_cards.item_id', 'left')
                ->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left')
                ->join('tbl_centres', 'tbl_centres.centre_id = tbl_job_cards.centre_id', 'left')
                ->where('tbl_items.deleted', 0)
                ->where('tbl_items.status', 1)
                ->where("(`tbl_items.item_name` LIKE '%$search%'")
                ->or_where("`tbl_centres.centre_name` LIKE '%$search%')");
        $query = $this->db->get('tbl_job_cards');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function searchtanks($type_id = NULL, $store_id = NULL) {
        $this->db->order_by('tbl_stores.store_name', 'asc');
        $this->db->select('tbl_stores.store_id as store_id, tbl_stores.store_name, tbl_fuel_stores.capacity');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_fuel_stores.store_id', 'left')->where('tbl_fuel_stores.item_id', $type_id)->where('tbl_stores.deleted', 0)->where('tbl_stores.active_status', 1)->where('tbl_stores.store_id !=', $store_id);
        $query = $this->db->get('tbl_fuel_stores');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

//Get list of pumps
    function searchpump($id) {
        $this->db->order_by('tbl_pumps.name', 'asc');
        $this->db->select('tbl_pumps.pump_id, tbl_pumps.name as pump_name, tbl_pumps.centre_id');
        $this->db->where('tbl_pumps.deleted', 0)->where('tbl_pumps.status', 1)->where('fuel_product_id', $id);
        $query = $this->db->get('tbl_pumps');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

//Save Sale
    function saveSale($admin) {
        $this->db->insert('tbl_sales', $admin);
        return $this->db->insert_id();
    }

    function saveBranchSale($admin) {
        $this->db->insert('tbl_Branch_sales', $admin);
        return $this->db->insert_id();
    }

//Save Sale Items
    function saveSaleItems($admin) {
        $this->db->insert('tbl_sales_items', $admin);
        return $this->db->insert_id();
    }

    //Save Sale Items
    function saveBranchSaleItems($admin) {
        $this->db->insert('tbl_branch_sales_items', $admin);
        return $this->db->insert_id();
    }

//Save Sale Invoice
    function saveSaleInvoice($admin) {
        $this->db->insert('tbl_sales_invoices', $admin);
        return $this->db->insert_id();
    }

    function get_list_all_products() {
        $this->db->order_by('item_name', 'asc');
        $this->db->select('tbl_items.item_id, tbl_items.item_name, tbl_items.cost_price, tbl_items.unit_price,
		 tbl_items.description, tbl_items.deleted, tbl_items.status, tbl_tax_type.name as tax_name,
		 tbl_measurement_type.name as measurement_name, tbl_items.date_created, tbl_products.product_id, tbl_products_category_type.name as category,
		 tbl_centres.centre_name, tbl_products.quantity_store, tbl_products.quantity_fourcourt');
        $this->db->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left');
        $this->db->join('tbl_fuel_products', 'tbl_fuel_products.item_id = tbl_items.item_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left');
        $this->db->join('tbl_products_category_type', 'tbl_products_category_type.type_id = tbl_products.category_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_products.centre_id', 'left');
        $this->db->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left');
        return $this->db->get('tbl_items');
    }

    function get_list_products() {
        $this->db->order_by('tbl_products_category_type.name', 'asc');
        $this->db->order_by('item_name', 'asc');
        $this->db->select('tbl_items.item_id, tbl_items.item_name, tbl_items.cost_price, tbl_items.unit_price,
		 tbl_items.description,tbl_items.measurement_unit_id, tbl_items.deleted, tbl_items.status, tbl_tax_type.name as tax_name, tbl_items.status, 
		 tbl_measurement_type.name as measurement_name, tbl_items.date_created, tbl_products.product_id, tbl_products_category_type.name as category,
		 tbl_centres.centre_name, tbl_products.quantity_store, tbl_products.quantity_fourcourt, tbl_stores.store_name, tbl_products.recieve_forecourt');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_products.item_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left');
        $this->db->join('tbl_products_category_type', 'tbl_products_category_type.type_id = tbl_products.category_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_products.centre_id', 'left');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_products.store_id', 'left');
        $this->db->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left');
        $this->db->where('tbl_items.deleted', 0);

        return $this->db->get('tbl_products');
    }

    function get_list_jobCards() {
        $this->db->order_by('centre_name', 'asc');
        $this->db->order_by('item_name', 'asc');
        $this->db->select('tbl_items.item_id, tbl_items.item_name, tbl_items.unit_price, tbl_items.description,tbl_items.measurement_unit_id, 
			tbl_items.deleted, tbl_items.status, tbl_tax_type.name as tax_name, tbl_job_cards.job_card_id, tbl_centres.centre_name');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_job_cards.item_id', 'left');
        $this->db->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_job_cards.centre_id', 'left')
                ->where('tbl_items.deleted', 0);
        return $this->db->get('tbl_job_cards');
    }

//Get FC Job Card By ID
    function get_FCJobCardByID($item_id = NULL) {
        $this->db->select('tbl_items.item_id, tbl_items.item_name, tbl_items.unit_price,
		 tbl_items.description, tbl_items.measurement_unit_id, tbl_items.status, tbl_job_cards.centre_id, tbl_items.tax_id');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_job_cards.item_id', 'left')
                ->where('tbl_items.item_id', $item_id);
        $this->db->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left');
        return $this->db->get('tbl_job_cards');
    }

//Get Products by Store ID
    function get_list_productsByStoreID($store_id = null) {
        $this->db->order_by('item_name', 'asc');
        $this->db->select('tbl_items.item_id, tbl_items.item_name, tbl_items.cost_price, tbl_items.unit_price,
		 tbl_items.description, tbl_items.deleted, tbl_items.status, tbl_tax_type.name as tax_name, tbl_items.status, tbl_products.store_id,
		 tbl_measurement_type.name as measurement_name, tbl_items.date_created, tbl_products.product_id, tbl_products_category_type.name as category,
		 tbl_centres.centre_name, tbl_centres.centre_id as centre_id, tbl_products.quantity_store, tbl_products.quantity_fourcourt');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_products.item_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left');
        $this->db->join('tbl_products_category_type', 'tbl_products_category_type.type_id = tbl_products.category_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_products.centre_id', 'left');
        $this->db->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left');
        $this->db->where('tbl_products.store_id', $store_id);
        return $this->db->get('tbl_products');
    }

//Get Products by category ID
    function get_list_productsByID($category_id = null) {
        $this->db->order_by('item_id', 'asc');
        $this->db->select('tbl_items.item_id, tbl_items.item_name, tbl_items.cost_price, tbl_items.unit_price,
		 tbl_items.description,tbl_items.measurement_unit_id,tbl_items.deleted, tbl_items.status, tbl_tax_type.name as tax_name, tbl_items.status, 
		 tbl_measurement_type.name as measurement_name, tbl_items.date_created, tbl_products.product_id, tbl_products_category_type.name as category,
		 tbl_centres.centre_name, tbl_centres.centre_id as centre_id, tbl_products.quantity_store, tbl_products.quantity_fourcourt, tbl_tax_type.value as tax');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_products.item_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left');
        $this->db->join('tbl_products_category_type', 'tbl_products_category_type.type_id = tbl_products.category_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_products.centre_id', 'left');
        $this->db->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left');
        $this->db->where('tbl_products.category_id', $category_id);
        return $this->db->get('tbl_products');
    }

    //Get Non Lubes Products by category ID
    function get_list_NonLubesproductsByID() {
        $this->db->order_by('item_id', 'asc');
        $this->db->select('tbl_items.item_id, tbl_items.item_name, tbl_items.cost_price, tbl_items.unit_price,
		 tbl_items.description, tbl_items.deleted, tbl_items.status, tbl_tax_type.name as tax_name, tbl_items.status, 
		 tbl_measurement_type.name as measurement_name, tbl_items.date_created, tbl_products.product_id, tbl_products_category_type.name as category,
		 tbl_centres.centre_name, tbl_centres.centre_id as centre_id, tbl_products.quantity_store, tbl_products.quantity_fourcourt, tbl_tax_type.value as tax');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_products.item_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left');
        $this->db->join('tbl_products_category_type', 'tbl_products_category_type.type_id = tbl_products.category_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_products.centre_id', 'left');
        $this->db->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left');
        $this->db->where('tbl_products.category_id !=', 1);
        return $this->db->get('tbl_products');
    }

    function get_by_id_products($id) {
        $this->db->select('tbl_items.item_id, tbl_items.item_name, tbl_items.cost_price, tbl_items.unit_price,
		 tbl_items.description, tbl_items.deleted, tbl_items.status, tbl_items.tax_id as tax_id, tbl_tax_type.name as tax_name, tbl_items.status,tbl_items.measurement_unit_id,
		 tbl_measurement_type.name as measurement_name, tbl_items.date_created, tbl_products.product_id, tbl_products.category_id, tbl_products_category_type.name as category, tbl_products.store_id,
		 tbl_products.centre_id, tbl_centres.centre_name, tbl_products.quantity_store, tbl_products.quantity_fourcourt, tbl_products.recieve_forecourt');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_products.item_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left');
        $this->db->join('tbl_products_category_type', 'tbl_products_category_type.type_id = tbl_products.category_id', 'left');
        $this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_products.centre_id', 'left');
        $this->db->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left');
        $this->db->where('tbl_items.item_id', $id);
        $query = $this->db->get('tbl_products');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

    function get_by_id_products_sale($id) {
        $this->db->select('tbl_products.quantity_fourcourt');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_products.item_id', 'left');
        $this->db->where('tbl_items.item_id', $id);
        $query = $this->db->get('tbl_products');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

    function get_list_fuel_products() {
        $this->db->select('tbl_items.item_id, tbl_items.item_name, tbl_items.cost_price, tbl_items.unit_price,
		 tbl_items.description,tbl_items.measurement_unit_id, tbl_items.deleted, tbl_items.status, tbl_tax_type.name as tax_name, tbl_items.status, tbl_measurement_type.name as measurement_name, tbl_items.date_created, tbl_fuel_products.product_id');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_fuel_products.item_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left');
        $this->db->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left')
                ->where('tbl_items.deleted', 0);
        return $this->db->get('tbl_fuel_products');
    }

    function get_by_id_Whiteproducts($id) {
        $this->db->select('tbl_fuel_products.item_id, tbl_items.item_name, tbl_items.cost_price, tbl_items.unit_price,
			tbl_items.description,tbl_items.measurement_unit_id, tbl_items.deleted, tbl_items.status, tbl_items.tax_id as tax_id, tbl_tax_type.name as tax_name, tbl_items.status, tbl_measurement_type.name as measurement_name, tbl_items.date_created, tbl_fuel_products.product_id');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_fuel_products.item_id', 'left');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left');
        $this->db->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left');
        $this->db->where('tbl_items.item_id', $id);
        $query = $this->db->get('tbl_fuel_products');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
    }

    function get_by_id_items($id) {
        $this->db->select('tbl_items.item_id, tbl_items.item_name, tbl_items.cost_price, tbl_items.unit_price, tbl_items.item_type,
			tbl_items.description, tbl_items.deleted, tbl_items.status, tbl_items.tax_id as tax_id, tbl_tax_type.name as tax_name, tbl_items.status, tbl_measurement_type.name as measurement_name, tbl_items.date_created, tbl_items.fc_job_card');
        $this->db->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left');
        $this->db->join('tbl_measurement_type', 'tbl_measurement_type.type_id = tbl_items.measurement_unit_id', 'left');
        $this->db->where('tbl_items.item_id', $id);
        return $this->db->get('tbl_items');
    }

//Get all Recievings Charge Supplier
    function get_list_charge_supplier() {
        $where = "tbl_recieving_items.variance < 0 OR tbl_recieving_items_fuel.variance < 0";
        $this->db->order_by('tbl_receivings.receiving_id', 'desc');
        $this->db->select('tbl_receivings.receiving_id, tbl_receivings.datetime, tbl_receivings.type, tbl_users.name as employee, tbl_suppliers.company_name as supplier, tbl_receivings.transporter_id, tbl_transporters.transporter_name,
			tbl_vehicles.registration_number, tbl_receivings.driver_name, tbl_shifts_names.name as shift_name, tbl_shifts.shift_date, tbl_receivings.invoice_number,
			tbl_receivings.comment, tbl_receivings.delivery_note_number, tbl_recieving_items.variance as product_variance, tbl_recieving_items_fuel.variance as fuel_variance, tbl_receivings.charge_supplier');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_receivings.employee_id', 'left');
        $this->db->join('tbl_suppliers', 'tbl_suppliers.supplier_id = tbl_receivings.supplier_id', 'left');
        $this->db->join('tbl_recieving_items', 'tbl_recieving_items.recieving_id = tbl_receivings.receiving_id', 'left');
        $this->db->join('tbl_recieving_items_fuel', 'tbl_recieving_items_fuel.recieving_id = tbl_receivings.receiving_id', 'left');
        $this->db->join('tbl_transporters', 'tbl_transporters.transporter_id = tbl_receivings.transporter_id', 'left');
        $this->db->join('tbl_vehicles', 'tbl_vehicles.vehicle_id = tbl_receivings.truck_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_receivings.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->where($where);
        return $this->db->get('tbl_receivings');
    }

//Get all Recievings
    function get_list_recievings() {
        $this->db->order_by('tbl_receivings.receiving_id', 'desc');
        $this->db->select('tbl_receivings.receiving_id, tbl_receivings.datetime, tbl_receivings.type, tbl_users.name as employee, tbl_suppliers.company_name as supplier, tbl_transporters.transporter_name,
			tbl_vehicles.registration_number, tbl_receivings.driver_name, tbl_shifts_names.name as shift_name, tbl_shifts.shift_date, tbl_receivings.invoice_number,
			tbl_receivings.comment, tbl_receivings.delivery_note_number');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_receivings.employee_id', 'left');
        $this->db->join('tbl_suppliers', 'tbl_suppliers.supplier_id = tbl_receivings.supplier_id', 'left');
        $this->db->join('tbl_transporters', 'tbl_transporters.transporter_id = tbl_receivings.transporter_id', 'left');
        $this->db->join('tbl_vehicles', 'tbl_vehicles.vehicle_id = tbl_receivings.truck_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_receivings.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        return $this->db->get('tbl_receivings');
    }

//Get Non-Fuel Recieving
    function get_list_NonFuel_recievings() {
        $this->db->order_by('tbl_receivings.receiving_id', 'desc');
        $this->db->select('tbl_receivings.receiving_id, tbl_receivings.datetime, tbl_users.name as employee, tbl_suppliers.company_name as supplier, tbl_transporters.transporter_name,
			tbl_vehicles.registration_number, tbl_receivings.driver_name, tbl_shifts_names.name as shift_name, tbl_shifts.shift_date, tbl_receivings.invoice_number,
			tbl_receivings.comment, tbl_receivings.delivery_note_number');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_receivings.employee_id', 'left');
        $this->db->join('tbl_suppliers', 'tbl_suppliers.supplier_id = tbl_receivings.supplier_id', 'left');
        $this->db->join('tbl_transporters', 'tbl_transporters.transporter_id = tbl_receivings.transporter_id', 'left');
        $this->db->join('tbl_vehicles', 'tbl_vehicles.vehicle_id = tbl_receivings.truck_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_receivings.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->where('tbl_receivings.type', 1);
        return $this->db->get('tbl_receivings');
    }

//Get Fuel Recieving
    function get_list_Fuel_recievings() {
        $this->db->order_by('tbl_receivings.receiving_id', 'desc');
        $this->db->select('tbl_receivings.receiving_id, tbl_receivings.datetime, tbl_users.name as employee, tbl_suppliers.company_name as supplier, tbl_transporters.transporter_name,
			tbl_vehicles.registration_number, tbl_receivings.driver_name, tbl_shifts_names.name as shift_name, tbl_shifts.shift_date, tbl_receivings.invoice_number,
			tbl_receivings.comment, tbl_receivings.delivery_note_number');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_receivings.employee_id', 'left');
        $this->db->join('tbl_suppliers', 'tbl_suppliers.supplier_id = tbl_receivings.supplier_id', 'left');
        $this->db->join('tbl_transporters', 'tbl_transporters.transporter_id = tbl_receivings.transporter_id', 'left');
        $this->db->join('tbl_vehicles', 'tbl_vehicles.vehicle_id = tbl_receivings.truck_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_receivings.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->where('tbl_receivings.type', 2);
        return $this->db->get('tbl_receivings');
    }

//Get Recieving by ID	
    function get_recievings_by_id($id) {
        $this->db->order_by('tbl_receivings.receiving_id', 'desc');
        $this->db->select('tbl_receivings.receiving_id, tbl_receivings.datetime, tbl_users.name as employee, tbl_suppliers.company_name as supplier, tbl_receivings.transporter_id, tbl_transporters.transporter_name,
			tbl_vehicles.registration_number, tbl_receivings.driver_name, tbl_shifts_names.name as shift_name, tbl_shifts.shift_date, tbl_receivings.invoice_number,
			tbl_receivings.comment, tbl_receivings.delivery_note_number');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_receivings.employee_id', 'left');
        $this->db->join('tbl_suppliers', 'tbl_suppliers.supplier_id = tbl_receivings.supplier_id', 'left');
        $this->db->join('tbl_transporters', 'tbl_transporters.transporter_id = tbl_receivings.transporter_id', 'left');
        $this->db->join('tbl_vehicles', 'tbl_vehicles.vehicle_id = tbl_receivings.truck_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_receivings.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->where('tbl_receivings.receiving_id', $id);
        return $this->db->get('tbl_receivings');
    }

//Get Recieving Items by recieving ID
    function get_list_recievings_items_by_id($id) {
        $this->db->order_by('tbl_recieving_items.recieving_items_id', 'asc');
        $this->db->select('tbl_items.item_name, tbl_recieving_items.recieving_quantity, tbl_recieving_items.quantity_purchased, tbl_recieving_items.variance,
			tbl_recieving_items.item_unit_price, tbl_recieving_items.tax_percentage, tbl_recieving_items.discount_percent, tbl_recieving_items.total_price');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_recieving_items.item_id', 'left');
        $this->db->where('tbl_recieving_items.recieving_id', $id);
        $query = $this->db->get('tbl_recieving_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get Recieving Items by recieving ID
    function get_list_recievings_fuel_items_by_id($id) {
        $this->db->order_by('tbl_recieving_items_fuel.recieving_items_id', 'asc');
        $this->db->select('tbl_items.item_name, tbl_recieving_items_fuel.recieving_quantity, tbl_recieving_items_fuel.variance, tbl_recieving_items_fuel.item_unit_price, tbl_recieving_items_fuel.tax_percentage, tbl_recieving_items_fuel.discount_percent, tbl_recieving_items_fuel.vat_amount, tbl_stores.store_name as store, tbl_stores.store_type_id as store_type, tbl_recieving_items_dippings.dip_before as before, tbl_recieving_items_dippings.dip_after as after,
			tbl_recieving_items_dippings.expected_dip_quantity as expected, tbl_recieving_items_dippings.sales_during_offloading as sales, tbl_recieving_items_fuel.net_amount');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_recieving_items_fuel.item_id', 'left');
        $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_recieving_items_fuel.store_id', 'left');
        $this->db->join('tbl_recieving_items_dippings', 'tbl_recieving_items_dippings.recieving_id = tbl_recieving_items_fuel.recieving_items_id', 'left');
        $this->db->where('tbl_recieving_items_fuel.recieving_id', $id)->group_by('tbl_recieving_items_fuel.recieving_items_id');
        $query = $this->db->get('tbl_recieving_items_fuel');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get Vendor Statement
    function get_SupplierStatement($supplier_id = null, $from = null, $to = null) {
        $this->db->order_by('tbl_suppliers_transactions.supplier_transaction_id', 'asc');
        $this->db->select('tbl_suppliers_transactions.datetime, tbl_suppliers_transactions.debit, tbl_suppliers_transactions.details,
							tbl_suppliers_transactions.amount, tbl_suppliers_transactions.transaction_type, tbl_suppliers_transactions.payment_type,
							tbl_users.name as employee, tbl_suppliers.company_name as supplier');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_suppliers_transactions.employee_id', 'left');
        $this->db->join('tbl_suppliers', 'tbl_suppliers.supplier_id = tbl_suppliers_transactions.supplier_id', 'left');
        if ($supplier_id == null) {
            return null;
        } else {
            $this->db->where('tbl_suppliers_transactions.supplier_id', $supplier_id);
            if ($from != null) {
                $from_date = "DATE(tbl_suppliers_transactions.datetime) >= '" . date("Y-m-d", strtotime($from)) . "'";
                $this->db->where($from_date);
            }
            if ($to != null) {
                $to_date = "DATE(tbl_suppliers_transactions.datetime) <= '" . date("Y-m-d", strtotime($to)) . "'";
                $this->db->where($to_date);
            }
            $query = $this->db->get('tbl_suppliers_transactions');
            if ($query->num_rows() > 0) {
                return $query;
            } else {
                return null;
            }
        }
    }

    function getCustomerStatement($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post, 'asc');
        foreach ($shift_array as $shift) {

            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        if (count($shift_array) > 0) {
            if ($post['vendor']) {
                $this->db->where('tbl_customers_transactions.customer_id', $post['vendor']);
            }
            $this->db->order_by('tbl_customers_transactions.customer_transaction_id', 'asc');
            $this->db->select('tbl_customers.company_name, DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y") as datetime, customer_transaction_id, tbl_customers_transactions.debit, tbl_customers_transactions.source, tbl_customers_transactions.ref_number, tbl_customer_payments.remarks, tbl_customers_transactions.transaction_type, tbl_customers_transactions.amount,tbl_customers_transactions.payment_type as payment_type, bbf, tbl_sales_invoice.vehicle,
            tbl_sales.payment_type as sale_type,tbl_items.item_name, tbl_sales_items.quantity_sold,tbl_sales_items.total, tbl_sales_items.unit_price, tbl_sales.total_amount, tbl_customers_transactions.customer_id, lpo_number, card_name, tbl_sales.sales_id');
            $this->db->join('tbl_customer_payments', 'tbl_customer_payments.customers_transactions_id = tbl_customers_transactions.customer_transaction_id', 'left')
                    ->join('tbl_payment_type', 'tbl_payment_type.type_id = tbl_customers_transactions.payment_type', 'left')
                    ->join('tbl_sales', 'tbl_sales.sales_id = tbl_customers_transactions.ref_number', 'left')
                    ->join('tbl_customers', 'tbl_customers.customer_id = tbl_customers_transactions.customer_id', 'left')
                    ->join('tbl_sales_items', 'tbl_sales_items.sales_id = tbl_sales.sales_id', 'left')
                    ->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id', 'left')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_customers_transactions.shift_id', 'left')
                    ->join('tbl_sales_card', 'tbl_sales_card.sales_id = tbl_sales.sales_id', 'left')
                    ->join('tbl_sales_invoice', 'tbl_sales_invoice.sales_id = tbl_sales.sales_id', 'left')
                    ->where_in('tbl_customers_transactions.shift_id', $shift_data_array);
            $data = $this->db->get('tbl_customers_transactions')->result_array();
        }
        return array('data' => $data);
    }

    function getSupplierStatement($post = NULL) {
        $shift_data_array = array();
        $shift_array = $this->per_shift_range($post, 'asc');
        foreach ($shift_array as $shift) {

            $shift_data_array[] = $shift['shift_id'];
        }
        $data = array();
        if (count($shift_array) > 0) {
            if ($post['vendor']) {
                $this->db->where('tbl_vendors_transactions.supplier_id', $post['vendor']);
            }
            $this->db->order_by('tbl_vendors_transactions.supplier_transaction_id', 'asc');
            $this->db->select('tbl_suppliers.company_name, DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y") as datetime, tbl_vendors_transactions.debit, tbl_vendors_transactions.source, tbl_vendors_transactions.ref_number, tbl_supplier_payments.remarks, tbl_vendors_transactions.transaction_type, tbl_vendors_transactions.amount, tbl_vendors_transactions.payment_type as payment_type, bbf,
            tbl_receivings.invoice_number,tbl_receivings.type');
            $this->db->join('tbl_supplier_payments', 'tbl_supplier_payments.supplier_transactions_id = tbl_vendors_transactions.supplier_transaction_id', 'left')
                    ->join('tbl_payment_type', 'tbl_payment_type.type_id = tbl_vendors_transactions.payment_type', 'left')
                    ->join('tbl_receivings', 'tbl_receivings.receiving_id = tbl_vendors_transactions.ref_number', 'left')
                    ->join('tbl_suppliers', 'tbl_suppliers.supplier_id = tbl_vendors_transactions.supplier_id', 'left')
                    ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_vendors_transactions.shift_id', 'left')
                    ->where_in('tbl_vendors_transactions.shift_id', $shift_data_array);
            $data = $this->db->get('tbl_vendors_transactions')->result_array();
        }
        return array('data' => $data);
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

//Get Customer Statement
    function get_CustomerStatement($post) {
        if (isset($post['dateTo'])) {
            $date_array = explode(" - ", $post['dateTo']);
            $post_range = "DATE(tbl_shifts.shift_date) >= '" . date("Y-m-d", strtotime($date_array[0])) . "' AND DATE(tbl_shifts.shift_date) <= '" . date("Y-m-d", strtotime($date_array[1])) . "'";
            $this->db->where($post_range);
        }
        if ($post['vendor']) {
            $this->db->where('tbl_customers_transactions.customer_id', $post['vendor']);
        }
        $this->db->order_by('tbl_customers_transactions.customer_transaction_id', 'asc');
        $this->db->select('DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y") as datetime, customer_transaction_id, tbl_customers_transactions.debit, tbl_customers_transactions.source, tbl_customers_transactions.ref_number, tbl_customer_payments.remarks, tbl_customers_transactions.transaction_type, tbl_customers_transactions.amount, tbl_payment_type.name as payment_type, bbf, tbl_sales_invoice.vehicle,
            tbl_sales.payment_type as sale_type, tbl_customers_transactions.customer_id, lpo_number, card_name, tbl_sales.sales_id');
        $this->db->join('tbl_customer_payments', 'tbl_customer_payments.customers_transactions_id = tbl_customers_transactions.customer_transaction_id', 'left')
                ->join('tbl_payment_type', 'tbl_payment_type.type_id = tbl_customers_transactions.payment_type', 'left')
                ->join('tbl_sales', 'tbl_sales.sales_id = tbl_customers_transactions.ref_number', 'left')
                ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_customers_transactions.shift_id', 'left')
                ->join('tbl_sales_card', 'tbl_sales_card.sales_id = tbl_sales.sales_id', 'left')
                ->join('tbl_sales_invoice', 'tbl_sales_invoice.sales_id = tbl_sales.sales_id', 'left');
        $query = $this->db->get('tbl_customers_transactions');
        $result = $query->result_array();
        $items = array();
        foreach ($result as $rst) {
            $this->db->order_by('tbl_sales.sales_id', 'asc');
            $this->db->select('tbl_items.item_name, tbl_sales_items.quantity_sold, tbl_sales.payment_type, 
                tbl_sales_items.total, tbl_sales_items.unit_price, tbl_sales.total_amount')
                    ->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left')
                    ->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id', 'left')
                    ->where('tbl_sales_items.sales_id', $rst['sales_id']);
            $query2 = $this->db->get('tbl_sales_items')->result_array();
            $items[$rst['customer_transaction_id']] = $query2;
        }
        $this->db->order_by('company_name', 'asc');
        $this->db->select('tbl_customers.company_name');
        $this->db->where('customer_id', $post['vendor']);
        $query = $this->db->get('tbl_customers');
        if ($query->num_rows() > 0)
            $customer = $query->result()[0]->company_name;
        else
            $customer = "";
        return array('data' => $result, 'items' => $items, 'customer' => $customer);
    }

//customer statement report
    //Customer, BBF last, SUM all debits, Total = bbf + debits, Sum paid, Balance
//Get Customer Debit Amount
    function sum__customer_debit_opening_balance($supplier_id, $from) {
        $this->db->select('SUM(tbl_customers_transactions.amount) as sum_debit');
        $this->db->where('tbl_customers_transactions.customer_id', $supplier_id);
        $this->db->where('tbl_customers_transactions.debit', 1);
        if ($from != null) {
            $from_date = "DATE(tbl_customers_transactions.datetime) < '" . date("Y-m-d", strtotime($from)) . "'";
            $this->db->where($from_date);
        }
        $query = $this->db->get('tbl_customers_transactions');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

//Get Customer Credit Amount
    function sum__customer_credit_opening_balance($supplier_id, $from) {
        $this->db->select('SUM(tbl_customers_transactions.amount) as sum_credit');
        $this->db->where('tbl_customers_transactions.customer_id', $supplier_id);
        $this->db->where('tbl_customers_transactions.debit', 2);
        if ($from != null) {
            $from_date = "DATE(tbl_customers_transactions.datetime) < '" . date("Y-m-d", strtotime($from)) . "'";
            $this->db->where($from_date);
        }
        $query = $this->db->get('tbl_customers_transactions');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

//Get Vendor Credit Amount
    function sum__credit_opening_balance($supplier_id, $from) {
        $this->db->select('SUM(tbl_suppliers_transactions.amount) as sum_credit');
        $this->db->where('tbl_suppliers_transactions.supplier_id', $supplier_id);
        $this->db->where('tbl_suppliers_transactions.debit', 2);
        if ($from != null) {
            $from_date = "DATE(tbl_suppliers_transactions.datetime) < '" . date("Y-m-d", strtotime($from)) . "'";
            $this->db->where($from_date);
        }
        $query = $this->db->get('tbl_suppliers_transactions');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

//Sum Mpesa Amount
    function sum_mpesa_amount($shift_id = NULL) {
        $this->db->select('SUM(tbl_sales.total_amount) as total_mpesa_sales');
        $query = $this->db->where('shift_id', $shift_id)->get('tbl_sales');
        return $query->result_array();
    }

    function get_credit_sales($shift_id) {
        $this->db->select('tbl_sales.payment_type as sale_type, SUM(tbl_sales_items.total) as total, SUM(tbl_sales_items.quantity_sold) as qty, tbl_sales_items.item_id')
                ->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left')->where('tbl_sales.shift_id', $shift_id)->where('payment_type !=', 'Cash')->group_by('item_id');
        $this->db->where('tbl_sales.status', 0);
        return $this->db->get('tbl_sales_items')->result_array();
    }

    function get_list_tax() {
        return $this->db->get('tbl_tax_type');
    }

    function get_list_measure() {
        return $this->db->get('tbl_measurement_type');
    }
    function fetch_all($table) {
        return $this->db->get($table);
    }

    function get_list_measurement() {
        return $this->db->get('tbl_measurement_type');
    }

    function get_list_item_types() {
        return $this->db->get('tbl_item_type');
    }

    //Only for non fuel items
    function get_list_product_category() {
        $this->db->select('tbl_products_category_type.*');
        $this->db->where('tbl_products_category_type.deleted', 0);
        return $this->db->get('tbl_products_category_type');
    }

    function get_list_product_category_by_id($id) {
        $this->db->select('*');
        $this->db->where('tbl_products_category_type.type_id', $id);
        $query = $this->db->get('tbl_products_category_type');
        if ($query->num_rows() > 0)
            return $query;
        else
            return null;
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
        return $this->db->get('tbl_companies');
    }

    function update($id, $user) {
        $this->db->where('item_id', $id);
        $this->db->update('tbl_items', $user);
    }

    function updateProduct($id, $user) {
        $this->db->where('product_id', $id);
        $this->db->update('tbl_products', $user);
    }

    function updateCategory($id, $user) {
        $this->db->where('type_id', $id);
        $this->db->update('tbl_products_category_type', $user);
    }

    //update product category 
    function updateProductCategory($id, $user) {
        $this->db->where('type_id', $id);
        $this->db->update('tbl_products_category_type', $user);
    }

//Update Product using Item ID
    function updateProductItem($id, $user) {
        $this->db->where('item_id', $id);
        $this->db->update('tbl_products', $user);
    }

//Update Recieving using Recieving ID
    function updateReceiving($id, $user) {
        $this->db->where('receiving_id', $id);
        $this->db->update('tbl_receivings', $user);
        if ($this->db->affected_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    function updateRecord($record, $id, $user, $tbl) {
        $this->db->where($record, $id);
        $this->db->update($tbl, $user);
    }

    function save($admin) {
        $this->db->insert($this->tbl_user, $admin);
        return $this->db->insert_id();
    }

    function saveRecord($admin, $tbl) {
        $this->db->insert($tbl, $admin);
        return $this->db->insert_id();
    }

    function saveItem($admin) {
        $this->db->insert('tbl_items', $admin);
        return $this->db->insert_id();
    }

    function saveFuel($admin) {
        $this->db->insert('tbl_fuel_products', $admin);
        return $this->db->insert_id();
    }

    function saveProduct($admin) {
        $this->db->insert('tbl_products', $admin);
        return $this->db->insert_id();
    }

    // Add Product Category Name
    function saveProductCategory($name) {
        $this->db->insert('tbl_products_category_type', $name);
        return $this->db->insert_id();
    }

//Save recieving
    function saveRecieving($admin) {
        $this->db->insert('tbl_receivings', $admin);
        return $this->db->insert_id();
    }

//Save recieving Items Non Fuel
    function saveRecievingNonFuel($admin) {
        $this->db->insert('tbl_recieving_items', $admin);
        return $this->db->insert_id();
    }

//Save recieving Items Fuel
    function saveRecievingFuel($admin) {
        $this->db->insert('tbl_recieving_items_fuel', $admin);
        return $this->db->insert_id();
    }

//Save recieving Dippings Fuel
    function saveRecievingDippings($admin) {
        $this->db->insert('tbl_recieving_items_dippings', $admin);
        return $this->db->insert_id();
    }

//Save recieving Vendor Payments
    function saveVendorTransaction($admin) {
        $this->db->insert('tbl_suppliers_transactions', $admin);
        return $this->db->insert_id();
    }

    function saveSupplierTransaction($admin) {
        $this->db->insert('tbl_vendors_transactions', $admin);
        return $this->db->insert_id();
    }

//Check if Product Name exists
    function product_name_exists($name) {
        $this->db->where('item_name', $name);
        $query = $this->db->get('tbl_items');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

//Check if Product Name exists
    function product_category_name_exists($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('tbl_products_category_type');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

//Save Invoice
    function saveInvoice($admin) {
        $this->db->insert('tbl_invoices', $admin);
        return $this->db->insert_id();
    }

    function get_list_invoice() {
        return $this->db->get('tbl_invoices');
    }

//Get Invoices by recieving ID
    function get_by_recieving_id_invoices($id) {
        $this->db->where('tbl_invoices.recieving_id', $id);
        $query = $this->db->get('tbl_invoices');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Save Stock Transfer
    function saveStockTransfer($admin) {
        $this->db->insert('tbl_stock_transfers', $admin);
        return $this->db->insert_id();
    }

//Save Stock Transfer items
    function saveStockTransferItems($admin) {
        $this->db->insert('tbl_stock_transfers_items', $admin);
        return $this->db->insert_id();
    }

//Get list of stock transfers
    function get_list_stockTransfer() {
        $this->db->order_by('transfer_id', 'desc');
        $this->db->select('tbl_stock_transfers.transfer_id, tbl_stock_transfers.datetime, tbl_stock_transfers.transfer_type, tbl_users.name as employee, tbl_stock_transfers.dispatch_store_id, tbl_stock_transfers.recieving_store_id, tbl_shifts.shift_date, tbl_shifts_names.name as shift_name, dispatch_store.store_name as dispatch_name, recieving_store.store_name as recieving_name');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_stock_transfers.employee_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_stock_transfers.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                ->join('tbl_stores dispatch_store', 'dispatch_store.store_id = tbl_stock_transfers.dispatch_store_id', 'left outer')
                ->join('tbl_stores recieving_store', 'recieving_store.store_id = tbl_stock_transfers.recieving_store_id', 'left outer');
        $query = $this->db->get('tbl_stock_transfers');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get list of stock transfers
    function get_list_stockTransfer_items($id) {
        $this->db->order_by('tbl_stock_transfers_items.transfer_id', 'desc');
        $this->db->select('tbl_stock_transfers_items.quantity, tbl_stock_transfers.datetime, tbl_stock_transfers.transfer_type, tbl_users.name as employee, tbl_stock_transfers.dispatch_store_id, dispatch_store.store_name as dispatch_name, recieving_store.store_name as recieving_name, tbl_stock_transfers.recieving_store_id, tbl_shifts.shift_date, tbl_shifts_names.name as shift_name, tbl_items.item_name');
        $this->db->join('tbl_stock_transfers', 'tbl_stock_transfers.transfer_id = tbl_stock_transfers_items.stock_transfer_id', 'left');
        $this->db->join('tbl_items', 'tbl_items.item_id = tbl_stock_transfers_items.item_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_stock_transfers.employee_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_stock_transfers.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                ->join('tbl_stores dispatch_store', 'dispatch_store.store_id = tbl_stock_transfers.dispatch_store_id', 'left outer')
                ->join('tbl_stores recieving_store', 'recieving_store.store_id = tbl_stock_transfers.recieving_store_id', 'left outer');
        $this->db->where('tbl_stock_transfers_items.stock_transfer_id', $id);
        $query = $this->db->get('tbl_stock_transfers_items');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get list of Debit Notes
    function get_list_debitNote() {
        $this->db->order_by('note_id', 'desc');
        $this->db->select('tbl_debit_notes.*, tbl_users.name as employee, tbl_persons.name as customer');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_debit_notes.user_id', 'left');
        $this->db->join('tbl_persons', 'tbl_persons.person_id = tbl_debit_notes.customer_id', 'left');
        $query = $this->db->get('tbl_debit_notes');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Save Debit Note
    function saveDebitNote($admin) {
        $this->db->insert('tbl_debit_notes', $admin);
        return $this->db->insert_id();
    }

    function saveVendorCrNote($admin) {
        $this->db->insert('tbl_credit_notes', $admin);
        return $this->db->insert_id();
    }

    function saveVendorDrNote($admin) {
        $this->db->insert('tbl_debit_notes', $admin);
        return $this->db->insert_id();
    }

//Get list of Customer Payments
    function get_list_customerPayments() {
        $this->db->order_by('customer_transaction_id', 'desc');
        $this->db->select('tbl_shifts.shift_date as datetime, customer_transaction_id, debit, amount, tbl_users.name as employee, tbl_customers.company_name as customer, tbl_payment_type.name as payment_type, ref_number, tbl_customer_payments.remarks, tbl_customer_payments.payment_reason')
                ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_customers_transactions.shift_id', 'left')
                ->join('tbl_users', 'tbl_users.user_id = tbl_customers_transactions.employee_id', 'left')
                ->join('tbl_payment_type', 'tbl_payment_type.type_id = tbl_customers_transactions.payment_type')
                ->join('tbl_customer_payments', 'tbl_customer_payments.customers_transactions_id = tbl_customers_transactions.customer_transaction_id');
        $this->db->join('tbl_customers', 'tbl_customers.customer_id = tbl_customers_transactions.customer_id', 'left');
        $query = $this->db->get('tbl_customers_transactions');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    //Get list of Customer Payments
    function get_list_employeePayments() {
        $this->db->order_by('adjust_amt_id', 'desc');
        $this->db->select('datetime, adjust_amt_id, figure, tbl_users.name as employee, tbl_employees.name as customer, tbl_payment_type.name as payment_type, ref_number, tbl_employee_payments.remarks, tbl_employee_payments.payment_reason')
                ->join('tbl_users', 'tbl_users.user_id = tbl_close_shift_debit_user.employee_id', 'left')
                ->join('tbl_payment_type', 'tbl_payment_type.type_id = tbl_close_shift_debit_user.payment_type')
                ->join('tbl_employee_payments', 'tbl_employee_payments.employee_transactions_id = tbl_close_shift_debit_user.adjust_amt_id');
        $this->db->join('tbl_employees', 'tbl_employees.emp_id = tbl_close_shift_debit_user.user_id', 'left');
        $query = $this->db->get('tbl_close_shift_debit_user');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Save Customer Payments
    function saveCustomerPayment($admin) {
        $this->db->insert('tbl_customer_payments', $admin);
        return $this->db->insert_id();
    }

    function saveSupplierPayment($admin) {
        $this->db->insert('tbl_supplier_payments', $admin);
        return $this->db->insert_id();
    }


    function saveVatPayment($post) {
        $this->db->insert('tbl_vat_payments', $post);
        return $this->db->insert_id();
    }

//Save Customer Transactions
    function saveCustomerTransactions($admin) {
        $this->db->insert('tbl_customers_transactions', $admin);
        return $this->db->insert_id();
    }

    function saveSupplierTransactions($admin) {
        $this->db->insert('tbl_vendors_transactions', $admin);
        return $this->db->insert_id();
    }

    //Save Customer Payments
    function saveEmployeePayment($admin) {
        $this->db->insert('tbl_employee_payments', $admin);
        return $this->db->insert_id();
    }

    //Save Employee Transactions
    function saveEmployeeTransactions($admin) {
        $this->db->insert('tbl_close_shift_debit_user', $admin);
        return $this->db->insert_id();
    }

    function getlist_vendorPayments() {
        $this->db->order_by('supplier_transaction_id', 'desc');
        $this->db->select('tbl_shifts.shift_date as datetime, supplier_transaction_id, debit, amount, tbl_users.name as employee, tbl_suppliers.company_name as supplier, tbl_payment_type.name as payment_type, ref_number, tbl_supplier_payments.remarks, tbl_supplier_payments.payment_reason')
                ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_vendors_transactions.shift_id', 'left')
                ->join('tbl_users', 'tbl_users.user_id = tbl_vendors_transactions.employee_id', 'left')
                ->join('tbl_payment_type', 'tbl_payment_type.type_id = tbl_vendors_transactions.payment_type')
                ->join('tbl_supplier_payments', 'tbl_supplier_payments.supplier_transactions_id = tbl_vendors_transactions.supplier_transaction_id');
        $this->db->join('tbl_suppliers', 'tbl_suppliers.supplier_id = tbl_vendors_transactions.supplier_id', 'left');
        $query = $this->db->get('tbl_vendors_transactions');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get list of Vendor Payments
    function get_list_vendorPayments() {
        $this->db->order_by('payment_id', 'desc');
        $this->db->select('tbl_vendor_payments.*, tbl_users.name as employee, tbl_suppliers.company_name as supplier, 
				tbl_payment_type.name as payment_type')
                ->join('tbl_users', 'tbl_users.user_id = tbl_vendor_payments.user_id', 'left')
                ->join('tbl_payment_type', 'tbl_payment_type.type_id = tbl_vendor_payments.payment_method');
        $this->db->join('tbl_suppliers', 'tbl_suppliers.supplier_id = tbl_vendor_payments.vendor_id', 'left');
        $query = $this->db->get('tbl_vendor_payments');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Save Debit Note
    function saveVendorPayment($admin) {
        $this->db->insert('tbl_vendor_payments', $admin);
        return $this->db->insert_id();
    }

//Save Transaction
    function saveTransaction($admin) {
        $this->db->insert('tbl_transactions', $admin);
        return $this->db->insert_id();
    }

//Save Shortage for Employee
    function saveShortage($admin) {
        $this->db->insert('	tbl_employee_shortage', $admin);
        return $this->db->insert_id();
    }

//Save Excess for Employee
    function saveExcess($admin) {
        $this->db->insert('	tbl_employee_excess', $admin);
        return $this->db->insert_id();
    }

//Save Banking
    function saveBanking($admin) {
        $this->db->insert('tbl_bankings', $admin);
        return $this->db->insert_id();
    }

//Save Banks
    function saveBank($admin) {
        $this->db->insert('tbl_banks', $admin);
        return $this->db->insert_id();
    }

//Save Bank Account
    function saveBankAccount($admin) {
        $this->db->insert('tbl_banks_account_number', $admin);
        return $this->db->insert_id();
    }

//Get list of Bankings Done
    function get_list_Bankings() {
        $this->db->order_by('banking_id', 'desc');
        $this->db->select('tbl_bankings.*, tbl_banks_account_number.branch_name, tbl_banks_account_number.account_number, tbl_users.name as employee, tbl_banks.name as bank, tbl_shifts_names.name as shift, tbl_shifts.shift_date');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_bankings.deposited_by', 'left');
        $this->db->join('tbl_banks_account_number', 'tbl_banks_account_number.account_number_id = tbl_bankings.account_number_id', 'left');
        $this->db->join('tbl_banks', 'tbl_banks.bank_id = tbl_banks_account_number.bank_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_bankings.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $query = $this->db->get('tbl_bankings');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    function get_list_VendorNotes() {
        $this->db->order_by('note_id', 'desc');
        $this->db->select('tbl_credit_notes.*, tbl_suppliers.company_name as vendor, tbl_customers.company_name as customer, tbl_users.name as employee, tbl_shifts.shift_date as date');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_credit_notes.user_id', 'left');
        $this->db->join('tbl_suppliers', 'tbl_suppliers.supplier_id = tbl_credit_notes.supplier_id', 'left');
        $this->db->join('tbl_customers', 'tbl_customers.customer_id = tbl_credit_notes.customer_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_credit_notes.shift_id', 'left');
        $query = $this->db->get('tbl_credit_notes');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

    function get_list_VendorDebits() {
        $this->db->order_by('note_id', 'desc');
        $this->db->select('tbl_debit_notes.*, tbl_suppliers.company_name as vendor, tbl_customers.company_name as customer, tbl_users.name as employee, tbl_shifts.shift_date as date');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_debit_notes.user_id', 'left');
        $this->db->join('tbl_suppliers', 'tbl_suppliers.supplier_id = tbl_debit_notes.supplier_id', 'left');
        $this->db->join('tbl_customers', 'tbl_customers.customer_id = tbl_debit_notes.customer_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_debit_notes.shift_id', 'left');
        $query = $this->db->get('tbl_debit_notes');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get list of Banks and account numbers
    function get_list_Banks() {
        $this->db->order_by('bank_id', 'desc');
        $this->db->select('tbl_banks.*, tbl_users.name as user');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_banks.user_id', 'left')
                ->where('tbl_banks.deleted', 0);
        $query = $this->db->get('tbl_banks');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get list of Account Numbers
    function get_list_Banks_accountNumber() {
        $this->db->order_by('tbl_banks.name', 'asc');
        $this->db->select('tbl_banks_account_number.*, tbl_banks.name as bank');
        $this->db->join('tbl_banks', 'tbl_banks.bank_id = tbl_banks_account_number.bank_id', 'left')
                ->where('tbl_banks.deleted', 0)
                ->where('tbl_banks_account_number.deleted', 0);
        $query = $this->db->get('tbl_banks_account_number');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get Bank by Bank ID
    function getBankByID($bank_id = NULL) {
        $this->db->select('tbl_banks.name, bank_id')
                ->where('tbl_banks.deleted', 0)
                ->where('tbl_banks.bank_id', $bank_id);
        $query = $this->db->get('tbl_banks');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Get Account Numbers BY Account Number ID
    function getAccountNumberByID($account_number_id = null) {
        $this->db->select('tbl_banks_account_number.*')
                ->where('tbl_banks_account_number.deleted', 0)
                ->where('tbl_banks_account_number.account_number_id', $account_number_id);
        $query = $this->db->get('tbl_banks_account_number');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

}

?>