	<div class="pageheader">
      <h2><i class="fa fa-money" aria-hidden="true"></i> Stock Valuation Report</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>">Fms</a></li>
          <li class="active">Stock Valuation Report</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-12">
			      <?php $total = 0; ?>
          	<div class="panel panel-default" style="padding: 15px; 5px">
              <form action="<?php echo base_url('Export') ?>" method="POST" target="_blank">
              <?php
              $sub_heading_array = array('sub_heading_1' => 'Stock Valuation Report as at '.date("D, d-m-Y"), 'sub_heading_2' => 'Shift Date : '.current_shift_data()->shift_name.' of '.format_date(current_shift_data()->shift_date).'');
                  $data_footer = '<div class="">
                  <table style="width: 100%">
                    <tr>
                      <th><b>Prepared By : _________________________________</b></th>
                      <th><b>Checked By:  __________________________________</b></th>
                    </tr>
                    <tr>
                      <th style="padding-top:10px; font-size:10px">Remarks : </th>
                      <th style="margin-top:10px; font-size:10px">Remarks : </th>
                    </tr>
                  </table>
                </div>';
              $export = '<table cellspacing="0" cellpadding="3" border="1" style="border-color:white;">';
              $real = '<div class="panel-heading">
							      		<div class="row">
							        		<div class="col-md-12"><div class="text-primary text-small"><strong>White Products</strong></div></div>
							      		</div>
							      	</div>';
              $real .= '<table class="table table-responsive table-striped table-hover">';
              $tbl_header = '<thead>
		                  <tr style="color:white; background-color:#36304a; font-size:9px">
		                    <td class="col-md-6">Item Name</td>
						      			<td>Quantity</td>
						      			<td>Unit Price</td>
						      			<td>Gross Price</td>
						      			<td>Net Price</td>
		                </tr>
		              </thead>
                <tbody>';
                $sub_total = 0; $gross_total = 0; 
									foreach ($valuations['white_products'] as $white) {
										$gross =  $white['quantity'] * $white['unit_price'];
										$net = $gross - ($white['tax'] * $gross);
										$gross_total += $gross;
										$sub_total += $net;
										$total += $net;
								$tbl_header .= '<tr>
										<td>'.$white['item_name'].'</td>
										<td>'.number_format($white['quantity'], 2).'</td>
										<td>'.number_format($white['unit_price'], 2).'</td>
										<td>'.number_format($gross, 2).'</td>
										<td>'.number_format($net, 2).'</td>
									</tr>';
								}
								$tbl_header .= '<tr>
				      		<td class="col-md-6"><b>Sub Total</b></td>
				      		<td class="col-md-1"></td>
				      		<td class="col-md-1"></td>
				      		<td class="col-md-2"><b>'.number_format($gross_total, 2).'</b></td>
				      		<td class="col-md-2"><b>'.number_format($sub_total, 2).'</b></td>
				      	</tr>
			      		</tbody>
			      	</table>';
							foreach ($valuations['stores'] as $store) {
								$tbl_header .= '<div class="panel-heading">
				      		<div class="row">
				        		<div class="col-md-12"><div class="text-primary text-small"><strong>'.$store['product_type'].'</strong></div></div>
				      		</div>
				      	</div>
				      	<table class="table table-responsive table-striped table-hover">
				      		<thead>
		                  <tr style="color:white; background-color:#36304a; font-size:9px">
					      			<td class="col-md-6">Item Name</td>
					      			<td>Quantity</td>
					      			<td>Unit Price</td>
					      			<td>Gross Price</td>
					      			<td>Net Price</td>
					      		</tr>
				      		</thead>
				      		<tbody>';$sub_total = 0; $gross_total = 0; 
				      				foreach($valuations['data'][$store['category_id']] as $category) {
													$gross =  $category['quantity'] * $category['unit_price'];
													$net = $gross - ($category['tax'] * $gross);
													$gross_total += $gross;
													$sub_total += $net;
													$total += $net;
						      $tbl_header .= '<tr>
						      				<td>'.$category['item_name'] .'</td>
													<td>'.number_format($category['quantity'], 2) .'</td>
													<td>'.number_format($category['unit_price'], 2) .'</td>
													<td>'.number_format($gross, 2) .'</td>
													<td>'.number_format($net, 2).'</td>
						      			</tr> ';
					      			}
							   $tbl_header .= '<tr>
							      		<td class="col-md-6"><b>Sub Total</b></td>
							      		<td class="col-md-1"></td>
							      		<td class="col-md-1"></td>
							      		<td class="col-md-2"><b>'.number_format($gross_total, 2).'</b></td>
							      		<td class="col-md-2"><b>'.number_format($sub_total, 2).'</b></td>
							      	</tr>
				      		</tbody>
				      	</table>';
				      	}
				      	/*$tbl_header .='<table class="table table-striped table-condensed table-hover">
				      	<thead>
				      	<tr>
				      		<th class="col-md-6"><b>Grand Total</b></th>
				      		<th class="col-md-1"></th>
				      		<th class="col-md-1"></th>
				      		<th class="col-md-2"><b></th>
				      		<th class="col-md-2"><b><?php echo number_format($total, 2) ?></b></th>
				      	</tr>
				      	</thead>
				      </table>';*/ ?>
	              <input type="hidden" name="sub_heading" value='<?php echo json_encode($sub_heading_array) ?>'>
	              <input type="hidden" name="data_footer" value='<?php echo json_encode($data_footer) ?>'>
	              <input type="hidden" name="data_val" value='<?php echo json_encode($export.$tbl_header) ?>'>
	              <input type="hidden" name="export_type" value='<?php echo json_encode($export.$tbl_header) ?>'>
	              <div class="text-right">
		              <button class="btn btn-default" type="submit" name="export_type" value="I"><span>Print Report</span></button>
		              <button class="btn btn-default" type="submit" name="export_type" value="D"><span>Export to PDF</span></button>
		            </div>
              </form>
			        <?php echo $real.$tbl_header ?>
				      <table class="table table-striped table-condensed table-hover">
				      	<tbody>
				      	<tr>
				      		<td class="col-md-6"><b>Grand Total</b></td>
				      		<td class="col-md-1"></td>
				      		<td class="col-md-1"></td>
				      		<td class="col-md-2"><b></td>
				      		<td class="col-md-2"><b><?php echo number_format($total, 2) ?></b></td>
				      	</tr>
				      	</tbody>
				      </table>
      			</div>
					</div><!-- col-md-12 -->
        </div><!-- col-md-12 -->
      </div><!-- row -->
    </div><!-- contentpanel -->