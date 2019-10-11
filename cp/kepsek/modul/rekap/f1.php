<?php 

require_once '../../inc/db_connect.php';
$tapel=$_GET['tapel'];
$kelas=$_GET['kelas'];
$ab=substr($kelas, 0, 1);
$smt=$_GET['smt'];
$jns=$_GET['jns'];
$output = array('data' => array());

$jsiswa=$connect->query("select count(id_rombel) as jumlah_siswa from penempatan where rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
$skl = "select * from mapel order by id_mapel asc";
$qkl = $connect->query($skl);
//$hasil=$query->num_rows;
while($s=$qkl->fetch_assoc()) {
	$idpel=$s['id_mapel'];
	$kkm=$connect->query("select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
		if(empty($kkm['nilai'])){
			$kkmsaya=0;
		}else{
			$kkmsaya=$kkm['nilai'];
		};
	if($jns=="PTS"){
		$dataf = $connect->query("select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pts where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
	}else{
		$dataf = $connect->query("select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pas where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
	};
	
		$output['data'][] = array(
			$s['nama_mapel'],
			'100',
			number_format($dataf['nmax'],0),
			number_format($dataf['nmin'],0),
			number_format($dataf['rerata'],0),
			$kkmsaya,
			$jsiswa['jumlah_siswa'],
			$jsiswa['jumlah_siswa'],
			'0',
			'100',
			number_format($dataf['rerata'],0),
			'Tuntas'
		);
	};

// database connection close
$connect->close();

echo json_encode($output);