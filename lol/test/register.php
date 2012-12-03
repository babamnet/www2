<?

// Страница регситрации нового пользователя


# Соединямся с БД
include "config.php";
mysql_connect($host , $db_login, $db_password);

mysql_select_db($db_name);



if(isset($_POST['submit']))

{

    $err = array();


    # проверям логин

    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))

    {

        $err[] = "Логин может состоять только из букв английского алфавита и цифр";

    }

    

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)

    {

        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";

    }

    

    # проверяем, не сущестует ли пользователя с таким именем

    $query = mysql_query("SELECT COUNT(user_id) FROM wc__superusers WHERE user_login='".mysql_real_escape_string($_POST['login'])."'");

    // if(mysql_result($query, 0) > 0)

    // {

    //     $err[] = "Пользователь с таким логином уже существует в базе данных";

    // }

    # Если нет ошибок, то добавляем в БД нового пользователя

    if(count($err) == 0)

    {

        
        $login = $_POST['login'];

        

        # Убераем лишние пробелы и делаем двойное шифрование

        $password = $_POST['password'];

        $email = $_POST['email'];

        mysql_query("INSERT INTO wc__superusers SET user_login='".$login."', user_password='".$password."', user_email='".$email."'");

        header("Location: hello.php"); exit();

    }

    else

    {

        print "<b>При регистрации произошли следующие ошибки:</b><br>";

        foreach($err AS $error)

        {

            print $error."<br>";

        }

    }

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Untitled Page</title>
<meta name="generator" content="Quick 'n Easy Web Builder Trial Version - http://www.quickandeasywebbuilder.com">
<style type="text/css">
div#container
{
   width: 564px;
   position: relative;
   margin-top: 0px;
   margin-left: auto;
   margin-right: auto;
   text-align: left;
}
body
{
   text-align: center;
   margin: 0;
   background-color: #FFFFFF;
   background-image: url(images/shattered.png);
   color: #000000;
}
</style>
<style type="text/css">
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
p, span, div, ol, ul, li, input, textarea, form
{
   margin: 0;
   padding: 0;
}
ol, ul
{
   list-style-position:inside;
}
</style>
<style type="text/css">
#wb_Form1
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#Editbox2
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Editbox1
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Editbox3
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Editbox4
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#wb_Text1
{
   background-color: transparent;
   border: 0px #C0C0C0 solid;
}
#wb_Text2
{
   background-color: transparent;
   border: 0px #C0C0C0 solid;
}
#wb_Text3
{
   background-color: transparent;
   border: 0px #C0C0C0 solid;
}
#wb_Text4
{
   background-color: transparent;
   border: 0px #C0C0C0 solid;
}
#wb_Text5
{
   background-color: transparent;
   border: 0px #C0C0C0 solid;
}
#Button1
{
   color: #000000;
   font-family: Arial;
   font-size: 13px;
}
#wb_Text6
{
   background-color: transparent;
   border: 0px #C0C0C0 solid;
}
</style>
</head>
<body>
<div id="container">
<div id="wb_Image1" style="margin:0;padding:0;position:absolute;left:5px;top:27px;width:560px;height:701px;text-align:left;z-index:6;">
<img src="images/reglist.png" id="Image1" alt="" border="0" style="width:560px;height:701px;"></div>
<div id="wb_Form1" style="position:absolute;left:63px;top:82px;width:433px;height:594px;z-index:7;">
<form method="post">
<input type="text" id="password" style="position:absolute;left:255px;top:117px;width:141px;height:20px;line-height:20px;z-index:0;" name="password" value="">
<input type="text" id="Editbox4" style="position:absolute;left:255px;top:173px;width:141px;height:20px;line-height:20px;z-index:1;" name="Editbox4" value="">
<input type="text" id="login" style="position:absolute;left:255px;top:54px;width:141px;height:20px;line-height:20px;z-index:2;" name="login" value="">
<input type="text" id="email" style="position:absolute;left:255px;top:250px;width:141px;height:20px;line-height:20px;z-index:3;" name="email" value="">
<input type="checkbox" id="Checkbox1" name="" value="on" style="position:absolute;left:376px;top:314px;z-index:4;">
</div>
<div id="wb_Text1" style="margin:0;padding:0;position:absolute;left:93px;top:394px;width:248px;height:24px;text-align:left;z-index:8;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
<div style="font-family:'Lucida Grande';font-size:15px;color:#000000;">
<div style="text-align:left"><span style="font-family:'Rosbank Sans';font-size:21px;">&#1057; &#1087;&#1088;&#1072;&#1074;&#1080;&#1083;&#1072;&#1084;&#1080; &#1086;&#1079;&#1085;&#1072;&#1082;&#1086;&#1084;&#1083;&#1077;&#1085;</span></div>
</div>
</div>
<div id="wb_Text2" style="margin:0;padding:0;position:absolute;left:93px;top:317px;width:161px;height:47px;text-align:left;z-index:9;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
<div style="font-family:'Lucida Grande';font-size:15px;color:#000000;">
<div style="text-align:left"><span style="font-family:'Rosbank Sans';font-size:21px;">eMail</span></div>
<div style="text-align:left"><span style="font-family:'Rosbank Sans';font-size:13px;">&#1042; &#1089;&#1083;&#1091;&#1095;&#1072;&#1077; &#1091;&#1090;&#1088;&#1072;&#1090;&#1099; &#1087;&#1072;&#1088;&#1086;&#1083;&#1103;, &#1074;&#1099; &#1089;&#1084;&#1086;&#1078;&#1077;&#1090;&#1077; &#1077;&#1075;&#1086; &#1074;&#1086;&#1089;&#1089;&#1090;&#1072;&#1085;&#1086;&#1074;&#1080;&#1090;&#1100;</span></div>
</div>
</div>
<div id="wb_Text3" style="margin:0;padding:0;position:absolute;left:93px;top:243px;width:173px;height:53px;text-align:left;z-index:10;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
<div style="font-family:'Lucida Grande';font-size:15px;color:#000000;">
<div style="text-align:left"><span style="font-family:'Rosbank Sans';font-size:21px;">&#1055;&#1086;&#1074;&#1090;&#1086;&#1088;&#1080;&#1090;&#1077; &#1087;&#1072;&#1088;&#1086;&#1083;&#1100;</span></div>
<div style="text-align:left"><span style="font-family:'Rosbank Sans';font-size:13px;">&#1069;&#1090;&#1086; &#1087;&#1086;&#1079;&#1074;&#1086;&#1083;&#1080;&#1090; &#1080;&#1079;&#1073;&#1077;&#1078;&#1072;&#1090;&#1100; &#1086;&#1087;&#1077;&#1095;&#1072;&#1090;&#1086;&#1082;</span></div>
</div>
</div>
<div id="wb_Text4" style="margin:0;padding:0;position:absolute;left:93px;top:122px;width:161px;height:47px;text-align:left;z-index:11;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
<div style="font-family:'Lucida Grande';font-size:15px;color:#000000;">
<div style="text-align:left"><span style="font-family:'Rosbank Sans';font-size:21px;">&#1051;&#1086;&#1075;&#1080;&#1085;</span></div>
<div style="text-align:left"><span style="font-family:'Rosbank Sans';font-size:13px;">&#1055;&#1086;&#1076; &#1085;&#1080;&#1084; &#1074;&#1099; &#1089;&#1084;&#1086;&#1078;&#1077;&#1090;&#1077; &#1072;&#1074;&#1090;&#1086;&#1088;&#1080;&#1079;&#1086;&#1074;&#1072;&#1090;&#1100;&#1089;&#1103; &#1085;&#1072; &#1089;&#1072;&#1081;&#1090;&#1077;</span></div>
</div>
</div>
<div id="wb_Recaptcha1" style="margin:0;padding:0;position:absolute;left:110px;top:495px;width:318px;height:129px;text-align:left;z-index:12;">
</div>
<div id="wb_Text5" style="margin:0;padding:0;position:absolute;left:93px;top:434px;width:380px;height:40px;text-align:left;z-index:13;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
<div style="font-family:'Lucida Grande';font-size:15px;color:#000000;">
<div style="text-align:left"><span style="font-family:'Rosbank Sans';font-size:21px;">&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1090;&#1077;&#1082;&#1089;&#1090;, &#1091;&#1082;&#1072;&#1079;&#1072;&#1085;&#1085;&#1099;&#1081; &#1085;&#1072; &#1082;&#1072;&#1088;&#1090;&#1080;&#1085;&#1082;&#1077;</span></div>
<div style="text-align:left"><span style="font-family:'Rosbank Sans';font-size:13px;">&#1069;&#1090;&#1080;&#1084; &#1074;&#1099; &#1087;&#1086;&#1076;&#1090;&#1074;&#1077;&#1088;&#1078;&#1076;&#1072;&#1077;&#1090;&#1077;, &#1095;&#1090;&#1086; &#1103;&#1074;&#1083;&#1103;&#1077;&#1090;&#1077;&#1089;&#1100; &#1088;&#1077;&#1072;&#1083;&#1100;&#1085;&#1099;&#1084; &#1087;&#1086;&#1083;&#1100;&#1079;&#1086;&#1074;&#1072;&#1090;&#1077;&#1084;</span></div>
</div>
</div>
<input type="submit" id="Button1" name="submit" value="Submit" style="position:absolute;left:229px;top:645px;width:97px;height:26px;z-index:14;">
<div id="wb_Text6" style="margin:0;padding:0;position:absolute;left:93px;top:199px;width:161px;height:21px;text-align:left;z-index:15;border:0px #C0C0C0 solid;overflow-y:hidden;background-color:transparent;">
<div style="font-family:'Lucida Grande';font-size:15px;color:#000000;">
<div style="text-align:left"><span style="font-family:'Rosbank Sans';font-size:21px;">&#1055;&#1072;&#1088;&#1086;&#1083;&#1100;</span></div>
</form>
</div>
</div>
</div>
</body>
</html>