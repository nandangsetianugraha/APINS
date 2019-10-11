<?php 

require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$ptkid=$_POST['ptkid'];
	$tapel=$_POST['tapel'];
	$kelas=$_POST['kelas'];
	$jenisptk=$_POST['jenisptk'];
	if(empty($jenisptk)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from mengajar where tapel='$tapel' and ptk_id='$ptkid'";
		$query = $connect->query($sql);
		$ada=$query->num_rows;
		if($ada>0){
			$sql = "update ptk set jenis_ptk_id='$jenisptk' where ptk_id='$ptkid'";
			$query = $connect->query($sql);
			$sql1 = "update pengguna set level='$jenisptk' where ptk_id='$ptkid'";
			$query1 = $connect->query($sql1);
			$sql2 = "update mengajar set rombel='$kelas' where ptk_id='$ptkid'";
			$query2 = $connect->query($sql2);
			if($query === TRUE and $query1 === TRUE and $query2 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penempatan dan Jabatan berhasil diperbaharui!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the member information";
			};
		}else{
			$sql1 = "insert into mengajar values('','$tapel','$ptkid','$kelas')";
			$query1 = $connect->query($sql1);
			$sql = "update ptk set jenis_ptk_id='$jenisptk' where ptk_id='$ptkid'";
			$query = $connect->query($sql);
			$sql2 = "update pengguna set level='$jenisptk' where ptk_id='$ptkid'";
			$query2 = $connect->query($sql2);
			$validator['success'] = true;
			$validator['messages'] = "Penempatan dan Jabatan berhasil diperbaharui!";
		};
		
		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}