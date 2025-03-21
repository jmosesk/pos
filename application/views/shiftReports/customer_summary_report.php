  <div class="pageheader">
    	<h2><i class="fa fa-sliders"></i> Customer Summary Report</h2>
	<p class="mb20 text-muted">View and Filter Customer Summary Report for given date range</p>
  </div>
	<div class="contentpanel">
		<div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
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
              <div class="col-md-1">
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
                  <input type="hidden" name="tbl_header" id="tbl_header" value='<?php echo array() ?>'>
                  <input type="hidden" name="filename" id="filename" value="Customer Summary Statement">
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
        swal_wait("Please wait as we fetch data")
        $.ajax({
            url: '<?php echo base_url("ShiftReports/customerSummaryReport") ?>',
            type: 'POST',
            data: { range: range, shift: $("#shift").val() },
            success: function (response) {
              //console.log(response);
              $('#salesTable').empty();
              var results = JSON.parse(response);
              var trHTML = '';
              var total_bbf = total_debit = total_credit = 0;
              var bbf = credit = debit = sum_balance = sum_total = 0;
              var new_table = open_main_table();
              var totals = {};            
              if(Object.keys(results).length > 0) {
                $.each(results, function (j, fuel) {
                  var amnt_bbf = fuel.amount;
                  if(fuel.debit_type == 1)
                      amnt_bbf = -(fuel.amount);
                  debit = parseFloat(-(fuel.debit));
                  bbf = parseFloat(fuel.bbf) - parseFloat(amnt_bbf);
                  balance = parseFloat(bbf) - parseFloat(fuel.debit) + parseFloat(fuel.credit);
                  sum_balance += parseFloat(balance);
                  total = parseFloat(debit) + parseFloat(bbf);
                  sum_total += parseFloat(total);
                  total_bbf += parseFloat(bbf); 
                  total_credit += parseFloat(fuel.credit); 
                  total_debit += parseFloat(debit);
                  trHTML += draw_center(fuel);
                });
              }
              totals.bbf = total_bbf; totals.credit = total_credit; totals.debit = total_debit; 
              totals.total = sum_total; totals.balance = sum_balance;
              trHTML += draw_totals(totals);
              trHTML += close_main_table();
              new_table += trHTML;
              initialize_export(trHTML);
              $('#salesTable').append(new_table);
              swal_close();
            }
        });
    });

    function initialize_export(data) {
        $('#export_div').show();
        var export_header = '<table cellspacing="0" cellpadding="3" border="1" width="100%">';
        export_header += '<tr nobr="true" style="color:white; background-color:#36304a; font-size:6px">';
        export_header += '<th style="width:25%">Customer Name</th>';
        export_header += '<th style="width:15%; text-align:right">BBF</th>';
        export_header += '<th style="width:15%; text-align:right">Debt Incurred</th>';
        export_header += '<th style="width:15%; text-align:right">Total</th>';
        export_header += '<th style="width:15%; text-align:right">Paid</th>';
        export_header += '<th style="width:15%; text-align:right">Balance</th>';
        export_header += '</tr><tbody>';             
        var sub_heading = {};
        var date_range = $("#reportrange").val();
        var date_format = $("#reportrange").val().split("-");
        if (date_format) {
            from_date = date_format[0].split("/");
            to_date = date_format[1].split("/");
            date_range = from_date[1] + "-" + from_date[0] + "-" + from_date[2] + " to " + to_date[1] + "-" + to_date[0] + "-" + to_date[2];
        }
        sub_heading['sub_heading_1'] = 'Customer Summary Report for a Period of ' + date_range;
        sub_heading['sub_heading_2'] = '';
        $('#filename').val('Customer Summary ' + date_range);
        export_header += data;
        $('#data_val').val(JSON.stringify(export_header));
        $('#sub_heading').val(JSON.stringify(sub_heading));
    }

    function open_main_table() {
          draw_panel = '<table class="table table-condensed mb0"><thead><tr><th width="25%">Customer Name</th><th width="15%" style="text-align:right">BBF</th><th width="15%" style="text-align:right">Debt Incurred</th><th width="15%" style="text-align:right">Total</th><th width="15%" style="text-align:right">Paid</th><th width="15%" style="text-align:right">Balance</th></tr>';
          draw_panel += '</thead><tbody>';
      return draw_panel;
    }

    function close_main_table() {
      var draw_panel = '</tbody></table>';
      return draw_panel;
    }

    function draw_center(fuel) {
      var amnt_bbf = fuel.amount;
      if(fuel.debit_type == 1)
          amnt_bbf = -(fuel.amount);
      var debit = -(fuel.debit);
      var bbf = parseFloat(fuel.bbf) - parseFloat(amnt_bbf);
      var balance = parseFloat(bbf) - parseFloat(fuel.debit) + parseFloat(fuel.credit);
      var total = parseFloat(debit) + parseFloat(bbf);
      var draw_panel = '<tr><td width="25%">'+fuel.company_name+'</td>';
          draw_panel += '<td width="15%" align="right">'+format_amount_decimals(parseFloat(bbf).toFixed(2))+'</td>';
          draw_panel += '<td width="15%" align="right">'+format_amount_decimals(parseFloat(debit).toFixed(2))+'</td>';
          draw_panel += '<td width="15%" align="right">'+format_amount_decimals(parseFloat(total).toFixed(2))+'</td>';
          draw_panel += '<td width="15%" align="right">'+format_amount_decimals(parseFloat(fuel.credit).toFixed(2))+'</td>';
          draw_panel += '<td width="15%" align="right">'+format_amount_decimals(parseFloat(balance).toFixed(2))+'</td>';
          draw_panel += '</tr>';
      return draw_panel;
    }

    function draw_totals(totals) {
      var draw_panel = '<tr><td width="25%"><b>Total</b></td>';
          draw_panel += '<td width="15%" align="right"><b>'+format_amount_decimals(parseFloat(totals.bbf).toFixed(2))+'</b></td>';
          draw_panel += '<td width="15%" align="right"><b>'+format_amount_decimals(parseFloat(totals.debit).toFixed(2))+'</b></td>';
          draw_panel += '<td width="15%" align="right"><b>'+format_amount_decimals(parseFloat(totals.total).toFixed(2))+'</b></td>';
          draw_panel += '<td width="15%" align="right"><b>'+format_amount_decimals((totals.credit).toFixed(2))+'</b></td>';
          draw_panel += '<td width="15%" align="right"><b>'+format_amount_decimals(parseFloat(totals.balance).toFixed(2))+'</b></td>';
          draw_panel += '</tr>';
      return draw_panel;
    }
  </script>