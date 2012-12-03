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

if(isset($_POST['submit']))
{

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
<form action="http://<?echo $baseurl?>/continue_register.php" method="POST">
  <input name="skype" type="text" value="Логин" style="background-color: #ffffff; width: 100px; border-radius: 2px;"><br>
  <input name="cellphone" type="text" value="Имя" style="background-color: #ffffff; width: 100px; border-radius: 2px;"><br>
  <input name="city" type="text" value="Фамилия" style="background-color: #ffffff; width: 100px; border-radius: 2px;"><br>
  <input name="birth" type="date" value="" style="background-color: #ffffff; width: 100px; border-radius: 2px;"><br>
  <select name="day" style="background-color: #ffffff; width: 50px; border-radius: 2px;">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="3">4</option>
  <option value="3">5</option>
  <option value="3">6</option>
  <option value="3">7</option>
  <option value="3">8</option>
  <option value="3">9</option>
  <option value="3">10</option>
  <option value="3">11</option>
  <option value="3">12</option>
  <option value="3">13</option>
  <option value="3">14</option>
  <option value="3">15</option>
  <option value="3">16</option>
  <option value="3">17</option>
  <option value="3">18</option>
  <option value="3">19</option>
  <option value="3">20</option>
  <option value="3">21</option>
  <option value="3">22</option>
  <option value="3">23</option>
  <option value="3">24</option>
  <option value="3">25</option>
  <option value="3">26</option>
  <option value="3">27</option>
  <option value="3">28</option>
  <option value="3">29</option>
  <option value="3">30</option>
  <option value="3">31</option>
  </select>
    <select name="month" style="background-color: #ffffff; width: 100px; border-radius: 2px;">
  <option value="1">Январь</option>
  <option value="2">Февраль</option>
  <option value="3">Март</option>
  <option value="3">Апрель</option>
  <option value="3">Май</option>
  <option value="3">Июнь</option>
  <option value="3">Июль</option>
  <option value="3">Август</option>
  <option value="3">Сентябрь</option>
  <option value="3">Октябрь</option>
  <option value="3">Ноябрь</option>
  <option value="3">Декабрь</option>
  </select>
  <input name="year" type="text" value="" style="background-color: #ffffff; width: 100px; border-radius: 2px;"><br>
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