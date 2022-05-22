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
                invoice_date: {
                    validators: {
                        notEmpty: {
                            message: "Please select Date!"
                        }
                    }
                },
                vendor: {
                    validators: {
                        notEmpty: {
                            message: "Please select a Supplier!"
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
                        url: '<?php echo base_url(); ?>payment/addVatPayment',
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
    $(function () {
        $("#invoice_date").datepicker();
        $("#to").datepicker();
    });
</script>
<!-- Modal to add Company -->
<link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>
<div id="addUser" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add VAT Payment</h4>
            </div>
            <div class="modal-body">
                <form id="addForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="panel panel-default">
                        <div class="panel-body">
                               <div class="form-group">
                                <label class="col-lg-3 control-label">Total Tax Due OR Claimable : </label>
                                <div class="col-lg-8">
                                    <input type="text" value="<?=number_format($totalTaxdue,2)?>" class="form-control" name="" id="" readonly />
                                </div><!-- col-sm-6 -->
                            </div>
                            <?php if($totalTaxdue > 0) {?>

                                <?php }else{?>

                    you can not pay

                <?php }?>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Reason for Payment : </label>
                                <div class="col-lg-8">
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
                                                <label class="col-lg-3 control-label">Payment Type : </label>
                                                <div class="col-lg-8">
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
                                                <label class="col-lg-3 control-label">Account : </label>
                                                <div class="col-lg-8">
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
                                                <label class="col-lg-3 control-label">Account : </label>
                                                <div class="col-lg-8">
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
                                                <label class="col-lg-3 control-label">Account : </label>
                                                <div class="col-lg-8">
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
                                <label class="col-lg-3 control-label">Reference : </label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="ref_no" id="ref_no" placeholder="Bank Ref Number/Cheque Number" />
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Amount : </label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount" />
                                </div><!-- col-sm-6 -->
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Transaction Date: <sup>*</sup></label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="invoice_date" name="invoice_date" placeholder="dd-mm-yyyy" readonly/>
                                </div>
                            </div>                          
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Remarks : </label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Enter Remarks e.g Card Holder Name, Card Number for Top Up" ></textarea>
                                </div><!-- col-sm-6 -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add VAT Payment</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal-->
<div class="pageheader">
    <h2><i class="fa fa-edit"></i> VAT Payments</h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Fms</a></li>
            <li class="active"> VAT Payments</li>
        </ol>
    </div>
</div>
<div class="contentpanel">
    <div class="row">
        <div class="col-md-12">

            <div class="col-md-6">
                <h5 class="subtitle mb5"> VAT Payments</h5>
                <p class="mb20">Create a VAT Payment or Keep track of existing VAT Payments</p>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser"><span class="fa fa-plus"></span> Create VAT Payment</button>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb30" id="no-ordering">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Datetime</th>
                                <th>Payment Reason</th>
                                <th>Payment Method</th>
                                <th>Ref No.</th>
                                <th>Remarks</th>
                                <th>Amount</th>
                                <th>Employee</th>
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
                                        <td><?php echo $payment->reason; ?></td>
                                        <td><?php echo $payment->payment_type; ?></td>
                                        <td><?php echo $payment->ref_no; ?></td>
                                        <td><?php echo $payment->remarks; ?></td>
                                        <td><?php echo $payment->amount; ?></td>
                                        <td><?php echo $payment->employee; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>                       
                        </tbody>
                    </table>
                </div><!-- table-responsive -->
            </div><!-- col-md-12 -->

        </div><!-- col-md-12 -->
    </div><!-- row -->
</div><!-- contentpanel -->