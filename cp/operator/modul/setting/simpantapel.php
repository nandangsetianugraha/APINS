<?php 

require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['idp'];
	
	$tapel=$_POST['tapel'];
	$smt=$_POST['smt'];
	$versi=$_POST['versi'];
	$sql = "SELECT * FROM konfigurasi WHERE id_conf='$idr'";
	$usis = $connect->query($sql)->fetch_assoc();
	$ids=$usis['id_conf'];
	if(empty($idr)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
			$sql = "update konfigurasi set tapel='$tapel', semester='$smt', versi='$versi' where id_conf='$idr'";
			$query = $connect->query($sql);
			$validator['success'] = true;
			$validator['messages'] = "Data berhasil diubah!<br/>Silahkan Refresh";		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}