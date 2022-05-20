<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {

    function __construct() {
        parent::__construct();

// load library
        $this->load->library(array('table', 'form_validation'));

// load helper
        $this->load->helper('url');

// load model
        $this->load->model('Company_model', '', TRUE);
        $this->load->model('Product_model', '', TRUE);
    }

    public function index() {
        $this->load->model('Store_model', '', TRUE);
        if ($this->session->userdata('logged_in')) {
            $this->load->model('User_model', '', TRUE);
            $data['customers'] = $this->Company_model->get_list_customer();
            $data['sales'] = $this->Product_model->get_list_sales();
            $this->load->view('includes/header');
            $this->load->view('payment/sales', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function saleList() {
        if ($this->session->userdata('logged_in')) {
            $shift_id = current_shift_data()->shift_id;
            $data['sales_inv'] = $this->Product_model->get_list_sales_inv($shift_id);
            $data['sales_mp'] = $this->Product_model->get_list_sales_mp($shift_id);
            $data['sales_cad'] = $this->Product_model->get_list_sales_cad($shift_id);
            $this->load->view('includes/header');
            $this->load->view('payment/sales', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function editInvoice($id = null) {
        if ($this->session->userdata('logged_in')) {
            if ($id == null) {
                $id = $this->input->post('sale_id');
                $invoice = array('driver ' => $this->input->post('driver'),
                    'lpo_number' => $this->input->post('Invoice'),
                    'vehicle' => $this->input->post('vehicle'));
                $this->db->trans_begin();
                $this->Product_model->updateInvoice($id, $invoice);
                echo "Invoice Details successfully Updated";
                $this->db->trans_complete();
            } else {

                $data['invoice'] = $this->Product_model->get_invoice_by_id($id);
                $this->load->view('payment/edit_Customer_Invoice', $data);
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function jobCardList() {
        if ($this->session->userdata('logged_in')) {
            $shift_id = current_shift_data()->shift_id;
            $data['sales_jc'] = $this->Product_model->get_list_sales_jc($shift_id);
            $this->load->view('includes/header');
            $this->load->view('payment/jobCards', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function viewSalesItems($id = null) {
        if ($this->session->userdata('logged_in')) {
            $data = $this->Product_model->get_list_sale_items($id);
            if ($data != null) {
                $agent = $data->result();
                echo json_encode($agent);
            } else {
                echo null;
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function sales() {
        $this->load->model('Store_model', '', TRUE);
        if ($this->session->userdata('logged_in')) {
            $this->load->model('User_model', '', TRUE);
            $data['customers'] = $this->Company_model->get_list_customer(1);
            $data['custCards'] = $this->Company_model->get_list_custcards();
            $data['mpesas'] = $this->Company_model->get_customer_by_category(3);
            $this->load->view('includes/header');
            $this->load->view('payment/salesModule', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function brachSales() {
        $this->load->model('Store_model', '', TRUE);
        if ($this->session->userdata('logged_in')) {
            $this->load->model('User_model', '', TRUE);
            $data['customers'] = $this->Company_model->get_list_customer(1);
            $data['custCards'] = $this->Company_model->get_list_custcards();
            $data['mpesas'] = $this->Company_model->get_customer_by_category(3);
            $this->load->view('includes/header');
            $this->load->view('payment/banchSalesModule', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function getVehicle($vehId) {
        $veh = $this->Company_model->getVehList($vehId);
        echo json_encode($veh);
    }

    function searchItem() {
        $search = $this->input->post('search');
        $query = $this->Product_model->searchitem($search);
//print_r($query);
//print_r($this->db->last_query());
        echo json_encode($query);
    }

    function searchProduct() {
        $search = $this->input->post('search');
        $query = $this->Product_model->searchproduct($search);
        echo json_encode($query);
    }
    public function cash_reconcilliation() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('Shift_model', '', TRUE);
            $data['shifts'] = $this->Shift_model->get_list_closed_shifts();
//print_r($this->db->last_query()); die();
            $this->load->view('includes/header');
            $this->load->view('payment/cash_reconcilliation', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function cash_reconcilliation_sheet($id) {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('Shift_model', '', TRUE);
            $shift_id = $id;
            $data['shift_users'] = $this->Shift_model->ShiftUsers($shift_id);
            $data['drops'] = $this->Shift_model->DropsExcessPerUser($shift_id);
            $data['fuel_sales'] = $this->Shift_model->FuelSalesPerUser($shift_id);
            $data['lpg_sales'] = $this->Shift_model->LpgSalesPerUser($shift_id);
            $data['lubes_sales'] = $this->Shift_model->LubesSalesPerUser($shift_id);
            $data['credit_sales'] = $this->Shift_model->CreditSalesPerUser($shift_id);
            $data['payments'] = $this->Shift_model->SumPayments($shift_id);
            $data['recieving_amt'] = $this->Shift_model->SumRecievingsPayments($shift_id);
            $data['job_cards'] = $this->Shift_model->SumUserJobCards($shift_id);
            $data['expenses_amnt'] = $this->Shift_model->SumAllExpenses($shift_id);
            $data['expenses'] = $this->MY_Model->fetch('tbl_petty_cash_expenses', 'approved', 0, 'approved', 'asc', 'shift_id', $shift_id);
            $this->load->view('includes/header');
            $this->load->view('payment/cash_reconcilliation_sheet', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function total_sum_credit_amount($user_id, $shift_id, $payment_type) {
        $sum = total_sum_credit_amount($user_id, $shift_id, $payment_type);
        print_r($sum);
        print_r($this->db->last_query());
        die();
    }

    public function creditNoteVendor() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('User_model', '', TRUE);
            $data['users'] = $this->Company_model->get_list_employees_active();
            $data['bankings'] = $this->Product_model->get_list_VendorNotes();
            $data['customers'] = $this->Company_model->get_list_customer();
            $data['vendors'] = $this->Company_model->get_list_suppliers();
            $data['employees'] = $this->User_model->get_list();
            $this->load->view('includes/header');
            $this->load->view('payment/creditNoteVendor', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function debitNoteVendor() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('User_model', '', TRUE);
            $data['users'] = $this->Company_model->get_list_employees_active();
            $data['bankings'] = $this->Product_model->get_list_VendorDebits();
            $data['customers'] = $this->Company_model->get_list_customer();
            $data['vendors'] = $this->Company_model->get_list_suppliers();
            $data['employees'] = $this->User_model->get_list();
            $this->load->view('includes/header');
            $this->load->view('payment/debitNoteVendor', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function debit_note() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('User_model', '', TRUE);
            $data['notes'] = $this->Product_model->get_list_debitNote();
            $data['customers'] = $this->Company_model->get_list_customer();
            $data['taxes'] = $this->Product_model->get_list_tax();
            $data['employees'] = $this->User_model->get_list();
            $this->load->view('includes/header');
            $this->load->view('payment/debit_note', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function addDebitNote() {
        if ($this->session->userdata('logged_in')) {
            $vat = (($this->input->post('vat')) * ($this->input->post('amount')));
            $total = ($vat + ($this->input->post('amount')));
            $date = date("Y-m-d", strtotime($this->input->post('invoice_date')));
            $note = array('supplier_id' => $this->input->post('vendor'),
                'customer_id' => $this->input->post('customer'),
                'reference_number' => $this->input->post('ref'),
                'amount' => $this->input->post('amount'),
                'amt_date' => $date,
                'user_id' => $this->input->post('employee'),
                'comments' => $this->input->post('comments'),
                'shift_id' => current_shift_data()->shift_id);
            $this->Product_model->saveDebitNote($note);
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function AddVendorCreditNote() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('ShiftReports_model', '', TRUE);
            $vat = (($this->input->post('vat')) * ($this->input->post('amount')));
            $total = ($vat + ($this->input->post('amount')));
            $date = date("Y-m-d", strtotime($this->input->post('invoice_date')));
            $customer_field_id = $this->input->post('customer');
            $shift_id = current_shift_data()->shift_id;
            $bbf = 0;
            $transaction_details = $this->MY_Model->fetch_limit('tbl_customers_transactions', 'customer_id', $customer_field_id, 'customer_transaction_id', 'desc', 1);
            if ($transaction_details != NULL)
                $bbf = $transaction_details[0]->bbf + $this->input->post('amount');
            $prefix = "CRN";
            $payment = array('customer_id' => $customer_field_id,
                'shift_id' => $shift_id,
                'debit' => 0,
                'amount' => $this->input->post('amount'),
                'employee_id' => $this->input->post('employee'),
                'transaction_type' => 10,
                'payment_type' => 10,
                'ref_number' => $prefix . $this->input->post('ref'),
                'bbf' => $bbf);
            $this->db->trans_start();
            $customers_transaction_id = $this->Product_model->saveCustomerTransactions($payment);
            if ($customers_transaction_id) {
                $note = array('supplier_id' => $this->input->post('vendor'),
                    'customer_id' => $this->input->post('customer'),
                    'customers_transactions_id' => $customers_transaction_id,
                    'reference_number' => $this->input->post('ref'),
                    'amount' => $this->input->post('amount'),
                    'amt_date' => $date,
                    'user_id' => $this->input->post('employee'),
                    'comments' => $this->input->post('comments'),
                    'shift_id' => current_shift_data()->shift_id);
                $note_id = $this->Product_model->saveVendorCrNote($note);
                if ($note_id) {
                    $bbf2 = 0;
                    $transaction_details2 = $this->MY_Model->fetch_limit('tbl_vendors_transactions', 'supplier_id', $this->input->post('vendor'), 'supplier_transaction_id', 'desc', 1);
                    if ($transaction_details2 != NULL)
                        $bbf2 = $transaction_details2[0]->bbf - $this->input->post('amount');
                    $prefix2 = "CRN";
                    $payment2 = array('supplier_id' => $this->input->post('vendor'),
                        'shift_id' => $shift_id,
                        'debit' => 1,
                        'amount' => $this->input->post('amount'),
                        'employee_id' => $this->input->post('employee'),
                        'transaction_type' => 10,
                        'payment_type' => 10,
                        'ref_number' => $prefix2 . $this->input->post('ref'),
                        'bbf' => $bbf2);
                    $this->Product_model->saveSupplierTransaction($payment2);
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
                echo "Credit Note could not be saved, Please try again";
            else
                echo "Credit Note has been successfully saved";
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function AddVendorDebitNote() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('ShiftReports_model', '', TRUE);
            $vat = (($this->input->post('vat')) * ($this->input->post('amount')));
            $total = ($vat + ($this->input->post('amount')));
            $date = date("Y-m-d", strtotime($this->input->post('invoice_date')));
            $customer_field_id = $this->input->post('customer');
            $shift_id = current_shift_data()->shift_id;
            $bbf = 0;
            $transaction_details = $this->MY_Model->fetch_limit('tbl_customers_transactions', 'customer_id', $customer_field_id, 'customer_transaction_id', 'desc', 1);
            if ($transaction_details != NULL)
                $bbf = $transaction_details[0]->bbf - $this->input->post('amount');
            $prefix = "DBN";
            $payment = array('customer_id' => $customer_field_id,
                'shift_id' => $shift_id,
                'debit' => 1,
                'amount' => $this->input->post('amount'),
                'employee_id' => $this->input->post('employee'),
                'transaction_type' => 11,
                'payment_type' => 11,
                'ref_number' => $prefix . $this->input->post('ref'),
                'bbf' => $bbf);
            $this->db->trans_start();
            $customers_transaction_id = $this->Product_model->saveCustomerTransactions($payment);
            if ($customers_transaction_id) {
                $note = array('supplier_id' => $this->input->post('vendor'),
                    'customer_id' => $this->input->post('customer'),
                    'customers_transactions_id' => $customers_transaction_id,
                    'reference_number' => $this->input->post('ref'),
                    'amount' => $this->input->post('amount'),
                    'amt_date' => $date,
                    'user_id' => $this->input->post('employee'),
                    'comments' => $this->input->post('comments'),
                    'shift_id' => current_shift_data()->shift_id);
                $note_id = $this->Product_model->saveVendorDrNote($note);
                if ($note_id) {
                    $bbf2 = 0;
                    $transaction_details2 = $this->MY_Model->fetch_limit('tbl_vendors_transactions', 'supplier_id', $this->input->post('vendor'), 'supplier_transaction_id', 'desc', 1);
                    if ($transaction_details2 != NULL)
                        $bbf2 = $transaction_details2[0]->bbf + $this->input->post('amount');
                    $prefix2 = "DBN";
                    $payment2 = array('supplier_id' => $this->input->post('vendor'),
                        'shift_id' => $shift_id,
                        'debit' => 0,
                        'amount' => $this->input->post('amount'),
                        'employee_id' => $this->input->post('employee'),
                        'transaction_type' => 11,
                        'payment_type' => 11,
                        'ref_number' => $prefix2 . $this->input->post('ref'),
                        'bbf' => $bbf2);
                    $this->Product_model->saveSupplierTransaction($payment2);
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
                echo "Debit Note could not be saved, Please try again";
            else
                echo "Debit Note has been successfully saved";
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function customer_payment() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('User_model', '', TRUE);
            $this->load->model('Shift_model', '', TRUE);
            $this->load->model('Ledger_model', '', TRUE);
            $data['payments'] = $this->Product_model->get_list_customerPayments();
            $data['customers'] = $this->Company_model->get_list_customer_station();
            $data['custCards'] = $this->Company_model->get_list_custcards_pay();
            $data['mpesas'] = $this->Company_model->get_customer_by_category(3);
            $data['employees'] = $this->Shift_model->getAllocatedUserById(current_shift_data()->shift_id);
            $data['methods'] = $this->Product_model->getListTable('name', 'tbl_payment_type');
            $data['accounts'] = $this->Ledger_model->fetch_bank_accounts_items();
            $data['recieving_amt'] = $this->Shift_model->SumRecievingsPayments(current_shift_data()->shift_id);
            $this->load->view('includes/header');
            $this->load->view('payment/customer_payment', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function employee_payment() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('User_model', '', TRUE);
            $this->load->model('Shift_model', '', TRUE);
            $this->load->model('Ledger_model', '', TRUE);
            $data['payments'] = $this->Product_model->get_list_employeePayments();
            $data['customers'] = $this->Company_model->get_list_employee_station();
            $data['custCards'] = $this->Company_model->get_list_custcards_pay();
            $data['mpesas'] = $this->Company_model->get_customer_by_category(3);
            $data['employees'] = $this->Shift_model->getAllocatedUserById(current_shift_data()->shift_id);
            $data['methods'] = $this->Product_model->getListTable('name', 'tbl_payment_type');
            $data['accounts'] = $this->Ledger_model->fetch_bank_accounts_items();
            $data['recieving_amt'] = $this->Shift_model->SumEmpPayments(current_shift_data()->shift_id);
            $this->load->view('includes/header');
            $this->load->view('payment/employee_payment', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function addCustomerReport($employee_id, $customer_id, $debit, $amount, $details, $shift_id, $transaction_type, $pay_type) {
//transaction_type - Customer_payment - 1, 
        if ($this->session->userdata('logged_in')) {
            $statement = array('employee_id' => $employee_id,
                'customer_id' => $customer_id,
                'debit' => $debit,
                'amount' => $amount,
                'details' => $details,
                'shift_id' => $shift_id,
                'transaction_type' => $transaction_type,
                'payment_type' => $pay_type);
            $this->Product_model->saveCustomerTransactions($statement);
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function addCustomerPayment() {
        if ($this->session->userdata('logged_in')) {
            $employee_data = $this->input->post('employee');
            $source = 0;
            if (strpos($employee_data, '-') !== false) {
                $centre = explode('-', $employee_data);
                $employee_id = $centre[0];
                $centre_id = $centre[1];
                $shift_id = current_shift_data()->shift_id;
                $customer_field_id = $this->input->post('customer');
                $bbf = 0;
                $transaction_details = $this->MY_Model->fetch_limit('tbl_customers_transactions', 'customer_id', $customer_field_id, 'customer_transaction_id', 'desc', 1);
                if ($transaction_details != NULL)
                    $bbf = $transaction_details[0]->bbf + $this->input->post('amount');
                if ($this->input->post('payment_type') == 3) {

                    $source = $this->input->post('account_c');
                }
                if ($this->input->post('payment_type') == 2) {

                    $source = $this->input->post('account_b');
                }

                if ($this->input->post('payment_type') == 7) {

                    $source = $this->input->post('account_m');
                }
                $prefix = "PY";
                $payment = array('customer_id' => $customer_field_id,
                    'shift_id' => $shift_id,
                    'debit' => 0,
                    'amount' => $this->input->post('amount'),
                    'employee_id' => $employee_id,
                    'transaction_type' => 2,
                    'payment_type' => $this->input->post('payment_type'),
                    'source' => $source,
                    'ref_number' => $prefix . $this->input->post('cheque'),
                    'bbf' => $bbf);
                $this->db->trans_start();
                $customers_transaction_id = $this->Product_model->saveCustomerTransactions($payment);
                $payment_remarks = array('payment_reason' => $this->input->post('reason'),
                    'customers_transactions_id' => $customers_transaction_id,
                    'remarks' => $this->input->post('remarks'),
                    'centre_id' => $centre_id);
                $this->Product_model->saveCustomerPayment($payment_remarks);
                if ($this->input->post('payment_type') != 1) {
                    if ($this->input->post('payment_type') == 2) {
                        $user_id = $this->session->userdata('logged_in')['user_id'];
                        $amt = 0;
                        $transaction_details = $this->MY_Model->fetch_limit('tbl_bankings', 'account_number_id', $source, 'banking_id', 'desc', 1);
                        if ($transaction_details != NULL) {
                            $amt = $transaction_details[0]->bbf + $this->input->post('amount');
                        }
                        $payment3 = array('account_number_id' => $source,
                            'deposited_by' => $employee_id,
                            'source' => $customer_field_id,
                            'amount' => $this->input->post('amount'),
                            'shift_id' => $shift_id,
                            'transaction_type' => 2,
                            'payment_type' => $this->input->post('payment_type'),
                            'reference_number' => $this->input->post('cheque'),
                            'debit' => 0,
                            'user_id' => $user_id,
                            'bbf' => $amt);
                        $this->Product_model->saveBanking($payment3);
                    } else {
                        $customer_field_id2 = $source;
                        $transaction_details2 = $this->MY_Model->fetch_limit('tbl_customers_transactions', 'customer_id', $customer_field_id2, 'customer_transaction_id', 'desc', 1);
                        if ($transaction_details2 != NULL) {
                            $bbf = $transaction_details2[0]->bbf - $this->input->post('amount');
                            $payment2 = array('customer_id' => $source,
                                'shift_id' => $shift_id,
                                'debit' => 1,
                                'amount' => $this->input->post('amount'),
                                'employee_id' => $employee_id,
                                'transaction_type' => 2,
                                'payment_type' => $this->input->post('payment_type'),
                                'source' => $customer_field_id,
                                'ref_number' => $this->input->post('cheque'),
                                'bbf' => $bbf);
                            $customers_transaction_id2 = $this->Product_model->saveCustomerTransactions($payment2);
                        }
                    }
                }
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE)
                    echo "Payment could not be saved, Please try again";
                else
                    echo "Payment has been successfully saved";
            } else
                echo "Payment could not be saved, Please try again";
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function addEmployeePayment() {
        if ($this->session->userdata('logged_in')) {
            $employee_data = $this->input->post('employee');
            $source = 0;
            if (strpos($employee_data, '-') !== false) {
                $centre = explode('-', $employee_data);
                $employee_id = $centre[0];
                $centre_id = $centre[1];
                $shift_id = current_shift_data()->shift_id;
                $customer_field_id = $this->input->post('customer');
                $bbf = 0;
                $transaction_details = $this->MY_Model->fetch_limit('tbl_close_shift_debit_user', 'user_id', $customer_field_id, 'adjust_amt_id', 'desc', 1);
                if ($transaction_details != NULL) {
                    $bbf = $transaction_details[0]->bbf + $this->input->post('amount');
                }
                if ($this->input->post('payment_type') == 3) {

                    $source = $this->input->post('account_c');
                }
                if ($this->input->post('payment_type') == 2) {

                    $source = $this->input->post('account_b');
                }

                if ($this->input->post('payment_type') == 7) {

                    $source = $this->input->post('account_m');
                }
                $payment = array('user_id' => $customer_field_id,
                    'shift_id' => $shift_id,
                    'debit' => 0,
                    'figure' => $this->input->post('amount'),
                    'employee_id' => $employee_id,
                    'transaction_type' => 2,
                    'payment_type' => $this->input->post('payment_type'),
                    'source' => $source,
                    'ref_number' => $this->input->post('cheque'),
                    'bbf' => $bbf);
                $this->db->trans_start();
                $customers_transaction_id = $this->Product_model->saveEmployeeTransactions($payment);
                $payment_remarks = array('payment_reason' => $this->input->post('reason'),
                    'employee_transactions_id' => $customers_transaction_id,
                    'remarks' => $this->input->post('remarks'),
                    'centre_id' => $centre_id);
                $this->Product_model->saveEmployeePayment($payment_remarks);
                if ($this->input->post('payment_type') != 1) {
                    if ($this->input->post('payment_type') == 2) {
                        $user_id = $this->session->userdata('logged_in')['user_id'];
                        $payment3 = array('account_number_id' => $source,
                            'deposited_by' => $employee_id,
                            'source' => $customer_field_id,
                            'amount' => $this->input->post('amount'),
                            'shift_id' => $shift_id,
                            'payment_type' => $this->input->post('payment_type'),
                            'reference_number' => $this->input->post('cheque'),
                            'debit' => 0,
                            'user_id' => $user_id);
                        $this->Product_model->saveBanking($payment3);
                    } else {
                        $customer_field_id2 = $source;
                        $transaction_details2 = $this->MY_Model->fetch_limit('tbl_customers_transactions', 'customer_id', $customer_field_id2, 'customer_transaction_id', 'desc', 1);
                        if ($transaction_details2 != NULL) {
                            $bbf = $transaction_details2[0]->bbf - $this->input->post('amount');
                            $payment2 = array('customer_id' => $source,
                                'shift_id' => $shift_id,
                                'debit' => 1,
                                'amount' => $this->input->post('amount'),
                                'employee_id' => $employee_id,
                                'transaction_type' => 4,
                                'payment_type' => $this->input->post('payment_type'),
                                'source' => $customer_field_id,
                                'ref_number' => $this->input->post('cheque'),
                                'bbf' => $bbf);
                            $customers_transaction_id2 = $this->Product_model->saveCustomerTransactions($payment2);
                        }
                    }
                }
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE)
                    echo "Payment could not be saved, Please try again";
                else
                    echo "Payment has been successfully saved";
            } else
                echo "Payment could not be saved, Please try again";
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function vendor_payment() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('User_model', '', TRUE);
            $this->load->model('Ledger_model', '', TRUE);
            $data['payments'] = $this->Product_model->getlist_vendorPayments();
            $data['suppliers'] = $this->Company_model->get_list_suppliers();
            $data['custCards'] = $this->Company_model->get_list_custcards_pay();
            $data['mpesas'] = $this->Company_model->get_customer_by_category(3);
            $data['methods'] = $this->Product_model->getListTable('name', 'tbl_payment_type');
            $data['accounts'] = $this->Ledger_model->fetch_bank_accounts_items();
            $this->load->view('includes/header');
            $this->load->view('payment/vendor_payment', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function addVendorPayment() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('ShiftReports_model', '', TRUE);
            $shift_id = current_shift_data()->shift_id;
            $customer_field_id = $this->input->post('vendor');
            $source = 0;
            $bbf = 0;
            $transaction_details = $this->MY_Model->fetch_limit('tbl_vendors_transactions', 'supplier_id', $customer_field_id, 'supplier_transaction_id', 'desc', 1);
            if ($transaction_details != NULL)
                $bbf = $transaction_details[0]->bbf - $this->input->post('amount');
            if ($this->input->post('payment_type') == 3) {

                $source = $this->input->post('account_c');
            }
            if ($this->input->post('payment_type') == 2) {

                $source = $this->input->post('account_b');
            }

            if ($this->input->post('payment_type') == 7) {

                $source = $this->input->post('account_m');
            }
            $prefix = "PY";
            $payment = array('supplier_id' => $customer_field_id,
                'shift_id' => $shift_id,
                'debit' => 1,
                'source' => $source,
                'amount' => $this->input->post('amount'),
                'employee_id' => $this->session->userdata('logged_in')['user_id'],
                'transaction_type' => 2,
                'payment_type' => $this->input->post('payment_type'),
                'ref_number' => $prefix . $this->input->post('cheque'),
                'bbf' => $bbf);
            $this->db->trans_start();
            $supplier_transaction_id = $this->Product_model->saveSupplierTransactions($payment);
            $payment_remarks = array('payment_reason' => $this->input->post('reason'),
                'supplier_transactions_id' => $supplier_transaction_id,
                'remarks' => $this->input->post('remarks'),
                'centre_id' => 0);
            $this->Product_model->saveSupplierPayment($payment_remarks);
            if ($this->input->post('payment_type') != 1) {
                if ($this->input->post('payment_type') == 2) {
                    $user_id = $this->session->userdata('logged_in')['user_id'];
                    $amt = 0;
                    $transaction_details = $this->MY_Model->fetch_limit('tbl_bankings', 'account_number_id', $source, 'banking_id', 'desc', 1);
                    if ($transaction_details != NULL) {
                        $amt = $transaction_details[0]->bbf - $this->input->post('amount');
                    }
                    $payment3 = array('account_number_id' => $source,
                        'deposited_by' => $user_id,
                        'source' => $customer_field_id,
                        'amount' => $this->input->post('amount'),
                        'amt_date' => $this->input->post('invoice_date'),
                        'shift_id' => $shift_id,
                        'payment_type' => $this->input->post('payment_type'),
                        'transaction_type' => 4, //supplier payment                      
                        'reference_number' => $this->input->post('cheque'),
                        'debit' => 1,
                        'user_id' => $user_id,
                        'bbf' => $amt);
                    $this->Product_model->saveBanking($payment3);
                } else {
                    $customer_field_id2 = $source;
                    $transaction_details2 = $this->MY_Model->fetch_limit('tbl_customers_transactions', 'customer_id', $customer_field_id2, 'customer_transaction_id', 'desc', 1);
                    if ($transaction_details2 != NULL) {
                        $bbf = $transaction_details2[0]->bbf - $this->input->post('amount');
                        $payment2 = array('customer_id' => $source,
                            'shift_id' => $shift_id,
                            'debit' => 1,
                            'amount' => $this->input->post('amount'),
                            'employee_id' => $user_id,
                            'transaction_type' => 4,
                            'payment_type' => $this->input->post('payment_type'),
                            'source' => $customer_field_id,
                            'ref_number' => $this->input->post('cheque'),
                            'bbf' => $bbf);
                        $customers_transaction_id2 = $this->Product_model->saveCustomerTransactions($payment2);
                    }
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
                echo "Payment could not be saved, Please try again";
            else
                echo "Payment has been successfully saved";
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function calculateBanking($procedure = null, $amount) {
        if ($this->session->userdata('logged_in')) {
            $bal = company_data()[0]->cash;
            if ($procedure == "add") {
                $update_add = array('cash' => ($bal + $amount));
                $this->Company_model->update(company_data()[0]->company_id, $update_add);
                return true;
            } elseif ($procedure == "subtract") {
                if ($bal < $amount) {
                    return FALSE;
                } else {
                    $update_subtract = array('cash' => ($bal - $amount));
                    $this->Company_model->update(company_data()[0]->company_id, $update_subtract);
                    if ($this->db->affected_rows() > 0) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return FALSE;
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }


        public function VatPayment1() {
        $this->load->model('Store_model', '', TRUE);
        if ($this->session->userdata('logged_in')) {
            $this->load->model('User_model', '', TRUE);
            $data['customers'] = $this->Company_model->get_list_customer();
            $data['sales'] = $this->Product_model->get_list_sales();
            $this->load->view('includes/header');
            $this->load->view('payment/sales', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }



    public function VatPayment() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('User_model', '', TRUE);
            $this->load->model('Ledger_model', '', TRUE);
            $data['payments'] = $this->Product_model->getlist_vendorPayments();
            $data['suppliers'] = $this->Company_model->get_list_suppliers();
            $data['custCards'] = $this->Company_model->get_list_custcards_pay();
            $data['mpesas'] = $this->Company_model->get_customer_by_category(3);
            $data['methods'] = $this->Product_model->getListTable('name', 'tbl_payment_type');
            $data['accounts'] = $this->Ledger_model->fetch_bank_accounts_items();
            $this->load->view('includes/header');
            $this->load->view('payment/VatPayment', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

}
