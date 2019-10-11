<?php 

require_once '../../../inc/db_connect.php';
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
	$n=0;
	while ($row = $query2->fetch_assoc()) {
		$ids=$row['peserta_didik_id'];
		$sql1 = "select * from raport_k13 where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$idmp' and jns='k3'";
		$query1 = $connect->query($sql1);
		$m=$query1->num_rows;
		if($m>0){
			$n=$n+1;
		};
	};
	if($n==$j){
		$status='<span class="badge bg-green"><i class="fa fa-fw fa-check-square-o"></i></span>';
	}elseif($n<$j){
		$selisih=$j-$n;
		$status='<span class="badge bg-red"> '.$selisih.' </span>';
	}else{
		$status='Belum Generate';
	};
	if(($idmp==5 and $ab<=3) or ($idmp==6 and $ab<=3)){
		$actionButton='';
	}else{
		$actionButton = '
		<a href="raportpengetahuan.php?generate&mp='.$idmp.'&kelas='.$kelas.'" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o"></i> Lihat</a>
		';
	};
	
	$output['data'][] = array(
		$s['nama_mapel'],
		'<span class="badge bg-yellow">'.$j.'</span>','<span class="badge bg-green">'.$n.'</span>',$status,
		$actionButton
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);