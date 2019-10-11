<?php 

require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$ids=$_POST['ids'];
	$smt=$_POST['smt'];
	$tapel=$_POST['tapel'];
	$tinggi=$_POST['tinggi'];
	$berat=$_POST['berat'];
	$pendengaran=$_POST['pendengaran'];
	$penglihatan=$_POST['penglihatan'];
	$gigi=$_POST['gigi'];
	$lainnya=$_POST['lainnya'];
	if(empty($smt) || empty($ids)){
		$validator['success'] = false;
		$validator['messages'] = "UPS ada yg salah Bro!";
	}else{
			$sql = "select * from data_kesehatan where peserta_didik_id='$ids' and smt='$smt' and tapel='$tapel'";
			$query = $connect->query($sql);
			$cks = $query->num_rows;
			if($cks>0){
				$sql = "select * from data_kesehatan where peserta_didik_id='$ids' and smt='$smt' and tapel='$tapel'";
				$query = $connect->query($sql);
				$cks = $query->fetch_array();
				$idkes=$cks['id'];
				$sql1 = "UPDATE data_kesehatan SET tinggi='$tinggi', berat='$berat', pendengaran='$pendengaran', penglihatan='$penglihatan', gigi='$gigi', lainnya='$lainnya' WHERE id='$idkes'";
				$query1 = $connect->query($sql1);
				if($query1 === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Data Kesehatan Semester $smt Tahun Pelajaran $tapel berhasil diperbaharui!";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Kok Error ya???";
				};
			}else{
				$sql1 = "INSERT INTO data_kesehatan VALUES('','$ids','$smt','$tapel','$tinggi','$berat','$pendengaran','$penglihatan','$gigi',
										'$lainnya')";
				$query1 = $connect->query($sql1);
				if($query1 === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Data Kesehatan Semester $smt Tahun Pelajaran $tapel Berhasil dibuat!";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "hmmmmmm error";
				};
			}
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}