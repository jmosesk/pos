        
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
                            message: "You're required to fill in Supplier Name!"
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
          }, 
          description: {
            validators: {
              notEmpty: {
              message: "You're required to fill in Centre Description!"
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
          url: '<?php echo base_url(); ?>company/addSupplier',
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

    function edit(id) {
    $.ajax({
          url: '<?php echo base_url(); ?>company/editSupplier/' + id,
          type: 'post',
          dataType: 'html',   
          success: function(html) {
           $('#edit-admin-content').html(html);             
          }
        });
    }
    //Delete Supplier
    function deleteSupplier(id, nm){
      bootbox.confirm("Are you sure you want to delete " + nm + "?", function(result) {
        if(result) {
          $.ajax({
          url: '<?php echo base_url(); ?>company/deleteSupplier/' + id,
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
  <link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>

	<?php $role_level = $this->session->userdata('logged_in')['role_id']; ?>
    <div id="editUser" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Edit Supplier Details</h4>
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
            <h4 class="text-center">Add a Supplier</h4>
          </div>
          <div class="modal-body">
          <form id="addForm" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-lg-3 control-label">Contact Person : <sup>*</sup></label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Contact Person's Full Name" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Company Name : <sup>*</sup></label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Phone Number : <sup>*</sup></label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Email : <sup>*</sup></label>
              <div class="col-lg-8">
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Address" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Location : <sup>*</sup></label>
              <div class="col-lg-8">
                <input type="text" class="form-control" name="location" placeholder="Enter Customer Location" />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Add Supplier</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  <!-- End of Modal-->

   <div class="pageheader">
      <h2><i class="fa fa-bus"></i> Suppliers List</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>">Fms</a></li>
          <li class="active">Suppliers List</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <h5 class="subtitle mb5">Suppliers List</h5>
            <p class="mb20">This is a list of Suppliers. You can view, search and edit supplier details</p>
          </div>
          <div class="col-md-6 text-right">
            <?php if($role_level == 4 OR $role_level == 5 OR $role_level == 6 OR $role_level == 7){ ?>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser"><span class="fa fa-plus"></span> Add Supplier</button>
            <?php } ?>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped mb30">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Contact Person</th>
                    <th>Company Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Status</th>
            		<?php if($role_level == 4 OR $role_level == 5 OR $role_level == 6 OR $role_level == 7){ ?>
                    <th class="text-center">Action</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php $row_count = 0; foreach ($suppliers->result() as $supplier) { $row_count = ++$row_count;?>
                  <tr>
                    <td><?php echo $row_count; ?></td>
                    <td><?php echo $supplier->name; ?></td>
                    <td><?php echo $supplier->company_name; ?></td>
                    <td><?php echo $supplier->phone_number; ?></td>
                    <td><?php echo $supplier->email; ?></td>
                    <td><?php echo $supplier->county; ?></td>
                    <td><?php if($supplier->status == 1) echo "<span class='label label-success'> Active </span>"; else echo "<span class='label label-warning'> InActive </span>"; ?></td>
            		<?php if($role_level == 4 OR $role_level == 5 OR $role_level == 6 OR $role_level == 7){ ?>
                    <td><span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editUser" onclick="edit('<?php echo $supplier->person_id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
                    <span class="btn btn-danger btn-xs" onclick="deleteSupplier('<?php echo $supplier->person_id; ?>','<?php echo $supplier->name; ?>')"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</span>
                    </td>
                    <?php } ?>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
            </div><!-- table-responsive -->
          </div><!-- col-md-12 -->
        </div><!-- col-md-12 -->
      </div><!-- row -->
    </div><!-- contentpanel -->