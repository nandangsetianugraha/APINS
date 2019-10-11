<?php 

require_once '../../../inc/db_connect.php';
$kelas=$_GET['kelas'];
$ab=substr($kelas,0,1);
$level=$_GET['level'];
$tapel=$_GET['tapel'];
$output = array('data' => array());
if($level==96){ //guru pai
	$idmp=1;
	$ckkm=$connect->query("select * from kkmku where kelas='$ab' and tapel='$tapel' and mapel='$idmp'")->num_rows;
	$ckkdp=$connect->query("select * from kd where kelas='$ab' and aspek=3 and mapel='$idmp' group by kd")->num_rows;
	$ckkdk=$connect->query("select * from kd where kelas='$ab' and aspek=4 and mapel='$idmp' group by kd")->num_rows;
	$jumkd=$ckkdp+$ckkdk;
	if($ckkm==3*$jumkd){
		$boleh=true;
	}else{
		$boleh=false;
	};
	$sql1 = "select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idmp'";
	$query1 = $connect->query($sql1);
	$m=$query1->fetch_assoc();
	if($boleh){
		$nkkm=$m['nilai'];
	}else{
		$nkkm="<small class='label label-danger'><i class='fa fa-clock-o'></i> Belum Lengkap</small>";
	};
	$actionButton = '
	<a href="kkm.php?kelas='.$kelas.'&mp='.$idmp.'&tapel='.$tapel.'&lihat" class="btn btn-primary btn-xs"> <i class="fa fa-file-text-o"></i> Detail</a>
	';
	$output['data'][] = array(
		'Pendidikan Agama Islam',
		$nkkm,
		$actionButton
	);
}elseif($level==95){ //guru penjas
	$idmp=8;
	$ckkm=$connect->query("select * from kkmku where kelas='$ab' and tapel='$tapel' and mapel='$idmp'")->num_rows;
	$ckkdp=$connect->query("select * from kd where kelas='$ab' and aspek=3 and mapel='$idmp' group by kd")->num_rows;
	$ckkdk=$connect->query("select * from kd where kelas='$ab' and aspek=4 and mapel='$idmp' group by kd")->num_rows;
	$jumkd=$ckkdp+$ckkdk;
	if($ckkm==3*$jumkd){
		$boleh=true;
	}else{
		$boleh=false;
	};
	$sql1 = "select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idmp'";
	$query1 = $connect->query($sql1);
	$m=$query1->fetch_assoc();
	if($boleh){
		$nkkm=$m['nilai'];
	}else{
		$nkkm="<small class='label label-danger'><i class='fa fa-clock-o'></i> Belum Lengkap</small>";
	};
	$actionButton = '
	<a href="kkm.php?kelas='.$kelas.'&mp='.$idmp.'&tapel='.$tapel.'&lihat" class="btn btn-primary btn-xs"> <i class="fa fa-file-text-o"></i> Detail</a>
	';
	$output['data'][] = array(
		'Pendidikan Jasmani Olahraga dan Kesehatan',
		$nkkm,
		$actionButton
	);
}elseif($level==94){ //guru bahasa inggris
	$idmp=10;
	$ckkm=$connect->query("select * from kkmku where kelas='$ab' and tapel='$tapel' and mapel='$idmp'")->num_rows;
	$ckkdp=$connect->query("select * from kd where kelas='$ab' and aspek=3 and mapel='$idmp' group by kd")->num_rows;
	$ckkdk=$connect->query("select * from kd where kelas='$ab' and aspek=4 and mapel='$idmp' group by kd")->num_rows;
	$jumkd=$ckkdp+$ckkdk;
	if($ckkm==3*$jumkd){
		$boleh=true;
	}else{
		$boleh=false;
	};
	$sql1 = "select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idmp'";
	$query1 = $connect->query($sql1);
	$m=$query1->fetch_assoc();
	if($boleh){
		$nkkm=$m['nilai'];
	}else{
		$nkkm="<small class='label label-danger'><i class='fa fa-clock-o'></i> Belum Lengkap</small>";
	};
	$actionButton = '
	<a href="kkm.php?kelas='.$kelas.'&mp='.$idmp.'&tapel='.$tapel.'&lihat" class="btn btn-primary btn-xs"> <i class="fa fa-file-text-o"></i> Detail</a>
	';
	$output['data'][] = array(
		'Bahasa Inggris',
		$nkkm,
		$actionButton
	);
}else{
$sql = "select * from mapel order by id_mapel asc";
$query = $connect->query($sql);

while($s=$query->fetch_assoc()) {
	$idmp=$s['id_mapel'];
	$ckkm=$connect->query("select * from kkmku where kelas='$ab' and tapel='$tapel' and mapel='$idmp'")->num_rows;
	$ckkdp=$connect->query("select * from kd where kelas='$ab' and aspek=3 and mapel='$idmp' group by kd")->num_rows;
	$ckkdk=$connect->query("select * from kd where kelas='$ab' and aspek=4 and mapel='$idmp' group by kd")->num_rows;
	$jumkd=$ckkdp+$ckkdk;
	if($ckkm==3*$jumkd){
		$boleh=true;
	}else{
		$boleh=false;
	};
	$sql1 = "select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idmp'";
	$query1 = $connect->query($sql1);
	$m=$query1->fetch_assoc();
	if($boleh){
		$nkkm=$m['nilai'];
	}else{
		$nkkm="<small class='label label-danger'><i class='fa fa-clock-o'></i> Belum Lengkap</small>";
	};
	$actionButton = '
	<a href="kkm.php?kelas='.$kelas.'&mp='.$idmp.'&tapel='.$tapel.'&lihat" class="btn btn-primary btn-xs"> <i class="fa fa-file-text-o"></i> Detail</a>
	';
	$output['data'][] = array(
		$s['nama_mapel'],
		$nkkm,
		$actionButton
	);
	
};
};
	

// database connection close
$connect->close();

echo json_encode($output);