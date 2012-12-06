<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>WeClouds l Добро пожаловать!</title>
<style type="text/css">
div#container
{
   width: 896px;
   position: relative;
   margin-top: 0px;
   margin-left: auto;
   margin-right: auto;
   text-align: left;
}
body
{
   text-align: center;
   margin: 0;
   background-color: #FFFFFF;
   background-image: url(template/images/shattered.png);
   color: #000000;
}
</style>
<style type="text/css">
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
p, span, div, ol, ul, li, input, textarea, form
{
   margin: 0;
   padding: 0;
}
ol, ul
{
   list-style-position:inside;
}
</style>
<style type="text/css">
#wb_Text1
{
   background-color: transparent;
   border: 0px #C0C0C0 solid;
}
#wb_Text2
{
   background-color: transparent;
   border: 0px #C0C0C0 solid;
}
#wb_Text3
{
   background-color: transparent;
   border: 0px #C0C0C0 solid;
}
</style>
<style type="text/css">
div#container
{
   width: 903px;
   position: relative;
   margin-top: 0px;
   margin-left: auto;
   margin-right: auto;
   text-align: left;
}
</style>
<style type="text/css">
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
p, span, div, ol, ul, li, input, textarea, form
{
   margin: 0;
   padding: 0;
}
ol, ul
{
   list-style-position:inside;
}
</style>
<style type="text/css">
#wb_Form1
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#Editbox1
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Editbox2
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Button1
{
   color: #000000;
   font-family: Arial;
   font-size: 13px;
}
</style>
<script type="text/javascript" src="./js/swfobject.js"></script>
</head>
<body>
<div style="background: url(images/backg.png) repeat-x; height: 60px; color: #fff">
<?
/* Соединяемся с базой данных */
$hostname = "localhost"; // название/путь сервера, с MySQL
$username = "root"; // имя пользователя (в Denwer`е по умолчанию "root")
$password = "root"; // пароль пользователя (в Denwer`е по умолчанию пароль отсутствует, этот параметр можно оставить пустым)
$dbName = "weclouds"; // название базы данных
$db_prefix = "wc__";
 
/* Таблица MySQL, в которой хранятся данные */
$table = "wc__pages";
 
/* Создаем соединение */
mysql_connect($hostname, $username, $password) or die ("Не могу создать соединение");
 
/* Выбираем базу данных. Если произойдет ошибка - вывести ее */
mysql_select_db($dbName) or die (mysql_error());

$query = mysql_query("SELECT *,INET_NTOA(user_ip) FROM wc__superusers WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
$showuser = mysql_fetch_assoc($query);


if($_POST['exit']){
       setcookie("id", "");

       setcookie("hash", "");
	
	header("Location: http://localhost:8888/hello.php");
}
?>	
you are <? echo ($showuser['user_login']) ?>.<br><p><form action="content.php" method="post"><input type="submit" name="exit" value="Logout"></form></p>
</div>	
<?
 
/* Составляем запрос для извлечения данных из полей "name", "email", "theme",
"message", "data" таблицы "test_table" */
$query = "SELECT id, date, url, title, text FROM $table";

//$userquery = "SELECT user_id, user_login FROM wc__superusers";
//$showuser = mysql_fetch_assoc($userquery) or die(mysql_error());

/* Выполняем запрос. Если произойдет ошибка - вывести ее. */
$res = mysql_query($query) or die(mysql_error());
 
/* Выводим данные из таблицы */
echo ("
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
 
<head>
 
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
 
    <title>Вывод данных из MySQL</title>
 
<style type=\"text/css\">
<!--
body { font: 12px Georgia; color: #666666; }
h3 { font-size: 16px; text-align: center; }
table { width: 700px; border-collapse: collapse; margin: 0px auto; background: #E6E6E6; }
td { padding: 3px; text-align: center; vertical-align: middle; }
.buttons { width: auto; border: double 1px #666666; background: #D6D6D6; }
-->
</style>
 
</head>
 
<body>
 
<h3>My posts</h3>
 
<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
 <tr style=\"border: solid 1px #000\">
  <td align=\"center\"><b>Theme</b></td>
  <td align=\"center\"><b>url</b></td>
  <td align=\"center\"><b>Text</b></td>
 </tr>
");
 
/* Цикл вывода данных из базы конкретных полей */
while ($row = mysql_fetch_array($res)) {
    echo "<tr>\n";
    echo "<td>".$row['url']."</td>\n";
    echo "<td>".$row['title']."</td>\n";
    echo "<td>".$row['text']."</td>\n";
}
 
echo ("</table>\n");
 



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
    $add_pages = "INSERT INTO wc__pages SET text='".$page_text."'";

    if(mysql_query($add_pages)){
		//clearstatcache();
        //header ("Cache-Control: no-cache"); // если запись добавилась перенаправляем к списку страниц
        header("Location: http://localhost:8888/");
		}
    else{
        echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
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
<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
 <tr style=\"border: solid 1px #000\">
	 <td align=\"center\"><b>
 
	<form action="content.php" method="post">

	    <input type="hidden" name="page_id" value=""><br><br>
	    Text:<br>
	    <textarea name="page_text" cols=60 rows=10></textarea>

	    <input type="submit" name="save" value="Send">
	</form>
	
<div class="content-top">
</b></td>
</tr>
</table>
</body>
</html>