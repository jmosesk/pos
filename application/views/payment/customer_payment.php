<script type="text/javascript">
    $(document).ready(function () {
        $('#addForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                cheque: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Reference Number!"
                        }
                    }
                },
                amount: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Payment Amount!"
                        },
                        digits: {
                            message: "Please enter a valid value!"
                        }
                    }
                },
                remarks: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Remarks, Input N/A if none!"
                        }
                    }
                },
                reason: {
                    validators: {
                        notEmpty: {
                            message: "Please select reason for payment!"
                        }
                    }
                },
                method: {
                    validators: {
                        notEmpty: {
                            message: "Please select payment method!"
                        }
                    }
                },
                payment_type_div: {
                    validators: {
                        notEmpty: {
                            message: "Please select payment type!"
                        }
                    }
                },
                employee: {
                    validators: {
                        notEmpty: {
                            message: "Please select an employee!"
                        }
                    }
                },
                customer: {
                    validators: {
                        notEmpty: {
                            message: "Please select a customer!"
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
                    // Use Ajax to submit form data
                    $.ajax({
                        url: '<?php echo base_url(); ?>Payment/addCustomerPayment',
                        type: 'post',
                        data: $('#addForm :input'),
                        dataType: 'html',
                        success: function (html) {
                            $('#addForm')[0].reset();
                            $('#addUser').modal('hide');
                            bootbox.alert(html, function ()
                            {
                                window.location.reload();
                            });
                        },
                        error: function (e) {
                            alert('Payment could not be saved, Please try again!');
                        }
                    });
                });
    });
    function ShowHideDiv() {
        var type_payment = document.getElementById("payment_type_div");
        mobile.style.display = payment_type_div.value == 7 ? "table-row" : "none";
        card.style.display = payment_type_div.value == 3 ? "table-row" : "none";
        bank.style.display = payment_type_div.value == 2 ? "table-row" : "none";
        $("#addForm").data('bootstrapValidator').resetForm();
    }
</script>
<!-- Modal to add Company -->
<link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>
<div id="addUser" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add a Customer Payment</h4>
            </div>
            <div class="modal-body">
                <form id="addForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Customer : </label>
                                <div class="col-sm-6">
                                    <select class="form-control mb15 selectpicker" name="customer" id="customer" data-live-search="true" data-style="btn-white">
                                        <option readonly value="">Select a Customer . . .</option>
                                        <?php
                                        if ($customers != null) {
                                            foreach ($customers as $customer) {
                                                ?>
                                                <option value="<?php echo $customer->customer_id; ?>"><?php echo $customer->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div><!-- col-sm-6 -->
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Reason for Payment : </label>
                                <div class="col-sm-6">
                                    <select class="form-control mb15 selectpicker" name="reason" id="reason" data-live-search="true" data-style="btn-white">
                                        <option readonly value="">Select a Reason for Payment . . .</option>
                                        <option value="Invoice">Invoice</option>
                                        <option value="Deposit">Deposit</option>
                                        <option value="Prepayment">Prepayment</option>
                                        <option value="Ownequity">Ownequity</option>
                                        <option value="Loan">Loan</option>
                                        <option value="Income">Income</option>
                                    </select>
                                </div><!-- col-sm-6 -->
                            </div>
                            <div class="form-group">
                                <table class="table">
                                    <tr>                                       
                                        <td class="col-md-5 pb-10">
                                            <div class="form-group"> 
                                                <label class="control-label col-md-4">Payment Type : </label>
                                                <div class="col-sm-6">
                                                    <select class="form-control mb15 selectpicker" name="payment_type" id="payment_type_div" onchange="ShowHideDiv()" data-live-search="true" data-style="btn-white">
                                                        <option readonly value="">Select Payment Method . . .</option>
                                                        <?php
                                                        if ($methods != null) {
                                                            foreach ($methods->result() as $method) {
                                                                ?>
                                                                <option value="<?php echo $method->type_id; ?>"><?php echo $method->name; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>                           
                                    <tr id="mobile" style="display: none">                     
                                        <td colspan="2" class="control-label">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Account : </label>
                                                <div class="col-sm-6">
                                                    <select name="account_m" id="account_m" class="form-control mb15 selectpicker" data-live-search="true" data-style="btn-white">
                                                        <option value="">Select Mobile Account</option>
                                                        <?php
                                                        if (!empty($mpesas)) {
                                                            foreach ($mpesas as $key => $value) {
                                                                echo "<option value='" . $value->customer_id . "'>" . $value->company_name . "</option>";
                                                            }
                                                        } else {
                                                            echo '<option value="">Account not available</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>                                         
                                        </td>
                                    </tr>
                                    <tr id="card" style="display: none">
                                        <td colspan="2" class="control-label">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Account : </label>
                                                <div class="col-sm-6">
                                                    <select name="account_c" id="card_type" class="form-control selectpicker" data-live-search="true" data-style="btn-white">
                                                        <option value="" selected>Select Card Type</option>
                                                        <?php
                                                        if ($custCards != null) {
                                                            foreach ($custCards as $value) {
                                                                ?>
                                                                <option value="<?php echo $value->customer_id; ?>"><?php echo $value->name; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo '<option value="">Card Customers not available</option>';
                                                        }
                                                        ?>                                                        
                                                    </select>   
                                                </div> 
                                            </div>                                                                                  
                                        </td>
                                    </tr>
                                    <tr id="bank" style="display: none">
                                        <td colspan="2" class="control-label">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Account : </label>
                                                <div class="col-sm-6">
                                                    <select name="account_b" id="bank_acc" class="form-control selectpicker" data-live-search="true" data-style="btn-white">
                                                        <?php
                                                        if (!empty($accounts)) {
                                                            foreach ($accounts as $account) {
                                                                ?>
                                                                <option value="<?php echo $account['account_number_id']; ?>"><?php echo $account['bank'] . " - " . $account['account_number'] . " - "; ?></option>
                                                            <?php } ?>
                                                            } else {
                                                            <?php
                                                            echo '<option value="">Banks not available</option>';
                                                        }
                                                        ?>
                                                    </select> 
                                                </div> 
                                            </div>                                                                                                                             
                                        </td>
                                    </tr>
                                    </tbody>
                                </table> 
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Reference : </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="cheque" id="cheque" placeholder="Enter Transaction Reference Number" />
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Amount : </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount" />
                                </div><!-- col-sm-6 -->
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-4">With Holding Tax(if Any) : </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="wht" id="wht" value="0.00"/>
                                </div><!-- col-sm-6 -->
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-4">Total Amount : </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="grdtot" name="grdtot" value="0.00" readonly />
                                </div><!-- col-sm-6 -->
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Employee : </label>
                                <div class="col-sm-6">
                                    <select class="form-control mb15 selectpicker" name="employee" id="employee" data-live-search="true" data-style="btn-white">
                                        <option readonly value="">Select an Employee . . .</option>
                                        <?php
                                        if ($employees != null) {
                                            foreach ($employees->result() as $employee) {
                                                ?>
                                                <option value="<?php echo $employee->user_id . '-' . $employee->centre_id; ?>"><?php echo $employee->username; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div><!-- col-sm-6 -->
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Remarks : </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Enter Remarks or Decsription here" ></textarea>
                                </div><!-- col-sm-6 -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Customer Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal-->
<div class="pageheader">
    <h2><i class="fa fa-edit"></i> Customer Payments</h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Fms</a></li>
            <li class="active"> Customer Payments</li>
        </ol>
    </div>
</div>
<div class="contentpanel">
    <div class="row">
        <div class="col-md-12">
            <?php if ($employees != null) { ?>
                <div class="col-md-6">
                    <h5 class="subtitle mb5"> Customer Payments</h5>
                    <p class="mb20">Create a Customer Payment or Keep track of existing Customer Payments</p>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser"><span class="fa fa-plus"></span> Create Customer Payment</button>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb30" id="no-ordering">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Payment Reason</th>
                                    <th>Payment Method</th>
                                    <th>Cheque Number</th>
                                    <th>Amount</th>
                                    <th>Employee</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($payments != null) {
                                    $row_count = 0;
                                    foreach ($payments->result() as $payment) {
                                        $row_count++;
                                        ?>
                                        <tr>
                                            <td><?php echo $row_count; ?></td>
                                            <td><?php echo $payment->datetime; ?></td>
                                            <td><?php echo $payment->customer; ?></td>
                                            <td><?php echo $payment->payment_reason; ?></td>
                                            <td><?php echo $payment->payment_type; ?></td>
                                            <td><?php echo $payment->ref_number; ?></td>
                                            <td><?php echo number_format(($payment->amount), 2, '.', ''); ?></td>
                                            <td><?php echo $payment->employee; ?></td>
                                            <td><?php echo $payment->remarks; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- table-responsive -->
                </div><!-- col-md-12 -->
                <?php
            } else {
                $msg = "Please assign shift allocation to continue";
                load_error($msg);
            }
            ?>
        </div><!-- col-md-12 -->
    </div><!-- row -->
</div><!-- contentpanel -->