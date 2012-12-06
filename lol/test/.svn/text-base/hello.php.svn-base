<?
include "config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>WeClouds</title>
<link rel="stylesheet" href="styles/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<script src="scripts/cufon-yui.js" type="text/javascript"></script>
<script src="scripts/Museo_Slab.font.js" type="text/javascript"></script>
<script src="scripts/jquery.nivo.slider.pack.js" type="text/javascript"></script>

<script type="text/javascript">
Cufon.replace('h2', { fontFamily:'Museo Slab' });
Cufon.replace('h3', { fontFamily:'Museo Slab' });

$(window).load(function() {
	$('#slider1').nivoSlider({ pauseTime:5000, pauseOnHover:false });
	setTimeout(function(){
		$('#slider2').nivoSlider({ pauseTime:5000, pauseOnHover:false });
	}, 1000);
	setTimeout(function(){
		$('#slider3').nivoSlider({
			pauseTime:5000,
			pauseOnHover:false,
			controlNavThumbs:true
		});
	}, 2000);
	setTimeout(function(){
		$('#slider4').nivoSlider({
			effect:'random',
			animSpeed:1500,
			pauseTime:5000,
			startSlide:2,
			directionNav:false,
			controlNav:true,
			keyboardNav:false,
			pauseOnHover:false
		});
	}, 3000);
});
</script>
	<link rel="stylesheet" href="css/hello.css" type="text/css">
</head>
<body style="background: url(images/backgr.png);">
<div id="logobar">
<div id="logo">
<img src="images/logo2.png">
</div>
<div id="form">
<form action="http://<?echo $baseurl?>/login.php" method="POST">
	<input name="login" type="text" value="Login" style="background-color: #ffffff; width: 100px; border-radius: 2px;">
	<input name="password" type="password" value="Password" style="background-color: #ffffff; width: 100px; border-radius: 2px;">
	<input name="submit" type="submit" value="Enter!" style="background-color: #ffffff; width: 100px; border-radius: 2px;">
</form>
</div>
</div>
<div id="topbar" style="background: url(images/bodybg.png) repeat;">
	<div id="content">
		<div id="texter">
			Взгляните по-другому на виртуальный мир
		</div>
		<div id="texterline">
			WeClouds - тонкий намек на твое превосходство
		</div>
		<div id="block" style="background: url(images/backgr.png); box-shadow: 10px;">
		<div id="blocktext">
			<div style="font-size: 20px;">На WeClouds Вы сможете:</div><br>-Общаться с друзьями<br>-Развивать свои идеи<br>-Обмениваться интересными новостями<br>-Создать свой мир
		</div>
		<a href="register.php">
		<div id="button">
			<img src="images/blockbutton.png" style="position: absolute;">
			<div id="buttontext">
				Присоединиться!
			</div>	
		</div>
		</a>
		</div>
		<div id="prev">
		<div id="slider1" class="nivoSlider">
			<img src="images/up.jpg" alt="" />
			<img src="images/monstersinc.jpg" alt="" />
			<img src="images/nemo.jpg" alt="" />
			<img src="images/walle.jpg" alt="" />
		</div>
		</div>
	</div>	
</div>
<div id="footer">
	WeClouds 2012 Все права защищены
</div>
</body>
</html>