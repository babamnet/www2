<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
   "http://www.w3.org/TR/html4/frameset.dtd">
<html>
    <frameset rows="0,50,*" onunload='alert( "выход" );'>
        <frame noresize frameborder="0" name="dummy" src="dummy.php" >
        <frame noresize frameborder="0" name="chat" src="input.php" >
        <frameset cols="200,*" onunload='alert( "выход" );'>
            <frame noresize frameborder="0"  name="nicklist" src="users.php" >
            <frame noresize frameborder="0"  name="main" src="main.php" >
        </frameset>
    </frameset>
</html>
