<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Backup extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->library('session');
    }

    function Backup_db() {
	    require_once( APPPATH.'libraries/BackupLibrary.php' );
        $backup = new BackupLibrary();
        $backup->backup_db(1);
    }

    function restore_backup($id = null) {
    	//get file details
    	$backup_details = $this->MY_Model->fetch_array('tbl_backup', 'id', $id, 'id', 'desc');
    	if(count($backup_details) > 0) {
    		$location = 'backups/';
    		$details = $backup_details[0];
    		$url = $details['url'];
    		if(file_exists($location.$url)) {
    			$this->load->dbutil();
    			$this->load->helper('file');
    			$this->load->library('user_agent');
    			$agent = array('browser' => $this->agent->browser(), 'version' => $this->agent->version(), 'platform' => $this->agent->platform(), 'agent' => $this->agent->agent);
    			$data = array('shift_id' => $details['shift_id'], 'user_id' => $this->session->userdata('logged_in')['user_id'], 'username' => ucwords($this->session->userdata('logged_in')['username']), 'name' => ucwords($this->session->userdata('logged_in')['name']), 'datetime' => date('Y-m-d H:i:s'), 'agent' => $agent, 'file_details' => array('zip' => $url, 'sql' => $details['file_name'].'.sql', 'previous' => current_shift_data()->shift_id));
    			$file_to_write = $details['file_name'].'-'.$this->session->userdata('logged_in')['user_id'].'-'.date('Y-m-d-H_i_s').'.php';
				write_file($location.$file_to_write, json_encode($data));
    			if ($this->dbutil->database_exists('fms')) {   				
	             	## Extract the zip file ---- start
	             	$zip = new ZipArchive;
	             	$res = $zip->open($location.$url);
	             	if ($res === TRUE) {
		               $extractpath = "backups/";
		               $zip->extractTo($extractpath);
		               $zip->close();
    					$file_name = $details['file_name'].'.sql';
    					if(file_exists($location.$file_name)) {
			               	$temp_line = '';
						    $lines = file('backups/'.$file_name); 
						    foreach ($lines as $line) {
						        if (substr($line, 0, 2) == '--' || $line == '' || substr($line, 0, 1) == '#')
						            continue;
						        $temp_line .= $line;
						        if (substr(trim($line), -1, 1) == ';')
						        {
						            $this->db->query($temp_line);
						            $temp_line = '';
						        }
						    }
    						$response = array('error' => false, 'message' => 'Upload & Extract successful');
						} else
    						$response = array('error' => true, 'message' => 'Sorry Failed to extract Active Backup');
	             	} else {
    					$response = array('error' => true, 'message' => 'Sorry Failed to extract Backup');
	             	}
				} else
    				$response = array('error' => true, 'message' => 'Sorry Database does not exist, please contact system admin');
    		} else {
    			$response = array('error' => true, 'message' => 'Sorry backup file not found, Please select another backup');
    		}
    	} else
    		$response = array('error' => true, 'message' => 'Sorry backup details not found, Please select another backup');
    	echo json_encode($response);
    }
}