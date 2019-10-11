<?php 
require_once '../../inc/db_connect.php';
$tapel=$_GET['tapel'];
$kelas=$_GET['kelas'];
$mpid=$_GET['mp'];
$ab=substr($kelas, 0, 1);
$output = array('data' => array());

$sql="select * from penempatan where rombel like '$ab%' and tapel='$tapel' order by nama asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idp=$s['peserta_didik_id'];
	$m41=$connect->query("select * from raport where id_pd='$idp' and kelas=4 and smt=1 and mapel='$mpid'")->fetch_assoc();
	$m42=$connect->query("select * from raport where id_pd='$idp' and kelas=4 and smt=2 and mapel='$mpid'")->fetch_assoc();
	$m51=$connect->query("select * from raport where id_pd='$idp' and kelas=5 and smt=1 and mapel='$mpid'")->fetch_assoc();
	$m52=$connect->query("select * from raport where id_pd='$idp' and kelas=5 and smt=2 and mapel='$mpid'")->fetch_assoc();
	$m61=$connect->query("select * from raport where id_pd='$idp' and kelas=6 and smt=1 and mapel='$mpid'")->fetch_assoc();
	$m62=$connect->query("select * from raport where id_pd='$idp' and kelas=6 and smt=2 and mapel='$mpid'")->fetch_assoc();
	$mrt=$connect->query("select AVG(nilai) AS rata from raport where id_pd='$idp' and (kelas>3 and kelas<7) and mapel='$mpid'")->fetch_assoc();
	$n41=$m41['nilai'];
	$n42=$m42['nilai'];
	$n51=$m51['nilai'];
	$n52=$m52['nilai'];
	$n61=$m61['nilai'];
	$n62=$m62['nilai'];
	$l41='
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$n41.'"  onBlur="saveUA(this,\'nilai\',\''.$idp.'\',\'4\',\'1\',\''.$mpid.'\')" onClick="highlightEdit(this);">'.$n41.'</span>
		';
	$l42='
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$n42.'"  onBlur="saveUA(this,\'nilai\',\''.$idp.'\',\'4\',\'2\',\''.$mpid.'\')" onClick="highlightEdit(this);">'.$n42.'</span>
		';
	$l51='
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$n51.'"  onBlur="saveUA(this,\'nilai\',\''.$idp.'\',\'5\',\'1\',\''.$mpid.'\')" onClick="highlightEdit(this);">'.$n51.'</span>
		';
	$l52='
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$n52.'"  onBlur="saveUA(this,\'nilai\',\''.$idp.'\',\'5\',\'2\',\''.$mpid.'\')" onClick="highlightEdit(this);">'.$n52.'</span>
		';
	$l61='
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$n61.'"  onBlur="saveUA(this,\'nilai\',\''.$idp.'\',\'6\',\'1\',\''.$mpid.'\')" onClick="highlightEdit(this);">'.$n61.'</span>
		';
	$l62='
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$n62.'"  onBlur="saveUA(this,\'nilai\',\''.$idp.'\',\'6\',\'2\',\''.$mpid.'\')" onClick="highlightEdit(this);">'.$n62.'</span>
		';
	
	$output['data'][] = array(
		$s['nama'],
		$l41,$l42,$l51,$l52,$l61,$l62,ROUND($mrt['rata'],0)
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);