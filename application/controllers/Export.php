<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Export extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Pdf');
        $this->load->library('Excel_lib');
    }

    function index() {
        //$this->load->library('Pdf');
        $this->load->library('phpmailer_lib');
        //$this->output->delete_cache();
        $post = $this->input->post();
        //print_r($post); die();
        $export_type = "D";
        if ($post['export_type'] == "I") {
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
        } else {
            $heading_array = json_decode($post['sub_heading'], TRUE);
            $footer = json_decode($post['data_footer']);
            $table_values = json_decode($post['data_val'], TRUE);
            $pdf = new TCPDF("POTRAIT", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor(PDF_AUTHOR);

            $pdf->setPrintFooter(false);
            $pdf->setPrintHeader(false);

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(10, 3, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(0);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            $pdf->setFontSubsetting(true);
            $pdf->SetFont('helvetica', 'B', 10, '', true);
            $pdf->SetTitle("FMS - " . $heading_array['sub_heading_1']);
            // Logo
            $pdf->AddPage();
            $fpath = FCPATH . "assets/img/logo.png";
            // print_r($fname); die();
            $pdf->Image($fpath, 20);
            $pdf->Ln(5);
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell('189', '5', company_data()[0]->name, 0, 1, 'C');
            $pdf->SetFont('helvetica', 'B', 8);
            $pdf->Cell('189', '3', 'Bungoma Water', 0, 1, 'C');
            $pdf->Cell('189', '3', 'P.O Box 0011', 0, 1, 'C');
            $pdf->Cell('189', '3', 'Bungoma', 0, 1, 'C');
            $pdf->Cell('189', '3', 'Phone:+254729320785', 0, 1, 'C');
            $pdf->Cell('189', '3', 'Email:jmosesk@gmail.com', 0, 1, 'C');
            $pdf->SetFont('helvetica', 'B', 7);
            $pdf->Ln(2);
            $set_html = <<<EOD
        <h4>{$heading_array['sub_heading_1']}</h4>
        <h4>{$heading_array['sub_heading_2']}</h4>
        {$table_values}
        <br>
        {$footer}       
        EOD;
            $pdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', true);
            $pdf->Ln(2);
            $pdf->Cell(20, 1, '____________________', 0, 0);
            $pdf->Cell(118, 1, '', 0, 0);
            $pdf->Cell(51, 1, '____________________', 0, 1);
            $pdf->Cell(20, 5, 'Authorised Signature', 0, 0);
            $pdf->Cell(118, 5, '', 0, 0);
            $pdf->Cell(51, 5, 'Customer/POA Signature(s)', 0, 1);
            $pdf->Ln(2);
            $pdf->SetFont('helvetica', 'I', 8);
            date_default_timezone_set('Africa/Nairobi');
            $today = date("F j, Y/ g:i A", time());
            $pdf->Cell(25, 5, 'Generated Date/Time: ' . $today, 0, 0, 'L');
            $pdf->Cell(164, 5, 'Page' . $pdf->getAliasNumPage() . ' of ' . $pdf->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
            $file_name = "PetraNova";
            if (@$post['filename'])
                $file_name = $post['filename'];
            $pdf->Output($file_name . '.pdf', $export_type);
        }
    }

    function CreatePdf() {
        
    }

    function saleItem($sale_id = null) {
        $this->load->model('Product_model', '', TRUE);
        $pdf = new TCPDF("POTRAIT", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $sale_item = $this->Product_model->print_sale_items($sale_id);
        $data = '<table cellspacing="0" cellpadding="1" border="0" style="width: 100%">
                <tr>
                    <td width="20" align="left">#</td>
                    <td width="250"><b>Item Description</b></td>
                    <td width="50" align="right"><b>Price</b></td>
                    <td width="50" align="center"><b>Qty</b></td>
                    <td align="right" width="80"><b>Total</b></td>
                </tr>';
        $i = 0;
        foreach ($sale_item['items'] as $value) {
            $i++;
            $data .= '<tr><td>' . $i . '</td><td>' . $value['item_name'] . '</td><td align="right">' . number_format($value['unit_price']) . '</td><td align="center">' . $value['quantity_sold'] . '</td><td align="right">' . number_format($value['total'], 2) . '</td></tr>';
        }
        $sales_type = $sale_item['sales'][0];

        $data .= '<hr><br>';
        $data .= '<br><table cellspacing="0" cellpadding="1" style="width: 100%"><tr>
                        <td style="width:300">Served By: <b>' . $sales_type['user'] . '</b></td>
                        <td>Date: <b>' . $sales_type['datetime'] . '</b></td>
                    </tr>';
        $data .= '<tr style="width:60%" class="col-md-6">';
        if ($sales_type['customer'] != null)
            $data .= '<td>Customer: <b>' . $sales_type['customer'] . '</b></td>';
        $data .= '<td>Payment: <b>' . $sales_type['payment_type'] . '</b></td>
                    </tr></table>';

        $this->load->library('Pdf');

        $pdf->setCreator(PDF_CREATOR);
        $pdf->setTitle(company_data()[0]->name);
        $pdf->setHeaderData('', PDF_HEADER_LOGO_WIDTH, company_data()[0]->name, "Tel : " . company_data()[0]->phone_number, array(0, 65, 0), array(0, 65, 0));
        $font_size = $pdf->pixelsToUnits('20');
        $pdf->SetFont('helvetica', '', $font_size, '', 'default', true);
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
        $pdf->setFooterData(array(0, 65, 0), array(0, 65, 127));
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->setMargins(5, PDF_MARGIN_TOP, 5);
        $pdf->setHeaderMargin(10);
        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->AddPage();
        $tbl = <<<EOD
                    {$data}
                    EOD;
        $pdf->writeHTML($tbl, true, false, false, false, '');
        $pdf->Output('Sale Registry.pdf', 'I');
    }

    function testPDF() {
        $this->load->library('Pdf');
        $post = $this->input->post();
        $theader = "";
        $title = "FMS Report";
        $subtitle = "";
        $body = "";
        $footer_sum = "";
        $footer = "";
        if (isset($post['headers'])) {
            $header_array = json_decode($post['headers']);
            $theader .= '<tr style="border-color:gray;color:white; background-color:#36304a; padding:1px">';
            foreach ($header_array as $header) {
                $theader .= '<th>' . $header . '</th>';
            }
            $theader .= '</tr>';
        }
        if (isset($post['subtitle'])) {
            $subtitle = json_decode($post['subtitle']);
        }
        if (isset($post['footer'])) {
            $footer = json_decode($post['footer']);
        }
        if (isset($post['title'])) {
            $title = json_decode($post['title']);
        }
        if (isset($post['body'])) {
            $body_data = json_decode($post['body']);
            foreach ($body_data as $value) {
                $body .= "<tr>";
                for ($i = 0; $i < count($value); $i++) {
                    $body .= "<td>" . $value[$i] . "</td>";
                }
                $body .= "</tr>";
            }
        }
        if (isset($post['footer_sum'])) {
            $footer_array = json_decode($post['footer_sum']);
            foreach ($footer_array as $value) {
                $footer_sum .= "<tr>";
                for ($i = 0; $i < count($value); $i++) {
                    $footer_sum .= "<td><b>" . $value[$i] . "</b></td>";
                }
                $footer_sum .= "</tr>";
            }
        }
        $pdf = new TCPDF("LANDSCAPE", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setCreator(PDF_CREATOR);
        $pdf->setAuthor('FMS');
        $pdf->setTitle($title);
        $pdf->setHeaderData('', PDF_HEADER_LOGO_WIDTH, company_data()[0]->name, "Tel : " . company_data()[0]->phone_number, array(0, 65, 0), array(0, 65, 0));
        $font_size = $pdf->pixelsToUnits('20');
        $pdf->SetFont('helvetica', '', $font_size, '', 'default', true);
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
        $pdf->setFooterData(array(0, 65, 0), array(0, 65, 127));
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->setHeaderMargin(10);
        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->AddPage();
        $tbl = <<<EOD
                        <h1>{$title}</h1>
                        <h3>{$subtitle}</h3>
                        <table cellspacing="0" cellpadding="3" border="1" style="border-color:gray;">
                            {$theader}
                            {$body}
                            {$footer_sum}
                        </table>
                        {$footer}
                        EOD;
        $pdf->writeHTML($tbl, true, false, false, false, '');
        $pdf->Output($title . 'pdf', 'I');
    }

}
