<?php 
require_once '../../inc/db_connect.php';
function TanggalIndo($tanggal){
    if(!empty($tanggal)){
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
};
$tapel=$_GET['tapel'];
$kelas=$_GET['kelas'];
$output = array('data' => array());

$sql="select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idp=$s['peserta_didik_id'];
	$nama=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
	$nopes=$connect->query("select * from pesertaun where peserta_didik_id='$idp'")->fetch_assoc();
	$output['data'][] = array(
		$nopes['nopes'],
		$nama['nis'],$nama['nisn'],$nama['nama'],$nama['tempat'].', '.TanggalIndo($nama['tanggal']),$nama['nama_ayah'],$nama['nama_ibu']
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);