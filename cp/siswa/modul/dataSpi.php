<?php 
require_once '../../../inc/db_connect.php';
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$pdid=$_GET['pdid'];
$kelas=$_GET['kelas'];
$output = array('data' => array());

$sql="select * from nsp where id_pd='$pdid' and smt='$smt' and tapel='$tapel'";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$jns=$s['jns'];
	switch ($jns) {
		case 1:
			$nsos="Ketaatan Beribadah";
			break;
		case 2:
			$nsos="Berdoa Sebelum dan Sesudah Pembelajaran";
			break;
		case 3:
			$nsos="Toleransi dalam Beribadah";
			break;
		case 4:
			$nsos="Berperilaku Syukur";
			break;
		default:
			$nsos="Kosong";
			break;
	};
	$output['data'][] = array(
		$s['perilaku'],
		$nsos,
		$s['nilai']
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);