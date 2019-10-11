<?php 

require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$bulan=$_POST['blne'];
	$tahun=$_POST['thne'];
	$hari=$_POST['harie'];
	if(empty($bulan) || empty($tahun) || empty($hari)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from hari_efektif where bulan='$bulan' and tapel='$tahun'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Hari Efektif Sudah Ada!";
		}else{
			$sql1 = "insert into hari_efektif values('','$bulan','$tahun','$hari')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Hari Efektif Berhasil ditambahkan";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error Bro";
			};
		};
		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}