<link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/custom/js/jquery.timepicker.js"></script>
<style>
    #ui-datepicker-div {
        width:200px !important;
    }
</style>
<div class="pageheader">
    <h2><i class="fa fa-file"></i><?php echo ucfirst($type) . " Credit Transactions Report" ?></h2>
</div>
<div class="contentpanel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="panel-title"><b><?php echo ucfirst($type) . " Credit Transactions Report" ?></b></h4>
                    <p>View and Filter <?php echo ucfirst($type) . " Credit Transactions Report" ?></p>
                </div>
                <div class="col-md-12 text-right mt10">
                    <form class="form-inline" action="<?php echo base_url(); ?>Reports/credit_report_detail ? type=<?php echo $type; ?>">
                        <div class="col-md-12">
                            <?php if ($type == "Customer") { ?>
                                <select class="form-control mr10" name="customer" style="padding: 10px 30px;">
                                    <option value="">All Customers</option>
                                    <?php foreach ($customers as $customer) { ?>
                                        <option value="<?php echo $customer->person_id; ?>"><?php echo $customer->name; ?></option>
                                    <?php } ?>
                                </select>
                                <select class="form-control mr10" name="payment_type" style="padding: 10px 30px;">
                                    <option value="">All Payment Types</option>
                                    <?php foreach ($customers as $customer) { ?>
                                        <option value="<?php echo $customer->person_id; ?>"><?php echo $customer->name; ?></option>
                                    <?php } ?>
                                </select>
                            <?php } else { ?>
                                <select class="form-control mr10" name="employee" style="padding: 10px 30px;">
                                    <option value="">All Cashiers</option>
                                    <?php foreach ($customers as $customer) { ?>
                                        <option value="<?php echo $customer->person_id; ?>"><?php echo $customer->name; ?></option>
                                    <?php } ?>
                                </select>
                                <select class="form-control mr10" name="payment_type" style="padding: 10px 30px;">
                                    <option value="">All Payment Types</option>
                                    <?php foreach ($customers as $customer) { ?>
                                        <option value="<?php echo $customer->person_id; ?>"><?php echo $customer->name; ?></option>
                                    <?php } ?>
                                </select>
                            <?php } ?>
                            <div class="input-group mr10">
                                <input type="text" class="form-control" id="from" name="date_from" placeholder="From Date">
                                <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
                            </div>
                            <div class="input-group mr10">
                                <input type="text" class="form-control" id="to" name="date_to" placeholder="To Date">
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
                            <th>Datetime</th>
                            <th>Shift Name</th>
                            <th>Shift Date</th>
                            <th><?php echo ucfirst($type) ?></th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($transactions as $transaction) {
                            $i++; ?>
                            <tr>
                                <td><?php echo format_datetime($transaction['datetime']) ?></td>
                                <td><?php echo $transaction['shift_name'] ?></td>
                                <td><?php echo format_date($transaction['shift_date']) ?></td>
                                <td><?php echo $transaction['cashier'] ?></td>
                                <td><?php echo format_cash($transaction['total_amount']) ?></td>
                            </tr>
<?php } ?>

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
</script>