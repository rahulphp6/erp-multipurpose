<?php
if (isset($_GET['page'])) {
    $ModuleKey=strtolower($_GET['page']);
    $pageModeName=explode('-', $ModuleKey);
}
// echo '<div class="testingMode">';
 if (isset($pageModeName[0])) {
    if (isSuper() or isAdmin()) {
        $isR=1;
        $isW=1;
        $isE=1;
        $isD=1;
    }else{
       $checkPerm=isPermMode($roleID,$pageModeName[0]);
       if (!empty($checkPerm)) {
        //print_r($checkPerm);
            $isR=$checkPerm[0];
            $isW=$checkPerm[1];
            $isE=$checkPerm[2];
            $isD=$checkPerm[3];
       }else{
        echo "<script>alert('Invalid page enter!')</script>";
        //echo "<script>window.location.href='" . constant("BASE") . "'</script>";
       }
         
    }
    
  } 
// echo "</div>";
include_once("inc/elements/elements.php");

$data_user = dbAction('users', 4, "", "id = ".$uid);
if (empty($brandData['data'][0])) {
    $user_row = $brandData['data'][0]->fetch_assoc();
    extract($user_row);
} ?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="?page=profile" class="nav-link">Profile</a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="?page=news" class="nav-link">News</a>
        </li> -->
        <li class="nav-item d-none d-sm-inline-block">
            <a href="job-log.php" class="nav-link" target="_blank">Jobs</a>
        </li>
    </ul>
    
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <?php //if (isAdmin()) {include_once'inc/html/notis-admin.php';}else{include_once'inc/html/notis.php';} ?>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="<?php if (!empty($user_row['profilePic'])) {
                          echo $user_row['profilePic'];
                        } else {
                          echo "dist/img/user2-160x160.jpg";
                        } ?>" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline"><?php echo ucfirst($user_row['name']); ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="<?php if (!empty($user_row['profilePic'])) {
                    echo $user_row['profilePic'];
                  } else {
                    echo "dist/img/user2-160x160.jpg";
                  } ?>" class="img-circle elevation-2" alt="User Image">

                    <p>
                    <?php echo ucfirst($user_row['name']); ?> - <?php if (!empty($user_row['userType'])) {
                       echo ucfirst(getRow('usertype',$user_row['userType'],'type'));
                    }else{echo "NA";}  ?>
                        <small>Member since <?php echo dateFormate($user_row['date'],'m-Y'); ?></small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="?page=profile" class="btn btn-default btn-flat">Profile</a>
                    <a href="logout.php" class="btn btn-default btn-flat float-right">Sign out</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
