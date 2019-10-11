<?php 

require_once '../../inc/db_connect.php';

$output = array('success' => false, 'messages' => array());
$memberId = $_POST['member_id'];
$sqlp = "SELECT * FROM nasabah WHERE id = '$memberId'";
$queryp = $connect->query($sqlp);
$rs = $queryp->fetch_assoc();
$nama=$rs['nama'];
$idN=$rs['nasabah_id'];
$jns=$rs['jenis'];
//hapus Nasabah
$sql = "DELETE FROM nasabah WHERE id = {$memberId}";
$query = $connect->query($sql);
//Hapus data tabungan
$sql1 = "DELETE FROM tabungan WHERE nasabah_id = {$idN}";
$query1 = $connect->query($sql1);
if($query === TRUE) {
	if($jenis==1){
		$sql1 = "UPDATE siswa SET nasabah_id='0' WHERE peserta_didik_id='$idsis'";
		$query1 = $connect->query($sql1);
	}elseif($jenis==2){
		$sql1 = "UPDATE ptk SET nasabah_id='0' WHERE ptk_id='$idsis'";
		$query1 = $connect->query($sql1);
	}else{
		
	};
	$output['success'] = true;
	$output['messages'] = $nama." Berhasil dihapus ";
} else {
	$output['success'] = false;
	$output['messages'] = 'Error saat mencoba mengeluarkan data nasabah';
}

// close database connection
$connect->close();

echo json_encode($output);