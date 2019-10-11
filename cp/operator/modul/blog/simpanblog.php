<?php 

require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$id=$_POST['id'];
	$tanggal=$_POST['tanggal'];
	$tgl=substr($tanggal,3,2);
	$bln=substr($tanggal,0,2);
	$thn=substr($tanggal,6,4);
	$waktu=$thn."-".$bln."-".$tgl;
	$judul=$_POST['judul'];
	$isi=$_POST['isiartikel'];
	if(empty($tanggal) || empty($judul)){
		header('location:../../pages/editblog.php?idp='.$id.'&status=kosong');
		exit();
	}else{
		$sql1 = "UPDATE berita SET tanggal='$waktu', judul='$judul', isi='$isi' WHERE id='$id'";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				header('location:../../pages/editblog.php?idp='.$id.'&status=sukses');
				exit();				
			} else {		
				header('location:../../pages/editblog.php?idp='.$id.'&status=gagal');
				exit();
			};
		
	};
	
}
?>