<?php/**
 * Created by PhpStorm.
 * User: sam
 * Date: 2016/11/1
 * Time: 23:52
 */?>
<?php include ("includes/config.php");?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>注册成功</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background-color: #f4f4f4;">
<div style="width: 90%; margin: auto; padding-top: 10rem; text-align:center ; line-height: 2rem;">
    <h1 style="font-size: 10rem; color: #7fba00;"><span class="glyphicon glyphicon-ok-sign"></span></h1>
    <h3>恭喜您，注册成功</h3>
    <p style="padding: 1rem; font-size: 1.8rem;">现在起，您可以使用您的用户名登陆MagicWorld服务器或者您的个人主页。</p>
    <P>您的浏览器将会在<span id="time"></span>秒后转跳到主页，如果您的浏览器没有任何反应，请单击<a href="index.html">这里</a>来返回主页</P>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script>
    var i = 6;
    function jump() {
        var time = document.getElementById("time");
        i--;
        time.innerHTML = i;
        if (i < 0) {
            location.href = '../login.html';
            clearInterval(inter);
        }
    }
    var inter = setInterval("jump()",1000);
</script>
</body>
</html>