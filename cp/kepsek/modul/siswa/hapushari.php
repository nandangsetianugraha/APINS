<?php 

require_once '../../inc/db_connect.php';

$output = array('success' => false, 'messages' => array());

$memberId = $_POST['member_id'];
$sql = "DELETE from hari_efektif where id_hari= {$memberId}";
$query = $connect->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Hari Efektif Berhasil dihapus';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error Bro';
}

// close database connection
$connect->close();

echo json_encode($output);