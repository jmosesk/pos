<?php
class Centre_model extends CI_Model {
	
	private $tbl_user= 'tbl_centres';
	
	function __construct(){
		parent::__construct();
	}

	function list_all(){
		$this->db->order_by('grid_id','asc');
		return $this->db->get('tbl_grids');
	}

//Get List of All Active Centres
	function get_list_active(){
		$this->db->order_by('tbl_centres.centre_name', 'asc');
		$this->db->select('tbl_centres.centre_id, tbl_centres.centre_name, tbl_centres.description, tbl_centres.centre_type_id, tbl_centres.date_created, tbl_centres.status, tbl_centre_type.centre_type_id as type_id, tbl_centre_type.name');
		$this->db->join('tbl_centre_type', 'tbl_centre_type.centre_type_id = tbl_centres.centre_type_id', 'left');
		$this->db->where('tbl_centres.status', 1);
       	return $this->db->get('tbl_centres');
	}

//Get List of All Centres
	function get_list(){
		$this->db->order_by('tbl_centres.centre_name', 'asc');
		$this->db->select('tbl_centres.centre_id, tbl_centres.centre_name, tbl_centres.description, tbl_centres.centre_type_id, tbl_centres.date_created, tbl_centres.status, tbl_centre_type.centre_type_id as type_id, tbl_centre_type.name');
		$this->db->join('tbl_centre_type', 'tbl_centre_type.centre_type_id = tbl_centres.centre_type_id', 'left')
		->where('tbl_centres.deleted', 0);
       	return $this->db->get('tbl_centres');
	}

//Get List Non FC Centres
	function get_list_Nonfuel_centres(){
		$this->db->order_by('tbl_centres.centre_name', 'asc');
		$this->db->select('tbl_centres.centre_id, tbl_centres.centre_name, tbl_centres.description, tbl_centres.centre_type_id, tbl_centres.date_created, tbl_centres.status, tbl_centre_type.centre_type_id as type_id, tbl_centre_type.name');
		$this->db->join('tbl_centre_type', 'tbl_centre_type.centre_type_id = tbl_centres.centre_type_id', 'left');
		$this->db->where('tbl_centres.centre_type_id', 1)->where('tbl_centres.status', 1);
       	return $this->db->get('tbl_centres');
	}

//Get List FC Centres
	function get_list_fc_centres($type_id = null){
		$this->db->order_by('tbl_centres.centre_name', 'asc');
		$this->db->select('tbl_centres.centre_id, tbl_centres.centre_name, tbl_centres.description, tbl_centres.centre_type_id, tbl_centres.date_created, tbl_centres.status, tbl_centre_type.centre_type_id as type_id, tbl_centre_type.name');
		$this->db->join('tbl_centre_type', 'tbl_centre_type.centre_type_id = tbl_centres.centre_type_id', 'left');
		if($type_id != null) {
			$this->db->where_in('tbl_centres.centre_type_id', $type_id);
		}
		$this->db->where('tbl_centres.status', 1);
       	return $this->db->get('tbl_centres');
	}

//Get List Fuel Centres or Islands
	function get_list_fuel_centres(){
		$this->db->order_by('tbl_centres.centre_name', 'asc');
		$this->db->select('tbl_centres.centre_id, tbl_centres.centre_name, tbl_centres.description, tbl_centres.centre_type_id, tbl_centres.date_created, tbl_centres.status, tbl_centre_type.centre_type_id as type_id, tbl_centre_type.name');
		$this->db->join('tbl_centre_type', 'tbl_centre_type.centre_type_id = tbl_centres.centre_type_id', 'left');
		$this->db->where('tbl_centres.centre_type_id', 1);
       	return $this->db->get('tbl_centres');
	}

//Get List of Centre Types
	function get_list_centre_type(){
       	return $this->db->get('tbl_centre_type');
	}

	function count_all(){
		return $this->db->count_all($this->tbl_user);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_user, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('centre_id', $id);
		$query = $this->db->get('tbl_centres');
		if($query->num_rows() > 0){
    		return $query;
		} else {
			return null;
		}
	}

	function update($id, $user){
		$this->db->where('centre_id', $id);
		$this->db->update($this->tbl_user, $user);
	}

	function save($admin){
		$this->db->insert($this->tbl_user, $admin);
		return $this->db->insert_id();
	}

//Check if Centre Name exists
	function centre_name_exists($store_name){
		$this->db->where('centre_name', $store_name);
		$query = $this->db->get('tbl_centres');
		if ($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//Delete Centre	
	function deleteCentre($id, $status){
		$this->db->where('centre_id', $id);
		 $this->db->update($this->tbl_user, $status);	
		
	}

	//Activate Centre	
	function activateCentre($id, $status){
		$this->db->where('centre_id', $id);
		 $this->db->update($this->tbl_user, $status);
		
		
	}
}
?>