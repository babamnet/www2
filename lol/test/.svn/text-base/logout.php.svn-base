<?php
include "config.php";

mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);
mysql_set_charset("utf8");

$hash  = "0000";
$get = $_GET['id'];
       mysql_query("UPDATE wc__superusers SET user_hash='".$hash."' WHERE user_id = '".$get."' LIMIT 1");
	header("Location: http://".$baseurl."/");
?>