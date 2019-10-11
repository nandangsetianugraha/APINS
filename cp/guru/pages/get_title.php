<?php
	include '../inc/db.php';
	$id_user = $_POST['id'];
	$query = "SELECT * FROM ptk WHERE ptk_id='$id_user'";
	$result = mysqli_query($koneksi, $query);
	$data = mysqli_fetch_array($result);
	$user = $data['ptk_id'];
	if(file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/images/ptk/".$data['gambar'])){
							$foto = $data['gambar'];
						}else{
							$foto = "user-default.png";
						};
	$nama = $data['nama'];
	echo $nama.'~'.$foto;
?>