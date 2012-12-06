<?
include ('../config.php');

	$uploaddir = 'files/';
	$newname = $_COOKIE['id'];
	$newname = $newname.strrchr($_FILES['userfile']['name'], ".");
	$p = strrchr($_FILES['userfile']['name'], ".");
	$_FILES['userfile']['name'] = $newname;
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
	{
		header("Location: crop.php");
	}
	else
	{
		echo "fucking error";
	}
// } 
?>