<?php if (isSuper()) { ?>
<?php
  if (isset($_POST['m_register'])) {
        $m_data=array_map("addslashes", $_POST);
        $m_data=array(
          "name"=>$m_data['name'],
          "MKey"=>md5(1),
          "about"=>$m_data['about'],
          "date"=>date('Y/m/d h:i:s a')
        );
        dbAction('module',$operation=1,$m_data);
    }
    
   ?>
<?php  $mod_result=dbAction('module',$operation=4,$m_data="","status=1");
    if ($mod_result->num_rows>0) {
       foreach ($mod_result as $mod_row) {
        $enable="ena_".$mod_row['name'];
        $disable="dis_".$mod_row['name'];
       if (isset($_POST[$enable])) {
          $m_data=array("MKey"=>md5(1));
          dbAction('module',$operation=2,$m_data,"id=".$_POST['id']);
          echo "<script>window.location.href='".constant("BASE")."admin.php?page=options'</script>";
        }
        if (isset($_POST[$disable])) {
          $m_data=array("MKey"=>md5(0));
          dbAction('module',$operation=2,$m_data,"id=".$_POST['id']);
          echo "<script>window.location.href='".constant("BASE")."admin.php?page=options'</script>";
        }
        ?>

        <script>
          var mod_name="#<?php echo $mod_row['name']; ?>";
          var mod_id="<?php echo $mod_row['id'] ?>";
          $(document).ready(function(){
              $("input").change(function(){
                 var id=$(this).val();
                 $("#<?php echo $mod_row['name']; ?>").submit();
              });
            });
        </script>
     <?php  }
     } ?>
<!-- <button type="button" class="btn btn-primary btn-xs"><i class="fa fa-sliders"></i> Table View</button> -->
  <div class="modal fade in" id="module_pop">
    <form method="post">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Default Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
            
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Module Name</label>
              <input type="text" class="form-control" placeholder="Module Name.." name="name" required="required">
              <p><pre>By Default it'll be Enable</pre></p>
              <label>About Module</label>
              <textarea name="about" class="form-control" required="required"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="m_register">Register</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </form>
    </div>
<div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Module Management</h3>
                <button type="button" class="btn btn-primary btn-xs pull-right" style="float: right;" data-toggle="modal" data-target="#module_pop"><i class="fa fa-plus"></i> Register New</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">

        <thead>

          <tr>

            <th>id</th>

            <th>NAME</th>

            <th>About Module</th>

          </tr>

        </thead>

        <tbody>

            <?php 

            if ($mod_result->num_rows > 0) {

              foreach ($mod_result as $row) {
              $enable="ena_".$row['name'];
              $disable="dis_".$row['name']; ?>

               <tr>

                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?> <label  title=""><?php if ($row['MKey']==md5(1)) { echo "<i class='fa fa-circle text-success'></i>"; }else{echo "<i class='fa fa-circle text-danger'></i>";} ?></label></td>
                <td><small><?php if (!empty($row['about'])) {echo $row['about'];}else{echo "Don't Know!";}  ?></small><br>
                <div class="btn-group">
                      <form method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                        <input type="submit" class="btn btn-success btn-xs <?php if ($row['MKey']==md5(1)) { echo "btn-success"; } ?>" name="<?php echo $enable; ?>" value="Enable"/>

                        <input type="submit" class="btn btn-danger btn-xs <?php if ($row['MKey']==md5(0)) { echo "btn-success"; } ?>" name="<?php echo $disable; ?>" value="Disable"/>
                      </form>
                  </div>

                </td>

              </tr>

              <?php }

            }

             ?>

        </tbody>

      </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
<?php }else{
  echo "Not Permitted!";
} ?>