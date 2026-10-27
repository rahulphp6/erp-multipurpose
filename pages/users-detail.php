<section class="content">
  <div class="container-fluid">
    <?php
    if ($isW)
      if (isset($_GET['Eid'])) {
        if (!$isE) {
          echo "<script>alert('Invalid Permission Area!')</script>";
        }
        $empEid = $_GET['Eid'];
        $empRow = dbAction('users', 4, '', 'id=' . $empEid);
        $empRow = $empRow->fetch_assoc();
      }
    ?>
    <?php
    if ($isD) {
      if (isset($_POST['deleteRun'])) {
        $delId = $_POST['userDid'];
        $deleteRun = dbAction('users', 3, '', 'id=' . $delId);
        if ($deleteRun[0] == 1) {
          echo "<script>alert('Deleted Successfully!')</script>";
          echo "<script>window.location.href='admin.php?page=users-detail'</script>";
        } else {
          mgs($deleteRun[1], 0);
        }
      }
    }
    ?>
    <?php
    if (isset($_POST['addUser'])) {
      $email = explode('@', $_POST['email']);
      $username = array("UserName" => $email[0], "password" => md5('emp@123'));
      $data = array_merge($_POST, $username);
      unset($data['addUser']);
      array_values($data);
      //print_r($data);
      $usersData = dbAction('users', 1, $data);
      if ($usersData[0] == 1) {
        mgs('User Has Been Added');
      } else {
        mgs($usersData[1], 0);
      }
    }

    if (isset($_POST['upUser'])) {
      $date = array("date" => date("Y-m-d h:i:s"));
      $post = array_merge($_POST, $date);
      unset($post['upUser']);
      $userQ = dbAction('users', 2, $post, 'id=' . $empEid);
      if ($userQ[0] == 1) {
        mgs('User Updated Successfully!', 1);
        echo "<script>window.location.href='" . constant("admin") . "admin.php?page=users-detail'</script>";
      } else {
        mgs($userQ[1], 0);
      }
    }
    ?>
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Users Detail</h3>
            <button type="button" class="btn btn-primary btn-xs pull-right" style="float: right;" data-toggle="modal" data-target="#module_pop"><i class="fa fa-plus"></i> Add New</button>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#ID</th>
                  <th>Action</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Role</th>
                  <th>Date</th>

                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($_POST['Block'])) {
                  statusChange($_POST['status'], "users", $_POST['id']);
                }
                $users = dbAction('users', 4, "", "role>=2");
                if ($users->num_rows > 0) {
                  $authKey = 1;
                  foreach ($users as $userData) { ?>
                    <tr>
                      <td title="<?php echo $userData['EndUserIp']; ?>"><?php echo $userData['id']; ?></td>
                      <td>
                        <?php if ($userData['status'] == 1) {
                          // echo "<span class='fa fa-circle text-success'></span>";
                          $block = "name='Block' value='Block' class='btn btn-danger btn-xs' title='you can block this user'";
                        } else {
                          // echo "<span class='fa fa-circle text-danger'></span>";
                          $block = "name='Block' value='UnBlock' class='btn btn-success btn-xs' title='you can unblock this user'";
                        } ?>
                        <form method="post" style="float: left;margin-right: 5px">
                          <input type="hidden" name="id" value="<?php echo $userData['id']; ?>">
                          <input type="hidden" name="status" value="<?php echo $userData['status']; ?>">
                          <button type="submit" <?php echo $block; ?>><i class="fa fa-ban nav-icon"></i></button>
                        </form>

                        <div class="btn-group">
                          <?php
                          if ($isE) echo '<a href="?page=users-detail&Eid=' . $userData['id'] . '&model=1" class="btn btn-primary btn-xs"><i class="fa fa-edit nav-icon"></i></a>';
                          if ($isD) { ?>
                            <form method="post" class="btnForm">
                              <input type="hidden" name="userDid" value="<?php echo $userData['id']; ?>">
                              <button type="submit" title="Delete this record" onclick="return confirm('Are You Sure?')" name="deleteRun" class="btn btn-danger btn-xs"><i class="fa fa-trash nav-icon"></i></button>
                            </form>
                          <?php }
                          ?>
                        </div>
                      </td>
                      <td><?php echo $userData['name'] . " " . $userData['last_name']; ?></td>
                      <td><?php echo $userData['email']; ?></td>
                      <td><?php echo $userData['phone']; ?></td>
                      <td><i class="fa fa-user-secret"></i> <?php getName("roles", $userData['role']); ?></td>
                      <td><?php echo $userData['date']; ?></td>

                    </tr>
                <?php  }
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
</section>
<div <?php if (isset($empEid)) {
        echo 'class="modal fade in show" style="display:block" id="module_pop_' . $empEid . '"';
      } else {
        echo 'class="modal fade in" id="module_pop"';
      } ?>>
  <div class="modal-dialog modal-lg">
    <div class="modal-content" <?php if (isset($empEid)) {
                                  echo 'style="height: 500px; overflow:auto"';
                                } ?>>
      <div class="modal-header">
        <h4>Employee Management</h4>
        <?php if (isset($empEid)) {
          echo '<a href="?page=users-detail" class="close">x</a>';
        } else {
          echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>';
        } ?>

      </div>
      <form method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <?php if (isset($empEid)) {
                elements("depid", "departments", $empRow['depid']);
              } else {
                elements("depid", "departments");
              } ?>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group form-group-icon-left">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope input-icon"></i></span>
                      </div>
                      <input class="form-control" name="email" placeholder="employee email" type="email" required value="<?php if (isset($empEid)) {
                                                                                                                            echo $empRow['email'];
                                                                                                                          } ?>" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-group-icon-left">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-phone input-icon"></i></span>
                      </div>
                      <input class="form-control" value="<?php if (isset($empEid)) {
                                                            echo $empRow['phone'];
                                                          } ?>" name="phone" placeholder="Phone Number" type="number" />
                    </div>

                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-group-icon-left">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user input-icon"></i></span>
                      </div>
                      <input class="form-control" value="<?php
                                                          if (isset($empEid)) {
                                                            echo $empRow['name'];
                                                          } ?>" name="name" placeholder="First Name" type="text" required />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-group-icon-left">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user input-icon"></i></span>
                      </div>
                      <input class="form-control" value="<?php
                                                          if (isset($empEid)) {
                                                            echo $empRow['last_name'];
                                                          } ?>" name="last_name" placeholder="Last Name" type="text" />
                    </div>

                  </div>
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
          <input type="submit" <?php if (isset($empEid)) {
                                  echo 'name="upUser" value="Update"';
                                }
                                echo 'name="addUser" value="Add"'; ?> class="btn btn-primary">
          <?php if (isset($empEid)) {
            echo '<a href="?page=users-detail" class="close">Close</a>';
          } else {
            //echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">Close</button>';
          } ?>
        </div>
      </form>
    </div>
  </div>
</div>