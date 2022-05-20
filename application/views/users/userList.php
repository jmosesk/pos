  <script type="text/javascript">
    $(document).ready(function() {
        $('#addForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in a full name!"
                        }
                    }
                },
          phone_number: {
            validators: {
              notEmpty: {
              message: "You're required to fill in phone number!"
              }
            } 
          }, 
          employment: {
            validators: {
              notEmpty: {
              message: "You're required to fill in a Employment Date!"
              }
            } 
          }, 
          username: {
            validators: {
              notEmpty: {
              message: "You're required to fill in a Username!"
              }
            } 
          },
          password: {
            validators: {
              notEmpty: {
              message: "You're required to fill in a password"
              }
              }
            },
          cpassword: {
            validators: {
              notEmpty: {
              message: "You're required to confirm password!"
              },
              identical: {
              field: 'password',
                message: 'The confirm password must match password'
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
          url: '<?php echo base_url(); ?>user/addUser',
          type: 'post',
          data: $('#addForm :input'),
          dataType: 'html',   
          success: function(html) {
            $('#addForm')[0].reset();
            $('#addUser').modal('hide');
            bootbox.alert(html, function()
              {
              window.location.reload();
              });
            }
        });
      });
    });

    function edit(id)
    {
    $.ajax({
          url: '<?php echo base_url(); ?>user/editUser/' + id,
          type: 'post',
          dataType: 'html',   
          success: function(html) {
           $('#edit-admin-content').html(html);
             
          }
        });
    }

    function rm(nm,id){
      bootbox.confirm("Are you sure you want to delete " + nm + "?", function(result) {
        if(result) {
          $.ajax({
          url: '<?php echo base_url(); ?>user/deleteUser/' + id,
          type: 'post',
          data: {id: id},
          dataType: 'html',  
          success: function(html) {
              bootbox.alert(html, function()
              {
              window.location.reload();
              });
          }
        });  
      }
      }); 
    }

    </script>
    <script>
	$(function() {
        $( "#from" ).datepicker();
        $( "#to" ).datepicker();
      });
    </script>
    <script type="text/javascript">
				$(document).ready(function(){
				    $('input[type="checkbox"]').click(function(){
				        if($(this).attr("value")=="red"){
				            $(".login_enabled_add_user").toggle();
				        }
				    });
				});
	</script>
  	<link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
  	<script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/custom/js/jquery.timepicker.js"></script>
  <!-- Modal to Edit User -->
  <style>
    .date {
      z-index:1151 !important; 
    }
</style>
  <div id="editUser" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Edit Employee Details</h4>
          </div>
          <div class="modal-body" id="edit-admin-content">
            
          </div>
        </div>
      </div>
    </div>
  <!-- Modal to add User -->
    <div id="addUser" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Add Employee</h4>
          </div>
          <div class="modal-body">
          <form id="addForm" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-lg-3 control-label">Name : </label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Employment Date : </label>
              <div class="col-lg-8">
              	<div class="input-group">
			      <input type="text" class="form-control date" id="to" name="employment" placeholder="Enter Employment Date">
			      <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
			    </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Phone Number : </label>
              <div class="col-lg-8">
                <input type="text" class="form-control" name="phone_number" placeholder="Enter Phone Number" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Select Title : </label>
              <div class="col-lg-8">
                <select class="form-control mb15 selectpicker" name="title_id" data-live-search="true" data-style="btn-white">
                  <?php foreach ($titles->result() as $title){?>
                    <option value="<?php echo $title->user_title_id; ?>"><?php echo $title->name; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Select Role : </label>
              <div class="col-lg-8">
                <select class="form-control mb15 selectpicker" name="role_id" data-live-search="true" data-style="btn-white">
                  <?php foreach ($roles->result() as $role){?>
                    <option value="<?php echo $role->role_id; ?>"><?php echo $role->name; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
				<div class="col-lg-8 col-md-offset-3">
		            <div class="ckbox ckbox-primary">
						<input id="checkboxPrimary" type="checkbox" value="red">
						<label for="checkboxPrimary"> <strong>Enable Login</strong> </label>
					</div>
				</div>
			</div>
			<div class="login_enabled_add_user" id="login_enabled_add_user" style="display: none">
	            <div class="form-group">
	              <label class="col-lg-3 control-label">Username : </label>
	              <div class="col-lg-8">
	                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" />
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="col-lg-3 control-label">Password : </label>
	              <div class="col-lg-8">
	                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" />
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="col-lg-3 control-label">Confirm Password : </label>
	              <div class="col-lg-8">
	                <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" />
	              </div>
	            </div>
	        </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Add Employee</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End add User -->
   <div class="pageheader">
   	<div class="col-md-6">
      <h2><i class="fa fa-user"></i> Staff</h2>
   	</div> 
   	<div class="clearfix"></div>
      
    </div>
    <div class="contentpanel">
          <div class="panel panel-default">                
            <div class="panel-heading">
              <div class="row"> 
                <div class="col-md-4">
                  <h4 class="panel-title"><b>Staff List</b></h4>
                  <p>This is a list of all staff. You can view, search and manage employee details</p>
                </div>
                <div class="col-md-8 text-right">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser"><span class="fa fa-plus"></span> Add Employee</button>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                  <table class="table mb30">
                    <thead>
                      <tr>
                        <th style="background-color:#fcfcfc">#</th>
                        <th style="background-color:#fcfcfc">Name</th>
                        <th style="background-color:#fcfcfc">Username</th>
                        <th style="background-color:#fcfcfc">Speciality</th>
                        <th style="background-color:#fcfcfc">Role</th>
                        <th style="background-color:#fcfcfc">Employment Date</th>
                        <th style="background-color:#fcfcfc">Status</th>
                        <th style="background-color:#fcfcfc">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $row_count = 0; if($users != null){ $row_count = 0; foreach ($users->result() as $user){ $row_count ++;?>
                      <tr>
                      	<td><?php echo $row_count; ?></td>
                      	<td><?php echo $user->name; ?></td>
                      	<td><?php if ($user->username == null) {
							  echo " -- -- -- -- -- -- ";
						  } else {
							  echo $user->username;
						  } ?>
						</td>
                      	<td><?php echo $user->title; ?></td>
						<td><?php if ($user->role_name == null) {
							  		echo " -- -- -- -- -- -- ";
							  } else {
									echo $user->role_name;
							  } ?>
						</td>
                      	<td><?php echo format_date($user->employment_date); ?></td>
                      	<td><?php if($user->status == 1) {
							  echo "Active";
						  } else {
							  echo "Active";
						  } ?>
						  </td>
						<td>
							<a href="<?php echo base_url();?>User/employeeReport/<?php echo $user->user_id; ?>" class="btn btn-success btn-xs"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;Shortages</a>
							<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editUser" onclick="edit('<?php echo $user->user_id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
							<a href="javascript:void(0);" onclick="rm('<?php echo $user->name; ?>','<?php echo $user->user_id; ?>');" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
                    	</td>
                      </tr>
                      <?php } }?>
                    </tbody>
                  </table>
                </form>
              </div><!-- table-responsive -->
            </div>
          </div><!-- panel -->
    </div><!-- contentpanel -->