<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
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
                          //echo '<a href="admin.php?page=permission&rId='.$roleRow['id'].'" class="btn btn-primary btn-xs"><i class="fa fa-lock nav-icon"></i></a>';
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

      <div class="col-md-4">
        <div class="card">
          <div class="card-body">

            <?php
            if (isset($_POST['assignRole'])) {
              $roleUpAr = array("depid" => $_POST['depid']);
              $dataRole = dbAction('users', 2, $roleUpAr, 'id=' . $_POST['userid']);
              if ($dataRole[0] == 1) {
                mgs('Department Assigned Successfully');
              } else {
                mgs($dataRole[1], 0);
              }
            }
            ?>
            <h5><i class="fa fa-exchange input-icon"></i> Assign Department</h5>
            <hr>
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <?php diffElement("userId", "users", "User"); ?>
                </div>
                <div class="col-md-12">
                  <?php elements("depid", "departments"); ?>
                </div>
                <div class="col-md-12">
                  <input type="submit" name="assignRole" class="btn btn-primary" value="Assign Department">
                </div>
              </div>
            </form>
          </div>
        </div>
        <?php if (isSuper() and isModCheck('pro')) { ?>
          <div class="card">
            <div class="card-body">
              <?php
              if (isset($_POST['addPerm'])) {
                $dataPermission = dbAction('permissions', 1);
                if ($dataPermission[0] == 1) {
                  mgs('Permission Create Successfully');
                } else {
                  mgs($dataPermission[1], 0);
                }
              }
              ?>
              <h5><i class="fa fa-keys input-icon"></i> Add Permission</h5>
              <hr>
              <form method="post" enctype="multipart/form-data">
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
                  <div class="col-md-12">
                    <input type="submit" name="addPerm" class="btn btn-primary" value="Add Permission">
                  </div>
                  <div class="gap"></div>
                </div>
              </form>
            </div>
          <?php } ?>
          </div>
      </div>

      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>