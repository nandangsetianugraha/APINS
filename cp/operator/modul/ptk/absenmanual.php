<?php 

require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['idp'];
	
	$hari=$_POST['hari'];
	$jam=$_POST['jam'];
	$sql = "SELECT * FROM id_pegawai WHERE pegawai_id='$idr'";
	$usis = $connect->query($sql)->fetch_assoc();
	$ids=$usis['ptk_id'];
	if(empty($idr) || empty($hari) || empty($jam)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
			$tanggal=$hari." ".$jam;
			$sql = "insert into absensi_ptk values('','$idr','$tanggal')";
			$query = $connect->query($sql);
			$validator['success'] = true;
			$validator['messages'] = "Absen Manual berhasil";		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}