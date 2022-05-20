<div class="pageheader">
    <h2><i class="fa fa-sliders"></i> Cash Sales Summary Report</h2>
    <p class="mb20 text-muted">View and Filter Cash Sales Summary Report</p>
</div>
<div class="contentpanel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="panel-title"><b>Filter Cash Sales Report</b></h4>
                    <p>View and Filter Cash Sales Report per Shift and over a Duration of Time</p>
                </div>
                <div class="col-md-12 text-right mt10">
                    <form class="form-inline" id="filterForm" method="post">
                        <div class="form-group col-md-4">
                            <label class="control-label col-md-4" style="margin-top: 5px;">Select a Shift&nbsp; :  </label>
                            <div class="col-sm-8">
                                <select class="form-control mb15 selectpicker" name="shift" id="shift" data-live-search="true" data-style="btn-white" style="margin-top: 15px; padding: 10px 30px;">
                                    <option value="">All Shifts</option>
                                    <?php foreach (list_shifts() as $shift) { ?>
                                        <option value="<?php echo $shift['shift_name_id']; ?>"><?php echo $shift['name']; ?></option>
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
                            <button type="button" class="btn btn-success" id="generate_report">Generate Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div id="salesTable">

            </div>
        </div>
    </div><!-- panel -->
</div><!-- contentpanel -->

<script type="text/javascript">
    $("#generate_report").click(function (e) {
        e.preventDefault();
        var range = $("#reportrange").val();
        $.ajax({
            url: '<?php echo base_url("ShiftReports/salesSummary") ?>',
            type: 'POST',
            data: {range: range, shift: $("#shift").val()},
            success: function (response) {
                console.log(response);
                $('#salesTable').empty();
                var results = JSON.parse(response);
                var shifts = results.shifts;
                var centres = results.centres;
                var data = results.data;
                var trHTML = '';
                $.each(shifts, function (i, item) {
                    trHTML += open_draw_table(item.shift_name, item.operator);
                    var reading_method = item.reading;
                    $.each(centres, function (j, centre) {
                        sale_qty = 0;
                        sale_amnt = 0;
                        cash_qty = 0;
                        cash_amnt = 0;
                        credit_qty = 0;
                        credit_amnt = 0;
                        if (centre.shift_id == item.shift_id) {
                            $.each(data.other, function (j, other) {
                                if (centre.centre_id == other.centre_id && centre.shift_id == other.shift_id) {
                                    sale_qty = parseFloat(other.closing_quantity) - parseFloat(other.opening_quantity) - parseFloat(other.receipts);
                                    sale_amnt = parseFloat(other.price) * sale_qty;
                                    cash_qty = parseFloat(sale_qty) - parseFloat(other.credit_sales);
                                    cash_amnt = parseFloat(cash_qty) * parseFloat(other.price);
                                }
                            });
                            $.each(data.fuel, function (j, fuel) {
                                if (centre.centre_id == fuel.centre_id && centre.shift_id == fuel.shift_id) {
                                    if (reading_method == 4) {
                                        sale_qty = parseFloat(fuel.sales_manual_meter).toFixed(4);
                                    } else if (reading_method == 3) {
                                        sale_qty = parseFloat(fuel.sales_elec_meter).toFixed(4);
                                    } else if (reading_method == 2) {
                                        sale_qty = parseFloat(fuel.amnt_cash_elec).toFixed(4);
                                    } else if (reading_method == 5) {
                                        sale_qty = parseFloat(Math.max(fuel.sales_elec_meter, fuel.amnt_cash_elec)).toFixed(4);
                                    } else {
                                        sale_qty = parseFloat(Math.max(fuel.sales_manual_meter, fuel.sales_elec_meter, fuel.amnt_cash_elec)).toFixed(4);
                                    }
                                    sale_amnt = fuel.price * sale_qty;
                                }
                            });
                            $.each(data.lube, function (j, lube) {
                                if (centre.centre_id == lube.centre_id && centre.shift_id == lube.shift_id) {
                                    sale_qty = parseFloat(lube.closing_quantity) - parseFloat(lube.opening_quantity) - parseFloat(lube.receipts);
                                    sale_amnt = parseFloat(lube.price) * sale_qty;
                                    cash_qty = parseFloat(sale_qty) - parseFloat(lube.credit_sales);
                                    cash_amnt = parseFloat(cash_qty) * parseFloat(lube.price);
                                }
                            });
                            trHTML += draw_center(centre.centre_name, sale_qty, sale_amnt, cash_qty, cash_amnt);
                        }
                    });
                    trHTML += close_draw_table(item.shift_name, item.operator);
                });
                //console.log(centres);
                $('#salesTable').append(trHTML);
            }
        });
    });

    function open_draw_table(shift_name, operator) {
        var draw_panel = '<div class="panel-heading"><div class="row"><div class="col-md-12">';
        draw_panel += '<span class="text-primary">' + shift_name + '</span><span class="pull-right"> Closed by :  ' + operator + '</span>';
        draw_panel += '<table class="table table-striped mb30 table-bordered"><thead><tr>';
        draw_panel += '<th rowspan="2">Product Category</th><th colspan="2">Total Sales</th>';
        draw_panel += '<th colspan="2">Cash Sales</th><th colspan="2">Credit Sales</th></tr>';
        draw_panel += '<tr><th>Qty</th><th>Ksh</th><th>Qty</th><th>Ksh</th><th>Qty</th><th>Ksh</th></tr>';
        draw_panel += '</thead>';
        return draw_panel;
    }

    function close_draw_table(shift_name, operator) {
        var draw_panel = '</table></div></div></div>';
        return draw_panel;
    }

    function draw_center(centre_name, sale_qty, sale_amnt, cash_qty, cash_amnt) {
        var draw_panel = '<tr><td>' + centre_name + '</td>';
        draw_panel += '<td>' + parseFloat(sale_qty).toFixed(4) + '</td>';
        draw_panel += '<td>' + parseFloat(sale_amnt).toFixed(2) + '</td>';
        draw_panel += '<td>' + parseFloat(cash_qty).toFixed(2) + '</td>';
        draw_panel += '<td>' + parseFloat(cash_amnt).toFixed(2) + '</td>';
        draw_panel += '<td>' + parseFloat(sale_qty - cash_qty).toFixed(2) + '</td>';
        draw_panel += '<td>' + parseFloat(sale_amnt - cash_amnt).toFixed(2) + '</td>';
        draw_panel += '</tr>';
        return draw_panel;
    }
</script>