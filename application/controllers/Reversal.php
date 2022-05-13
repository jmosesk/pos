<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reversal extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
    }

    function shortage_reversal() {
        if ($this->session->userdata('logged_in')) {
            if(isset($_POST['type'])) {
                $type = $this->input->post('type');
                $post = $this->input->post();
                if($type == 'Shortage' || $type == 'Excess') {
                    if($type == 'Shortage') {
                        $short = array('status' => 1);
                        $data = $this->MY_Model->fetch('tbl_close_shift_debit_user', 'adjust_amt_id', $post['id'], 'adjust_amt_id', 'desc');
                        $adjustment = array('short_id' => $post['id'], 'shift_id' => current_shift_data()->shift_id, 'amount' => -($data['0']->amount), 'user_id' => $post['cashier']);
                        $this->MY_Model->updateTrans('tbl_close_shift_debit_user', 'adjust_amt_id', $post['id'], $short);
                            $this->MY_Model->save('tbl_close_shift_debit_user_reversal', $adjustment);
                            $response = array('error' => false, 'message' => $type.' Reversal was Successful');
                    } else 
                        $response = array('error' => true, 'message' => $type.' could not be processed');
                } else if($type == "Shift Reversal") {
                    $data = $this->MY_Model->fetch('tbl_close_shift_debit_user', 'adjust_amt_id', $post['id'], 'adjust_amt_id', 'desc');
                    $new_amount = ($data['0']->amount - $data['0']->amount);
                    $adjustment = array('excess' => $new_amount);
                    $this->MY_Model->update('tbl_close_shift_drops', 'shift_id', $data[0]->shift_id, $adjustment, 'user_id', $data[0]->user_id);
                    $delete_data = array('adjust_amt_id' => $post['id']);
                    $this->db->delete('tbl_close_shift_debit_user', $delete_data);
                    $response = array('error' => false, 'message' => $type.' Reversal was Successful');
                }
            } else {
                $response = array('error' => true, 'message' => 'Sorry we can not complete request, Please contact System Admin');
            }
            echo json_encode($response);
        } else {
            redirect('user/login', 'refresh');
        }
    }
}

?>