<?php
include ('../config.php');
mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);
// mysql_connect ('localhost', 'root', '');
// mysql_select_db('weclouds');
$add_photo = "INSERT INTO  wc__images (ID) VALUES (NULL)";
$photo_name = "SELECT * FROM wc__images WHERE ID = last_insert_id()";
$uploaddir = 'uploads/';
	mysql_query($add_photo);
	$newname = mysql_query($photo_name);
	$name = mysql_fetch_assoc($newname);
	$newname = $name['ID'];
	$newname = $newname.strrchr($_FILES['userfile']['name'], ".");
	$p = strrchr($_FILES['userfile']['name'], ".");
	$_FILES['userfile']['name'] = $newname;
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
	{
		//move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
		echo "File is valid, and was successfully uploaded. <br>";
		echo ('file\'s new name '.$newname.'<br>');
		$newname = '<img src = "uploads/'.$newname.'">';
		echo ($newname);
	}
	else
	{
		echo "fucking error";
	}
	mysql_close();
// } 
// else 
// {
// 	echo "File uploading failed.";
// }

?>