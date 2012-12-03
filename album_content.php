<?php
include "config.php";
mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);
mysql_set_charset("utf8");
$query = mysql_query("SELECT * FROM wc__albums WHERE album_id = '".$_GET['id']."'");
$query = mysql_fetch_assoc($query);
$name = $query['name'];
?>
<html>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?echo ($name);?></title>
<link rel="stylesheet" href="css/albums.css" type="text/css">

</head>
<body onload="L.create()">
<script type='text/javascript' src='iLoad.js'></script>
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
<div id="cont">
<?
$query = "SELECT * FROM wc__images WHERE album_id = '".$_GET['album_id']."'";
$query = mysql_query($query);
$query = mysql_query("SELECT * FROM wc__images WHERE album='".$_GET['id']."'");
//$query = mysql_fetch_array($query);
while ($res = mysql_fetch_array($query)) {
	echo "<div id=photobox>";
	echo ("<a href='userupload/uploads/".$res['ID'].".jpg' style='vertical-align: middle;' rel='iLoad|".$name."'><img src='userupload/uploads/".$res['ID'].".jpg' style='width:112px; height:112px; text-align:center; vertical-align: middle;'>");
	echo "</div>";
}


?>
</div>
</body>
</html>