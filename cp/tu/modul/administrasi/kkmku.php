<?php 

require_once '../../inc/db_connect.php';
$kelas=$_GET['kelas'];
$mpid=$_GET['mapel'];
$tapel=$_GET['tapel'];
$output = array('data' => array());
$sql = "select * from kd where kelas='$kelas' and mapel='$mpid' order by kd";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$kda=$s['kd'];
	$namakd=$connect->query("select * from kkmku where kelas='$kelas' and tapel='$tapel' and mapel='$mpid' and kd='$kda'")->fetch_assoc();
	$cr1=$namakd['k1'];
	$cr2=$namakd['k2'];
	$cr3=$namakd['k3'];
	if(empty($cr1)){
	$actionButton1 = '
		<form class="form-inline" action="../modul/administrasi/tambahkkm.php" method="POST" id="nilaiKKM">
			<input type="hidden" name="kelas" class="form-control" value="'.$kelas.'">
			<input type="hidden" name="tapel" class="form-control" value="'.$tapel.'">
			<input type="hidden" name="mapel" class="form-control" value="'.$mpid.'">
			<input type="hidden" name="kd" class="form-control" value="'.$kda.'">
			<input type="hidden" name="jns" class="form-control" value="k1">
			<input type="text"  name="nilai" style="width:75px;" autocomplete=off class="form-control input-sm" placeholder="">
		</form>
		';    
	}else{
	$actionButton1 = '
		<form class="form-inline" action="../modul/administrasi/tambahkkm.php" method="POST" id="nilaiKKM">
			<input type="hidden" name="kelas" class="form-control" value="'.$kelas.'">
			<input type="hidden" name="tapel" class="form-control" value="'.$tapel.'">
			<input type="hidden" name="mapel" class="form-control" value="'.$mpid.'">
			<input type="hidden" name="kd" class="form-control" value="'.$kda.'">
			<input type="hidden" name="jns" class="form-control" value="k1">
			<input type="text"  name="nilai" style="width:75px;" autocomplete=off class="form-control input-sm" placeholder="" value="'.$cr1.'">
		</form>
		';    
	};
	if(empty($cr2)){
	$actionButton2 = '
		<form class="form-inline" action="../modul/administrasi/tambahkkm.php" method="POST" id="nilaiKKM">
			<input type="hidden" name="kelas" class="form-control" value="'.$kelas.'">
			<input type="hidden" name="tapel" class="form-control" value="'.$tapel.'">
			<input type="hidden" name="mapel" class="form-control" value="'.$mpid.'">
			<input type="hidden" name="kd" class="form-control" value="'.$kda.'">
			<input type="hidden" name="jns" class="form-control" value="k2">
			<input type="text"  name="nilai" style="width:75px;" autocomplete=off class="form-control input-sm" placeholder="">
		</form>
		';    
	}else{
	$actionButton2 = '
		<form class="form-inline" action="../modul/administrasi/tambahkkm.php" method="POST" id="nilaiKKM">
			<input type="hidden" name="kelas" class="form-control" value="'.$kelas.'">
			<input type="hidden" name="tapel" class="form-control" value="'.$tapel.'">
			<input type="hidden" name="mapel" class="form-control" value="'.$mpid.'">
			<input type="hidden" name="kd" class="form-control" value="'.$kda.'">
			<input type="hidden" name="jns" class="form-control" value="k2">
			<input type="text"  name="nilai" style="width:75px;" autocomplete=off class="form-control input-sm" placeholder="" value="'.$cr2.'">
		</form>
		';    
	};
	if(empty($cr3)){
	$actionButton3 = '
		<form class="form-inline" action="../modul/administrasi/tambahkkm.php" method="POST" id="nilaiKKM">
			<input type="hidden" name="kelas" class="form-control" value="'.$kelas.'">
			<input type="hidden" name="tapel" class="form-control" value="'.$tapel.'">
			<input type="hidden" name="mapel" class="form-control" value="'.$mpid.'">
			<input type="hidden" name="kd" class="form-control" value="'.$kda.'">
			<input type="hidden" name="jns" class="form-control" value="k3">
			<input type="text"  name="nilai" style="width:75px;" autocomplete=off class="form-control input-sm" placeholder="">
		</form>
		';    
	}else{
	$actionButton3 = '
		<form class="form-inline" action="../modul/administrasi/tambahkkm.php" method="POST" id="nilaiKKM">
			<input type="hidden" name="kelas" class="form-control" value="'.$kelas.'">
			<input type="hidden" name="tapel" class="form-control" value="'.$tapel.'">
			<input type="hidden" name="mapel" class="form-control" value="'.$mpid.'">
			<input type="hidden" name="kd" class="form-control" value="'.$kda.'">
			<input type="hidden" name="jns" class="form-control" value="k3">
			<input type="text"  name="nilai" style="width:75px;" autocomplete=off class="form-control input-sm" placeholder="" value="'.$cr3.'">
		</form>
		';    
	};
	
	$output['data'][] = array(
		$s['kd'],
		$s['nama_kd'],
		$actionButton1,
		$actionButton2,
		$actionButton3,
		$namakd['rk']
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);