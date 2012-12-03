<?php
header("Content-Type: text/html; charset=UTF-8");
if($_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest") {
 print  $_GET["id"];
 print  $_GET['userid'];
}
?>