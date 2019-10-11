<?php
include_once("../../inc/db.php");
$nopes=$_REQUEST['id'];
$mapel=$_REQUEST['mp'];
$nilai=$_REQUEST['value'];
$cek="select * from nilaiun where nopes='$nopes' AND mapel='$mapel'";
$hasil=mysqli_query($koneksi,$cek);
$ada = mysqli_num_rows($hasil);
$utt=mysqli_fetch_array($hasil);
if ($ada>0){
	$idn=$utt['id'];
	if($nilai==0 or empty($nilai)){
		$sql="DELETE FROM nilaiun WHERE id='$idn'";
	}else{ 
		$sql = "UPDATE nilaiun SET nilai='$nilai' WHERE id='$idn'";
	};
}else{
	$sql = "INSERT INTO nilaiun VALUES('','$nopes','$mapel','$nilai')";
};
mysqli_query($koneksi, $sql) or die("database error:". mysqli_error($koneksi));
echo "saved";
?>