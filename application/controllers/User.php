<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    // num of records per page

    function __construct() {
        parent::__construct();

        // load library
        $this->load->library(array('table', 'form_validation'));

        // load helper
        $this->load->helper('url');

        // load model
        $this->load->model('User_model', '', TRUE);
    }

    function index($offset = 0) {
        if ($this->session->userdata('logged_in')) {
            $data['users'] = $this->User_model->get_list_active();
            $data['titles'] = $this->User_model->get_list_title();
            $data['roles'] = $this->User_model->get_list_role();
            $this->load->view('includes/header');
            $this->load->view('users/userList', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function employeePayment() {
        if ($this->session->userdata('logged_in')) {
            $data['users'] = $this->User_model->get_list_active();
            $this->load->view('includes/header');
            $this->load->view('users/employeePayment', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function employeeShortageList() {
        if ($this->session->userdata('logged_in')) {
            $data['users'] = $this->User_model->get_list_employee_shortage();
            $this->load->view('includes/header');
            $this->load->view('users/shortageList', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function employeeExcessList() {
        if ($this->session->userdata('logged_in')) {
            $data['users'] = $this->User_model->get_list_employee_excess();
            $this->load->view('includes/header');
            $this->load->view('users/excessList', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function employeeReport($user_id) {
        if ($this->session->userdata('logged_in')) {
            $this->load->view('includes/header');
            $data['cashiers'] = $this->Shift_model->getAllocatedUserById(current_shift_data()->shift_id);
            if ($data['cashiers']) {
                $search = null;
                $this->load->model('Shift_model', '', TRUE);
                $data['users'] = $this->User_model->employeeReport($user_id);
                $this->load->view('users/employeeReport', $data);
                $this->load->view('includes/swal');
            } else {
                $action = "<a href='" . base_url('Shift/centre_allocation_list') . "' class='btn btn-primary'>Allocate Cashiers</a>";
                display_error("Allocate Employees", 'Allocate Cashiers to continue', $action);
            }
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function addUser() {
        if ($this->session->userdata('logged_in')) {
            $admin = array('name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'role_id' => $this->input->post('role_id'),
                'title_id' => $this->input->post('title_id'),
                'phone_number' => $this->input->post('phone_number'),
                'employment_date' => date('Y-m-d', strtotime($this->input->post('employment'))));
            $User_id = $this->User_model->save($admin);
            if ($User_id) {
                $emp = array('emp_id' => $User_id, 'name' => $this->input->post('name'));
                $this->User_model->saveEmp($emp);
                echo "Employee record saved successfully";
            } else
                echo "Employee record not saved successfully, Please try again";
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function editUser($id = null) {
        if ($this->session->userdata('logged_in')) {
            if ($id == null) {
                //print_r($this->input->post()); die();
                $id = $this->input->post('item_id');

                if ($this->input->post('username') != null) {
                    $admin = array('name' => $this->input->post('name'),
                        'username' => $this->input->post('username'),
                        'role_id' => $this->input->post('role_id'),
                        'title_id' => $this->input->post('title_id'),
                        'phone_number' => $this->input->post('phone_number'),
                        'employment_date' => date('Y-m-d', strtotime($this->input->post('employment'))));
                } else {
                    $admin = array('name' => $this->input->post('name'),
                        'role_id' => $this->input->post('role_id'),
                        'title_id' => $this->input->post('title_id'),
                        'phone_number' => $this->input->post('phone_number'),
                        'employment_date' => date('Y-m-d', strtotime($this->input->post('employment'))));
                }
                $this->User_model->update($id, $admin);
                if ($this->db->affected_rows() > 0) {
                    echo "Employee record updated successfully";
                } else {
                    echo "Employee record not updated successfully, Please try again";
                }
            } else {
                $data['titles'] = $this->User_model->get_list_title();
                $data['roles'] = $this->User_model->get_list_role();
                $data['users'] = $this->User_model->get_by_id($id);
                $this->load->view('users/editUser', $data);
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function deleteUser($id) {
        if ($this->session->userdata('logged_in')) {

            //print_r($this->input->post());
            $user = array('deleted' => 1);
            $this->User_model->update($id, $user);
            echo "Employee record deleted successfully";
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function login() {
        $this->load->view('users/login');
    }

    function verifylogin() {
        //print_r($this->input->post()); die();
        $this->load->helper('security');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('users/login');
        } else {
            //saveAudits("Successful Log in", 3);
            $logged_in_time = array(
                'last_login' => date('Y-m-d H:i:s'));
            $this->User_model->update($this->session->userdata('logged_in')['user_id'], $logged_in_time);
            redirect('Payment/sales', 'refresh');
        }
    }

    function check_database($password) {
        $username = $this->input->post('username');
        $result = $this->User_model->login($username, $password);
        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'user_id' => $row->user_id,
                    'name' => $row->name,
                    'role_id' => $row->role_id,
                    'username' => $row->username
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid Username or Password');
            return false;
        }
    }

    function changepwd() {
        if ($this->session->userdata('logged_in')) {
            $user = $this->User_model->login($this->session->userdata('logged_in')['username'], $this->input->post('oldpasswrd'));
            if (empty($user))
                echo "Invalid password for logged in user!";
            else {
                $admin = array('password' => md5($this->input->post('passwrd')));
                $this->User_model->update($user[0]->user_id, $admin);
                echo "Password successfully changed";
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    public function logout() {
        //saveAudits("Successful Log Out", 3);
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('user/login', 'refresh');
    }

}

?>