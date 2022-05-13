<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Excel extends MY_Controller {

    function __construct() {
        parent::__construct();
       $this->load->library('Excel_lib'); 

              
    }

    function index() {
        // Put the html into a temporary file
        $post = $this->input->post();
        $heading_array = json_decode($post['sub_heading'], TRUE);
        $footer = json_decode($post['data_footer']);
        $table_values = json_decode($post['data_val'], TRUE);
        $set_html = <<<EOD
            <h3>{$heading_array['sub_heading_1']}</h5>
            <h4>{$heading_array['sub_heading_2']}</h4>
            {$table_values}
            <br>
            {$footer}
        EOD;
        $tmpfile = time() . '.html';
        file_put_contents($tmpfile, $set_html);

// Read the contents of the file into PHPExcel Reader class
        $reader = new PHPExcel_Reader_HTML;
        $content = @$reader->load($tmpfile);

// Pass to writer and output as needed
        $objWriter = PHPExcel_IOFactory::createWriter($content, 'Excel2007');
        // We'll be outputting an excel file
         header('Content-type: application/vnd.ms-excel');
        // It will be called file.xls
         header('Content-Disposition: attachment; filename="file.xlsx"');
        // Write file to the browser
        $objWriter->save('php://output');
        // Pass to writer and output as needed
       // $objWriter->save('excelfile.xlsx');
      //  $objWriter->save('assets/files/temp/excelfile.xlsx');
        // Delete temporary file
        unset($tmpfile);
       // unlink($tmpfile);
        return false;
    }

}
