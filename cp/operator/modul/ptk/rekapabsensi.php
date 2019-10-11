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
$tapel=$_REQUEST['tapel'];
$tahun=substr($hariini,0,4);
$bulan=substr($hariini,5,2);
$tgls=substr($hariini,8,2);
$output = array('data' => array());
$hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
$efekday=$connect->query("select * from hari_efektif where bulan='$bulan' and tapel='$tapel'")->fetch_assoc();

$sql = "select * from ptk where status_keaktifan_id=1";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['ptk_id'];
	$nsb=$connect->query("select * from id_pegawai where ptk_id='$idp'")->fetch_assoc();
	$ida=$nsb['pegawai_id'];
	for ($i=1; $i < $hari+1; $i++) { 
	};
	$sql2 = "SELECT *,
min(left(RIGHT(tanggal, 8), 5)) jam1,
MAX(left(right(tanggal, 8), 5)) jam2,
if(LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '07:00:00'))))>0,LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '07:00:00'))))/60,'') diff1, 
if(LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('16:00:00', MAX(left(right(tanggal, 8), 5))))))>0,LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('16:00:00', MAX(left(right(tanggal, 8), 5))))))/60,'') diff2
FROM absensi_ptk where date(tanggal)='$hariini' and pegawai_id='$ida' group by pegawai_id";
$jabs=$connect->query($sql2)->fetch_assoc();
$jmanual=$connect->query($sql2)->num_rows;
if($jmanual>0){
	$tombol='
	<button class="btn btn-effect-ripple btn-xs btn-danger" type="button" data-toggle="modal" data-target="#hapusTabModal" onclick="hapusTab('.$jabs['id'].')"><i class="fa fa-trash"></i></button>
	<button class="btn btn-effect-ripple btn-xs btn-danger" type="button" data-toggle="modal" data-id="'.$ida.'" data-tgl="'.$hariini.'" data-target="#absenmanual"><i class="fa fa-share-square-o"></i></button>
	';
}else{
	$tombol='
	<button class="btn btn-effect-ripple btn-xs btn-danger" type="button" data-toggle="modal" data-id="'.$ida.'" data-tgl="'.$hariini.'" data-target="#absenmanual"><i class="fa fa-share-square-o"></i></button>
	';
}
	
	
	$output['data'][] = array(
		$nsb['pegawai_id'],
		$row['nama'],
		$jabs['jam1'],
		$jabs['jam2'],
		$jabs['diff1'],
		$jabs['diff2'],
		$tombol
	);
}

// database connection close
$connect->close();

echo json_encode($output);