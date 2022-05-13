<?php

class  MY_Controller  extends  CI_Controller  {

    function __construct() {
		parent::__construct();
	}

	function UpdateReciepts($item_id, $qty) {
		$this->load->model('Product_model','',TRUE);
		$item_type = $this->Product_model->get_by_id_products($item_id);
		if ($item_type) {

			$shift_id = current_shift_data()->shift_id;
			$this->load->model('Shift_model','',TRUE);
			if ($item_type->result()[0]->category_id != 1) {
				#Non Lubes
				if($this->Store_model->get_list_CloseProducts($shift_id)) {
					$item = $this->Store_model->get_list_CloseProductsItem($shift_id, $item_id);
					$rcpts = $item->result()[0]->receipts;
					$close_shift_id = $item->result()[0]->close_shift_id;
					$new_amount = $rcpts + $qty;  
					$recieves = array('receipts' => $new_amount);
					$this->Shift_model->updateRecord($close_shift_id, $recieves, 'tbl_close_shift_products', 'close_shift_id');
				}

			} else {
				//Lubes
				if($this->Store_model->get_list_CloseLubes($shift_id)) {
					$item = $this->Store_model->get_listCloseLubesReadingItem($shift_id, $item_id);
					$rcpts = $item->result()[0]->receipts;
					$close_shift_id = $item->result()[0]->close_shift_id;
					$new_amount = $rcpts + $qty;  
					$recieves = array('receipts' => $new_amount);
					$this->Shift_model->updateRecord($close_shift_id, $recieves, 'tbl_close_shift_lubes', 'close_shift_id');
				}
			}
		}
	}

	function UpdateRecieptsDippings($store_id, $qty, $type) {
		$shift_id = current_shift_data()->shift_id;
		$this->load->model('Store_model','',TRUE);
		if ($this->Store_model->get_listCloseDippingsReading($shift_id)) {
			$tank_details = $this->Store_model->get_list_CurrentShiftDippings($store_id, $shift_id);
			if ($tank_details) {
				$close_shift_id = $tank_details->close_shift_id;
					$bbf = $tank_details->bbf;
					$rcpts = $tank_details->reciepts;
					$new_amount = $rcpts + $qty;
					$recieves = array('reciepts' => $new_amount);
				$this->Shift_model->updateRecord($close_shift_id, $recieves, 'tbl_close_shift_dippings', 'close_shift_id');
				$this->update_not_closed('dippings');
			}
		}
	}

	function update_not_closed($type = null) {
		if ($type == null) {
			$type = "dippings";
		}
		$shift_id = current_shift_data()->shift_id;
        $save_meter = array($type => 0);
        $this->MY_Model->updateTrans('tbl_close_shift_values', 'shift_id', $shift_id, $save_meter);
	}

	function update_closed_readings($type = null) {
		if ($type == null) {
			$type = "dippings";
		}
		$shift_id = current_shift_data()->shift_id;
        $save_meter = array($type => 1);
        $this->MY_Model->updateTrans('tbl_close_shift_values', 'shift_id', $shift_id, $save_meter);
	}

	function fetch_permissions($role_id = null) {
		$main_menu_permissions = $this->MY_Model->get_list_permission(array(3), $role_id);
		$sub_menu_permissions = $this->MY_Model->get_list_permission(array(1, 2, 4), $role_id);
		$query = $this->db->query("SELECT tbl_menu.name as main_menu, tbl_menu.menu_id, tbl_menu.description FROM tbl_menu WHERE tbl_menu.deleted = 0 ORDER BY tbl_menu.position asc");

/*
		SELECT tbl_menu_user_permissions.sub_menu_id as menu_id, tbl_menu.name as main_menu, tbl_menu.icon as icon, tbl_menu.link as menu_link
					FROM tbl_menu_user_permissions
					LEFT JOIN tbl_menu ON tbl_menu.menu_id = tbl_menu_user_permissions.sub_menu_id
					WHERE tbl_menu.deleted = 0
					AND tbl_menu_user_permissions.role_id = $role_id
					AND tbl_menu_user_permissions.sub_menu_type = 3
					GROUP BY tbl_menu_user_permissions.sub_menu_id
					ORDER BY tbl_menu.position, menu_id asc


		SELECT tbl_menu_sub.name as sub_menu, tbl_menu_sub.link as sub_menu_link, type
						FROM tbl_menu_user_permissions
						LEFT JOIN tbl_menu_sub ON tbl_menu_sub.sub_menu_id = tbl_menu_user_permissions.sub_menu_id
						WHERE tbl_menu_sub.deleted = 0 
						AND (tbl_menu_sub.type = 1 OR tbl_menu_sub.type = 4 OR tbl_menu_sub.type = 5) 
						AND tbl_menu_sub.menu_id = $q->menu_id 
						AND tbl_menu_user_permissions.role_id = $role_id
						GROUP BY tbl_menu_user_permissions.sub_menu_id
						ORDER BY tbl_menu_sub.position asc*/
		$result = '';
		if($query->num_rows() > 0) {
			foreach ($query->result() as $q) {
				if(in_array($q->menu_id, $main_menu_permissions))
					$main_checked = "checked";
				else
					$main_checked = "";
				$result .= '<div class="row">
							<div class="panel panel-default">
  								<div class="panel-heading ptb10-0">
  								<label class="h5 mt0">
									<input type="checkbox" '.$main_checked.' name="main_menu[]" class="'.$q->menu_id.'" value="'.$q->menu_id.'" id="'.$q->menu_id.'" onclick="checkAll(this)"/> '.$q->main_menu.' : <small class="text-muted">'.$q->description.'</small>
								</label>
								<div class="clear-fix"></div>
							</div>
  								<div class="panel-body plr-20 ptb10-0">';
				$query_sub_menu = $this->db->query("SELECT tbl_menu_sub.name as sub_menu, tbl_menu_sub.sub_menu_id as sub_menu_id
								FROM tbl_menu_sub WHERE tbl_menu_sub.deleted = 0 AND (tbl_menu_sub.type = 1 OR tbl_menu_sub.type = 4) AND tbl_menu_sub.menu_id = $q->menu_id ORDER BY tbl_menu_sub.position asc");
				$query_sub_menu_action = $this->db->query("SELECT tbl_menu_sub.name as sub_menu, tbl_menu_sub.sub_menu_id as sub_menu_id
								FROM tbl_menu_sub WHERE tbl_menu_sub.deleted = 0 AND tbl_menu_sub.type = 2 AND tbl_menu_sub.menu_id = $q->menu_id ORDER BY tbl_menu_sub.position asc");
				if($query_sub_menu->num_rows() > 0 || $query_sub_menu_action->num_rows() > 0) {
					$result .= '<div class="col-md-6">';
					if ($query_sub_menu->num_rows() > 0) {
						$result .= '<div class="ml-10">';
						foreach ($query_sub_menu->result() as $sub_menu) {					
							if(in_array($sub_menu->sub_menu_id, $sub_menu_permissions))
								$sub_checked = "checked";
							else
								$sub_checked = "";
							$result .= '<div class="col-md-12"><label class="">
								<input type="checkbox" name="sub_menu[]" '.$sub_checked.' class="class-'.$q->menu_id.'" value="'.$sub_menu->sub_menu_id.'"/> '.$sub_menu->sub_menu.'</label></div>';
						}
						$result .= '</div>';
					}
					$result .= '</div><div class="col-md-6">';
					if ($query_sub_menu_action->num_rows() > 0) {
						$result .= '<div class="ml-10"><span class="text-primary">Special Actions</span>';
						foreach ($query_sub_menu_action->result() as $sub_menu_action) {					
							if(in_array($sub_menu_action->sub_menu_id, $sub_menu_permissions))
								$special_checked = "checked";
							else
								$special_checked = "";
							$result .= '<div class="col-md-12"><label class="">
								<input type="checkbox" name="sub_menu_action[]" '.$special_checked.' class="class-'.$q->menu_id.'" value="'.$sub_menu_action->sub_menu_id.'"/> '.$sub_menu_action->sub_menu.'</label></div>';
						}
						$result .= '</div>';
					}
					$result .= '</div>';
				}
				$result .= '</div></div></div>';
			}
			$result .= '<div class="clearfix"></div>';
			return $result;
		}
	}
}