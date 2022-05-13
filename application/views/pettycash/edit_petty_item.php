    
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
                name: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Item Name!"
                        }
                    }
                },
                description: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Description!"
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
                url: '<?php echo base_url(); ?>PettyCash/addItem',
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
        <label class="col-lg-3 control-label">Item Name: <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="name" placeholder="Enter Item Name" value="<?php echo $cash->name ?>" />
            <input type="hidden" name="item_id" readonly value="<?php echo $cash->id ?>" />
            <input type="hidden" name="type" readonly value="edit" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Description: <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="description" placeholder="Enter Item Description" value="<?php echo $cash->description ?>" />
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>