<?php 

require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$ptkid=$_POST['ptkid'];
	$tanggal=$_POST['tanggal'];
	$nosk=$_POST['nosk'];
	$pendidikan=$_POST['pendidikan'];
	$jenis=$_POST['jenis'];
	$jabatan=$_POST['jabatan'];
	$pengangkat=$_POST['pengangkat'];
	$thn = substr($tanggal, 6, 4);
	$bln = substr($tanggal, 0, 2);
	$tgl   = substr($tanggal, 3, 2);
	$tanggal=$thn."-".$bln."-".$tgl;
	if(empty($tanggal) || empty($nosk) || empty($jenis) || empty($jabatan) || empty($pengangkat)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from sk where tanggal_sk='$tanggal' and no_sk='$nosk' and ptk_id='$ptkid'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Nomor SK sudah ada, silahkan hapus terlebih dahulu!";
		}else{
			$sql1 = "insert into sk values('','$tanggal','$nosk','$ptkid','$pendidikan','$jenis','$jabatan','$pengangkat')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan SK berhasil dilakukan";		
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