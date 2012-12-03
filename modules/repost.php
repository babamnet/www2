<?php
include "../config.php";
mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);

$query = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
$userdata = mysql_fetch_assoc($query);
$insip = ip2long($_SERVER['REMOTE_ADDR']);

if(($userdata['user_hash'] == $_COOKIE['hash']) and ($userdata['user_id'] == $_COOKIE['id']) and (($userdata['user_ip'] == $insip) or ($userdata['user_ip'] == "0")))
{}
else
{
header("Location: hello.php"); 
}

$geter = $_GET['id'];
$lol = $_COOKIE['id'];
mysql_query("INSERT INTO  wc__posts (post_repostid ,post_userid ,post_repoststatus) VALUES ('$geter',  '$lol',  '1')");
header("Location: ../page.php?id=".$_GET['userid']); 
?>