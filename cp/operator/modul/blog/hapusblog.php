<?php 

require_once '../../inc/db_connect.php';

$output = array('success' => false, 'messages' => array());

$memberId = $_POST['member_id'];
$sql = "DELETE FROM berita WHERE id = {$memberId}";
$query = $connect->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = "Artikel Berhasil Hapus!!";
	
} else {
	$output['success'] = false;
	$output['messages'] = 'Error saat mencoba mengeluarkan data Guru';
}

// close database connection
$connect->close();

echo json_encode($output);