//通用js代码

    //用于判断表单
function name_check() {
    var form_number = document.getElementById("username").value;
    var Regx = /^\w+$/; //[A-Za-z0-9]*$
    var user = $("#username");
    if(form_number.length == 0) {
        user.removeClass("has-success");
        user.addClass("has-error");
        return false;
    }
    else {
        if (Regx.test(form_number)) {
                user.removeClass("has-error");
                user.addClass("has-success");
                return true;
            }
            else {
                user.removeClass("has-success");
                user.addClass("has-error");
                return false;
            }
    }
}

function passw_check() {
    var form_number = document.getElementById("password").value;
    var passw = $("#password");
    if(form_number.length == 0) {
        passw.removeClass("has-success");
        passw.addClass("has-error");
        return false;
    }
    else {
        if (form_number.length >= 6) {
                passw.removeClass("has-error");
                passw.addClass("has-success");
                return true;
            }
            else {
                passw.removeClass("has-success");
                passw.addClass("has-error");
                return false;
            }
    }
}

function checkcode_check() {
    var form_number = document.getElementById("checkcode").value;
    var Regx = /^\w+$/; //[A-Za-z0-9]*$
    var checkcode = $("#checkcode")
    if(form_number.length != 4) {
        checkcode.removeClass("has-warning");
        checkcode.addClass("has-error");
        return false;
    }
    else {
        if (Regx.test(form_number)) {
                checkcode.removeClass("has-error");
                checkcode.addClass("has-warning");
                return true;
            }
            else {
                checkcode.removeClass("has-warning");
                checkcode.addClass("has-error");
                return false;
            }
    }
}

function email_check() {
    var form_number = document.getElementById("email").value;
    var Regx = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    var passw = $("#email")
    if(form_number.length == 0) {
        passw.removeClass("has-success");
        passw.addClass("has-error");
        return false;
    }
    else {
        if (Regx.test(form_number)) {
                passw.removeClass("has-error");
                passw.addClass("has-success");
                return true;
            }
            else {
                passw.removeClass("has-success");
                passw.addClass("has-error");
                return false;
            }
    }
}


function conf_passw_check(){
    var form_number = document.getElementById("password").value;
    var conf_form_number = document.getElementById("conf_password").value;
    var conf_pass = $("#conf_password");
    if(form_number.length == 0) {
        passw.removeClass("has-success");
        passw.addClass("has-error");
        return false;
    }
    else {
        if (form_number == conf_form_number) {
                conf_pass.removeClass("has-error");
                conf_pass.addClass("has-success");
                return true;
            }
            else {
                conf_pass.removeClass("has-success");
                conf_pass.addClass("has-error");
                return false;
            }
    }
}

//login页面需要的代码
function checkform(){
            if(!name_check() || !passw_check() || !checkcode_check())
            {
                $("#submit_btn").attr("disabled","disabled"); 
                $("#submit_btn").addClass("btn-danger");
            }
            else{ 
                $("#submit_btn").removeAttr("disabled"); 
                $("#submit_btn").removeClass("btn-danger");
            }
         }

function setHeight(){
            if(document.body.clientWidth < 990){
                document.getElementById("left").style.height = 200+"px";
                document.getElementById("right").style.height = "auto";
            }
            else{
                
                if(document.getElementById("right").offsetHeight < document.documentElement.clientHeight){
                    document.getElementById("left").style.height = document.documentElement.clientHeight + "px";
                }
                else {
                    document.getElementById("left").style.height = document.getElementById("right").offsetHeight + "px";
                }
            }
         }       

//register 页面需要的代码
function checkUserConflict() { //TODO: 修复这个函数
    var username = document.getElementById("username").value;     //input的值赋值给username
    var p = $("#conflict_name");
    /*
    var xmlhttp;

    if (window.XMLHttpRequest)          //创建xmlhttprequest对象
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }


    alert(username);
    xmlhttp.open("POST","../includes/searchname.php");
    xmlhttp.setRequestHeader("Content-type","text/html; charset=UTF-8");
    xmlhttp.send('username='+username);                         //以post发送username
    xmlhttp.onreadystatechange = function () {          //发送这个信息
        if(xmlhttp.readyState==4 && xmlhttp.status===200){ //服务器是否ok
            if(xmlhttp.status==1){          //用户名冲突的情况
                p.removeClass("sp_hide");
                return false;
            }
            else { //用户名OK的情况
                alert('11');
                p.addClass("sp_hide");
                return true;
            }
        }
        else{
            alert("222");
            return false;
        }
    }
    */
    $.ajax({
        type: "POST",
        datatype : "json",
        url : "../includes/searchname.php",
        data:{username:username},
        success:function(data){
            if(data=='true'){
                $("#username").removeClass("has-success");
                $("#username").addClass("has-error");
                p.removeClass("sp_hide"); //用户名已经存在
                p.attr("sign",false);
                return false;
            }
            else{
                $("#username").removeClass("has-success");
                $("#username").removeClass("has-error");
                p.addClass("sp_hide");      //用户名不存在
                p.attr("sign",true);
                return true;
            }
        }
    });
}

function checkUserConf() {
    if($("#conflict_name").attr("sign")=="true"){
        return true;
    }
    else {
        return false;
    }
}

function checkform_register(){
    if(!name_check() || !passw_check() || !checkcode_check() || !email_check() || !conf_passw_check() || !checkUserConf()) // || !checkUserConflict()
            {
                $("#submit_btn").attr("disabled","disabled");
                $("#submit_btn").addClass("btn-danger");
                $("#success-form").removeClass("sp_show");
                $("#error-form").addClass("sp_show");
            }
            else{ 
                $("#submit_btn").removeAttr("disabled"); 
                $("#submit_btn").removeClass("btn-danger");
                $("#error-form").removeClass("sp_show");
                $("#success-form").addClass("sp_show");
            }
}


