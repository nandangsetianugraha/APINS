<?php 

require_once '../../inc/db_connect.php';
$kelas=$_GET['kelas'];
$peta=$_GET['aspek'];
$mpid=$_GET['mp'];
$output = array('data' => array());

$sql = "select * from kd where kelas='$kelas' and aspek='$peta' and mapel='$mpid' order by kd asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$actionButton = '
	<button class="btn btn-effect-ripple btn-xs btn-danger" data-toggle="modal" data-target="#removeKDModal" onclick="removeKD('.$s['id_kd'].')"> <i class="fa fa-trash"></i> Hapus</button>
	';
	$output['data'][] = array(
		$s['kd'],
		$s['nama_kd'],
		$actionButton
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);