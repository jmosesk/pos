<div class="pageheader">
    <h2><i class="fa fa-edit"></i> Sales</h2>
</div>
<div class="contentpanel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row"> 
                <div class="col-md-6">
                    <h4 class="panel-title"><b>Sales Register</b></h4>
                    <p>View and Filter Cash, Invoice, Mpesa and Card Job Cards</p>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?php echo base_url() ?>product/raiseFCJobCard" type="button" class="btn btn-success"><span class="fa fa-plus"></span> Add Sales</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped mb30">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>                             
                                <th>Total Amount</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($sales_jc != null) {
                                $row_count = 0;
                                foreach ($sales_jc->result() as $sale) {
                                    $row_count++;
                                    ?>
                                    <tr>
                                        <td><?php echo $row_count; ?></td>
                                        <td><?php echo format_datetime($sale->datetime); ?></td>
                                        <td><?php echo $sale->item_name; ?></td>                                       
                                        <td><?php echo $sale->quantity; ?></td>
                                        <td><?php echo $sale->unit_price; ?></td>
                                        <td><?php echo number_format(($sale->quantity * $sale->unit_price), 2); ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- table-responsive -->              
            </div><!-- col-md-12 -->
        </div>
    </div><!-- panel -->
</div><!-- contentpanel -->
<div id="viewSalesItems" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="text-center">View Sales Items</h4>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-condensed" id="medicineTable">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div class="col-md-12 text-right">
                        <p>Total Amount : <span id="total_amount"></span></p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script>
    function viewSalesItems(id) {
        window.open(
                '<?php echo site_url('Export/saleItem') ?>/' + id,
                '_blank'
                );
    }

    function rm(nm, id, customer_id) {
        bootbox.confirm("Are you sure you want to void sales " + nm + "?", function (result) {
            if (result) {
                $.ajax({
                    url: '<?php echo base_url(); ?>Payment/voidSale/' + id,
                    type: 'post',
                    data: {id: id, cust_id: customer_id},
                    dataType: 'html',
                    success: function (html) {
                        bootbox.alert(html, function () {
                            window.location.reload();
                        });
                    }
                });
            }
        });
    }
</script>