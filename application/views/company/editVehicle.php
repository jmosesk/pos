	
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
                name: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Customer Name!"
                        }
                    }
                }, 
          company_name: {
            validators: {
              notEmpty: {
              message: "You're required to fill in Company Name!"
              }
            } 
          }, 
          phone_number: {
            validators: {
              notEmpty: {
              message: "You're required to fill in Transporter Phone Number!"
              }
            } 
          }, 
          location: {
            validators: {
              notEmpty: {
              message: "You're required to fill in Customer Location!"
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
	    url: '<?php echo base_url(); ?>company/editVehicle',
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
    <?php $vehicle = $vehicles->result()[0]; 
    if($type == "customer") { ?>
      <div class="form-group">
        <label class="col-lg-4 control-label">Customer : <sup>*</sup></label>
        <div class="col-lg-7">
          <select class="form-control" name="transporter" data-live-search="true" data-style="btn-white">
            <?php foreach ($transporters as $transporter){?>
              <option value="<?php echo $transporter->customer_id; ?>"<?php if($transporter->customer_id == $vehicle->customer_id) {?> selected="Yes" <?php } ?>><?php echo $transporter->company_name; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    <?php } else { ?>
      <div class="form-group">
        <label class="col-lg-4 control-label">Transporter Name : <sup>*</sup></label>
        <div class="col-lg-7">
          <select class="form-control" name="transporter" data-live-search="true" data-style="btn-white">
            <?php foreach ($transporters->result() as $transporter){?>
              <option value="<?php echo $transporter->transporter_id; ?>"<?php if($transporter->transporter_id == $vehicle->transporter_id) {?> selected="Yes" <?php } ?>><?php echo $transporter->transporter_name; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    <?php } ?>
      <div class="form-group">
        <label class="col-lg-4 control-label">Registration Number : <sup>*</sup></label>
        <div class="col-lg-7">
          <input type="hidden" name="item_id" value="<?php echo $vehicle->vehicle_id; ?>">
          <input type="hidden" name="type" value="<?php echo $type ?>">
          <input type="text" class="form-control" id="reg" name="reg" placeholder="Enter Vehicle Registration Number" value="<?php echo $vehicle->registration_number; ?>" Readonly/>
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-4 control-label">Description : <sup>*</sup></label>
        <div class="col-lg-7">
          <input type="text" class="form-control" id="description" name="description" placeholder="Enter Vehicle Description" value="<?php echo $vehicle->description; ?>"/>
        </div>
      </div>
      <div class="form-group">
        <div class="col-lg-8 col-md-offset-4">
          <div class="ckbox ckbox-success">
            <input type="checkbox" id="checkbox1" name="active" <?php if($vehicle->status == 1) echo "checked"; ?>>
            <label for="checkbox1"> Active Status </label>
          </div>
        </div>
      </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>