<?php 

require_once '../../inc/db_connect.php';

$output = array('success' => false, 'messages' => array());
$cfg=$connect->query("select * from konfigurasi")->fetch_assoc();
$smt=$cfg['semester'];
$tapel=$cfg['tapel'];
$memberId = $_POST['member_id'];
$sqlp = "SELECT * FROM siswa WHERE id = '$memberId'";
	$queryp = $connect->query($sqlp);
	$rs = $queryp->fetch_assoc();
	$nama=$rs['nama'];
	$ids=$rs['peserta_didik_id'];
$sql = "DELETE FROM siswa WHERE id = {$memberId}";
$query = $connect->query($sql);
$sql1 = "DELETE FROM penempatan WHERE peserta_didik_id = {$ids} and tapel = {$tapel}";
$query1 = $connect->query($sql1);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = $nama." Berhasil dihapus ";
} else {
	$output['success'] = false;
	$output['messages'] = 'Error saat mencoba mengeluarkan data siswa';
}

// close database connection
$connect->close();

echo json_encode($output);