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
                            message: "You're required to fill in a role name!"
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
	    url: '<?php echo base_url(); ?>Admin/editRole',
	    type: 'post',
	    data: $('#editForm :input').serialize(),
	    dataType: 'html',
	    success: function(html) {
        $('#editForm')[0].reset();
        $('#editUser').modal('hide');
        bootbox.alert(html, function() {
          window.location.reload();
        });
      }
    });
  });
});
</script>
	<form id="editForm" method="post" class="form-horizontal">
	<?php  $user = $users[0]; ?>
		<div class="form-group">
			<label class="col-lg-3 control-label">Name : </label>
			<div class="col-lg-8">
			<input type="hidden" name="item_id" value="<?php echo $user->role_id; ?>" />
				<input value ="<?php echo $user->name; ?>" type="text" class="form-control" name="name" placeholder="Enter Role Name"/>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-primary">Update</button>
		</div>
	</form>