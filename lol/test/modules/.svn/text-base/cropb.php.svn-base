<?
include ('../config.php');
mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);
$add_photo = "INSERT INTO  wc__images (ID) VALUES (NULL)";
	$photo_name = "SELECT * FROM wc__images WHERE ID = last_insert_id()";
	mysql_query($add_photo);
	$newname = mysql_query($photo_name);
	$name = mysql_fetch_assoc($newname);
	$newname = $name['ID'];
	mysql_query("UPDATE wc__superusers SET user_avatar = '".$newname."' WHERE user_id='".$_COOKIE['id']."'");

require_once(dirname(__FILE__)."/class.upload.php");
$handle = new Upload('files/'.$_COOKIE['id'].'.jpg');
$handle->image_resize        = true;
$handle->image_x             = 906;
$handle->image_y             = 345;
$handle->image_ratio         = true;
$savepath = dirname(__FILE__)."../userupload/uploads/";
$handle->Process($savepath);
$handle->Clean();
//unlink('files/'.$_COOKIE['id'].'.jpg');
/*
function resize_photo($src,$src2){
    $params = getimagesize($src);
        switch ( $params[2] ) {
        case 1: $source = imagecreatefromgif($src); break;
        case 2: $source = imagecreatefromjpeg($src); break;
        case 3: $source = imagecreatefrompng($src); break;
        }
    $max_size = 224;
 
    if (  $params[1]>$max_size ) {
        if ( $params[0]>$params[1] ) $size = $params[0];
        else $size = $params[1];
        $resource_width = floor($params[0] * $max_size / $size);
        $resource_height = floor($params[1] * $max_size / $size);
        $resource = imagecreatetruecolor($resource_width, $resource_height);
        imagecopyresampled($resource, $source, 0, 0, 0, 0, $resource_width, $resource_height, $params[0], $params[1]);
    }
    else $resource = $source;
    $resource_src = $src2;
    imageJpeg($resource, $resource_src);
                            
}
                            
function crop_photo($src,$src2,$x,$y,$x2,$y2,$w11,$h11){
    $targ_w = $w11;
    $targ_h = $h11;
 
    $jpeg_quality = 90;
 
    $img_r = imagecreatefromjpeg($src);
    echo ((int) $targ_w);
    echo "<br>";
    echo $targ_h;
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
 
    imagecopyresampled($dst_r,$img_r,0,0,$x,$y,
    $targ_w,$targ_h,$x2,$y2);
 
 
    imageJpeg($dst_r,$src2,$jpeg_quality);
}
                            
function make_small_photo($src,$src2){
    $params = getimagesize($src);
    $w = $params[0];
    $h = $params[1];
    if (round($w/$h,2)==0.75){
        resize_photo($src,$src2); // если соотношения такие, как нужно, то просто меняем размер
    }else
    if (round($w/$h,2)>0.75){ //если ширина больше, то обрезаем по центру, высоту не трогаем
 
    $e = $h/345;
    echo $e;
    echo "<br>";
    $w2 = 906*$e;
    echo $w2;
    echo "<br>";
    $x1 = ($w - $w2)/2;
    $x2 = $w2;
    $y1 = 0;
    $y2 = 345*$e;
    
    crop_photo($src,$src2,$x1,$y1,$x2,$y2,$w2,$w2/0.75);
    resize_photo($src2,$src2);
    }
    else
    if (round($w/$h,2)<0.75){ //если высота больше, то обрезаем по центру, ширину не трогаем
    $e = $w/345;
    $h2 = 906*$e;
    $y1 = ($h - $h2)/2;
    $y2 = $h2;
    $x1 = 0;
    $x2 = 345*$e;
    
    crop_photo($src,$src2,$x1,$y1,$x2,$y2,$h2*0.75,$h2);
    resize_photo($src2,$src2);
    }
                    
}
make_small_photo('files/'.$_COOKIE['id'].'.jpg','../userupload/uploads/'.$newname.'.jpg');*/
//header("Location: ../settings.php")
?>