<?php 
require_once '../../../inc/db_connect.php';
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$pdid=$_GET['pdid'];
$mpid=$_GET['mp'];
$kelas=$_GET['kelas'];
$output = array('data' => array());

$sql="select * from nats where id_pd='$pdid' and smt='$smt' and tapel='$tapel' and mapel='$mpid'";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idp=$s['kd'];
	$sql1 = "select * from kd where kelas='$kelas' and aspek='3' and mapel='$mpid' and kd='$idp'";
	$nh = $connect->query($sql1);
	$m=$nh->fetch_assoc();
	$output['data'][] = array(
		$s['kd'],
		$m['nama_kd'],
		round($s['nilai'],0)
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);