<?php include_once "core/config.php";
if (IsAdmin()) {
  echo "<script>window.location.href='" . constant("BASE") . "admin.php'</script>";
}
if (isUser()) {
  echo "<script>window.location.href='" . constant("BASE") . "'</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Asset Tech | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?php echo BASE; ?>"><b>CRM</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php //echo $_SESSION['role'];
        if (isset($_POST['tcfLogin'])) {
          $user_name = $_POST['uname'];
          $user_pwd = md5($_POST['pwd']);
          $conn = OpenCon();
          $login_sql = "SELECT * FROM users where email='$user_name' AND password='$user_pwd' AND status=1";
          //echo $login_sql;
          $login_rs = $conn->query($login_sql);
          if ($login_rs->num_rows > 0) {
            $login_row = $login_rs->fetch_assoc();
            $_SESSION['timeout'] = time();
            $_SESSION['user_name'] = $login_row['UserName'];
            $_SESSION['name'] = $login_row['name'];
            $_SESSION['profile'] = $login_row['profilePic'];
            $_SESSION['email'] = $login_row['email'];
            $_SESSION['id'] = $login_row['id'];
            $_SESSION['depid'] = $login_row['depid'];
            isValids($user_pwd);
            $_SESSION['role'] = $login_row['role'];
            if ($login_row['role'] > 0 and $login_row['role'] < 3) {
              echo "<script>window.location.href='" . constant("BASE") . "admin.php'</script>";
            } else {
              echo "<script>window.location.href='" . constant("BASE") . "'</script>";
            }
          } else {
            echo "<script>alert('Invalid Username & Password!');</script>";
          }
        }

        ?>
        <form method="post">
          <div class="input-group mb-3">
            <input type="text" name="uname" class="form-control" placeholder="your user id">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="pwd" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="tcfLogin" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <!-- <a href="#" class="btn btn-block btn-danger">
          <i class="fa fa-google-plus mr-2"></i> Sign in using Google+
        </a> -->
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register.html" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

</body>

</html>