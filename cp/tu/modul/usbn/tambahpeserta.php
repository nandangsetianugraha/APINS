<?php 

require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$pdid=$_POST['pdid'];
	$tapel=$_POST['tapel'];
	$nopes=$_POST['nopes'];
	if(empty($pdid) and empty($nopes)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from pesertaun where tapel='$tapel' and peserta_didik_id='$pdid'";
		$query = $connect->query($sql);
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Sudah menjadi Peserta UN dan Memiliki Nomor Peserta";
		}else{
			$sql1 = "insert into pesertaun values('','$tapel','$pdid','$nopes')";
			$query1 = $connect->query($sql1);
			$validator['success'] = true;
			$validator['messages'] = "Berhasil memasukkan data peserta";
		};
		
		
	};
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}