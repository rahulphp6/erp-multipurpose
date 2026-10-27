<?php
if ($isW)
  if (isset($_GET['depEid'])) {
    if (!$isE) {
      echo "<script>alert('Invalid Permission Area!')</script>";
      //echo "<script>window.location.href='" . constant("BASE") . "'</script>";
    }
    $assetEid = $_GET['depEid'];
    $assetRow = dbAction('departments', 4, '', 'id=' . $assetEid);
    $assetRow = $assetRow->fetch_assoc();
  }
?>
<?php
if ($isD) {
  if (isset($_POST['deleteRun'])) {
    $delId = $_POST['depDid'];
    $deleteRun = dbAction('departments', 3, '', 'id=' . $delId);
    if ($deleteRun[0] == 1) {
      echo "<script>alert('Deleted Successfully!')</script>";
      echo "<script>window.location.href='" . constant("BASE") . "?page=departments'</script>";
    } else {
      mgs($deleteRun[1], 0);
    }
  }
}
?>
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <?php
        if (isset($_POST['addDepartment'])) {
          $date = array("date" => date("Y-m-d h:i:s"));
          $post = array_merge($_POST, $date);
          unset($post['addDepartment']);
          $deparment = dbAction('departments', 1, $post);
          if ($deparment[0] == 1) {
            mgs('Department Add Successfully!', 1);
          } else {
            mgs($deparment[1], 0);
          }
        }
        if (isset($_POST['upDepartment'])) {
          $date = array("date" => date("Y-m-d h:i:s"));
          $post = array_merge($_POST, $date);
          unset($post['upDepartment']);
          $deparment = dbAction('departments', 2, $post, 'id=' . $assetEid);
          if ($deparment[0] == 1) {
            mgs('Department Updated Successfully!', 1);
            echo "<script>window.location.href='" . constant("BASE") . "admin.php?page=departments'</script>";
          } else {
            mgs($deparment[1], 0);
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
            <h3 class="card-title">Departments Detail</h3>
            <button type="button" class="btn btn-primary btn-xs pull-right" style="float: right;" data-toggle="modal" data-target="#module_pop"><i class="fa fa-plus"></i> Add Department</button>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped" id="example1">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Action</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Status</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $departmentsQ = dbAction('departments', 4);
                if ($departmentsQ->num_rows > 0) {
                  foreach ($departmentsQ as $departmentsRow) { ?>
                    <tr>
                      <td><?php echo $departmentsRow['id']; ?></td>
                      <td>
                        <div class="btn-group">
                          <?php
                          if ($isE) echo '<a href="?page=departments&depEid=' . $departmentsRow['id'] . '&model=1" class="btn btn-primary btn-xs"><i class="fa fa-edit nav-icon"></i></a>';
                          if ($isD) { ?>
                            <form method="post" class="btnForm">
                              <input type="hidden" name="depDid" value="<?php echo $departmentsRow['id']; ?>">
                              <button type="submit" title="Delete this record" onclick="return confirm('Are You Sure?')" name="deleteRun" class="btn btn-danger btn-xs"><i class="fa fa-trash nav-icon"></i></button>
                            </form>
                          <?php } ?>
                        </div>
                      </td>
                      <td><?php echo $departmentsRow['name']; ?></td>
                      <td><?php echo $departmentsRow['date']; ?></td>
                      <td><?php if ($departmentsRow['status']) {
                            echo "Active";
                          } else {
                            echo "InActive";
                          } ?></td>


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

<div <?php if (isset($assetEid)) {
        echo 'class="modal fade in show" style="display:block" id="module_pop_"' . $assetEid . ' aria-modal="true"';
      } else {
        echo 'class="modal fade in" id="module_pop"';
      } ?>>
  <form method="post">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Department</h4>
          <?php if (isset($assetEid)) {
            echo '<a href="?page=departments" class="close">x</a>';
          } else {
            echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>';
          } ?>

        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group form-group-icon-left">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-tasks input-icon"></i></span>
                  </div>
                  <input class="form-control" name="name" placeholder="department name" type="text" required value="<?php if (isset($assetEid)) {
                                                                                                                      echo $assetRow['name'];
                                                                                                                    } ?>" />
                </div>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                  <option value="1">Active</option>
                  <option value="0">InActive</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">

          <?php if (isset($assetEid)) {
            echo '';
          } else {
            echo '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>';
          } ?>
          <input type="submit" <?php if (isset($assetEid)) {
                                  echo 'name="upDepartment" value="Update Department"';
                                }
                                echo 'name="addDepartment" value="Add Department"'; ?> class="btn btn-primary">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>