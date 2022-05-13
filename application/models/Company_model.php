<?php

class Company_model extends CI_Model {

    private $tbl_user = 'tbl_companies';

    function __construct() {
        parent::__construct();
    }

    function list_all() {
        $this->db->order_by('grid_id', 'asc');
        return $this->db->get('tbl_grids');
    }

    function get_list_employees() {
        $this->db->order_by('name', 'asc');
        return $this->db->get('tbl_users');
    }

    function get_list_employee_station() {
        $this->db->order_by('tbl_employees.name', 'asc');
        $this->db->select('tbl_employees.emp_id, tbl_employees.name, tbl_employees.status');
        $this->db->join('tbl_employees', 'tbl_employees.emp_id = tbl_close_shift_debit_user.user_id', 'left');
        $this->db->where('tbl_employees.status', 1)->group_by('tbl_close_shift_debit_user.user_id');
        $query = $this->db->get('tbl_close_shift_debit_user');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_list_employees_active() {
        $this->db->order_by('name', 'asc');
        $this->db->where('status', 1);
        return $this->db->get('tbl_users');
    }

    function get_list_company() {
        return $this->db->select('tbl_companies.*, a.name as reading_method')
                        ->join('tbl_shift_reading_method a', 'a.reading_id = tbl_companies.reading_method', 'left')
                        ->get('tbl_companies');
    }

    function get_list_expenses() {
        return $this->db->select('tbl_petty_cash_categories.*, tbl_chartmaster.accountname, tbl_tax_type.name as tax')
                        ->join('tbl_chartmaster', 'tbl_chartmaster.accountcode = tbl_petty_cash_categories.glaccount')
                        ->join('tbl_tax_type', 'tbl_tax_type.type_id = tbl_petty_cash_categories.taxcatid')
                        ->where('deleted', 0)->get('tbl_petty_cash_categories');
    }

    function get_list_all_expenses() {
        return $this->db->order_by('tbl_petty_cash_expenses.id', 'desc')
                        ->select('total, vendor_name, reason, tbl_users.name as employee, tbl_shifts_names.name as shift_name, tbl_shifts.shift_date')
                        ->join('tbl_users', 'tbl_users.user_id = tbl_petty_cash_expenses.cashier', 'left')
                        ->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_petty_cash_expenses.shift_id', 'left')
                        ->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left')
                        ->where('approved', 1)->get('tbl_petty_cash_expenses')->result_array();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_user);
    }

    function get_paged_list($limit = 10, $offset = 0) {
        $this->db->order_by('id', 'asc');
        return $this->db->get($this->tbl_user, $limit, $offset);
    }

    function get_by_id($id) {
        $this->db->where('company_id', $id);
        return $this->db->get('tbl_companies');
    }

    function update($id, $user) {
        $this->db->where('company_id', $id);
        $this->db->update($this->tbl_user, $user);
    }

    function updateRates($id, $user) {
        $this->db->where('rate_id', $id);
        $this->db->update('tbl_rates', $user);
    }

    function save($admin) {
        $this->db->insert($this->tbl_user, $admin);
        return $this->db->insert_id();
    }

    function sec($admin) {
        $this->db->insert($this->tbl_user, $admin);
        return $this->db->insert_id();
    }

    function get_customers($category_id = null) {
        $this->db->order_by('company_name', 'asc');
        $this->db->select('tbl_customers.company_name, tbl_persons.name, tbl_customers.person_id, customer_id');
        $this->db->join('tbl_customer_category', 'tbl_customer_category.category_id = tbl_customers.customer_category_id', 'left');
        $this->db->join('tbl_persons', 'tbl_persons.person_id = tbl_customers.person_id', 'left');
        if ($category_id != null)
            $this->db->where('customer_category_id', 1);
        $this->db->where('tbl_persons.deleted', 0);
        $query = $this->db->get('tbl_customers');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            
            return NULL;
    }
      function get_suppliers($category_id = null) {
        $this->db->order_by('company_name', 'asc');
        $this->db->select('tbl_suppliers.company_name, tbl_persons.name, tbl_suppliers.person_id, supplier_id');       
        $this->db->join('tbl_persons', 'tbl_persons.person_id = tbl_suppliers.person_id', 'left');
        if ($category_id != null)
            $this->db->where('customer_category_id', 1);
        $this->db->where('tbl_persons.deleted', 0);
        $query = $this->db->get('tbl_suppliers');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_customer_opening_balances() {
        $this->db->order_by('tbl_persons.name', 'asc');
        $this->db->select('tbl_persons.name, tbl_persons.phone_number, tbl_persons.status, tbl_customers.customer_id');
        $this->db->join('tbl_customers', 'tbl_customers.customer_id = tbl_customers_transactions.customer_id', 'left')
                ->join('tbl_persons', 'tbl_persons.person_id = tbl_customers.person_id', 'left');
        $this->db->where('tbl_persons.deleted', 0)->where('tbl_customers_transactions.transaction_type', 6)
                ->group_by('tbl_customers_transactions.customer_id');
        $query = $this->db->get('tbl_customers_transactions')->result_array();
        $customer_array = array();
        foreach ($query as $customer) {
            $customer_array[] = $customer['customer_id'];
        }
        $opening_array = array();
        $closing_array = array();
        $date_array = array();
        if (count($customer_array) > 0) {
            $this->db->order_by('tbl_customers_transactions.customer_transaction_id', 'asc');
            $this->db->select('tbl_customers_transactions.bbf as opening_balance, tbl_customers_transactions.customer_id')
                    ->where_in('tbl_customers_transactions.customer_id', $customer_array)
                    ->group_by('tbl_customers_transactions.customer_id');
            $results = $this->db->get('tbl_customers_transactions')->result_array();
            foreach ($results as $value) {
                $opening_array[$value['customer_id']] = $value['opening_balance'];
            }
            $this->db->select('a.bbf as closing_balance, a.customer_id, DATE_FORMAT(a.datetime, "%d-%b-%Y") as datetime')
                    ->where_in('a.customer_transaction_id', "(SELECT MAX(customer_transaction_id) FROM tbl_customers_transactions GROUP BY customer_id)", false);
            $closing = $this->db->get('tbl_customers_transactions a')->result_array();
            foreach ($closing as $value) {
                $closing_array[$value['customer_id']] = $value['closing_balance'];
            }
            foreach ($closing as $value) {
                $date_array[$value['customer_id']] = $value['datetime'];
            }
        }
        return array('customers' => $query, 'opening_data' => $opening_array, 'closing_data' => $closing_array, 'date_data' => $date_array);
    }

    function get_list_customer($category_id = null) {
        $this->db->order_by('tbl_persons.name', 'asc');
        $this->db->select('tbl_persons.person_id, tbl_persons.name, tbl_persons.phone_number, tbl_persons.email, tbl_persons.address, tbl_persons.pin, tbl_persons.county, tbl_persons.status, tbl_customers.company_name, tbl_customers.balance, tbl_customers.customer_category_id, tbl_customers.credit_limit, tbl_customer_category.category_name, customer_id');
        $this->db->join('tbl_persons', 'tbl_persons.person_id = tbl_customers.person_id', 'left');
        $this->db->join('tbl_customer_category', 'tbl_customer_category.category_id = tbl_customers.customer_category_id', 'left');
        if ($category_id != null)
            $this->db->where('customer_category_id', 1);
        $this->db->where('tbl_persons.deleted', 0);
        $query = $this->db->get('tbl_customers');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_list_customer_station() {
        $this->db->order_by('tbl_persons.name', 'asc');
        $this->db->select('tbl_persons.person_id, tbl_persons.name, tbl_persons.phone_number, tbl_persons.email, tbl_persons.address, tbl_persons.pin, tbl_persons.county, tbl_persons.status, tbl_customers.company_name, tbl_customers.balance, tbl_customers.customer_category_id, tbl_customers.credit_limit, tbl_customer_category.category_name, customer_id');
        $this->db->join('tbl_persons', 'tbl_persons.person_id = tbl_customers.person_id', 'left');
        $this->db->join('tbl_customer_category', 'tbl_customer_category.category_id = tbl_customers.customer_category_id', 'left');
       // $this->db->where('customer_category_id', 1);
        $this->db->where('tbl_persons.deleted', 0);
        $query = $this->db->get('tbl_customers');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    } 

    function get_customer_by_category($category_id = null) {
        $this->db->order_by('tbl_persons.name', 'asc');
        $this->db->select('tbl_persons.person_id, tbl_persons.name, tbl_persons.phone_number, tbl_persons.email, tbl_persons.county, tbl_persons.status, tbl_customers.company_name, tbl_customers.balance, tbl_customers.customer_category_id, tbl_customers.credit_limit, tbl_customer_category.category_name, customer_id');
        $this->db->join('tbl_persons', 'tbl_persons.person_id = tbl_customers.person_id', 'left');
        $this->db->join('tbl_customer_category', 'tbl_customer_category.category_id = tbl_customers.customer_category_id', 'left');
        if ($category_id != null)
            $this->db->where('customer_category_id', $category_id);
        $this->db->where('tbl_persons.deleted', 0);
        $query = $this->db->get('tbl_customers');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_list_custcards() {
        $this->db->order_by('tbl_persons.name', 'asc');
        $this->db->select('tbl_persons.person_id, tbl_persons.name, tbl_persons.phone_number, tbl_persons.email, tbl_persons.county, tbl_persons.status, tbl_customers.company_name, tbl_customers.balance, tbl_customers.customer_category_id, tbl_customers.credit_limit, tbl_customer_category.category_name, customer_id');
        $this->db->join('tbl_persons', 'tbl_persons.person_id = tbl_customers.person_id', 'left');
        $this->db->join('tbl_customer_category', 'tbl_customer_category.category_id = tbl_customers.customer_category_id', 'left');
        $this->db->where('tbl_persons.deleted', 0);
        $this->db->where('tbl_customer_category.category_id', 2);
        return $this->db->get('tbl_customers')->result();
    }

    function get_list_custcards_pay() {
        $this->db->order_by('tbl_persons.name', 'asc');
        $this->db->select('tbl_persons.person_id, tbl_persons.name, tbl_persons.phone_number, tbl_persons.email, tbl_persons.county, tbl_persons.status, tbl_customers.company_name, tbl_customers.balance, tbl_customers.customer_category_id, tbl_customers.credit_limit, tbl_customer_category.category_name, customer_id');
        $this->db->join('tbl_persons', 'tbl_persons.person_id = tbl_customers.person_id', 'left');
        $this->db->join('tbl_customer_category', 'tbl_customer_category.category_id = tbl_customers.customer_category_id', 'left');
        $this->db->where('tbl_persons.deleted', 0);
        $this->db->where('tbl_customer_category.category_id', 2);
        $query = $this->db->get('tbl_customers');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_customers_vehicles_id($id = null) {
        $this->db->order_by('registration_number', 'asc')
                ->select('tbl_customers_vehicles.registration_number, vehicle_id')
                ->where('tbl_customers_vehicles.deleted', 0)
                ->where('tbl_customers_vehicles.customer_id', $id);
        $query = $this->db->get('tbl_customers_vehicles');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return array();
    }

    function get_customers_vehicles($id = null) {
        $this->db->order_by('tbl_persons.name', 'asc')
                ->select('tbl_persons.name, tbl_customers.company_name, tbl_customers_vehicles.registration_number, tbl_customers_vehicles.description, vehicle_id, tbl_customers_vehicles.status, vehicle_id, tbl_customers_vehicles.customer_id')
                ->join('tbl_customers', 'tbl_customers.customer_id = tbl_customers_vehicles.customer_id', 'left')
                ->join('tbl_persons', 'tbl_persons.person_id = tbl_customers.person_id', 'left')
                ->where('tbl_persons.deleted', 0)
                ->where('tbl_customers_vehicles.deleted', 0);
        if ($id != null)
            $this->db->where('tbl_customers_vehicles.vehicle_id', $id);
        //$this->db->where('tbl_customers_vehicles.category_id', 2);
        $query = $this->db->get('tbl_customers_vehicles');
        //print_r($query->num_rows());
        if ($query->num_rows() > 0)
            return $query;
        else
            return NULL;
    }

    function get_list_countries() {
        return $this->db->get("countries")->result();
    }

    function getVehList($id) {
        return $this->db->where("transporter_id", $id)->get("tbl_vehicles")->result();
    }

    function get_list_customer_category() {
        return $this->db->get('tbl_customer_category');
    }

//Save Person
    function savePerson($admin) {
        $this->db->insert('tbl_persons', $admin);
        return $this->db->insert_id();
    }

//Save Customer
    function saveCustomer($admin) {
        $this->db->insert('tbl_customers', $admin);
        return $this->db->insert_id();
    }

//Get Customer By Id
    function get_customer_by_id($id) {
        $this->db->where('tbl_persons.person_id', $id);
        $this->db->select('tbl_persons.person_id, tbl_persons.name, tbl_persons.phone_number, tbl_persons.email, tbl_persons.address, tbl_persons.pin, tbl_persons.county, tbl_persons.status, tbl_customers.company_name,
		tbl_customers.balance, tbl_customers.credit_limit, tbl_customers.customer_category_id, tbl_customers.customer_id, tbl_customer_category.category_name');
        $this->db->join('tbl_persons', 'tbl_persons.person_id = tbl_customers.person_id', 'left');
        $this->db->join('tbl_customer_category', 'tbl_customer_category.category_id = tbl_customers.customer_category_id', 'left');
        return $this->db->get('tbl_customers');
    }
   function get_accounts_by_id($id){
     $this->db->where('tbl_banks_account_number.account_number_id', $id);
     $this->db->select('tbl_banks_account_number.account_number_id, tbl_banks_account_number.account_number, tbl_bankings.bbf');
     $this->db->join('tbl_bankings', 'tbl_bankings.account_number_id = tbl_banks_account_number.account_number_id', 'left');
     return $this->db->get('tbl_banks_account_number');
     
   }

//Update Person by ID
    function updatePerson($id, $user) {
        $this->db->where('person_id', $id);
        $this->db->update('tbl_persons', $user);
    }

//Update Customer by ID
    function updateCustomer($id, $user) {
        $this->db->where('customer_id', $id);
        $this->db->update('tbl_customers', $user);
    }

//Update Customer by ID to DELETED
    function deleteCustomer($id, $user) {
        $this->db->where('person_id', $id);
        $this->db->update('tbl_persons', $user);
    }

//Get List Suppliers
    function get_list_suppliers() {
        $this->db->order_by('tbl_persons.name', 'asc');
        $this->db->select('tbl_persons.person_id, tbl_persons.name, tbl_persons.phone_number, tbl_persons.email, tbl_persons.county, tbl_persons.status, tbl_suppliers.company_name, tbl_suppliers.balance, tbl_suppliers.supplier_id');
        $this->db->join('tbl_persons', 'tbl_persons.person_id = tbl_suppliers.person_id', 'left')
                ->where('tbl_persons.deleted', 0);
        return $this->db->get('tbl_suppliers');
    }

//Save Supplier
    function saveSupplier($admin) {
        $this->db->insert('tbl_suppliers', $admin);
        return $this->db->insert_id();
    }

//Get Supplier By Id
    function get_supplier_by_id($id) {
        $this->db->where('tbl_persons.person_id', $id);
        $this->db->select('tbl_persons.person_id, tbl_persons.name, tbl_persons.phone_number, tbl_persons.email, tbl_persons.county, tbl_persons.status, tbl_suppliers.company_name, tbl_suppliers.balance, tbl_suppliers.supplier_id');
        $this->db->join('tbl_persons', 'tbl_persons.person_id = tbl_suppliers.person_id', 'left');
        $query = $this->db->get('tbl_suppliers');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null;
        }
    }

//Update Supplier by ID
    function updateSupplier($id, $user) {
        $this->db->where('supplier_id', $id);
        $this->db->update('tbl_suppliers', $user);
    }

//Update Supplier by ID to DELETED
    function deleteSupplier($id, $user) {
        $this->db->where('person_id', $id);
        $this->db->update('tbl_persons', $user);
    }

//Get List Vehicles
    function get_list_vehicles() {
        $this->db->order_by('registration_number', 'asc');
        $this->db->select('tbl_vehicles.vehicle_id, tbl_vehicles.registration_number, tbl_vehicles.description, tbl_vehicles.status, tbl_transporters.transporter_name');
        $this->db->join('tbl_transporters', 'tbl_transporters.transporter_id = tbl_vehicles.transporter_id', 'left');
        $this->db->where('tbl_vehicles.deleted', 0);
        return $this->db->get('tbl_vehicles');
    }

//Save Vehicles
    function saveVehicle($admin) {
        $this->db->insert('tbl_vehicles', $admin);
        return $this->db->insert_id();
    }

//Get Vehicles By Id
    function get_vehicle_by_id($id) {
        $this->db->where('tbl_vehicles.vehicle_id', $id);
        $this->db->select('tbl_vehicles.vehicle_id, tbl_vehicles.registration_number, tbl_vehicles.description, tbl_vehicles.status, tbl_transporters.transporter_name, tbl_vehicles.transporter_id');
        $this->db->join('tbl_transporters', 'tbl_transporters.transporter_id = tbl_vehicles.transporter_id', 'left');
        return $this->db->get('tbl_vehicles');
    }

//Update Vehicles by ID
    function updateVehicles($id, $user) {
        $this->db->where('vehicle_id', $id);
        $this->db->update('tbl_vehicles', $user);
    }

//Get List Transporters
    function get_list_transporters() {
        $this->db->order_by('transporter_name', 'asc');
        $this->db->select('tbl_transporters.*');
        $this->db->where('tbl_transporters.deleted', 0);
        return $this->db->get('tbl_transporters');
    }

//Save Transporter
    function saveTransporter($admin) {
        $this->db->insert('tbl_transporters', $admin);
        return $this->db->insert_id();
    }

//Get Transporter By Id
    function get_transporter_by_id($id) {
        $this->db->where('transporter_id', $id);
        $this->db->select('tbl_transporters.*');
        return $this->db->get('tbl_transporters');
    }

//Update Transporter by ID
    function updateTransporter($id, $user) {
        $this->db->where('transporter_id', $id);
        $this->db->update('tbl_transporters', $user);
    }

//Check if Transporter Name exists
    function transporter_name_exists($name) {
        $this->db->where('transporter_name', $name);
        $query = $this->db->get('tbl_transporters');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

//Check if Registration Number exists
    function registration_number($number, $type) {
        if ($type == "customer") {
            $tbl = 'tbl_customers_vehicles';
        } else {
            $tbl = 'tbl_vehicles';
        }
        $this->db->where('registration_number', $number);
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    ######## Added functions - Brian #######

    //delete company information 

    function deleteCompany($id) {
        $this->db->where('company_id', $id);
        $this->db->delete('tbl_companies');
    }

    //delete Transporter information 
    function deleteTransporter($id, $status) {
        $this->db->where('transporter_id', $id);
        $this->db->update('tbl_transporters', $status);
    }

    //delete Transporter information 
    function deleteVehicle($id, $status) {
        $this->db->where('vehicle_id', $id);
        $this->db->update('tbl_vehicles', $status);
    }

}

?>