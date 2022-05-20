<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="images/favicon.png" type="image/png">
        <title>PetraNova Ltd</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.datatables.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.default.css" />
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/toggles.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/retina.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.cookies.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
        <script src="<?php echo base_url(); ?>assets/custom/js/bootbox.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/custom/js/bootstrapValidator.js"></script>
        <script src="<?php echo base_url(); ?>assets/custom/js/bootstrapValidator.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/DataTables/datatables.min.js"></script>
    </head>
    <body>

        <!-- Modal to Change Password -->
        <div id="changepwrd" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Change Password</h4>
                    </div>
                    <div class="modal-body">
                        <form id="changepwrdForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Old Password : </label>
                                <div class="col-lg-8">
                                    <input type="password" class="form-control" name="oldpasswrd" placeholder="Enter Old Password" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Password : </label>
                                <div class="col-lg-8">
                                    <input type="password" class="form-control" name="passwrd" placeholder="Enter New Password" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Confirm Password : </label>
                                <div class="col-lg-8">
                                    <input type="password" class="form-control" name="cpasswrd" placeholder="Confirm New Password" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Change Password -->

        <section>
            <div class="leftpanel">
                <div>
                    <span> <img src="<?php echo base_url(); ?>assets/custom/images/logo.png" style="width: 80px; padding: 5px 10px 0px 10px;"></span>
                </div><!-- logopanel -->
                <div class="leftpanelinner">
                    <h5 class="sidebartitle">Navigation</h5>
                    <ul class="nav nav-pills nav-stacked nav-bracket" id="main_menu">
                        <?php echo generate_menu() ?>
                        <!--<li class="nav-parent"><a href="#"><i class="fa fa-home fa-fw"></i> <span>Company Information</span><i class="pull-right fa fa-plus" style="font-size: 12px;margin-top: 3%;"></i></a>
                            <ul class="children">
                                <li><a href="<?php echo base_url(); ?>company"><i class="fa fa-desktop fa-fw"></i> <span>Company</span></a></li>
                                <li><a href="<?php echo base_url(); ?>company/customer"><i class="fa fa-user-circle-o fa-fw"></i> <span>Customers</span></a></li>
                                <li><a href="<?php echo base_url(); ?>Company/customer_vehicles" class="ml30"><i class="fa fa-caret-right" aria-hidden="true"></i> Customer Vehicles</a></li>
                                <li><a href="<?php echo base_url(); ?>company/supplier"><i class="fa fa-truck" aria-hidden="true"></i> Suppliers</a></li>
                                <h6 class="sidebartitle sidebarsmall">Items Master</h6> 
                                    <li class=""><a href="<?php echo base_url(); ?>product/white_product" class="ml30"><i class="fa fa-fire fa-fw"></i> Fuel Products</a></li>
                                    <li><a href="<?php echo base_url(); ?>product" class="ml30"><i class="fa fa-shopping-basket fa-fw"></i> Non Fuel Products</a></li>
                                    <li><a href="<?php echo base_url(); ?>product/product_category" class="ml30"><i class="fa fa-shopping-basket fa-fw"></i>Product Category</a></li>
                                    <li><a href="<?php echo base_url(); ?>product/fcJobCard" class="ml30"><i class="fa fa-shopping-basket fa-fw"></i> FC Job Cards</a></li>

                                    <h6 class="sidebartitle sidebarsmall">Stores</h6> 
                                        <li><a href="<?php echo base_url(); ?>store/fuel_store" class="ml30"><i class="fa fa-free-code-camp" aria-hidden="true"></i> Fuel Stores</a></li>
                                        <li><a href="<?php echo base_url(); ?>store" class="ml30"><i class="fa fa-building-o" aria-hidden="true"></i> Non Fuel Stores</a></li>
                                        <li><a href="<?php echo base_url(); ?>store/pump"><i class="fa fa-fax fa-fw"></i> <span>Pumps</span></a></li>
                                        <li><a href="<?php echo base_url(); ?>centre"><i class="fa fa-columns" aria-hidden="true"></i> <span>Centres</span></a></li>
                                        <li><a href="<?php echo base_url(); ?>store/shift_master"><i class="fa fa-table fa-fw"></i> Meter Form Master</a></li>
                                        <li><a href="<?php echo base_url(); ?>user"><i class="fa fa-user fa-fw"></i> Staff Menu</a></li>
                                        </ul>
                                        </li>
                                        <li class="nav-parent"><a href="#"><i class="fa fa-cc"></i> <span>Payments</span><i class="pull-right fa fa-plus" style="font-size: 12px;margin-top: 3%;"></i></a>
                                            <ul class="children">
                                                <li><a href="<?php echo base_url(); ?>payment/sales"><i class="fa fa-caret-right"></i> Sales</a></li>
                                                <li><a href="<?php echo base_url(); ?>Product/raiseFCJobCard"><i class="fa fa-caret-right"></i> Raise Job Card</a></li>
                                                <li><a href="<?php echo base_url(); ?>payment/debit_note"><i class="fa fa-caret-right"></i> Debit Notes</a></li>
                                                <li><a href="<?php echo base_url(); ?>payment/vendor_payment"><i class="fa fa-caret-right"></i> Vendor Payments</a></li>
                                                <li><a href="<?php echo base_url(); ?>payment/customer_payment"><i class="fa fa-caret-right"></i> Customer Payments</a></li>
                                                <li><a href="<?php echo base_url(); ?>Product/banks"><i class="fa fa-caret-right"></i> Banks & Account Numbers</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-parent"><a href="#"><i class="fa fa-money"></i> <span>Petty Cash</span><i class="pull-right fa fa-plus" style="font-size: 12px;margin-top: 3%;"></i></a>
                                            <ul class="children">
                                                <li><a href="<?php echo base_url(); ?>PettyCash"><i class="fa fa-caret-right"></i>Maintenance</a></li>
                                                <li><a href="<?php echo base_url(); ?>PettyCash/submitExpenses"><i class="fa fa-caret-right"></i>Transactions</a></li>
                                                <li><a href="<?php echo base_url(); ?>payment/debit_note"><i class="fa fa-caret-right"></i>Inquiries and Reports</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="<?php echo base_url(); ?>product/charge_supplier"><i class="fa fa-home"></i> <span>Variance Charge Suppliers</span></a></li>
                                        <li class="nav-parent"><a href="#"><i class="fa fa-suitcase"></i> <span>Vehicles</span><i class="pull-right fa fa-plus" style="font-size: 12px;margin-top: 3%;"></i></a>
                                            <ul class="children">
                                                <li><a href="<?php echo base_url(); ?>company/transporter"><i class="fa fa-caret-right"></i> Transporters</a></li>
                                                <li><a href="<?php echo base_url(); ?>company/vehicle"><i class="fa fa-caret-right"></i> Vehicles</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-parent"><a href="#"><i class="fa fa-suitcase"></i> <span>Employees</span><i class="pull-right fa fa-plus" style="font-size: 12px;margin-top: 3%;"></i></a>
                                            <ul class="children">
                                                <li><a href="<?php echo base_url(); ?>user/employeeShortageList"><i class="fa fa-caret-right"></i> Employees Shortages</a></li>
                                                <li><a href="<?php echo base_url(); ?>user/employeeExcessList"><i class="fa fa-caret-right"></i> Employee Excess</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-parent"><a href="#"><i class="fa fa-suitcase"></i> <span>Inventory</span><i class="pull-right fa fa-plus" style="font-size: 12px;margin-top: 3%;"></i></a>
                                            <ul class="children">
                                                <li><a href="<?php echo base_url(); ?>product/stockAdjustment"><i class="fa fa-usd"></i> Stock Adjustment</a></li>
                                                <li><a href="<?php echo base_url(); ?>product/stock_transfer"><i class="fa fa-exchange"></i> Stock Transfer</a></li>
                                                <li><a href="<?php echo base_url(); ?>product/stockList"><i class="fa fa-retweet"></i> Stock Take</a></li>
                                                <li><a href="<?php echo base_url(); ?>product/stockValuation"><i class="fa fa-usd"></i> Stock Valuation</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-parent"><a href="#"><i class="fa fa-cart-arrow-down"></i> <span>Purchases</span><i class="pull-right fa fa-plus" style="font-size: 12px;margin-top: 3%;"></i></a>
                                            <ul class="children">
                                                <li><a href="<?php echo base_url(); ?>product/recieving"><i class="fa fa-caret-right"></i> All Purchases</a></li>
                                                <li><a href="<?php echo base_url(); ?>product/recieving_fuel"><i class="fa fa-caret-right"></i> Fuel Purchases</a></li>
                                                <li><a href="<?php echo base_url(); ?>product/recieving_non_fuel"><i class="fa fa-caret-right"></i> Non Fuel Purchases</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-parent"><a href="#"><i class="fa fa-suitcase"></i> <span>Shifts</span><i class="pull-right fa fa-plus" style="font-size: 12px;margin-top: 3%;"></i></a>
                                            <ul class="children">
                                                <li><a href="<?php echo base_url(); ?>shift/shift_list"><i class="fa fa-caret-right"></i> Shift List</a></li>
                                                <li><a href="<?php echo base_url(); ?>shift/centre_allocation_list"><i class="fa fa-caret-right"></i> Centre Allocation</a></li>
                                                <li><a href="<?php echo base_url(); ?>shift/close_shift"><i class="fa fa-caret-right"></i> Close Shift</a></li>
                                                <li><a href="<?php echo base_url(); ?>shift"><i class="fa fa-caret-right"></i> Shift Names</a></li>
                                                <li><a href="<?php echo base_url(); ?>shift/bankings"><i class="fa fa-caret-right"></i> Bankings</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-parent"><a href="#"><i class="fa fa-bar-chart"></i> <span>Reports</span><i class="pull-right fa fa-plus" style="font-size: 12px;margin-top: 3%;"></i></a>
                                            <ul class="children">
                                                <li><a href="<?php echo base_url(); ?>reports/CustomerReport"><i class="fa fa-caret-right"></i> Customer Statement Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>reports/VendorReport"><i class="fa fa-caret-right"></i> Vendor Statement Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>reports/CreditReport"><i class="fa fa-caret-right"></i> Credit Transactions Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>reports/DebitReport"><i class="fa fa-caret-right"></i> Debit Transactions Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>reports/ExpenseReport"><i class="fa fa-caret-right"></i> Expense Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>reports/stockTransferReport"><i class="fa fa-caret-right"></i> Stock Movement Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>reports/valuationReport"><i class="fa fa-caret-right"></i> Stock Valuation Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>reports/variationReport"><i class="fa fa-caret-right"></i> Stock Variation Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>reports/meterMovementReport"><i class="fa fa-caret-right"></i> Meter Movement Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>reports/salesReport"><i class="fa fa-caret-right"></i> Sales Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>reports/purchaseReport"><i class="fa fa-caret-right"></i> Purchase Report</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-parent"><a href="#"><i class="fa fa-bar-chart"></i> <span>Shift Reports</span><i class="pull-right fa fa-plus" style="font-size: 12px;margin-top: 3%;"></i></a>
                                            <ul class="children">
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/salesSummary"><i class="fa fa-caret-right"></i> Sales Summary Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/meterMovement"><i class="fa fa-caret-right"></i> Meter Movement Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/stockCalculation"><i class="fa fa-caret-right"></i> Stock Calculation Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/inventoryReport"><i class="fa fa-caret-right"></i> Inventory Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/dailyCashier"><i class="fa fa-caret-right"></i> Cashier Reconciliation Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/dailyCashSummary"><i class="fa fa-caret-right"></i> Cash Summary Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/stockCalculationUllage"><i class="fa fa-caret-right"></i> Stock Calculation Ullage Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/receiptsRegister"><i class="fa fa-caret-right"></i> Receipts Register Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/stockTransfer"><i class="fa fa-caret-right"></i> Stock Transfer Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/stockAdjustment"><i class="fa fa-caret-right"></i> Stock Adjustment Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/meterVariance"><i class="fa fa-caret-right"></i> Meter Variance Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/customerStatement"><i class="fa fa-caret-right"></i> Customer Statement Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/vendorStatement"><i class="fa fa-caret-right"></i> Vendor Statement Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/wetStockSummary"><i class="fa fa-caret-right"></i> Summary Wet Stock Report</a></li>
                                                <li><a href="<?php echo base_url(); ?>ShiftReports/wetStockDetailed"><i class="fa fa-caret-right"></i> Detailed Wet Stock Report</a></li>
                                            </ul>
                                        </li> -->
                                        </ul>
                                        </div><!-- leftpanelinner -->
                                        </div><!-- leftpanel -->
                                        <?php

                                        function format_datetime($datetime) {
                                            $date = date('H:i, d-M-Y', (strtotime($datetime)));
                                            return $date;
                                        }

                                        function format_date($datetime) {
                                            $date = date('d-m-Y', (strtotime($datetime)));
                                            return $date;
                                        }

                                        function format_cash($amount) {
                                            $total_amount = number_format($amount, 2);
                                            return $total_amount;
                                        }
                                        ?>
                                        <div class="mainpanel">
                                            <div class="headerbar">
                                                <div class="">
                                                    <ul class="headermenu">
                                                        <?php if(has_permissions(69, 1)) { ?>
                                                            <li style="padding: 2% 10px; border-left: none; ">
                                                                <span class="text-danger"><?php if ((company_data()[0]->banking_limit) < (company_data()[0]->cash)) echo "You have Ksh. " . number_format(company_data()[0]->cash) . " that is unbanked!"; ?></span>
                                                            </li>
                                                        <?php } ?>
                                                        <li class="pull-right">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                    Welcome, <?php echo ucwords($this->session->userdata('logged_in')['name']); ?>
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                                                    <li><a href="#" data-toggle="modal" data-target="#changepwrd"><i class="glyphicon glyphicon-cog"></i> Change Password</a></li>
                                                                    <li><a href="<?php echo base_url(); ?>user/logout"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <?php if(has_permissions(70, 1)) { ?>
                                                        <li class="pull-right" style="border-left: none;">
                                                            <a href="<?php echo base_url(); ?>shift/close_shift" type="button" class="btn btn-danger ml20 mr20 mt10 mb10">
                                                                   Close <?php echo (current_shift_data()->shift_name) . ' of ' . format_date((current_shift_data()->shift_date));
                                                                 ?>
                                                            </a>
                                                        </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div><!-- header-right -->
                                            </div><!-- headerbar -->
                                            <?php
                                            if ($this->session->flashdata('message') == null) {

                                            } else { ?>
                                            <div class="alert alert-info">
                                                <?php echo $this->session->flashdata('message'); ?>
                                            </div> <?php }

                                            if ($this->session->flashdata('error_message')) { ?>
                                                <div class="alert alert-danger">
                                                    <strong><?php echo $this->session->flashdata('error_message'); ?></strong>
                                                </div> <?php }
