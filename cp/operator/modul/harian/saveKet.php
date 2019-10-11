<?php
include_once("../../inc/db.php");
$idp=$_REQUEST['id'];
$smt=$_REQUEST['smt'];
$tapel=$_REQUEST['tapel'];
$mpid=$_REQUEST['mp'];
$ab=$_REQUEST['kelas'];
$nilai=$_REQUEST['value'];
$tema=$_REQUEST['tema'];
$kd=$_REQUEST['kd'];
$jns=$_REQUEST['jns'];
$cek="select * from nk where id_pd='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mpid' and tema='$tema' and kd='$kd' and jns='$jns'";
$hasil=mysqli_query($koneksi,$cek);
$ada = mysqli_num_rows($hasil);
$utt=mysqli_fetch_array($hasil);
if ($ada>0){
	$idn=$utt['idNH'];
	if($nilai==0 or empty($nilai)){
		$sql="DELETE FROM nk WHERE idNH='$idn'";
	}else{ 
		$sql = "UPDATE nk SET nilai='$nilai' WHERE idNH='$idn'";
	};
}else{
	$sql = "INSERT INTO nk VALUES('','$idp','$ab','$smt','$tapel','$mpid','$tema','$kd','$jns','$nilai')";
};
mysqli_query($koneksi, $sql) or die("database error:". mysqli_error($koneksi));
echo "saved";
?>