<section class="content">
      <div class="container-fluid">
<!-- SELECT2 EXAMPLE -->

        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">File Details</h3></div>
            <div class="card-body">
                <ul>
                <?php
                    if (isset($_POST['opnFolder'])) {
                      $folName="upload/".$_POST['folName']."/";
                      if ($dirFolder = opendir($folName)) {

                              while (false !== ($fileName = readdir($dirFolder))) {

                                  if ($fileName != "." && $fileName != "..") {
                                    if (!is_dir($fileName)) {
                                        $pageName=pathinfo($fileName);
                                         $checkUsr=explode('--', $pageName['filename']);
                                         echo '<li><a href="'.$pageName['basename'].'" class="btn btn-default btn-xs"><i class="nav-icon fa fa-file"></i> '.$pageName['filename'].'</a></li>';
                                         
                                      }
                                       
                                  }
                              }

                              closedir($dirFolder);
                          }
                      
                    }else{echo "<p>Choose folder to View Files <i class='fa fa-arrow-down'></i></p>";}
                  ?>
              </ul>
            </div>
          </div>
          <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">File Manager</h3>
            <a href="?page=training-add" class="btn btn-primary btn-xs pull-right" style="float: right;" data-toggle="modal" data-target="#module_pop"><i class="fa fa-plus"></i> Upload New</a>
          </div>
              <?php
              if (isset($_POST['applyId'])) {
                
                
               if (isset($_FILES['Uploadfiles'])) {
                  $fetchModule=dbAction('permissions',4,'','status=1 AND id='.$_POST['moduleName']);
                  if ($fetchModule->num_rows>0) {
                     $modulefileName=$fetchModule->fetch_assoc();
                     $modulefileName=explode('-', $modulefileName['name']);
                  }
                      $allowedExtsFiles = array("doc", "docx", "pdf", "xlsx", "xcl","txt");
                      $files="";
                      for ($i=0; $i < count($_FILES["Uploadfiles"]["name"]); $i++) { 
                        $tmp=$_FILES["Uploadfiles"]["tmp_name"][$i];
                        $orginal=$_FILES["Uploadfiles"]["name"][$i];

                        $type=strtolower($orginal);
                        $type=str_replace(" ", "-",$type);
                        $extArray = explode(".",$type);
                        $extension =$extArray[1];
                        $name=$extArray[0]."--".$uid.".".$extension;

                        $target_dir="upload/".$modulefileName[0]."/";
                        if (!file_exists($target_dir)){
                          mkdir($target_dir, 0777, true);
                        }
                        $target_file = $target_dir.$name;
                        $name=$extArray[0].".".$extension;
                        if(in_array($extension, $allowedExtsFiles)){
                           $files .=filter_var($target_file, FILTER_SANITIZE_STRING).",";
                           move_uploaded_file($tmp, $target_file);
                          }
                      }
                      $extrasFiles=array("files"=>$files);
                      $tblName=tableName($modulefileName[0]);
                      $modUpload=dbAction($tblName,2,$extrasFiles,'id='.$_POST['applyId']);
                      if ($modUpload[0]) {
                        mgs("Files Uploaded!");
                      }else{
                        mgs($modUpload[1],0);
                      }

                  }

                
              }
               ?>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped projects" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Folder</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $folder = "upload";
                                if (@scandir($folder)) {
                                    $dir = scandir($folder);
                                    $prt = 1;
                                    foreach ($dir as $images) {
                                        if ($images != "." && $images != "..") {
                                            $parts = pathinfo($images);
                                            $imgTitle=str_replace('.jpg','',$images);
                                            $imgTitle=str_replace('.png','',$imgTitle);
                                            $imgTitle=str_replace('.gif','',$imgTitle);
                                            $imgTitle=str_replace('-',' ',$imgTitle);
                                            $imgTitle=str_replace('_',' ',$imgTitle);

                                            if (empty($parts['extension'])) {
                                                echo '<tr>';
                                                echo '<td>' . $prt . '</td>';
                                               ?>
                                               <td><i class="nav-icon fa fa-folder"></i> <?php echo $images; ?></td>
                                               <td class="btn-group">
                                                <form method="post">
                                                  <input type="hidden" name="folName" value="<?php echo $images; ?>">
                                                  <button type="submit" name="opnFolder" class="btn btn-default btn-xs"><i class="nav-icon fa fa-eye"></i></button>
                                                </form>
                                                <form method="post"><input type="hidden" name="fileName" value="<?php echo $folder . '/' . $images ; ?>"><button type="submit" name="trashimg" class="btn btn-xs btn-danger" onclick="return confirm('Are You Sure!');"><i class="fa fa-trash"></i></button></form></td>
                                                
                                               <?php
                                                echo '</tr>';
                                            }
                                        }
                                        $prt++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>         
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <ul>
                   
                 </ul>
            </div>
        </div>
        </div>
        <!-- /.card -->
    </div>
</section>
<!-- Select2 -->
<div class="modal fade in" id="module_pop">
  <form method="post" enctype="multipart/form-data">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Add Stock Items</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                      <?php
                      echo '<div class="form-group">
                      <label>Module Name</label>
                        <select class="form-control select2bs4" name="moduleName" id="moduleName">';
                        echo "<option>--Select Module--</option>"; 
                      $moduleData=dbAction('permissions',4,'','status=1');
                      if ($moduleData->num_rows>0) {
                        foreach ($moduleData as $moduleRow) {
                          echo '<option value="'.$moduleRow['id'].'">'.$moduleRow['name'].'</option>';
                        }
                      }
                      echo '</select></div>';
                      ?>
                    <span id="assStatus"></span>
                    <div id="assData"></div>
                    <script>
                        $(document).ready(function(){
                         $("#moduleName").change(function(){

                          var moduleName = $('#moduleName').val();
                          $.ajax({
                           url: 'core/dynamic-data.php',
                           type: 'post',
                           data:{moduleName:moduleName},
                           beforeSend: function(){
                            $('#tokenStatus').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
                           },
                           success: function(response){
                            $('#assStatus').empty();
                            $('#assData').html(response);

                            //document.getElementById("assData").innerhtml= response;
                           },
                           complete:function(data){
                            $("#loader").hide();
                           }
                          });
                         
                         });
                        });
                    </script>
                    <?php filesUpload("Uploadfiles"); ?>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-primary" name="filesUpload" value="Upload Files">
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </form>
</div>