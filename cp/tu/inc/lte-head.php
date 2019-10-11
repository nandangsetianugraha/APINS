<?php
include "../inc/db.php";
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
session_start();

$sql_tahun=mysqli_query($koneksi, "select * from konfigurasi");
$esmanis=mysqli_fetch_array($sql_tahun);
$tpl_aktif=$esmanis['tapel'];
$smt_aktif=$esmanis['semester'];
$sekolah=$esmanis['nama_sekolah'];
$alamat=$esmanis['alamat_sekolah'];
$img_login=$esmanis['image_login'];
$maintenis=$esmanis['maintenis'];
$level=$_SESSION['level'];
$idku=$_SESSION['userid'];
$bioku = mysqli_fetch_array(mysqli_query($koneksi, "select * from ptk where ptk_id='$idku'"));
$gbr = mysqli_fetch_array(mysqli_query($koneksi, "select * from pengguna where ptk_id='$idku'"));
if(file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/images/ptk/".$gbr['gambar'])){
	$avatar="../../images/ptk/".$gbr['gambar'];
}else{
	$avatar="../../images/user-default.png";
};?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  
  <!-- Pace -->
  <link rel="stylesheet" href="../../../plugins/pace-master/themes/blue/pace-theme-flash.css">
  <script type="text/javascript" src="../../../plugins/pace-master/pace.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../dist/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../../dist/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../../../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../../plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../../plugins/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../../plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../../plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../../../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../../plugins/select2/select2.min.css">
  <link rel="stylesheet" href="../../../plugins/amaran/amaran.min.css"> <!-- amaran styles -->
  <link rel="stylesheet" href="../../../plugins/jAlert/jquery.alerts.css"> <!-- jAlert styles -->
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../../dist/css/skins/all-skins.min.css">
  <link href="../../../dist/css/sweetalert.css" rel="stylesheet">
  <link href="../../../dist/css/cropper.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>