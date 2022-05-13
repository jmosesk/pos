  <div class="pageheader">
    	<h2><i class="fa fa-sliders"></i> Sales Register</h2>
	<p class="mb20 text-muted">View and Filter Sales for given date range</p>
  </div>
	<div class="contentpanel">
		<div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-3">
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
                <button type="button" class="btn btn-success" id="generate_report">Filter Data</button>
              </div>
            </form>
          </div>
        </div>
        <div class="row mt10">
          <div id="export_div" style="display:none">
            <div class="col-md-12">
              <form action="<?php echo base_url('Export') ?>" method="POST" target="_blank">
                  <input type="hidden" name="sub_heading" id="sub_heading" value='<?php echo json_encode(array('sub_heading_1' => 'Sales Register', 'sub_heading_2' => '')) ?>'>
                  <input type="hidden" name="data_footer" id="data_footer" value='<?php echo json_encode('') ?>'>
                  <input type="hidden" name="data_val" id="data_val" value=''>
                  <input type="hidden" name="filename" id="filename" value="<?php echo 'Sales Register'; ?>">
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
        $.ajax({
            url: '<?php echo base_url("ShiftReports/salesRegister") ?>',
            type: 'POST',
            data: { range: range},
            success: function (response) {
              console.log(response);
              $('#salesTable').empty();
              var results = JSON.parse(response);
              var data_response = results.data;
              var trHTML = '';
              var new_table = open_main_table();
              var sum_amnt = 0;
              if(Object.keys(data_response).length > 0) {
                $.each(data_response, function (j, lubes) {
                    sum_amnt += parseFloat(lubes.total_amount);
                    trHTML += draw_center(lubes);
                });
              }
              trHTML += close_main_table(sum_amnt);
              new_table += trHTML;
              $('#salesTable').append(new_table);
              //initialize_export(trHTML, reportType);
              swal_close();
            }
        });
    });

    function open_main_table() {
      var draw_panel = '<table class="table table-striped table-condensed mb0"><thead><tr>';
      draw_panel += '<th width="20%">Datetime</th><th width="20%">Payment Type</th><th width="20%">Reference</th><th width="20%" style="text-align:right">Total Amount</th><th width="20%">Cashier</th>';
      draw_panel += '</tr></thead>';
      return draw_panel;
    }

    function close_main_table(total) {
      var draw_panel = '<tr><td colspan="3"><b>Total</b></td><td style="text-align:right"><b>'+format_amount_decimals(parseFloat(total).toFixed(2))+'</b></td><td></td></tr>';
          draw_panel +="</table>";
      return draw_panel;
    }

    function draw_center(fuel) {
      var ref = "";
      if(fuel.card_name)
        ref += fuel.card_name;
      if(fuel.lpo_number)
        ref += fuel.lpo_number;
      if(fuel.ref_number)
        ref += fuel.ref_number;
      var draw_panel = '<tr><td width="20%">'+fuel.shift_name+'</td>';
        draw_panel += '<td width="20%">'+fuel.payment_type+'</td>';
        draw_panel += '<td width="20%">'+ref+'</td>';
        draw_panel += '<td width="20%" style="text-align:right">'+format_amount_decimals(parseFloat(fuel.total_amount).toFixed(2))+'</td>';
        draw_panel += '<td width="20%">'+fuel.user+'</td>';
        draw_panel += '</tr>';
      return draw_panel;
    }
  </script>