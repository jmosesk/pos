    <div class="pageheader">
      <h3><i class="fa fa-user-circle-o"></i><span id="heading">Summary</span> Employee Report</h3>
      <p class="mb20 text-muted">View and Filter Employee Reports</p>
    </div>
    <div class="contentpanel">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
              <div id="myRadioGroup">
                <div class="form-group col-md-12">
                  <label class="control-label col-md-12 bold">
                    <span style="font-weight:bold; font-size:15px; font-family:Verdana; color:black;"> Shift Summary Report <input type="radio" name="reportType" checked="checked" value="summary"/></span>
                    <span style="font-weight:bold; font-size:15px; font-family:Verdana; color:black; margin-left:10px;">&nbsp;&nbsp; Employee Detailed Report <input type="radio" name="reportType" value="detailed"/></span>
                    <span style="font-weight:bold; font-size:15px; font-family:Verdana; color:black; margin-left:10px;">&nbsp;&nbsp; Cummulative Employee Report <input type="radio" name="reportType" value="cummulative"/></span>
                  </label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-right mt10">
              <form class="form-inline" id="filterForm" method="post">
                <div class="row">
                  <div class="form-group col-md-4" id="summary">
                    <label class="control-label col-md-5" style="margin-top: 5px;">Select a Shift&nbsp; :  </label>
                    <div class="col-sm-7">
                      <select class="form-control mb15 selectpicker" name="shift" id="shift" data-live-search="true" data-style="btn-white" style="padding: 10px 30px;">
                      <option value="">All Shifts</option>
                        <?php foreach (list_shifts() as $shift) { ?>
                          <option value="<?php echo $shift['shift_name_id']; ?>"><?php echo $shift['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-md-4" id="detailed" style="display:none">
                    <label class="control-label col-md-5" style="margin-top: 5px;">Select Employee&nbsp; :  </label>
                    <div class="col-sm-7">
                      <select class="form-control mb15 selectpicker" name="employee" id="employee" data-live-search="true" data-style="btn-white" style="padding: 10px 30px;">
                      <option value="">All Employees</option>
                        <?php foreach ($employees as $employee) { ?>
                          <option value="<?php echo $employee['user_id']; ?>"><?php echo $employee['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4" id="cummulative" style="display:none"></div>
                  <div class="form-group col-md-5">
                    <label class="control-label col-md-4 mt10">Date Range&nbsp; :  </label>
                    <div class="col-sm-8">
                      <input type="hidden" class="form-control" id="type" value="summary" readonly/>
                      <div class='input-group width100p'>
                        <input type="text" class="form-control" name="dateTo" id="reportrange" placeholder="From Date" readonly/>
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-2">
                      <button type="button" class="btn btn-success btn-block" id="generate_report">Generate Report</button>
                  </div>
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
          var range = $("#reportrange").val();
          var reportType = $("input[type='radio'][name='reportType']:checked").val();
          var data = {range: range, type: $('#type').val(), employee: $("#employee").val(), reportType: reportType};
          if(reportType == "cummulative") {
            data = {range: range, reportType: reportType};
          } else if(reportType == "summary") {
            data = {range: range, shift: $("#shift").val(), type: $('#type').val(), reportType: reportType};
          }
          e.preventDefault();
          swal_wait("Please wait as we fetch data")
          $.ajax({
              url: '<?php echo base_url("ShiftReports/employeeReport") ?>',
              type: 'POST',
              data: data,
              success: function (response) {
                console.log(response);
                $('#salesTable').empty();
                var results = JSON.parse(response);
                if(reportType == "cummulative") {
                  _build_cummulative_form(results);
                } else {
                  _build_form(results);
                }
                swal_close();                
              }
          });
      });

      $("input[name='reportType']").change(function() {
          var val = $(this).val();
          $('#heading').html(val.charAt(0).toUpperCase() + val.slice(1));
          $("#type").val(val);
          if (val == "detailed") {
            $("#cummulative").hide();
            $("#summary").hide();
            $("#detailed").show();
          } else if(val == "summary") {
            $("#cummulative").hide();
            $("#detailed").hide();
            $("#summary").show();
          } else {
            $("#detailed").hide();
            $("#summary").hide();
            $("#cummulative").show();
          }
      });

      function _build_cummulative_form(results) {
        var shifts = results.shifts;
        var data = results.data;
        var trHTML = '';
        trHTML += open_cummulative_table();
        var receipts_data = new Array();
        var total_data = new Array();
          var sum_total = new Array();
          var total_credit_amnt = 0;
          var total_debit_amnt = 0;
          var total_balance_amnt = 0;
          $.each(data, function (j, reciepts) {
            var balance = parseFloat(reciepts.credit_amount) + parseFloat(reciepts.debit_amount);
              receipts_data['amount'] = format_amount_decimals(parseFloat(reciepts.credit_amount));
              receipts_data['date'] = reciepts.user;
              receipts_data['employee'] = format_amount_decimals(parseFloat(reciepts.debit_amount));
              receipts_data['balance'] = format_amount_decimals(balance);
              total_credit_amnt = sum_amnt(total_credit_amnt, reciepts.credit_amount); 
              total_debit_amnt = sum_amnt(total_debit_amnt, reciepts.debit_amount);
              total_balance_amnt = sum_amnt(total_balance_amnt, balance);  
              trHTML += draw_receipt(receipts_data);
          });
          sum_total['total_debit'] = format_amount_decimals(total_debit_amnt);
          sum_total['total_credit'] = format_amount_decimals(total_credit_amnt);
          sum_total['total_balance'] = format_amount_decimals(total_balance_amnt);
          trHTML += close_cummulative(sum_total);
        trHTML += close_main_table(total_data);
        $('#salesTable').append(trHTML);
      }

      function _build_form(results) {
        var shifts = results.shifts;
        var data = results.data;
        var trHTML = '';
        trHTML += open_main_table();
        var receipts_data = new Array();
        var total_data = new Array();
          var sum_total = new Array();
          var total_amnt = 0;
          $.each(data, function (j, reciepts) {
              receipts_data['date'] = reciepts.date;
              receipts_data['employee'] = reciepts.user;
              receipts_data['amount'] = format_amount_decimals(parseFloat(reciepts.amount));
              total_amnt = sum_amnt(total_amnt, reciepts.amount); 
              trHTML += draw_receipt(receipts_data);
          });
          sum_total['total'] = format_amount_decimals(total_amnt);
          trHTML += close_shift(sum_total);
        trHTML += close_main_table(total_data);
        $('#salesTable').append(trHTML);
      }

      function open_main_table() {
          var draw_panel = '<table class="table table-condensed mb0"><thead>';
            draw_panel += '<tr><th width="">Shift</th><th width="">Employee</th><th width="">Amount</th></tr>';
            draw_panel += '</thead><tbody>';
        return draw_panel;
      }

      function open_cummulative_table() {
          var draw_panel = '<table class="table table-condensed mb0"><thead>';
            draw_panel += '<tr><th width="">Employee</th><th width="">Debit</th><th width="">Credit</th><th width="">Balance</th></tr>';
            draw_panel += '</thead><tbody>';
        return draw_panel;
      }

      function close_main_table(total_data) {
        var draw_panel = '</tbody></table>';
        return draw_panel;
      }

      function draw_receipt(shift) {
        var draw_panel = '<tr><td>'+shift.date+'</td><td>'+shift.employee+'</td><td>'+shift.amount+'</td>';
        if (typeof shift.balance !== 'undefined')
            draw_panel += '<td>' + shift.balance + '</td>';
          draw_panel += '</tr>';
        return draw_panel;
      }

      function open_shift(shift) {
        var draw_panel = '<tr><th colspan="5">'+shift+'</th></tr>';
        return draw_panel;
      }

      function close_shift(shift) {
        var draw_panel = '<tr><td colspan="2"><b>Total</b></td><td><b>'+shift.total+'</b></td>';
            draw_panel += '</tr>';
        return draw_panel;
      }

      function close_cummulative(shift) {
        var draw_panel = '<tr><td><b>Total</b></td><td><b>'+shift.total_debit+'</b></td>';
            draw_panel += '<td><b>'+shift.total_credit+'</b></td><td><b>'+shift.total_balance+'</b></td></tr>';
        return draw_panel;
      }
  </script>