<?php
include_once("../../inc/db.php");
$pdid=$_REQUEST['id'];
$smt=$_REQUEST['smt'];
$tapel=$_REQUEST['tapel'];
$mapel=$_REQUEST['mp'];
$kelas=$_REQUEST['kelas'];
$nilai=$_REQUEST['value'];
$kd=$_REQUEST['kd'];
$cek="select * from nuts where id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mapel' and kd='$kd'";
$hasil=mysqli_query($koneksi,$cek);
$ada = mysqli_num_rows($hasil);
$utt=mysqli_fetch_array($hasil);
if ($ada>0){
	$idn=$utt['idNH'];
	if($nilai==0 or empty($nilai)){
		$sql="DELETE FROM nuts WHERE idNH='$idn'";
	}else{ 
		$sql = "UPDATE nuts SET nilai='$nilai' WHERE idNH='$idn'";
	};
}else{
	$sql = "INSERT INTO nuts VALUES('','$pdid','$kelas','$smt','$tapel','$mapel','$kd','$nilai')";
};
mysqli_query($koneksi, $sql) or die("database error:". mysqli_error($koneksi));
echo "saved";
?>