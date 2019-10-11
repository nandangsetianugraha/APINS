<?php 

require_once '../../inc/db_connect.php';
function random($panjang)
{
   $karakter = 'abcdefghijklmnopqrstuvwxyz1234567890';
   $string = '';
   for($i = 0; $i < $panjang; $i++) {
   $pos = rand(0, strlen($karakter)-1);
   $string .= $karakter{$pos};
   }
    return $string;
};
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$tanggal=$_POST['tanggal'];
	$tgl=substr($tanggal,3,2);
	$bln=substr($tanggal,0,2);
	$thn=substr($tanggal,6,4);
	$waktu=$thn."-".$bln."-".$tgl;
	$judul=$_POST['judul'];
	$isi=$_POST['isi'];
	if(empty($tanggal) || empty($judul)){
		header('location:../../pages/blog.php?status=kosong');
		exit();
	}else{
			$sql2 = "INSERT INTO berita VALUES('','$waktu','$judul','$isi')";
			$query2 = $connect->query($sql2);
			if($query2 === TRUE) {			
				header('location:../../pages/blog.php?status=sukses');
				exit();		
			} else {		
				header('location:../../pages/blog.php?status=gagal');
				exit();
			};
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}