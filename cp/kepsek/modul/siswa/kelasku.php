<?php 
require_once '../../inc/db_connect.php';
function TanggalIndo($tanggal)
{
	$bulan = array ('Januari',
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
	return $split[2] . ' ' . $bulan[ (int)$split[1]-1 ] . ' ' . $split[0];
};
$output = array('data' => array());
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['peserta_didik_id'];
	$sqlp = "SELECT * FROM siswa WHERE peserta_didik_id='$idp'";
	$pn = $connect->query($sqlp)->fetch_assoc();
	$nisn=$pn['nisn'];
	$jk=$pn['jk'];
	$ids=$pn['id'];
	if(file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/images/siswa/".$pn['avatar'])){
		$gbr="../../../images/siswa/".$pn['avatar'];
	}else{
		$gbr="../../../images/user-default.png";
	};
	$rmb=$row['rombel'];
	$actionButton = '
		<a href="#myModal" class="btn btn-effect-ripple btn-xs btn-danger" type="button" id="'.$ids.'" data-toggle="modal" data-id="'.$ids.'"><i class="fa fa-edit"></i> Edit</a>
		<button class="btn btn-effect-ripple btn-xs btn-danger" type="button" data-toggle="modal" data-target="#outMemberModal" onclick="outMember('.$row['id_rombel'].')"><i class="fa fa-trash"></i> Out</button>
		<a href="../../cetak/cetakNISN.php?idp='.$ids.'" class="btn btn-effect-ripple btn-xs btn-danger" type="button" target="_blank"><i class="fa fa-print"></i> NISN</a>
		';
	$tgl=$pn['tempat'].", ".TanggalIndo($pn['tanggal']);
	$namasis=$pn['nama'];
	$foto='<img src="'.$gbr.'" class="img-circle" alt="User Image" height="30px" width="30px">';
	$output['data'][] = array(
		$foto,
		$pn['nis'],
		$pn['nisn'],
		$pn['nama'],
		$tgl,
		$pn['jk'],
		$actionButton
	);
}

// database connection close
$connect->close();

echo json_encode($output);