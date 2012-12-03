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
<title>Сообщения</title>
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
<div id="cont"> 
<?
$my_id = $_COOKIE['id'];
$friend_id = $_GET["id"];

if($_POST['save']){

    $my_id = $_COOKIE['id'];
    $friend = $_GET["id"];
    // echo $my_id;
    // echo $friend_id;
    $def = 1;
    $text = $_POST['text'];
    // $text = convert($text);
    $add_posts = "INSERT INTO wc__messages (
      from_user,
      to_user,
      text,
      readstatus)
    VALUES (
      '$my_id',
      '$friend',
      '$text',
      '1'
    )";
    mysql_query($add_posts);
}
?>
<form action="messages.php?id=<? echo $friend_id ?>" method="post" accept-charset="utf-8">
    <input type="hidden" name="page_id" value="">
    <input type="text" name="text" style="position: absolute; left: 10px; top: 10px; background-color: #ffffff; width: 610px; height: 35px; border-radius: 2px;"/>
    <input type="submit" name="save" value="Send" style="position: absolute; left: 630px; top: 10px; background-color: #ffffff; width: 100px; height: 40px; border-radius: 2px;"/>
</form>
<iframe src="dialog.php?id=<? echo $friend_id; ?>#last" width="739" height="498" style="position:absolute; box-shadow: 0 0 5px; top: 70px; border: none;"></iframe>

</div>
</body>
</html>