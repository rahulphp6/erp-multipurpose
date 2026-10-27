<?php 
if ($isW)
if (isset($_GET['NotesEid'])) {
  if (!$isE){
    echo "<script>alert('Invalid Permission Area!')</script>";
    //echo "<script>window.location.href='" . constant("BASE") . "'</script>";
  }
   $assetEid=$_GET['NotesEid'];
   $assetRow=dbAction('notes',4,'','id='.$assetEid);
   $assetRow=$assetRow->fetch_assoc();
  }
?>
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
<?php
  if (isset($_POST['addNotes'])) {
    $date=array("date"=>date("Y-m-d h:i:s"));
    $serviceData=array_merge($_POST,$date);
    unset($serviceData['addNotes']);
   $addNotes=dbAction('notes',1,$serviceData);
   if ($addNotes[0]==1) {
     mgs('Notes Add Successfully!',1);
   }else{
     mgs($addNotes[1],0);
   }
  }


  if (isset($_POST['upNotes'])) {
    $date=array("date"=>date("Y-m-d h:i:s"));
    $serviceData=array_merge($_POST,$date);
    unset($serviceData['upNotes']);
   $addNotes=dbAction('notes',2,$serviceData);
   if ($addNotes[0]==1) {
     mgs('Notes Updated Successfully!',1);
     echo "<script>window.location.href='" . constant("BASE") . "?page=notes'</script>";
   }else{
     mgs($addNotes[1],0);
   }
  }
  ?>
</div>
</div>
</div>
</div>
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
                <h3 class="card-title">Notes Details</h3>
                <!-- <button type="button" class="btn btn-primary btn-xs pull-right" style="float: right;" data-toggle="modal" data-target="#module_pop"><i class="fa fa-plus"></i> Add Notes</button> -->
              </div>
          <div class="card-body">            
            <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th >#</th>
                    <th>Action</th>
                    <th>Title</th>
                    <th>Note</th>
                    <th>Date</th>
                    <th>Status</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                   <?php
                   $notes=dbAction('notes',4,'','status=1');

                    if ($notes->num_rows>0) {
                      $authKey=1;
                     foreach ($notes as $notesRow) { ?>
                        <tr>
                          <td><?php echo $notesRow['id']; ?></td>
                          <td>
                            <div class="btn-group">
                               <?php
                                if ($isE)echo '<a href="?page=notes&NotesEid='.$notesRow['id'].'" class="btn btn-primary btn-xs"><i class="fa fa-edit nav-icon"></i></a>';
                                //if ($isD)echo '<a href="?page=notes&NotesDid='.$notesRow['id'].'" class="btn btn-danger btn-xs"><i class="fa fa-trash nav-icon"></i></a>';
                                 ?>
                            </div>
                          </td>
                          <td><?php echo $notesRow['heading']; ?></td>
                          <td><?php echo $notesRow['description'];?></td>
                          <td><?php echo $notesRow['date'];?></td>
                          <td><?php if($notesRow['status']){echo "Active";}else{echo "InActive";}?></td>
                          
                          
                        </tr>
                    <?php  }
                    }
                   ?>
                  </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
 <div <?php if(isset($assetEid)){echo 'class="modal fade in show" style="display:block" id="module_pop_"'.$assetEid.' aria-modal="true"';}else{echo 'class="modal fade in" id="module_pop"';} ?>>
  <form method="post">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Add Notes</h4>
            <?php if(isset($assetEid)){echo '<a href="?page=notes" class="close">x</a>';}else{echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>';} ?>
            
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group form-group-icon-left">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-pencil input-icon"></i></span>
                      </div>
                      <input class="form-control" name="heading" placeholder="Heading" type="text" required value="<?php if(isset($assetEid)){echo $assetRow['heading'];} ?>"/>
                    </div>
                  </div>
                  <div class="form-group form-group-icon-left">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-file input-icon"></i></span>
                      </div>
                      <textarea class="form-control" name="description" placeholder="some description..."><?php if(isset($assetEid)){echo $assetRow['description'];} ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <?php if(isset($assetEid)){echo '';}else{echo '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>';} ?>
            <input type="submit" <?php if(isset($assetEid)){echo 'name="upNotes" value="Update Notes"';}echo 'name="addNotes" value="Add Notes"'; ?>class="btn btn-primary">
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </form>
</div>