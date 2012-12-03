<?php

include "config.php";

// Скрипт проверки
mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);
mysql_set_charset("utf8");

session_start();
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{   
    $query = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysql_fetch_assoc($query);
    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
      header("Location: hello.php");  
    }
    else{}
}
else
{
    header("Location: hello.php");
}

if($_POST['save']){

    $post_text = $_POST['text'];
    $post_userid = $_COOKIE['id'];
    $post_repostid = '0';
    $post_repoststatus = false;

    // добавляем запись в таблицу pages
    //$add_posts = "INSERT INTO wc__posts SET text='".$page_text."'";
    $add_posts = "INSERT INTO wc__posts (
      post_text,
      post_repostid,
      post_userid,
      post_repoststatus)
    VALUES (
      '$post_text',
      '$post_repostid',
      '$post_userid',
      '$post_repoststatus'
    )";
    
    if(mysql_query($add_posts)){
        clearstatcache();
        //header ("Cache-Control: no-cache"); // если запись добавилась перенаправляем к списку страниц
        header("Location: http://".$baseurl."/news.php");

    }
    else{
        echo "<posts>
        <table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
        <tr style=\"border: solid 0px #000\">
        <td align=\"center\"><b>
        Connection error. Please, try later
        </b></td>
        </tr>
        </table>
        "; // если запись не добавилась, показываем ошибку
    echo $page_text;    
    }
}

$avaquery = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
$avatarparcing = mysql_fetch_assoc($avaquery);
$definition = ".jpg";
$smallavaparcing = $avatarparcing['user_smallavatar'].$definition;
$avatarpreview = 'http://'.$baseurl.'/userupload/uploads/'.$smallavaparcing;// width="75" height="75"
$smallavaparcing = 'http://'.$baseurl.'/userupload/uploads/'.$smallavaparcing;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Моя страница</title>
<meta name="generator" content="WYSIWYG Web Builder 8 - http://www.wysiwygwebbuilder.com">
<link rel="stylesheet" href="css/news.css" type="text/css">
</head>
<body>
<div id="topbar"> 
<div id="container">
<div id="wb_Image9">
<img src="images/button_submit.png" id="Image9" alt="" border="0"></div>
<div id="wb_Image1">
<img src="<?echo ($smallavaparcing);?>" id="Image1" alt="" border="10" border-color="ffffff" width="100" height="100"></div>

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
<div id="wb_Image7">
<img src="images/point.png" id="Image7" alt="" border="0"></div>
<div id="wb_Image8">
<img src="images/point.png" id="Image8" alt="" border="0"></div>
</form>
<div id="wb_Form2">
<form name="save" method="post" action="news.php" id="Form2">
<input type="hidden" name="page_id" value="">
<textarea name="text" id="TextArea1" rows="2" cols="107" style="resize: none;"></textarea>
<input type="submit" id="Button2" name="save" value="Разместить">
</form>
<div id="wb_Image11">
<img src="images/button_calendar.png" id="Image11" alt="" border="0"></div>
</div>
</div>
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
/* Соединяемся с базой данных */
$hostname = "localhost"; // название/путь сервера, с MySQL
$username = "root"; // имя пользователя (в Denwer`е по умолчанию "root")
$password = "root"; // пароль пользователя (в Denwer`е по умолчанию пароль отсутствует, этот параметр можно оставить пустым)
$dbName = "weclouds"; // название базы данных
$db_prefix = "wc__";

/* Таблица MySQL, в которой хранятся данные */
$table = "wc__posts";
 
/* Создаем соединение */
mysql_connect($host, $db_login, $db_password) or die ("Не могу создать соединение");
 
/* Выбираем базу данных. Если произойдет ошибка - вывести ее */
mysql_select_db($db_name) or die (mysql_error());

//выборка id пользователей

$myid = $_COOKIE['id'];
$friendquery = mysql_query("SELECT friend_id FROM wc__friendlists WHERE user_id = '".$myid."'");
$friendid = mysql_fetch_assoc($friendquery);
$friendid = $friendid['friend_id'];

$query = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".intval($_COOKIE['id'])."'");
$showuser = mysql_fetch_assoc($query);
 
/* Составляем запрос для извлечения данных из полей "name", "email", "theme",
"message", "data" таблицы "test_table" */
$query = "SELECT post_id, post_text, post_repostid, post_date, post_userid, post_repoststatus FROM $table WHERE (post_userid = '".$friendid."') OR (post_userid = '".intval($_COOKIE['id'])."') ORDER BY post_date DESC";

//$userquery = "SELECT user_id, user_login FROM wc__superusers";
//$showuser = mysql_fetch_assoc($userquery) or die(mysql_error());

/* Выполняем запрос. Если произойдет ошибка - вывести ее. */
$res = mysql_query($query) or die(mysql_error());

/* Выводим данные из таблицы */
echo ('
<div id="cont"> 
<table border="0" cellpadding="0" cellspacing="0">
');
/* Цикл вывода данных из базы конкретных полей */
while ($row = mysql_fetch_array($res)) {
      if ($row['post_repoststatus'] == false)
  {
    $avaquery = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".$row['post_userid']."' LIMIT 1");
    $avatarparcing = mysql_fetch_assoc($avaquery);
    $definition = ".jpg";
    $username = $avatarparcing['user_name']." ".$avatarparcing['user_surname'];
    $avaparcing = $avatarparcing['user_avatar'].$definition;
    $avaparcing = '<img src = "http://'.$baseurl.'/userupload/uploads/'.$avaparcing.'" width="900">';


    $smallavaparcing = $avatarparcing['user_smallavatar'].$definition;
    $smallavaparcing = 'http://'.$baseurl.'/userupload/uploads/'.$smallavaparcing;
    ?>
    <tr>
    <div id="mesbox">
    <div id="wb_avaframe">
    <img src="images/avaframe.png" id="avaframe" alt="" border="0">
    <div id="wb_avatar">
    <img src="<?echo($smallavaparcing);?>" id="avatar" alt="" border="0">
    </div>
    </div>
    <div id="wb_postframe">
    <div id="wb_postuser">
    <?echo "<b>".$username."</b>"?>
    </div>
    <div id="wb_postdate">
    <?echo $row['post_date']?>
    </div>
    <div id="wb_posttext">
    <?echo $row['post_text'];?>
    </div>
    <div id="wb_buttons">
    Редактировать · Комментировать
    </div>

    </div>
    </div>
    </tr>
    <?
  }
  else
  {
    $avaquery = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".$row['post_userid']."' LIMIT 1");
    $avatarparcing = mysql_fetch_assoc($avaquery);
    $definition = ".jpg";
    $username = $avatarparcing['user_name']." ".$avatarparcing['user_surname'];
    $avaparcing = $avatarparcing['user_avatar'].$definition;
    $avaparcing = '<img src = "/userupload/uploads/'.$avaparcing.'" width="900">';


    $smallavaparcing = $avatarparcing['user_smallavatar'].$definition;
    $smallavaparcing = '/userupload/uploads/'.$smallavaparcing;
    ?>
    <tr>
    <div id="mesbox">
    <div id="wb_avaframe">
    <img src="images/avaframe.png" id="avaframe" alt="" border="0">
    <div id="wb_avatar">
    <img src="<?echo($smallavaparcing);?>" id="avatar" alt="" border="0">
    </div>
    </div>
    <div id="wb_postframe">
    <div id="wb_postuser">
    <?echo "<b>".$username."</b>"?>
    </div>
    <div id="wb_postdate">
    <?echo $row['post_date']?>
    </div>
    <div id="wb_repost">
    <?
    $rep = mysql_query("SELECT post_id, post_text, post_userid FROM wc__posts WHERE post_id = '".$row['post_repostid']."' LIMIT 1");
    $rep = mysql_fetch_array($rep);
    $rep_user = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".$rep['post_userid']."' LIMIT 1");
    $rep_user = mysql_fetch_assoc($rep_user);
    $rep_user = $rep_user['user_name'].' '.$rep_user['user_surname'];
    echo '<b>'.$rep_user.'</b><br><div style="padding-top: 3px;">'.$rep['post_text'].'</div>';?>
    </div>
    <div id="wb_buttons">
    Редактировать · Комментировать
    </div>

    </div>
    </div>
    </tr>
    <?
  }
}
 
echo ("</table>\n");
?>