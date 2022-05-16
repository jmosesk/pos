    <div class="pageheader">
      <h2><i class="fa fa-shopping-cart"></i> Sales Report</h2>
    </div>
    <div class="contentpanel">
          <div class="panel panel-default">
            <?php if ($transfers != null) { ?>
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-3">
                  <h4 class="panel-title"><b>Sales Report</b></h4>
                  <p>View and Search Sales</p>
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
              </div>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table mb30">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Datetime</th>
                      <th>Item</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Total Amount</th>
                      <th>Employee</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $row_count = 0; foreach ($transfers->result() as $transfer){ $row_count ++;?>
                    <tr>
                      <td><?php echo $row_count; ?></td>
                      <td><?php echo format_datetime($transfer->datetime); ?></td>
                      <td><?php echo $transfer->item_name; ?></td>
                      <td><?php echo $transfer->quantity_sold; ?></td>
                      <td><?php echo $transfer->unit_price; ?></td>
                      <td><?php echo $transfer->quantity_sold * $transfer->unit_price; ?></td>
                      <td><?php echo $transfer->employee; ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div><!-- table-responsive -->
            <?php } else { ?>
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-9">
                  <h4 class="panel-title"><b>No Results Found</b></h4>
                </div>
              </div>
            </div>
            <?php } ?>
            </div>
          </div><!-- panel -->
    </div><!-- contentpanel -->