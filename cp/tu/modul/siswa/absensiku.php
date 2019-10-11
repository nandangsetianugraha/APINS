<?php 

require_once '../../inc/db_connect.php';
$kelas=$_GET['kelas'];
$tanggal=$_GET['tgl'];
$tapel=$_GET['tapel'];
$thn = substr($tanggal, 6, 4);
$bln = substr($tanggal, 0, 2);
$tgl   = substr($tanggal, 3, 2);
$tgls=$thn."-".$bln."-".$tgl;
$output = array('data' => array());

$sql = "select penempatan.*, absensi.* from penempatan join absensi using(peserta_didik_id) where absensi.tanggal='$tgls' and penempatan.rombel='$kelas' and penempatan.tapel='$tapel'";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idp=$s['peserta_didik_id'];
	$sql1 = "select * from siswa where peserta_didik_id='$idp'";
	$query1 = $connect->query($sql1);
	$m=$query1->fetch_assoc();
	$actionButton = '
	<button class="btn btn-effect-ripple btn-xs btn-danger" data-toggle="modal" data-target="#removeAbsenModal" onclick="removeAbsen('.$s['id_absen'].')"> <i class="fa fa-trash"></i> Hapus</button>
	';
	$output['data'][] = array(
		$m['nama'],
		$s['absensi'],
		$actionButton
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);