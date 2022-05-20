    <div class="pageheader">
      <h2><i class="fa fa-sliders"></i> Stock Variation Report</h2>
    </div>
	<div class="contentpanel">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-3">
						<h4 class="panel-title"><b>Stock Variation Report</b></h4>
						<p>View and Search Stock Variations</p>
					</div>
					<div class="col-md-9 pull-right">
                	<form class="form-inline" role="search" method="POST" action="">
					  <div class="form-group">
					    <label>From Date : </label>
					    <div class="input-group">
					      <input type="text" class="form-control" id="from" name="from" placeholder="From Date">
					      <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
					    </div>
					  </div>
					  <div class="form-group">
					    <label>To Date : </label>
					    <div class="input-group">
					      <input type="text" class="form-control" id="to" name="to" placeholder="To Date">
					      <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
					    </div>
					  </div>
					  <button type="submit" class="btn btn-success"><span class="fa fa-filter"></span> Filter</button>
					</form>
					</div>
				  <div class="row">
					<div class="col-md-12 text-right">
						<a href="<?php echo base_url(); ?>product/stockList" class="btn btn-success"><span class="fa fa-plus"></span> Create a Report</a>
					</div>
				  </div>
				</div>
			</div>
			<div class="panel-body">
            <?php if ($variations != null) { ?>
              <div class="table-responsive">
                <table class="table mb30">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Datetime</th>
                      <th>Shift</th>
                      <th>Employee</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $row_count = 0; foreach ($variations->result() as $variation){ $row_count ++;?>
                    <tr>
                      <td><?php echo $row_count; ?></td>
                      <td><?php echo format_datetime($variation->datetime); ?></td>
                      <td><?php echo $variation->shift_name.'-'.format_date($variation->shift_date); ?></td>
                      <td><?php echo $variation->employee; ?></td>
                      <td><a href="<?php echo base_url(); ?>product/stockList/<?php echo MD5($variation->variation_id); ?>" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp; View</a>
                    </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div><!-- table-responsive -->
            <?php } ?>
            </div>
        </div><!-- panel -->
    </div><!-- contentpanel -->