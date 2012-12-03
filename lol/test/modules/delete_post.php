<?
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

$user_post_id = mysql_query("SELECT post_userid FROM wc__posts WHERE post_id = '".intval($_GET['id'])."' LIMIT 1");
$user_post_id = mysql_fetch_assoc($user_post_id);
echo $user_post_id['user_id'];


if ($user_post_id['post_userid'] == $userdata['user_id'])
{
	mysql_query("DELETE FROM `weclouds`.`wc__posts` WHERE `wc__posts`.`post_id` = '".intval($_GET['id'])."'");
	header("Location: ../mypage.php"); 
}
else
{
	header("Location: ../mypage.php"); 
}
?>