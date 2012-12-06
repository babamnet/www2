<?php
/**
 * Script that will include to all others
 * common header file
 *
 * Скрипт, который будет включатся во все остальные
 * общий заголовочный файл
 */
error_reporting( E_ALL ^ E_NOTICE );
session_start();
/** DB settings - CHANGE IT TO YOUR
 *
 * БД настройки - ИЗМЕНИТЬ НА СВОИ
 */
$dbhost = "localhost";
$dblogin = "root";
$dbpass = "root";
$dbname = "weclouds";//имя БД где наши таблицы
     
$dbconnect = mysql_connect( $dbhost, $dblogin, $dbpass ) or
    myexit( __FILE__." (".__LINE__."): cannot connect to $dblogin@$dbhost/$dbname" );
     
mysql_select_db( $dbname );
     
/**
 * тут нет никаких проверок на ошибки, поэтому лучше чтобы
 * 1. mySQL user с логином root был
 * 2. chat БД была )
 */
//set activity if user loginned
if( $_SESSION['userid'] ) {
    $query = "UPDATE `user` SET `lastactivity` = '".mktime()."' WHERE `userid` = '$_SESSION[userid]'";
    @mysql_query( $query );//апдейтим lastactivity и глушим вывод об ошибках
     
    $query = "SELECT * FROM `user` WHERE `userid` = '$_SESSION[userid]'";
    global $user;
    $user = mysql_fetch_assoc( $res = mysql_query( $query ) );//берез данные о юзере
     
    mysql_free_result( $res );
}
?>