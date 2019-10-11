<?php 

require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$walikelas=$_POST['walikelas'];
	$pendamping=$_POST['pendamping'];
	$tapel=$_POST['tapel'];
	$kelas=$_POST['rombel'];
	$kurikulum=$_POST['kurikulum'];
	if(empty($kelas)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from rombel where tapel='$tapel' and wali_kelas='$walikelas'";
		$query = $connect->query($sql);
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Guru tersebut sudah menjadi Wali Kelas!";
		}else{
			$sql1 = "select * from rombel where tapel='$tapel' and pendamping='$pendamping'";
			$query1 = $connect->query($sql1);
			$ada1=$query1->num_rows;
			if($ada>0){
			}else{
				$sql1 = "insert into rombel values('','$kelas','$kurikulum','$tapel','$walikelas','$pendamping')";
				$query1 = $connect->query($sql1);
				$validator['success'] = true;
				$validator['messages'] = "Penempatan dan Jabatan berhasil diperbaharui!";
			};
		};
		
		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}