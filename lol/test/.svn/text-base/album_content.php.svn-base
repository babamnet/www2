<?php
include "config.php";
mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);
mysql_set_charset("utf8");
$query = mysql_query("SELECT * FROM wc__albums WHERE album_id = '".$_GET['album_id']."'");
$query = mysql_fetch_assoc($query);
?>
<html>
<head>
<title>Альбом "<?echo ($query['album_name']);?>"</title>
</head>
<body onload="L.create()" style="allign: text-center;">
<script type='text/javascript' src='/iLoad.js'></script>

<?
$query = "SELECT * FROM wc__images WHERE album_id = '".$_GET['album_id']."'";
$query = mysql_query($query);
// $row = mysql_fetch_assoc($query);

// 	echo($row['id'].'<br>');
// 	echo($row['album_id'].'<br>');
while ($row = mysql_fetch_assoc($query)) 
{ 
	echo ('<a href ="userupload/uploads/'.$row['ID'].'.jpg" rel="iLoad|album_1"><img src ="userupload/uploads/'.$row['ID'].'.jpg" width=900px></a><br>');
}


?>
</body>
</html>