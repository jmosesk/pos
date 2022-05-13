	
<script type="text/javascript">
    $(document).ready(function () {
        $('#editGridForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                amount: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Opening Balance!"
                        },
                        integer: {
                            message: 'Please enter corrent value for Opening Balance'
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
                        url: '<?php echo base_url(); ?>Company/editAccountBalance',
                        type: 'post',
                        data: $('#editGridForm :input').serialize(),
                        dataType: 'html',
                        success: function (html) {
                            $('#opening_balance_modal').modal('hide');
                            bootbox.alert(html, function ()
                            {
                                window.location.reload();
                            });
                        }
                    });
                });
    });

</script>
<form id="editGridForm">
    <?php $customer = $customers->result()[0]; ?>
    <div class="form-group">
        <label class="col-lg-3 control-label">Account Name : </label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Account Name" value="<?php echo $customer->account_number; ?>" Readonly />
            <input type="hidden" class="form-control" id="item_id" name="item_id" value="<?php echo $customer->account_number_id; ?>" Readonly />
            <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="<?php echo $customer->account_number_id; ?>" Readonly />
        </div>
    </div>
    <?php
    if ($transactions != NULL) {
        $transaction = $transactions[0];
        ?>
        <div class="form-group">
            <label class="col-lg-12 control-label text-danger">Sorry the Customer has an Opening Balance of : <?php echo number_format($transaction->bbf, 2) ?></label>
        </div>
    <?php } else { ?>
        <div class="form-group">
            <label class="col-lg-3 control-label">Opening Balance : </label>
            <div class="col-lg-8">
                <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Opening Balance"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-8 col-md-offset-3">
                <div class="ckbox ckbox-success">
                    <input type="checkbox" id="dr" name="dr" checked>
                    <label for="dr"> Debit Balance </label>
                </div>
            </div>
        </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
    <?php } ?>   
</form>