<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('Report_model','',TRUE);
	}
	
	public function stockTransferReport() {
		if($this->session->userdata('logged_in')) {
			$data['transfers'] = $this->Report_model->stockTransferReport();
			$this->load->view('includes/header');
			$this->load->view('reports/stockTransferReport', $data);
			$this->load->view('includes/footer');
		} else {
			redirect('user/login','refresh');
		}
	}
	
	public function purchaseReport() {
		if($this->session->userdata('logged_in')) {
			$data['transfers'] = $this->Report_model->purchaseReport();
			$this->load->view('includes/header');
			$this->load->view('reports/purchaseReport', $data);
			$this->load->view('includes/footer');
		} else {
			redirect('user/login','refresh');
		}
	}

	function CreditReport() {
		if($this->session->userdata('logged_in')) {
			$this->load->view('includes/header');
			$this->load->view('reports/creditReport');
			$this->load->view('includes/footer');
		} else {
			redirect('user/login','refresh');
		}
	}

	function credit_report_detail($type = null) {
		if($this->session->userdata('logged_in')) {
			if($type == 'customer' || $type == 'cashier') {
				$data['type'] = ucfirst($type);
				$data['transactions'] = $this->Report_model->creditReport_detailed();
				//print_r($data['transactions']->result()); die();
				$this->load->view('includes/header');
				$this->load->view('reports/creditReport_detailed', $data);
				$this->load->view('includes/footer');
			} else {
				$this->session->set_flashdata('error_msg', 'Please select report type to continue');
				redirect('Reports/CreditReport');
			}
		} else {
			redirect('user/login','refresh');
		}
	}

	function DebitReport() {
		if($this->session->userdata('logged_in')) {
			$data['statements'] = $this->Report_model->creditReport();
			$this->load->view('includes/header');
			$this->load->view('reports/debitReport', $data);
			$this->load->view('includes/footer');
		} else {
			redirect('user/login','refresh');
		}
	}

	function ExpenseReport() {
		if($this->session->userdata('logged_in')) {
			$this->load->model('Company_model','',TRUE);
            $data['expenses'] = $this->Company_model->get_list_all_expenses();
			$this->load->view('includes/header');
			$this->load->view('shift/ExpenseReport', $data);
			$this->load->view('includes/footer');
		} else {
			redirect('user/login','refresh');
		}
	}

	function salesReport() {
		if($this->session->userdata('logged_in')) {
			$data['transfers'] = $this->Report_model->salesReport();
			$this->load->view('includes/header');
			$this->load->view('reports/salesReport', $data);
			$this->load->view('includes/footer');
		} else {
			redirect('user/login','refresh');
		}
	}
	
	public function meterMovementReport() {
		if($this->session->userdata('logged_in')) {
			//Get all Shifts that are closed
			//Get that data given shift ID
			$this->load->model('Shift_model','',TRUE);
			$data['shifts'] = $this->Report_model->get_list_closed_fuel_shifts();
			$this->load->view('includes/header');
			$this->load->view('reports/meterMovementReport', $data);
			$this->load->view('includes/footer');
		} else {
			redirect('user/login','refresh');
		}
	}
	
	public function variationReport() {
		if($this->session->userdata('logged_in')) {
			$data['variations'] = $this->Report_model->get_list_stockVariations();
			$this->load->view('includes/header');
			$this->load->view('reports/stockVariationReport', $data);
			$this->load->view('includes/footer');
		} else {
			redirect('user/login','refresh');
		}
	}
	
	public function valuationReport()
	{
		if($this->session->userdata('logged_in'))
		{
			//per category
			$this->load->model('Store_model','',TRUE);
			$data['valuations'] = $this->Report_model->get_list_Valuation();
			//$data['stores'] = $this->Report_model->get_list_StoresValuationID($id);
			$this->load->view('includes/header');
			$this->load->view('reports/stockValuationReport', $data);
			$this->load->view('includes/footer');
		}
		else
		{
			redirect('user/login','refresh');
		}
	}

	public function VendorReport()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->model('Product_model','',TRUE);
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$vendor = $this->input->post('vendor');
			if($vendor != null){
				$this->load->model('Company_model','',TRUE);
				$data['suppliers'] = $this->Company_model->get_list_suppliers();
				$data['statements'] = $this->Product_model->get_SupplierStatement($vendor, $date_from, $date_to);
				if($date_from !=null) {
					$data['opening_debit'] = $this->Product_model->sum__debit_opening_balance($vendor, $date_from);
					$data['opening_credit'] = $this->Product_model->sum__credit_opening_balance($vendor, $date_from);
				} else {
					$data['opening_debit'] = NULL;
					$data['opening_credit'] = NULL;
				}
				$this->load->view('includes/header');
				$this->load->view('reports/vendorReport', $data);
				$this->load->view('includes/footer');
			} else {
				$this->load->model('Report_model','',TRUE);
				$this->load->model('Company_model','',TRUE);
				$data['suppliers'] = $this->Company_model->get_list_suppliers();
				$data['statements'] = NULL;
				$this->load->view('includes/header');
				$this->load->view('reports/vendorReport', $data);
				$this->load->view('includes/footer');
			}
		}
		else
		{
			redirect('user/login','refresh');
		}
	}

	public function CustomerReport() {
		if($this->session->userdata('logged_in')) {
			$this->load->model('Product_model','',TRUE);
			if(count($this->input->post()) > 0) {
				echo json_encode($this->Product_model->get_CustomerStatement($this->input->post()));
			} else {
				$this->load->model('Company_model','',TRUE);
				$data['customers'] = $this->Company_model->get_customers();
				$data['statements'] = array();
				$this->load->view('includes/header');
				$this->load->view('reports/customerReport', $data);
				$this->load->view('includes/footer');
			}
		} else {
			redirect('user/login','refresh');
		}
	}
        public function CustomerReportExcel() {
		if($this->session->userdata('logged_in')) {
			$this->load->model('Product_model','',TRUE);
			if(count($this->input->post()) > 0) {
				echo json_encode($this->Product_model->get_CustomerStatement($this->input->post()));
			} else {
				$this->load->model('Company_model','',TRUE);
				$data['customers'] = $this->Company_model->get_customers();
				$data['statements'] = array();
				$this->load->view('includes/header');
				$this->load->view('reports/customerReportE', $data);
				$this->load->view('includes/footer');
			}
		} else {
			redirect('user/login','refresh');
		}
	}


	public function Mpesa_report()
	{
		if($this->session->userdata('logged_in')) {
			if(count($this->input->post()) > 0) {
				echo json_encode($this->Report_model->mpesa_statement($this->input->post()));
			} else {
				$data['statements'] = array();
				$this->load->view('includes/header');
				$this->load->view('shiftReports/mpesa_statement', $data);
				$this->load->view('includes/footer');
			}
		} else {
			redirect('user/login','refresh');
		}
	}
}
