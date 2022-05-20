    
<link href="<?php echo base_url(); ?>assets/custom/css/bootstrap-select.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/custom/js/bootstrap-select.js"></script>

<div class="pageheader">
    <h2><i class="fa fa-sliders"></i> Receipts Register Report</h2>
    <p class="mb20 text-muted">View and Filter Receipts Register Per Shift or Per Day</p>
</div>
<div class="contentpanel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="">
                    <form class="form-inline pull-right" action="<?php echo base_url() ?>ShiftReports/receiptsRegister" method ="Post">
                        <div class="form-group">
                            <label>Select a Shift :</label>
                        </div>
                        <div class="form-group">
                            <select class="form-control mb15 selectpicker" name="shift_id" data-live-search="true" data-style="btn-white">
                                <?php
                                if ($shifts != null) {
                                    foreach ($shifts->result() as $shift) {
                                        ?>
                                        <option value="<?php echo $shift->shift_id; ?>" <?php
                                        if ($shift_id == $shift->shift_id): echo "selected";
                                        endif
                                        ?>> <?php echo $shift->shift_name . ' of ' . format_date($shift->shift_date); ?> </option>
                                                <?php
                                            }
                                        }
                                        ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Create Report</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped mb30 table-bordered" id="export">
                    <thead>
                        <tr>
                            <th>Customer/ Cashier</th>
                            <th>Debit Amt</th>
                            <th>Credit Amt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($users != NULL) {
                            foreach ($users->result() as $user) {
                                $debit = 0;
                                $credit = 0;
                                if ($user->excess < 0)
                                    $debit = $user->excess;
                                elseif ($user->excess > 0)
                                    $credit = $user->excess;
                                ?>
                                <tr>
                                    <td><?php echo $user->cashier; ?></td>
                                    <td><?php if ($debit != 0) echo $debit; ?></td>
                                    <td><?php if ($credit != 0) echo $credit; ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div><!-- panel -->
</div><!-- contentpanel -->