<link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/custom/js/jquery.timepicker.js"></script>
<style>
    #ui-datepicker-div {
        width:200px !important;
    }
</style>
<div id="editUser" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Ã—</button>
                <h4 class="modal-title">Edit Invoice Details</h4>
            </div>
            <div class="modal-body" id="edit-admin-content">

            </div>
        </div>
    </div>
</div>
<div class="pageheader">
    <h2><i class="fa fa-file"></i>Credit Transactions Report</h2>
</div>
<div class="contentpanel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="panel-title"><b> Credit Transactions Report</b></h4>
                    <p>View and Filter  Credit Transactions Report</p>
                </div>
                <div class="col-md-12 text-right mt10">
                    <form class="form-inline" action="<?php echo base_url(); ?>ShiftReports/CreditRegisterByCustomer" method ="Post">
                        <div class="col-md-12">                           
                            <div class="col-sm-8">
                                <select class="form-control mb15 selectpicker" name="shift" id="shift" data-live-search="true" data-style="btn-white" style="margin-top: 15px; padding: 10px 30px;">
                                    <?php foreach (list_shifts() as $shift) { ?>
                                        <option value="<?php echo $shift['shift_name_id']; ?>"><?php echo $shift['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>                                                     
                            <div class="input-group mr10">
                                <input type="text" class="form-control" id="from" name="date_from" placeholder="Date">
                                <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
                            </div>                        
                            <button type="submit" class="btn btn-success"><span class="fa fa-filter"></span> View Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table mb30">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Invoice</th>
                            <th>Vehicle</th>
                            <th>LPO Number</th>
                            <th>Amount</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ($sales != null) {
                            foreach ($sales->result() as $sale) {
                                ?>
                                <tr>                             
                                    <td><?php echo $sale->shift_name; ?></td>
                                    <td><?php echo $sale->company_name; ?></td>
                                    <td><?php echo $sale->lpo_number; ?></td>
                                    <td><?php echo $sale->vehicle; ?></td>
                                    <td><?php echo $sale->driver; ?></td>                                  
                                    <td><?php echo $sale->total_amount; ?></td>
                                    <td class="text-center">
                                        <?php if ($sale->status == 0) { ?>
                                            <span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editUser" onclick="edit('<?php echo $sale->sales_id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;</span>
                                        <?php } else { ?>
                                            <p class="text-danger"><b> --- </b></p>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div><!-- panel -->
</div><!-- contentpanel -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#searchForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                vendor: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in a full name!"
                        }
                    }
                },
                date_from: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in phone number!"
                        }
                    }
                },
                date_to: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in a Employment Date!"
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
                        url: '<?php echo base_url(); ?>Reports/VendorReport',
                        type: 'post',
                        data: $('#searchForm :input'),
                        dataType: 'html',
                        success: function (html) {

                        }
                    });
                });
    });
    $(function () {
        $("#from").datepicker();
        $("#to").datepicker();
    });
    function edit(id)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>Payment/editInvoice/' + id,
            type: 'post',
            dataType: 'html',
            success: function (html) {
                $('#edit-admin-content').html(html);

            }
        });
    }
</script>