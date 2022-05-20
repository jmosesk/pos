<link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/custom/js/jquery.timepicker.js"></script>
<style>
    #ui-datepicker-div {
        width:200px !important;
    }
</style>
<div class="pageheader">
    <h2><i class="fa fa-file"></i>Credit Transactions Report</h2>
</div>
<?php if ($this->session->flashdata('error_msg')) { ?>
    <div class="row">
        <div class="alert alert-danger mb10">
            <?php echo $this->session->flashdata('error_msg'); ?>
        </div>
    </div>
<?php } ?>
<div class="contentpanel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="panel-title"><b>Credit Transactions Report</b></h4>
                    <p>Select one of below to view and filter Credit Transactions Report</p>
                </div>
                <div class="col-md-12 mt10">
                    <a href="<?php echo base_url(); ?>Reports/credit_report_detail/customer" class="btn btn-default"><span class="fa fa-user-circle-o"></span> &nbsp; Customer Credit Report</a>
                    <a href="<?php echo base_url(); ?>Reports/credit_report_detail/cashier" class="btn btn-default ml20"><span class="fa fa-users"></span> &nbsp; Cashier Credit Report</a>
                </div>
            </div>
        </div>
    </div>
</div>