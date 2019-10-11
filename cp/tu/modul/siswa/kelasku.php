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
$st=isset($_GET['status']) ? $_GET['status'] : 1;
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : '2020/2021';
$sql = "select * from siswa where status='$st' order by nama asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	if(file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/images/siswa/".$row['avatar'])){
		$gbr="../../../images/siswa/".$row['avatar'];
	}else{
		$gbr="../../../images/user-default.png";
	};
	$idp=$row['id'];
	$ids=$row['peserta_didik_id'];
	if($st==1){
		$sqlp = "select * from penempatan where peserta_didik_id='$ids' and tapel='$tapel'";
		$pn = $connect->query($sqlp)->fetch_assoc();
		$rmb=$pn['rombel'];
		$actionButton = '
		<a href="../pages/edit-siswa.php?id='.$idp.'" class="btn btn-effect-ripple btn-xs btn-danger" type="button"><i class="fa fa-edit"></i></a>
		<button class="btn btn-effect-ripple btn-xs btn-danger" type="button" data-toggle="modal" data-target="#outMemberModal" onclick="outMember('.$idp.')"><i class="fa fa-trash"></i></button>
		<button class="btn btn-effect-ripple btn-xs btn-danger" type="button" data-toggle="modal" data-tapel="'.$tapel.'" data-id="'.$idp.'" data-target="#mutasiSiswa"><i class="fa fa-share-square-o"></i></button>
		<a href="../../cetak/cetakNISN.php?idp='.$idp.'" class="btn btn-effect-ripple btn-xs btn-danger" type="button" target="_blank"><i class="fa fa-print"></i></a>
		';	
	}else{
		$stt = $connect->query("select * from jns_mutasi where id_mutasi='$st'")->fetch_assoc();
		$rmb=$stt['nama_mutasi'];
		$actionButton = '
		<a href="../pages/edit-siswa.php?id='.$idp.'" class="btn btn-effect-ripple btn-xs btn-danger" type="button"><i class="fa fa-edit"></i> Edit</a>
		<button class="btn btn-effect-ripple btn-xs btn-danger" type="button" data-toggle="modal" data-tapel="'.$tapel.'" data-id="'.$idp.'" data-target="#mutasiSiswa"><i class="fa fa-share-square-o"></i></button>
		';
	};
	
	$tgl=$row['tempat'].", ".TanggalIndo($row['tanggal']);
	$namasis=$row['nama'];
	$foto='<img src="'.$gbr.'" class="img-circle" alt="User Image" height="30px" width="30px">';
	$output['data'][] = array(
		$foto,
		$row['nis'],
		$row['nisn'],
		$row['nama'],
		$tgl,
		$rmb,
		$actionButton
	);
}

// database connection close
$connect->close();

echo json_encode($output);