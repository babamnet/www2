<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>WeClouds</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="css/register.css" type="text/css">
</head>
<body style="background: url(images/backgr.png);">
<div id="logobar">
<div id="logo">
<img src="images/logo2.png">
</div>
<div id="form">
<form action="http://<?echo $baseurl?>/login.php" method="POST">
  <input name="login" type="text" value="Login" style="background-color: #ffffff; width: 100px; border-radius: 2px;">
  <input name="password" type="password" value="Password" style="background-color: #ffffff; width: 100px; border-radius: 2px;">
  <input name="submit" type="submit" value="Enter!" style="background-color: #ffffff; width: 100px; border-radius: 2px;">
</form>
</div>
</div>
<div id="topbar" style="background: url(images/bodybg.png) repeat;">
  <div id="content">
    <div id="error">
<?
# Соединямся с БД
include "config.php";
mysql_connect($host , $db_login, $db_password);
mysql_select_db($db_name);
mysql_set_charset("utf8");

$postlogin = "";
$postname = "";
$postsurname = "";

if(isset($_POST['submit']))
{
    $postlogin = $_POST['login'];
    $postname = $_POST['name'];
    $postsurname = $_POST['surname'];
    $err = array();
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }
    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }
    $query = mysql_query("SELECT COUNT(user_id) FROM wc__superusers WHERE user_login='".mysql_real_escape_string($_POST['login'])."'");
    if(mysql_result($query, 0) > 0)
    {
         $err[] = "Пользователь с таким логином уже существует в базе данных";
    }
    if($_POST['ret_password'] != $_POST['password'])
    {
         $err[] = "Пароли не совпадают";
    }
    if(count($err) == 0)
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        mysql_query("INSERT INTO wc__superusers SET user_login='".$login."', user_password='".$password."', user_name='".$_POST['name']."', user_surname='".$_POST['surname']."'");
        header("Location: continue_register.php"); exit();
    }
    else
    {
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}

?>
</div>
  <div id="header">
    <div id="lol">Регистрация</div><br><br>Заполните эти поля для начала работы
  </div>
  <div id="descblock">
    <div id="logintext">
    Логин</div>
    <div id="nametext">
    Имя</div>
    <div id="surtext">
    Фамилия</div>
    <div id="passtext">
    Пароль</div>
    <div id="rettext">
    Повторите пароль</div>
  </div>
  <div id="formblock">
<form action="http://<?echo $baseurl?>/register.php" method="POST">
  <input name="login" type="text" value="<?echo $postlogin?>" style="background-color: #ffffff; width: 100px; border-radius: 2px;"><br>
  <input name="name" type="text" value="<?echo $postname?>" style="background-color: #ffffff; width: 100px; border-radius: 2px;"><br>
  <input name="surname" type="text" value="<?echo $postsurname?>" style="background-color: #ffffff; width: 100px; border-radius: 2px;"><br>
  <input name="password" type="password" value="" style="background-color: #ffffff; width: 100px; border-radius: 2px;"><br>
  <input name="ret_password" type="password" value="" style="background-color: #ffffff; width: 100px; border-radius: 2px;"><br>
  <div id="submbut">
  <input name="submit" type="submit" value="Продолжить" style="background-color: #ffffff; width: 106px; border-radius: 2px;"><br>
</div>
</form>
</div>
  </div>  
</div>
<div id="footer">
  WeClouds 2012 Все права защищены
</div>
</body>
</html>