<?php 

require_once '../../inc/db_connect.php';
function TanggalIndo($tanggal){
    if(!empty($tanggal)){
		$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
		$split = explode('-', $tanggal);
		return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
	};
};
$tapel=$_GET['tapel'];
$output = array('data' => array());

$sql = "SELECT * FROM rombel WHERE tapel='$tapel' order by nama_rombel asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idr=$row['nama_rombel'];
	$idk=$row['id_rombel'];
	$idwk=$row['wali_kelas'];
	$sqlp = "SELECT * FROM ptk WHERE ptk_id='$idwk'";
	$queryp = $connect->query($sqlp);
	$pn = $queryp->fetch_assoc();
	$actionButton = '
		  <a href="../pages/rombel.php?kelas='.$idr.'" class="btn btn-effect-ripple btn-xs btn-danger" type="button"> Lihat</a>
		  <a href="#" class="btn btn-effect-ripple btn-xs btn-danger edit-record" data-id="'.$idk.'" type="button">Edit</a>
		';
		$output['data'][] = array(
			$row['nama_rombel'],
			$row['kurikulum'],
			$pn['nama'],
			$actionButton
			);
	
}

// database connection close
$connect->close();

echo json_encode($output);