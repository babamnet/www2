<?php

	$name = strip_tags(iconv('utf-8','windows-1251',$_POST['name']));
	$message = strip_tags(iconv('utf-8','windows-1251',$_POST['message']));
	$email = strip_tags(iconv('utf-8','windows-1251',$_POST['email']));
	
	sleep(1); // делаем искуственную задержку, для того чтобы эмулировать время отправки данных. Ибо на локальном сервере это происходит за доли секунды :)
	
	if (($name!='')&&($message!=''))
	{
		$connect_db = mysql_connect("localhost", "root", "");
		mysql_select_db("guest", $connect_db);
	
		mysql_query("INSERT INTO message (mess, author, email, approve) VALUES ('$message','$name','$email','1')");
		
		echo "<div align='left' style='width:580px; border: 1px solid black; background-color: #ccc; margin:5px; padding:5px;'>
				<b> Сообщение добавил:</b> $name <br/>
				<b> email:</b> $email <br/>
				<b> Сообщение: </b> <br/>
				$message	
				<div id='add_now' ></div>
			</div>" ;
	}
	else
	{
		echo "<h2>Заполните поле имя и текст!</h2>";
	}
?>