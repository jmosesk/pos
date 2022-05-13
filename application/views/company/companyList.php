            
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
                name: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Company Name!"
                        }
                    }
                },
                phone_number: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in a Phone Number!"
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Address!"
                        }
                    }
                },
                pin: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in a Pin!"
                        }
                    }
                },
                location: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in a Location"
                        }
                    }
                },
                shift_day: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Number of Shifts per Day"
                        }
                    }
                },
                date: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in the Start Date!"
                        }
                    }
                },
                shift_week: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Number of Shifts per Week"
                        }
                    }
                },
                cash_bbf: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Cash BBF Limit"
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
                        url: '<?php echo base_url(); ?>company/addCompany',
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

    //Edit company
    function edit(id)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>company/editCompany/' + id,
            type: 'post',
            dataType: 'html',
            success: function (html) {
                $('#edit-admin-content').html(html);

            }
        });
    }

    //Delete company
    function deleteCompany(id, nm) {
        bootbox.confirm("Are you sure you want to delete " + nm + "?", function (result) {
            if (result) {
                $.ajax({
                    url: '<?php echo base_url(); ?>company/deleteCompany/' + id,
                    type: 'post',
                    data: {id: id},
                    dataType: 'html',
                    success: function (html) {
                        bootbox.alert(html);
                        if (html == 'User successfully deleted')
                            location.reload();
                    }
                });
            }
        });
    }

    $(function () {
        $("#datepicker").datepicker();
        $('#timepicker').timepicker({'timeFormat': 'H:i:s'});
    });
</script>
<link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/custom/js/jquery.timepicker.js"></script>
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
                <h4 class="modal-title">Edit Company Details</h4>
            </div>
            <div class="modal-body" id="edit-admin-content">

            </div>
        </div>
    </div>
</div>
<div id="addUser" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="text-center">Add Company</h4>
            </div>
            <div class="modal-body">
                <form id="addForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Company Name : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Phone Number : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Address : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">PIN : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="pin" name="pin" placeholder="Enter Pin Number" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Start Date:</label>
                        <div class="col-sm-8">
                            <div class="input-group mb15">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <div class="bootstrap-timepicker">
                                    <input id="datepicker" type="text" name="date" class="form-control date" placeholder="Select Start Date"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Location : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Shift per Day : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="shift_day" placeholder="Enter Number of shifts per Day" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Shift per Week : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="shift_week" placeholder="Enter Number of shifts per Week" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Reading Method : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <select class="form-control mb15 selectpicker" name="reading_method" data-live-search="true" data-style="btn-white">
                                <option value="1" selected="selected">HIGHEST</option>
                                <option value="2">ELECTRONIC CASH READING</option>
                                <option value="3">ELECTRONIC METER READING</option>
                                <option value="4">MANUAL METER READING</option>
                                <option value="5">ELECTRONIC HIGHEST READING</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Cash BBF Limit : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="cash_bbf" placeholder="Enter Cash BBF Limit" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Company</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal-->

<div class="pageheader">
    <h2><i class="fa fa-edit"></i> Company Information</h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Fms</a></li>
            <li class="active">Company Information</li>
        </ol>
    </div>
</div>
<div class="contentpanel">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h5 class="subtitle mb5">Company Information</h5>
                <p class="mb20">View and Edit Company details</p>
            </div>
            <div class="col-md-6 text-right">
                <!-- changed disabled to enable for test purposes of adding company and doing CRUD functions -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser" <?php if ((@$companies->result()[0]->company_id) != NULL) echo "enabled"; ?> ><span class="fa fa-plus"></span> Add Company</button>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped mb30">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Phone Number</th>
                                <th>Location</th>
                                <th>No of Shift a Day</th>
                                <th>No of Shift a Week</th>
                                <th>Reading Method</th>
                                <th>Start Date</th>
                                <th>Cash BBF</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($companies->result() as $company) { ?>
                                <tr>
                                    <td><?php echo $company->name; ?></td>
                                    <td><?php echo $company->phone_number; ?></td>
                                    <td><?php echo $company->location; ?></td>
                                    <td><?php echo $company->no_shift_day; ?></td>
                                    <td><?php echo $company->no_shift_week; ?></td>
                                    <td><?php echo $company->reading_method; ?></td>
                                    <td><?php echo format_date($company->start_date); ?></td>
                                    <td><?php echo $company->banking_limit; ?></td>
                                    <td><span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editUser" onclick="edit('<?php echo $company->company_id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
                                    </td>
                                    <td><span class="btn btn-danger btn-xs" <?php if ((@$companies->result()[0]->company_id) != NULL) echo "disabled"; ?> onclick="deleteCompany('<?php echo $company->company_id; ?>', '<?php echo $company->name; ?>')"><span class="glyphicon glyphicon-remove"></span>&nbsp;Delete</span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div><!-- table-responsive -->
            </div><!-- col-md-12 -->
        </div><!-- col-md-12 -->
    </div><!-- row -->
</div><!-- contentpanel -->