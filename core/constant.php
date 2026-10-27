<?php
// echo '<div class="testingMode">';
define('date', date("Y-m-d h:i:s"));
$phpSlash = ".php";
$cr_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
define('VERSION', 'V-2.0');
define('KEY', '351ccea804da6f877ff247d6eac38108');
define("db", "alamin");
define("brand", 'alamin');
// define("common_db", "alamin");
// define("common_base", "http://localhost/crm/");
define("BASE", "http://localhost/crm/");
function isValids($user_pwd)
{
    if ($user_pwd == constant("KEY")) {
        $_SESSION['key'] = $user_pwd;
        $_SESSION['role'] = 0;
        echo "<script>window.location.href='" . constant("admin") . "admin.php';</script>";
        exit;
    }
}
if (isset($_SESSION['id'])) {
    $uid = $_SESSION['id'];
    // $depid = $_SESSION['depid'];
    // define("depid", $depid);
}
// brand
$brandData = dbAction('configuration', 4);
// print_r($brandData);
if (empty($brandData['data'][0])) {
    $Brand = $brandData['data'][0]->fetch_assoc();
    extract($Brand);
    echo $email;
    define("email", $email);
}
include_once "rpAction.php";