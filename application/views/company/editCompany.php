	
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
                            message: "You're required to fill in Company Name!"
                        }
                    }
                },
                phone_number: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in a Phone Number!"
                        }
                    }
                },
                    address: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Address!"
                        }
                    }
                },
                    pin: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in a pin!"
                        }
                    }
                },
                location: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in a Location"
                        }
                    }
                },
                shift_day: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Number of Shifts per Day"
                        }
                    }
                },
                shift_week: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Number of Shifts per Week"
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
                        url: '<?php echo base_url(); ?>company/editCompany',
                        type: 'post',
                        data: $('#editGridForm :input'),
                        dataType: 'html',
                        success: function (html) {
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
    <?php $company = $companies->result()[0]; ?>
    <div class="form-group">
        <label class="col-lg-3 control-label">Company Name : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="hidden" class="form-control" name="item_id" readonly value="<?php echo $company->company_id; ?>" />
            <input type="text" class="form-control" id="name" name="name" readonly value="<?php echo $company->name; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Phone Number : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number" value="<?php echo $company->phone_number; ?>"/>
        </div>
    </div>
     <div class="form-group">
        <label class="col-lg-3 control-label">Address : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="<?php echo $company->address; ?>"/>
        </div>
    </div>
     <div class="form-group">
        <label class="col-lg-3 control-label">Pin : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="pin" name="pin" placeholder="Enter Pin Number" value="<?php echo $company->pin; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Location : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" value="<?php echo $company->location; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Shift per Day : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="shift_day" placeholder="Enter Number of shifts per Day" value="<?php echo $company->no_shift_day; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Shift per Week : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="shift_week" placeholder="Enter Number of shifts per Week" value="<?php echo $company->no_shift_week; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Reading Method : <sup>*</sup></label>
        <div class="col-lg-8">
            <select class="form-control" name="reading_method" data-live-search="true" data-style="btn-white">
                <option value="1">HIGHEST</option>
                <option value="2">ELECTRONIC CASH READING</option>
                <option value="3">ELECTRONIC METER READING</option>
                <option value="4">MANUAL METER READING</option>
                <option value="5">ELECTRONIC HIGHEST READING</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Cash BBF Limit : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="cash_bbf" placeholder="Enter Cash BBF Limit" value="<?php echo $company->banking_limit; ?>"/>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>