<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackupLibrary {
 
    public function __construct($config = array()) {
        $this->Ci = & get_instance();
        $this->Ci->load->model('MY_Model');
    }

	function backup_db($system = 1) {
		$this->Ci->load->dbutil();
		$shift_id = current_shift_data()->shift_id;
		$shift_data = $this->Ci->MY_Model->fetch('tbl_backup', 'shift_id', $shift_id, 'datetime', 'desc');
		$shift_name = $shift_id;
		if($shift_data) {
			$shift_name = $shift_name.'_'.uniqid();
		}
		$zip_name = 'backup-on-'. date("Y-m-d-H-i-s").'_'.$shift_name.'.zip';
		$saveFile = array('shift_id' => $shift_id, 'file_name' => $shift_name, 'url' => $zip_name, 'system' => $system);
		$prefs = array(     
		    'format'      => 'zip',             
		    'filename'    => $shift_name
		);
		$this->Ci->MY_Model->save('tbl_backup', $saveFile);
		$backup = $this->Ci->dbutil->backup($prefs);
		$this->Ci->load->helper('file');
		$save = 'backups/'.$zip_name;
		write_file($save, $backup);
	}
}