<?php if (session_id() == '' || !isset($_SESSION)) {
  session_start();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách đơn hàng | Quản trị Admin</title>
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
 <?php 
	include('../connect/ketnoi.php');
	?>
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
      <li><a class="app-menu__item " href="danhsachmonhocmo.php"><i
            class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý môn đăng ký</span></a>
      </li>
      <li><a class="app-menu__item active" href="danhsachmonnd.php"><i class='app-menu__icon bx bx-task'></i><span
            class="app-menu__label">Nhập điểm</span></a></li>
    </ul>
  </aside>
    <main class="app-content">
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
		  <?php
			require_once('../connect/ketnoi.php');
		$MaMH=$_GET['MaMH'];
		$sql="SELECT * FROM monhoc mh,danhsachdk dk, diem d,sinhvien sv WHERE mh.MaMH=dk.MaMH and mh.MaMH=d.MaMH and d.MaMH=dk.MaMH and sv.MaSV=dk.MaSV and dk.MaSV=d.MaSV and dk.MaMH='$MaMH'";
  		$kq=mysqli_query($conn,$sql);
		$row1=mysqli_fetch_array($kq);
          echo"<li class='breadcrumb-item active'><a href='#'><b>Danh sách môn nhập điểm</b></a></li>";
		  echo"<li class='breadcrumb-item active'><a href='#'><b>Nhập điểm cho môn : ".$row1['TenMH']."</b></a></li>";
			  ?>
        </ul>
        <div id="clock"></div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="row element-button">
                <div class="col-sm-2">
                  <a class="btn btn-excel btn-sm" href="" title="In"><i class="fas fa-file-excel"></i> Xuất Excel</a>
                </div>
                <div class="col-sm-2">
                  <a class="btn btn-delete btn-sm pdf-file" type="button" title="In" onclick="myFunction(this)"><i
                      class="fas fa-file-pdf"></i> Xuất PDF</a>
                </div>
              
              </div>
				<form method="post">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th width="10"><input type="checkbox" id="all"></th>
                    <th>Mã sinh viên</th>
                    <th>Tên sinh viên</th>
                    <th>Điểm giữa kỳ</th>
					<th>Điểm cuối kỳ</th>
					<th>% giữa kỳ</th>
					<th>% cuối kỳ</th>
                  </tr>
                </thead>
                <tbody>
					<?php
			
  
               $MaMH=$_GET['MaMH'];
		$sql="SELECT * FROM monhoc mh,danhsachdk dk, diem d,sinhvien sv WHERE mh.MaMH=dk.MaMH and mh.MaMH=d.MaMH and d.MaMH=dk.MaMH and sv.MaSV=dk.MaSV and dk.MaSV=d.MaSV and dk.MaMH='$MaMH'";
  		$kq=mysqli_query($conn,$sql);
        $id=0;
        while ($row=mysqli_fetch_array($kq)) {
                 echo "<tr style='background: #ffd4aa; height: 30px; vertical-align: middle;align='center'>";
			echo "<td style='text-align:center;'>".$id."</td>";
			echo "<td align='center'><input type='text' name='MaSV' required value='".$row['MaSV']."' disabled></td>";
			echo "<td align='center'><input type='text' name='TenSV' value=' ".$row['TenSV']."' disabled></td>";
			echo "<td align='center'><input type='text' name='DiemGK' value='".$row['DiemGK']."'></td>";
			echo "<td align='center'><input type='text' name='DiemCK' value='".$row['DiemCK']."'></td>";
			echo "<td align='center'><input type='text' name='PTGK' value='".$row['PTGK']."'></td>";
			echo "<td align='center'><input type='text' name='PTCK' value='".$row['PTCK']."'></td>";
			echo "</tr";
				  }
					  ?>
                </tbody>
              </table>
					<form>	 <input class="btn btn-cancel" type="submit" name="LUU" value="LƯU"></form>
				<?php
	if(isset($_POST['LUU']))
	{
		//$MaSV= $_POST['MaSV'];
		$DiemGK=  $_POST['DiemGK'];
		$DiemCK = $_POST['DiemCK'] ;
		$PTGK =  $_POST['PTGK'] ;
		$PTCK = $_POST['PTCK'];
		if($DiemCK<4)
		{
			$DaHoc= "";
		}
		else{
			$DaHoc= "x";
		}
		$diem10=9.9;
		$sql="UPDATE diem SET DiemGK='$DiemGK',DiemCK='$DiemCK',PTGK='$PTGK',PTCK='$PTCK',DaHoc='$DaHoc', DiemTK10='$diem10' WHERE  MaMH='$MaMH'";
		$kq=mysqli_query($conn,$sql);
		echo "Nhập điểm thành công.  <a href='danhsachmonnd.php' style='color:red;'>Trở lại</a>";
        exit;
       
	}
?>
				<BR>
        
          <BR>
			  </form>
            </div>
          </div>
        </div>
      </div>
		
    </main>
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
    function deleteRow(r) {
      var i = r.parentNode.parentNode.rowIndex;
      document.getElementById("myTable").deleteRow(i);
    }
    jQuery(function () {
      jQuery(".trash").click(function () {
        swal({
          title: "Cảnh báo",
         
          text: "Bạn có chắc chắn là muốn xóa đơn hàng này?",
          buttons: ["Hủy bỏ", "Đồng ý"],
        })
          .then((willDelete) => {
            if (willDelete) {
              swal("Đã xóa thành công.!", {
                
              });
            }
          });
      });
    });
    oTable = $('#sampleTable').dataTable();
    $('#all').click(function (e) {
      $('#sampleTable tbody :checkbox').prop('checked', $(this).is(':checked'));
      e.stopImmediatePropagation();
    });

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
    $("#show-emp").on("click", function () {
      $("#ModalUP").modal({ backdrop: false, keyboard: false })
    });
  </script>
</body>

</html>