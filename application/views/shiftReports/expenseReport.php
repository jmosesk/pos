  <div class="pageheader">
    	<h2><i class="fa fa-sliders"></i> Expense Report</h2>
	<p class="mb20 text-muted">View and Filter Expenses for given date range</p>
  </div>
	<div class="contentpanel">
		<div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-3 mt10 ">
              <label class="control-label col-md-12">
                <span style="color:black;"> Summary Report <input type="radio" name="reportType" checked="checked" value="summary"/></span>
                <span style="color:black; margin-left:10px;">&nbsp;&nbsp; Detailed Report <input type="radio" name="reportType" value="detailed"/></span>
              </label>
          </div>
          <div class="text-right col-sm-9">
            <form class="form-inline" id="filterForm" method="post">
              <div class="col-sm-10">
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
                  <input type="hidden" name="sub_heading" id="sub_heading" value='<?php echo json_encode(array('sub_heading_1' => 'Expense Summary Report', 'sub_heading_2' => '')) ?>'>
                  <input type="hidden" name="data_footer" id="data_footer" value='<?php echo json_encode('') ?>'>
                  <input type="hidden" name="data_val" id="data_val" value=''>
                  <input type="hidden" name="filename" id="filename" value="<?php echo 'Sales Detailed Report'; ?>">
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
    $("#generate_report").click(function(e) {
        e.preventDefault();
        $('#export_div').hide();
        var range = $("#reportrange").val();
        swal_wait("Please wait as we fetch data");
          var reportType = $("input[type='radio'][name='reportType']:checked").val();
        $.ajax({
            url: '<?php echo base_url("ShiftReports/expenseReport") ?>',
            type: 'POST',
            data: { range: range, reportType: reportType},
            success: function (response) {
              //console.log(response);
              $('#salesTable').empty();
              var results = JSON.parse(response);
              var data_response = results.data;
              var trHTML = '';
              var new_table = open_main_table(reportType);
              var g_sum_amnt = sum_amnt = 0;
              if(Object.keys(data_response).length > 0) {
                $.each(data_response, function (j, lubes) {
                    sum_amnt += parseFloat(lubes.amount);
                    trHTML += draw_center(lubes, reportType);
                });
              }
              g_sum_amnt += parseFloat(sum_amnt);
              trHTML += close_main_table(g_sum_amnt, reportType);
              new_table += trHTML;
              $('#salesTable').append(new_table);
              initialize_export(trHTML, reportType);
              swal_close();
            }
        });
    });

    $('input[type=radio][name=reportType]').change(function() {
      $('#export_div').hide();
      $('#salesTable').empty();
    });

    function initialize_export(data, rType) {
        $('#export_div').show();
        var export_header = '<table cellspacing="0" cellpadding="4" border="0.2" width="100%">';
        export_header += '<tr nobr="true" style="color:white; background-color:#36304a; font-size:6px">';
        if(rType == "summary") {
          export_header += '<th width="60%">Item</th><th width="40%" style="text-align:right">Amount</th>';
        } else {
          export_header += '<th width="10%">Datetime</th><th width="40%">Item</th><th width="15%" style="text-align:right">Amount</th><th width="25%">Reason</th><th width="10%">Type</th>';
        }
        export_header += '</tr>';     
        var sub_heading = {};
        var date_range = $("#reportrange").val();
        var date_format = $("#reportrange").val().split("-");
        if (date_format) {
            from_date = date_format[0].split("/");
            to_date = date_format[1].split("/");
            date_range = from_date[1] + "-" + from_date[0] + "-" + from_date[2] + " to " + to_date[1] + "-" + to_date[0] + "-" + to_date[2];
        }
        reportType = rType[0].toUpperCase() + rType.slice(1);
        sub_heading['sub_heading_1'] = 'Expense ' + reportType + ' Report for a Period of ' + date_range;
        sub_heading['sub_heading_2'] = '';
        export_header += data;
        $('#filename').val('Expense '  + reportType + ' Statement ' + date_range);
        $('#data_val').val(JSON.stringify(export_header));
        $('#sub_heading').val(JSON.stringify(sub_heading));
    }

    function open_main_table(reportType) {
      draw_panel = '<table class="table table-striped table-condensed mb0"><thead><tr>';
      if(reportType == "summary") {
        draw_panel += '<th width="60%">Item</th><th width="40%" style="text-align:right">Amount</th>';
      } else {
        draw_panel += '<th width="10%">Datetime</th><th width="40%">Item</th><th width="15%" style="text-align:right">Amount</th><th width="25%">Reason</th><th width="10%">Type</th>';
      }
      draw_panel += '</tr></thead>';
      return draw_panel;
    }

    function close_main_table(total, reportType) {
      if(reportType == "summary") {
        draw_panel = '<tr><td width="60%"><b>Total</b></td><td width="40%" style="text-align:right" style="text-align:right"><b>'+format_amount_decimals(parseFloat(total).toFixed(2))+'</b></td></tr>';
      } else {
        draw_panel = '<tr><td colspan="2"><b>Total</b></td><td colspan="3" style="text-align:right"><b>'+format_amount_decimals(parseFloat(total).toFixed(2))+'</b></td></tr>';
      }
          draw_panel +="</table>";
      return draw_panel;
    }

    function draw_center(fuel, reportType) {
      if(reportType == "summary") {
        var draw_panel = '<tr><td width="60%">'+fuel.name+'</td>';
          draw_panel += '<td width="40%" style="text-align:right">'+format_amount_decimals(parseFloat(fuel.amount).toFixed(2))+'</td>';
          draw_panel += '</tr>';
      } else {
        var draw_panel = '<tr><td width="10%">'+fuel.date+'</td>';
          draw_panel += '<td width="40%">'+fuel.name+'</td>';
          draw_panel += '<td width="15%" style="text-align:right">'+format_amount_decimals(parseFloat(fuel.amount).toFixed(2))+'</td>';
          draw_panel += '<td width="25%">'+fuel.reason+'</td>';
          draw_panel += '<td width="10%">'+fuel.reason+'</td>';
          draw_panel += '</tr>';
      }
      return draw_panel;
    }
  </script>