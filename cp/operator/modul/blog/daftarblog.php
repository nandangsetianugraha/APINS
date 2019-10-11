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
$output = array('data' => array());

$sql = "SELECT * FROM berita order by tanggal desc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['id'];
	$actionButton = '
	<a href="editblog.php?idp='.$idp.'" class="btn btn-effect-ripple btn-xs btn-success"><i class="glyphicon glyphicon-pencil"></i></a>
	<button class="btn btn-effect-ripple btn-xs btn-danger" type="button" data-toggle="modal" data-target="#outMemberModal" onclick="outMember('.$idp.')"><i class="glyphicon glyphicon-trash"></i></button>
	';
	
	$output['data'][] = array(
		TanggalIndo($row['tanggal']),
		$row['judul'],
		substr($row['isi'],0,100)."...",
		$actionButton
	);
}

// database connection close
$connect->close();

echo json_encode($output);