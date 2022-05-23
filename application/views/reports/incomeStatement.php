    <div class="pageheader">
      <h2><i class="fa fa-shopping-cart"></i> Income Statement Report</h2>
      <p class="mb20 text-muted">View and Filter Income Statement Report for a Period of Time</p>
    </div>
    <div class="contentpanel">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
            <div class="col-md-12 text-right mt10">
              <form class="form-inline" id="filterForm" method="post">
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
              url: '<?php echo base_url("ShiftReports/incomeStatement") ?>',
              type: 'POST',
              data: { range: range},
              success: function (response) {
                console.log(response);
                $('#salesTable').empty();
                var results = JSON.parse(response);
                var data = results.data;
                //console.log(data);
                var trHTML = '';
                trHTML += open_main_table();
                var sum_purchases = sum_expenses = final_tax_due = sum_withholding = sum_sales = purchases_vat = sales_vat = 0;
                trHTML += open_sales_data("Sales");
                  $.each(data.sales, function (j, sale) {
                    var name = "Taxable Rate (" + sale.name + ")";
                    var value = (sale.value);
                    var rate = (sale.name);
                    var vat = (parseFloat(sale.tax).toFixed(2));
                    sum_sales = sum_amnt(sum_sales, value); 
                    sales_vat = sum_amnt(sales_vat, vat);
                    trHTML += draw_sales_data(name, value, rate, vat);
                  });
                trHTML += draw_total_sales_data("Total Taxable Sales", sum_sales, sales_vat);
//--------------------------------------------------------------
                trHTML += open_sales_data("Expenses");
                  $.each(data.expensess, function (j, expense) {
                    var name = (expense.name);
                    var value = (expense.amount);
                    //var rate = (sale.name);
                   // var vat = (parseFloat(sale.tax).toFixed(2));
                    sum_expenses = sum_amnt(sum_expenses, value); 
                   // sales_vat = sum_amnt(sales_vat, vat);
                    trHTML += draw_sales_data(name, value, 0 , value);
                  });
                trHTML += draw_total_sales_data("Total Expenses", sum_expenses, sum_expenses);
//------------------------------------------------------------------

//--------------------------------------------------------------
                trHTML += open_sales_data("Withholding");
                  $.each(data.withholding, function (j, withhold) {
                    var name = (withhold.shift_id);
                    var value = (withhold.w_tax);
                    //var rate = (sale.name);
                   // var vat = (parseFloat(sale.tax).toFixed(2));
                    sum_withholding = sum_amnt(sum_withholding, value); 
                   // sales_vat = sum_amnt(sales_vat, vat);
                   // trHTML += draw_sales_data(name, value, 0 , value);
                  });
                //trHTML += draw_total_sales_data("Total Expenses", sum_expenses, sum_expenses);
//------------------------------------------------------------------
 

                trHTML += open_sales_data("Purchase");
                  $.each(data.purchases, function (j, reciepts) {
                      var total_amnt_val = sum_amnt(reciepts.net_amount, reciepts.fuel_net_amount);
                      var tax_amount_val = sum_amnt(reciepts.tax_amount, reciepts.fuel_tax_amount);
                      var tax_perc_val = strip_empty(reciepts.tax_perc) + strip_empty(reciepts.fuel_tax_perc);
                      var name = "Taxable Rate (" + tax_perc_val + ")";
                      var value = (parseFloat(total_amnt_val).toFixed(2));
                      var rate = (tax_perc_val);
                      var vat = (parseFloat(tax_amount_val).toFixed(2));
                      sum_purchases = sum_amnt(sum_purchases, total_amnt_val); 
                      purchases_vat = sum_amnt(purchases_vat, tax_amount_val);
                      trHTML += draw_sales_data(name, value, rate, vat);
                  });
                trHTML += draw_total_sales_data("Total Taxable Purchase", sum_purchases, purchases_vat);
                var pxps= sum_amnt(purchases_vat, sum_expenses);
                var plus_adj = sum_amnt(pxps, sum_withholding);

                var tax_due = sales_vat - pxps;
                var final_tax_due = sales_vat - plus_adj;
               //  alert(final_tax_due);
                trHTML += draw_others(parseFloat(tax_due).toFixed(2));
                trHTML += close_main_table();
                $('#salesTable').append(trHTML);
                swal_close();
              }
          });
      });

      function open_main_table() {
          var draw_panel = '<table class="table table-condensed mb0"><thead><tbody>';
        return draw_panel;
      }

      function close_main_table() {
        var draw_panel = '</tbody></table>';
        return draw_panel;
      }

      function open_sales_data(type) {
        var draw_panel = '<tr><td width=""><b>'+type+' Transactions</b></td><td width="" class="text-center"><b>VALUE (EXCL. VAT) KSHS</b></td><td width="" class="text-center"><b>RATE</b></td><td width="" class="text-center"><b>VAT CHARGED KSHS</b></td></tr>';
        return draw_panel;
      }

      function draw_sales_data(name, value, rate, vat) {
        var draw_panel = '<tr><td>'+name+'</td><td class="text-center">'+format_amount_decimals(parseFloat(value).toFixed(2))+'</td><td class="text-center">'+rate+'</td>';
          draw_panel += '<td class="text-center">'+format_amount_decimals(parseFloat(vat).toFixed(2))+'</td></tr>';
        return draw_panel;
      }

      function draw_total_sales_data(name, value, vat) {
        var draw_panel = '<tr><td>'+name+'</td><td class="text-center"><b>'+format_amount_decimals(parseFloat(value).toFixed(2))+'</b></td><td></td><td class="text-center"><b>'+format_amount_decimals(parseFloat(vat).toFixed(2))+'</b></td></tr>';
        return draw_panel;
      }

      function draw_others(tax_due) {
        var draw_panel = '<tr><td>Total Deductable Input</td><td></td><td></td><td class="text-center">0</td>';
            draw_panel += '<tr><td>Tax Due OR Claimable</td><td></td><td></td><td class="text-center">'+format_amount_decimals(tax_due)+'</td>';
            draw_panel += '<tr><td><b>Adjustment</b></td><td></td><td></td><td></td>';
            draw_panel += '<tr><td>Less Credit Balance</td><td></td><td></td><td class="text-center">0</td>';
            draw_panel += '<tr><td>Withholding Tax</td><td></td><td></td><td class="text-center">'+format_amount_decimals(sum_withholding)+'</td>';
            draw_panel += '<tr><td>Net Tax Payable</td><td></td><td></td><td class="text-center">'+format_amount_decimals(tax_due)+'</td>';
            draw_panel += '<tr><td>Add Refund Claims</td><td></td><td></td><td class="text-center">0</td>';
            draw_panel += '<tr><td>Final Tax Payable/Credit Carried Forward</td><td></td><td></td><td class="text-center">'+format_amount_decimals(tax_due)+'</td>';
            draw_panel += '</tr>';
        return draw_panel;
      }
  </script>