  <div class="pageheader">
    	<h2><i class="fa fa-sliders"></i> Cash Summary Report</h2>
	<p class="mb20 text-muted">View and Filter Cash Summary Report for given date range</p>
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
                  <input type="hidden" name="sub_heading" id="sub_heading" value='<?php echo json_encode(array('sub_heading_1' => 'Cash Summary Report', 'sub_heading_2' => '')) ?>'>
                  <input type="hidden" name="data_footer" id="data_footer" value='<?php echo json_encode('') ?>'>
                  <input type="hidden" name="data_val" id="data_val" value=''>
                  <input type="hidden" name="tbl_header" id="tbl_header" value='<?php echo array() ?>'>
                  <input type="hidden" name="filename" id="filename" value="<?php echo 'Cash Summary Report'; ?>">
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
            url: '<?php echo base_url("ShiftReports/cashSummaryReport") ?>',
            type: 'POST',
            data: { range: range, shift: $("#shift").val() },
            success: function (response) {
              console.log(response);
              $('#salesTable').empty();
              var results = JSON.parse(response);
              var trHTML = '';          
              if(Object.keys(results).length > 0) {
                $.each(results.shifts, function (j, shift) {
                    trHTML += open_main_table();
                    trHTML += open_shift_row(shift.shift_name);
                    var white_amnt = non_cash_white = lubricants = non_cash_lubricant = lpg = non_cash_lpg = others = non_cash_others = 0;
                    var customer_payment_amnt = 0;
                    if(shift.shift_id in results.fuel_sales) {
                        white_amnt = results.fuel_sales[shift.shift_id].fuel_amnt;
                    }
                    if(shift.shift_id in results.credit_sales) {
                        non_cash_white = results.credit_sales[shift.shift_id].credit_sale_fuel;
                        non_cash_lubricant = results.credit_sales[shift.shift_id].credit_sale_lube;
                        non_cash_lpg = results.credit_sales[shift.shift_id].credit_sale_lpg;
                        non_cash_others = results.credit_sales[shift.shift_id].credit_sale_others;

                    }
                    if(shift.shift_id in results.lube_sales) {
                        lubricants = results.lube_sales[shift.shift_id].lubes_amnt;
                    }
                    if(shift.shift_id in results.customer_payment) {
                        console.log(shift.shift_id);
                        console.log(results.customer_payment[shift.shift_id].amnt);
                        customer_payment_amnt = results.customer_payment[shift.shift_id].amnt;
                    }
                    if(shift.shift_id in results.other_sales) {
                        others = results.other_sales[shift.shift_id].others_amnt;
                    }
                    /*var credit_id = debit_id = null; var original_amnt = 0;
                    var bbf = credit_val = debit_val = bbf_credit = bbf_debit = 0;
                    if(supplier.supplier_id in results.credit) {
                        credit_id = results.credit[supplier.supplier_id].transaction_id;
                        credit_val = results.credit[supplier.supplier_id].credit;
                        bbf_credit = results.credit[supplier.supplier_id].balance - results.credit[supplier.supplier_id].amnt;
                        original_amnt = results.credit[supplier.supplier_id].balance;
                    } 
                    if(supplier.supplier_id in results.debit) {
                        debit_id = results.debit[supplier.supplier_id].transaction_id;
                        debit_val = results.debit[supplier.supplier_id].debit;
                        bbf_debit = results.debit[supplier.supplier_id].balance - results.debit[supplier.supplier_id].amnt;
                        original_amnt = results.debit[supplier.supplier_id].balance;
                    }
                    if(credit_id != null && debit_id != null) {
                      if(credit_id < debit_id) {
                        bbf = bbf_credit;
                      } else {
                        bbf = bbf_debit;
                      }
                    }*/
                   var supplier_obj = {};  supplier_obj.bbf = shift.bbf_amt; supplier_obj.white = white_amnt;
                    supplier_obj.non_cashwhite = non_cash_white; supplier_obj.non_cash_lubricant = non_cash_lubricant; supplier_obj.non_cash_lpg = non_cash_lpg; supplier_obj.non_cash_others = non_cash_others;
                      supplier_obj.customer_payment = customer_payment_amnt;
                   
                    trHTML += draw_center(supplier_obj);
                    trHTML += close_main_table();
                });
              }
              //initialize_export(trHTML);
              $('#salesTable').append(trHTML);
              swal_close();
            }
        });
    });

    function initialize_export(data) {
        $('#export_div').show();
        var export_header = '<table cellspacing="0" cellpadding="3" border="1" width="100%">';
        export_header += '<tr nobr="true" style="color:white; background-color:#36304a; font-size:6px">';
        export_header += '<th style="width:25%">Supplier Name</th>';
        export_header += '<th style="width:15%; text-align:right">BBF</th>';
        export_header += '<th style="width:15%; text-align:right">Current Supplies</th>';
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
        sub_heading['sub_heading_1'] = 'Cash Summary Report for a Period of ' + date_range;
        sub_heading['sub_heading_2'] = '';
        export_header += data;
        $('#data_val').val(JSON.stringify(export_header));
        $('#sub_heading').val(JSON.stringify(sub_heading));
    }

    function open_main_table() {
          draw_panel = '<table class="table table-condensed mb10"><tbody>';
      return draw_panel;
    }

    function close_main_table() {
      var draw_panel = '</tbody></table>';
      return draw_panel;
    }

    function draw_center(fuel) {
      var draw_panel = '<tr><td width="60%" colspan="2">BBF</td><td width="40%">'+format_amount_decimals(parseFloat(fuel.bbf).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="60%" colspan="2">White Products</td><td width="40%">'+format_amount_decimals(parseFloat(fuel.white).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="2%"><td width="58%">Non Cash</td><td width="40%">'+format_amount_decimals(parseFloat(fuel.non_cashwhite).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="60%" colspan="2">Lubricants</td><td width="40%">'+format_amount_decimals(parseFloat(lubricants).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="2%"><td width="58%">Non Cash</td><td width="40%">'+format_amount_decimals(parseFloat(fuel.non_cash_lubricant).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="60%" colspan="2">***Job Cards</td><td width="40%">'+format_amount_decimals(parseFloat(200).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="2%"><td width="58%">Non Cash</td><td width="40%">'+format_amount_decimals(parseFloat(fuel.non_cash_lpg).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="60%" colspan="2">***Other Products</td><td width="40%">'+format_amount_decimals(parseFloat(others).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="2%"><td width="58%">Non Cash</td><td width="40%">'+format_amount_decimals(parseFloat(fuel.non_cash_others).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="60%" colspan="2">Customer Payments</td><td width="40%">'+format_amount_decimals(parseFloat(fuel.customer_payment).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="60%" colspan="2">***Total Receipts</td><td width="40%">'+format_amount_decimals(parseFloat(200).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="60%" colspan="2">Expenses (FC)</td><td width="40%">'+format_amount_decimals(parseFloat(200).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="60%" colspan="2"><b>Expected Cash</b></td><td width="40%">'+format_amount_decimals(parseFloat(200).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="60%" colspan="2">Shortage/Excess</td><td width="40%">'+format_amount_decimals(parseFloat(200).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="60%" colspan="2">Actual Cash</td><td width="40%">'+format_amount_decimals(parseFloat(200).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="60%" colspan="2"><b>Total Cash</b></td><td width="40%">'+format_amount_decimals(parseFloat(200).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="60%" colspan="2">Payments</td><td width="40%">'+format_amount_decimals(parseFloat(200).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="60%" colspan="2">Banking</td><td width="40%">'+format_amount_decimals(parseFloat(200).toFixed(2))+'</td></tr>';
          draw_panel += '<tr><td width="60%" colspan="2"><b>BCF</b></td><td width="40%">'+format_amount_decimals(parseFloat(200).toFixed(2))+'</td></tr>';
      return draw_panel;
    }

    function open_shift_row(fuel) {
      var draw_panel = '<tr><td colspan="3"><b>'+fuel+'</b></td></tr>';
      return draw_panel;
    }
  </script>