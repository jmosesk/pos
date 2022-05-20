<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PettyCash extends MY_Controller {

    function __construct() {
        parent::__construct();

        // load library
        $this->load->library(array('table', 'form_validation'));

        // load helper
        $this->load->helper('url');

        // load model
        $this->load->model('Company_model', '', TRUE);
        $this->load->model('Shift_model', '', TRUE);
        $this->load->model('Product_model', '', TRUE);
        $this->load->model('Ledger_model', '', TRUE);
    }

    //put your code here
    public function index() {
        if ($this->session->userdata('logged_in')) {
            $data['companies'] = $this->Company_model->get_list_company();
            $data['expenses'] = $this->Company_model->get_list_expenses();
            $data['taxs'] = $this->Product_model->get_list_tax();
            $data['accounts'] = $this->Ledger_model->get_list_accounts();
            $this->load->view('includes/header');
            $this->load->view('pettycash/pettycashList', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function edit_expense($id = null) {
        if ($this->session->userdata('logged_in')) {
            if ($id == null) {
                $id = $this->input->post('item_id');
                $expense_data = array('codeexpense' => $this->input->post('expcode'),
                    'description' => $this->input->post('description'),
                    'glaccount' => $this->input->post('accountcode'),
                    'taxcatid' => $this->input->post('tax_id'),
                    'explimit' => $this->input->post('cash_limit'),
                );
                $this->MY_Model->update('tbl_petty_cash_categories', 'id', $id, $expense_data);
                echo "Petty Cash Category Details successfully Updated";
            } else {
                $data['taxs'] = $this->Product_model->get_list_tax();
                $data['accounts'] = $this->Ledger_model->get_list_accounts();
                $data['expense_details'] = $this->MY_Model->fetch('tbl_petty_cash_categories', 'id', $id, 'id', 'asc');
                $this->load->view('pettycash/editPettyCategory', $data);
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function addExpense() {
        if ($this->session->userdata('logged_in')) {
            $this->db->trans_begin();
            $expense_data = array('codeexpense' => $this->input->post('expcode'),
                'description' => $this->input->post('description'),
                'glaccount' => $this->input->post('accountcode'),
                'taxcatid' => $this->input->post('tax_id'),
                'explimit' => $this->input->post('cash_limit'),
            );

            $this->MY_Model->save('tbl_petty_cash_categories', $expense_data);
            if ($this->db->trans_status() === FALSE) {
                echo "Petty Cash Category could not be created, Please try again!";
                $this->db->trans_rollback();
            } else {
                echo "Petty Cash Category successfully added";
                $this->db->trans_commit();
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function petty_cash_items() {
        if ($this->session->userdata('logged_in')) {
            $data['items'] = $this->MY_Model->fetch('tbl_petty_cash_items', 'deleted', 0, 'name', 'desc');
            $this->load->view('includes/header');
            $this->load->view('pettycash/petty_cash_items', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function addItem($id = null) {
        if ($this->session->userdata('logged_in')) {
            $this->db->trans_begin();
            $show_msg = true;
            if($id != null) {
                $show_msg = false;
                $data['expense_details'] = $this->MY_Model->fetch('tbl_petty_cash_items', 'id', $id, 'id', 'asc');
                $this->load->view('pettycash/edit_petty_item', $data);
            } else {
                $type = $this->input->post('type');
                $expense_data = array('name' => $this->input->post('name'),
                    'description' => $this->input->post('description')
                );
                if($type == "add") {
                    $this->MY_Model->save('tbl_petty_cash_items', $expense_data);
                } else {
                    $id = $this->input->post('item_id');
                    $this->MY_Model->update('tbl_petty_cash_items', 'id', $id, $expense_data);
                }
            }
            if($show_msg) {
                if ($this->db->trans_status() === FALSE) {
                    echo "Petty Cash Item could not be created, Please try again!";
                    $this->db->trans_rollback();
                } else {
                    echo "Petty Cash Item successfully added";
                    $this->db->trans_commit();
                }
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function submitExpenses() {
        if ($this->session->userdata('logged_in')) {
            $data['expenses'] = $this->Ledger_model->get_list_expenses();
            //print_r($data['expenses']);
            $this->load->view('includes/header');
            $this->load->view('pettycash/pettycashModule', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function create_expenses() {
        $data['users'] = $this->Shift_model->getAllocatedUserById(current_shift_data()->shift_id);
        $data['items'] = $this->MY_Model->fetch('tbl_petty_cash_items', 'deleted', 0, 'name', 'desc');
        $this->load->view('includes/header');
        $this->load->view('pettycash/create_petty_cash', $data);
        $this->load->view('includes/footer');
    }

    function create_expenses_bank() {
        $data['accounts'] = $this->Ledger_model->fetch_bank_accounts_items();
        $this->load->view('includes/header');
        $this->load->view('pettycash/bank_petty_cash', $data);
        $this->load->view('includes/footer');
    }

    function add_expense() {
        if ($this->session->userdata('logged_in')) {
            $user_id = $this->session->userdata('logged_in')['user_id'];
            $shift_id = current_shift_data()->shift_id;
            $post_data = $this->input->post();
            //print_r($this->input->post()); die();
            if($post_data['control_amount'] != $post_data['total-amnt_val']) {
                $response = array('error' => true, "message" => "Total Amount is not equal to Control Amount");
            } else {
                if($this->input->post('bank_expense') != false && $this->input->post('banked_cash') == 2) {
                    $acc= $post_data['vendor_name'];
                    $this->db->trans_start();
                     $amt = 0;
                        $transaction_details = $this->MY_Model->fetch_limit('tbl_bankings', 'account_number_id', $acc, 'banking_id', 'desc', 1);
                        if ($transaction_details != NULL) {
                            $amt = $transaction_details[0]->bbf - $post_data['control_amount'];
                        }
                    $expense_data = array('amount' => $post_data['control_amount'], 'reference_number' => $post_data['ref_number'], 'transaction_type' =>3, 
                        'account_number_id' => $acc, 'deposited_by' => $user_id, 'shift_id' => $shift_id, 'debit' => 1, 'bbf' =>$amt);
                    $expense_id = $this->MY_Model->save('tbl_bankings', $expense_data);
                    for($i= 0; $i < count($post_data['item']); $i ++) {
                        $save_expense_data = array('item_id' => $post_data['item'][$i], 
                            'quantity' => $post_data['qty'][$i], 
                            'amount' => $post_data['amount'][$i],
                            'expense_id' => $expense_id,
                            'source' => $post_data['vendor_name']
                        );
                        $this->MY_Model->save('tbl_petty_cash_expense_bank_items', $save_expense_data);
                    }
                    $this->db->trans_complete();
                    if($this->db->trans_status() === FALSE)
                        $response = array('error' => true, 'message' => 'Error saving data, please try again');
                    else
                        $response = array('error' => false, 'message' => 'Expense data has successfully been saved');
                } else {
                    $this->db->trans_start();
                    if($this->input->post('bank_expense') != false) {
                        $expense_data = array('total' => $post_data['control_amount'], 'ref_number' => $post_data['ref_number_unbanked'], 
                                                'vendor_name' => $post_data['vendor_name_unbanked'], 'user_id' => $user_id, 'shift_id' => $shift_id, 
                                                'reason' => $post_data['reason']);
                    } else {                        
                        $expense_data = array('total' => $post_data['control_amount'], 'receipt_number' => $post_data['receipt_number'],
                                                'ref_number' => $post_data['ref_number'], 'vendor_name' => $post_data['vendor_name'],
                                                'cashier' => $post_data['cashier'], 'user_id' => $user_id, 'shift_id' => $shift_id, 
                                                'reason' => $post_data['reason']);
                    }
                    $expense_id = $this->MY_Model->save('tbl_petty_cash_expenses', $expense_data);
                    $new_total = 0;
                    for($i= 0; $i < count($post_data['item']); $i ++) {
                        $new_total += $post_data['amount'][$i];
                        $save_expense_data = array('item_id' => $post_data['item'][$i], 
                            'quantity' => $post_data['qty'][$i], 
                            'amount' => $post_data['amount'][$i],
                            'expense_id' => $expense_id
                        );
                        $this->MY_Model->save('tbl_petty_cash_expense_items', $save_expense_data);
                    }
                    if($this->input->post('bank_expense') != false) {
                        $unbanked_cash = company_data()[0]->cash;
                        $new_unbanked = $unbanked_cash - $new_total;
                        $update_cash = array('cash' => $new_unbanked);
                        $this->MY_Model->update('tbl_companies', 'company_id', company_data()[0]->company_id, $update_cash);
                    }
                    $this->db->trans_complete();
                    if($this->db->trans_status() === FALSE)
                        $response = array('error' => true, 'message' => 'Error saving data, please try again');
                    else
                        $response = array('error' => false, 'message' => 'Expense data has successfully been saved');
                }
            }
            echo json_encode($response);            
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function search_item() {
        if(!empty($_POST["keyword"])) {
            $result = $this->MY_Model->search_array('tbl_petty_cash_items', 'name', $_POST["keyword"], 'name', 'asc');
            if(!empty($result)) {
                $data = '<ul class="list-group">';
                    foreach($result as $country) {
                        $data .= '<li class="list-group-item" onClick="selectItem(\''.$country["name"].'\', '.$country["id"].')">'.$country["name"].'</li>';
                    }
                $data .= '</ul>';
            } else {
                $data = '<ul class="list-group">';
                $data .= '<li class="list-group-item">No Results Found</li>';
                $data .= '</ul>';
            }
            echo $data;
        }
    }

    function view_expense($id = null) {
        $data['expense_details'] = $this->Ledger_model->fetch_petty_cash_items($id);
        $this->load->view('pettycash/view_petty_cash_items', $data);
    }
}
