<?php 

require_once '../../../inc/db_connect.php';
session_start();
date_default_timezone_set("Asia/Bangkok");
$tanggal = date('Y-m-d H:i:s');
$output = array('success' => false, 'messages' => array());

$memberId = $_POST['member_id'];
$sql = "DELETE from nsp where idNH= {$memberId}";
$query = $connect->query($sql);
$querys = $connect->query("INSERT INTO log VALUES('','$iduser','Nilai Spiritual','Hapus Nilai Spiritual','$tanggal')");
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Nilai Aspek Berhasil dihapus';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error saat mencoba menghapus data siswa';
}

// close database connection
$connect->close();

echo json_encode($output);