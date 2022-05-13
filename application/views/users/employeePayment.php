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
              <label class="col-lg-3 control-label">Select Employee : </label>
              <div class="col-lg-8">
                <select class="form-control mb15 selectpicker" name="employee" data-live-search="true" data-style="btn-white">
                  <?php foreach ($users->result() as $user){?>
                    <option value="<?php echo $user->user_id; ?>"><?php echo $user->name; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Enter Amount : </label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Payment Amount" />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Add Payment</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End add User -->
   <div class="pageheader">
   	<div class="col-md-6">
      <h2><i class="fa fa-user"></i> Employee Payments</h2>
   	</div> 
   	<div class="clearfix"></div>
      
    </div>
    <div class="contentpanel">
          <div class="panel panel-default">                
            <div class="panel-heading">
              <div class="row"> 
                <div class="col-md-8">
                  <h4 class="panel-title"><b>Employee List</b></h4>
                  <p>This is a list of all employee payments. You can view, search and manage employee payments</p>
                </div>
                <div class="col-md-4 text-right">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser"><span class="fa fa-plus"></span> Add Payment</button>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                  <table class="table mb30">
                    <thead>
                      <tr>
                        <th style="background-color:#fcfcfc">Datetime</th>
                        <th style="background-color:#fcfcfc">Employee</th>
                        <th style="background-color:#fcfcfc">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if($users != null) { foreach ($users->result() as $user) { ?>
                      <tr>
                      	<td><?php echo $user->name; ?></td>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->name; ?></td>
                      </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </form>
              </div><!-- table-responsive -->
            </div>
          </div><!-- panel -->
    </div><!-- contentpanel -->