    
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
                expcode: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Expense Code!"
                        }
                    }
                },
                description: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Description!"
                        }
                    }
                },
                cash_limit: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Cash Expense Limit"
                        },
                        numeric: {
                            message: "Please enter valid Value"
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
                url: '<?php echo base_url(); ?>PettyCash/edit_expense',
                type: 'post',
                data: $("#editGridForm").serialize(),
                dataType: 'html',
                success: function (html) {
                    $('#editGridForm')[0].reset();
                    $('#editUser').modal('hide');
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
    <?php $cash = $expense_details[0]; ?>
    <div class="form-group">
        <label class="col-lg-3 control-label">Expense Code: <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="expcode" name="expcode" placeholder="Enter Expense Code" value="<?php echo $cash->codeexpense ?>" />
            <input type="hidden" name="item_id" readonly value="<?php echo $cash->id ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Description: <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Expense Description" value="<?php echo $cash->description ?>" />
        </div>
    </div>                  
    <div class="form-group">
        <label class="col-lg-3 control-label">Account Code : <sup>*</sup></label>
        <div class="col-lg-8">
            <select class="form-control mb15" name="accountcode" data-live-search="true" data-style="btn-white">
                <?php foreach ($accounts->result() as $account) { ?>
                    <option value="<?php echo $account->accountcode; ?>" <?php if($cash->glaccount == $account->accountcode) echo "selected" ?>><?php echo $account->accountcode . '-' . $account->accountname; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Tax Category : <sup>*</sup></label>
        <div class="col-lg-8">
            <select class="form-control mb15" name="tax_id" data-live-search="true" data-style="btn-white">
                <?php foreach ($taxs->result() as $tax) { ?>
                    <option value="<?php echo $tax->type_id; ?>" <?php if($cash->taxcatid == $tax->type_id) echo "selected" ?>><?php echo $tax->name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Expense Limit: <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="cash_limit" placeholder="Enter Cash Expense Limit" value="<?php echo $cash->explimit ?>" />
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>