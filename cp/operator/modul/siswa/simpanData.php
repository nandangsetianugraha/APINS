<?php 

require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$id=$_POST['id'];
	$ids=$_POST['ids'];
	$nis=$_POST['nis'];
	$nisn=$_POST['nisn'];
	$nama=$connect->real_escape_string($_POST['nama']);
	$jk=$_POST['jk'];
	$tempat=$_POST['tempat'];
	$tanggal=$_POST['tanggal'];
	$nik=$_POST['nik'];
	$agama=$_POST['agama'];
	$pend=$_POST['pend_seb'];
	$alamat=$connect->real_escape_string($_POST['alamat']);
	$ayah=$connect->real_escape_string($_POST['ayah']);
	$ibu=$connect->real_escape_string($_POST['ibu']);
	$pek_ayah=$_POST['pek_ayah'];
	$pek_ibu=$_POST['pek_ibu'];
	//$=$_POST[''];
	//$=$_POST[''];
	$jalan=$_POST['jalan'];
	$kelurahan=$_POST['kelurahan'];
	$kecamatan=$_POST['kecamatan'];
	$kabupaten=$_POST['kabupaten'];
	$provinsi=$_POST['provinsi'];
	if(empty($nama) || empty($id)){
		$validator['success'] = false;
		$validator['messages'] = "Nama dan tanggal lahir tidak boleh kosong!";
	}else{
			$sql1 = "UPDATE siswa SET nis='$nis', nisn='$nisn', nama='$nama', jk='$jk', tempat='$tempat', tanggal='$tanggal', nik='$nik', agama='$agama', pend_sebelum='$pend', alamat='$alamat', nama_ayah='$ayah', nama_ibu='$ibu', pek_ayah='$pek_ayah', pek_ibu='$pek_ibu', jalan='$jalan', kelurahan='$kelurahan', kecamatan='$kecamatan', kabupaten='$kabupaten', provinsi='$provinsi' WHERE id='$id'";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Biodata $nama berhasil diperbaharui!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Kok Error ya???";
			};
		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}