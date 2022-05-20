    

    <div class="pageheader">
        <h2><i class="fa fa-user-circle-o"></i> Customer Balances</h2>
        <div class="breadcrumb-wrapper">
            <span class="label">You are here:</span>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Fms</a></li>
                <li class="active">Customers Balances</li>
            </ol>
        </div>
    </div>

    <div class="contentpanel">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <h5 class="subtitle mb5">Customer Information</h5>
                    <p class="mb20">View Customer Balances</p>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-striped mb30" id="no-pagination">
                            <thead>
                                <tr>                                                              
                                    <th>Company Name</th>
                                    <th>Phone Number</th>
                                    <th>Credit</th>
                                    <th>Debit</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $total_cr = $total_dr = 0;
                              foreach ($customers['customers'] as $customer):
                                $cr_opening = $dr_opening = ""; $closing = 0; $date = " --- ";
                                if(array_key_exists($customer['customer_id'], $customers['opening_data'])) {
                                  if($customers['opening_data'][$customer['customer_id']] > 1) {
                                    $cr_opening = $customers['opening_data'][$customer['customer_id']];
                                    $total_cr += $cr_opening;
                                  } else {
                                    $dr_opening = $customers['opening_data'][$customer['customer_id']];
                                    $total_dr += $dr_opening;
                                  }
                                }
                                if(array_key_exists($customer['customer_id'], $customers['closing_data'])) {
                                  $closing = $customers['closing_data'][$customer['customer_id']];
                                }
                                if(array_key_exists($customer['customer_id'], $customers['closing_data'])) {
                                  $date = $customers['date_data'][$customer['customer_id']];
                                }
                                ?>
                                <tr>
                                  <td><?php echo $customer['name'] ?></td>
                                  <td><?php echo $customer['phone_number'] ?></td>
                                  <td><?php echo $cr_opening ?></td>
                                  <td><?php echo $dr_opening ?></td>
                                </tr>
                              <?php endforeach ?>              
                            </tbody>
                              <tr><td>Total</td><td></td><td><?php echo $total_cr ?></td><td><?php echo $total_dr ?></td><td></td><td></td><td></td></tr>                  
                        </table>
                    </div><!-- table-responsive -->
                </div><!-- col-md-12 -->
            </div><!-- col-md-12 -->
        </div><!-- row -->
    </div><!-- contentpanel -->