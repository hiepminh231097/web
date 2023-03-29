<?php if (session_id() == '' || !isset($_SESSION)) {
  session_start();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Thêm nhân viên | Quản trị Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <!-- or -->
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <script>

    function readURL(input, thumbimage) {
      if (input.files && input.files[0]) { //Sử dụng  cho Firefox - chrome
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#thumbimage").attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
      else { // Sử dụng cho IE
        $("#thumbimage").attr('src', input.value);

      }
      $("#thumbimage").show();
      $('.filename').text($("#uploadfile").val());
      $('.Choicefile').css('background', '#14142B');
      $('.Choicefile').css('cursor', 'default');
      $(".removeimg").show();
      $(".Choicefile").unbind('click');

    }
    $(document).ready(function () {
      $(".Choicefile").bind('click', function () {
        $("#uploadfile").click();

      });
      $(".removeimg").click(function () {
        $("#thumbimage").attr('src', '').hide();
        $("#myfileupload").html('<input type="file" id="uploadfile"  onchange="readURL(this);" />');
        $(".removeimg").hide();
        $(".Choicefile").bind('click', function () {
          $("#uploadfile").click();
        });
        $('.Choicefile').css('background', '#14142B');
        $('.Choicefile').css('cursor', 'pointer');
        $(".filename").text("");
      });
    })
  </script>
</head>

<body class="app sidebar-mini rtl">
  <style>
    .Choicefile {
      display: block;
      background: #14142B;
      border: 1px solid #fff;
      color: #fff;
      width: 150px;
      text-align: center;
      text-decoration: none;
      cursor: pointer;
      padding: 5px 0px;
      border-radius: 5px;
      font-weight: 500;
      align-items: center;
      justify-content: center;
    }

    .Choicefile:hover {
      text-decoration: none;
      color: white;
    }

    #uploadfile,
    .removeimg {
      display: none;
    }

    #thumbbox {
      position: relative;
      width: 100%;
      margin-bottom: 20px;
    }

    .removeimg {
      height: 25px;
      position: absolute;
      background-repeat: no-repeat;
      top: 5px;
      left: 5px;
      background-size: 25px;
      width: 25px;
      /* border: 3px solid red; */
      border-radius: 50%;

    }

    .removeimg::before {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      content: '';
      border: 1px solid red;
      background: red;
      text-align: center;
      display: block;
      margin-top: 11px;
      transform: rotate(45deg);
    }

    .removeimg::after {
      /* color: #FFF; */
      /* background-color: #DC403B; */
      content: '';
      background: red;
      border: 1px solid red;
      text-align: center;
      display: block;
      transform: rotate(-45deg);
      margin-top: -2px;
    }
  </style>
  <!-- Navbar-->
	<?php 
	include('../connect/ketnoi.php');
	?>
  <header class="app-header">
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
      aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">


      <!-- User Menu-->
      <li><a class="app-nav__item" href="/index.html"><i class='bx bx-log-out bx-rotate-180'></i> </a>

      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <?php
		  	 $username = $_SESSION['username'] ;
    $sql="SELECT * FROM sinhvien WHERE username='$username'";
    $kq=mysqli_query($conn,$sql);
    if (mysqli_num_rows($kq) > 0) {
      {while ($row= mysqli_fetch_assoc($kq)) {
            # code...
            echo" <div class='app-sidebar__user'><img class='app-sidebar__user-avatar' src='../images/$row[anh]' width='50px' alt='User Image'>";
          }
          }
    }
		  ?>
      <div>
		  <?php
		  	 $username = $_SESSION['username'] ;
    $sql="SELECT * FROM sinhvien WHERE username='$username'";
    $kq=mysqli_query($conn,$sql);
    if (mysqli_num_rows($kq) > 0) {
      {while ($row= mysqli_fetch_assoc($kq)) {
            # code...
            echo" <p class='app-sidebar__user-name'><b>".$row['TenSV']."</b></p> ";
          }
          }
    }
		  ?>
        <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
      </div>
    </div>
    <hr>
    <ul class="app-menu">
	   <li><a class="app-menu__item " href="../index/quanlysinhvien.php"><i class='app-menu__icon bx bx-id-card'></i>
          <span class="app-menu__label">Quản lý sinh viên</span></a></li>
      <li><a class="app-menu__item active" href="danhsachmonhocmo.php"><i
            class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý môn đăng ký</span></a>
      </li>
      <li><a class="app-menu__item" href="danhsachmonnd.php"><i class='app-menu__icon bx bx-task'></i><span
            class="app-menu__label">Nhập điểm</span></a></li>
    </ul>
  </aside>
  <main class="app-content">
	 
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách môn học mở kỳ này</li>
        <li class="breadcrumb-item"><a href="#">Thêm môn học</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="tile">
		
          <h3 class="tile-title">Thêm môn học</h3>
          <div class="tile-body">
            <div class="row element-button">
              

            </div>
            <form method="post" action=""> 
              <div class="form-group col-md-4">
                <label class="control-label">Mã môn học</label>
                <input class="form-control" type="text" name="MaMH">
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Nhóm</label>
                <input class="form-control" type="text" name="nhom" >
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Số lượng</label>
                <input class="form-control" type="number" name="soluong" >
              </div>
              <div class="form-group  col-md-4">
                <label class="control-label">Phòng</label>
                <input class="form-control" type="text" name="phong" >
              </div>
              <div class="form-group  col-md-3">
                <label class="control-label">Thứ</label>
                <input class="form-control" type="text" name="thu" >
              </div>
			   <div class="form-group col-md-4">
                <label class="control-label">Ngày bắt đầu</label>
                <input class="form-control" type="date" name="ngaybd" >
              </div>
			 <div class="form-group col-md-4">
                <label class="control-label">Ngày kết thúc</label>
                <input class="form-control" type="date" name="ngaykt" >
              </div>
              
<?php
	include('../connect/ketnoi.php');
	if(isset($_POST['THEM']))
	{
		$MaMH= $_POST['MaMH'];
		$soluong =  $_POST['soluong'];
		$nhom =$_POST['nhom'];
		$thu = $_POST['thu'];
		$ngaybd = $_POST['ngaybd'];
		$ngaykt = $_POST['ngaykt'];
		$phong = $_POST['phong'];
		$ctdt = 1;
		$sql="INSERT INTO dangkymh (MaMH,soluong,nhom,MaCTDT,Thu,ngayBD,ngayKT,PHONG) VALUES ('$MaMH',' $soluong','$nhom','$ctdt','$thu','$ngaybd','$ngaykt','$phong')";
		mysqli_query($conn,$sql);
		echo "Thêm môn học thành công.  <a href='danhsachmonhocmo.php' style='color:red;'>Trở lại</a>";
        exit;
	}
	
?>
 </div>
			<form><input class="btn btn-cancel" type="submit" name="THEM" value="THÊM">
          <a class="btn btn-cancel" href="danhsachmonhocmo.php">Hủy bỏ</a></form>
			  
         </form>
        </div>
        </div>
			</div>
  </main>


  <!--
  MODAL
-->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-body">
          <div class="row">
           
          
          </div>
          <BR>
         
          <BR>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!--
  MODAL
-->


  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>

</body>

</html>