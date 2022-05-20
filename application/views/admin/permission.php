<div class="pageheader">
    <h2><i class="fa fa-edit"></i> Employee Permissions</h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Fms</a></li>
            <li class="active">Employee Permissions</li>
        </ol>
    </div>
</div>
  <div class="panel panel-default mb5">                
    <div class="panel-heading">
      <div class="row"> 
        <div class="col-md-8">
          <h4 class="panel-title"><b><?php echo urldecode($name); ?> Permissions</b></h4>
          <p>This is a list of all permissions. You can view and manage permissions for <?php echo urldecode($name); ?></p>
        </div>
        <div class="col-md-4 text-right">
          <button type="button" id="addPermission" class="btn btn-primary"><span class="fa fa-check"></span> Save Permission</button>
        </div>
      </div>
    </div>
  </div>
  <form id="assignPermissions" class="form-horizontal" role="form">
    <input type="hidden" name="role_id" value="<?php echo $id ?>">
    <div class="contentpanel">
        <div class="row">
            <div class="col-md-12">
              <?php echo $results ?>
            </div><!-- col-md-12 -->
        </div><!-- row -->
    </div>
</form>


<script type="text/javascript">  
    $("#addPermission").click(function (e) {
        e.preventDefault();
        //Loader();
        $.ajax({
            type:"POST",
            cache:false,
            url:"<?php echo base_url("Admin/assignPermission") ?>",
            data:$("#assignPermissions").serialize(),
            success: function (html) {
                var result = JSON.parse(html);
                if(!(result.error)) {
                    var msg = result.message;
                    bootbox.alert(msg, function() {
                      window.location.reload();
                    });
                }  else {
                    //$.unblockUI();
                    alert(result.message);
                }
            }
        });
    });

    function checkAll(bx) {
      var id = bx.id;
      $('.class-'+id).prop("checked" , bx.checked);
    }
</script>