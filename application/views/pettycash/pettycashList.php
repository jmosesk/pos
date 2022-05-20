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
                <h4 class="modal-title">Edit Petty Cash Category Details</h4>
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
                <h4 class="text-center">Add Petty Cash Category</h4>
            </div>
            <div class="modal-body">
                <form id="addForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Expense Code: <sup>*</sup></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="expcode" name="expcode" placeholder="Enter Expense Code" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Description: <sup>*</sup></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Expense Description" />
                        </div>
                    </div>                  
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Account Code : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <select class="form-control mb15 selectpicker" name="accountcode" data-live-search="true" data-style="btn-white">
                                <?php foreach ($accounts->result() as $account) { ?>
                                    <option value="<?php echo $account->accountcode; ?>"><?php echo $account->accountcode . '-' . $account->accountname; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Tax Category : <sup>*</sup></label>
                        <div class="col-lg-8">
                            <select class="form-control mb15 selectpicker" name="tax_id" data-live-search="true" data-style="btn-white">
                                <?php foreach ($taxs->result() as $tax) { ?>
                                    <option value="<?php echo $tax->type_id; ?>"><?php echo $tax->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Expense Limit: <sup>*</sup></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="cash_limit" placeholder="Enter Cash Expense Limit" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Expense</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal-->

<div class="pageheader">
    <h2><i class="fa fa-edit"></i> Petty Cash</h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Fms</a></li>
            <li class="active">Petty Cash Categories</li>
        </ol>
    </div>
</div>
<div class="contentpanel">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h5 class="subtitle mb5">Petty Cash Categories</h5>
                <p class="mb20">View and Edit Petty Cash Categories</p>
            </div>
            <div class="col-md-6 text-right">
                <!-- changed disabled to enable for test purposes of adding company and doing CRUD functions -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser" <?php if ((@$companies->result()[0]->company_id) != NULL) echo "enabled"; ?> ><span class="fa fa-plus"></span> &nbsp; Add PC Expenses</button>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped mb30">
                        <thead>
                            <tr>
                                <th>Expense Code</th>
                                <th>Description</th>                              
                                <th>Account Code</th>                               
                                <th>Tax Category</th>                         
                                <th>Expense Limit</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($expenses->result() as $company) { ?>
                                <tr>
                                    <td><?php echo $company->codeexpense; ?></td>
                                    <td><?php echo $company->description; ?></td>                                 
                                    <td><?php echo $company->accountname; ?></td>                                 
                                    <td><?php echo $company->tax; ?></td>                            
                                    <td><?php echo $company->explimit; ?></td>
                                    <td><span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editUser" onclick="edit('<?php echo $company->id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
                                    </td>
                                    <td><span class="btn btn-danger btn-xs" onclick="deleteCompany('<?php echo $company->id; ?>', '<?php echo $company->description; ?>')"><span class="glyphicon glyphicon-remove"></span>&nbsp;Delete</span>
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
                expcode: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Expense Code!"
                        }
                    }
                },
                description: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Description!"
                        }
                    }
                },
                cash_limit: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Cash Expense Limit"
                        },
                        numeric: {
                            message: "Please enter valid Value"
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
                url: '<?php echo base_url(); ?>PettyCash/addExpense',
                type: 'post',
                data: $("#addForm").serialize(),
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

    //Edit Expense
    function edit(id)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>PettyCash/edit_expense/' + id,
            type: 'post',
            dataType: 'html',
            success: function (html) {
                $('#edit-admin-content').html(html);
            }
        });
    }

    //Delete Expense
    function deleteCompany(id, nm) {
        bootbox.confirm("Are you sure you want to delete " + nm + "?", function (result) {
            if (result) {
                $.ajax({
                    url: '<?php echo base_url(); ?>Admin/delete/' + id,
                    type: 'post',
                    data: {id: id, tbl: "tbl_petty_cash_categories", row: 'id'},
                    dataType: 'html',
                    success: function (html) {
                        var response = JSON.parse(html);
                        var msg = response.message;
                        if(response.success) {
                            bootbox.alert((msg + " Category has been deleted"), function () {
                                window.location.reload();
                            });
                        } else {
                            bootbox.alert(msg, function () {
                            });
                        }
                    }
                });
            }
        });
    }
</script>
<link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>