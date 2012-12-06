<?php

	$id = intval($_POST['id']);

	# Удаляем ккомментарий из базы данных
	if ($id>0)
	{
		$connect_db = mysql_connect("localhost", "root", "");
		mysql_select_db("guest", $connect_db);
		#mysql_query("DELETE FROM message WHERE id=$id"); // удаляем
		mysql_query("UPDATE message SET approve='0' WHERE id='$id'"); // либо просто не показываем
	}
	
?>