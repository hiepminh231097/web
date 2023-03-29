<?php if (session_id() == '' || !isset($_SESSION)) {
  session_start();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách nhân viên | Quản trị Admin</title>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>
<?php 
	include('../connect/ketnoi.php');
	?>
<body onload="time()" class="app sidebar-mini rtl">
  <!-- Navbar-->
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
        <li class="breadcrumb-item"><a href="#">Sửa môn học</a></li>
      </ul>
      <div id="clock"></div>
    </div>
<form method="post" >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-body">
          <div class="row">
            <div class="form-group  col-md-12">
              <span class="thong-tin-thanh-toan">
                <h5>Chỉnh sửa thông tin môn học</h5>
              </span>
            </div>
          </div>
          <div class="row">
          <?php
			  require_once('../connect/ketnoi.php');
			  $MaMH=$_GET['MaMH'];
             $sql="SELECT mh.MaMH,mh.TenMH,dk.nhom,dk.soluong,dk.Thu,dk.PHONG,dk.ngayBD,dk.ngayKT FROM monhoc mh,dangkymh dk WHERE mh.MaMH=dk.MaMH and mh.MaMH='$MaMH' ";
                $kq=mysqli_query($conn,$sql);
				 while ($row=mysqli_fetch_array($kq)) {
            echo"<div class='form-group col-md-6'>
              <label class='control-label'>Mã môn học</label>
              <input class='form-control' type='text' name='MaMH'  value='$row[MaMH]' >
            </div>";
           echo"<div class='form-group col-md-6'>
              <label class='control-label'>Tên môn học</label>
              <input class='form-control' type='text' name='TenMH'  value='$row[TenMH]' >
            </div>";
           echo"<div class='form-group col-md-6'>
              <label class='control-label'>Nhóm</label>
              <input class='form-control' type='text' name='nhom'  value='$row[nhom]' >
            </div>";
            echo"<div class='form-group col-md-6'>
              <label class='control-label'>Số lượng</label>
              <input class='form-control' type='text' name='soluong'  value='".$row['soluong']."' >
            </div>";
			echo"<div class='form-group col-md-6'>
              <label class='control-label'>Phòng</label>
              <input class='form-control' type='text' name='PHONG'  value='$row[PHONG]' >
            </div>";
			echo"<div class='form-group col-md-6'>
              <label class='control-label'>Thứ</label>
              <input class='form-control' type='text' name='Thu'  value='$row[Thu]' >
            </div>";
           echo" <div class='form-group col-md-6'>
              <label class='control-label'>Ngày bắt đầu</label>
              <input class='form-control' type='date' name='ngayBD' value='$row[ngayBD]'>
            </div>";
			 echo" <div class='form-group col-md-6'>
              <label class='control-label'>Ngày kết thúc</label>
              <input class='form-control' type='date' name='ngayKT' value='$row[ngayKT]'>
            </div>";
			   }
				?>
          </div>
			
			<?php
	if(isset($_POST['LUU']))
	{
		$MaMH=  $_POST['MaMH'];
		$TenMH = $_POST['TenMH'] ;
		$nhom =  $_POST['nhom'] ;
		$soluong = $_POST['soluong'];
		$Thu = $_POST['Thu'];
		$PHONG = $_POST['PHONG'];
		$ngayBD = $_POST['ngayBD'];
		$ngayKT = $_POST['ngayKT'];
		$sql="UPDATE dangkymh SET MaMH='$MaMH',soluong='$soluong',nhom='$nhom',Thu='$Thu',ngayBD='$ngayBD',ngayKT='$ngayKT',PHONG='$PHONG' WHERE MaMH='$MaMH'";
		$kq=mysqli_query($conn,$sql);
		echo "Thêm môn học thành công.  <a href='danhsachmonhocmo.php' style='color:red;'>Trở lại</a>";
        exit;
        
	}
	
?>
          <BR>
          
          <BR>
          <BR>
         <input class="btn btn-cancel" type="submit" name="LUU" value="LƯU">
          <a class="btn btn-cancel" data-dismiss="modal" href="danhsachmonhocmo.php">Hủy bỏ</a>
          <BR>
        </div>
			  
        <div class="modal-footer">
        </div>
      </div>
    </div>
			  </form>
  </div>
    
  </main>

  <!--
  MODAL
-->
  
  <!--
  MODAL
-->

  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="src/jquery.table2excel.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <!-- Data table plugin-->
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">$('#sampleTable').DataTable();</script>
  <script>
   
    //EXCEL
    // $(document).ready(function () {
    //   $('#').DataTable({

    //     dom: 'Bfrtip',
    //     "buttons": [
    //       'excel'
    //     ]
    //   });
    // });


    //Thời Gian
    function time() {
      var today = new Date();
      var weekday = new Array(7);
      weekday[0] = "Chủ Nhật";
      weekday[1] = "Thứ Hai";
      weekday[2] = "Thứ Ba";
      weekday[3] = "Thứ Tư";
      weekday[4] = "Thứ Năm";
      weekday[5] = "Thứ Sáu";
      weekday[6] = "Thứ Bảy";
      var day = weekday[today.getDay()];
      var dd = today.getDate();
      var mm = today.getMonth() + 1;
      var yyyy = today.getFullYear();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      nowTime = h + " giờ " + m + " phút " + s + " giây";
      if (dd < 10) {
        dd = '0' + dd
      }
      if (mm < 10) {
        mm = '0' + mm
      }
      today = day + ', ' + dd + '/' + mm + '/' + yyyy;
      tmp = '<span class="date"> ' + today + ' - ' + nowTime +
        '</span>';
      document.getElementById("clock").innerHTML = tmp;
      clocktime = setTimeout("time()", "1000", "Javascript");

      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
    }
    //In dữ liệu
    var myApp = new function () {
      this.printTable = function () {
        var tab = document.getElementById('sampleTable');
        var win = window.open('', '', 'height=700,width=700');
        win.document.write(tab.outerHTML);
        win.document.close();
        win.print();
      }
    }
    //     //Sao chép dữ liệu
    //     var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

    // copyTextareaBtn.addEventListener('click', function(event) {
    //   var copyTextarea = document.querySelector('.js-copytextarea');
    //   copyTextarea.focus();
    //   copyTextarea.select();

    //   try {
    //     var successful = document.execCommand('copy');
    //     var msg = successful ? 'successful' : 'unsuccessful';
    //     console.log('Copying text command was ' + msg);
    //   } catch (err) {
    //     console.log('Oops, unable to copy');
    //   }
    // });


    //Modal
  
  </script>
</body>

</html>