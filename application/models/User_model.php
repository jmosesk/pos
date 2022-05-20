<?php

class User_model extends CI_Model {

    private $tbl_user = 'tbl_users';

    function __construct() {
        parent::__construct();
    }

    function login($username, $password) {
        $this->db->select('tbl_users.user_id as user_id, username, password, name, role_id, status');
        $this->db->from('tbl_users');
        $this->db->where('username', $username);
        $this->db->where('password = ' . "'" . MD5($password) . "'");
        $this->db->where('status', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
            return $query->result();
        else
            return false;
    }

    function get_list($search = null) {

        $this->db->order_by('name', 'asc');
        $this->db->select('tbl_users.*, tbl_roles.name as role_name, tbl_user_titles.name as title');
        $this->db->join('tbl_roles', 'tbl_roles.role_id = tbl_users.role_id', 'left');
        $this->db->join('tbl_user_titles', 'tbl_user_titles.user_title_id = tbl_users.title_id', 'left');
        if ($search == null) {
            return $this->db->get('tbl_users');
        } else {
            $where = "tbl_users.name LIKE '%" . $search . "%' OR tbl_roles.name LIKE '%" . $search . "%' OR tbl_users.username LIKE '%" . $search . "%'";
            $this->db->where($where);
            return $this->db->get('tbl_users');
        }
    }

    function get_list_title() {
        $this->db->order_by('name', 'asc');
        $this->db->select('tbl_user_titles.user_title_id, tbl_user_titles.name');
        return $this->db->get('tbl_user_titles');
    }

//Get list of Users with Shortage
    function get_list_employee_shortage() {
        $this->db->order_by('transaction_id', 'desc');
        $this->db->select('tbl_employee_shortage.*, tbl_transactions.transaction_type, tbl_shifts.shift_date, tbl_shifts_names.name as shift_name, tbl_users.name as user');
        $this->db->join('tbl_transactions', 'tbl_transactions.transaction_id = tbl_employee_shortage.transaction_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_transactions.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_employee_shortage.employee_id', 'left');
        return $this->db->get('tbl_employee_shortage');
    }

//Get List of Users with excess
    function get_list_employee_excess() {
        $this->db->order_by('transaction_id', 'desc');
        $this->db->select('tbl_employee_excess.*, tbl_transactions.transaction_type, tbl_shifts.shift_date, tbl_shifts_names.name as shift_name, tbl_users.name as user');
        $this->db->join('tbl_transactions', 'tbl_transactions.transaction_id = tbl_employee_excess.excess_id', 'left');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_transactions.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_employee_excess.employee_id', 'left');
        return $this->db->get('tbl_employee_excess');
    }

//Generate Report of Employees with Short and Excess
    function employeeReport($user_id) {
        $this->db->order_by('tbl_close_shift_debit_user.adjust_amt_id', 'desc');
        $this->db->select('tbl_close_shift_debit_user.amount, tbl_shifts.shift_date, tbl_shifts_names.name as shift_name, tbl_users.name as user, tbl_close_shift_debit_user.status, adjust_amt_id, tbl_close_shift_debit_user.shift_id');
        $this->db->join('tbl_shifts', 'tbl_shifts.shift_id = tbl_close_shift_debit_user.shift_id', 'left');
        $this->db->join('tbl_shifts_names', 'tbl_shifts_names.shift_name_id = tbl_shifts.shift_name_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_close_shift_debit_user.user_id', 'left');
        $this->db->where('tbl_close_shift_debit_user.user_id', $user_id);
        return $this->db->get('tbl_close_shift_debit_user')->result_array();
    }

    function get_list_active($search = null) {

        $this->db->order_by('name', 'asc');
        $this->db->select('tbl_users.*, tbl_roles.name as role_name, tbl_user_titles.name as title');
        $this->db->join('tbl_roles', 'tbl_roles.role_id = tbl_users.role_id', 'left');
        $this->db->join('tbl_user_titles', 'tbl_user_titles.user_title_id = tbl_users.title_id', 'left');
        $this->db->where('tbl_users.deleted', 0);
        if ($search == null) {
            return $this->db->get('tbl_users');
        } else {
            $where = "tbl_users.name LIKE '%" . $search . "%' OR tbl_roles.name LIKE '%" . $search . "%' OR tbl_users.username LIKE '%" . $search . "%'";
            $this->db->where($where);
            return $this->db->get('tbl_users');
        }
    }

//Get Username exists
    function username_exists($username) {

        $this->db->where('username', $username);
        $query = $this->db->get('tbl_users');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_list_role($search = null) {
        $this->db->order_by('role_id', 'asc');
        $this->db->select('tbl_roles.*');
        return $this->db->get('tbl_roles');
    }

    function get_active_list() {
        $this->db->order_by('name', 'asc');
        $this->db->where('status', 1);
        return $this->db->get('tbl_users');
    }

    function count_all() {
        return $this->db->count_all($this->tbl_user);
    }

    function get_by_id($id) {
        $this->db->where('user_id', $id);
        return $this->db->get('tbl_users');
    }

    function get_role_by_id($id) {
        $this->db->where('role_id', $id);
        return $this->db->get('tbl_roles');
    }

    function save($user) {
        $this->db->insert('tbl_users', $user);
        return $this->db->insert_id();
    }
      function saveEmp($user) {
        $this->db->insert('tbl_employees', $user);
        return $this->db->insert_id();
    }

    function update($id, $user) {
        $this->db->where('user_id', $id);
        $this->db->update($this->tbl_user, $user);
    }

}

?>