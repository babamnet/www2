<?php
/**
 * Script that load to input window
 * 
 * Скрипт выводящий в окно ввода
 */
include 'functions.php';
include 'global.php';
     
if( $_SESSION['userid'] ) {
 
    if( "POST" == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['message'] ) ) {//parse form
        $query = "INSERT INTO `chat` VALUES ( '$user[userid]', '".addslashes( $_POST['message'] )."', '".mktime()."' )";
        @mysql_query( $query );
        echo setlocation( 'main', 0, 'main.php' );
    }
     
    echo "<center>
    <form method="post">
 
 
        <input name="message" type="text" maxsize="250" size="50">
        <input type="submit" value="Send">
    </form>
</center>";
     
//выводим js скрипт переводящий фокус куды надо
    echo "<script type="text/javascript">top.chat.document.forms[0].message.focus();</script>";
     
} else {
    echo "<center>Введи ник</center>";
}
?>