<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 2016/11/6
 * Time: 20:49
 */
include "includes/config.php";
session_destroy();
unset($_SESSION["username"]);
echo "<script>location.href='login.html'</script>";