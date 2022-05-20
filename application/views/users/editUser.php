<script type="text/javascript">
$(document).ready(function() {
    $('#editForm').bootstrapValidator({
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
	    url: '<?php echo base_url(); ?>user/editUser',
	    type: 'post',
	    data: $('#editForm :input').serialize(),
	    dataType: 'html',
	    success: function(html) {
            $('#editForm')[0].reset();
            $('#editUser').modal('hide');
            bootbox.alert(html, function()
              {
              window.location.reload();
              });
            }
    });
  });
});
	document.getElementById('checkbox1').onchange = function() {
		    document.getElementById('login_enabled').style.display = this.checked ? 'block' : 'none';
		};
</script>
	<form id="editForm" method="post" class="form-horizontal">
	<?php  $user = $users->result()[0]; ?>
		<div class="form-group">
			<label class="col-lg-3 control-label">Name : </label>
			<div class="col-lg-8">
			<input type="hidden" name="item_id" value="<?php echo $user->user_id; ?>" />
				<input value ="<?php echo $user->name; ?>" type="text" class="form-control" name="name"/>
			</div>
		</div>
		<div class="form-group">
              <label class="col-lg-3 control-label">Employment Date : </label>
              <div class="col-lg-8">
              	<div class="input-group">
			      <input value ="<?php echo $user->employment_date; ?>" type="text" class="form-control date" id="to" name="employment" placeholder="Enter Employment Date">
			      <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
			    </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Phone Number : </label>
              <div class="col-lg-8">
                <input value ="<?php echo $user->phone_number; ?>" type="text" class="form-control" name="phone_number" placeholder="Enter Phone Number" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Select Title : </label>
              <div class="col-lg-8">
                <select class="form-control" name="title_id" data-live-search="true" data-style="btn-white">
                  <?php foreach ($titles->result() as $title){?>
                    <option value="<?php echo $title->user_title_id; ?>" <?php if($title->user_title_id ==$user->title_id) echo "selected"; ?>><?php echo $title->name; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
			<div class="form-group">
				<label class="col-lg-3 control-label">Role : </label>
				<div class="col-lg-8">
					<select class="form-control" name="role_id" data-live-search="true" data-style="btn-white">
	                  <?php foreach ($roles->result() as $role){?>
	                    <option value="<?php echo $role->role_id; ?>" <?php if($role->role_id == $user->role_id) {?> selected="Yes" <?php } ?>><?php echo $role->name; ?></option>
	                  <?php } ?>
	                </select>
				</div>
			</div>
            <?php if($user->username !=null) { ?>
				<div class="form-group">
	              <label class="col-lg-3 control-label">Username : </label>
	              <div class="col-lg-8">
	                <input value = "<?php echo $user->username; ?>" type="text" class="form-control" id="username" name="username" placeholder="Enter Username" Readonly/>
	              </div>
	            </div>
	     	<?php } else { ?>
	            <div class="form-group">
	              <div class="col-lg-8 col-md-offset-3">
	                <div class="ckbox ckbox-success">
	                  <input type="checkbox" id="checkbox1">
	                  <label for="checkbox1"> <strong>Enable Login</strong> </label>
	                </div>
	              </div>
	            </div>
				<div class="login_enabled" id="login_enabled" style="display: none">
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
			<?php } ?>
			</br>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-primary">Update</button>
		</div>
	</form>