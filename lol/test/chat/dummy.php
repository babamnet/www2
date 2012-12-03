<?php
/**
 * engine to check new messages and reload chat window if need
 * this script will contantly refreshed by self or others
 * 
 * Скрипт, который будет постоянно обновлятся и при 
 * наличии обновлений обновлять другие фреймы
 */
set_time_limit( 0 );
     
if( connection_aborted() ) {//we have to delete user from DB
    $query="INSERT INTO `chat`
            ( `userid`, `message`, `date` )
        VALUES
            ( '$user[userid]', 'я ушел!!!!', '".mktime()."' )";
     
    @mysql_query( $query );
    exit;
}
     
include 'functions.php';
include 'global.php';
     
echo setlocation( 'dummy', 10, 'dummy.php' );
     
/**
 * We will check for need of update frames
 */
    $r = 0;
    $now = mktime() - 5 * 60;//ten minutes
    $query = "DELETE FROM chat WHERE `date` < $now";
    mysql_query( $query );
     
    $query = "DELETE FROM user WHERE `lastactivity` < $now";
    mysql_query( $query );
     
    if( mysql_affected_rows() ) {
        echo setlocation( 'nicklist', 0, 'users.php' );//если есть удаленные записи то обновить ник лист
    }
     
    $query="SELECT count(*) FROM `chat`,`user`
        WHERE `chat`.`date` > `user`.`lastupdate` AND `user`.`userid` = $_SESSION[userid]";
     
    list( $row ) = mysql_fetch_array( $res = mysql_query( $query ) );
    mysql_free_result( $res );
     
    if( $row ) {
        echo setlocation( 'main', 0, 'main.php' );
    }
?>