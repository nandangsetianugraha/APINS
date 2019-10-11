<?php 

require_once '../../inc/db_connect.php';
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
$hariini=$_REQUEST['tanggal_now'];
$output = array('data' => array());

$sql = "SELECT * FROM tabungan where tanggal='$hariini' order by id asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['nasabah_id'];
	$nsb=$connect->query("select * from nasabah where nasabah_id='$idp'")->fetch_assoc();
	$tombol='
	<button class="btn btn-effect-ripple btn-xs btn-danger" type="button" data-toggle="modal" data-target="#hapusTabModal" onclick="hapusTab('.$row['id'].')"><i class="fa fa-trash"></i></button>
	';
	$output['data'][] = array(
		$nsb['nama'],
		$row['kode'],
		rupiah($row['masuk']),
		rupiah($row['keluar']),
		$tombol
	);
}

// database connection close
$connect->close();

echo json_encode($output);