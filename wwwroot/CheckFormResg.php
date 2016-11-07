<?php

/**
 * Created by PhpStorm.
 * User: sam
 * Date: 2016/10/28
 * Time: 14:22
 */
include ("includes/CheckFormL.php");

$checkformreg = new CheckFormR($_POST['username'],$_POST['password'],$_POST['checkcode']);
$checkformreg->checkunity();