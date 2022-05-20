<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function permission($id = null, $nm = null) {
        if ($this->session->userdata('logged_in')) {
            $data['results'] = $this->fetch_permissions($id);
            //$role_id = $this->session->userdata('logged_in')['role_id'];
            $data['id'] = $id;
            $data['name'] = $nm;
            $this->load->view('includes/header');
            $this->load->view('admin/permission', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function roles() {
        if ($this->session->userdata('logged_in')) {
            $data['users'] = $this->MY_Model->fetch('tbl_roles', null, null, 'name', 'asc');
            $this->load->view('includes/header');
            $this->load->view('admin/roleList', $data);
            $this->load->view('includes/footer');
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function editRole($id = null) {
        if ($this->session->userdata('logged_in')) {
            if($id == null) {
                $id = $this->input->post('item_id');
                //check name
                $name_exists = $this->MY_Model->fetch('tbl_roles', 'name', $this->input->post('name'), 'name', 'asc');
                if($name_exists != NULL && $name_exists[0]->role_id != $id) {
                    echo "Update failed, similar name exist. Please select a different name";
                } else {
                    $role_data = array('name' => $this->input->post('name'));
                    if($this->MY_Model->updateTrans('tbl_roles', 'role_id', $id, $role_data))
                        echo "Role record updated successfully";
                    else
                        echo "Role record not updated, Please change name and try again";
                }
            } else {
                $data['users'] = $this->MY_Model->fetch('tbl_roles', 'role_id', $id, 'name', 'asc');
                $this->load->view('Admin/editRole', $data);
            }
        } else {
            redirect('user/login', 'refresh');
        }
    }

    function deleteUser($id = null) {
        $data = array('role_id' => $id);
        $this->MY_Model->delete('tbl_roles', $data);
        echo "Role has been deleted";
    }

    function deletePurge($id = null) {
        $data = array($this->input->post('row') => $this->input->post('id'));
        $this->MY_Model->delete($this->input->post('tbl'), $data);
        $response = array('success' => true, 'message' => " success");
        echo json_encode($response);
    }

    function delete() {
        $data = array('deleted' => 1);
        if($this->input->post('data'))
            $data = ($this->input->post('data'));
        if($this->MY_Model->updateTrans($this->input->post('tbl'), $this->input->post('row'), $this->input->post('id'), $data))
            $response = array('success' => true, 'message' => "Request Successful");
        else
            $response = array('success' => false, 'message' => "Request Failed, Please try again");
        echo json_encode($response);
    }

    function assignPermission() {
        $post = $this->input->post();
        if($post['role_id'] != null) {
            $this->MY_Model->delete('tbl_menu_user_permissions', array('role_id' => $post['role_id']));
            if (@$post['main_menu']) {
                for ($i=0; $i < count($post['main_menu']); $i++) {
                    $save_main_menu = array('role_id' => $post['role_id'], 'sub_menu_id' => $post['main_menu'][$i], 'sub_menu_type' => 3);
                    $this->MY_Model->save('tbl_menu_user_permissions', $save_main_menu);
                }
            }
            if (@$post['sub_menu']) {
                for ($i=0; $i < count($post['sub_menu']); $i++) {
                    $save_sub_menu = array('role_id' => $post['role_id'], 'sub_menu_id' => $post['sub_menu'][$i], 'sub_menu_type' => 1);
                    $this->MY_Model->save('tbl_menu_user_permissions', $save_sub_menu);
                }
            }
            if (@$post['sub_menu_action']) {
                for ($i=0; $i < count($post['sub_menu_action']); $i++) {
                    $save_sub_menu_action = array('role_id' => $post['role_id'], 'sub_menu_id' => $post['sub_menu_action'][$i], 'sub_menu_type' => 2);
                    $this->MY_Model->save('tbl_menu_user_permissions', $save_sub_menu_action);
                }
            }
            $resp = array('error' => FALSE, 'message' => "Permissions have been assigned successfully");
        } else {
            $resp = array('error' => FALSE, 'message' => "Error saving data, please try again");
        }
        echo json_encode($resp);
    }

    function fetch_id() {
        $post = $this->input->post();
        $tbl = $post['tbl'];
        $row = $post['row'];
        $id = $post['id'];
        $response = $this->MY_Model->fetch_array($tbl, $row, $id, $row, 'desc');
        echo json_encode($response);
    }

    function return_id() {
        $post = $this->input->post();
        $tbl = $post['tbl'];
        $row = $post['row'];
        $id = $post['id'];
        $response = $this->MY_Model->fetch_array($tbl, $row, $id, $row, 'desc');
        if (count($response) > 0) {
           $json['valid'] = false;
        } else {
            $json['valid'] = true;
        }
        echo json_encode($json);
    }
}