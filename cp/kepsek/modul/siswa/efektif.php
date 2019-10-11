<?php 

require_once '../../inc/db_connect.php';
$tapel=$_GET['tapel'];
$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$output = array('data' => array());

$sql = "select * from hari_efektif where tapel='$tapel'";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$bln=$s['bulan'];
	$bulan=$BulanIndo[(int)$bln-1];
	$actionButton = '
	<button class="btn btn-effect-ripple btn-xs btn-danger" data-toggle="modal" data-target="#removeHariModal" onclick="removeHari('.$s['id_hari'].')"> <i class="fa fa-trash"></i> Hapus</button>
	';
	$output['data'][] = array(
		$bulan,
		$s['hari'],
		$actionButton
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);