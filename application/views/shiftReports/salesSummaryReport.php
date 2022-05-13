<div class="pageheader">
    <h2><i class="fa fa-sliders"></i> Sales Summary Report</h2>
    <p class="mb20 text-muted">View and Filter Sales Summary Report for given date range</p>
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
                            <input type="hidden" name="sub_heading" id="sub_heading" value='<?php echo json_encode(array('sub_heading_1' => 'Sales Summary Report', 'sub_heading_2' => '')) ?>'>
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
            url: '<?php echo base_url("ShiftReports/salesSummaryReport") ?>',
            type: 'POST',
            data: {range: range, shift: $("#shift").val()},
            success: function (response) {
                //console.log(response);
                $('#salesTable').empty();
                var results = JSON.parse(response);
                var categories = results.type;
                var data_response = results.data;
                var trHTML = '';
                var new_table = open_main_table();
                var g_sum_qty = 0;
                var g_sum_vol = 0;
                var g_sum_amnt = 0;
                var g_sum_netamnt = 0;
                g_vat_amnt = 0;
                var g_non_vat_amnt = 0;
                var g_zero_amnt = 0;
                $.each(categories, function (i, item) {
                    var sum_qty = 0;
                    var sum_vol = 0;
                    var sum_amnt = 0;
                    var sum_netamnt = 0;
                    sum_vat_amnt = 0;
                    var sum_non_vat_amnt = 0;
                    var sum_zero_amnt = 0;
                    trHTML += open_draw_table(item.name);
                    if (Object.keys(data_response).length > 0) {
                        $.each(data_response.lubes, function (j, lubes) {
                            if (item.type_id == lubes.category_id) {
                                sum_qty += parseFloat(lubes.qty);
                                sum_vol += parseFloat(lubes.vol);
                                sum_amnt += parseFloat(lubes.amnt);
                                sum_netamnt += parseFloat(lubes.netamnt);
                                sum_vat_amnt += parseFloat(lubes.vat);
                                trHTML += draw_fuel_center(lubes);
                            }
                        });
                        $.each(data_response.others, function (j, others) {
                            if (item.type_id == others.category_id) {
                                sum_qty += parseFloat(others.qty);
                                sum_vol += parseFloat(others.vol);
                                sum_amnt += parseFloat(others.amnt);
                                sum_netamnt += parseFloat(others.netamnt);
                                sum_vat_amnt += parseFloat(others.vat);
                                trHTML += draw_fuel_center(others);
                            }
                        });
                        $.each(data_response.fuel, function (j, fuel) {
                            if (item.type_id == fuel.category_id) {
                                sum_qty += parseFloat(fuel.qty);
                                sum_vol += parseFloat(fuel.vol);
                                sum_amnt += parseFloat(fuel.amnt);
                                sum_netamnt += parseFloat(fuel.netamnt);
                                sum_vat_amnt += parseFloat(fuel.vat);
                                trHTML += draw_fuel_center(fuel);
                            }
                        });
                        $.each(data_response.jc, function (j, fuel) {
                            if (item.type_id == fuel.category_id) {
                                sum_qty += parseFloat(fuel.qty);
                                sum_vol += parseFloat(fuel.vol);
                                sum_amnt += parseFloat(fuel.amnt);
                                sum_netamnt += parseFloat(fuel.netamnt);
                                sum_vat_amnt += parseFloat(fuel.vat);
                                trHTML += draw_fuel_center(fuel);
                            }
                        });
                        g_sum_qty += parseFloat(sum_qty);
                        g_sum_vol += parseFloat(sum_vol);
                        g_sum_amnt += parseFloat(sum_amnt);
                        g_sum_netamnt += parseFloat(sum_netamnt);
                        g_vat_amnt += parseFloat(sum_vat_amnt);
                        trHTML += total_table(item.name, sum_qty, sum_vol, sum_amnt,sum_netamnt, sum_vat_amnt, sum_non_vat_amnt, sum_zero_amnt);
                    }
                });
                trHTML += close_main_table(g_sum_qty, g_sum_vol, g_sum_amnt, g_sum_netamnt, g_vat_amnt, g_non_vat_amnt, g_zero_amnt);
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
        export_header += '<th style="width:20%">Description</th>';
        export_header += '<th style="width:12%">Qty Sold</th>';
        export_header += '<th style="width:12%">Volume</th>';
        export_header += '<th style="width:14%">Total Sales</th>';
        export_header += '<th style="width:14%">Net Sales</th>';
        export_header += '<th style="width:14%; text-align:right">VAT Amount</th>';
        export_header += '<th style="width:10%; text-align:right">NON VAT Amount</th>';
        export_header += '<th style="width:10%; text-align:right">Zero Tax Amount</th>';
        export_header += '</tr>';
        var sub_heading = {};
        var date_range = $("#reportrange").val();
        var date_format = $("#reportrange").val().split("-");
        if (date_format) {
            from_date = date_format[0].split("/");
            to_date = date_format[1].split("/");
            date_range = from_date[1] + "-" + from_date[0] + "-" + from_date[2] + " to " + to_date[1] + "-" + to_date[0] + "-" + to_date[2];
        }
        sub_heading['sub_heading_1'] = 'Sales Summary Report for a Period of ' + date_range;
        sub_heading['sub_heading_2'] = '';
        export_header += data;
        $('#data_val').val(JSON.stringify(export_header));
        $('#sub_heading').val(JSON.stringify(sub_heading));
    }

    function open_main_table() {
        draw_panel = '<table class="table table-condensed mb0"><thead><tr font-size:8px><th width="20%">Description</th><th width="12%">Qty Sold</th><th width="12%">Volume</th><th width="14%">Total Sales</th><th width="14%">Net Sales</th><th width="12%">VAT Amount</th><th width="10%">NON VAT Amount</th><th width="10%">Zero Tax Amount</th></tr>';
        draw_panel += '</thead><tbody>';
        return draw_panel;
    }

    function close_main_table(qty, vol, total, net, vat, non_vat, zero_vat) {
        var draw_panel = '<tr font-size:6px><td width="20%"><b>Grand Total </b></td>';
        draw_panel += '<td width="12%">' + format_amount_decimals(parseFloat(qty).toFixed(2)) + '</td>';
        draw_panel += '<td width="12%">' + format_amount_decimals(parseFloat(vol).toFixed(2)) + '</td>';
        draw_panel += '<td width="14%">' + format_amount_decimals(parseFloat(total).toFixed(2)) + '</td>';
        draw_panel += '<td width="14%">' + format_amount_decimals(parseFloat(net).toFixed(2)) + '</td>';
        draw_panel += '<td width="14%">' + format_amount_decimals(parseFloat(vat).toFixed(2)) + '</td>';
        draw_panel += '<td width="10%">' + format_amount_decimals(parseFloat(non_vat).toFixed(2)) + '</td>';
        draw_panel += '<td width="10%">' + format_amount_decimals(parseFloat(zero_vat).toFixed(2)) + '</td>';
        draw_panel += '</tr></tbody></table>';
        return draw_panel;
    }

    function open_draw_table(shift_name) {
        var draw_panel = '<tr>';
        draw_panel += '<td colspan="7"><b><span class="text-primary">' + shift_name + '</span></b></td></tr>';
        return draw_panel;
    }

    function total_table(item, qty, vol, total,net, vat, non_vat, zero_vat) {
        var draw_panel = '<tr font-size:6px><td width="20%"><b>Total ' + item + '</b></td>';
        draw_panel += '<td width="12%"><b>' + format_amount_decimals(parseFloat(qty).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="12%"><b>' + format_amount_decimals(parseFloat(vol).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="14%"><b>' + format_amount_decimals(parseFloat(total).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="14%"><b>' + format_amount_decimals(parseFloat(net).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="14%"><b>' + format_amount_decimals(parseFloat(vat).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="10%"><b>' + format_amount_decimals(parseFloat(non_vat).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="10%"><b>' + format_amount_decimals(parseFloat(zero_vat).toFixed(2)) + '</b></td>';
        draw_panel += '</tr>';
        return draw_panel;
    }

    function draw_fuel_center(fuel) {
        var draw_panel = '<tr font-size:6px><td width="20%">' + fuel.item_name + '</td>';
        draw_panel += '<td width="12%">' + format_amount_decimals(parseFloat(fuel.qty).toFixed(2)) + '</td>';
        draw_panel += '<td width="12%">' + format_amount_decimals(parseFloat(fuel.vol).toFixed(2)) + '</td>';
        draw_panel += '<td width="14%">' + format_amount_decimals(parseFloat(fuel.amnt).toFixed(2)) + '</td>';
        draw_panel += '<td width="14%">' + format_amount_decimals(parseFloat(fuel.netamnt).toFixed(2)) + '</td>';
        draw_panel += '<td width="14%">' + format_amount_decimals(parseFloat(fuel.vat).toFixed(2)) + '</td>';
        draw_panel += '<td width="10%">' + parseFloat(0).toFixed(2) + '</td>';
        draw_panel += '<td width="10%">' + parseFloat(0).toFixed(2) + '</td>';
        draw_panel += '</tr>';
        return draw_panel;
    }

    function draw_center(fuel) {
        var draw_panel = '<tr font-size:6px><td width="20%">' + fuel.item_name + '</td>';
        draw_panel += '<td width="12%">' + format_amount_decimals(fuel.qty) + '</td>';
        draw_panel += '<td width="12%">' + format_amount_decimals(fuel.vol) + '</td>';
        draw_panel += '<td width="14%">' + format_amount_decimals(parseFloat(fuel.amnt).toFixed(2)) + '</td>';
        draw_panel += '<td width="14%">' + format_amount_decimals(parseFloat(fuel.netamnt).toFixed(2)) + '</td>';
        draw_panel += '<td width="14%">' + format_amount_decimals(parseFloat(fuel.vat).toFixed(2)) + '</td>';
        draw_panel += '<td width="10%">' + parseFloat(0).toFixed(2) + '</td>';
        draw_panel += '<td width="10%">' + parseFloat(0).toFixed(2) + '</td>';
        draw_panel += '</tr>';
        return draw_panel;
    }
</script>