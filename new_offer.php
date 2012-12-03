<?
//Import global variables
include "config.php";

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
<link rel="stylesheet" href="css/offer_details.css" type="text/css">
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
$myid = $_COOKIE['id'];

//Taking of friend id
$query = mysql_query("SELECT * FROM wc__offers WHERE id = '".$_GET['id']."'");
$query = mysql_fetch_array($query);
$avka = $query['ava'];
echo ('<div id="cont">');
?>
<div id="formarea">
<form name="creator" action="new_offer.php">
<div id="name">
<input type="text" name="name">
</div>
<div id="descrition">
<textarea name="text" id="deccription" name="description" rows="10" cols="60" style="resize: none;"></textarea>
</div>
</form>
</div>
</div>
</body>
</html>