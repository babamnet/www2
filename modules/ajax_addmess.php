<?php

include "../config.php";
# Соединямся с БД
mysql_connect($host, $db_login, $db_password);
mysql_select_db($db_name);
mysql_set_charset("utf8");
	
	sleep(1); // äåëàåì èñêóñòâåííóþ çàäåðæêó, äëÿ òîãî ÷òîáû ýìóëèðîâàòü âðåìÿ îòïðàâêè äàííûõ. Èáî íà ëîêàëüíîì ñåðâåðå ýòî ïðîèñõîäèò çà äîëè ñåêóíäû :)
	
	if ($_POST['message']!='')
	{
	$post_text = $_POST['message'];
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
    Это спам
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
		echo "</a></b></div><div style='position:relative; top:8px; left:5px; width:620px; margin-bottom:5px;'>";
		echo $comment_row['text'];
		echo "</div><div style='position:absolute; right:5px; top:3px;'><div id='colorer'>";
		echo $comment_row['date'];
		echo "</div></div>";
        echo "<div id=delcom>";
        if ($comment_row['user_id'] == $_COOKIE['id']){
        echo "<a href='modules/delete_comment.php?id=".$comment_row['id']."&user_id=".$_COOKIE['id']."'><div id='colorer'>Удалить</div></a>";}
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
    </tr>" 
    <?;
	}
	else
	{
		echo "<h2>Не удалось подрубиться!</h2>";
	}
?>