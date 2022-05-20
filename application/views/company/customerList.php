            
<script type="text/javascript">
    $(document).ready(function () {
        $('#addForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
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
                            message: "You're required to fill in Customer Phone Number!"
                        }
                    }
                },
                location: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Customer Location!"
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
                .on('success.form.bv', function (e) {
                    // Prevent form submission
                    e.preventDefault();
                    // Get the form instance
                    var $form = $(e.target);

                    // Get the BootstrapValidator instance
                    var bv = $form.data('bootstrapValidator');

                    // Use Ajax to submit form data
                    $.ajax({
                        url: '<?php echo base_url(); ?>company/addCustomer',
                        type: 'post',
                        data: $('#addForm :input'),
                        dataType: 'html',
                        success: function (html) {
                            $('#addForm')[0].reset();
                            $('#addUser').modal('hide');
                            bootbox.alert(html, function ()
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
            url: '<?php echo base_url(); ?>Company/editCustomer/' + id,
            type: 'post',
            dataType: 'html',
            success: function (html) {
                $('#edit-admin-content').html(html);

            }
        });
    }

    function opening_balance(person_id, type, id) {
        $.ajax({
            url: '<?php echo base_url(); ?>Company/editOpeningBalance/' + id + '/' + person_id,
            type: 'post',
            dataType: 'html',
            success: function (html) {
                $('#opening_balance').html(html);
            }
        });
    }

// Delete Customer User

    function deleteCustomer(id, nm) {
        bootbox.confirm("Are you sure you want to delete " + nm + "?", function (result) {
            if (result) {
                $.ajax({
                    url: '<?php echo base_url(); ?>company/deleteCustomer/' + id,
                    type: 'post',
                    data: {id: id},
                    dataType: 'html',
                    success: function (html) {
                        bootbox.alert(html, function ()
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
                <h4 class="modal-title">Edit Customer Details</h4>
            </div>
            <div class="modal-body" id="edit-admin-content">

            </div>
        </div>
    </div>
</div>
<!--- Opening Balance -->
<div id="opening_balance_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Customer Opening Balance</h4>
            </div>
            <div class="modal-body" id="opening_balance">

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
                <h4 class="text-center">Add a Customer</h4>
            </div>
            <div class="modal-body">
                <form id="addForm" method="post" class="form-horizontal" enctype="multipart/form-data">                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Customer Name : <sup>*</sup></label>
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
                        <label class="col-lg-3 control-label">Address : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter postal Address" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">PIN : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="pin" name="pin" placeholder="Enter Cusomer PIN" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Location : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="location" placeholder="Enter Customer Location" />
                        </div>
                    </div>
                    <?php if ($role_level == 5) { ?>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Credit Limit : <sup>*</sup></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="limit" placeholder="Enter Credit Limit" />
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Select Category : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <select class="form-control mb15 selectpicker" name="category" data-live-search="true" data-style="btn-white">
                                <?php foreach ($categories->result() as $category) { ?>
                                    <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Customer</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal-->

<div class="pageheader">
    <h2><i class="fa fa-user-circle-o"></i> Customers List</h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Fms</a></li>
            <li class="active">Customers List</li>
        </ol>
    </div>
</div>
<div class="contentpanel">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h5 class="subtitle mb5">Customers List</h5>
                <p class="mb20">This is a list of all available Customers. You can view, search and edit Customers details</p>
            </div>
            <div class="col-md-6 text-right">
                <?php if ($role_level == 4 OR $role_level == 5 OR $role_level == 6 OR $role_level == 7) { ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser"><span class="fa fa-plus"></span> Add Customer</button>
                <?php } ?>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                   <table class="table table-striped table-hover mb30" id="no-ordering">
                        <thead>
                            <tr>
                                <th>#</th>                            
                                <th>Company Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>PIN</th>
                                <th>Credit Limit</th>
                                <th>Category</th>
                                <th>County</th>
                                <th>Status</th>
                                <?php if ($role_level == 4 OR $role_level == 5 OR $role_level == 6 OR $role_level == 7) { ?>
                                    <th class="text-center col-md-2">Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $row_count = 0;
                            if ($customers != null) {
                                foreach ($customers as $key => $customer) {
                                    $row_count = ++$row_count;
                                    ?>
                                    <tr>
                                        <td><?php echo $row_count; ?></td>                                       
                                        <td><?php echo $customer->company_name; ?></td>
                                        <td><?php echo $customer->phone_number; ?></td>
                                        <td><?php echo $customer->email; ?></td>
                                        <td><?php echo $customer->address; ?></td>
                                        <td><?php echo $customer->pin; ?></td>
                                        <td><?php echo $customer->credit_limit; ?></td>
                                        <td><?php echo $customer->category_name; ?></td>
                                        <td><?php echo $customer->county; ?></td>
                                        <td><?php
                                            if ($customer->status == 1)
                                                echo "<span class='label label-success'> Active </span>";
                                            else
                                                echo "<span class='label label-warning'> InActive </span>";
                                            ?></td>
                                        <?php if ($role_level == 4 OR $role_level == 5 OR $role_level == 6 OR $role_level == 7) { ?>
                                            <td>
                                                <span class="btn btn-info btn-xs" data-toggle="modal" data-target="#opening_balance_modal" onclick="opening_balance('<?php echo $customer->person_id; ?>', 'opening_balance', '<?php echo $customer->customer_id; ?>')"><span class="fa fa-folder-open" data-toggle="tooltip" data-placement="top" title="Set Opening Balance"></span>&nbsp;</span>&nbsp;
                                                <span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editUser" onclick="edit('<?php echo $customer->person_id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;</span>
                                                <span class="btn btn-danger btn-xs" onclick="deleteCustomer('<?php echo $customer->person_id; ?> ', '  <?php echo $customer->name; ?>')"><span class="glyphicon glyphicon-trash"></span>&nbsp;</span>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- table-responsive -->
            </div><!-- col-md-12 -->
        </div><!-- col-md-12 -->
    </div><!-- row -->
</div><!-- contentpanel -->