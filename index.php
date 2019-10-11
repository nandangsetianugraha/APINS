<?php
include "cp/inc/db.php";
session_start();
function TanggalIndo($tanggal)
{
	$bulan = array ('Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1]-1 ] . ' ' . $split[0];
};

$sql_tahun=mysqli_query($koneksi, "select * from konfigurasi");
$esmanis=mysqli_fetch_array($sql_tahun);
$tpl_aktif=$esmanis['tapel'];
$smt_aktif=$esmanis['semester'];
$sekolah=$esmanis['nama_sekolah'];
$alamat=$esmanis['alamat_sekolah'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SD Islam Al-Jannah | Official Website</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/all-skins.min.css">
	<!-- Cropper css -->
        <link href="dist/css/cropper.css" rel="stylesheet">
        <!-- Sweet alert -->
        <link href="dist/css/sweetalert.css" rel="stylesheet">

    <style type="text/css">
        html {
            overflow: hidden;
        }
    </style>
	<style type="text/css">
        * {
            margin: 0;
            box-sizing: border-box;
        }

        .avatar .camera {
            display: none;
        }

        .avatar:hover .camera {
            display: block;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="../plugins/ie9/html5shiv.min.js"></script>
    <script src="../plugins/ie9/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="./" class="logo">
		  <!-- mini logo for sidebar mini 50x50 pixels -->
		  <span class="logo-mini"><img src="images/logo2.png" alt="User Image"></span>
		  <!-- logo for regular state and mobile devices -->
		  <span class="logo-lg"><img src="images/logo2.png" alt="User Image"> <b>A P </b>I N S</span>
		</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i> Login
            </a>
			<ul class="dropdown-menu">
				<li class="header">Gunakan Login Dibawah ini:</li>
				<li>
					<ul class="menu">
						<li><!-- start message -->
							<a href="cp/login.html">
							  <div class="pull-left">
								<img src="images/user-default.png" class="img-circle" alt="User Image">
							  </div>
							  <h4>
								Login Guru
								<small><i class="fa fa-clock-o"></i> 5 mins</small>
							  </h4>
							  <p>Untuk Memasukkan Nilai Siswa</p>
							</a>
						</li>
						<li><!-- start message -->
							<a href="cp/login-siswa.html">
							  <div class="pull-left">
								<img src="images/user-default.png" class="img-circle" alt="User Image">
							  </div>
							  <h4>
								Login Siswa
								<small><i class="fa fa-clock-o"></i> 5 mins</small>
							  </h4>
							  <p>Untuk Melihat Nilai Siswa</p>
							</a>
						</li>
						<li><!-- start message -->
							<a href="cp/login-alumni.html">
							  <div class="pull-left">
								<img src="images/user-default.png" class="img-circle" alt="User Image">
							  </div>
							  <h4>
								Login Alumni
								<small><i class="fa fa-clock-o"></i> 5 mins</small>
							  </h4>
							  <p>Untuk Melihat Berkas Alumni</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="footer">
					<a href="#"></a>
				</li>
			</ul>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="images/logoku.png" class="user-image" alt="User Image">
              <span class="hidden-xs">SD Islam Al-Jannah</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
				<img src="images/logoku.png" class="img-circle" alt="User Image">
                
                <p>
                  SD ISLAM AL-JANNAH
                  <small>Jl. Raya Gabuswetan No. 1</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a class="tabCreate btn btn-default btn-flat"
                     onclick="addTabs({id:'7777',title: 'Profil',close: true,url: 'pages/profil.php',urlType: 'relative'});"
                  >Profile</a>
                </div>
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
				<div class="pull-left image">
					<img src="images/logoku.png" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
				  <p>SD Islam Al-Jannah</p>
				  <a href="#" ><i class="fa fa-circle text-success"></i> Terakreditasi A</a>
				</div>
			</div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="button" name="search" id="search-btn" class="btn btn-flat" onclick="search_menu()"><i
                        class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="content-wrapper" style="min-height: 421px;">
        <!--bootstrap tab风格 多标签页-->
        <div class="content-tabs">
            <button class="roll-nav roll-left tabLeft" onclick="scrollTabLeft()">
                <i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs menuTabs tab-ui-menu" id="tab-menu">
                <div class="page-tabs-content" style="margin-left: 0px;">

                </div>
            </nav>
            <button class="roll-nav roll-right tabRight" onclick="scrollTabRight()">
                <i class="fa fa-forward" style="margin-left: 3px;"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown tabClose" data-toggle="dropdown">
                    Option<i class="fa fa-caret-down" style="padding-left: 3px;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-right" style="min-width: 128px;">
                    <li><a class="tabReload" href="javascript:refreshTab();">Refresh</a></li>
                    <li><a class="tabCloseCurrent" href="javascript:closeCurrentTab();">Tutup Tab Sekarang</a></li>
                    <li><a class="tabCloseAll" href="javascript:closeOtherTabs(true);">Tutup Semua Tab</a></li>
                    <li><a class="tabCloseOther" href="javascript:closeOtherTabs();">Tutup Tab Lain</a></li>
                </ul>
            </div>
            <button class="roll-nav roll-right fullscreen" onclick="App.handleFullScreen()"><i
                    class="fa fa-arrows-alt"></i></button>
        </div>
        <div class="content-iframe " style="background-color: #ffffff; ">
            <div class="tab-content " id="tab-content">

            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
<!-- Modal -->
        
        <!-- /.modal -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 6.1.0a
        </div>
        <strong>Copyright &copy; 2013-2019.
    </footer>

    <!-- Control Sidebar -->
    
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!--tabs-->
<script src="dist/js/app_iframe.js"></script>
<!-- Cropper js -->
<script src="dist/js/cropper.js"></script>
        <!-- Sweet alert js -->
<script src="dist/js/sweetalert.js"></script>
<script src="menu.js"></script>
       <!-- Custom js -->

<!--
<script src="../dist/js/jquery.blockui.min.js"></script>
<script src="../dist/js/appx.js"></script>
<script src="../dist/js/bootstrap-tab.js"></script>
<script src="../dist/js/sidebarMenu.js"></script>
-->
</body>
</html>