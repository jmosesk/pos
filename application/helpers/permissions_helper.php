<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

	function shift_has_rtt($sub_menu_id = NULL) {
	   	$CI =& get_instance();
	   	$CI->load->library('session');
	   	$role_id = $CI->session->userdata('logged_in')['role_id'];
	   	$is_allowed = $CI->MY_Model->fetch('tbl_menu_user_permissions', 'role_id', $role_id, 'role_id', 'asc', 'sub_menu_id', $sub_menu_id);
	   	if($is_allowed)
	   		return TRUE;
	   	else
	   		return FALSE;
	}

	function has_permissions($sub_menu_id = NULL, $type = NULL) {
	   	$CI =& get_instance();
	   	$CI->load->library('session');
	   	$role_id = $CI->session->userdata('logged_in')['role_id'];
	   	$is_allowed = $CI->MY_Model->fetch('tbl_menu_user_permissions', 'role_id', $role_id, 'role_id', 'asc', 'sub_menu_id', $sub_menu_id);
	   	if($is_allowed)
	   		return TRUE;
	   	else
	   		return FALSE;
	}

	function generate_menu() {
	   	$CI =& get_instance();
	   	$CI->load->library('session');
	   	$role_id = $CI->session->userdata('logged_in')['role_id'];
	   	if($role_id) {
			$query = $CI->db->query("SELECT tbl_menu_user_permissions.sub_menu_id as menu_id, tbl_menu.name as main_menu, tbl_menu.icon as icon, tbl_menu.link as menu_link
					FROM tbl_menu_user_permissions
					LEFT JOIN tbl_menu ON tbl_menu.menu_id = tbl_menu_user_permissions.sub_menu_id
					WHERE tbl_menu.deleted = 0
					AND tbl_menu_user_permissions.role_id = $role_id
					AND tbl_menu_user_permissions.sub_menu_type = 3
					GROUP BY tbl_menu_user_permissions.sub_menu_id
					ORDER BY tbl_menu.position, menu_id asc");
			$result = "";
			if($query) {
				foreach ($query->result() as $q) {
	                if($q->menu_link != "#") {
						$result .= '<li class="main-menu">';
						$icon = '';
	                } else {
						$result .= '<li class="nav-parent main-menu">';
						$icon = ' fa fa-caret-right';
	                }
					$result .= '
					<a href="'. base_url().$q->menu_link .'" class=" ">
						<i class="fa '. $q->icon .'"></i>
						<span>'.$q->main_menu .'</span>
						<i class="pull-right '.$icon.'" style="font-size: 12px;margin-top: 3%;"></i>
					</a>';
					$query_sub_menu = $CI->db->query("SELECT tbl_menu_sub.name as sub_menu, tbl_menu_sub.link as sub_menu_link, type
						FROM tbl_menu_user_permissions
						LEFT JOIN tbl_menu_sub ON tbl_menu_sub.sub_menu_id = tbl_menu_user_permissions.sub_menu_id
						WHERE tbl_menu_sub.deleted = 0 
						AND (tbl_menu_sub.type = 1 OR tbl_menu_sub.type = 4 OR tbl_menu_sub.type = 5) 
						AND tbl_menu_sub.menu_id = $q->menu_id 
						AND tbl_menu_user_permissions.role_id = $role_id
						GROUP BY tbl_menu_user_permissions.sub_menu_id
						ORDER BY tbl_menu_sub.position asc");
					if ($query_sub_menu) {
						$result .= '<ul class="children">';
						foreach ($query_sub_menu->result() as $sub_menu) {
							if($sub_menu->type == 5) {
								$space = "ml20";
								$result .= '<h6 class="sidebartitle sidebarsmall ml20">'.$sub_menu->sub_menu.'</h6>';
							} else {
								$space = "ml20";
								$result .= '<li class="sub-menu"><a href="'.base_url().$sub_menu->sub_menu_link.'"class="'.$space.'">'.$sub_menu->sub_menu.'</a></li>';
							}
						}
						$result .= '</ul>';
					}
					$result.= '</li>';
				}
			}
			echo $result;
		} else {
			echo("Oh snap! we experienced an error while loading your request, Please contact system admin");
			die();
		}
		/*$role_id = $this->session->userdata('role_id');
		if($role_id) {
			$query = $this->query("SELECT tbl_user_permissions.sub_menu_id as menu_id,tbl_menu.name as main_menu, tbl_menu.icon as icon, tbl_menu.link as menu_link
									FROM tbl_user_permissions
									LEFT JOIN tbl_menu ON tbl_menu.menu_id = tbl_user_permissions.sub_menu_id
									WHERE tbl_user_permissions.role_id = $role_id
									AND tbl_menu.deleted = 0
									GROUP BY tbl_user_permissions.sub_menu_id
									ORDER BY tbl_menu.position asc");
			$result = "";
			if($query) {
				foreach ($query as $q) {
					$result .= '<li class="sub-menu">
					<a href="'. base_url().$q->menu_link .'">
						<i class="fa '. $q->icon .'"></i>
						<span>'.$q->main_menu .'</span>
					</a>';
					$query_sub_menu = $this->query("SELECT tbl_menu_sub.name as sub_menu, tbl_menu_sub.link as sub_menu_link
										FROM tbl_user_permissions
										LEFT JOIN tbl_menu_sub ON tbl_menu_sub.sub_menu_id = tbl_user_permissions.sub_menu_id
										WHERE tbl_menu_sub.deleted = 0 AND tbl_menu_sub.type = 1 AND tbl_menu_sub.menu_id = $q->menu_id AND tbl_user_permissions.role_id = $role_id
									GROUP BY tbl_user_permissions.sub_menu_id
									ORDER BY tbl_menu_sub.position asc");
					if ($query_sub_menu) {
						$result .= '<ul class="sub">';
						foreach ($query_sub_menu as $sub_menu) {
							$result .= '<li><a href="'.base_url().$sub_menu->sub_menu_link.'">'.$sub_menu->sub_menu.'</a></li>';
						}
						$result .= '</ul>';
					}
					$result.= '</li>';
				}
			}
			echo ($result);
		} else {
		}*/
	}