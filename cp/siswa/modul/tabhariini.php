<?php 

require_once '../inc/db_connect.php';
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}
function TanggalIndo($date){
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);
 
    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;        
    return($result);
};
$idN=$_REQUEST['idN'];
$output = array('data' => array());

$sql = "SELECT * FROM tabungan where nasabah_id='$idN' order by tanggal asc";
$query = $connect->query($sql);
$saldo=0;
while ($row = $query->fetch_assoc()) {
	$debet=$row['masuk'];
	$kredit=$row['keluar'];
	$saldo=$saldo+$debet-$kredit;
	$output['data'][] = array(
		$row['tanggal'],
		$row['kode'],
		rupiah($debet),
		rupiah($kredit),
		rupiah($saldo)
	);
}

// database connection close
$connect->close();

echo json_encode($output);