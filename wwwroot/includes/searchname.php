<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 2016/11/2
 * Time: 19:48
 */
include ('config.php');

function searchname() {
    $username = $_GET['username'];
    header("Content-type: text/html; charset=utf8");
    $start = mysql_connect(DB_ADDRESS, DB_USER, DB_PASSWORD);
    if (!$start){
        return 0;
    }
    else {
        mysql_select_db(DB_NAME,$start);
        mysql_query("SET NAMES 'UTF8'");
        $sqlsearch = "select * from tuser where username = '{$this->name}'";
        mysql_query("$sqlsearch");
        //echo (mysql_error());
        if (mysql_affected_rows()) {
            return 1;
        }
        else {
            return 0;
        }
    }
}