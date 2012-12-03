<?
//Import global variables
include "config.php";

// Check scrypt
// Connection to database
mysql_connect($host, $db_login, $db_password);
// Select datbase
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
if($_POST['search']){
    $keywords = $_POST['keywords'];
    echo $keywords;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Друзья</title>
<meta name="generator" content="WYSIWYG Web Builder 8 - http://www.wysiwygwebbuilder.com">
<link rel="stylesheet" href="css/search.css" type="text/css">
<link rel="stylesheet" href="scripts/jqtransformplugin/jqtransform.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/form.css" type="text/css" media="all" />
    
    <script type="text/javascript" src="scripts/requiered/jquery.js" ></script>
    <script type="text/javascript" src="scripts/jqtransformplugin/jquery.jqtransform.js" ></script>
    <script language="javascript">
        $(function(){
            $('form').jqTransform({imgPath:'jqtransformplugin/img/'});
        });
    </script>
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
<iframe src="menu.php" style="border:none;" height="300" width="164" scrolling="no"></iframe>
</div>
<div id="wb_Image12">
<img src="images/rightshadow.png" id="Image12" alt="" border="0"></div>
<div id="wb_Image13">
<img src="images/img0003.png" id="Image13" alt="" border="0"></div>
<div id="wb_Image14">
<img src="images/line.png" id="Image14" alt="" border="0"></div>
<div id="cont"> 
<div id="searchform">
<form class="jqtransform">
<div class="rowElem">
<input type="text" name="name" style="width:500px;"/>
<input type="submit" value="send"/><div>
</form>
</div>
<div id="results">
<div class="tabs">
    <a href="#one"><div id="button1">Люди</div></a>
    <a href="#two"><div id="button2">Записи</div></a>
    <a href="#three"><div id="button3">Предложения</div></a>
    <a href="#four"><div id="button4">Видео</div></a>
    <a href="#five"><div id="button5">Музыка</div></a>
</div>
<div class="tabs-content">
<ul>
    <li id="one">Содержимое 1-й вкладки</li>
    <li id="two">Содержимое 2-й вкладки</li>
    <li id="three">Содержимое 3-й вкладки</li>
    <li id="four">Содержимое 4-й вкладки</li>
    <li id="five">Содержимое 5-й вкладки</li>
</ul>
</div>
</div>
</body>
</html>