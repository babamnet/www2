<?
include "../config.php";
# Соединямся с БД
mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);
mysql_set_charset("utf8");
?>
<style>
	a:visited
	{
	   color: #fff;
	}
		a:active
	{
	   color: #fff;
	}
	a:hover{
		color: #fff;
		box-shadow: 0 0 5px 0 blue;
	}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<div style="width:300px; text-align:center; font-family:Arial; font-size:14px;vertical-align:middle;">
<a href="../mypage.php?id=<?echo $_COOKIE['id']?>" target="_top">
<div id="button_block" style="position:absolute; width:100; vertical-align:middle; top:0px; height:35px;">
	<br>Главная
</div>
</a>
<a href="" target="_top">
<div id="button_block" style="left:100px; position:absolute; width:100; top:0px; height:35px;">
	<br>Поиск
</div>
</a>
<a href="../logout.php?id=<?echo $_COOKIE['id']?>" target="_top">
<div id="button_block" style="left:200px;position:absolute; width:100; top:0px; height:35px;">
	<br>Выход
</div>
</a>
</div>