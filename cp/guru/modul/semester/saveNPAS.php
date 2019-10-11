<?php
include_once("../../inc/db.php");
session_start();
date_default_timezone_set("Asia/Bangkok");
$tanggal = date('Y-m-d H:i:s');
$iduser=$_SESSION['userid'];
$pdid=$_REQUEST['id'];
$smt=$_REQUEST['smt'];
$tapel=$_REQUEST['tapel'];
$mapel=$_REQUEST['mp'];
$kelas=$_REQUEST['kelas'];
$nilai=$_REQUEST['value'];
$kd=$_REQUEST['kd'];
$ab=substr($kelas,0,1);
$cek="select * from nats where id_pd='$pdid' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mapel' and kd='$kd'";
$hasil=mysqli_query($koneksi,$cek);
$ada = mysqli_num_rows($hasil);
$utt=mysqli_fetch_array($hasil);
if ($ada>0){
	$idn=$utt['idNH'];
	if($nilai==0 or empty($nilai)){
		$sql="DELETE FROM nats WHERE idNH='$idn'";
		mysqli_query($koneksi, "INSERT INTO log VALUES('','$iduser','Nilai','Hapus Nilai PAS [$pdid $smt $tapel $mapel $kelas $kd]','$tanggal')") or die("database error:". mysqli_error($koneksi));
	}else{ 
		$sql = "UPDATE nats SET nilai='$nilai' WHERE idNH='$idn'";
		mysqli_query($koneksi, "INSERT INTO log VALUES('','$iduser','Nilai','Ubah Nilai PAS [$pdid $smt $tapel $mapel $kelas $kd] menjadi $nilai','$tanggal')") or die("database error:". mysqli_error($koneksi));
	};
}else{
	$sql = "INSERT INTO nats VALUES('','$pdid','$ab','$smt','$tapel','$mapel','$kd','$nilai')";
	mysqli_query($koneksi, "INSERT INTO log VALUES('','$iduser','Nilai','Input Nilai PAS [$pdid $smt $tapel $mapel $kelas $kd $nilai]','$tanggal')") or die("database error:". mysqli_error($koneksi));
};
mysqli_query($koneksi, $sql) or die("database error:". mysqli_error($koneksi));
$vck=mysqli_num_rows(mysqli_query($koneksi,"select * from temp_pas where id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mapel'"));
$vrh=mysqli_fetch_array(mysqli_query($koneksi,"select avg(nilai) as rerata from nats where id_pd='$pdid' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mapel'"));
$rerata=$vrh['rerata'];
if($vck>0){
	$vcn=mysqli_fetch_array(mysqli_query($koneksi,"select * from temp_pas where id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mapel'"));
	$idt=$vcn['idNH'];
	$sql1 = "UPDATE temp_pas SET nilai='$rerata' WHERE idNH='$idt'";
}else{
	$sql1 = "INSERT INTO temp_pas VALUES('','$pdid','$kelas','$smt','$tapel','$mapel','$rerata')";
};
mysqli_query($koneksi, $sql1) or die("database error:". mysqli_error($koneksi));
echo "saved";
?>