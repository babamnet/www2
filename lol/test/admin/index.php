<?
include $_SERVER['DOCUMENT_ROOT']."/config.php"; //включаем файл настроек
include $_SERVER['DOCUMENT_ROOT']."/inc/db_connect.php"; //подключение к серверу MySQL и выбор БД
$user_status = 0; //обнуляем статус пользователя, 0 - пользователь не авторизован
//Читаем куки и смотрим, есть ли в базе пользователь с таким паролем, и проверяем были ли нажаты кнопки вход и выход
if (isset($_COOKIE['Login']) & isset($_COOKIE['Password']) & !$_POST['auth'] & !$_GET['exit']){
//запрос
$sql = mysql_query("SELECT * FROM ".$db_prefix."_users WHERE login = '".$_COOKIE['Login']."' && password = '".$_COOKIE['Password']."'");
//если есть совпадение, авторизуем пользователя
if (mysql_num_rows($sql) > 0){
//собираем все данные о пользователе в массив
$userinfo = mysql_fetch_array($sql);
//устанавливаем куки
SetCookie("Login",$userinfo['login']);
SetCookie("Password",$userinfo['password']);
$user_status = 1; //статус пользователя, 1 = админ авторизован
}
}
//если была нажата кнопка из формы авторизации
if ($_POST['auth']){
//ищем совпадение пары логин-пароль в таблице
$auth = mysql_query ("SELECT * FROM ".$db_prefix."_users WHERE login = '".$_POST['login']."' && password = '".$_POST ['pass']."'");
//если есть совпадение, авторизуем пользователя
if(mysql_num_rows($auth) > 0){
//собираем все данные о пользователе в массив
$userinfo = mysql_fetch_array($auth);
//устанавливаем куки
SetCookie("Login",$_POST['login']);
SetCookie("Password",$_POST['pass']);
$user_status = 1; //статус пользователя, 1 - авторизован админ
}
//если если пара логин-пароль не совпала, выводим сообщение об ошибке
else{
echo "No users with this name";
}
}
//если нажата кнопка выход
if ($_GET['exit']){
//удаляем куки
SetCookie("Login",$_POST['login']);
SetCookie("Password",$_POST['pass']);
}
//если статус пользователя не изменился, выводим форму авторизации
if ($user_status == 0){
?>

<div style="position:absolute;width:220px;height:150px;left:50%;top:50%;margin-left:-150px;margin-top:-100px;background:#777;color:#eee;border:solid 1px black;padding:10px;font-family:Tahoma,Arial,FreeSans,Garuda,Utkal,sans-serif;overflow:auto">
<form method="post" action="index.php">
Login:<br>
<input type="text" size="30" name="login"><br><br>
Password:<br>
<input type="password" name="pass" size="30"><br><br>
<input type="submit" name="auth" value="Enter">
</form>
</div>

<?
}
//если пользователь авторизовался, показываем ему админку
if ($user_status == 1){
?>

<?

// если нажата кнопка сохранить
if($_POST['save']){

    // определяем переменные
    $page_date = $_POST['page_date'];
    //Приводим дату к таймстамп виду
    $hour = substr($page_date, 0, 2);
    $minut = substr($page_date, 3, 2);
    $day = substr($page_date, 6, 2);
    $month =substr($page_date, 9, 2);
    $year =substr($page_date, 12, 4);
    $page_date = mktime ($hour, $minut, 0, $month, $day, $year);

    $page_url = $_POST['page_url'];
    $page_title = $_POST['page_title'];
    $page_text = $_POST['page_text'];

    // добавляем запись в таблицу pages
    $add_pages = "INSERT ".$db_name.".".$db_prefix."_pages (
        date,
        url, 
        title,
        text) 
    VALUES ( 
        '$page_date', 
        '$page_url',  
        '$page_title', 
        '$page_text')";

    if(mysql_query($add_pages)){
        header ("Location: ?section=pages&event=list"); // если запись добавилась перенаправляем к списку страниц
        }
    else{
        echo "При добавлении страницы возникла ошибка. Попробуйте повторить действие позднее."; // если запись не добавилась, показываем ошибку
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Control panel</title>
<meta http-equiv="Content-Language" content="ru">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="shortcut icon" href="/favicon.ico">
<link rel="stylesheet" type="text/css" href="/admin/style.css">
<script type="text/javascript" src="/inc/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/inc/AjexFileManager/ajex.js"></script>
</head>
<body>
	
	<p>Добавление новой страницы</p>

	<form action="post.php" method="post">

	    <input type="hidden" name="page_id" value=""><br><br>

	    Заголовок страницы:<br>
	    <input type="text" name="page_title" size="60" value=""><br><br>

	    Адрес страницы: <br>
	    <input type="text" name="page_url" size="60" value=""><br><br>

	    Дата добавления:
	    <input type="text" name="page_date" value=""<br><br>

	    Содержимое страницы:<br>
	    <textarea name="page_text" cols=60 rows=10></textarea>

	    <input type="submit" name="save" value="сохранить">
	</form>
	
<div class="content-top">
<p>you are <? echo $userinfo['login']; ?>. <a href="?exit=ok">exit</a></p>
</div>

<?
}
?>