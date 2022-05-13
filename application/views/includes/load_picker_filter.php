<link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js"></script>
<link rel="stylesheet" href="<?= base_url('assets/js/datepicker/daterangepicker.css') ?>"/>
<script type="text/javascript" src="<?= base_url('assets/js/datepicker/moment.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/datepicker/daterangepicker.js') ?>"></script>
  <style>
	  #ui-datepicker-div {
		  width:200px !important;
	  }
  </style>
<script type="text/javascript">
  $(function () {
    var start = moment().subtract(29, 'days');
    var end = moment();
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
    cb(start, end);
  });
</script>