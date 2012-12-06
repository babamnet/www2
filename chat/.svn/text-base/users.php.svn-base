<?php
/**
 * Script that just output online users of chat
 * 
 * Скрипт выводящий пользователей онлайн
 */
include 'functions.php';
include 'global.php';
     
$query = "SELECT * FROM `user`";
$result = mysql_query ( $query ) or exit( __FILE__." (".__LINE__.") ".$query );
     
print "<ul class="users">".PHP_EOL;
     
while( $line = mysql_fetch_assoc( $result ) ) {
    echo "<li><a onclick="top.chat.document.forms[0].message.value+=\"$line[username], \"">$line[username]</a></li>";
}
     
print "</ul>".PHP_EOL;
     
echo setlocation( "nicklist", 60, $_SERVER['PHP_SELF'] );//60 - second for refresh
mysql_free_result( $result );
?>
