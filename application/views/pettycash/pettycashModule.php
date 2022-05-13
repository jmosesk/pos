  
<script type="text/javascript">
    

</script>
<style type="text/css">
    .form-control-feedback.bv-no-label {
        height: 20px !important;
        line-height: 0px !important;
        width: 40px;
    }
</style>
<!-- End of Modal-->
<div class="pageheader">
    <h2><i class="fa fa-check"></i> Approve Expenses</h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Fms</a></li>
            <li class="active"> Approve Expenses </li>
        </ol>
    </div>
</div>
<div class="contentpanel">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <h5 class="subtitle mb5"> Approve Expenses</h5>
                <p class="mb20">Approve/ Disapprove Expenses</p>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped mb30">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Datetime</th>
                                <th>Employee</th>
                                <th>Amount</th>
                                <th>Reason</th>
                                <th>Supplier</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $row_count = 0;
                            foreach ($expenses as $expense) {
                                $row_count ++;
                                ?>
                                <tr>
                                    <td><?php echo $row_count; ?></td>
                                    <td><?php echo format_datetime($expense['date_created']); ?></td>
                                    <td><?php echo $expense['employee']; ?></td>
                                    <td><?php echo number_format($expense['total'], 2); ?></td>
                                    <td><?php echo $expense['reason']; ?></td>
                                    <td><?php echo $expense['vendor_name']; ?></td>
                                    <td class="text-center">
                                        <!-- <span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editUser" onclick="edit('<?php echo $company->id; ?>')"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</span>
                                    </td>
                                    <td><span class="btn btn-danger btn-xs" onclick="deleteCompany('<?php echo $company->id; ?>', '<?php echo $company->description; ?>')"><span class="glyphicon glyphicon-remove"></span>&nbsp;Delete</span>
 -->

                                        <a href="#" onclick="deleteCompany('<?php echo $expense['id']; ?>', '<?php echo number_format($expense['total'], 2); ?>', 'Approve')" class="btn btn-success btn-xs">&nbsp; Approve</a>
                                        <a href="#" onclick="deleteCompany('<?php echo $expense['id']; ?>', '<?php echo number_format($expense['total'], 2); ?>', 'Disapprove')" class="btn btn-danger btn-xs">&nbsp; Deny</a>
                                        <a href="#" data-toggle="modal" data-target="#editUser" onclick="edit('<?php echo $expense['id']; ?>')" class="btn btn-info btn-xs">&nbsp; View</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div><!-- table-responsive -->
            </div><!-- col-md-12 -->
        </div><!-- col-md-12 -->
    </div><!-- row -->
</div><!-- contentpanel -->
<div id="editUser" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">View Petty Cash Item Details</h4>
            </div>
            <div class="modal-body" id="edit-admin-content">

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function edit(id)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>PettyCash/view_expense/' + id,
            type: 'post',
            dataType: 'html',
            success: function (html) {
                $('#edit-admin-content').html(html);
            }
        });
    }

    function deleteCompany(id, nm, type) {
        var objs = {};
        var type_id = 2;
        if(type == 'Approve')
            type_id = 1;
            objs.approved = type_id;
        bootbox.confirm("Are you sure you want to "+ type +" expense with a total amount of " + nm + "?", function (result) {
            if (result) {
                $.ajax({
                    url: '<?php echo base_url(); ?>Admin/delete/' + id,
                    type: 'post',
                    data: {id: id, tbl: "tbl_petty_cash_expenses", row: 'id', data: objs},
                    dataType: 'html',
                    success: function (html) {
                        var response = JSON.parse(html);
                        var msg = response.message;
                        if(response.success) {
                            bootbox.alert(("Expense item has been " + type + "d"), function () {
                                window.location.reload();
                            });
                        } else {
                            bootbox.alert(msg, function () {
                            });
                        }
                    }
                });
            }
        });
    }
</script>