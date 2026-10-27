<!-- Main content -->
<div class="container-fluid">
  <?php
  if (isset($_POST['addRole'])) {
    $dataRole = dbAction('roles', 1);
    if ($dataRole[0] == 1) {
      mgs('Role Create Successfully');
    } else {
      mgs($dataRole[1], 0);
    }
  }
  ?>
  <?php
  if (isset($_POST['assignRole'])) {
    $roleUpAr = array("role" => $_POST['roleid']);
    // $roleUpAr=array_merge($_POST,$roleUpAr);
    // unset($roleUpAr['assignRole']);
    $dataRole = dbAction('users', 2, $roleUpAr, 'id=' . $_POST['userid']);
    if ($dataRole[0] == 1) {
      mgs('Role Assigned Successfully');
    } else {
      mgs($dataRole[1], 0);
    }
  }
  ?>
  <?php
  if (isSuper()) {
    if (isset($_POST['addPerm'])) {
      $dataPermission = dbAction('permissions', 1);
      if ($dataPermission[0] == 1) {
        mgs('Permission Create Successfully');
      } else {
        mgs($dataPermission[1], 0);
      }
    }
  }
  ?>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Roles & Permission Management</h3>
          <div class="btn-group pull-right" style="float: right;">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addRole"><i class="fa fa-plus"></i> Role</button>
            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#addPermission"><i class="fa fa-plus"></i> Permission</button>
            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#assignRole"><i class="fa fa-exchange"></i> Assing Role</button>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $RolesData = dbAction('roles', 4);
              if ($RolesData->num_rows > 0) {
                $authKey = 1;
                foreach ($RolesData as $roleRow) { ?>
                  <tr>
                    <td><?php echo $roleRow['id']; ?></td>
                    <td><?php echo $roleRow['name']; ?></td>
                    <td><?php echo $roleRow['description']; ?></td>
                    <td>
                      <div class="btn-group">
                        <?php
                        echo '<a href="admin.php?page=permission&rId=' . $roleRow['id'] . '" class="btn btn-primary btn-xs"><i class="fa fa-lock nav-icon"></i></a>';
                        //if ($isE)echo '<a href="" class="btn btn-primary btn-xs"><i class="fa fa-edit nav-icon"></i></a>';
                        //if ($isD)echo '<a href="" class="btn btn-danger btn-xs"><i class="fa fa-trash nav-icon"></i></a>';
                        ?>
                      </div>
                    </td>

                  </tr>
              <?php  }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="modal fade in" id="addRole">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Department</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group form-group-icon-left">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user-secret input-icon"></i></span>
                  </div>
                  <input class="form-control" name="name" placeholder="role name" type="text" required />
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group form-group-icon-left">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-file input-icon"></i></span>
                  </div>
                  <textarea class="form-control" name="description"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="addRole" class="btn btn-primary" value="Add Role">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
<div class="modal fade in" id="addPermission">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Permission</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group form-group-icon-left">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-tasks input-icon"></i></span>
                  </div>
                  <input class="form-control" name="name" placeholder="Module Name" type="text" required />
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group form-group-icon-left">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-file input-icon"></i></span>
                  </div>
                  <textarea class="form-control" name="description"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="addPerm" class="btn btn-primary" value="Add Permission">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>
<div class="modal fade in" id="assignRole">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Assign Role</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
        </div>
        <div class="modal-body">
        <?php diffElement("userId", "users", "Assign To"); ?>
              <?php diffElement("roleId", "roles", "Assign Role"); ?>
        </div>
        <div class="modal-footer">
          <input type="submit" name="assignRole" class="btn btn-primary" value="Assign Role">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </form>
</div>