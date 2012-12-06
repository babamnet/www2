<?php
/** 
 * (c) Vaulter 2003 )))))
 */
     
/**
 * Sets the location of browser window
 * used for jumping to other location
 * or for refreshing page
 *
 * Устанавливает адрес окна броузера
 * используется для перехода к другому адресу
 * или для обновления страницы
 * @param string $window name of window (frame)
 * @param $time delay before refresh
 * @param $url location to go
 */
function setlocation( $window, $time, $url ) {
     
    if( $time ) {
        echo "<script type="text/javascript">
    top.$window.document.write( \"<meta http-equip=Refresh content='$time; URL=$url' />\" );
</script>";
     
    } else {
        echo "<script type="text/javascript">top.$window.location='$url';</script>";
    }
}
     
/**
 * Возвращает строку даты
 * @param unsigned int date timestamp
 * @return string representation of date
 */
function getdatestring( $datest ) {
     
    global $GMT;
     
    if( 0 == $datest ) {
        return "никогда";
    }
     
    $now = mktime() + $GMT;
    $datest += $GMT;
    $strdate = strftime( "%H:%M:%S", $datest );
     
    return $strdate;
}
?>