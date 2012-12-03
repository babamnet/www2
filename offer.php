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
<title>Предложения</title>
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
<div id="menu">
<iframe src="menu.php" style="border:none;" height="300"></iframe>
</div>
<div id="wb_Image12">
<img src="images/rightshadow.png" id="Image12" alt="" border="0"></div>
<div id="wb_Image13">
<img src="images/img0003.png" id="Image13" alt="" border="0"></div>
<div id="wb_Image14">
<img src="images/line.png" id="Image14" alt="" border="0"></div>




<?
//Connection to database
mysql_connect($host, $db_login, $db_password) or die ("Не могу создать соединение");
//Select database
mysql_select_db($db_name) or die (mysql_error());

//$query = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".intval($_COOKIE['id'])."'");
$showuser = mysql_fetch_assoc($query);


//Taking of user id
$myid = $_COOKIE['id'];

//Taking of friend id
$query = mysql_query("SELECT * FROM wc__offers WHERE author = '".$myid."'");

echo ('
<div id="cont"> 
<table border="0" cellpadding="0" cellspacing="0">
');

while ($regs = mysql_fetch_array($query)) {
    $definition = ".jpg";
    $smallavaparcing = $regs['ava'].$definition;
    $smallavaparcing = 'http://'.$baseurl.'/userupload/uploads/'.$smallavaparcing;
    $username = $regs['name'];
    //$friendquery = mysql_query("SELECT friend_id FROM wc__friendlists WHERE user_id = '".$myid."'");
    ?>
    <tr>
    <div id="mesbox">
    <div id="wb_avaframe">
    <img src="images/avaframe.png" id="avaframe" alt="" border="0">
    <a href="http://<?echo $baseurl?>/offer_details.php?id=<?echo $regs['id'];?>">
    <div id="wb_avatar"> 
    <img src="<?echo($smallavaparcing);?>" id="avatar" alt="" border="0">
    </div>
    </div>
    <div id="wb_postframe">
    <div id="wb_postuser">
    <a href="http://<?echo $baseurl?>/offer_details.php?id=<?echo $regs['id'];?>">
    <?echo "<b>".$username."</b>"?>
    
    </div>
    <div id="wb_posttext">
    <?echo $regs['description']?>
    </div>
    </a>
    <div id="wb_buttons">
    <a href="modules/delete_offer.php?id=<?echo $row['post_id'];?>" style="color: #aaaaaa;">Удалить</a>
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