<?php 

require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['idp'];
	
	$mutasi=$_POST['mutasi'];
	$tapel=$_POST['tapel'];
	$sql = "SELECT * FROM siswa WHERE id='$idr'";
	$usis = $connect->query($sql)->fetch_assoc();
	$ids=$usis['peserta_didik_id'];
	if(empty($idr)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
			$sql = "update siswa set status='$mutasi' where id='$idr'";
			$query = $connect->query($sql);
			$sql1 = "DELETE FROM penempatan WHERE peserta_didik_id = {$ids} and tapel = {$tapel}";
			$query1 = $connect->query($sql1);
			$validator['success'] = true;
			$validator['messages'] = "Siswa berhasil dimutasikan!";		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}