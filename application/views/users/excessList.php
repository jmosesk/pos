   
   <div class="pageheader">
   	<div class="col-md-6">
      <h2><i class="fa fa-edit"></i> Excesses</h2>
   	</div> 
   	<div class="clearfix"></div>
      
    </div>
    <div class="contentpanel">
          <div class="panel panel-default">
                <form>
            <div class="panel-heading">
              <div class="row"> 
                <div class="col-md-4">
                  <h4 class="panel-title"><b>Excesses</b></h4>
                  <p>View Employees with Excesses </p>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                  <table class="table mb30">
                    <thead>
                      <tr>
                        <th style="background-color:#fcfcfc">#</th>
                        <th style="background-color:#fcfcfc">Datetime</th>
                        <th style="background-color:#fcfcfc">Employee</th>
                        <th style="background-color:#fcfcfc">Shift</th>
                        <th style="background-color:#fcfcfc">Amount</th>
                        <th style="background-color:#fcfcfc">Type</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $row_count = 0; if($users != null){ $row_count = 0; foreach ($users->result() as $user){ $row_count ++;?>
                      <tr>
                      	<td><?php echo $row_count; ?></td>
                      	<td><?php echo format_datetime($user->datetime); ?></td>
                      	<td><?php echo $user->user; ?></td>
                      	<td><?php echo ($user->shift_name.' - '.format_date($user->shift_date)); ?></td>
                      	<td><?php echo $user->amount; ?></td>
                      	<td><?php echo $user->transaction_type; ?></td>
                      </tr>
                      <?php } }?>
                    </tbody>
                  </table>
                </form>
              </div><!-- table-responsive -->
            </div>
          </div><!-- panel -->
    </div><!-- contentpanel -->