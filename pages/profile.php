<?php
$id = $_SESSION['id'];
$urlredirect=BASE."admin.php?page=profile";
if (isset($_GET['pEid'])) {
  if (isAdmin()) {
    $id = $_GET['pEid'];
  }
}
?>

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <?php
    if (isset($_SESSION['id'])) {
      if (!empty($_SESSION['id'])) {
        if (isset($_POST['profleUpdate'])) {
          extract($_POST);
          $profileData = array(
            "UserName" => trim(str_replace(' ','',$UserName)),
            "name" => $name,
            "LastName" => $LastName,
            "phone" => $phone,
            "email" => $email
          );
          $data = dbAction('users', 2, $profileData, 'id=' . $id);
          if ($data[0] == 1) {
            echo "<script>alert('User Updated Successfully!')</script>";
            echo "<script>window.location.href='" .$urlredirect. "'</script>";
          } else {
            mgs($data[1], 0);
          }
        }
      } else {
        mgs('Your Session is not Valid!', 0);
      }
    }
    ?>
    <div class="row">
      <div class="col-md-4">
        <?php
        if (isset($_POST['upDp'])) {
          if (!empty($_FILES['dpPic']['name'])) {
            $dpPic = array("profilePic" => imgUpload("dpPic", "teams-dp"));
            $dataUp = dbAction('users', 2, $dpPic, 'id=' . $uid);
            if ($dataUp[0] == 1) {
              // mgs('Updated Successfully!');
              echo "<script>window.location.href='" .$urlredirect. "'</script>";
            } else {
              mgs($dataUp[1], 0);
            }
          }
        }

        ?>
        <?php
        if (isset($_POST['pwdChange'])) {
          extract($_POST);
          $current_password = md5($_POST['current_password']);
          $new_password = md5($_POST['new_password']);
          $confirm_password = md5($_POST['confirm_password']);
          if ($new_password == $confirm_password) {
            $pass_rs = dbAction('users', 4, '', "id ='" . $uid . "'");
            if ($pass_rs->num_rows > 0) {
              $pass_row = $pass_rs->fetch_assoc();
              $db_password = $pass_row['password'];
              if ($current_password == $db_password) {
                $from_data = array(
                  "password" => $new_password
                );
                $data = dbAction('users', 2, $from_data, "id ='" . $uid . "'");
                if ($data[0] == true) {
                  mgs('password change successfully');
                } else {
                  mgs($data[1], 0);
                }
              } else {
                mgs('Old password did not matched!', 0);
              }
            } else {
              mgs('Something went wrong.!', 0);
            }
          } else {
            mgs('New password and confirmed password did not match!', 0);
          }
        }
        ?>
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img src="<?php if (!empty($user_row['profilePic'])) {
                          echo $user_row['profilePic'];
                        } else {
                          echo BASE . "static/admin/dist/img/user2-160x160.jpg";
                        } ?>" class="profile-user-img img-fluid img-circle" alt="User Image">
            </div>

            <h3 class="profile-username text-center"><?php echo ucfirst($user_row['name']); ?></h3>

            <p class="text-muted text-center"><?php if (!empty($user_row['depid'])) {
                                                echo ucfirst(getName('departments', $user_row['depid']));
                                              } else {
                                                echo "NA";
                                              }  ?></p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>User Name</b> <a class="float-right"><?php echo $user_row['UserName']; ?></a>
              </li>
              <li class="list-group-item">
                <b>Email</b> <a class="float-right"><?php echo $user_row['email']; ?></a>
              </li>
              <li class="list-group-item">
                <b>Phone</b> <a class="float-right"><?php echo $user_row['phone']; ?></a>
              </li>
            </ul>

            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#module_pop">Change DP</button>
            <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#module_pwd">Change Password</button>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <div class="col-md-8">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Personal Information</h3>
          </div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group form-group-icon-left">
                    <label>User Name</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user input-icon"></i></span>
                      </div>
                      <input class="form-control" name="UserName" value="<?php echo $user_row['UserName']; ?>" type="text" />
                    </div>

                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-group-icon-left">
                    <label>E-mail</label>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope input-icon"></i></span>
                      </div>
                      <input class="form-control" name="email" value="<?php echo $user_row['email']; ?>" type="email" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-group-icon-left">
                    <label>First Name</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user input-icon"></i></span>
                      </div>
                      <input class="form-control" name="name" value="<?php echo $user_row['name']; ?>" type="text" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-group-icon-left">
                    <label>Last Name</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user input-icon"></i></span>
                      </div>
                      <input class="form-control" name="LastName" value="<?php echo $user_row['LastName']; ?>" type="text" />
                    </div>

                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group form-group-icon-left">
                    <label>Phone Number</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-phone input-icon"></i></span>
                      </div>
                      <input class="form-control" name="phone" value="<?php echo $user_row['phone']; ?>" type="number" />
                    </div>

                  </div>
                </div>
              </div>
              <hr>
              <div class="col-md-12">
                <input type="submit" name="profleUpdate" class="btn btn-primary" value="Save Changes">
              </div>
              <div class="gap"></div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="modal fade in" id="module_pop">
    <form method="post" enctype="multipart/form-data">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Change Dp</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="dpPic">
                    <label class="custom-file-label" for="Image">Choose file</label>
                  </div>
                </div>
                <p><small>Image Should be squire size. example size (400x400 px)</small></p>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <input type="submit" name="upDp" value="Update" class="btn btn-primary">
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </form>
  </div>
  <div class="modal fade in" id="module_pwd">
    <form method="post" enctype="multipart/form-data">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Change Password</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Current Password</label>
                  <input type="password" name="current_password" id="current_password" class="form-control" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>New Password</label>
                  <input type="password" name="new_password" id="new_password" class="form-control" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <input type="submit" name="pwdChange" class="btn btn-primary" value="Change Password">
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </form>
  </div>