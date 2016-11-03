//通用js代码

    //用于判断表单
function name_check() {
    var form_number = document.getElementById("username").value;
    var Regx = /^\w+$/; //[A-Za-z0-9]*$
    var user = $("#username")
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
    var passw = $("#password")
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
        checkcode.removeClass("has-success");
        checkcode.addClass("has-error");
        return false;
    }
    else {
        if (Regx.test(form_number)) {
                checkcode.removeClass("has-error");
                checkcode.addClass("has-success");
                return true;
            }
            else {
                checkcode.removeClass("has-success");
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
var xmlHttp;
//创建Ajax核心对象XMLHttpRequest
function createXMLHttp(){
    if(window.XMLHttpRequest){
        xmlHttp = new XMLHttpRequest();
    }else{
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function checkUsername(username){
    createXMLHttp();

//设置请求方式为GET，设置请求的URL，设置为异步提交
    xmlHttp.open("GET","../mc/inlcudes/searchname.php?username="+username ,true);

//将方法地址复制给onreadystatechange属性
//类似于电话号码
    xmlHttp.onreadystatechange = checkUsernameCallback();
//将设置信息发送到Ajax引擎
    xmlHttp.send(null);
}

function checkUsernameCallback(){
//Ajax引擎状态为成功
    if(xmlHttp.readyState == 4){
//HTTP协议状态为成功
        if(xmlHttp.status == 200){
            var text = xmlHttp.responseText;
            if(text == 1){
                $["#username"].removeClass("has-error");
                $["#username"].addClass("has-success");
                $["#conflict_name"].removeClass("sp_show");
                return true;
            }else{
                $["#username"].removeClass("has-success");
                $["#username"].addClass("has-error");
                $["#conflict_name"].addClass("sp_show");
                return false;
            }
        }
    }
}

function checkform_register(){
    if(!name_check() || !passw_check() || !checkcode_check() || !email_check() || !conf_passw_check() || !checkUsername())
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


