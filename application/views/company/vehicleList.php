   
  
  <link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>

    <div id="editUser" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Edit Vehicle Details</h4>
          </div>
          <div class="modal-body" id="edit-admin-content">
            
          </div>
        </div>
      </div>
    </div>
  <!-- Modal to add Company -->
  <div id="addUser" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="text-center">Add Vehicle</h4>
          </div>
          <div class="modal-body">
          <form id="addForm" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-lg-4 control-label">Select Transporter : <sup>*</sup></label>
              <div class="col-lg-7">
                <input type="hidden" class="form-control" name="type" value="transporter" />
                <select class="form-control mb15 selectpicker" name="transporter" data-live-search="true" data-style="btn-white">
                  <?php foreach ($transporters->result() as $transporter){?>
                    <option value="<?php echo $transporter->transporter_id; ?>"><?php echo $transporter->transporter_name; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-4 control-label">Registration Number : <sup>*</sup></label>
              <div class="col-lg-7">
                <input type="text" class="form-control" id="reg" name="reg" placeholder="Enter Vehicle Registration Number" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-4 control-label">Description : <sup>*</sup></label>
              <div class="col-lg-7">
                <input type="text" class="form-control" id="description" name="description" placeholder="Enter Vehicle Description" />
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-8 col-md-offset-4">
                <div class="ckbox ckbox-success">
                  <input type="checkbox" id="checkbox1" name="active">
                  <label for="checkbox1"> Active Status </label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Add Vehicle</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  <!-- End of Modal-->

    <div class="pageheader">
      <h2><i class="fa fa-edit"></i> Vehicles</h2>
    </div>
    <div class="contentpanel">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-6">
                  <h4 class="panel-title"><b>Vehicles List</b></h4>
                  <p>View, add and Edit Vehicles Details</p>
                </div>
                <div class="col-md-6 text-right">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser"><span class="fa fa-plus"></span> Add Vehicle</button>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped mb30">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Transporter</th>
                      <th>Registration Number</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $row_count = 0; foreach ($vehicles->result() as $vehicle) { $row_count = ++$row_count;?>
                    <tr>
                      <td><?php echo $row_count; ?></td>
                      <td><?php echo $vehicle->transporter_name; ?></td>
                      <td><?php echo $vehicle->registration_number; ?></td>
                      <td><?php echo $vehicle->description; ?></td>                    
                     
                      <td><?php if($vehicle->status == 0) echo "<span class='label label-success'> Active </span>"; else echo "<span class='label label-warning'> InActive </span>"; ?></td>
                      <td><span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editUser" onclick="edit('<?php echo $vehicle->vehicle_id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>  
                          <span class="btn btn-danger btn-xs" onclick="deleteVehicle('<?php echo $vehicle->vehicle_id; ?>','<?php echo $vehicle->transporter_name; ?>')"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</span></td>
                    
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div><!-- table-responsive -->
            </div>
          </div><!-- panel -->
    </div><!-- contentpanel -->
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
                reg: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Vehicle Registration Number!"
                        }
                    }
                }, 
          description: {
            validators: {
              notEmpty: {
              message: "You're required to fill in Vehicle Description!"
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
          url: '<?php echo base_url(); ?>company/addVehicle',
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
          url: '<?php echo base_url(); ?>company/editVehicle/' + id,
          type: 'post',
          data: {type: "transporter"},
          dataType: 'html',   
          success: function(html) {
           $('#edit-admin-content').html(html);
             
          }
        });
    }

    function deleteVehicle(id, nm){
      bootbox.confirm("Are you sure you want to delete " + nm + "?", function(result) {
        if(result) {
          $.ajax({
          url: '<?php echo base_url(); ?>company/deleteVehicle/' + id,
          type: 'post',
          data: {id: id, type: 'transporter'},
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