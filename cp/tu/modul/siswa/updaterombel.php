<?php 

require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['idrombel'];
	$tapel=$_POST['tapel'];
	$rombel=$_POST['rombel'];
	$kurikulum=$_POST['kurikulum'];
	$wali=$_POST['walikelas'];
	$pendamping=$_POST['pendamping'];
	if(empty($rombel)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
			$sql = "update rombel set nama_rombel='$rombel',kurikulum='$kurikulum',tapel='$tapel',wali_kelas='$wali', pendamping='$pendamping' where id_rombel='$idr'";
			$query = $connect->query($sql);
			$validator['success'] = true;
			$validator['messages'] = "Rombel berhasil diperbaharui!";		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}