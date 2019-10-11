<?php 

require_once '../../inc/db_connect.php';

$output = array('success' => false, 'messages' => array());

$memberId = $_POST['member_id'];
$sql = "DELETE from kd where id_kd= {$memberId}";
$query = $connect->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Kompetensi Dasar Berhasil dihapus';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error saat mencoba menghapus data siswa';
}

// close database connection
$connect->close();

echo json_encode($output);