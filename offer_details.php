<?
//Import global variables
include "config.php";

mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);
mysql_set_charset("utf8");

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))

{ 
    $query = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysql_fetch_assoc($query);
    $insip = ip2long($_SERVER['REMOTE_ADDR']);

    if(($userdata['user_hash'] == $_COOKIE['hash']) and ($userdata['user_id'] == $_COOKIE['id']))
    {
        $flag = true;
    }
    else
    {
        $flag = false;
    }
}
else
{
    $flag = false;
}
if ($flag == true)
{}
else
{
    header("Location: hello.php"); 
}

if(isset($_POST['comment']))
{

    $text = $_POST['text'];
    $user_id = $_COOKIE['id'];
    $post_id = $_POST['post_id'];

    // добавляем запись в таблицу pages
    //$add_posts = "INSERT INTO wc__posts SET text='".$page_text."'";
    $add_posts = "INSERT INTO wc__comments (
      user_id,
      post_id,
      text)
    VALUES (
      '$user_id',
      '$post_id',
      '$text'
    )";
    
    if(mysql_query($add_posts)){
        clearstatcache();
        //header ("Cache-Control: no-cache"); // если запись добавилась перенаправляем к списку страниц
        header("Location: http://".$baseurl."/offer_details.php?id=".$_GET['id']."");

    }
    else{
        echo "<posts>
        <table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
        <tr style=\"border: solid 0px #000\">
        <td align=\"center\"><b>
        Connection error. Please, try later
        </b></td>
        </tr>
        </table>
        "; // если запись не добавилась, показываем ошибку
    echo $page_text;    
    }
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Предложения</title>
<meta name="generator" content="WYSIWYG Web Builder 8 - http://www.wysiwygwebbuilder.com">
<link rel="stylesheet" href="css/offer_details.css" type="text/css">
</head>
<body>
<div id="topbar"> 
<div id="container">
<div id="wb_Image9">
<img src="images/button_submit.png" id="Image9" alt="" border="0"></div>

<div id="wb_Image6">
<a href="<?echo 'http://'.$baseurl;?>">
<img src="images/logo.png" id="Image6" alt="" border="0"><? echo ($showuser['user_login']) ?></div>
</a>
<div id="wb_Text1">
<span id="wb_uid0">Главная</span></div>
<div id="wb_Text2">
<span id="wb_uid1">Профиль</span></div>
<div id="wb_Text3">
<span id="wb_uid2"><a href="logout.php?id=<?echo $_COOKIE['id']?>"><div style="color: #ffffff">Выход</div></a></span></div>
<div id="mainbody">
<div id="menu">
<iframe src="menu.php" style="border:none;" height="300"></iframe>
</div>
<div id="wb_Image12">
<img src="images/rightshadow.png" id="Image12" alt="" border="0"></div>
<div id="wb_Image13">
<img src="images/img0003.png" id="Image13" alt="" border="0"></div>
<div id="wb_Image14">
<img src="images/line.png" id="Image14" alt="" border="0"></div>

<?
$myid = $_COOKIE['id'];

//Taking of friend id
$query = mysql_query("SELECT * FROM wc__offers WHERE id = '".$_GET['id']."'");
$query = mysql_fetch_array($query);
$avka = $query['ava'];
echo ('<div id="cont">');
?>
<div id="avatar">
<img src="userupload/uploads/<?echo $avka?>.jpg" style="border: 8px solid black;">
</div>
<div id="name">
<?echo $query['name']?>
</div>
<div id="description">
<?echo $query['description']?>
</div>
<div id="rating">
<?
echo $query['rating'];
$check = mysql_fetch_array(mysql_query("SELECT * FROM wc__likes WHERE user_id = '".$_COOKIE['id']."' AND offer_id = '".$_GET['id']."'"));
?>

<?
if ($check['user_id'] == '') {
    echo ('
            <a href="modules/liker.php?id='.$_GET['id'].'"><div id="likebox">Нравится</div></a>
        ');
}
else {
    echo ('
            <a href="modules/disliker.php?id='.$_GET['id'].'"><div id="likebox">Не нравится</div></a>
        ');
}
?>
</div>
<div id="album">
    Здесь должен быть фотоальбом, которого никто еще не соизволил запилить
</div>
<div id="comments">
<?
$query = "SELECT * FROM wc__posts WHERE post_offer = '".$_GET['id']."' ORDER BY post_date DESC";
$res = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($res)) {

    $avaquery = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".$row['post_userid']."' LIMIT 1");
    $avatarparcing = mysql_fetch_assoc($avaquery);
    $definition = ".jpg";
    $username = $avatarparcing['user_name']." ".$avatarparcing['user_surname'];
    $smallavaparcing = 'http://'.$baseurl.'/userupload/uploads/'.$avka.'.jpg';
    ?>
    <tr>
    <div id="mesbox">
    <div id="wb_avaframe">
    <img src="images/avaframe.png" id="avaframe" alt="" border="0">
    <div id="wb_avatar">
    <img src="<?echo $smallavaparcing;?>" id="avatarka" alt="" border="0">
    </div>
    </div>
    <div id="wb_postframe">
    <div id="wb_postdate">
    <?echo $row['post_date']?>
    </div>
    <div id="wb_posttext">
    <?echo $row['post_text'];?>
    </div>
    <div id="wb_buttons">
    Редактировать · Комментировать
    </div>
    </div>
    <div id="commentbox" style="position:relative; left:95px; width:605px; padding-left:30px; padding-bottom: 10px;"><?
    $comment_query = mysql_query("SELECT * FROM wc__comments WHERE post_id='".$row['post_id']."'");
    //вывод коментов
    while ($comment_row = mysql_fetch_array($comment_query)) 
    {
        $comment_user = mysql_fetch_array(mysql_query("SELECT * FROM wc__superusers WHERE user_id='".$comment_row['user_id']."'"));         
        echo "<div style='position:relative; top:5px; padding-bottom: 8px; margin-bottom:5px;box-shadow: 0 0 3px 0;'>";     
        echo "<div style='position:relative; top:5px; left:5px;'><b><a href='page.php?id=".$comment_user['user_id']."'>";
        echo $comment_user['user_name'];
        echo " ";
        echo $comment_user['user_surname'];
        echo "</a></b></div><div style='position:relative; top:8px; left:5px; width:590px; margin-bottom:5px;'>";
        echo $comment_row['text'];
        echo "</div><div style='position:absolute; right:30px; top:3px;'>";
        echo $comment_row['date'];
        echo "</div>";
        echo "<div style='position:absolute; right:5px; top:3px;'>";
        echo "<a href='modules/delete_offers_comment.php?id=".$comment_row['id']."&offid=".$_GET['id']."'><img src = 'images/delete_comment.png'></a>";//худоэник был пьян
        echo "</div>";
        echo "</div>";
    }   
    ?>
    <div id="comment_post">
    <form name="comment" method="post" action="offer_details.php?id=<?echo ($_GET['id']);?>" id="comment_form">
    <input type="hidden" name="post_id" value="<?echo $row['post_id']?>">
    <input name="text" id="commentarea" rows="2" cols="107" style="width: 478px; margin-top:7px;">
    <input type="submit" id="comment_button" name="comment" value="Комментировать">
    </form>
    </div>
    </div>
    </div>
<?}?>
</div>
<? 
echo ("</table>\n");

?>
</body>
</html>