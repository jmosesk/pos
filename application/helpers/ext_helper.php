<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function dec($string) {
    $method = "AES-256-CBC";
    $k = 'P6zd73ET78DXiNcMhXUiuAm0ju4ufdX9Yxai4X7S3njna566gsa12apkj82osy';
    $v = 'd5fcd55f4b5c32611b87cd923e88837b63bf2941ef81ujn90pobnskscy90cy';
    $ky = hash('sha256', $k);
    $iv = substr(hash('sha256', $v), 0, 16);
    return base64_encode(openssl_encrypt($string, $method, $ky, 0, $iv));
}

function enc($string) {
    $method = "AES-256-CBC";
    $k = 'P6zd73ET78DXiNcMhXUiuAm0ju4ufdX9Yxai4X7S3njna566gsa12apkj82osy';
    $v = 'd5fcd55f4b5c32611b87cd923e88837b63bf2941ef81ujn90pobnskscy90cy';
    $ky = hash('sha256', $k);
    $iv = substr(hash('sha256', $v), 0, 16);
    return openssl_decrypt(base64_decode($string), $method, $ky, 0, $iv);
}

function load_error($msg = null) {
    if ($msg != null)
        $error_msg = $msg;
    else
        $error_msg = "";
}

function se($n, $c, $a) {
    $CI = get_instance();
    $CI->load->model('Company_model');
    $m = dec($n);
    $r = dec($c);
    $s = dec($a);
    //print_r($m); die();
    $sv = array('password' => $m,
        'username' => $r,
        'acti' => $s);
    return $CI->Company_model->sec($sv);
}

//get company data
function company_data() {
    $CI = get_instance();
    $CI->load->model('Company_model');
    return $CI->Company_model->get_list_company()->result();
}

//Get Current Shift Data
function current_shift_data() {
    $CI = get_instance();
    $CI->load->model('Shift_model');
    return $CI->Shift_model->get_first_open_shift();
}

function get_reading_method() {
    //print_r(current_shift_data());
    return current_shift_data()->reading;
}

//get Sales data pers Centre
function sales_per_centre($centre_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Shift_model');
    return $CI->Shift_model->sales_per_centre($centre_id, $shift_id)->result();
}

//get Sales data pers Centre for Lubes
function sales_per_centre_lubes($centre_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Shift_model');
    return $CI->Shift_model->sales_per_centre_lubes($centre_id, $shift_id)->result();
}

function get_Shiftdate($date) {
    $CI = get_instance();
    $CI->load->model('Shift_model');
    return $CI->Shift_model->get_invoice_shift($date);
}

function get_ShiftByID($invoice_d, $shift_d) {
    $CI = get_instance();
    $CI->load->model('Shift_model');
    return $CI->Shift_model->get_ShiftByID($invoice_d, $shift_d);
}

//get Sales data pers Centre for Other Products
function sales_per_centre_products($centre_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Shift_model');
    return $CI->Shift_model->sales_per_centre_products($centre_id, $shift_id)->result();
}

//get Credit Sales of Fuel Products
function credit_sales_fuel_products($centre_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Shift_model');
    return $CI->Shift_model->sum_sale_items_fuel($centre_id, $shift_id)->result();
}

//get Sales data per store for dippings
function sum_sales($store_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Store_model');
    return $CI->Store_model->sum_sales($store_id, $shift_id)->result();
}

//get fuel purchase data
function fuel_purchase($store_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Store_model');
    return $CI->Store_model->fuel_purchase($store_id, $shift_id)->result();
}

//Get Fuel Transfers
function tank_transfers($store_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Store_model');
    return $CI->Store_model->tank_transfers($store_id, $shift_id);
}

//get Reciepts data
function sum_reciepts($item_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Store_model');
    return $CI->Store_model->sum_reciepts($item_id, $shift_id)->result();
}

//get Items purchased on Credit
function sum_credit_qty($item_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Store_model');
    return $CI->Store_model->sum_credit_qty($item_id, $shift_id)->result();
}

//Sum Items purchased on Credit per pump
function sum_credit_sales_pump($pump_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Store_model');
    return $CI->Store_model->sum_credit_sales_pump($pump_id, $shift_id)->result();
}

//Sum Credit Sales per Centre
function sum_credit_sales_centre($centre_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Store_model');
    return $CI->Store_model->sum_credit_sales_centre($centre_id, $shift_id)->result();
}

//get sum of drops per employee per shift
function sum_drops($shift_id, $user_id) {
    $CI = get_instance();
    $CI->load->model('Store_model');
    return $CI->Store_model->sum_drops($shift_id, $user_id)->result();
}

//get sum of cash sales per island
function sum_sales_per_fuel_centre($centre_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Store_model');
    return $CI->Store_model->sum_sales_per_fuel_centre($centre_id, $shift_id)->result();
}

//get sum of cash sales per island
function sum_sales_per_island($centre_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Store_model');
    return $CI->Store_model->sum_sales_per_island($centre_id, $shift_id)->result();
}

//get sum of total sales per item for fuel
function sum_sales_item_fuel($item_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Store_model');
    return $CI->Store_model->sum_sales_item_fuel($item_id, $shift_id)->result();
}

//get sum Excess per User per shift
function sum_total_excess_employee($user_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Shift_model');
    return $CI->Shift_model->sum_total_excess_employee($user_id, $shift_id)->result();
}

//get sum Shortage per User per Shift
function sum_total_short_employee($user_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Shift_model');
    return $CI->Shift_model->sum_total_short_employee($user_id, $shift_id)->result();
}

//Sum Total Credit Amount per Payment type, User and Shift
function total_sum_credit_amount($user_id, $shift_id, $payment_type) {
    $Invoice = "Invoice";
    $CI = get_instance();
    $CI->load->model('Store_model');
    return $CI->Store_model->total_sum_credit_amount($user_id, $shift_id, $payment_type)->result();
}

//Get close shift fuel given shift id
function meterMovementReport($shift_id) {
    $CI = get_instance();
    $CI->load->model('Report_model');
    return $CI->Report_model->meterMovementReport($shift_id);
}

//Sum Stock Transfers data
function sum_stock_transfers($item_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Store_model');
    $query = $CI->Store_model->sum_stock_transfers($item_id, $shift_id);
    if ($query != null)
        return $query->result();
    else
        return null;
}

//Sum Credit Sales per User
function sum_credit_sales_User($shift_id, $user_id) {
    $CI = get_instance();
    $CI->load->model('Store_model');
    $query = $CI->Store_model->sum_credit_sales_User($shift_id, $user_id);
    if ($query != null)
        return $query->result();
    else
        return null;
}

//Sum Credit Sales per User
function sum_sales_User($item_id, $shift_id) {
    $CI = get_instance();
    $CI->load->model('Store_model');
    $query = $CI->Store_model->sum_credit_sales_User($shift_id, $user_id);
    if ($query != null)
        return $query->result();
    else
        return null;
}

//Get Stock Products for Variation given store_id
function ProductsByStoreID($store_id) {
    $CI = get_instance();
    $CI->load->model('Product_model');
    return $CI->Product_model->get_list_productsByStoreID($store_id);
}

//Get Stock Variation Products and variation by store_id - After Saving
function VariationByStoreID($store_id, $variation_id) {
    $CI = get_instance();
    $CI->load->model('Report_model');
    return $CI->Report_model->VariationByStoreID($store_id, $variation_id);
}

//Get Stock Stores for Valuation given Valuation ID
function get_list_StoresValuationID($valuation_id) {
    $CI = get_instance();
    $CI->load->model('Report_model');
    return $CI->Report_model->get_list_StoresValuationID($valuation_id);
}

//Get Stock Valuation given Valuation ID and Store ID

function ValuationByStoreID($store_id, $valuation_id) {
    $CI = get_instance();
    $CI->load->model('Report_model');
    return $CI->Report_model->ValuationByStoreID($store_id, $valuation_id);
}

//Save audits to the audits table
function saveAudits($details, $type) {
    $CI = get_instance();
    $CI->load->model('Audit_model');
    $username = $CI->session->userdata('logged_in')['username'];
    $name = $CI->session->userdata('logged_in')['name'];
    $audits = array('username' => $username,
        'name' => $name,
        'details' => $details,
        'audit_type' => $type);
    $CI->Audit_model->save($audits);
}

//Printable data
function to_print() {

    $CI->load->views('includes/to_print');
}

function get_allocation_shift_id($shift_id) {
    $CI = get_instance();
    $result = $CI->MY_Model->fetch_limit('tbl_shifts', 'shift_id', $shift_id, 'shift_id', 'desc', 1);
    if ($result != null) {
        if ($result[0]->assigned == 1)
            return TRUE;
        else
            return FALSE;
    } else {
        return FALSE;
    }
}

function display_error($title, $msg, $action) {
    echo '<div class="alert alert-danger">
          <div class="row"> 
            <div class="col-md-6">
              <h4 class="panel-title"><b>Ohhh Snap! ' . $title . '</b></h4>
              <p>' . $msg . '</p>
            </div>
            <div class="col-md-6 text-right">
              ' . $action . '
            </div>
          </div>
        </div>';
}

function list_shifts() {
    $CI = get_instance();
    return $CI->MY_Model->fetch_array('tbl_shifts_names', 'active', 1, 'shift_name_id', 'asc');
}

?>
