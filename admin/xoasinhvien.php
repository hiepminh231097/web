
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 <meta http-equiv="refresh" content="0.5 url=http://localhost/quanly/index/quanlysinhvien.php" >
	<title>Xóa</title>
</head>
<body>
	<?php
	
	include('../connect/ketnoi.php');
	$MaSV=$_GET['MaSV'];
	$sql="DELETE FROM sinhvien WHERE MaSV = '$MaSV'";
	$kq=mysqli_query($conn,$sql);
	if ($kq) {
		header("http://localhost/quanly/index/quanlysinhvien.php");
	}
	?>
</body>
</html>