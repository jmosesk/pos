		<div class="pageheader">
	   	<div class="col-md-6">
	      <h2><i class="fa fa-edit"></i> Employee Report</h2>
	   	</div> 
	   	<div class="clearfix"></div>
    </div>
    <div class="contentpanel">
    	<?php if(count($users) > 0) { ?>
            <div class="panel-heading">
              <div class="row"> 
                <div class="col-md-4">
                  <h4 class="panel-title"><strong>Report for : </strong> <?php echo $users[0]['user']; ?></b></h4>
                  <p>View and Filter <?php echo $users[0]['user']; ?>'s Shortage Report</p>
                </div>
		          <div class="col-md-8">
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
                        <th style="background-color:#fcfcfc">#</th>
                        <th style="background-color:#fcfcfc">Employee</th>
                        <th style="background-color:#fcfcfc">Shift</th>
                        <th style="background-color:#fcfcfc">Amount</th>
                        <th class="text-center">Reverse/Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $row_count = 0; foreach ($users as $user) { $row_count ++;?>
                      <tr>
                      	<td><?php echo $row_count; ?></td>
                      	<td><?php echo $user['user']; ?></td>
                      	<td><?php echo $user['shift_name'].' - '.format_date($user['shift_date']); ?></td>
                      	<td><?php echo number_format($user['amount']); ?></td>
                      	<td class="text-center">
                      		<?php $type = "Excess";
                      			if($user['amount'] < 0)
                      				$type = "Shortage"; 
                      			if($user['status'] == 0 && current_shift_data()->shift_id == $user['shift_id']) { ?>
                      			<a href="#" onclick="confirm_rollback(<?php echo $user['adjust_amt_id'].", 'Reverse ".$type." of Ksh. ".number_format($user['amount'])." for ".$user['user']."', 'Shift Reversal'"?>)" class="btn btn-danger btn-sm"><span class="fa fa-undo"></span></a>
                      		<?php } else if($user['status'] == 0 && $user['amount'] < 0) { ?>
                      			<a href="#" onclick="confirm_rollback(<?php echo $user['adjust_amt_id'].", 'Reverse ".$type." of Ksh. ".number_format($user['amount'])." for ".$user['user']."', '".$type."'"?>)" class="btn btn-danger btn-sm"><span class="fa fa-undo"></span></a>
                      		<?php } elseif ($user['status'] == 1) {
                      			echo "<b>Reversed</b>";
                      		} else 
                      			echo "<b> ----- </b>"; ?>
                      		</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
              </div><!-- table-responsive -->
            </div>
          <?php } else { ?>
						<div class="row">
							<div class="col-md-12">
								<div class="alert alert-warning">
									<p class="lead">Sorry, No Report found for this Employee. You can go to <a href="<?php echo base_url(); ?>user">list of Users</a> and select another employee</p>
								</div>
							</div>
						</div>	  
		  		<?php } ?>
    		</div><!-- contentpanel -->

		    <!-- Modal to add Company -->
		    <div id="addUser" class="modal fade">
		      <div class="modal-dialog">
		        <div class="modal-content">
		          <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		            <h4 class="text-center">Reversal Recipient Cashier</h4>
		          </div>
		          <div class="modal-body">
		          <form id="addForm" method="post" class="form-horizontal" enctype="multipart/form-data">
		            <div class="form-group">
              		<label class="col-sm-3 control-label">Recipient Cashier</label>
		              <div class="col-lg-9">
		                <select class="form-control" name="cashier">
		                  <?php foreach ($cashiers->result() as $user): ?>
		                    <option value="<?php echo $user->user_id ?>"><?php echo $user->username ?></option>
		                  <?php endforeach ?>
		                </select>
		                <input type="hidden" id="item_id" name="id"/>
		                <input type="hidden"  id="type" name="type"/>
		              </div>
		            </div>
		            <div class="modal-footer">
		              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		              <button type="submit" class="btn btn-primary">Confirm Reversal</button>
		            </div>
		          </form>
		          </div>
		        </div>
		      </div>
		    </div>
		  <!-- End of Modal-->

    <script type="text/javascript">
      function confirm_rollback(id, nm, type) {
        swal_confirm(nm, 'Please note you will not be able to revert this!', 'Confirm Reversal', function (confirmed) {
              if (confirmed) {
              	if(type == "Shift Reversal") {
              		reverse_short(id, type);
              	} else {
	              	$('#item_id').val(id);
	              	$('#type').val(type);
	              	$("#addUser").modal();
              	}
              }
          });
      }

      $(document).ready(function() {
        $('#addForm').bootstrapValidator({
          message: 'This value is not valid',
          feedbackIcons: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },
          fields: {
	          cashier: {
	            validators: {
	              notEmpty: {
	              message: "You're required to select Cashier!"
	              }
	            } 
	          }
          }
        }).on('success.form.bv', function(e) {
          // Prevent form submission
          e.preventDefault();
          // Get the form instance
          var $form = $(e.target);
          // Get the BootstrapValidator instance
          var bv = $form.data('bootstrapValidator');
          // Use Ajax to submit form data
          $.ajax({
          url: '<?php echo base_url(); ?>Reversal/shortage_reversal/',
          type: 'post',
          data: $('#addForm :input'),
          dataType: 'html',   
          success: function(html) {
            $('#addForm')[0].reset();
            $('#addUser').modal('hide');
          	const result = JSON.parse(html);
          	swal_success_reload("Request Successful", result.message);
          }
        });
      });
    });

    function reverse_short(id, type) {
			$.ajax({
        url: '<?php echo base_url(); ?>Reversal/shortage_reversal/',
        type: 'post',
        data: {id: id, type: type},
        dataType: 'html',   
        success: function(html) {
          $('#addForm')[0].reset();
          $('#addUser').modal('hide');
        	const result = JSON.parse(html);
        	swal_success_reload("Request Successful", result.message);
        }
      });
    }
   </script>