<?

// Страница авторизации

include "config.php";

# Функция для генерации случайной строки

function generateCode($length=6) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIHJKLMNOPRQSTUVWXYZ0123456789";

    $code = "";

    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {

            $code .= $chars[mt_rand(0,$clen)];  
    }

    return $code;

}



# Соединямся с БД

mysql_connect($host, $db_login,$db_password);

mysql_select_db($db_name);


if(isset($_POST['submit']))

{

    # Вытаскиваем из БД запись, у которой логин равняеться введенному

    $query = mysql_query("SELECT user_id, user_password FROM wc__superusers WHERE user_login='".mysql_real_escape_string($_POST['login'])."' LIMIT 1");

    $data = mysql_fetch_assoc($query);

    

    # Соавниваем пароли

    if($data['user_password'] === ($_POST['password']))

    {

		session_start();

        # Генерируем случайное число и шифруем его

        $hash = md5(generateCode(10));

            

        if(!@$_POST['not_attach_ip'])

        {

            # Если пользователя выбрал привязку к IP

            # Переводим IP в строку

            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";

        }

        
        # Ставим куки

        setcookie("id", $data['user_id'], time()+60*60*24*30);

        setcookie("hash", $hash, time()+60*60*24*30);
		

        # Записываем в БД новый хеш авторизации и IP

        mysql_query("UPDATE wc__superusers SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");
        

        # Переадресовываем браузер на страницу проверки нашего скрипта

        header("Location: check.php"); exit();

    }

    else

    {

        print "
        <div id='description'>
            Вы ввели неверный пароль...<br><br>Попробуйте еще раз.
        </div>
        ";

    }

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>WeClouds</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="css/register.css" type="text/css">
</head>
<body style="background: url(images/backgr.png);">
<img style="position: absolute; width: 100%; height: 100%;" src="images/backgr.png">
<div id="logobar">
<a href="http://<? echo $baseurl?>">
<div id="logo">
<img src="images/logo2.png">
</div></a>
<div id="form">
<form action="http://<?echo $baseurl?>/login.php" method="POST">
  <input name="login" type="text" value="Login" style="background-color: #ffffff; width: 100px; border-radius: 2px;">
  <input name="password" type="password" value="Password" style="background-color: #ffffff; width: 100px; border-radius: 2px;">
  <input name="submit" type="submit" value="Enter!" style="background-color: #ffffff; width: 100px; border-radius: 2px;">
</form>
</div>
</div>
<div id="topbar" style="background: url(images/bodybg.png) repeat; text-allign:absolute;">
  <div id="content">
  <div id="descblock">
    <div id="logintext">
    Логин</div>
    <div id="nametext">
    Пароль</div>
  </div>
  <div id="formblock">
<form action="http://<?echo $baseurl?>/login.php" method="POST">
  <input name="login" type="text" value="<?echo $postlogin?>" style="background-color: #ffffff; width: 100px; border-radius: 2px;"><br>
  <input name="password" type="text" value="" style="background-color: #ffffff; width: 100px; border-radius: 2px;"><br>
  <div id="submbut">
  <input name="submit" type="submit" value="Продолжить" style="background-color: #ffffff; width: 106px; border-radius: 2px;"><br>
</div>
</form>
</div>
</div>
<div id="footer_login">
  WeClouds 2012 © Все права защищены
</div>
</body>
</html>