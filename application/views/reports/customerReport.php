<link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>
<link rel="stylesheet" href="<?= base_url('assets/js/datepicker/daterangepicker.css') ?>"/>
<script type="text/javascript" src="<?= base_url('assets/js/datepicker/moment.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/datepicker/daterangepicker.js') ?>"></script>
<style>
    #ui-datepicker-div {
        width:200px !important;
    }
</style>
<div class="pageheader">
    <h2><i class="fa fa-address-book"></i> Customer Statement Report</h2>
</div>
<div class="contentpanel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="panel-title"><b>Customer Statement Report</b></h4>
                    <p>View and Filter Customer Statement Report</p>
                </div>
                <div class="col-md-12 text-right mt10">
                    <form class="form-inline" id="filterForm" method="post">
                        <div class="form-group col-md-4">
                            <label class="control-label col-md-3">Customer&nbsp; :  </label>
                            <div class="col-sm-9">
                                <select class="form-control mb15 selectpicker" name="vendor" data-live-search="true" data-style="btn-white" style="margin-top: 15px; padding: 10px 30px;">
                                    <option value="">Select Customer</option>
                                    <?php foreach ($customers as $customer) { ?>
                                        <option value="<?php echo $customer->customer_id; ?>"><?php echo $customer->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label col-md-3 text-right mt10">Date Range&nbsp; :  </label>
                            <div class="col-sm-9">
                                <div class='input-group width100p'>
                                    <input type="text" class="form-control" name="dateTo" id="reportrange" placeholder="From Date" readonly/>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-1">
                            <button type="submit" class="btn btn-success"><span class="fa fa-filter" id="generate_report"></span> Generate Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <form action="<?php echo base_url('Export') ?>" method="POST" target="_blank">
                <input type="hidden" name="sub_heading" id="sub_heading" value='<?php echo json_encode(array('sub_heading_1' => 'Customer Statement', 'sub_heading_2' => '')) ?>'>
                <input type="hidden" name="data_footer" id="data_footer" value='<?php echo json_encode('') ?>'>
                <input type="hidden" name="data_val" id="data_val" value=''>
               <button class="btn btn-default pull-right" type="submit" name="export_type" value="I"><span class="fa fa-file-pdf-o"></span> &nbsp; Export to Excel</button>
                <button class="btn btn-default pull-right" type="submit" name="export_type" value="D"><span class="fa fa-file-pdf-o"></span> &nbsp; Export to PDF</button>
            </form>
            <table class="table table-responsive table-hover text-left mb30">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Vehicle</th>
                        <th>Invoice</th>
                        <th>Details-Item-Price-Qty Amount</th>
                        <th style="text-align:right">Debit</th>
                        <th style="text-align:right">Credit</th>
                        <th style="text-align:right">Book Balance</th>
                    </tr>
                </thead>
                <tbody id="body_id">

                </tbody>
            </table>
            <div id="footer_val"></div>
        </div>
    </div><!-- panel -->
</div><!-- contentpanel -->
<script type="text/javascript">
    $('#filterForm').submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            url: "<?php echo base_url(); ?>Reports/CustomerReport",
            type: 'post',
            data: $('#filterForm :input').serialize(),
            dataType: 'json',
            success: function (html) {
                build_body(html);
            }
        });
    });

    function build_body(html) {
        var sub_table = '<table><tr><td style="width:37%">Item</td>';
        sub_table += '<td style="width:10%">Price</td>';
        sub_table += '<td style="width:12%">Qty</td>';
        sub_table += '<td style="width:15%">Amount</td></tr></table>';
        var export_header = '<table cellspacing="0" cellpadding="3" border="1" width="100%">';
        export_header += '<tr nobr="true" style="color:white; background-color:#36304a; font-size:9px">';
        export_header += '<th style="width:9%">Date</th>';
        export_header += '<th style="width:10%">Vehicle</th>';
        export_header += '<th style="width:12%">Invoice</th>';
        export_header += '<th style="width:45%">Details(Item-Price-Qty Amount)</th>';
        export_header += '<th style="width:7%; text-align:right">Debit</th>';
        export_header += '<th style="width:7%; text-align:right">Credit</th>';
        export_header += '<th style="width:10%; text-align:right">Book Balance</th>';
        export_header += '</tr>';
        export_header += '<tbody>';
        var bal = 0;
        var opening_bal = 0;
        var tbody = "";
        if (html.data.length > 0) {
            var amnt_bbf = html.data[0].amount;
            if (html.data[0].debit == 1)
                amnt_bbf = -(amnt_bbf);
            opening_bal = parseFloat(html.data[0].bbf) - parseFloat(amnt_bbf);
        }
        jQuery.each(html.data, function (i, val) {
            bal = val.bbf;
            var ref = "PMNT";
            var vehicle = "";
            if (val.debit == 1) {
                var amnt_debit = (val.amount);
                var amnt_cr = "";
            } else {
                var amnt_debit = "";
                var amnt_cr = val.amount;
            }
            if (val.transaction_type == 8) {
                var description = "Transaction Reversal";
            } else if (val.transaction_type == 10) {
                var description = "Credit Note";
            } else if (val.transaction_type == 11) {
                var description = "Debit Note";
            } else {
                if (val.payment_type == null) {
                    var description = "Opening Balance";
                } else {
                    if (val.debit == 1) {
                        var description = "";
                        if (val.lpo_number != null)
                            description += "" + val.lpo_number;
                        if (val.source != null)
                            description += "" + val.ref_number;
                        if (val.card_name != null)
                            description += "" + val.card_name;
                        ref = "PUR";
                        if (val.vehicle != null)
                            vehicle = val.vehicle;
                    } else {
                        var description = val.remarks;
                    }
                }
            }
            var item_tbl = '';
            if (html.items[val.customer_transaction_id].length > 0) {
                item_tbl += '<table cellspacing="1" align="center" style="float:left">';
            }
            jQuery.each((html.items[val.customer_transaction_id]), function (j, item) {
                item_tbl += '<tr><td style="width:45%">' + item.item_name + '</td>';
                item_tbl += '<td style="width:12%">' + item.unit_price + '</td>';
                item_tbl += '<td style="width:12%">' + item.quantity_sold + '</td>';
                item_tbl += '<td style="width:15%">' + item.total + '</td></tr>';
            });
            if (html.items[val.customer_transaction_id].length > 0) {
                item_tbl += '</table>';
            }
            tbody += '<tr nobr="false" style="font-size:8px">';
            tbody += '<td style="text-align:left">' + val.datetime + '</td>';
            tbody += '<td style="text-align:left">' + vehicle + '</td>';
            tbody += '<td style="text-align:left">' + description + '</td>';
            tbody += '<td style="text-align:left">' + item_tbl + '</td>';
            tbody += '<td style="text-align:right">' + format_amount_decimals(amnt_debit) + '</td>';
            tbody += '<td style="text-align:right">' + format_amount_decimals(amnt_cr) + '</td>';
            tbody += '<td style="text-align:right">' + format_amount_decimals(val.bbf) + '</td>';
            tbody += '</tr>';
        });
        $('#body_id').html(tbody);
        export_header += tbody;
        export_header += '</tbody></table>';
        var sub_heading = {};
        var date_range = $("#reportrange").val();
        var date_format = $("#reportrange").val().split("-");
        if (date_format) {
            from_date = date_format[0].split("/");
            to_date = date_format[1].split("/");
            date_range = from_date[1] + "-" + from_date[0] + "-" + from_date[2] + " to " + to_date[1] + "-" + to_date[0] + "-" + to_date[2];
        }
        sub_heading['sub_heading_1'] = 'Customer Statement for Period from ' + date_range;
        sub_heading['sub_heading_2'] = 'Customer : ' + html.customer + ' <span style="text-align:right">Opening Balance : ' + format_amount_decimals(parseFloat(opening_bal).toFixed(2)) + '</span>';

        var top_heading = '<div class="col-md-12 mb10"><p class="">' + 'Customer Statement for Period from ' + date_range;
        top_heading += '</p><p class="">' + 'Customer : ' + html.customer + '</br> <span style="text-align:right">Opening Balance : ' + format_amount_decimals(parseFloat(opening_bal).toFixed(2)) + '</span>';
        top_heading += '</p><button class="btn btn-default pull-right" type="submit" name="export_type" value="D"><span class="fa fa-file-pdf-o"></span> &nbsp; Export to PDF</button>';
        top_heading += '</div>';
        var footer = '<p><b>Closing Balance : ' + format_amount_decimals(parseFloat(bal).toFixed(2));
        $('#export_function').html(top_heading);
        $('#data_val').val(JSON.stringify(export_header));
        $('#sub_heading').val(JSON.stringify(sub_heading));
        $('#data_footer').val(JSON.stringify(footer));
        $('#footer_val').html(footer);
    }

    $(function () {
        var start = moment().subtract(29, 'days');
        var end = moment();
        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
        cb(start, end);
    });
</script>