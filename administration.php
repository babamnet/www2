<?
include "config.php";
# Соединямся с БД
mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);
mysql_set_charset("utf8");

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))

{ 
$query = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
$userdata = mysql_fetch_assoc($query);
$insip = ip2long($_SERVER['REMOTE_ADDR']);

if(($userdata['user_hash'] == $_COOKIE['hash']) and ($userdata['user_id'] == $_COOKIE['id']) and ($userdata['user_admin'] == 1))
{
$flag = true;
}
else
{
$flag = false;
}
}
else
{
$flag = false;
}
if ($flag == true)
{
//header("Location: mypage.php"); если включить запускает рекурсию
}
else
{
header("Location: index.php"); 
}
?>
<header>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>
		WECLOUDS:ADMINPANEL
	</title>
</header>
<body style="text-align:center; background-color:#000; color:#0f0; font-family:Arial; font-size:12px; padding:0; margin:0;">
	<div style="font-size:20px;">
		<hr color="#0f0">
			Панель администрирования WeClouds
			<div style="font-size: 12px;">
				<br>
				<?
					echo 'Добро пожаловать, '.$userdata['user_name'];
				?>
			</div>
		<hr color="#0f0">
	</div>
	<div>
		Content

		<hr color="#0f0">	
	</div>
	<div>
		WeClouds 2012 | All rights reserved
	</div>
</body>