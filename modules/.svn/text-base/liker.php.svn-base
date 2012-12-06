<?
	include "../config.php";
	mysql_connect($host, $db_login, $db_password);
	mysql_select_db($db_name);
	mysql_set_charset("utf8");

    $val = $_GET['id'];
    $coo = $_COOKIE['id'];
    mysql_query("INSERT INTO wc__likes (offer_id, user_id) VALUES ('$val', '$coo')");
    mysql_query("UPDATE wc__offers SET rating = rating+1 WHERE id = '".$val."'");
    header("Location: ../offer_details.php?id=".$_GET['id']);
?>