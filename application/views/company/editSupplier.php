	
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
              message: "You're required to fill in Supplier Phone Number!"
              }
            } 
          }, 
          location: {
            validators: {
              notEmpty: {
              message: "You're required to fill in Supplier Location!"
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
	    url: '<?php echo base_url(); ?>company/editSupplier',
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
  <?php if($suppliers != null) { ?>
  <?php $supplier = $suppliers->result()[0]; ?>
    <div class="form-group">
              <label class="col-lg-3 control-label">Contact Person : <sup>*</sup></label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Supplier Name" value="<?php echo $supplier->name; ?>" Readonly />
                <input type="hidden" class="form-control" id="item_id" name="item_id" value="<?php echo $supplier->person_id; ?>" Readonly />
                <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="<?php echo $supplier->supplier_id; ?>" Readonly />
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Company Name : <sup>*</sup></label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name" value="<?php echo $supplier->company_name; ?>" Readonly />
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Phone Number : <sup>*</sup></label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number" value="<?php echo $supplier->phone_number; ?>"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Email : <sup>*</sup></label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="<?php echo $supplier->email; ?>"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Location : <sup>*</sup></label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" value="<?php echo $supplier->county; ?>"/>
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-8 col-md-offset-3">
                <div class="ckbox ckbox-success">
                  <input type="checkbox" id="checkbox1" name="active" <?php if($supplier->status == 1) echo "checked"; ?>>
                  <label for="checkbox1"> Active Status </label>
                </div>
              </div>
            </div>
		
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>
  <?php } else {
    echo "Edit function disabled, please contact system admin";
  }