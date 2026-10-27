<?php include_once "core/config.php";
if (!IsAdmin()) {
    echo "<script>window.location.href='" . constant("BASE") . "login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php if (isset($_GET['page'])) {
        echo brand.' | '.@$_GET['page'];
    }else{echo brand;}  ?> Administrator</title>
    <!-- Tell the browser to be responsive to screen width -->
    <?php include 'head.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php include 'header.php'; ?>
    <!-- Main Sidebar Container -->
    <?php include 'navbar.php'; ?>
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"><?php echo @$_GET['page']; ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <?php
            if (isset($ModuleKey)) {
                if ($rootPage = opendir('pages')) {

                    while (false !== ($pageLink = readdir($rootPage))) {

                        if ($pageLink != "." && $pageLink != "..") {
                             $pageName=str_replace('.php', '', $pageLink);
                            if ($pageName==$ModuleKey AND $isR==true) {
                            // if ($pageName==$ModuleKey) {
                                include 'pages/'.$pageLink;
                            }
                        }
                    }

                    closedir($rootPage);
                }
            }else{
                //include 'pages/dashboard.php';
                echo "dashboard..";
            }
            ?>
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
    <!-- Main Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>