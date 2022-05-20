	
<?php $expense_data = $expense_details ?>

<div class="">
    <div class="table-responsive">
        <table class="table table-striped mb30">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th class="text-center">Total Price</th>
                </tr>
            </thead>
            <tbody>
              <?php $i = 0; $total_amount = 0; foreach($expense_details as $expense) { $i ++; $total_amount += $expense['amount']; ?>
                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $expense['item'] ?></td>
                  <td><?php echo $expense['quantity'] ?></td>
                  <td class="text-right"><?php echo number_format($expense['amount'], 2) ?></td>
                </tr>
              <?php } ?>
              <tr><td class="text-right" colspan="4"><strong>Total Amount: <?php echo number_format($total_amount, 2) ?></strong></td></tr>
          </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
</div>