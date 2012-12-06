<?
include "config.php";
mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);


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
header("Location: mypage.php");
}
else
{
header("Location: hello.php"); 
}
?>