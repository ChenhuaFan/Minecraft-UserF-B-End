<?php

/**
 * Created by PhpStorm.
 * User: sam
 * Date: 2016/10/28
 * Time: 10:53
 */
include ("inlcudes/CheckFormL.php");

$checkform = new CheckFormL($_POST['username'],$_POST['password'],$_POST);
$checkform->checkunity();
?>