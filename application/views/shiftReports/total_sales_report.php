<div class="pageheader">
    <h2><i class="fa fa-sliders"></i> Sales Detailed Report</h2>
    <p class="mb20 text-muted">View and Filter Total Sales Report for given Date Range</p>
</div>
<div class="contentpanel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="text-right mt10">
                    <form class="form-inline" id="filterForm" method="post">
                        <div class="col-md-6 col-md-offset-4">
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
                        <div class="col-md-2">
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
                            <input type="hidden" name="filename" id="filename" value="<?php echo 'Sales Detailed Report'; ?>">
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
        var range = $("#reportrange").val();
        $('#export_div').hide();
        swal_wait("Please wait as we fetch data")
        $.ajax({
            url: '<?php echo base_url("ShiftReports/total_sales_report") ?>',
            type: 'POST',
            data: {range: range, shift: $("#shift").val()},
            success: function (response) {
                $('#salesTable').empty();
                //console.log(response);
                var results = JSON.parse(response);
                var categories = results.type;
                var data = results.data;
                ///console.log(data.credits);
                var trHTML = '';
                var new_table = open_main_table();
                var g_sum_qty = g_sum_amnt = g_sum_inv = g_sum_card = g_sum_mpesa = g_sum_cash = 0;
                $.each(categories, function (i, item) {
                    var sum_qty = sum_amnt = sum_inv = sum_card = sum_mpesa = sum_cash = 0;
                    var inv = cash = card = mpesa = 0;
                    trHTML += open_draw_table(item.name);
                    $.each(data.fuel, function (j, fuel) {
                        if (item.type_id == fuel.category_id) {
                            inv = cash = card = mpesa = 0;
                            if (fuel.item_id in data.credits) {
                                card = parseFloat(data.credits[fuel.item_id].credit_card);
                                mpesa = parseFloat(data.credits[fuel.item_id].mpesa);
                                inv = parseFloat(data.credits[fuel.item_id].invoice);
                            }
                            var item_obj = {};
                            item_obj.qty = fuel.qty;
                            item_obj.card = card;
                            item_obj.inv = inv;
                            item_obj.mpesa = mpesa;
                            item_obj.total = fuel.amnt;
                            var cal_cash = parseFloat(fuel.amnt) - parseFloat(card) - parseFloat(inv) - parseFloat(cash) - parseFloat(mpesa);
                            item_obj.cash = cal_cash;
                            item_obj.name = fuel.item_name;

                            sum_qty += parseFloat(fuel.qty);
                            sum_amnt += parseFloat(fuel.amnt);
                            sum_inv += parseFloat(inv);
                            sum_card += parseFloat(card);
                            sum_mpesa += parseFloat(mpesa);
                            sum_cash += parseFloat(cal_cash);
                            trHTML += draw_table(item_obj);
                        }
                    });

                    $.each(data.lubes, function (j, lubes) {
                        if (item.type_id == lubes.category_id) {
                            inv = cash = card = mpesa = 0;
                            if (data.credits.hasOwnProperty(lubes.item_id)) {
                                console.log(lubes.item_id);
                                card = parseFloat(data.credits[lubes.item_id].credit_card);
                                mpesa = parseFloat(data.credits[lubes.item_id].mpesa);
                                inv = parseFloat(data.credits[lubes.item_id].invoice);
                            }
                            var item_obj = {};
                            item_obj.qty = lubes.qty;
                            item_obj.card = card;
                            item_obj.inv = inv;
                            item_obj.mpesa = mpesa;
                            item_obj.total = lubes.amnt;
                            var cal_cash = parseFloat(lubes.amnt) - parseFloat(card) - parseFloat(inv) - parseFloat(cash) - parseFloat(mpesa);
                            item_obj.cash = cal_cash;
                            item_obj.name = lubes.item_name + lubes.item_id;

                            sum_qty += parseFloat(lubes.qty);
                            sum_amnt += parseFloat(lubes.amnt);
                            sum_inv += parseFloat(inv);
                            sum_card += parseFloat(card);
                            sum_mpesa += parseFloat(mpesa);
                            sum_cash += parseFloat(cal_cash);
                            trHTML += draw_table(item_obj);
                        }
                    });

                    $.each(data.jc, function (j, jc) {
                        if (item.type_id == jc.category_id) {
                            inv = cash = card = mpesa = 0;
                            if (jc.item_id in data.credits) {
                                card = parseFloat(data.credits[jc.item_id].credit_card);
                                mpesa = parseFloat(data.credits[jc.item_id].mpesa);
                                inv = parseFloat(data.credits[jc.item_id].invoice);
                            }
                            var item_obj = {};
                            item_obj.qty = jc.qty;
                            item_obj.card = card;
                            item_obj.inv = inv;
                            item_obj.mpesa = mpesa;
                            item_obj.total = jc.amnt;
                            var cal_cash = parseFloat(jc.amnt) - parseFloat(card) - parseFloat(inv) - parseFloat(cash) - parseFloat(mpesa);
                            item_obj.cash = cal_cash;
                            item_obj.name = jc.item_name;

                            sum_qty += parseFloat(jc.qty);
                            sum_amnt += parseFloat(jc.amnt);
                            sum_inv += parseFloat(inv);
                            sum_card += parseFloat(card);
                            sum_mpesa += parseFloat(mpesa);
                            sum_cash += parseFloat(cal_cash);
                            trHTML += draw_table(item_obj);
                        }
                    });

                    $.each(data.others, function (j, others) {
                        if (item.type_id == others.category_id) {
                            inv = cash = card = mpesa = 0;
                            if (others.item_id in data.credits) {
                                card = parseFloat(data.credits[others.item_id].credit_card);
                                mpesa = parseFloat(data.credits[others.item_id].mpesa);
                                inv = parseFloat(data.credits[others.item_id].invoice);
                            }
                            var item_obj = {};
                            item_obj.qty = others.qty;
                            item_obj.card = card;
                            item_obj.inv = inv;
                            item_obj.mpesa = mpesa;
                            item_obj.total = others.amnt;
                            var cal_cash = parseFloat(others.amnt) - parseFloat(card) - parseFloat(inv) - parseFloat(cash) - parseFloat(mpesa);
                            item_obj.cash = cal_cash;
                            item_obj.name = others.item_name;

                            sum_qty += parseFloat(others.qty);
                            sum_amnt += parseFloat(others.amnt);
                            sum_inv += parseFloat(inv);
                            sum_card += parseFloat(card);
                            sum_mpesa += parseFloat(mpesa);
                            sum_cash += parseFloat(cal_cash);
                            trHTML += draw_table(item_obj);
                        }
                    });
                    g_sum_qty += parseFloat(sum_qty);
                    g_sum_amnt += parseFloat(sum_amnt);
                    g_sum_cash += parseFloat(sum_cash);
                    g_sum_inv += parseFloat(sum_inv);
                    g_sum_card += parseFloat(sum_card);
                    g_sum_mpesa += parseFloat(sum_mpesa);
                    trHTML += total_table(item.name, sum_qty, sum_cash, sum_inv, sum_card, sum_mpesa, sum_amnt);
                });
                trHTML += close_main_table(g_sum_qty, g_sum_cash, g_sum_inv, g_sum_card, g_sum_mpesa, g_sum_amnt);
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
        export_header += '<th width="30%">Description</th><th width="10%">Qty Sold</th><th width="12%">Cash</th><th width="10%">Invoice</th><th width="10%">Card</th><th width="10%">Mpesa</th><th width="15%">Total Sales Amount</th>';
        export_header += '</tr>';
        var sub_heading = {};
        var date_range = $("#reportrange").val();
        var date_format = $("#reportrange").val().split("-");
        if (date_format) {
            from_date = date_format[0].split("/");
            to_date = date_format[1].split("/");
            date_range = from_date[1] + "-" + from_date[0] + "-" + from_date[2] + " to " + to_date[1] + "-" + to_date[0] + "-" + to_date[2];
        }
        sub_heading['sub_heading_1'] = 'Detailed Sales Report for a Period of ' + date_range;
        sub_heading['sub_heading_2'] = '';
        export_header += data;
        $('#filename').val('Detailed Sales Statement ' + date_range);
        $('#data_val').val(JSON.stringify(export_header));
        $('#sub_heading').val(JSON.stringify(sub_heading));
    }

    function open_main_table() {
        draw_panel = '<table class="table table-condensed mb0"><thead><tr><th width="30%">Description</th><th width="10%" style="text-align:right">Qty Sold</th><th width="12%" style="text-align:right">Cash</th><th width="10%" style="text-align:right">Invoice</th><th width="10%" style="text-align:right">Card</th><th width="10%" style="text-align:right">Mpesa</th><th width="15%" style="text-align:right">Total Sales Amount</th></tr>';
        draw_panel += '</thead><tbody>';
        return draw_panel;
    }

    function close_main_table(qty, cash, inv, card, mpesa, total) {
        var draw_panel = '<tr><td width="30%"><b>Grand Total </b></td>';
        draw_panel += '<td width="10%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(qty).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="12%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(cash).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="10%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(inv).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="10%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(card).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="10%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(mpesa).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="15%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(total).toFixed(2)) + '</b></td>';
        draw_panel += '</tr></tbody></table>';
        return draw_panel;
    }

    function open_draw_table(shift_name) {
        var draw_panel = '<tr>';
        draw_panel += '<td colspan="7"><b><span class="text-primary">' + shift_name + '</span></b></td></tr>';
        return draw_panel;
    }

    function draw_table(item) {
        var draw_panel = '<tr><td width="30%">' + item.name + '</td>';
        draw_panel += '<td width="10%" style="text-align:right">' + format_amount_decimals(parseFloat(item.qty).toFixed(2)) + '</td>';
        draw_panel += '<td width="12%" style="text-align:right">' + format_amount_decimals(parseFloat(item.cash).toFixed(2)) + '</td>';
        draw_panel += '<td width="10%" style="text-align:right">' + format_amount_decimals(parseFloat(item.inv).toFixed(2)) + '</td>';
        draw_panel += '<td width="10%" style="text-align:right">' + format_amount_decimals(parseFloat(item.card).toFixed(2)) + '</td>';
        draw_panel += '<td width="10%" style="text-align:right">' + format_amount_decimals(parseFloat(item.mpesa).toFixed(2)) + '</td>';
        draw_panel += '<td width="15%" style="text-align:right">' + format_amount_decimals(parseFloat(item.total).toFixed(2)) + '</td>';
        draw_panel += '</tr>';
        return draw_panel;
    }

    function total_table(item, qty, cash, inv, card, mpesa, total) {
        var draw_panel = '<tr><td width="30%"><b>Total ' + item + '</b></td>';
        draw_panel += '<td width="10%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(qty).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="12%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(cash).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="10%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(inv).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="10%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(card).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="10%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(mpesa).toFixed(2)) + '</b></td>';
        draw_panel += '<td width="15%" style="text-align:right"><b>' + format_amount_decimals(parseFloat(total).toFixed(2)) + '</b></td>';
        draw_panel += '</tr>';
        return draw_panel;
    }

    function draw_center(fuel) {
        var cash = parseFloat(fuel.amnt - (parseFloat(fuel.invoice) + parseFloat(fuel.credit_card) + parseFloat(fuel.mpesa)));
        var draw_panel = '<tr><td width="30%">' + fuel.item_name + '</td>';
        draw_panel += '<td width="10%" style="text-align:right">' + format_amount_decimals(parseFloat(fuel.qty).toFixed(2)) + '</td>';
        draw_panel += '<td width="12%" style="text-align:right">' + format_amount_decimals(parseFloat(cash).toFixed(2)) + '</td>';
        draw_panel += '<td width="10%" style="text-align:right">' + format_amount_decimals(parseFloat(fuel.invoice).toFixed(2)) + '</td>';
        draw_panel += '<td width="10%" style="text-align:right">' + format_amount_decimals(parseFloat(fuel.credit_card).toFixed(2)) + '</td>';
        draw_panel += '<td width="10%" style="text-align:right">' + format_amount_decimals(parseFloat(fuel.mpesa).toFixed(2)) + '</td>';
        draw_panel += '<td width="15%" style="text-align:right">' + format_amount_decimals(parseFloat(fuel.amnt).toFixed(2)) + '</td>';
        draw_panel += '</tr>';
        return draw_panel;
    }
</script>