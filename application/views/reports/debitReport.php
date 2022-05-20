  <link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/custom/js/jquery.timepicker.js"></script>
  <style>
    #ui-datepicker-div {
      width:200px !important;
    }
  </style>
  <div class="pageheader">
      <h2><i class="fa fa-file"></i>Debit Transactions Report</h2>
    </div>
  <div class="contentpanel">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-12">
            <h4 class="panel-title"><b>Debit Transactions Report</b></h4>
            <p>View and Filter Debit Transactions Report</p>
          </div>
          <div class="col-md-12 text-right mt10">
            <form class="form-inline" id="seadrchForm" method="post" action="<?php echo base_url(); ?>Reports/DebitReport">
              <div class="form-group col-md-3">
                  <select class="form-control mb15 selectpicker" name="vendor" data-live-search="true" data-style="btn-white" style="margin-top: 15px; padding: 10px 30px;">
                  <option>Select Customer</option>
                  <?php foreach ($customers as $customer){?>
                    <option value="<?php echo $customer->person_id; ?>"><?php echo $customer->name; ?></option>
                  <?php } ?>
                  </select>
              </div>
              <div class="form-group col-md-3">
                <div class="input-group">
                  <input type="text" class="form-control" id="from" name="date_from" placeholder="From Date">
                  <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
                </div>
              </div>
              <div class="form-group col-md-3">
                <div class="input-group">
                  <input type="text" class="form-control" id="to" name="date_to" placeholder="To Date">
                  <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
                </div>
              </div>
              <div class="form-group col-md-1 text-right">
              <button type="submit" class="btn btn-success"><span class="fa fa-filter"></span> View Report</button>
              </div>
              
            </form>
          </div>
        </div>
      </div>
      <?php if($statements != null) { ?>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table mb30">
            <thead>
              <tr>
                <th>Datetime</th>
                <th>Cashier</th>
                <th>Payment Type</th>
                <th>Amount</th>
                <th>Card #</th>
                <th>Reference Number</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($statements->result() as $statement) { ?>
              <tr>
                <td><?php echo format_datetime($statement->datetime); ?></td>
                <td><?php echo $statement->cashier; ?></td>
                <td><?php echo $statement->payment_type; ?></td>
                <td><?php echo format_cash($statement->total_amount); ?></td>
                <td><?php echo $statement->card_number; ?></td>
                <td><?php echo $statement->reference_number; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php } ?>
    </div><!-- panel -->
  </div><!-- contentpanel -->
  <script type="text/javascript">
    $(document).ready(function() {
        $('#searchForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                vendor: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in a full name!"
                        }
                    }
                },
          date_from: {
            validators: {
              notEmpty: {
              message: "You're required to fill in phone number!"
              }
            } 
          }, 
          date_to: {
            validators: {
              notEmpty: {
              message: "You're required to fill in a Employment Date!"
              }
            } 
          }
         }
        })
      .on('success.form.bv', function(e) {
          // Prevent form submission
          e.preventDefault();
          // Get the form instance
          var $form = $(e.target);

          // Get the BootstrapValidator instance
          var bv = $form.data('bootstrapValidator');

          // Use Ajax to submit form data
          $.ajax({
          url: '<?php echo base_url(); ?>Reports/VendorReport',
          type: 'post',
          data: $('#searchForm :input'),
          dataType: 'html',   
          success: function(html) {
            
            }
        });
      });
    });
  $(function() {
        $( "#from" ).datepicker();
        $( "#to" ).datepicker();
      });
 </script>