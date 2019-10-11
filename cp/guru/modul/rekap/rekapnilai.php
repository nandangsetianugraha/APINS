<?php 

require_once '../../inc/db_connect.php';
$tapel=$_GET['tapel'];
$kelas=$_GET['kelas'];
$ab=substr($kelas, 0, 1);
$smt=$_GET['smt'];
$jns=$_GET['jns'];
$output = array('data' => array());
$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
$query = $connect->query($sql);
//$hasil=$query->num_rows;
while($s=$query->fetch_assoc()) {
	$idp=$s['peserta_didik_id'];
	$nh1=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='1' and jns='$jns'")->fetch_assoc();
	$nh2=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='2' and jns='$jns'")->fetch_assoc();
	$nh3=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='3' and jns='$jns'")->fetch_assoc();
	$nh4=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='4' and jns='$jns'")->fetch_assoc();
	$nh5=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='5' and jns='$jns'")->fetch_assoc();
	$nh6=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='6' and jns='$jns'")->fetch_assoc();
	$nh7=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='7' and jns='$jns'")->fetch_assoc();
	$nh8=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='8' and jns='$jns'")->fetch_assoc();
	$nh9=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='9' and jns='$jns'")->fetch_assoc();
	$nh10=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='10' and jns='$jns'")->fetch_assoc();
	$nh11=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='11' and jns='$jns'")->fetch_assoc();
	$nh12=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='12' and jns='$jns'")->fetch_assoc();
	$nrh=$connect->query("select avg(nilai) as rerata from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='$jns'")->fetch_assoc();
	$nrt=$connect->query("select sum(nilai) as rerata from raport_k13 where id_pd='$idp'  and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='$jns'")->fetch_assoc();
	//$rnk=$connect->query("select *,sum(nilai) as jumlah,( select find_in_set( jumlah,( select group_concat(distinct jumlah order by jumlah DESC separator ',') from raport))) as rangking from raport where id_pd='$idp' and smt='$smt' and tapel='$tapel'")->fetch_assoc();
	//$qrap="";
	
		$output['data'][] = array(
			$s['nama'],
			$nh1['nilai'],
			$nh2['nilai'],
			$nh3['nilai'],
			$nh4['nilai'],
			$nh5['nilai'],
			$nh6['nilai'],
			$nh7['nilai'],
			$nh8['nilai'],
			$nh9['nilai'],
			$nh10['nilai'],
			$nh11['nilai'],
			$nh12['nilai'],
			number_format($nrt['rerata'],2),
			number_format($nrh['rerata'],2)
		);
	};

// database connection close
$connect->close();

echo json_encode($output);
