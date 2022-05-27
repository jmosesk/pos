<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ShiftReports extends MY_Controller {

    var $previous_shift;

    function __construct() {
        parent::__construct();

        // load library
        $this->load->library(array('table', 'form_validation'));

        // load helper
        $this->load->helper('url');

        // load model
        $this->load->model('ShiftReports_model', '', TRUE);
        $this->load->model('Company_model', '', TRUE);
        $this->previous_shift = $this->ShiftReports_model->last_closed_shift();
    }

    public function cashSummaryReport() {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->cashSummaryReport($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/cash_summary_report');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function customerSummaryReport() {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->customerSummaryReport($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/customer_summary_report');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function employeeSummaryReport() {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->employeeSummaryReport($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/employee_summary_report');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function supplierSummaryReport() {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->supplierSummaryReport($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/supplier_summary_statement');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function expenseReport() {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->expense_report($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/expenseReport');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function salesSummary() {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->salesSummary($this->input->post()));
            } else {
                $data['statements'] = array();
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/salesSummary', $data);
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function meterMovement($shift_id = null) {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->meterMovement($this->input->post()));
            } else {
                $data['statements'] = array();
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/meterMovement', $data);
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function stockCalculation($shift_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->stockCalculation($this->input->post()));
            } else {
                $data['statements'] = array();
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/stockCalculation', $data);
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function inventoryReport($shift_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->inventoryReport($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/inventoryReport');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function salesReport($shift_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->salesReport($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                //$this->load->view('shiftReports/salesReport');
                $this->load->view('shiftReports/salesSummaryReport');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function total_sales_report($shift_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->total_sales_report($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/total_sales_report');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function employee_sales_report($shift_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->employee_sales_report($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/employee_sales_report');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function salesSummaryReport($shift_id = NULL) {
        if ($this->session->userdata('logged_in')) {

             $this->ShiftReports_model->save_rpt_sales();
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->salesSummaryReport($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/salesSummaryReport');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function purchaseSummaryReport($shift_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->purchaseSummaryReport($this->input->post()));
                //print_r($this->db->last_query());
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('reports/purchaseSummaryReport');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function purchaseDetailedReport() {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->purchaseDetailedReport($this->input->post()));
            } else {
                $this->load->model('Company_model', '', TRUE);
                $data['customers'] = $this->Company_model->get_customers();
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/purchaseDetailedReport', $data);
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function dailyCashier($shift_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->dailyCashier($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/dailyCashier');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function dailyCashSummary($shift_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if ($this->input->post('shift_id'))
                $shift_id = $this->input->post('shift_id');
            else
                $shift_id = $this->previous_shift;
            $data['shifts'] = $this->ShiftReports_model->get_list_shifts();
            $data['shift_id'] = $shift_id;
            $data['allocations'] = $this->ShiftReports_model->get_allocation_users($shift_id);
            $data['fuels'] = $this->ShiftReports_model->FuelSalesPerItem($shift_id);
            $data['fuel_credits'] = $this->ShiftReports_model->CreditSalesFuel($shift_id);
            $data['centres'] = $this->ShiftReports_model->NonFuelCentres();

            $data['lpgs'] = $this->ShiftReports_model->LpgSales($shift_id);
            $data['lubes'] = $this->ShiftReports_model->LubesSales($shift_id);

            $data['job_cards'] = $this->ShiftReports_model->SalesJobCards($shift_id);
            $data['credit_sales'] = $this->ShiftReports_model->SumAllCreditSales($shift_id);
            $data['reciepts'] = $this->ShiftReports_model->SumAllPayments($shift_id);
            $data['payments'] = $this->ShiftReports_model->SumAllRecievings($shift_id);
            $data['total_excess'] = $this->ShiftReports_model->TotalReciepts($shift_id);
            $data['bankings'] = $this->ShiftReports_model->TotalBankings($shift_id);

            $this->load->view('includes/header');
            $this->load->view('shiftReports/dailyCashSummary', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function stockCalculationUllage($shift_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if ($this->input->post('shift_id'))
                $shift_id = $this->input->post('shift_id');
            else
                $shift_id = $this->previous_shift;
            $data['shifts'] = $this->ShiftReports_model->get_list_shifts();
            $data['shift_id'] = $shift_id;
            $data['allocations'] = $this->ShiftReports_model->get_allocation_users($shift_id);
            $data['tanks'] = $this->ShiftReports_model->stockCalculation($shift_id);
            //print_r($data['tanks']->result());
            $this->load->view('includes/header');
            $this->load->view('shiftReports/stockCalculationUllage', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function receiptsRegister($shift_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if ($this->input->post('shift_id'))
                $shift_id = $this->input->post('shift_id');
            else
                $shift_id = $this->previous_shift;
            $data['shifts'] = $this->ShiftReports_model->get_list_shifts();
            $data['users'] = $this->ShiftReports_model->RecieptsPerUser($shift_id);
            $data['shift_id'] = $shift_id;
            $this->load->view('includes/header');
            $this->load->view('shiftReports/receiptsRegister', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function stockTransfer($shift_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if ($this->input->post('shift_id'))
                $shift_id = $this->input->post('shift_id');
            else
                $shift_id = $this->previous_shift;
            $data['shifts'] = $this->ShiftReports_model->get_list_shifts();
            $data['users'] = $this->ShiftReports_model->stockTransfer($shift_id);
            $data['allocations'] = $this->ShiftReports_model->get_allocation_users($shift_id);
            $data['shift_id'] = $shift_id;
            $this->load->view('includes/header');
            $this->load->view('shiftReports/stockTransfer', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function stockAdjustment($shift_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if ($this->input->post('shift_id'))
                $shift_id = $this->input->post('shift_id');
            else
                $shift_id = $this->previous_shift;
            $data['shifts'] = $this->ShiftReports_model->get_list_shifts();
            $data['shift_id'] = $shift_id;
            $data['allocations'] = $this->ShiftReports_model->get_allocation_users($shift_id);
            $data['users'] = $this->ShiftReports_model->stockAdjustment($shift_id);
            $this->load->view('includes/header');
            $this->load->view('shiftReports/stockAdjustment', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function meterVariance($shift_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if ($this->input->post('shift_id'))
                $shift_id = $this->input->post('shift_id');
            else
                $shift_id = $this->previous_shift;
            $data['shifts'] = $this->ShiftReports_model->get_list_shifts();
            $data['users'] = $this->ShiftReports_model->meterVariance($shift_id);
            //print_r($data['users']->result()); die();
            $data['allocations'] = $this->ShiftReports_model->get_allocation_users($shift_id);
            $data['shift_id'] = $shift_id;
            $this->load->view('includes/header');
            $this->load->view('shiftReports/meterVariance', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function customerStatement() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('Product_model', '', TRUE);
            if (count($this->input->post()) > 0) {
                echo json_encode($this->Product_model->getCustomerStatement($this->input->post()));
            } else {
                $this->load->model('Company_model', '', TRUE);
                $data['customers'] = $this->Company_model->get_customers();
                $this->load->view('includes/header');
                $this->load->view('shiftReports/customerStatement', $data);
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function supplierStatement() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('Product_model', '', TRUE);
            if (count($this->input->post()) > 0) {
                echo json_encode($this->Product_model->getSupplierStatement($this->input->post()));
            } else {
                $this->load->model('Company_model', '', TRUE);
                $data['suppliers'] = $this->Company_model->get_suppliers();
                $this->load->view('includes/header');
                $this->load->view('shiftReports/supplierStatement', $data);
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function customerStatement1($customer_id = NULL, $from = NULL, $to = NULL) {
        if ($this->session->userdata('logged_in')) {
            if ($this->input->post('customer_id'))
                $customer_id = $this->input->post('customer_id');
            else
                $customer_id = $this->ShiftReports_model->getCustomers()->result()[0]->person_id;
            $data['customers'] = $this->ShiftReports_model->getCustomers();
            $data['users'] = $this->ShiftReports_model->customerStatement($customer_id);
            //$data['users'] = $this->ShiftReports_model->meterVariance($shift_id);
            //print_r($data['users']->result()); die();
            //$data['allocations'] = $this->ShiftReports_model->get_allocation_users($shift_id);
            $data['customer_id'] = $customer_id;
            $this->load->view('includes/header');
            $this->load->view('shiftReports/customerStatement', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function vendorStatement($customer_id = NULL, $from = NULL, $to = NULL) {
        if ($this->session->userdata('logged_in')) {
            if ($this->input->post('customer_id'))
                $customer_id = $this->input->post('customer_id');
            else
                $customer_id = $this->ShiftReports_model->getSuppliers()->result()[0]->supplier_id;
            $from = $this->input->post('date_from');
            $to = $this->input->post('date_to');
            $data['customers'] = $this->ShiftReports_model->getSuppliers();
            $data['users'] = $this->ShiftReports_model->supplierStatement($customer_id, $from, $to);
            //print_r($this->db->last_query());
            $bal = $this->ShiftReports_model->opening_balance($customer_id, $from);
            if ($this->input->post('date_from')) {
                if ($bal != NULL)
                    $data['opening_balance'] = $bal->bal;
                else
                    $data['opening_balance'] = 0;
            } else
                $data['opening_balance'] = 0;
            //print_r($this->db->last_query());
            $data['customer_id'] = $customer_id;
            $this->load->view('includes/header');
            $this->load->view('shiftReports/supplierStatement', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function salesRegister() {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->salesRegister($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/salesRegister');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function CreditRegisterByCustomer($shiftd = NULL, $invoice_date = Null) {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('Product_model');
            if ($this->input->post('date_from')) {
                $invoice_date = $this->input->post('date_from');
            } else {
                $invoice_date = current_shift_data()->shift_date;
            }
            if ($this->input->post('shift')) {
                $shiftd = $this->input->post('shift');
            } else {
                $shiftd = current_shift_data()->shift_name_id;
            }
            $shift = get_ShiftByID($invoice_date, $shiftd);
            if ($shift != NULL) {
                $data1 = $shift->shift_id;
            } else {
                $data1 = current_shift_data()->shift_id;
            }
            $data['sales'] = $this->Product_model->get_list_sales_inv($data1);
            $this->load->view('includes/header');
            $this->load->view('shiftReports/creditRegister', $data);
            $this->load->view('includes/swal');
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function wetStockSummary($item_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->wetStockSummary($this->input->post()));
            } else {
                $data['items'] = $this->ShiftReports_model->getFuelProducts();
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/wetStockSummary', $data);
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function wetStockDetailed($item_id = NULL) {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->wetStockDetailed($this->input->post()));
            } else {
                $data['tanks'] = $this->ShiftReports_model->getFuelTanks();
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('shiftReports/wetStockDetailed', $data);
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function purchaseReport() {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->purchaseReport($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('reports/purchaseReport');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function employeeReport() {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->employeeReport($this->input->post()));
            } else {
                $data['employees'] = $this->MY_Model->fetch_array('tbl_users', 'deleted', 0, 'name', 'asc');
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('reports/employeeReport', $data);
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function VatReturnFile() {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->VatReturnFile($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('reports/vatReturnFile');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

        public function vatDetailed() {


        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                // var_dump($this->input->post());exit();//
                echo json_encode($this->ShiftReports_model->vatDetailed($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('reports/vatDetailed');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }


        public function incomeStatement() {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->incomeStatement($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('reports/incomeStatement');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }



        public function trialBalance() {
        if ($this->session->userdata('logged_in')) {
            if (count($this->input->post()) > 0) {
                echo json_encode($this->ShiftReports_model->trialBalance($this->input->post()));
            } else {
                $this->load->view('includes/header');
                $this->load->view('includes/load_picker_filter');
                $this->load->view('reports/trialBalance');
                $this->load->view('includes/swal');
                $this->load->view('includes/footer');
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

}
