<?

// Скрипт проверки
include "../config.php";
# Соединямся с БД
mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);
mysql_set_charset("utf8");

$id = $_GET['id'];
mysql_query("DELETE FROM wc__comments WHERE id = '".$id."'");

header("Location: ../page.php?id=".$_GET['user_id']);
?>