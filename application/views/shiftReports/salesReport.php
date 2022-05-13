  <div class="pageheader">
    	<h2><i class="fa fa-sliders"></i> Sales Report</h2>
	<p class="mb20 text-muted">View and Filter Sales Report for given Date Range</p>
  </div>
	<div class="contentpanel">
		<div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-12 text-right mt10">
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
              <div class="form-group col-md-1">
                <button type="button" class="btn btn-success" id="generate_report">Generate Report</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div id="salesTable">
        
      </div>
    </div><!-- panel -->
  </div><!-- contentpanel -->

  <script type="text/javascript">
    $("#generate_report").click(function(e) {
        e.preventDefault();
        var range = $("#reportrange").val();
        //swal_wait("Please wait as we fetch data")
        $.ajax({
            url: '<?php echo base_url("ShiftReports/salesReport") ?>',
            type: 'POST',
            data: { range: range, shift: $("#shift").val() },
            success: function (response) {
              //console.log(response);
              $('#salesTable').empty();
              var results = JSON.parse(response);
              var categories = results.type;
              var data = results.data;
              var trHTML = '';
              trHTML += open_main_table();
              var g_sum_qty = 0; var g_sum_cred = 0; var g_sum_cash = 0;
              $.each(categories, function (i, item) {
                var sum_qty = 0; var sum_cred = 0; var sum_cash = 0;
                trHTML += open_draw_table(item.name);
                $.each(data.lubes, function (j, lubes) {
                  if(item.type_id == lubes.category_id) {
                    sum_qty += parseFloat(lubes.qty);
                    sum_cred += parseFloat(lubes.credit);
                    sum_cash += parseFloat(lubes.cash);
                    trHTML += draw_center(lubes);
                  }
                });
                $.each(data.others, function (j, others) {
                  if(item.type_id == others.category_id) {
                    sum_qty += parseFloat(others.qty);
                    sum_cred += parseFloat(others.credit);
                    sum_cash += parseFloat(others.cash);
                    trHTML += draw_center(others);
                  }
                });
                $.each(data.fuel, function (j, fuel) {
                  if(item.type_id == fuel.category_id) {
                    var credit = 0;
                    $.each(data.credits_fuel, function (j, credits) {
                      if(fuel.item_id == credits.item_id) {
                        credit = credits.total_credits;
                        console.log(credit);
                      }
                    });
                    sum_qty += parseFloat(fuel.sales_qty);
                    sum_cred += parseFloat(credit);
                    sum_cash += parseFloat(parseFloat(fuel.sales_amnt) - parseFloat(credit));
                    trHTML += draw_fuel_center(fuel, credit); 
                  }
                });
                g_sum_qty += parseFloat(sum_qty);
                g_sum_cred += parseFloat(sum_cred);
                g_sum_cash += parseFloat(sum_cash);
                trHTML += total_table(item.name, sum_qty, sum_cred, sum_cash);
                trHTML += close_draw_table();
              });
              trHTML += close_main_table(g_sum_qty, g_sum_cred, g_sum_cash);
              $('#salesTable').append(trHTML);
              //swal_close();
            }
        });
    });

    function total_table(item, qty, credit, cash) {
      var total = parseFloat(credit) + parseFloat(cash);
      var draw_panel = '<tr><td width="45%"><b>Total '+item+'</b></td>';
          draw_panel += '<td width="10%"><b>'+format_amount_decimals(parseFloat(qty).toFixed(0))+'</b></td>';
          draw_panel += '<td width="15%"><b>'+format_amount_decimals(parseFloat(cash).toFixed(2))+'</b></td>';
          draw_panel += '<td width="15%"><b>'+format_amount_decimals(parseFloat(credit).toFixed(2))+'</b></td>';
          draw_panel += '<td width="15%"><b>'+format_amount_decimals(parseFloat(total).toFixed(2))+'</b></td>';
          draw_panel += '</tr>';
      return draw_panel;
    }

    function close_main_table(qty, credit, cash) {
      var total = parseFloat(credit) + parseFloat(cash);
      var draw_panel = '</tbody><tfooter><tr><td width="45%"><b>Grand Total </b></td>';
          draw_panel += '<td width="10%"><b>'+format_amount_decimals(parseFloat(qty).toFixed(0))+'</b></td>';
          draw_panel += '<td width="15%"><b>'+format_amount_decimals(parseFloat(credit).toFixed(2))+'</b></td>';
          draw_panel += '<td width="15%"><b>'+format_amount_decimals(parseFloat(cash).toFixed(2))+'</b></td>';
          draw_panel += '<td width="15%"><b>'+format_amount_decimals(parseFloat(total).toFixed(2))+'</b></td>';
          draw_panel += '</tr></tfooter></table>';
      return draw_panel;
    }

    function open_main_table() {
          draw_panel = '<table class="table table-condensed"><thead><tr><th width="45%">Description</th><th width="10%">Qty Sold</th><th width="15%">Cash Sale</th><th width="15%">Credit Sale</th><th width="15%">Total Sales Qty</th></tr>';
          draw_panel += '</thead><tbody>';
      return draw_panel;
    }

    function open_draw_table(shift_name) {
      var draw_panel = '<div class="panel"><div class="panel-heading padding5"><div class="row"><div class="col-md-12">';
          draw_panel += '<span class="text-primary">' + shift_name + '</span>';
          draw_panel += '</div></div></div><div class="panel-body nopadding"><table class="table table-striped mb0 table-bordered"><thead>';
      return draw_panel;
    }

    function close_draw_table() {
      var draw_panel = '</table></div></div>';
      return draw_panel;
    }

    function draw_fuel_center(fuel, credit) {
      var cash = parseFloat(fuel.sales_amnt) - parseFloat(credit);
      var draw_panel = '<tr><td width="45%">'+fuel.item_name+'</td>';
          draw_panel += '<td width="10%">'+format_amount_decimals(parseFloat(fuel.sales_qty).toFixed(0))+'</td>';
          draw_panel += '<td width="15%">'+format_amount_decimals(parseFloat(cash).toFixed(2))+'</td>';
          draw_panel += '<td width="15%">'+format_amount_decimals(parseFloat(credit).toFixed(2))+'</td>';
          draw_panel += '<td width="15%">'+format_amount_decimals(parseFloat(fuel.sales_amnt).toFixed(2))+'</td>';
          draw_panel += '</tr>';
      return draw_panel;
    }

    function draw_center(fuel) {
      var total = parseFloat(fuel.credit) + parseFloat(fuel.cash);
      var draw_panel = '<tr><td width="45%">'+fuel.item_name+'</td>';
          draw_panel += '<td width="10%">'+format_amount_decimals(fuel.qty)+'</td>';
          draw_panel += '<td width="15%">'+format_amount_decimals(parseFloat(fuel.credit).toFixed(2))+'</td>';
          draw_panel += '<td width="15%">'+format_amount_decimals(parseFloat(fuel.cash).toFixed(2))+'</td>';
          draw_panel += '<td width="15%">'+format_amount_decimals(parseFloat(total).toFixed(2))+'</td>';
          draw_panel += '</tr>';
      return draw_panel;
    }
  </script>