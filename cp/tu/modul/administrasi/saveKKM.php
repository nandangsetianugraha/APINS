<?php
include_once("../../inc/db.php");
$idp=$_REQUEST['id'];
$kelas=$_REQUEST['kelas'];
$tapel=$_REQUEST['tapel'];
$mpid=$_REQUEST['mp'];
$jns=$_REQUEST['jns'];
$kd=$_REQUEST['kd'];
$cek="select * from kkmku where kelas='$kelas' AND tapel='$tapel' AND mapel='$mpid' and kd='$kd'";
$hasil=mysqli_query($koneksi,$cek);
$ada = mysqli_num_rows($hasil);
$utt=mysqli_fetch_array($hasil);
if ($ada>0){
	$idn=$utt['id_kkm'];
	if($nilai==0 or empty($nilai)){
		$sql="DELETE FROM kkmku WHERE id_kkm='$idn'";
	}else{ 
		$sql = "UPDATE kkmku SET $jns='$nilai' WHERE idNH='$idn'";
	};
}else{
	if($jns=="k1"){
		$sql = "INSERT INTO kkmku VALUES('','$kelas','$tapel','$mapel','$kd','$nilai','','','$nilai')";
	};
	if($jns=="k2"){
		$sql = "INSERT INTO kkmku VALUES('','$kelas','$tapel','$mapel','$kd','','$nilai','','$nilai')";
	};
	if($jns=="k3"){
		$sql = "INSERT INTO kkmku VALUES('','$kelas','$tapel','$mapel','$kd','','','$nilai','$nilai')";
	};
	
};
mysqli_query($koneksi, $sql) or die("database error:". mysqli_error($koneksi));
echo "saved";
?>