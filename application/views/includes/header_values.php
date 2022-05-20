<?php
			if($this->Store_model->get_listCloseMeterReading($shift_id) != null){
				if($this->Store_model->get_listCloseDippingsReading($shift_id) != null){
					if($this->Store_model->get_listCloseLubesReading($shift_id) != null){
						if($this->Store_model->get_listCloseProductsReading($shift_id) != null) {



						if(($meters == null)
            echo "not meters";
            else
              echo "meters";

           && ($dips == null) && ($lubes == null) && ($products == null)) { echo $products; 

           ?>
        <div class="pageheader">
          <div class="col-md-3">
          <h2><i class="fa fa-edit"></i> Close Shift</h2>
        </div>
            <div class="col-md-9 text-right">
            <a href="<?php echo base_url() ?>shift/close_shift" class="btn btn-success"> Meter Readings</a>
            <a href="<?php echo base_url() ?>shift/dippings" class="btn btn-success"> Dippings</a>
            <a href="<?php echo base_url() ?>shift/lube_products" class="btn btn-success"> Lube Products</a>
            <a href="<?php echo base_url() ?>shift/products" class="btn btn-success"> Other Products</a>
          <?php if(($meters == null)
            echo "not meters";
            else
              echo "meters";

           && ($dips == null) && ($lubes == null) && ($products == null)) { echo $products;  ?>
            <a href="<?php echo base_url() ?>shift/drops" class="btn btn-success"> Cash Drops</a>
          <?php } ?>
            </div>
            <div class="clearfix"></div>
        </div>