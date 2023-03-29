<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
	$conn=mysqli_connect('localhost','root','','k21') or die('Không kết nối được DB');
	$lang=mysqli_query($conn,"SET NAMES 'utf8'");
	
?>
</body>
</html>