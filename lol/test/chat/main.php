<?php
/** 
 * Main script that will logon and logout users
 *
 * Скрипт, который будет логинить и разлогинивать 
 * пользователей
 */
error_reporting( E_ALL ^ E_NOTICE );
session_start();
session_register( "userid" );
     
@$action = $_GET['action'];
 
include 'functions.php';
include 'global.php';
     
global $user;
echo "";
     
if( empty( $_SESSION['userid'] ) ) {
     
    if( 'POST' == $_SERVER['REQUEST_METHOD'] ) {//catch incoming nick
     
        if( !empty( $_POST['username'] ) ) {//check for existence
            $query = "SELECT `userid` FROM `user` WHERE `username` = '".htmlspecialchars( $_POST['username'] )."'";
            $r = mysql_query( $query ) or exit( __FILE__." (".__LINE__.") ".$query );
     
            if( mysql_num_rows( $r ) ) {//if exists
                echo "<center>Уже есть</center>";
     
            } else {//reg
                $query = "INSERT INTO `user` 
                    ( `username`, `lastactivity` ) 
                VALUES 
                    ( '".htmlspecialchars( $_POST['username'] )."',".mktime()." )";
     
                mysql_query( $query ) or exit( __FILE__." (".__LINE__.") ".$query );
     
                $_SESSION['userid'] = mysql_insert_id();
     
                echo "<center>Привет, $_POST[username]</center>".
                    setlocation( 'chat', 0, 'input.php' ).
                    setlocation( 'main', 2, 'main.php' );
     
                echo "";
                $query = "INSERT INTO `chat` VALUES ( $_SESSION[userid], 'я пришел!!!!', '".mktime()."' )";
                @mysql_query( $query );
            }//if( mysql_num_rows( $r ) )
        }//if( !empty( $_POST['username'] ) )
     
    } else {
        echo
"<form method="POST">
    <input type="text" name="username" size="30">
    <input type="submit" value="Enter">
</form>
";
    }//if( 'POST' == $_SERVER['REQUEST_METHOD'] )
     
    exit;
}//if( empty( $_SESSION['userid'] ) )
     
if( "exit" == $action ) {
    session_destroy();
    $query = "INSERT INTO `chat` VALUES ( $user[userid], 'я ушел!!!!', '".mktime()."' )";
    @mysql_query( $query );
     
    $query = "DELETE FROM `user` WHERE `userid`='$user[userid]'";
    mysql_query( $query );
     
    echo setlocation( 'main', 0, 'main.php' );
    exit;
}//if( "exit" == $action ) 
     
echo "<center>Чат для $user[username] <a href="main.php?action=exit">выйти</a></center>";
     
$query = "SELECT * FROM `chat` LEFT JOIN `user` USING (`userid`) ORDER BY `date` DESC";
$result = mysql_query ( $query ) or die ( "Query failed: $query" );
     
echo "<ul>".PHP_EOL;
     
while( $line = mysql_fetch_assoc( $result ) ) {
    echo "<li><span class="ts">".getdatestring( $line['date'] )."</span>
<span class="un">$line[username]:</span>
<span class="msg">$line[message]</span></li>";
}//while
     
print "</ul>".PHP_EOL;
     
mysql_free_result( $result );
     
$query = "UPDATE `user` SET `lastupdate` = '".mktime()."' WHERE `userid` = $_SESSION[userid] ";
@mysql_query( $query );
     
echo "";
?>