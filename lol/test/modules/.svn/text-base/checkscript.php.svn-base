<?php
include "../config.php";
mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);
mysql_set_charset("utf8");
header("Content-Type: text/html; charset=UTF-8");
//if($_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest") {
$res = mysql_query("SELECT readstatus FROM wc__messages WHERE to_user = '".$_COOKIE['id']."'");
$flag = 0;
while ($row = mysql_fetch_array($res)) {
if ($row['readstatus'] == 1){
	$flag = 1;
}else{}
}
if ($flag == 1)
{
	echo "1";
}
else 
{
	echo "0";
}
//}
?>