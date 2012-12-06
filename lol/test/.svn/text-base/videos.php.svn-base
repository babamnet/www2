<?php
include "config.php";

mysql_connect($host, $db_login, $db_password);
// Select datbase
mysql_select_db($db_name);
mysql_set_charset("utf8");

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))

{ 
$query = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
$userdata = mysql_fetch_assoc($query);
$insip = ip2long($_SERVER['REMOTE_ADDR']);

if(($userdata['user_hash'] == $_COOKIE['hash']) and ($userdata['user_id'] == $_COOKIE['id']) and (($userdata['user_ip'] == $insip) or ($userdata['user_ip'] == "0")))
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

$query = mysql_query("SELECT * FROM wc__videos WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
$videolist = mysql_fetch_assoc($query);

while ($row = mysql_fetch_array($res)) {

}
?>