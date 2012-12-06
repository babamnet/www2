<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Подгрузка контента jQuery.ajax()</title>
  <script src="jquery-1.8.2.js" type="text/javascript"></script>  
  <script type="text/javascript">
  $(document).ready(function(){
       $.ajax({
         url: "content.php",
         type: "GET",
         cache:true,
         data: {id: "<?echo $_GET['id']?>", userid: "<?echo $_COOKIE['id']?>"},
         success: function(data){  
           $("#dataUpload").html(data);
         }
       });
  });
  </script>
</head>
<body>
<div id="dataUpload"></div>
</body>

</html>