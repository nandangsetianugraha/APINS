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

$sql = "
SELECT p.pegawai_id,
       p.ptk_id,
	    if(m.diff1=12600,'07:00',m.jam1) jam1,
       if(m.diff2=14400,'16:00',m.jam2) jam2,
       if(m.diff1>0, m.diff1/60, '') diff1,
       if(m.diff2>0, m.diff2/60, '') diff2
FROM
  (SELECT *
   FROM id_pegawai p,

     (SELECT DISTINCT DATE(tanggal) tgl
      FROM absensi_ptk m) m) p
LEFT JOIN
  (SELECT LEFT(tanggal, 10) tgl,
          min(left(RIGHT(tanggal, 8), 5)) jam1,
          MAX(left(right(tanggal, 8), 5)) jam2,
          LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '07:30:00')))) diff1,
          LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('16:00:00', MAX(left(right(tanggal, 8), 5)))))) diff2,
          pegawai_id
   FROM absensi_ptk m
   GROUP BY tanggal,
            pegawai_id) M ON p.pegawai_id = m.pegawai_id
AND p.tgl = m.tgl
ORDER BY 1,
         p.peg_id
";
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
		$row['masuk'],
		$row['keluar'],$tombol
	);
}

// database connection close
$connect->close();

echo json_encode($output);