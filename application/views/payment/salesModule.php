<style type="text/css">
    .form-control-feedback.bv-no-label {
        height: 20px !important;
        line-height: 0px !important;
        width: 40px;
    }
</style>

<link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery_validation/jquery.validate.js"></script>

<div class="pageheader">
    <h2><i class="fa fa-users"></i> Sales</h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <a href="<?php echo base_url() ?>payment/saleList/<?php echo MD5(date("d")); ?>" class="btn btn-success">Today's Sale</a>
            <a href="<?php echo base_url() ?>payment/saleList" class="btn btn-success">Sale List</a>
        </ol>
    </div>    
</div>

<div class="contentpanel">  
    <form class="form" id="addMedForm">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Search Item</label>
                        <div class="col-sm-9">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search Item Name or Item Category e.g Lubes" autocomplete="off"/>
                            <ul class="list-unstyled ui-autocomplete-search" id="finalResult"></ul>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-condensed" id="medicineTable">
                        <thead>
                            <tr>
                                <th class="col-md-5">Item Name</th>
                                <th class="col-md-2">Qty</th>
                                <th class="col-md-2">Price</th>
                                <th class="col-md-2">Discount</th>
                                <th class="col-md-2">Qty/Amount</th>
                                <th class="col-md-2">Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div><!-- panel-body -->
            </div><!-- panel -->
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-footer" style="padding:10px 20px;">
                    <table class="table">
                        <tr>
                            <td class="col-md-1 control-label">Payment Type </td>
                            <td class="col-md-9 pb-10">
                                <div class="form-group">
                                    <select class="form-control mb15 selectpicker" name="payment_type" id="payment_type_div" onchange="ShowHideDiv()" data-live-search="true" data-style="btn-white">
                                        <option value="Cash">CASH</option>
                                        <option value="Mpesa" selected="selected">MPESA</option>
                                        <option value="Credit Card">CARD</option>
                                        <option value="invoice">INVOICE</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr id="cash" style="display: none">
                            <td colspan="2" class="control-label">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Vehicle Reg Number" style="margin-bottom: 10px;" />
                                </div>
                            </td>
                        </tr>
                        <tr id="invoice" style="display: none">                     
                            <td colspan="2" class="control-label">
                                <div class="form-group row">
                                    <select name="customer" id="customer" class="form-control mb15 selectpicker" data-live-search="true" data-style="btn-white">
                                        <option value="">Select Customer</option>
                                        <?php
                                        if (!empty($customers)) {
                                            foreach ($customers as $key => $value) {
                                                echo "<option value='" . $value->customer_id . "'>" . $value->company_name . "</option>";
                                            }
                                        } else {
                                            echo '<option value="">Customer not available</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group row"> 
                                    <input type="text" class="form-control mt10" name="selVehicle" placeholder="Vehicle Registration Number"/>
                                </div>
                                <div class="form-group row">                               
                                    <input type="text" class="form-control mt10" id="invoice_driver" name="invoice_driver" placeholder="Invoice Number"/>
                                </div>
                                <div class="form-group row">
                                    <input type="text" class="form-control mt10" id="invoice_lpo_number" name="invoice_lpo_number" placeholder="LPO Number"/>
                                </div>
                            </td>
                        </tr>
                        <tr id="creditcard" style="display: none">
                            <td colspan="2" class="control-label">
                                <div class="form-group row">
                                    <select name="card_type" id="card_type" class="form-control selectpicker" data-live-search="true" data-style="btn-white">
                                        <option value="" selected>Select Card Type</option>
                                        <?php
                                        if (!empty($custCards)) {
                                            foreach ($custCards as $key => $value) {
                                                echo "<option value='" . $value->customer_id . "'>" . $value->name . "</option>";
                                            }
                                        } else {
                                            echo '<option value="">Card Customers not available</option>';
                                        }
                                        ?>
                                    </select>   
                                </div>
                                <div class="form-group row">                                 
                                    <input type="text" class="form-control mt10" id="cc_ref" name="cc_ref" placeholder=" Receipt Number"/>
                                </div>
                                <div class="form-group row">
                                    <input type="text" class="form-control mt10" id="card_holder_name" name="card_holder_name" placeholder="Card Holder Name"/>
                                </div>
                                <div class="form-group row">     
                                    <input type="text" class="form-control mt10" id="name" name="cc_name" placeholder="Vehicle Reg Number"/>
                                </div>
                            </td>
                        </tr>
                        <tr id="mpesa">
                            <td colspan="2" class="control-label">
                                <div class="form-group row">
                                    <select name="mpesa_type" class="form-control selectpicker" data-live-search="true" data-style="btn-white">
                                        <?php
                                        if (!empty($mpesas)) {
                                            foreach ($mpesas as $key => $value) {
                                                echo "<option value='" . $value->customer_id . "'>" . $value->name . "</option>";
                                            }
                                        } else {
                                            echo '<option value="">Mpesa not available</option>';
                                        }
                                        ?>
                                    </select>   
                                </div>
                                <div class="form-group row">
                                    <input type="text" class="form-control" id="mpesa_reg_number" name="mpesa_reg_number" placeholder="Vehicle Reg Number" style="margin-bottom: 10px;" />
                                </div>
                                <div class="form-group row">   
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" style="margin-bottom: 10px;" />
                                </div>
                                <div class="form-group row">   
                                    <input type="text" class="form-control" id="ref" name="mpesa_ref" placeholder="Ref Number"/>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-body" style="padding:0px 20px;">
                    <table class="table table-total">
                        <tbody>
                            <tr>
                        <div class="form-group row">   
                            <td class="col-md-2"><strong>Total :</strong></td>
                            <td><input type="text" class="form-control input-sm mb3 text-right" id="grdtot" name="grdtot" value="0.00" Readonly/></td>
                        </div>
                        </tr>
                        </tbody>
                    </table>
                    <div class="panel-footer" style="padding:10px">
                        <div class="col-xs-12 text-center">
                            <div class="row">
                                <div class="col-xs-6" style="padding: 0;">
                                    <button type="submit" class="btn btn-success btn-block btn-flat">Submit</button>
                                </div>
                                <div class="col-xs-6" style="padding: 0 5px;">
                                    <div class="btn-group-vertical btn-block">
                                        <button type="button" class="btn btn-danger btn-block btn-flat">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- panel-body -->
            </div><!-- panel -->
    </form>
</div>
</div>
<script type="text/javascript">


</script>
<script type="text/javascript">
    $(document).ready(function () {
        findTotal();
        $('#addMedForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            //excluded: ':disabled',
            fields: {
                'qty[]': {
                    validators: {
                        notEmpty: {
                            message: "Please enter Quantity"
                        }
                    }
                },
                type: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Invoice Number!"
                        }
                    }
                },
                credit_card: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Customer Credit Card Number"
                        }
                    }
                },
                ref: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Reference Number!"
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in Customer Phone Number"
                        }
                    }
                },
                customer: {
                    validators: {
                        notEmpty: {
                            message: "You're required to select a customer"
                        }
                    }
                },
                selVehicle: {
                    validators: {
                        notEmpty: {
                            message: "You're required to select a Vehicle"
                        }
                    }
                },
                payment_type: {
                    validators: {
                        notEmpty: {
                            message: "You're required to select a Vehicle"
                        }
                    }
                },
                invoice_driver: {
                    validators: {
                        notEmpty: {
                            message: "Please enter Driver Name"
                        }
                    }
                },
                invoice_lpo_number: {
                    validators: {
                        notEmpty: {
                            message: "invoice_lpo_number"
                        }
                    }
                },
                mpesa_type: {
                    validators: {
                        notEmpty: {
                            message: "Please select Mpesa Type"
                        }
                    }
                },
                card_type: {
                    validators: {
                        notEmpty: {
                            message: "Please select card type"
                        }
                    }
                },
                cc_ref: {
                    validators: {
                        notEmpty: {
                            message: "Please enter Receipt Number"
                        }
                    }
                },
                card_holder_name: {
                    validators: {
                        notEmpty: {
                            message: "Please enter Card Holder Name"
                        }
                    }
                },
                cc_name: {
                    validators: {
                        notEmpty: {
                            message: "Please enter Vehicle Reg Number"
                        }
                    }
                },
                card_holder_name: {
                    validators: {
                        notEmpty: {
                            message: "Please Card Holder Name"
                        }
                    }
                },
                mpesa_reg_number: {
                    validators: {
                        notEmpty: {
                            message: "Please enter Vehicle Reg Number"
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: "Please enter Phone Number"
                        }
                    }
                },
                mpesa_ref: {
                    validators: {
                        notEmpty: {
                            message: "Please enter Mpesa Reference Number"
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
                        url: '<?php echo base_url(); ?>Payment/addSale',
                        type: 'post',
                        data: $('#addMedForm :input'),
                        dataType: 'html',
                        success: function (html) {
                            var response = JSON.parse(html);
                            var msg = response.message;
                            if (response.success) {
                                $('#addMedForm')[0].reset();
                                bootbox.alert(msg, function () {
                                    window.location.reload();
                                });
                            } else {
                                bootbox.alert(msg, function () {
                                    $("#addMedForm").data('bootstrapValidator').resetForm();
                                });
                            }
                        }
                    })
                });
        $("#search").keyup(function () {
            $.ajax({
                type: "post",
                url: "<?php echo base_url() ?>Payment/searchItem",
                cache: false,
                data: 'search=' + $("#search").val(),
                success: function (response) {
                    $('#finalResult').html("");
                    var obj = JSON.parse(response);
                    if (obj != null) {
                        if (obj.length > 0) {
                            try {
                                var items = [];
                                $.each(obj, function (i, val) {
                                    var txt = val.name + " - " + val.category;
                                    if (val.item_type != 1) {
                                        if (val.fc_job != 1) {
                                            var cat = val.category;
                                            var qty = val.quantity;
                                            var newQty = val.quantity;
                                            var item_id = val.item_id + '-' + val.centre_id;
                                        } else {
                                            var cat = "FC Job Card";
                                            var qty = val.quantity;
                                            var newQty = val.quantity;
                                            var item_id = val.item_id + '-' + val.fc_centre;
                                        }
                                    } else {
                                        var cat = " White Products ";
                                        var qty = 0;
                                        var newQty = 10000000000000;
                                        var item_id = val.item_id;
                                    }
                                    items.push('<li class="item-suggestions"><a class="suggest-item" href="#" onclick="addMed(\'' + val.name + '\',\'' + item_id + '\',\'' + val.price + '\',' + qty + ',' + newQty + ',\'' + cat + '\')"><div class="details"><div class="item-name">' + val.name + '</div><span class="attributes">Category : <span class="item_category">' + cat + ' </span></span><span class="attributes qty">  Qty <span class="item_category">' + qty + '</span></span></a></li>');
                                });
                                $('#finalResult').append.apply($('#finalResult'), items);
                            } catch (e) {
                                alert('Sorry we encountered an error while fetching your request..');
                            }
                        } else {
                            $('#finalResult').html($('<li/>').text("Sorry, No Data Found! Please delete and try typing new data"));
                        }
                    } else {
                        $('#finalResult').html($('<li/>').text("Sorry, No Data Found! Please delete and try typing new data"));
                    }
                },
                error: function () {
                    alert('Sorry we encountered an error while fetching data, Please try again');
                }
            });
            return false;
        });
    });

    $("#medicineTable").on("click", ".ibtnDel", function (event) {
        var row = $(this).closest("tr");
        $option = row.find('[name="option[]"]');
        row.remove();
        findTotal();
    });


    $(function () {
        $('#customer').change(function () {
            populateSelect();
        });
    });

    function populateSelect() {
        var id = $('#customer').val();
        $.ajax({
            url: "<?php echo base_url() ?>Company/get_customer_vehicles",
            type: 'post',
            data: {id: id},
            dataType: 'json',
            success: function (response) {
                //alert('mss');
                var len = response.length;
                $("#selVehicle").empty();
                $("#selVehicle").append('<option value="">Select Vehicle</option>');
                for (var i = 0; i < len; i++) {
                    var id = response[i]['vehicle_id'];
                    var name = response[i]['registration_number'];
                    $("#selVehicle").append("<option value='" + id + "'>" + name + "</option>");

                }
            }
        });
    }


    function ShowHideDiv() {
        findTotal();
        var type_payment = document.getElementById("payment_type_div");
        cash.style.display = payment_type_div.value == "Cash" ? "table-row" : "none";
        mpesa.style.display = payment_type_div.value == "Mpesa" ? "table-row" : "none";
        creditcard.style.display = payment_type_div.value == "Credit Card" ? "table-row" : "none";
        invoice.style.display = payment_type_div.value == "invoice" ? "table-row" : "none";
        $("#addMedForm").data('bootstrapValidator').resetForm();
    }

    var counter = 0;
    function addMed(nm, id, price, qty, newQty, type) {
        counter++;
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td class="paddingtblr5-10"><label class="txt-inverse">' + nm + '</label>&nbsp;&nbsp;<div id="pump_div_' + counter + '"></div><input type="hidden" name="med_id[]" value="' + id + '" readonly/><input type="hidden" name="stock_qty[]" id="stock_qty_' + counter + '" value="' + newQty + '" readonly/></td>';
        cols += '<td class="paddingtblr5-10 qty_">0</td>';
        cols += '<td class="paddingtblr5-10"><input type="hidden" name="value_price[]" value="' + price + '" readonly/>' + price + '</td>';
        cols += '<td class="paddingtblr5-10"><div class="form-group"><input type="text" min="0" class="netEmp form-control input-sm mb3"  name="discount[]" placeholder="Enter discount" value="0" onchange="findTotal();" onkeyup="findTotal();" onpaste="findTotal();" onkeydown="findTotal();" Readonly/></td></td>';
        cols += '<td class="paddingtblr5-10"><div class="form-group"><input type="text" min="0" max="' + newQty + '" class="netEmp form-control input-sm mb3" name="qty[]" id="checkAmount_' + counter + '" placeholder="Enter Quantity" value="0" onchange="findTotal();" onkeyup="findTotal();" onpaste="findTotal();" onkeydown="findTotal();" required/></td></td>';
        cols += '<td class="paddingtblr5-10"><span class="subtot">' + price + '</span></td>';
        cols += '<td class="paddingtblr5-10"><input type="button" class="ibtnDel btn btn-md btn-danger btn-xs"  value="Delete"></td>';
        newRow.append(cols);
        $("#medicineTable").append(newRow);
        $('#finalResult').html("");
        if (type === " White Products ") {
            var select = document.createElement("select");
            select.setAttribute("name", "pumps[]");
            select.setAttribute("id", "pump_select_" + counter);
            select.setAttribute("class", "form-control mb15");
            $.ajax({
                type: "post",
                url: "<?php echo base_url() ?>Product/getPumps/" + id,
                success: function (response) {
                    var dt = JSON.parse(response);
                    if (dt != null) {
                        if (dt.length > 0) {
                            try {
                                $.each(dt, function (i, val) {
                                    var option = document.createElement("option");
                                    option.setAttribute("value", val.pump_id + '-' + val.centre_id);
                                    option.innerHTML = val.pump_name;
                                    select.appendChild(option);
                                });
                            } catch (e) {
                                alert('Sorry we encountered an error while fetching your request..1');
                            }
                            $('#pump_div_' + counter).append(select);
                        } else {
                            alert("Sorry, No Data Found! Please delete and try typing new data2");
                        }
                    } else {
                        alert("Sorry, No Data Found! Please delete and try typing new data3");
                    }
                }, error: function () {
                    alert('Sorry we encountered an error while fetching data, Please try again4');
                }
            });
        } else {
            $('<input>').attr({
                type: 'hidden',
                id: 'pump_select_' + counter,
                name: 'pumps[]',
                value: 'NULL'
            }).appendTo('#pump_div_' + counter);
        }
        findTotal();
        $("#addMedForm").bootstrapValidator('update');
        /*qty[]
         $('input[id="checkAmount_' + counter + '"]').rules("add", {// <- apply rule to new field
         required: true
         });
         */
    }

    function findTotal() {
        var $tblrows = $("#medicineTable tbody tr");
        $tblrows.each(function (index) {
            var $tblrow = $(this);
            var qty = $tblrow.find("[name=qty\\[\\]]").val();
            var price = $tblrow.find("[name=value_price\\[\\]]").val();
            var pumps = $tblrow.find("[name=pumps\\[\\]]").val();
            var discount = $tblrow.find("[name=discount\\[\\]]").val();
            var measure = "";
            if (pumps !== "NULL") {
                measure = " Ltrs";
                var subTotal = parseFloat(qty, 10);
                var qty = parseFloat(qty, 2) / parseFloat(price, 2);
            } else {
                var subTotal = parseFloat(qty, 10) * parseFloat(price);
                var qty = parseFloat(qty, 2);
            }
            if (!isNaN(qty))
                newQty = qty;
            else
                newQty = 0;
            $tblrow.find('.qty_').html(newQty.toFixed(2) + measure);
            if (!isNaN(subTotal)) {
                if (!isNaN(discount))
                    subTotal = subTotal - discount;
                $tblrow.find('.subtot').html(subTotal.toFixed(2));
                var grandTotal = 0;
                $(".subtot").each(function () {
                    var stval = parseFloat($(this).html());
                    grandTotal += isNaN(stval) ? 0 : stval;
                });
                $("#grdtot").val(grandTotal);
            }
        });
    }

</script>