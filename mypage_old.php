<?

// Скрипт проверки
include "config.php";
# Соединямся с БД
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
{
//header("Location: mypage.php"); если включить запускает рекурсию
}
else
{
header("Location: hello.php"); 
}


//Выход пользователя

if($_POST['exit']){
	
	$hash  = "0000";
	
       mysql_query("UPDATE wc__superusers SET user_hash='".$hash."' WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
	   
	header("Location: http://".$baseurl."/");
}

// если нажата кнопка сохранить
if($_POST['save']){

    $post_text = $_POST['text'];
    $post_userid = $_COOKIE['id'];
    $post_repostid = '0';
    $post_repoststatus = false;

    // добавляем запись в таблицу pages
    //$add_posts = "INSERT INTO wc__posts SET text='".$page_text."'";
    $add_posts = "INSERT INTO wc__posts (
      post_text,
      post_repostid,
      post_userid,
      post_repoststatus)
    VALUES (
      '$post_text',
      '$post_repostid',
      '$post_userid',
      '$post_repoststatus'
    )";
    
    if(mysql_query($add_posts)){
        clearstatcache();
        //header ("Cache-Control: no-cache"); // если запись добавилась перенаправляем к списку страниц
        header("Location: http://".$baseurl."/");

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
if($_POST['comment']){

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
        header("Location: http://".$baseurl."/");

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


$avaquery = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
$avatarparcing = mysql_fetch_assoc($avaquery);
$nm = $avatarparcing['user_name'].' '.$avatarparcing['user_surname'];
$definition = ".jpg";
$smallavaparcing = $avatarparcing['user_smallavatar'].$definition;
$avatarpreview = '/userupload/uploads/'.$smallavaparcing;// width="75" height="75"
$smallavaparcing = 'http://'.$baseurl.'/userupload/uploads/'.$smallavaparcing;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Моя страница</title>
<meta name="generator" content="WYSIWYG Web Builder 8 - http://www.wysiwygwebbuilder.com">
<link rel="stylesheet" href="css/index.css" type="text/css">
<link rel="stylesheet" href="popups/avachange/style.css" type="text/css"/>
<script type="text/javascript" src="popups/avachange/jquery.js"></script>
<script type="text/javascript" src="popups/avachange/facebox.js"></script>
<script type="text/javascript">

jQuery(document).ready(function($) {

$('a[rel*=facebox]').facebox({

loading_image : 'loading.gif',

close_image   : '/popups/avachange/closelabel.gif'

}) 

})

</script>
</head>
<body>
<div id="topbar"> 
<div id="container">
<div id="wb_Image5">
<img src="images/top_background.png" id="Image5" alt="" border="0"></div>

<div id="wb_Image1">
<img src="<?echo ($smallavaparcing);?>" id="Image1" alt="" border="10" border-color="ffffff" width="100" height="100">
<div style =  "color:#aaa; font-family:Arial; font-size:12px; vertical-align: middle;"><a href="#info" rel="facebox"><div style="color:#aaa; text-align:center; width:120px;">Изменить</div></a></div></div>

<div id="info" style="display:none;">
<iframe src="modules/avachange.php" frameborder="0" style="width:700px;"></iframe>
</div>

<div id="usernamelg">
<?echo $nm?>
</div>
<div id="wb_Image6">
<a href="<?echo 'http://'.$baseurl;?>">
<img src="images/logo.png" id="Image6" alt="" border="0"><? echo ($showuser['user_login']) ?></div>
</a>

<div id="wb_Text4">
<span id="wb_uid3"><a href="modules/page_config.php"><div style="color:#aaa;">Настройки</div></a></span></div>
<div id="wb_Image10">
<img src="images/button_settings.png" id="Image10" alt="" border="0"></div>
<div id="topmenu" style="position:absolute; right: 10px;">
    <iframe src="modules/topmenu.php" frameborder="no"></iframe>
</div>
<div id="wb_Form2">
<form name="save" method="post" action="mypage.php" id="Form2">
<input type="hidden" name="page_id" value="">
<textarea name="text" id="TextArea1" rows="2" cols="107"></textarea>
<input type="submit" id="Button2" name="save" value="Разместить" style="background-color: #ccc; color:#000; width: 100px; border-radius: 2px;">
</form>
<div id="wb_Image11">
<img src="images/button_calendar.png" id="Image11" alt="" border="0"></div>
</div>
</div>
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
/* Соединяемся с базой данных */
/* Таблица MySQL, в которой хранятся данные */
$table = "wc__posts";
 
/* Создаем соединение */
mysql_connect($host , $db_login, $db_password) or die ("Не могу создать соединение");
 
/* Выбираем базу данных. Если произойдет ошибка - вывести ее */
mysql_select_db($db_name) or die (mysql_error());

$query = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
$showuser = mysql_fetch_assoc($query);
 
/* Составляем запрос для извлечения данных из полей "name", "email", "theme",
"message", "data" таблицы "test_table" */
$query = "SELECT post_id, post_text, post_repostid, post_date, post_userid, post_repoststatus FROM $table WHERE post_userid = '".intval($_COOKIE['id'])."' ORDER BY post_date DESC";

//$userquery = "SELECT user_id, user_login FROM wc__superusers";
//$showuser = mysql_fetch_assoc($userquery) or die(mysql_error());
$username = $showuser['user_name'].' '.$showuser['user_surname'];
/* Выполняем запрос. Если произойдет ошибка - вывести ее. */
$res = mysql_query($query) or die(mysql_error());

echo ('
<div id="cont"> 
<table border="0" cellpadding="0" cellspacing="0">
');
/* Цикл вывода данных из базы конкретных полей */
while ($row = mysql_fetch_array($res)) {
    if ($row['post_repoststatus'] == false)
  {
    ?>
    <tr>
    <div id="mesbox">
    <div id="wb_avaframe">
    <img src="images/avaframe.png" id="avaframe" alt="" border="0">
    <div id="wb_avatar">
    <img src="<?echo($smallavaparcing);?>" id="avatar" alt="" border="0">
    </div>
    </div>
    <div id="wb_postframe">
    <div id="wb_postuser">
    <?echo "<b>".$username."</b>"?>
    </div>
    <div id="wb_postdate">
    <?echo $row['post_date']?>
    </div>
    <div id="wb_posttext">
    <?echo $row['post_text'];?>
    </div>
    <div id="wb_buttons">
    Редактировать · Комментировать · <a href="modules/delete_post.php?id=<?echo $row['post_id'];?>" style="color: #aaaaaa;">Удалить</a>
    </div>
    </div>
	<div id="commentbox" style="position:relative; left:95px; width:605px; padding-left:30px; padding-bottom: 10px;"><?
	$comment_query = mysql_query("SELECT * FROM wc__comments WHERE post_id='".$row['post_id']."'");
	while ($comment_row = mysql_fetch_array($comment_query)) {
		$comment_user = mysql_fetch_array(mysql_query("SELECT * FROM wc__superusers WHERE user_id='".$comment_row['user_id']."'"));			
		echo "<div style='position:relative; top:5px; padding-bottom: 8px; margin-bottom:5px;box-shadow: 0 0 3px 0;'>";		
		echo "<div style='position:relative; top:5px; left:5px;'><b><a href='page.php?id=".$comment_user['user_id']."'>";
		echo $comment_user['user_name'];
		echo " ";
		echo $comment_user['user_surname'];
		echo "</a></b></div><div style='position:relative; top:8px; left:5px; width:600px; margin-bottom:5px;'>";
		echo $comment_row['text'];
		echo "</div><div style='position:absolute; right:5px; top:3px;'>";
		echo $comment_row['date'];
        echo "</div>";
        echo "<div id=delcom>";
        //if ($comment_row['user_id'] == $_COOKIE['id']){
        echo "<a href='modules/delete_comment.php?id=".$comment_row['id']."'>Удалить</a>";//}
		echo "</div>";
		echo "</div>";
	}	
	?>
    <div id="comment_post">
    <form name="comment" method="post" action="mypage.php" id="comment_form">
    <input type="hidden" name="post_id" value="<?echo $row['post_id']?>">
    <input name="text" id="commentarea" rows="2" cols="107">
    <input type="submit" id="comment_button" name="comment" value="Комментировать">
    </form>
    </div>
    </div>
    </div>
    </tr>
    <?
  }
  else
  {
    ?>
    <tr>
    <div id="mesbox">
    <div id="wb_avaframe">
    <img src="images/avaframe.png" id="avaframe" alt="" border="0">
    <div id="wb_avatar">
    <img src="<?echo($smallavaparcing);?>" id="avatar" alt="" border="0">
    </div>
    </div>
    <div id="wb_postframe">
    <div id="wb_postuser">
    <?echo "<b>".$username."</b>"?>
    </div>
    <div id="wb_postdate">
    <?echo $row['post_date']?>
    </div>
    <div id="wb_repost">
    <?
    $rep = mysql_query("SELECT post_id, post_text, post_userid FROM wc__posts WHERE post_id = '".$row['post_repostid']."' LIMIT 1");
    $rep = mysql_fetch_array($rep);
    $rep_user = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".$rep['post_userid']."' LIMIT 1");
    $rep_user = mysql_fetch_assoc($rep_user);
    $rep_user = $rep_user['user_name'].' '.$rep_user['user_surname'];
    echo '<b>'.$rep_user.'</b><br><div style="padding-top: 3px;">'.$rep['post_text'].'</div>';?>
    </div>
    <div id="wb_buttons">
    Редактировать · Комментировать · <a href="modules/delete_post.php?id=<?echo $row['post_id'];?>" style="color: #aaaaaa;">Удалить</a>
    </div>
    </div>
	<div id="commentbox" style="position:relative; left:95px; width:605px; padding-left:30px; padding-bottom: 10px;"><?
	$comment_query = mysql_query("SELECT * FROM wc__comments WHERE post_id='".$row['post_id']."'");
	while ($comment_row = mysql_fetch_array($comment_query)) {
		$comment_user = mysql_fetch_array(mysql_query("SELECT * FROM wc__superusers WHERE user_id='".$comment_row['user_id']."'"));			
		echo "<div style='position:relative; top:5px; padding-bottom: 8px; margin-bottom:5px;box-shadow: 0 0 3px 0;'>";		
		echo "<div style='position:relative; top:5px; left:5px;'><b><a href='page.php?id=".$comment_user['user_id']."'>";
		echo $comment_user['user_name'];
		echo " ";
		echo $comment_user['user_surname'];
		echo "</a></b></div><div style='position:relative; top:8px; left:5px; width:600px; margin-bottom:5px;'>";
		echo $comment_row['text'];
		echo "</div><div style='position:absolute; right:5px; top:3px;'>";
		echo $comment_row['date'];
		echo "</div>";
        echo "<div id=delcom>";
        echo "<a href='modules/delete_comment.php?id=".$comment_row['id']."'>Удалить</a>";
        echo "</div>";
		echo "</div>";
	}	
	?>
    <div id="comment_post">
    <form name="comment" method="post" action="mypage.php" id="comment_form">
    <input type="hidden" name="post_id" value="<?echo $row['post_id']?>">
    <input name="text" id="commentarea" rows="2" cols="107">
    <input type="submit" id="comment_button" name="comment" value="Комментировать">
    </form>
    </div>
    </div>
    </div>
    </tr>
    <?
  }
}
 
echo ("</table></div></div></body>");
?>
 
</body>
</html>
