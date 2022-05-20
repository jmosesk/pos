<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email_Report
 *
 * @author alpha star
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Email_Report extends MY_Controller {
    //put your code here
     function __construct() {
        parent::__construct();
        $this->load->library('Pdf');
        $this->load->library('phpmailer_lib');
    }
    function cashRecon(){
        
    }
    
}
