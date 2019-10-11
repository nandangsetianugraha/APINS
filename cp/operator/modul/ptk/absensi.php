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
$idpeg=$_REQUEST['idpeg'];
$bln=$_REQUEST['bln'];
$thn=$_REQUEST['thn'];
$output = array('data' => array());

$sql = "SELECT pegawai_id,
DATE_FORMAT(tanggal,'%Y-%m-%d') tgl,
min(left(RIGHT(tanggal, 8), 5)) jam1,
MAX(left(right(tanggal, 8), 5)) jam2,
if(LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '07:00:00'))))>0,LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '07:00:00'))))/60,'') diff1, 
if(LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('16:00:00', MAX(left(right(tanggal, 8), 5))))))>0,LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('16:00:00', MAX(left(right(tanggal, 8), 5))))))/60,'') diff2
FROM absensi_ptk where pegawai_id='$idpeg' and DATE_FORMAT(tanggal,'%Y-%m-%d') like '$thn-%$bln-%' group by tgl";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$output['data'][] = array(
		$row['tgl'],
		$row['jam1'],
		$row['jam2'],
		$row['diff1'],
		$row['diff2']
	);
}

// database connection close
$connect->close();

echo json_encode($output);