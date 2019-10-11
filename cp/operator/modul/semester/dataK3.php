<?php 
require_once '../../inc/db_connect.php';
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$kelas=$_GET['kelas'];
$peta=$_GET['peta'];
$mpid=$_GET['mp'];
$kd=$_GET['kd'];
$ab=substr($kelas, 0, 1);
$output = array('data' => array());

$sql="select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idp=$s['peserta_didik_id'];
	$sql1 = "select * from nuts where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mpid' and kd='$kd'";
	$query1 = $connect->query($sql1);
	$m=$query1->fetch_assoc();
		$nPTS=$m['nilai'];
		$nkd='
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$nPTS.'"  onBlur="saveUT(this,\'nilai\',\''.$idp.'\',\''.$ab.'\',\''.$smt.'\',\''.$tapel.'\',\''.$mpid.'\',\''.$kd.'\')" onClick="highlightEdit(this);">'.$nPTS.'</span>
		';
	
	$output['data'][] = array(
		$s['nama'],
		$nkd
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);