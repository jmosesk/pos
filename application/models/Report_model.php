<?php
class Report_model extends CI_Model {
	
	private $tbl_user= 'tbl_products';
	
	function __construct(){
		parent::__construct();
	}
	
//Get Stock Transfers Report
	function stockTransferReport(){
		$this->db->order_by('transfer_id', 'desc');
		$this->db->select('	tbl_stock_transfers.transfer_id, tbl_stock_transfers.datetime, tbl_stock_transfers.transfer_type, tbl_users.name as employee, tbl_stock_transfers.dispatch_store_id,
							tbl_stock_transfers.recieving_store_id, tbl_shifts.shift_date, tbl_shifts_names.name as shift_name, tbl_items.item_name, tbl_stock_transfers_items.quantity,
							dispatch_fuel_store.store_name AS dispatch_tank, recieving_fuel_store.store_name AS recieving_tank,');
		$this->db->join('tbl_users', 'tbl_users.user_id = tbl_stock_transfers.employee_id', 'left');
		$this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_stock_transfers.shift_id', 'left');
		$this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
		$this->db->join('tbl_stock_transfers_items', 'tbl_stock_transfers_items.stock_transfer_id = tbl_stock_transfers.transfer_id', 'left');
		$this->db->join('tbl_items', 'tbl_items.item_id = tbl_stock_transfers_items.item_id', 'left');
		$this->db->join('tbl_stores as dispatch_fuel_store', 'dispatch_fuel_store.store_id = tbl_stock_transfers.dispatch_store_id', 'left');
		$this->db->join('tbl_stores as recieving_fuel_store', 'recieving_fuel_store.store_id = tbl_stock_transfers.recieving_store_id', 'left');
       	$query = $this->db->get('tbl_stock_transfers');
		if($query->num_rows() > 0){
    		return $query;
		} else {
			return null;
		}
	}

	function creditReport() {
		$this->db->order_by('tbl_sales.datetime', 'desc');
		$this->db->select('tbl_users.name as cashier, tbl_sales.datetime, payment_type, total_amount');
		$this->db->join('tbl_users', 'tbl_users.user_id = tbl_sales.user_id', 'left')
					->where('payment_type != ', 'Cash');
       	return $this->db->get('tbl_sales');
	}

	function mpesa_statement($post) {
    $date_array = explode(" - ", $post['dateTo']);
    if($post['dateTo']) {
        $from_date = "DATE(tbl_shifts.shift_date) >= '" . date("Y-m-d", strtotime($date_array[0])) . "' AND DATE(tbl_shifts.shift_date) <= '" . date("Y-m-d", strtotime($date_array[1])) . "'";
        $this->db->where($from_date);
    }
		$this->db->order_by('tbl_sales.datetime', 'desc')
						->select('tbl_users.name as cashier, total_amount, CONCAT(DATE_FORMAT(tbl_shifts.shift_date, "%d-%m-%Y"), " &nbsp; ", tbl_shifts_names.name) as shift_date, ref_number')
						->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_mpesa .sales_id', 'left')
						->join('tbl_users', 'tbl_users.user_id = tbl_sales.user_id', 'left')
						->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_sales.shift_id', 'left')
						->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
						->where('payment_type', 'Mpesa')->where('tbl_sales.status', 0);
    $result =  $this->db->get('tbl_sales_mpesa ')->result_array();
		return array('data' => $result);
	}


	function creditReport_detailed() {
//customers
		/*$this->db->order_by('tbl_sales.datetime', 'desc');
		$this->db->select('tbl_sales.payment_type,  tbl_users.name as cashier, tbl_sales.datetime, total_amount, tbl_sales.total_amount');
		$this->db->join('tbl_sales_card', 'tbl_sales_card.sales_id = tbl_sales.sales_id', 'left')
							->join('tbl_sales_invoice', 'tbl_sales_invoice.sales_id = tbl_sales.sales_id', 'left')
							->join('tbl_sales_mpesa', 'tbl_sales_mpesa.sales_id = tbl_sales.sales_id', 'left')
					->where('payment_type != ', 'Cash');
       	return $this->db->get('tbl_sales');*/

//cashier
		/*$this->db->order_by('tbl_sales.datetime', 'desc');
		$this->db->select('tbl_sales.payment_type, tbl_sales.datetime, tbl_sales.shift_id, SUM(tbl_sales_items.total) as total_amount, tbl_sales_items.item_id, tbl_items.item_name as item, tbl_centres.centre_name, sales_product_id, tbl_sales_items.sales_id')
							->join('tbl_sales_items', 'tbl_sales_items.centre_id = tbl_assigned_centres.centre_id', 'left')
        			->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left')
							->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id', 'left')
							->join('tbl_sales_card', 'tbl_sales_card.sales_id = tbl_sales.sales_id', 'left')
							->join('tbl_sales_invoice', 'tbl_sales_invoice.sales_id = tbl_sales.sales_id', 'left')
							->join('tbl_sales_mpesa', 'tbl_sales_mpesa.sales_id = tbl_sales.sales_id', 'left')
        			->join('tbl_centres', 'tbl_centres.centre_id = tbl_assigned_centres.centre_id', 'left')
							->where('payment_type != ', 'Cash')->where('tbl_sales.shift_id', 73)->where('tbl_assigned_centres.shift_id', 73)
							->group_by('tbl_sales.sales_id')->group_by('tbl_sales_items.item_id');
       	return $this->db->get('tbl_assigned_centres')->result_array();*/

		$this->db->order_by('tbl_sales.datetime', 'desc');
		$this->db->select('tbl_sales.payment_type, tbl_sales.datetime, tbl_sales.shift_id, SUM(tbl_sales_items.total) as total_amount,
											tbl_users.name as cashier, tbl_shifts_names.name as shift_name, tbl_shifts.shift_date')
							->join('tbl_sales_items', 'tbl_sales_items.centre_id = tbl_assigned_centres.centre_id', 'left')
        			->join('tbl_sales', 'tbl_sales.sales_id = tbl_sales_items.sales_id', 'left')
							->join('tbl_sales_card', 'tbl_sales_card.sales_id = tbl_sales.sales_id', 'left')
							->join('tbl_sales_invoice', 'tbl_sales_invoice.sales_id = tbl_sales.sales_id', 'left')
							->join('tbl_sales_mpesa', 'tbl_sales_mpesa.sales_id = tbl_sales.sales_id', 'left')
							->join('tbl_users', 'tbl_users.user_id = tbl_assigned_centres.employee_id', 'left')
							->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_assigned_centres.shift_id', 'left')
							->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
							->where('payment_type != ', 'Cash')
							->where('tbl_sales.shift_id', 73)
							->where('tbl_assigned_centres.shift_id', 73)
							->group_by('tbl_sales.shift_id')->group_by('tbl_assigned_centres.employee_id');
       	return $this->db->get('tbl_assigned_centres')->result_array();
	}

	function debitReport() {
		
	}

	function expenseReport() {
		
	}

	function salesReport() {
		$this->db->order_by('tbl_sales.sales_id', 'desc');
		$this->db->select('tbl_sales.datetime, payment_type, tbl_users.name as employee,
							tbl_sales_items.quantity_sold, tbl_sales_items.unit_price, tbl_items.item_name');
		$this->db->join('tbl_users', 'tbl_users.user_id = tbl_sales.user_id', 'left');
		$this->db->join('tbl_sales_items', 'tbl_sales_items.sales_id = tbl_sales.sales_id', 'left');
		$this->db->join('tbl_items', 'tbl_items.item_id = tbl_sales_items.item_id', 'left');
       	return $this->db->get('tbl_sales');
	}
	
//Get Purchase Report
	function purchaseReport() {
		$this->db->order_by('tbl_receivings.receiving_id', 'desc');
		$this->db->select('tbl_receivings.receiving_id, tbl_receivings.datetime, tbl_receivings.type, tbl_shifts_names.name as shift_name, tbl_shifts.shift_date, tbl_users.name as employee,
							tbl_recieving_items_fuel.recieving_quantity as fuel_recieving_quantity, tbl_recieving_items_fuel.item_unit_price, tbl_recieving_items.recieving_quantity as quantity,
							tbl_recieving_items.item_unit_price as unit_price, tbl_items.item_name, fuel_items.item_name as fuel_name');
		$this->db->join('tbl_users', 'tbl_users.user_id = tbl_receivings.employee_id', 'left');
		$this->db->join('tbl_recieving_items_fuel', 'tbl_recieving_items_fuel.recieving_id = tbl_receivings.receiving_id', 'left');
		$this->db->join('tbl_recieving_items', 'tbl_recieving_items.recieving_id = tbl_receivings.receiving_id', 'left');
		$this->db->join('tbl_items', 'tbl_items.item_id = tbl_recieving_items.item_id', 'left');
		$this->db->join('tbl_items as fuel_items', 'fuel_items.item_id = tbl_recieving_items_fuel.item_id', 'left');
		$this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_receivings.shift_id', 'left');
		$this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
       	return $this->db->get('tbl_receivings');
	}
	
//Get Meter Movement Report
	function meterMovementReport($shift_id){
		$this->db->order_by('tbl_close_shift_fuels.close_shift_fuel_id', 'desc');
		$this->db->select('tbl_close_shift_fuels.datetime, tbl_close_shift_fuels.opening_electronic_cash_reading as opening_cash, tbl_close_shift_fuels.opening_electronic_meter_reading as opening_electronic, 
							tbl_close_shift_fuels.opening_manual_meter_reading as opening_manual, tbl_close_shift_fuels.closing_electronic_cash_reading as closing_cash ,
							tbl_close_shift_fuels.closing_electronic_meter_reading as closing_electronic , tbl_close_shift_fuels.closing_manual_meter_reading as closing_manual ,
							tbl_close_shift_fuels.variance_ltrs ,tbl_close_shift_fuels.variance_electronic_reading ,tbl_close_shift_fuels.variance_manual_reading, tbl_shifts_names.name as shift_name, 
							tbl_shifts.shift_date, tbl_users.name as employee, tbl_pumps.name as pump_name, tbl_centres.centre_name');
		$this->db->join('tbl_users', 'tbl_users.user_id = tbl_close_shift_fuels.employee_id', 'left');
		$this->db->join('tbl_pumps', 'tbl_pumps.pump_id = tbl_close_shift_fuels.pump_id', 'left');
		$this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_close_shift_fuels.centre_id', 'left');
		$this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.centre_id', 'left');
		$this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
		$this->db->where('tbl_close_shift_fuels.shift_id', $shift_id);
       	return $this->db->get('tbl_close_shift_fuels');
	}
	
//Get List of Closed Shifts
	function get_list_closed_fuel_shifts(){
		$this->db->order_by('shift_id', 'desc');
		$this->db->select('tbl_close_shift_fuels.shift_id, tbl_shifts.shift_date, tbl_shifts.datetime, tbl_shifts_names.name as shift_name');
		$this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.shift_id', 'left');
		$this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
		$this->db->group_by('tbl_close_shift_fuels.shift_id');
       	return $this->db->get('tbl_close_shift_fuels');
	}

//Get List of Closed Shifts and Centres
	function get_list_closed_shifts_centres(){
		$this->db->order_by('tbl_close_shift_fuels.shift_id', 'desc');
		$this->db->select('tbl_shifts.shift_date, tbl_shifts_names.name as shift_name, tbl_close_shift_fuels.centre_id, tbl_close_shift_fuels.shift_id, tbl_centres.centre_name,
							tbl_close_shift_fuels.datetime, tbl_close_shift_fuels.opening_electronic_cash_reading as opening_cash, tbl_close_shift_fuels.opening_electronic_meter_reading as opening_electronic, 
							tbl_close_shift_fuels.opening_manual_meter_reading as opening_manual, tbl_close_shift_fuels.closing_electronic_cash_reading as closing_cash ,
							tbl_close_shift_fuels.closing_electronic_meter_reading as closing_electronic , tbl_close_shift_fuels.closing_manual_meter_reading as closing_manual ,
							tbl_close_shift_fuels.variance_ltrs ,tbl_close_shift_fuels.variance_electronic_reading ,tbl_close_shift_fuels.variance_manual_reading');
		$this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_fuels.shift_id', 'left');
		$this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
		$this->db->join('tbl_centres', 'tbl_centres.centre_id = tbl_close_shift_fuels.centre_id', 'left');
		$this->db->group_by('centre_id');
		$this->db->group_by('shift_id');
       	return $this->db->get('tbl_close_shift_fuels');
	}

//Get list of Customer Payments
	function get_list_customerPayments(){
		$this->db->order_by('payment_id', 'desc');
		$this->db->select('tbl_customer_payments.*, tbl_users.name as employee, tbl_persons.name as customer');
		$this->db->join('tbl_users', 'tbl_users.user_id = tbl_customer_payments.user_id', 'left');
		$this->db->join('tbl_persons', 'tbl_persons.person_id = tbl_customer_payments.customer_id', 'left');
       	$query = $this->db->get('tbl_customer_payments');
       	if($query->num_rows() > 0){
    		return $query;
		} else {
			return null;
		}
	}

//Save Stock Variation
  function saveVariation($variation)
  {
    $this->db->insert('tbl_stock_variation', $variation);
	return $this->db->insert_id();
  }

//Save Stock Variation Items
  function saveVariationItems($variationItems)
  {
    $this->db->insert('tbl_stock_variation_items', $variationItems);
	return $this->db->insert_id();
  }
  
//Save Stock Valuation
  function saveValuation($variation)
  {
    $this->db->insert('tbl_stock_valuation', $variation);
	return $this->db->insert_id();
  }

//Save Stock Valuation Items
  function saveValuationItems($variationItems)
  {
    $this->db->insert('tbl_stock_valuation_items', $variationItems);
	return $this->db->insert_id();
  }
  
//Get List Stock Variations
	function get_list_stockVariations(){
		$this->db->order_by('tbl_stock_variation.variation_id', 'desc');
		$this->db->select('tbl_stock_variation.variation_id, tbl_stock_variation.datetime, tbl_users.name as employee,
							tbl_shifts.shift_date, tbl_shifts_names.name as shift_name');
		$this->db->join('tbl_users', 'tbl_users.user_id = tbl_stock_variation.employee_id', 'left');
		$this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_stock_variation.shift_id', 'left');
		$this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
       	return $this->db->get('tbl_stock_variation');
	}
	
//Get List Stock Variations
	function VariationByStoreID($store_id, $variation_id){
		$this->db->order_by('item_name', 'asc');
		$this->db->select('	tbl_stock_variation_items.book_stock, tbl_stock_variation_items.physical_stock, tbl_stock_variation_items.variation, 
							tbl_items.item_name, tbl_items.item_id, tbl_products_category_type.name as category');
		$this->db->join('tbl_items', 'tbl_items.item_id = tbl_stock_variation_items.item_id', 'left');
		$this->db->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left');
		$this->db->join('tbl_products_category_type', 'tbl_products_category_type.type_id = tbl_products.category_id', 'left');
		$this->db->where('tbl_stock_variation_items.store_id', $store_id);
		$this->db->where('MD5(tbl_stock_variation_items.stock_variation_id)', $variation_id);
       	return $this->db->get('tbl_stock_variation_items');
	}
	
//Get List Stock Variations By Variation ID
	function get_list_StoresVariationID($variation_id){
		$this->db->order_by('tbl_stores.store_name', 'asc');
		$this->db->select('tbl_stock_variation_items.store_id, tbl_stores.store_name');
		$this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_stock_variation_items.store_id', 'left');
		$this->db->where('MD5(tbl_stock_variation_items.stock_variation_id)', $variation_id);
		$this->db->group_by('tbl_stock_variation_items.store_id');
       	return $this->db->get('tbl_stock_variation_items');
	}
		
//Get List Stock Valuations
	function get_list_Valuation() {
		$result_array = array();
		$white_products = $this->db->select("tbl_items.item_name, unit_price, SUM(IFNULL(tbl_fuel_stores.last_dipping, 0)) as quantity, tbl_tax_type.value as tax")
							->join('tbl_fuel_stores', 'tbl_fuel_stores.item_id = tbl_items.item_id', 'left')
							->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left')
							->where('item_type', 1)->where('tbl_items.deleted', 0)
							->group_by('tbl_items.item_id')
							->get('tbl_items')->result_array();
		$result_array["white_products"] = $white_products;
		$this->db->select('tbl_products_category_type.name as product_type, type_id as category_id')->where('deleted', 0);
		$non_fuel = $this->db->get('tbl_products_category_type')->result_array();
		foreach($non_fuel as $prod) {
			$this->db->select("tbl_items.item_name, SUM(IFNULL(`quantity_store`, 0) + IFNULL(`quantity_fourcourt`, 0)) AS `quantity`, unit_price, tbl_tax_type.value as tax")
						->join('tbl_items','tbl_items.item_id = tbl_products.item_id', 'left')
						->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_items.tax_id', 'left')
						->where('category_id', $prod['category_id'])->where('tbl_items.deleted', 0)
						->group_by('tbl_products.item_id');
			$result_array[$prod['category_id']] = $this->db->get('tbl_products')->result_array();
		}

    return array('stores' => $non_fuel, 'data' => $result_array, 'white_products' => $white_products);
	}
	
//Get List Stores for Valuations By Valuation ID
	function get_list_StoresValuationID($valuation_id){
		$this->db->order_by('tbl_stores.store_name', 'asc');
		$this->db->select('tbl_stock_valuation_items.store_id, tbl_stores.store_name');
		$this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_stock_valuation_items.store_id', 'left');
		$this->db->where('MD5(tbl_stock_valuation_items.stock_valuation_id)', $valuation_id);
		$this->db->group_by('tbl_stock_valuation_items.store_id');
       	return $this->db->get('tbl_stock_valuation_items');
	}

//Get List Stock Valuations By Valuation ID and Store ID
	function ValuationByStoreID($store_id, $valuation_id){
		$this->db->order_by('item_name', 'asc');
		$this->db->select('tbl_stock_valuation_items.quantity, tbl_stock_valuation_items.unit_price, tbl_stock_valuation_items.gross_price,
							tbl_stock_valuation_items.net_price, tbl_items.item_name, tbl_items.item_id, tbl_products_category_type.name as category');
		$this->db->join('tbl_items', 'tbl_items.item_id = tbl_stock_valuation_items.item_id', 'left');
		$this->db->join('tbl_products', 'tbl_products.item_id = tbl_items.item_id', 'left');
		$this->db->join('tbl_products_category_type', 'tbl_products_category_type.type_id = tbl_products.category_id', 'left');
		$this->db->where('tbl_stock_valuation_items.store_id', $store_id);
		$this->db->where('MD5(tbl_stock_valuation_items.stock_valuation_id)', $valuation_id);
       	return $this->db->get('tbl_stock_valuation_items');
	}
}
?>