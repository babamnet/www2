<?php
include "config.php";
mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);
mysql_set_charset("utf8");
$id = $_GET['id'];
$query = "SELECT * FROM wc__albums WHERE user_id = '".$id."'";
$query = mysql_query($query);
while ($row = mysql_fetch_assoc($query)) 
{
	// echo($row['album_id']."<br>");
	echo ('<a href="album_content.php?album_id='.$row['album_id'].'">'.$row['album_name'].'</a><br>');
}
//mysql_close($db_name);

?>