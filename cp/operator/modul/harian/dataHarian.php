<?php 
require_once '../../inc/db_connect.php';
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$kelas=$_GET['kelas'];
$peta=$_GET['peta'];
$mpid=$_GET['mp'];
$kd=$_GET['kd'];
$tema=$_GET['tema'];
$ab=substr($kelas, 0, 1);
$output = array('data' => array());

$sql="select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idp=$s['peserta_didik_id'];
	$sql1 = "select * from nh where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mpid' and tema='$tema' and kd='$kd' and jns='tls'";
	$nh = $connect->query($sql1);
	$sql2 = "select * from nh where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mpid' and tema='$tema' and kd='$kd' and jns='tgs1'";
	$nh1 = $connect->query($sql2);
	$sql3 = "select * from nh where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mpid' and tema='$tema' and kd='$kd' and jns='lsn'";
	$nh2 = $connect->query($sql3);
	$m=$nh->fetch_assoc();
	$m1=$nh1->fetch_assoc();
	$m2=$nh2->fetch_assoc();
		$nHar=$m['nilai'];
		$ntgs=$m1['nilai'];
		$nlsn=$m2['nilai'];
		$nh='
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$nHar.'"  onBlur="saveHarian(this,\'nilai\',\''.$idp.'\',\''.$ab.'\',\''.$smt.'\',\''.$tapel.'\',\''.$mpid.'\',\''.$kd.'\',\'tls\',\''.$tema.'\')" onClick="highlightEdit(this);">'.$nHar.'</span>
		';
		$ntg1='
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$ntgs.'"  onBlur="saveHarian(this,\'nilai\',\''.$idp.'\',\''.$ab.'\',\''.$smt.'\',\''.$tapel.'\',\''.$mpid.'\',\''.$kd.'\',\'tgs1\',\''.$tema.'\')" onClick="highlightEdit(this);">'.$ntgs.'</span>
		';
		$ntg2='
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$nlsn.'"  onBlur="saveHarian(this,\'nilai\',\''.$idp.'\',\''.$ab.'\',\''.$smt.'\',\''.$tapel.'\',\''.$mpid.'\',\''.$kd.'\',\'lsn\',\''.$tema.'\')" onClick="highlightEdit(this);">'.$nlsn.'</span>
		';
	
	$output['data'][] = array(
		$s['nama'],
		$nh,
		$ntg1,
		$ntg2
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);