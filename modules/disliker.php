<?
    include "../config.php";
    mysql_connect($host, $db_login, $db_password);
    mysql_select_db($db_name);
    mysql_set_charset("utf8");

    $val = $_GET['id'];
    mysql_query("DELETE FROM wc__likes WHERE offer_id = '".$val."' AND user_id = '".$_COOKIE['id']."'");
    mysql_query("UPDATE wc__offers SET rating = rating-1 WHERE id = '".$val."'");
    header("Location: ../offer_details.php?id=".$_GET['id']);
?>