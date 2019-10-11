<?php 
require_once '../../../inc/db_connect.php';
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$pdid=$_GET['pdid'];
$kelas=$_GET['kelas'];
$output = array('data' => array());

$sql="select * from nso where id_pd='$pdid' and smt='$smt' and tapel='$tapel'";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$jns=$s['jns'];
	switch ($jns) {
		case 1:
			$nsos="Jujur";
			break;
		case 2:
			$nsos="Disiplin";
			break;
		case 3:
			$nsos="Tanggung Jawab";
			break;
		case 4:
			$nsos="Santun";
			break;
		case 5:
			$nsos="Peduli";
			break;
		case 6:
			$nsos="Percaya Diri";
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