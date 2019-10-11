<?php 

require_once '../../inc/db_connect.php';
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

$sql = "SELECT *,
min(left(RIGHT(tanggal, 8), 5)) jam1,
MAX(left(right(tanggal, 8), 5)) jam2,
if(LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '07:00:00'))))>0,LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '07:00:00'))))/60,'') diff1, 
if(LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('16:00:00', MAX(left(right(tanggal, 8), 5))))))>0,LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('16:00:00', MAX(left(right(tanggal, 8), 5))))))/60,'') diff2
FROM absensi_ptk where date(tanggal)='$hariini' group by pegawai_id";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['pegawai_id'];
	$nsb=$connect->query("select * from id_pegawai where pegawai_id='$idp'")->fetch_assoc();
	$ida=$nsb['ptk_id'];
	$nsp=$connect->query("select * from ptk where ptk_id='$ida'")->fetch_assoc();
	$tombol='
	<button class="btn btn-effect-ripple btn-xs btn-danger" type="button" data-toggle="modal" data-target="#hapusTabModal" onclick="hapusTab('.$row['id'].')"><i class="fa fa-trash"></i></button>
	';
	$output['data'][] = array(
		$row['pegawai_id'],
		$nsp['nama'],
		$row['jam1'],
		$row['jam2'],
		$row['diff1'],
		$row['diff2'],
		$tombol
	);
}

// database connection close
$connect->close();

echo json_encode($output);