<div class="pageheader">
    <h2><i class="fa fa-sliders"></i> Purchase Summary Report</h2>
    <p class="mb20 text-muted">View and Filter Purchase Summary Report for given date range</p>
</div>
<div class="contentpanel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="text-right mt10">
                    <form class="form-inline" id="filterForm" method="post">
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
                            <button type="button" class="btn btn-success" id="generate_report">Generate Report</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt10">
                <div id="export_div" style="display:none">
                    <div class="col-md-12">
                        <form action="<?php echo base_url('Export') ?>" method="POST" target="_blank">
                            <input type="hidden" name="sub_heading" id="sub_heading" value='<?php echo json_encode(array('sub_heading_1' => 'Purchase Summary Report', 'sub_heading_2' => '')) ?>'>
                            <input type="hidden" name="data_footer" id="data_footer" value='<?php echo json_encode('') ?>'>
                            <input type="hidden" name="data_val" id="data_val" value=''>                  
                            <button class="btn btn-default pull-right" type="submit" name="export_type" value="I"><span class="fa fa-file-pdf-o"></span> &nbsp; Export to Excel</button>
                            <button class="btn btn-default pull-right" type="submit" name="export_type" value="D"><span class="fa fa-file-pdf-o"></span> &nbsp; Export to PDF</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="salesTable">

        </div>
    </div><!-- panel -->
</div><!-- contentpanel -->

<script type="text/javascript">
    $("#generate_report").click(function (e) {
        e.preventDefault();
        $('#export_div').hide();
        var range = $("#reportrange").val();
        swal_wait("Please wait as we fetch data")
        $.ajax({
            url: '<?php echo base_url("ShiftReports/purchaseSummaryReport") ?>',
            type: 'POST',
            data: {range: range, shift: $("#shift").val()},
            success: function (response) {
                console.log(response);
                $('#salesTable').empty();
                var results = JSON.parse(response);
                var categories = results.type;
                var data_response = results.fuels;
                var trHTML = '';
                var new_table = open_main_table();
                var g_sum_qty = g_net = g_vat_amnt = g_gross = 0;
                $.each(categories, function (i, item) {
                    var sum_qty = sum_net = sum_vat_amnt = sum_gross = 0;
                    trHTML += open_draw_table(item.name);
                    //console.log(data_response);
                    if (Object.keys(data_response).length > 0) {
                        $.each(data_response, function (j, fuels_data) {
                            if (item.type_id == fuels_data.category_id) {
                                var purchase_data = new Array();
                                var qty = sum_amnt(fuels_data.qty_amnt, fuels_data.qty);
                                var vat = sum_amnt(fuels_data.vat_amnt, fuels_data.vat);
                                var gross = sum_amnt(fuels_data.gross_amnt, fuels_data.gross_amount);
                                var net = parseFloat(gross) - parseFloat(vat);
                                purchase_data['name'] = strip_empty(fuels_data.item_name) + strip_empty(fuels_data.name);
                                purchase_data['qty'] = (qty);
                                purchase_data['vat'] = (vat);
                                purchase_data['gross_amount'] = (gross);
                                purchase_data['net'] = (net);
                                console.log(net);

                                sum_qty += parseFloat(qty);
                                sum_gross += parseFloat(gross);
                                sum_net += parseFloat(net);
                                sum_vat_amnt += parseFloat(vat);
                                trHTML += draw_center(purchase_data);
                            }
                        });
                    }
                    g_sum_qty += parseFloat(sum_qty);
                    g_net += parseFloat(sum_net);
                    g_vat_amnt += parseFloat(sum_vat_amnt);
                    g_gross += parseFloat(sum_gross);
                    trHTML += total_table((strip_empty(item.item_name) + strip_empty(item.name)), sum_qty, sum_net, sum_vat_amnt, sum_gross);
                    //trHTML += close_draw_table();
                });
                trHTML += close_main_table(g_sum_qty, g_net, g_vat_amnt, g_gross);
                new_table += trHTML;
                $('#salesTable').append(new_table);
                initialize_export(trHTML);
                swal_close();
            }
        });
    });

    function initialize_export(data) {
        $('#export_div').show();
        var export_header = '<table cellspacing="0" cellpadding="3" border="1" width="100%">';
        export_header += '<tr nobr="true" style="color:white; background-color:#36304a; font-size:6px">';
        export_header += '<th style="width:42%">Description</th>';
        export_header += '<th style="width:10%; text-align:right">Qty</th>';
        export_header += '<th style="width:15%; text-align:right">Net Amount</th>';
        export_header += '<th style="width:15%; text-align:right">VAT Amount</th>';
        export_header += '<th style="width:15%; text-align:right">Gross Amount</th>';
        export_header += '</tr>';
        var sub_heading = {};
        var date_range = $("#reportrange").val();
        var date_format = $("#reportrange").val().split("-");
        if (date_format) {
            from_date = date_format[0].split("/");
            to_date = date_format[1].split("/");
            date_range = from_date[1] + "-" + from_date[0] + "-" + from_date[2] + " to " + to_date[1] + "-" + to_date[0] + "-" + to_date[2];
        }
        sub_heading['sub_heading_1'] = 'Purchase Summary Report for a Period of ' + date_range;
        sub_heading['sub_heading_2'] = '';
        export_header += data;
        $('#data_val').val(JSON.stringify(export_header));
        $('#sub_heading').val(JSON.stringify(sub_heading));
    }

    function open_main_table() {
        draw_panel = '<table class="table table-condensed mb0"><thead><tr><th width="42%">Description</th><th width="10%" style="text-align:right">Qty</th><th width="12%" style="text-align:right">Net Amount</th><th width="12%" style="text-align:right">VAT Amount</th><th width="12%" style="text-align:right">Gross Amount</th></tr>';
        draw_panel += '</thead><tbody>';
        return draw_panel;
    }

    function close_main_table(qty, net_amount, vat, zero_vat) {
        var draw_panel = '<tr><td width="42%"><b>Grand Total </b></td>';
        draw_panel += '<td width="10%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(qty).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="15%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(net_amount).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="15%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(vat).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="15%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(zero_vat).toFixed(2)) + '</b></td>';
        draw_panel += '</tr></tbody></table>';
        return draw_panel;
    }

    function open_draw_table(shift_name) {
        var draw_panel = '<tr>';
        draw_panel += '<td colspan="7"><b><span class="text-primary">' + shift_name + '</span></b></td></tr>';
        return draw_panel;
    }

    function total_table(item, qty, gross_amount, vat, zero_vat) {
        var draw_panel = '<tr><td width="42%"><b>Total ' + item + '</b></td>';
        draw_panel += '<td width="10%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(qty).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="15%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(gross_amount).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="15%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(vat).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="15%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(zero_vat).toFixed(2)) + '</b></td>';
        draw_panel += '</tr>';
        return draw_panel;
    }

    function draw_center(fuel) {
        var draw_panel = '<tr><td width="42%">' + fuel.name + '</td>';
        draw_panel += '<td width="10%" style="text-align:right">' + format_amount_decimals(parseFloat(fuel.qty).toFixed(2)) + '</td>';
        draw_panel += '<td width="15%" style="text-align:right">' + format_amount_decimals(parseFloat(fuel.net).toFixed(2)) + '</td>';
        draw_panel += '<td width="15%" style="text-align:right">' + format_amount_decimals(parseFloat(fuel.vat).toFixed(2)) + '</td>';
        draw_panel += '<td width="15%" style="text-align:right">' + format_amount_decimals(parseFloat(parseFloat(fuel.gross_amount)).toFixed(2)) + '</td>';
        draw_panel += '</tr>';
        return draw_panel;
    }
</script>