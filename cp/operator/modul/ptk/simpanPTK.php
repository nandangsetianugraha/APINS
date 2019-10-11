<?php 

require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$nama=$_POST['nama'];
	$tempat=$_POST['tempat'];
	$tanggal=$_POST['tanggal'];
	$nik=$_POST['nik'];
	$niy=$_POST['niy'];
	$nuptk=$_POST['nuptk'];
	$alamat=$_POST['alamat'];
	$email=$_POST['email'];
	$hp=$_POST['hp'];
	//$=$_POST[''];
	//$=$_POST[''];
	$ptkid=$_POST['ptkid'];
	if(empty($nama) || empty($tanggal)){
		$validator['success'] = false;
		$validator['messages'] = "Nama dan tanggal lahir tidak boleh kosong!";
	}else{
		$sql = "select * from ptk where ptk_id='$ptkid'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
			$sql1 = "UPDATE ptk SET nama='$nama', tempat_lahir='$tempat', tanggal_lahir='$tanggal', nik='$nik', niy_nigk='$niy', nuptk='$nuptk', alamat_jalan='$alamat', email='$email', no_hp='$hp' WHERE ptk_id='$ptkid'";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Profil PTK berhasil diperbaharui!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the member information";
			};
		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}