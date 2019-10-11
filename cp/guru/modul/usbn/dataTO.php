<?php 
require_once '../../inc/db_connect.php';
$tapel=$_GET['tapel'];
$toke=$_GET['toke'];
$kelas=$_GET['kelas'];
$output = array('data' => array());

$sql="select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idp=$s['peserta_didik_id'];
	$nama=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
	$m1=$connect->query("select * from tryout where peserta_didik_id='$idp' and toke='$toke' and mapel='3'")->fetch_assoc();
	$m2=$connect->query("select * from tryout where peserta_didik_id='$idp' and toke='$toke' and mapel='4'")->fetch_assoc();
	$m3=$connect->query("select * from tryout where peserta_didik_id='$idp' and toke='$toke' and mapel='5'")->fetch_assoc();
	$m4=$connect->query("select sum(nilai) as jumlah from tryout where peserta_didik_id='$idp' and toke='$toke'")->fetch_assoc();
	$m5=$connect->query("select AVG(nilai) as rerata from tryout where peserta_didik_id='$idp' and toke='$toke'")->fetch_assoc();
	$n1=$m1['nilai'];
	$n2=$m2['nilai'];
	$n3=$m3['nilai'];
	$n4=$m4['jumlah'];
	$n5=$m5['rerata'];
	if($n5===0 or empty($n5)){
		$n6='';
	}else{
		$n6=round($n5,2);
	};
	$b1='<span class="input-group-addon" contenteditable="true" data-old_value="'.$n1.'"  onBlur="saveUN(this,\'nilai\',\''.$idp.'\',\'3\',\''.$toke.'\')" onClick="highlightEdit(this);">'.$n1.'</span>
		';
	$b2='<span class="input-group-addon" contenteditable="true" data-old_value="'.$n2.'"  onBlur="saveUN(this,\'nilai\',\''.$idp.'\',\'4\',\''.$toke.'\')" onClick="highlightEdit(this);">'.$n2.'</span>
		';
	$b3='<span class="input-group-addon" contenteditable="true" data-old_value="'.$n3.'"  onBlur="saveUN(this,\'nilai\',\''.$idp.'\',\'5\',\''.$toke.'\')" onClick="highlightEdit(this);">'.$n3.'</span>
		';
	
	$output['data'][] = array(
		$nama['nama'],
		$b1,$b2,$b3,$n4,$n6
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);