  <link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/custom/js/jquery.timepicker.js"></script>
	<div class="pageheader">
      <h2><i class="fa fa-id-card"></i> Vendor Statement Report</h2>
    </div>
	<div class="contentpanel">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-12">
						<h4 class="panel-title"><b>Vendor Statement Report</b></h4>
						<p>View and Filter Vendor Statement Report</p>
					</div>
					<div class="col-md-12 text-right mt10">
						<form class="form-inline" id="seadrchForm" method="post" action="<?php echo base_url(); ?>Reports/VendorReport">
						  <div class="form-group col-md-3">
							<label class="control-label col-md-3">Vendor&nbsp;: </label>
							<div class="col-sm-9">
							  <select class="form-control mb15 selectpicker" name="vendor" data-live-search="true" data-style="btn-white" style="margin-top: 15px; padding: 10px 30px;">
								<option>Select Supplier</option>
								<?php foreach ($suppliers->result() as $supplier){?>
									<option value="<?php echo $supplier->supplier_id; ?>"><?php echo $supplier->company_name; ?></option>
								<?php } ?>
							  </select>
							</div>
						  </div>
						  <div class="form-group col-md-3">
							<div class="col-sm-12">
							  <div class="input-group">
								  <input type="text" class="form-control" id="from" name="date_from" placeholder="From Date">
								  <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
							  </div>
							</div>
						  </div>
						  <div class="form-group col-md-3">
							<div class="col-sm-12">
							  <div class="input-group">
								  <input type="text" class="form-control" id="to" name="date_to" placeholder="To Date">
								  <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
							  </div>
							</div>
						  </div>
						  <div class="form-group col-md-1">
						  <button type="submit" class="btn btn-success"><span class="fa fa-filter"></span> View Report</button>
						  </div>
						  
						</form>
					</div>
				</div>
			</div>
			<?php if($statements != null){ ?>
			<div class="panel-body">
			  <div class="row">
				<div class="col-md-12">
					<?php  $opening_balance = 0; if($opening_debit !=null){ $open_debit_amount = $opening_debit[0]->sum_debit; } else { $open_debit_amount = 0; }
						if($opening_credit !=null){ $open_credit_amount = $opening_credit[0]->sum_credit; } else { $open_credit_amount = 0; }?>
					<label>Opening Balance : <?php $opening_balance = $open_debit_amount - $open_credit_amount; echo format_cash($opening_balance); ?></label>
					
				</div>
			  </div>
              <div class="table-responsive">
                <table class="table mb30">
                  <thead>
                    <tr>
                      <th>Datetime</th>
                      <th>Details</th>
                      <th>Debit</th>
                      <th>Credit</th>
                      <th>Book Balance</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $bal = 0; $sum_debit = 0; $sum_credit = 0; foreach ($statements->result() as $statement) { ?>
                    <tr>
                      <td><?php echo format_datetime($statement->datetime); ?></td>
                      <td><?php echo $statement->details; ?></td>
                      <td><?php if(($statement->debit) == 1){ $debit_amount = $statement->amount; $sum_debit += ($statement->amount); echo format_cash($debit_amount); } ?></td>
                      <td><?php if(($statement->debit) == 2){ $credit_amount = -($statement->amount); $sum_credit += ($statement->amount); echo format_cash($credit_amount); } ?></td>
					  <td><?php $bal = $sum_debit - $sum_credit; echo format_cash($bal); ?> </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div><!-- table-responsive -->
			  <div class="row">
				<div class="col-md-12 text-right">
					<label>Closing Balance : <?php echo format_cash($bal + $opening_balance); ?></label> 
				</div>
			  </div>
            </div>
			<?php } ?>
        </div><!-- panel -->
    </div><!-- contentpanel -->
	<script type="text/javascript">
    $(document).ready(function() {
        $('#searchForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                vendor: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in a full name!"
                        }
                    }
                },
          date_from: {
            validators: {
              notEmpty: {
              message: "You're required to fill in phone number!"
              }
            } 
          }, 
          date_to: {
            validators: {
              notEmpty: {
              message: "You're required to fill in a Employment Date!"
              }
            } 
          }
         }
        })
      .on('success.form.bv', function(e) {
          // Prevent form submission
          e.preventDefault();
          // Get the form instance
          var $form = $(e.target);

          // Get the BootstrapValidator instance
          var bv = $form.data('bootstrapValidator');

          // Use Ajax to submit form data
          $.ajax({
          url: '<?php echo base_url(); ?>Reports/VendorReport',
          type: 'post',
          data: $('#searchForm :input'),
          dataType: 'html',   
          success: function(html) {
            
            }
        });
      });
    });
	$(function() {
        $( "#from" ).datepicker();
        $( "#to" ).datepicker();
      });
 </script>