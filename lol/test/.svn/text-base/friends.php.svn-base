<?
//Import global variables
include "config.php";

// Check scrypt
// Connection to database
mysql_connect($host, $db_login, $db_password);
// Select datbase
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
{}
else
{
    header("Location: hello.php"); 
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Друзья</title>
<meta name="generator" content="WYSIWYG Web Builder 8 - http://www.wysiwygwebbuilder.com">
<link rel="stylesheet" href="css/friends.css" type="text/css">
</head>
<body>
<div id="topbar"> 
<div id="container">
<div id="wb_Image9">
<img src="images/button_submit.png" id="Image9" alt="" border="0"></div>

<div id="wb_Image6">
<a href="<?echo 'http://'.$baseurl;?>">
<img src="images/logo.png" id="Image6" alt="" border="0"><? echo ($showuser['user_login']) ?></div>
</a>
<div id="wb_Text1">
<span id="wb_uid0">Главная</span></div>
<div id="wb_Text2">
<span id="wb_uid1">Профиль</span></div>
<div id="wb_Text3">
<span id="wb_uid2"><a href="logout.php?id=<?echo $_COOKIE['id']?>"><div style="color: #ffffff">Выход</div></a></span></div>
<div id="mainbody">
<div id="wb_Text5">
<span id="wb_uid4"><a href="friends.php">Друзья</a></span></div>
<div id="wb_Text6">
<span id="wb_uid5"><a href="messages.php">Сообщения</a></span></div>
<div id="wb_Text7">
<span id="wb_uid6"><a href="news.php">Новости</a></span></div>
<div id="wb_Text8">
<span id="wb_uid8"><a href="albums.php">Фото</a></span></div>
<div id="wb_Text9">
<span id="wb_uid9"><a href="videos.php">Видео</a></span></div>
<div id="wb_Text10">
<span id="wb_uid10"><a href="settings.php">Настройки</a></span></div>
<div id="wb_Image12">
<img src="images/rightshadow.png" id="Image12" alt="" border="0"></div>
<div id="wb_Image13">
<img src="images/img0003.png" id="Image13" alt="" border="0"></div>
<div id="wb_Image14">
<img src="images/line.png" id="Image14" alt="" border="0"></div>




<?
$table = "wc__superusers";
 
//Connection to database
mysql_connect($host, $db_login, $db_password) or die ("Не могу создать соединение");
//Select database
mysql_select_db($db_name) or die (mysql_error());

$query = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
$showuser = mysql_fetch_assoc($query);


//Taking of user id
$myid = $_COOKIE['id'];

//Taking of friend id
$friendquery = mysql_query("SELECT friend_id FROM wc__friendlists WHERE user_id = '".$myid."'");
$friendid = mysql_fetch_assoc($friendquery);
$friendid = $friendid['friend_id'];

//Taking of friend data
$query = "SELECT user_name, user_surname, user_smallavatar, user_city, user_univer FROM $table WHERE user_id = '".$friendid."'";
$res = mysql_query($query) or die(mysql_error());

//Parcing friendtable
echo ('
<div id="cont"> 
<table border="0" cellpadding="0" cellspacing="0">
');

while ($row = mysql_fetch_array($res)) {
    $definition = ".jpg";
    $smallavaparcing = $row['user_smallavatar'].$definition;
    $smallavaparcing = 'http://'.$baseurl.'/userupload/uploads/'.$smallavaparcing;
    $username = $row['user_name'].' '.$row['user_surname'];
    ?>
    <tr>
    <div id="mesbox">
    <div id="wb_avaframe">
    <img src="images/avaframe.png" id="avaframe" alt="" border="0">
    <a href="http://<?echo $baseurl?>/page.php?id=<?echo $friendid?>">
    <div id="wb_avatar"> 
    <img src="<?echo($smallavaparcing);?>" id="avatar" alt="" border="0">
    </div>
    </div>
    <div id="wb_postframe">
    <div id="wb_postuser">
    <a href="http://<?echo $baseurl?>/page.php?id=<?echo $friendid?>">
    <?echo "<b>".$username."</b>"?>
    
    </div>
    <div id="wb_posttext">
    <?echo $row['user_city']?>
    <br>
    <?echo $row['user_univer'];?>
    </div>
    </a>
    <div id="wb_buttons">
    Сообщение · В черный список · <a href="modules/delete_user.php?id=<?echo $row['post_id'];?>" style="color: #aaaaaa;">Удалить</a>
    </div>

    </div>
    </div>
    </tr>
    <?
}
 
echo ("</table>\n");

?>
</body>
</html>