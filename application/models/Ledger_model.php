<?php

class Ledger_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_list_accounts(){
        return $this->db->get('tbl_chartmaster');
    }

    function get_list_expenses()
    {
        $shift_id = current_shift_data()->shift_id;
        $this->db->order_by('id', 'asc');
        $this->db->select('tbl_users.name as employee, total, reason, vendor_name, tbl_petty_cash_expenses.date_created as date_created, id');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_petty_cash_expenses.cashier', 'left');
        $this->db->where('tbl_petty_cash_expenses.shift_id', $shift_id)->where('approved', 0);
        return $this->db->get('tbl_petty_cash_expenses')->result_array();
    }

    function fetch_petty_cash_items($id = null)
    {
        $this->db->order_by('tbl_petty_cash_expense_items.id', 'asc');
        $this->db->select('quantity, amount, tbl_petty_cash_items.name as item');
        $this->db->join('tbl_petty_cash_items', 'tbl_petty_cash_items.id = tbl_petty_cash_expense_items.item_id', 'left');
        $this->db->where('tbl_petty_cash_expense_items.expense_id', $id);
        return $this->db->get('tbl_petty_cash_expense_items')->result_array();
    }

    function fetch_bank_accounts_items($id = null)
    {
        $this->db->order_by('tbl_banks.name', 'asc');
        $this->db->select('tbl_banks.name as bank, tbl_banks_account_number.account_number, branch_name, account_number_id');
        $this->db->join('tbl_banks', 'tbl_banks.bank_id = tbl_banks_account_number.bank_id', 'left');
        $this->db->where('tbl_banks_account_number.deleted', 0)->where('tbl_banks.deleted', 0);
        $query = $this->db->get('tbl_banks_account_number');
        return $query->result_array();
    }
}
