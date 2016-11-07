<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 2016/11/2
 * Time: 19:48
 */
include ('config.php');    //数据库定义在这
header("Content-type: text/html; charset=utf8");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
    $username = htmlspecialchars(test_input($_POST['username']));       //以post拿到username

    $start = mysql_connect(DB_ADDRESS, DB_USER, DB_PASSWORD);
    mysql_select_db(DB_NAME,$start);
    mysql_query("SET NAMES 'UTF8'");
    $is_user = false;
    $sqlsearch = "select * from tuser where username = '$username'";   //查找是否存在
    $result = mysql_query($sqlsearch);
    //echo (mysql_error());
    if (mysql_affected_rows()) {
        $is_user = true;         //存在返回1
    }
    else {
        $is_user = false;
    }
    echo json_encode($is_user);