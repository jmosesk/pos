    <div class="pageheader">
      <h2><i class="fa fa-calculator"></i> Meter Movement Report</h2>
    </div>
    <div class="contentpanel">
          <div class="panel panel-default">
            <?php if ($shifts != null) { ?>
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-3">
                  <h4 class="panel-title"><b>Meter Movement Report</b></h4>
                  <p>View, Search and Filter Meter Movement</p>
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
              	<table class="table table-invoice borderless">
              		<?php foreach ($shifts->result() as $shift) { ?>
              		<!-- Get Center and Shift-->
					<thead>
						<tr>
				        	<td class="col-md-3">
								<div class="text-primary text-small"><strong><?php echo $shift->shift_name.' of '. format_date($shift->shift_date); ?></strong></div>
							</td>
				        </tr>
						<tr>
				        	<th class="col-md-2">Pump</th>
				            <th class="col-md-3 left">Electronic Ltrs</th>
				            <th class="col-md-3 left">Electronic Cash</th>
				            <th class="col-md-3 left">Manual Ltrs</th>
				        </tr>
				    </thead>
              		<tbody>
		            	<?php foreach (meterMovementReport($shift->shift_id)->result() as $movement){ ?>
		            		<tr>
		            			<td>
		            				<?php echo $movement->pump_name; ?>
		            			</td>
		            			<td>
		            				Opening
					                	<span class="mlr-5 gray"><sub><?php echo $movement->opening_electronic; ?></sub></span>
					                	Closing
					                	<span class="mlr-5 gray"><sub><?php echo $movement->closing_electronic; ?></sub></span>
					                	Variance
					                	<span class="mlr-5 gray"><sub><?php echo $movement->variance_ltrs; ?></sub></span>
		            			</td>
		            			<td>
		            				Opening
					                	<span class="mlr-5 gray"><sub><?php echo $movement->opening_cash; ?></sub></span>
					                	Closing
					                	<span class="mlr-5 gray"><sub><?php echo $movement->closing_cash; ?></sub></span>
					                	Variance
					                	<span class="mlr-5 gray"><sub><?php echo $movement->variance_electronic_reading; ?></sub></span>
		            			</td>
		            			<td>
		            				Opening
					                	<span class="mlr-5 gray"><sub><?php echo $movement->opening_manual; ?></sub></span>
					                	Closing
					                	<span class="mlr-5 gray"><sub><?php echo $movement->closing_manual; ?></sub></span>
					                	Variance
					                	<span class="mlr-5 gray"><sub><?php echo $movement->variance_manual_reading; ?></sub></span>
		            			</td>
		            		</tr>
		                <?php } ?>
		            </tbody>
					<?php }?>
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