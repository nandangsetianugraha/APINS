<?php 

require_once '../../inc/db_connect.php';
$kelas=$_GET['kelas'];
$mpid=$_GET['mapel'];
$tapel=$_GET['tapel'];
$output = array('data' => array());

$sql = "select * from mapel order by id_mapel asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idmp=$s['id_mapel'];
	$sql1 = "select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idmp'";
	$query1 = $connect->query($sql1);
	$m=$query1->fetch_assoc();
	$actionButton = '
	<a href="kkm.php?kelas='.$kelas.'&mp='.$idmp.'&tapel='.$tapel.'&lihat" class="btn btn-primary btn-xs"> <i class="fa fa-file-text-o"></i> Detail</a>
	';
	$output['data'][] = array(
		$s['nama_mapel'],
		$m['nilai'],
		$actionButton
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);