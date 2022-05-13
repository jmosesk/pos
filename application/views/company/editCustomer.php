	
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
                            message: "You're required to fill in Customer Name!"
                        }
                    }
                },
                phone_number: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Customer Phone Number!"
                        }
                    }
                },
                location: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Customer Location!"
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
                        url: '<?php echo base_url(); ?>company/editCustomer',
                        type: 'post',
                        data: $('#editGridForm :input').serialize(),
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
    <?php
    $customer = $customers->result()[0];
    $role_level = $this->session->userdata('logged_in')['role_id'];
    ?>
    <div class="form-group">
        <label class="col-lg-3 control-label">Customer Name : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Customer Name" value="<?php echo $customer->name; ?>" Readonly />
            <input type="hidden" class="form-control" id="item_id" name="item_id" value="<?php echo $customer->person_id; ?>" Readonly />
            <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="<?php echo $customer->customer_id; ?>" Readonly />
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Company Name : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name" value="<?php echo $customer->company_name; ?>" Readonly />
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Phone Number : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number" value="<?php echo $customer->phone_number; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Email : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Address" value="<?php echo $customer->email; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Address : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Postal Address" value="<?php echo $customer->address; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">PIN : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="pin" name="pin" placeholder="Enter Email Address" value="<?php echo $customer->pin; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Location : <sup>*</sup></label>
        <div class="col-lg-8">
            <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" value="<?php echo $customer->county; ?>"/>
        </div>
    </div>
    <?php if ($role_level == 5) { ?>
        <div class="form-group">
            <label class="col-lg-3 control-label">Credit Limit : <sup>*</sup></label>
            <div class="col-lg-8">
                <input type="text" class="form-control" id="limit" name="limit" placeholder="Enter Credit Limit" value="<?php echo $customer->credit_limit; ?>"/>
            </div>
        </div>
    <?php } ?>
    <div class="form-group">
        <label class="col-lg-3 control-label">Select Category : <sup>*</sup></label>
        <div class="col-lg-8">
            <select class="form-control" name="category" data-live-search="true" data-style="btn-white">
                <?php foreach ($categories->result() as $category) { ?>
                    <option value="<?php echo $category->category_id; ?>"<?php if ($category->category_id == $customer->customer_category_id) { ?> selected="Yes" <?php } ?>><?php echo $category->category_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-8 col-md-offset-3">
            <div class="ckbox ckbox-success">
                <input type="checkbox" id="checkbox1" name="active" <?php if ($customer->status == 1) echo "checked"; ?>>
                <label for="checkbox1"> Active Status </label>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>