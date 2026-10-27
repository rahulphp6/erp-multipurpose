<?php

include('core/config.php');
unset($_SESSION["role"]);
unset($_SESSION["user_name"]);
unset($_SESSION["id"]);
unset($_SESSION["email"]);
session_destroy();
echo "<script>window.location.href='" . constant("BASE") . "login.php'</script>";
?>