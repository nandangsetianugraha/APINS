<?php 

require_once '../../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$username=$_POST['username'];
	$password=$_POST['password'];
	$ptkid=$_POST['ptkid'];
	if(empty($username) || empty($password)){
		$validator['success'] = false;
		$validator['messages'] = "Username dan Password tidak boleh kosong!";
	}else{
		$sql = "select * from pengguna where ptk_id='$ptkid'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$sql1 = "UPDATE pengguna SET username='$username', password='$password' WHERE ptk_id='$ptkid'";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Username/Password berhasil diperbaharui!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the member information";
			};
		}else{
			$sql1 = "select * from ptk where ptk_id='$ptkid'";
			$query1 = $connect->query($sql1);
			$cks1 = $query1->fetch_assoc();
			$level=$cks1['jenis_ptk_id'];
			$namalengkap=$cks1['nama'];
			$sql2 = "INSERT INTO pengguna VALUES('$ptkid','$username','$password','$namalengkap','$level','1')";
			$query2 = $connect->query($sql2);
			if($query2 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Username/Password berhasil dibuat!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the member information";
			};
		};
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}