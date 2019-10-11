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
	$nama=$connect->real_escape_string($_POST['nama']);
	$gelar=$_POST['gelar'];
	$jenis_kelamin=$_POST['jk'];
	$tempat_lahir=$_POST['tempat'];
	$tanggal_lahir=$_POST['tanggal'];
	$thn = substr($tanggal_lahir, 6, 4);
	$bln = substr($tanggal_lahir, 0, 2);
	$tgl   = substr($tanggal_lahir, 3, 2);
	$tgls=$thn."-".$bln."-".$tgl;
	$nik=$_POST['nik'];
	$niy_nigk=$_POST['niy'];
	$nuptk=$_POST['nuptk'];
	$status_kepegawaian_id=$_POST['status_peg'];
	$jenis_ptk_id=$_POST['jenisptk'];
	$alamat_jalan=$_POST['alamat'];
	$no_hp=$_POST['nohp'];
	$email=$_POST['email'];
	//$npa=$_POST['npa'];
	$id_pd1=random(8);
	$id_pd2=random(4);
	$id_pd3=random(4);
	$id_pd4=random(4);
	$id_pd5=random(12);
	$id_pd=$id_pd1.'-'.$id_pd2.'-'.$id_pd3.'-'.$id_pd4.'-'.$id_pd5;
	if(empty($nama) || empty($tempat_lahir) || empty($tanggal_lahir)){
		$validator['success'] = false;
		$validator['messages'] = "Harap Diisi dengan Benar!";
	}else{
			$sql2 = "INSERT INTO ptk VALUES('','$id_pd','$nama','$gelar','$jenis_kelamin','$tempat_lahir','$tgls','$nik','$niy_nigk',
										'$nuptk','$status_kepegawaian_id','$jenis_ptk_id','$alamat_jalan','$no_hp','$email','1','')";
			$query2 = $connect->query($sql2);
			if($query2 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Data PTK berhasil dibuat!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the member information";
			};
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}