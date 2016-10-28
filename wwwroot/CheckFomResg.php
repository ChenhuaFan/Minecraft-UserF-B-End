<?php

/**
 * Created by PhpStorm.
 * User: sam
 * Date: 2016/10/28
 * Time: 14:22
 */
class CheckFomResg extends LoginCheckForm
{
    public function checkunity() {
        if(!($this->checkName()) || !($this->checkPassword()) || !($this->checkEmail())){        //
            echo"<script>alert('form_error!');history.go(-1);</script>";                     //   返回其调用页面  
        }
        else{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"http://localhost/public/register.php");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->postinfo);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        }
    }
}

$checkformreg = new CheckFomResg($_POST['username'],$_POST['password'],$_POST['emailAdd'],$_POST);
$checkformreg->checkunity();