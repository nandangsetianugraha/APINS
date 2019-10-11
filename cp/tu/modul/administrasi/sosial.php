<?php 

require_once '../../inc/db_connect.php';
$kelas=$_GET['kelas'];
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$output = array('data' => array());

$sql = "select * from nso where kelas='$kelas' and smt='$smt' and tapel='$tapel' order by idNH desc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idp=$s['id_pd'];
	$sql1 = "select * from siswa where peserta_didik_id='$idp'";
	$query1 = $connect->query($sql1);
	$so=$query1->fetch_assoc();
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
	}
	$actionButton = '
	<button class="btn btn-effect-ripple btn-xs btn-danger" data-toggle="modal" data-target="#removeNilaiModal" onclick="removeSos('.$s['idNH'].')"> <i class="fa fa-trash"></i> Hapus</button>
	';
	$output['data'][] = array(
		$so['nama'],
		$s['perilaku'],
		$nsos." (".$s['nilai']." )",
		$actionButton
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);