	
<script type="text/javascript">
$(document).ready(function() {
    $('#editGridForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
 
          phone_number: {
            validators: {
              notEmpty: {
              message: "You're required to fill in Transporter Phone Number!"
              }
            } 
          }, 

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
	    url: '<?php echo base_url(); ?>company/editTransporter',
	    type: 'post',
	    data: $('#editGridForm :input').serialize(),
	    dataType: 'html',		
	    success: function(html) {
           	$('#editUser').modal('hide');
            bootbox.alert(html, function()
              {
             window.location.reload();
              });
            }
    });
  });
});

</script>
	<form id="editGridForm">
  <?php $transporter = $transporters->result()[0]; ?>
    <div class="form-group">
              <label class="col-lg-4 control-label">Transporter Name : <sup>*</sup></label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Transporter Name" value="<?php echo $transporter->transporter_name; ?>" Readonly />
                <input type="hidden" class="form-control" id="item_id" name="item_id" value="<?php echo $transporter->transporter_id; ?>" Readonly />
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-4 control-label">Phone Number : <sup>*</sup></label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number"  value="<?php echo $transporter->phone_number; ?>" />
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-8 col-md-offset-4">
                <div class="ckbox ckbox-success">
                  <input type="checkbox" id="checkbox1" name="active" <?php if($transporter->status == 1) echo "checked"; ?>>
                  <label for="checkbox1"> Active Status </label>
                </div>
              </div>
            </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>