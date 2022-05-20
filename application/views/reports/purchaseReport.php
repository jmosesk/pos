    <div class="pageheader">
      <h2><i class="fa fa-shopping-cart"></i> Purchase Report</h2>
      <p class="mb20 text-muted">View and Filter Purchases Per Invoice, Reference and Tank</p>
    </div>

    <div class="contentpanel">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
            <div class="col-md-12 text-right mt10">
              <form class="form-inline" id="filterForm" method="post">
                <div class="row">
                  <div class="form-group col-md-3">
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
                  <div class="form-group col-md-5">
                    <label class="control-label col-md-4 mt10">Invoice Number&nbsp; :  </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control width100p" id="invoice" placeholder="Enter Invoice Number"/>
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="control-label col-md-4 mt10">Delivery #&nbsp; :  </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control width100p" id="ref" placeholder="Enter Reference Number"/>
                    </div>
                  </div>
                </div>
                <div class="row mt10">
                  <div class="form-group col-md-3">
                  </div>
                  <div class="form-group col-md-5">
                    <label class="control-label col-md-4 mt10">Date Range&nbsp; :  </label>
                    <div class="col-sm-8">
                      <div class='input-group width100p'>
                        <input type="text" class="form-control" name="dateTo" id="reportrange" placeholder="From Date" readonly/>
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="col-md-4"></label>
                    <div class="col-sm-8">
                      <button type="button" class="btn btn-success btn-block" id="generate_report">Generate Report</button>
                    </div>
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
          e.preventDefault();
          var range = $("#reportrange").val();
          swal_wait("Please wait as we fetch data")
          $.ajax({
              url: '<?php echo base_url("ShiftReports/purchaseReport") ?>',
              type: 'POST',
              data: { range: range, invoice: $("#invoice").val(), ref: $("#ref").val(), shift: $("#shift").val()},
              success: function (response) {
                //console.log(response);
                $('#salesTable').empty();
                var results = JSON.parse(response);
                var shifts = results.shifts;
                var data = results.data;
                //console.log(data);
                var trHTML = '';
                trHTML += open_main_table();
                var shift_data = new Array();
                var receipts_data = new Array();
                var cum_sale = 0; cum_gain = 0;
                var g_purchase = g_sales = g_cum_sales = g_cum_gain = g_cum_perc_gain = 0;
                //$.each(shifts, function (i, shift) {
                  //trHTML += open_shift(shift.shift_name);
                  var sum_total = new Array();
                  var total_qty = total_amnt = total_vat = total_gross = 0;
                  $.each(data, function (j, reciepts) {
                      var qty = sum_amnt(reciepts.recieving_quantity, reciepts.recieving_quantity_fuel);
                      var vat = sum_amnt(reciepts.tax, reciepts.tax_fuel);
                      var total = sum_amnt(reciepts.total, reciepts.total_fuel);
                      var gross = parseFloat(parseFloat(vat) + parseFloat(total)).toFixed(2);
                      receipts_data['date'] = reciepts.date;
                      receipts_data['item'] = strip_empty(reciepts.fuel_name) + strip_empty(reciepts.item_name);
                      receipts_data['price'] = format_amount_decimals(sum_amnt(parseFloat(reciepts.price), parseFloat(reciepts.price_fuel)));
                      receipts_data['qty'] = format_amount_decimals(qty);
                      receipts_data['tax'] = format_amount_decimals(vat);
                      receipts_data['total'] = format_amount_decimals(total);
                      receipts_data['gross'] = format_amount_decimals(gross);
                      total_qty = sum_amnt(total_qty, qty); 
                      total_amnt = sum_amnt(total_amnt, total); 
                      total_vat = sum_amnt(total_vat, vat);
                      total_gross = sum_amnt(total_gross, gross);
                      trHTML += draw_receipt(receipts_data);
                  });
                  sum_total['qty'] = format_amount_decimals(total_qty);
                  sum_total['tax'] = format_amount_decimals(total_vat);
                  sum_total['net'] = format_amount_decimals(total_amnt);
                  sum_total['gross'] = format_amount_decimals(parseFloat(total_gross).toFixed(2));
                  trHTML += close_shift(sum_total);
                //});
                trHTML += close_main_table();
                $('#salesTable').append(trHTML);
                swal_close();
              }
          });
      });

      function open_main_table() {
          var draw_panel = '<table class="table table-condensed mb0"><thead>';
            draw_panel += '<tr><th width="">Shift</th><th width="">Item</th><th width="">Qty Purchased</th><th width="">Unit Price</th><th width="">Net Amount</th><th width="">Vat</th><th width="">Gross Amount</th></tr>';
            draw_panel += '</thead><tbody>';
        return draw_panel;
      }

      function close_main_table(total_data) {
        var draw_panel = '</tbody></table>';
        return draw_panel;
      }

      function draw_receipt(shift) {
        var draw_panel = '<tr><td>'+shift.date+'</td><td>'+shift.item+'</td><td>'+shift.qty+'</td><td>'+shift.price+'</td>';
            draw_panel += '<td>'+shift.total+'</td><td>'+shift.tax+'</td><td>'+shift.gross+'</td>';
            draw_panel += '</tr>';
        return draw_panel;
      }

      function open_shift(shift) {
        var draw_panel = '<tr><th colspan="5">'+shift+'</th></tr>';
        return draw_panel;
      }

      function close_shift(shift) {
        var draw_panel = '<tr><td colspan="2"><b>Total</b></td><td><b>'+shift.qty+'</b></td><td></td><td><b>'+shift.net+'</b></td>';
            draw_panel += '<td><b>'+shift.tax+'</b></td><td><b>'+shift.gross+'</b></td>';
            draw_panel += '</tr>';
        return draw_panel;
      }
  </script>