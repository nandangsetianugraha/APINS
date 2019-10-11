<?php 

require_once '../../inc/db_connect.php';

$output = array('success' => false, 'messages' => array());

$memberId = $_POST['member_id'];
$sqlp = "SELECT * FROM ptk WHERE id = '$memberId'";
	$queryp = $connect->query($sqlp);
	$rs = $queryp->fetch_assoc();
	$ptkid=$rs['ptk_id'];
	$nama=$rs['nama'];
$sql = "DELETE FROM ptk WHERE id = {$memberId}";
$query = $connect->query($sql);
if($query === TRUE) {
	$sql1 = "DELETE FROM pengguna WHERE ptk_id = {$ptkid}";
	$query1 = $connect->query($sql1);
	$output['success'] = true;
	$output['messages'] = "Data ".$nama." Berhasil Hapus!!";
	
} else {
	$output['success'] = false;
	$output['messages'] = 'Error saat mencoba mengeluarkan data Guru';
}

// close database connection
$connect->close();

echo json_encode($output);