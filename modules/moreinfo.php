<?

// Скрипт проверки
include "../config.php";
# Соединямся с БД
mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);
mysql_set_charset("utf8");

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))

{ 
$query = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
$userdata = mysql_fetch_assoc($query);
$insip = ip2long($_SERVER['REMOTE_ADDR']);

if(($userdata['user_hash'] == $_COOKIE['hash']) and ($userdata['user_id'] == $_COOKIE['id']))
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
header("Location: hello.php"); 
}

$avaquery = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".intval($_GET['id'])."' LIMIT 1");
$avatarparcing = mysql_fetch_assoc($avaquery);
$definition = ".jpg";
$smallavaparcing = $avatarparcing['user_smallavatar'].$definition;
$avatarpreview = 'http://'.$baseurl.'/userupload/uploads/'.$avatarparcing['user_avatar'].$definition;// width="75" height="75"
$smallavaparcing = 'http://'.$baseurl.'/userupload/uploads/'.$smallavaparcing;

?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/moreinfo.css" type="text/css"/>
<body style="background:url(<?echo $avatarpreview?>); padding:none;">
<div id="avatar">
	<img src="<?echo $smallavaparcing?>">
</div>
<div id="box">
<div id="name">
	<?echo $avatarparcing['user_name'].' '.$avatarparcing['user_surname'];?>
</div>
<div id="infobox">
	<?echo $avatarparcing['user_city'];?>
</div>
<div id="univer">
	<?echo $avatarparcing['user_univer'];?>
</div>
<div id="mar">
	<?echo $avatarparcing['user_marriage'];?>
</div>
</div>
</body>
</box>