<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author:     Samuel
 * @date:       12/17/19
 * @time:       12:18 PM
 * @description: base model
 */
class MY_Model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

    function get_list_permission($type, $role_id) {
        $this->db->select('sub_menu_id')->where_in('sub_menu_type', $type)
        		->where('role_id', $role_id)
        		->order_by('role_id', 'asc');
        $result = $this->db->get('tbl_menu_user_permissions')->result_array();
        $data = array();
        foreach ($result as $key => $value) {
            $data[] = $value['sub_menu_id'];
        }
        return $data;
    }

	function save($tbl, $data) {
		$this->db->insert($tbl, $data);
		return $this->db->insert_id();
	}

	function saveUUID($tbl, $data) {
		$this->db->insert($tbl, $data);
		$this->db->insert_id();
		if($this->db->affected_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}

	function update($tbl, $row, $id, $data, $row2 = NULL, $id2 = NULL, $row3 = NULL, $id3 = NULL) {
		$this->db->where($row, $id);
		if ($id2 != null)
			$this->db->where($row2, $id2);
		if($id3 != NULL) {
			$this->db->where($row3, $id3);
		}
		$this->db->update($tbl, $data);
	}

	function delete($tbl, $data, $type = NULL) {
		if ($type) {
			$this->db->where_in($data, $type);
			$this->db->delete($tbl);
		} else
		$this->db->delete($tbl, $data);
	}

	function updateTrans($tbl, $row, $id, $data) {
		$this->db->where($row, $id);
		$this->db->update($tbl, $data);
		if($this->db->affected_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}

	//Fetch all data
	function fetch($tbl, $where = NULL, $id, $order_by, $order_sequence, $where2 = NULL, $id2 = NULL, $where3 = NULL, $id3 = NULL, $where4 = NULL, $id4 = NULL) {
		$this->db->order_by($order_by, $order_sequence);
		if($where4 != NULL) {
			$this->db->where($where4, $id4);
		}
		if($where3 != NULL) {
			$this->db->where($where3, $id3);
		}
		if($where2 != NULL) {
			$this->db->where($where2, $id2);
		}
		if($where != NULL) {
			$this->db->where($where, $id);
		}
		$query = $this->db->get($tbl);
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return NULL;
		}
	}

	//Fetch all array
	function fetch_array($tbl, $where = NULL, $id, $order_by, $order_sequence, $where2 = NULL, $id2 = NULL, $where3 = NULL, $id3 = NULL) {
		$this->db->order_by($order_by, $order_sequence);
		if($where3 != NULL) {
			$this->db->where($where3, $id3);
		}
		if($where2 != NULL) {
			$this->db->where($where2, $id2);
		}
		if($where != NULL) {
			$this->db->where($where, $id);
		}
		$query = $this->db->get($tbl);
		return $query->result_array();
	}

	//Search
	function search_array($tbl, $where = NULL, $id, $order_by, $order_sequence, $where2 = NULL, $id2 = NULL, $where3 = NULL, $id3 = NULL) {
		$this->db->order_by($order_by, $order_sequence);
		if($where3 != NULL) {
			$this->db->like($where3, $id3);
		}
		if($where2 != NULL) {
			$this->db->like($where2, $id2);
		}
		if($where != NULL) {
			$this->db->like($where, $id);
		}
		$query = $this->db->get($tbl);
		return $query->result_array();
	}

	//Fetch all active data
	function get_all_active($tbl, $where = NULL, $id, $order_by, $order_sequence) {
		$this->db->order_by($order_by, $order_sequence);
		if($where != NULL) {
			$this->db->where($where, $id);
		}
		$query = $this->db->get($tbl);
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return NULL;
		}
	}

	function nameExists($tbl, $row1, $value1, $row2 = NULL, $value2 = NULL, $row3 = NULL, $value3 = NULL) {
		$this->db->order_by($row1, 'desc')
				->where($row1, $value1)->limit(1);
		if($row2 != NULL) {
			$this->db->where($row2, $value2);
		}
		if($value3 != NULL) {
			$this->db->where($row3.'!=', $value3);
		}
		$query = $this->db->get($tbl);
		if($query->num_rows() > 0){
			return FALSE;
		} else {
			return TRUE;
		}
	}

	//Fetch Limit
	function fetch_limit($tbl, $row1 = NULL, $value1 = NULL, $order_by, $order_sequence, $limit = NULL, $row2 = NULL, $value2 = NULL) {
		$this->db->order_by($order_by, $order_sequence);
		if ($row1 != NULL)
			$this->db->where($row1, $value1);
		if ($row2 != NULL)
			$this->db->where($row2, $value2);
		if ($limit != NULL)
			$this->db->limit($limit);
		$query = $this->db->get($tbl);
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return NULL;
		}
	}

	function query($query) {
		$q = $this->db->query($query);
		if($q->num_rows() > 0)
			return $q->result();
		else
			return NULL;
	}

	function count_all($tbl, $row = null, $where = null) {
		if ($row != NULL)
			$this->db->where($row, $where);
		$query = $this->db->get($tbl);
		if($query->num_rows() > 0) {
			return $this->db->count_all_results();
		} else {
			return 0;
		}
	}
}
