<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>Гостевая книга Димки</title>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
		<script src="jquery-1.3.2.min.js" language="JavaScript" type="text/javascript" ></script>
		<script type="text/javascript">		
			function ajax_addmess()
			{
				//Получаем параметры
				var name = $('#name').val();
				var email = $('#email').val();
				var message = $('#message').val();
				
				if ((name!='')&&(message!=''))
				{
					//$("#load").show('fast');
					$("#load").fadeIn('slow');
					
					// Отсылаем паметры
					 $.ajax({
					   type: "POST",
					   url: "ajax_addmess.php",
					   data: "name="+name+"&message="+message+"&email="+email,
					   // Выводим то что вернул PHP
					   success: function(html){
						$("#result").append(html);
						$("#result").slideDown('slow');
						// Убираем хрень
						$("#load").fadeOut('slow');
					  }
					 });
				}
				else
				{
					if ((name=='')&&(message==''))
					{
						alert ("Введите ваше имя и текст сообщения.");
					}
					else if (name=='')
					{
						alert ("Заполните ваше имя.");
					}
					else if (message=='')
					{
						alert ("Заполните текст сообщения.");
					}
				}
			}
			
			function del(id)
			{
				// Отсылаем паметры
				$.ajax({
					type: "POST",
					url: "ajax_delmess.php",
					data: "id="+id,
					// Выводим то что вернул PHP
					success: function(html){
						$("#mess-"+id).slideUp('slow');
					}
				});
			}
		</script>
	</head>
	<body>
		<div align='center' style='margin: 0px auto;  '>
			<div style='width:600px;'>
				<h2> Гостевая книга Димки :-) </h2>
				
				<?php
				Error_Reporting(E_ALL & ~E_NOTICE);

				$connect_db = mysql_connect("localhost", "root", "");
				mysql_select_db("guest", $connect_db);
				
				$db_mess=mysql_query("SELECT * FROM message WHERE approve=1 ORDER BY `id` ASC");
				while ($row = mysql_fetch_array($db_mess))
				{
					echo "<div id='mess-$row[id]' align='left' style='width:580px; border: 1px solid black; background-color: #EFEFEF; margin:5px; padding:5px;'>
						<b> Сообщение добавил:</b> $row[author] <br/>
						<b> email:</b> $row[email] <br/>
						<b> Сообщение: </b> <br/>
						$row[mess]	
						<div id='add_now'></div>
						<a href='#' onclick='del(".$row['id'].");return false;'>Удалить</a>
					</div>" ;
				}
				
				?>
				
				<!-- Вывод динамически новых сообщений  -->

					<!-- Сообщение об отправки данных -->
					<div id='load' align='center' style="display: none; width:600px; position:fixed; top:200px;"> 
						<div style='width: 200px; height:60px; border: 1px solid #545454; background-color: white;'>
							<div style='padding:10px;'><b>отправка данных...</b></div>
							<img src='images/loading.gif' alt='загрузка' />
						</div>
					</div>
					
					<!-- Форма отправки сообщения -->
					<table width='100%' >
						<tr height='25px'>
							<td  colspan='2'>Форма добавления сообщения</td>
						</tr>
						<tr height='25px'>
							<td width='200px'> Ваше имя: </td>
							<td><input style='border: 1px solid #CCCCCC;' type='text' size='50' id='name' /></td>
						</tr>
						<tr height='25px'>
							<td>E-mail: </td>
							<td> <input style='border: 1px solid #CCCCCC;' type='text' size='50' id='email' /> </td>
						</tr>
						<tr>
							<td colspan='2'>
								<textarea id='message' style='border: 1px solid #CCCCCC;' rows='3' cols='70' ></textarea> 
							</td>
						</tr>
						<tr>
							<td align='center' colspan='2'><input style='border: 1px solid #CCCCCC;' onclick="ajax_addmess();" type="submit" value="Отправить"/>
						</tr>
					</table>		
				</div>
								<div  style="display: none;" id='result'></div>
				
				<div style='width:100%; border:1px solid #cccccc;'>
				
				Сотворено с божьей помощью. С использованием jQuery 1.3.2 <br/> <a href='http://ht-expert.ru' alt='ht-expert.ru'>ht-expert.ru</a>
			</div>
		</div>
	</body>
</html>