<?php
include_once "core/config.php";
if (!isUser()) {
    echo "<script>window.location.href='" . constant("BASE") . "login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php if (isset($_GET['page'])) {
                echo brand . ' | ' . @$_GET['page'];
            } else {
                echo brand;
            }  ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <?php include 'head.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed <?php if (@$_GET['model'] == 1) {
                                                            echo 'modal-open';
                                                        } ?>">
    <?php include 'header.php'; ?>
    <!-- Main Sidebar Container -->
    <?php include 'navbar.php'; ?>
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <div class="row">

                        <?php
                        if (isset($_GET['page'])) {
                            $bridPage = $_GET['page']; ?>
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"><?php echo $bridPage; ?></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo BASE; ?>">Home</a></li>
                                    <li class="breadcrumb-item active"><?php echo $bridPage; ?></li>
                                </ol>
                            </div>
                        <?php } else {

                            $notes = dbAction('notes', 4, '', 'status=1');
                            if ($notes->num_rows > 0) {
                                $notes = $notes->fetch_assoc();
                            } ?>
                            <div class="col-sm">
                                <div class="callout callout-info">
                                    <!-- <p><?php echo $notes['heading']; ?></p> -->
                                    <p><small><?php echo $notes['description']; ?></small></p>
                                </div>
                            </div>
                        <?php } ?>


                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <?php
            if (isset($ModuleKey)) {
                if ($rootPage = opendir('users')) {

                    while (false !== ($pageLink = readdir($rootPage))) {

                        if ($pageLink != "." && $pageLink != "..") {
                            $pageName = str_replace('.php', '', $pageLink);
                            if (strtolower($pageName) == $ModuleKey and $isR == true) {
                                // if ($pageName==$ModuleKey) {
                                include 'users/' . $pageLink;
                            }
                        }
                    }

                    closedir($rootPage);
                }
            } else {
                include 'users/dashboard.php';
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