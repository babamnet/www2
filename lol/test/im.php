<?php
// Скрипт проверки
include "config.php";
include "converter_code.php";

# Соединямся с БД
mysql_connect($host, $db_login, $db_password);
// mysql_query("SET NAMES 'cp1251'");
// mysql_query("SET CHARACTER SET 'cp1251'");
mysql_select_db($db_name);
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

// @mysql_query("SET SESSION character_set_results = utf-8;");
// @mysql_query("SET SESSION Character_set_client = utf-8;");
// @mysql_query("SET SESSION Character_set_results = utf-8;");
// @mysql_query("SET SESSION Collation_connection = utf-8_general_ci;");
// @mysql_query("SET SESSION Character_set_connection = utf-8;");
// echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
@mysql_query("SET SESSION character_set_results = cp1251;");
@mysql_query("SET SESSION Character_set_client = cp1251;");
@mysql_query("SET SESSION Character_set_results = cp1251;");
@mysql_query("SET SESSION Collation_connection = cp1251_general_ci;");
@mysql_query("SET SESSION Character_set_connection = cp1251;");
//echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
$my_id = $_COOKIE['id'];
$friend_id = $_GET["id"];

if($_POST['save']){

    $my_id = $_COOKIE['id'];
    $friend = $_GET["id"];
    // echo $my_id;
    // echo $friend_id;

    $text = $_POST['text'];
    // $text = convert($text);
    $add_posts = "INSERT INTO wc__messages (
      from_user,
      to_user,
      text)
    VALUES (
      '$my_id',
      '$friend',
      '$text'
    )";
    mysql_query($add_posts);
}

?>
<iframe src="dialog.php?id=<? echo $friend_id; ?>#last" width="300" height="500" frameborder="0" style="border: 2px solid black"></iframe>

<form action="im.php?id=<? echo $friend_id ?>" method="post" accept-charset="windows-1251">
    <input type="hidden" name="page_id" value="">
    <input type="text" name="text" />
    <input type="submit" name="save" value="Send"/>
</form>
