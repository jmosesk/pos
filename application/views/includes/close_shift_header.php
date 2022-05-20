<?php
	$meter_reading_class = "btn-success";
	$dipping_reading_class = "btn-success";
	$lube_reading_class = "btn-success";
	$product_reading_class = "btn-success";
	$drop_reading_class = "btn-success";

	if($header_values['meter'] != null)
	 	$meter_reading_class = "btn-outline-warning";
	if($header_values['dippings'] != null)
	 	$dipping_reading_class = "btn-outline-warning";
	if($header_values['lubes'] != null)
	 	$lube_reading_class = "btn-outline-warning";
	if($header_values['products'] != null)
	 	$product_reading_class = "btn-outline-warning";
	if($header_values['drops'] != null)
	 	$drop_reading_class = "btn-outline-warning";
?>
			<div class="pageheader">
		    	<div class="col-md-3">
					<h2><i class="fa fa-edit"></i> Close Shift</h2>
				</div>
		      	<div class="col-md-9 text-right">
			      <a href="<?php echo base_url() ?>shift/close_shift" class="btn <?php echo $meter_reading_class ?>"> Meter Readings</a>
			      <a href="<?php echo base_url() ?>shift/dippings" class="btn <?php echo $dipping_reading_class ?>"> Dippings</a>
			      <a href="<?php echo base_url() ?>shift/lube_products" class="btn <?php echo $lube_reading_class ?>"> Lube Products</a>
			      <a href="<?php echo base_url() ?>shift/products" class="btn <?php echo $product_reading_class ?>"> Other Products</a>
			      <a href="<?php echo base_url() ?>shift/drops" class="btn <?php echo $drop_reading_class ?>"> Cash Drops</a>
		      	</div>
		      	<div class="clearfix"></div>
		    </div>