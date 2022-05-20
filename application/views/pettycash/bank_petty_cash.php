
<style type="text/css">
.form-control-feedback {
    top: 5px;
    right: 5px;
  }
  .list-group {
    max-height: 300px;
    margin-bottom: 10px;
    overflow:scroll;
    -webkit-overflow-scrolling: touch;
  }
</style>
<div class="pageheader">
    <h2><i class="fa fa-edit"></i> Create Bank Expense</h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Fms</a></li>
            <li class="active">Bank Expense Items</li>
        </ol>
    </div>
</div>
<div class="contentpanel mt20">
    <form id="transaction-form" class="" method="POST">
      <div class="box-body">
        <div class="row mb10">
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-sm-4 control-label" for="kode">Control Amount</label>
              <div class="col-sm-8">
                <input type="text" id="control_amount" name="control_amount" placeholder="Enter Control Amount" class="form-control"/>
                <input type="hidden" name="bank_expense" value="1" class="form-control"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-sm-4 control-label" for="kode">Reason for Payment</label>
              <div class="col-sm-8">
                <input type="text" name="reason" placeholder="Enter Reason for Payment" class="form-control"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb10">
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-sm-4 control-label">Payment Source</label>
              <div class="col-sm-8">
                <select class="form-control selectpicker" name="banked_cash" id="banked_cash" data-live-search="true" data-style="btn-white">
                    <option value="">Select Payment Source</option>
                    <option value="1">Unbanked Cash</option>
                    <option value="2">Banked Cash</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div id="row_unbanked" class="mb10">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="category_id">Vendor Name</label>
                  <div class="col-sm-8">
                    <input type="text" name="vendor_name_unbanked" placeholder="Enter Vendor Name" class="form-control"/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="date">Reference #</label>
                  <div class="col-sm-8">
                    <input type="text" name="ref_number_unbanked" placeholder="Enter Reference Number" class="form-control"/>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div id="row_dim" class="mb10">
          <div class="row mb10">
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-4 control-label" for="category_id">Bank Details</label>
                <div class="col-sm-8">
                  <select class="form-control mb15 selectpicker" name="vendor_name" data-live-search="true" data-style="btn-white" style="padding: 10px 30px;">
                  <option value="">Select Account Number</option>
                  <?php foreach ($accounts as $account){?>
                    <option value="<?php echo $account['account_number_id']; ?>"><?php echo $account['bank']." - ".$account['account_number']." - "; ?></option>
                  <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-4 control-label" for="date">Reference #</label>
                <div class="col-sm-8">
                  <input type="text" name="ref_number" placeholder="Enter Reference Number" class="form-control"/>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h5 class="content-title text-primary">Bank Expenses Information</h5>
            </div>
            <div class="panel-body">
              <div class="row mb40" style="border-bottom: 1px solid #eee;">
                <div class="form-group col-md-12">
                  <label class="col-sm-2 control-label" for="date">Search Item</label>
                  <div class="col-sm-6">
                    <input autocomplete="off" autofocus type="text" name="search" id="search-box" placeholder="Search by Item Name" class="form-control"/>
                    <div id="suggesstion-box"></div>
                  </div>
                </div>
                  <hr>
                  <div class="clearfix"></div>
              </div>
              <div class="content-process">
                <table class="table" id="pc-table">
                  <thead>
                    <tr>
                      <td class="col-md-5">GL Name</td>
                      <td class="col-md-3">Qty</td>
                      <td class="col-md-3">Total Cost</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody id="pc-item">
                  </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td><strong><h5>Total Amount</h5></strong></td>
                      <td><h5 id="total-amnt"></h5><input type="hidden" name="total-amnt_val" value="0" id="total-amnt_val"></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <div class="col-md-12 text-right">
          <a class="btn btn-danger">Cancel</a>
          <button class="btn btn-success pull-right ml20" type="submit">Create Bank Expense</button>
        </div>
      </div>
    </form>
  </div>
  <script type="text/javascript">
    $(function() {
      $('#row_dim').hide();
      $('#row_unbanked').hide();
      $('#banked_cash').change(function(){
          if($('#banked_cash').val() == '2') {
            $('#row_unbanked').hide();
            $('#row_dim').show(); 
          } else {
            $('#row_dim').hide();
            $('#row_unbanked').show(); 
          } 
      });
    });
    $(document).ready(function () {
        $('#transaction-form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
              'qty[]': {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in item quantity!"
                        }
                      ,numeric : {
                        message: "Please enter valid quantity"
                      }
                    }
                },
              'amount[]': {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in item amount!"
                        }
                      ,numeric : {
                        message: "Please enter valid amount"
                      }
                    }
                },
                control_amount: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in the control amount!"
                        }
                      ,
                      numeric : {
                        message: "Please enter valid amount"
                      }
                    }
                },
                receipt_number: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Receipt Number!"
                        }
                    }
                },
                vendor_name: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in the Vendor Name!"
                        }
                    }
                },
                ref_number: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Reference Number!"
                        }
                    }
                },
                vendor_name_unbanked: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in the Vendor Name!"
                        }
                    }
                },
                banked_cash: {
                    validators: {
                        notEmpty: {
                            message: "Please select Payment Source!"
                        }
                    }
                },
                ref_number_unbanked: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Reference Number!"
                        }
                    }
                },
                cashier: {
                    validators: {
                        notEmpty: {
                            message: "Please select Cashier!"
                        }
                    }
                },
                reason: {
                    validators: {
                        notEmpty: {
                            message: "Please enter reason for petty cash!"
                        }
                    }
                }
            }
        })
        .on('success.form.bv', function (e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
            $('#transaction-form').bootstrapValidator('revalidateField', 'control_amount');
            var results = form_valid();
            if(results[0] == "true") {
              $.ajax({
                  url: '<?php echo base_url(); ?>PettyCash/add_expense',
                  type: 'post',
                  data: $("#transaction-form").serialize(),
                  dataType: 'html',
                  success: function (html) {
                    var result = JSON.parse(html);
                      if(!(result.error)) {
                        $('#transaction-form')[0].reset();
                        bootbox.alert(result.message, function ()
                        {
                          window.location.reload();
                        });
                      }  else {
                          bootbox.alert(result.message);
                      }
                  }
              });
            } else {
               bootbox.alert(results[1]);
            }
        });

        $("#search-box").keyup(function() {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('PettyCash/search_item') ?>",
            data:'keyword='+$(this).val(),
            beforeSend: function() {
              $("#search-box").css("background","#eee");
            },
            success: function(data) {
              $("#suggesstion-box").show();
              $("#suggesstion-box").html(data);
              $("#search-box").css("background","#FFF");
            }
          });
        });
    });

    var obj = [];
    var i = 0;
    function selectItem(nm, id) {
      $("#suggesstion-box").html("");
      $("#search-box").val("");
      if(jQuery.inArray(id, obj) === -1) {
        obj.push(id);
        var main_row = '<tr class="pc-tr" id="main_row-'+ i +'"><td><input type="hidden" class="form-control" name="item[]" value="'+id+'"/>';
            main_row += ''+nm+' </td><td><div class="form-group"><input type="text" class="form-control" name="qty[]" min="1" onkeyup="findTotal()" id="qty-'+id+'"/></div></td>';
            main_row += '<td><div class="form-group"><input type="text" class="form-control amount" name="amount[]" min="1" onkeyup="findTotal()" id="amnt-'+id+'"/></div></td>';
            main_row += '<td><a href="#" class="btn btn-danger btn-xs mtop20" onclick="deleteItem(this, '+id+')" style="margin-top:5px"><i class="fa fa-trash"></i> Delete </a></td></tr>';
            $('#pc-table tr:first').after(main_row);
            $option_qty   = $('#pc-table').find('[id="qty-'+id+'"]');
            $option_amnt   = $('#pc-table').find('[id="amnt-'+id+'"]');
            $('#transaction-form').bootstrapValidator('addField', $option_qty);
            $('#transaction-form').bootstrapValidator('addField', $option_amnt);
        i ++;
      }
    }

    function findTotal() {
      //$(form).bootstrapValidator('transaction-form', field);
      var total = 0;
      $('tr.pc-tr').each(function(i,el) {
          var $this = $(this),
              $cost = $this.find('[name="amount\\[\\]"]');
              c = parseFloat($cost.val(), 10);
              total += isNaN(c) ? 0 : c; // default value in case of "NaN"
      });
      $("#total-amnt").html(total);
      $("#total-amnt_val").val(total);
    }

    function deleteItem(dd, id) {
      var row = dd.parentNode.parentNode;
      var $row_val = $(this).parents('.form-group'),
            $option_qty   = $('#pc-table').find('[id="qty-'+id+'"]');
            $option_amnt   = $('#pc-table').find('[id="amnt-'+id+'"]');
      row.parentNode.removeChild(row);
      $('#surveyForm').bootstrapValidator('removeField', $option_qty);
      cleanDeleteItemAll(obj, id);
      findTotal();
    }

    function cleanDeleteItemAll(arr, value) {
      var i = 0;
      while (i < arr.length) {
        if (arr[i] === value) {
          arr.splice(i, 1);
        } else {
          ++i;
        }
      }
      return arr;
    }

    function form_valid() {
      if(obj.length > 0) {
        var total = 0;
        $('tr.pc-tr').each(function(i,el) {
          var $this = $(this),
              $cost = $this.find('[name="amount\\[\\]"]');
              c = parseFloat($cost.val(), 10);
              total += isNaN(c) ? 0 : c;
        });
        if(parseFloat(total, 10) === parseFloat($("#control_amount").val(), 10)) {
          results = new Array("true", "hurray");
        }
        else{
          results = new Array("false", "Expense Save Failed, Control Amount has to be the same as Total Amount to save data");
        }
      } else {
          results = new Array("false", "Expense Save Failed, Please add expense items to save");
      }
      return results;
    }

    
</script>
