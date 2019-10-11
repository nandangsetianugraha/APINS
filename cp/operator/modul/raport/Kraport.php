<?php 

require_once '../../inc/db_connect.php';
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$ab=substr($kelas, 0, 1);
$output = array('data' => array());

$sql = "select * from mapel order by id_mapel asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idmp=$s['id_mapel'];
	$sql2 = "select * from penempatan where rombel='$kelas' and tapel='$tapel'";
	$query2 = $connect->query($sql2);
	$j=$query2->num_rows;
	$sql1 = "select * from raport_k13 where kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$idmp' and jns='k4'";
	$query1 = $connect->query($sql1);
	$n=$query1->num_rows;
	$m=$query1->fetch_assoc();
	if($n==$j){
		$status='Sukses';
	}elseif($n<$j){
		$status='Generate Ulang';
	}else{
		$status='Belum Generate';
	};
	if(($idmp==5 and $ab<=3) or ($idmp==6 and $ab<=3)){
		$actionButton='';
	}else{
		$actionButton = '
		<a href="raportketrampilan.php?generate&mp='.$idmp.'&kelas='.$kelas.'" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o"></i> Lihat</a>
		';
	};
	
	$output['data'][] = array(
		$s['nama_mapel'],
		$j,$n,
		$actionButton
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);