<?php

/**
 * Created by PhpStorm.
 * User: sam
 * Date: 2016/10/28
 * Time: 20:31
 */
include ("config.php");

class CheckFormL
{
    protected $name;
    protected $password;

    protected function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function __construct($name,$password){        //构造方法用于传入所需要的信息。
        $name = htmlspecialchars($this->test_input($name));
        $password = htmlspecialchars($this->test_input($password));
        $this->name = $name;
        $this->password = $password;
    }

    protected function checkName(){                                           //用于检查用户名
        if(!empty($name) || !(preg_match('/^\w+$/',$this->name))){
            return false;
        }
        else {
            return true;
        }
    }
    protected function checkPassword() {
        if(!empty($password)){
            return false;
        }
        else {
            return true;
        }
    }

    private function searchSql() {
        header("Content-type: text/html; charset=utf8");
        $start = mysql_connect(DB_ADDRESS, DB_USER, DB_PASSWORD);
        if (!$start){
            echo "<script>alert(\"服务器链接出错\");history.go(-1);</script>"; //
            return false;
        }
        else {
            mysql_select_db(DB_NAME,$start);
            mysql_query("SET NAMES 'UTF8'");
            $sqlsearch = "select * from tuser where username = '{$this->name}' and password = '{$this->password}'";
            mysql_query("$sqlsearch");
            //echo (mysql_error());
            if (mysql_affected_rows()) {
                return true;
            }
            else {
                echo"<script>alert('wrong password or username!');</script>";
                return false;
            }
        }
    }

    public function checkunity() {
        if(!($this->checkName()) || !($this->checkPassword())){        //
            echo"<script>alert('form_error!');history.go(-1);</script>";                                          //   返回其调用页面  
        }
        else{
            if($this->searchSql()){
                echo "<script>alert('login success!')</script>";
                //header("Location:http://www.hsxyhgh.com/inlcudes/register_login.php");
                return true;    //TODO：cookies或者是session 持续登陆？
            }
            else {
                return false;
            }
        }
    }
}

class CheckFormR extends CheckFormL
{
    protected $email;
    protected $timereg;

    protected function setEmail() {
        $this->email = htmlspecialchars($this->test_input($_POST['emailAdd'])); //
    }

    protected function checkEmail()
    {
        if (!(empty($email)) || !(preg_match('/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/', $this->email))) {
            return false;
        } else {
            return true;
        }
    }

    protected function writeSql(){
        header("Content-type: text/html; charset=utf8");
        $start = mysql_connect(DB_ADDRESS, DB_USER, DB_PASSWORD);
        if (!$start){
            echo "<script>alert(\"服务器链接出错\");history.go(-1);</script>"; //
            return false;
        }
        else {
            mysql_select_db(DB_NAME,$start);
            mysql_query("SET NAMES 'UTF8'");
            //echo(mysql_errno());
            $time = time();
            $timereg = date("Y-m-d H:i:s",$time);
            $this->setEmail();
            $sql_user = "insert into tuser (username,Password) values ('$this->name','$this->password')";
            $sql_info = "insert into tuserinfo (RegTime,emailAdd) values ('$timereg','$this->email')";
            //echo (mysql_error());
            mysql_query("$sql_user");
            //echo (mysql_error());
            mysql_query("$sql_info");
            //echo (mysql_error());
            return true;
        }
    }

    public function checkunity() {
        if(!($this->checkName()) || !($this->checkPassword()) ){        //  ||!($this->checkEmail())
            echo"<script>alert(\"reg_checkunity error\");history.go(-1);</script>";                     //   返回其调用页面  
        }
        else{
            if ($this->writeSql()) {
                header("Location:http://www.hsxyhgh.com/inlcudes/register_login.php");
            }
            else {
                echo"<script>history.go(-1);</script>";
            }
            /*
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"http://localhost/register.php");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->postinfo);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            */
        }
    }
}