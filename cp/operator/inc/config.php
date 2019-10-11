<?php
$db_host = "localhost";
$db_user = "sdialjan_nilai";
$db_pass = "maikawasumi79";
$db_name = "sdialjan_nilai";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno()){
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
};
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
if(!isset($_SESSION['userid'])){
	header('location:../login.html');
	exit();
};
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
$adakelas = mysqli_num_rows(mysqli_query($koneksi, "select * from mengajar where ptk_id='$idku' and tapel='$tpl_aktif'"));
if($adakelas>0){
	
}else{
	header('location:error.php');
	exit();
};
$rmku = mysqli_fetch_array(mysqli_query($koneksi, "select * from mengajar where ptk_id='$idku' and tapel='$tpl_aktif'"));
$kelas=$rmku['rombel'];
$ab=substr($kelas,0,1);
if(file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/1data/images/".$gbr['gambar'])){
	$avatar="../../images/".$gbr['gambar'];
}else{
	$avatar="../../images/user-default.png";
};?>