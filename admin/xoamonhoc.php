
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 <meta http-equiv="refresh" content="0.5 url=http://localhost/quanly/admin/danhsachmonhocmo.php" >
	<title>Xóa</title>
</head>
<body>
	<?php
	
	include('../connect/ketnoi.php');
	$MaMH=$_GET['MaMH'];
	$sql="DELETE FROM dangkymh WHERE MaMH = '$MaMH'";
	$kq=mysqli_query($conn,$sql);
	if ($kq) {
		header("http://localhost/quanly/admin/danhsachmonhocmo.php" );
	}
	?>
</body>
</html>