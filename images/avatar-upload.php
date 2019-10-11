<?php
require_once "../inc/db.php";
require_once "config.php";
$id=$_GET['id'];
$response = ['status' => 'failed'];

if (isset($_FILES['uploadAvatar'])) {
    $fileUpload = $_FILES['uploadAvatar'];
    $fileName = hash("md5", uniqid()) . "." . pathinfo($fileUpload['name'], PATHINFO_EXTENSION);
    $targetFile = rtrim(trim(IMAGE_DIR), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName;
    move_uploaded_file($fileUpload['tmp_name'], $targetFile);
    $response['status'] = 'ok';
    $response['uploaded_url'] = getImageUrl($fileName);
	$sql_query = "SELECT * FROM siswa WHERE id = '".mysqli_escape_string($koneksi, $id)."'";		
		$resultset = mysqli_query($koneksi, $sql_query) or die("database error:". mysqli_error($koneksi));		
		if(mysqli_num_rows($resultset)) {     
			$ava=mysqli_fetch_array($resultset);
			$flama=$ava['avatar'];
			$hapusFile = rtrim(trim(IMAGE_DIR), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $flama;
			if(file_exists($hapusFile)){
				unlink($hapusFile);
			};
			$sql_update = "UPDATE siswa set avatar='".mysqli_escape_string($koneksi,$fileName)."' WHERE id = '".mysqli_escape_string($koneksi, $id)."'";			
			mysqli_query($koneksi, $sql_update) or die("database error:". mysqli_error($koneksi));
		};
} else {
    $response['message'] = "The uploaded file not found.";
}

echo json_encode($response);
