<?php
include_once("../../inc/db.php");
$pdid=$_REQUEST['id'];
$mapel=$_REQUEST['mp'];
$nilai=$_REQUEST['value'];
$toke=$_REQUEST['toke'];
$cek="select * from tryout where peserta_didik_id='$id' and toke='$toke' and mapel='$mapel'";
$hasil=mysqli_query($koneksi,$cek);
$ada = mysqli_num_rows($hasil);
$utt=mysqli_fetch_array($hasil);
if ($ada>0){
	$idn=$utt['id_to'];
	if($nilai==0 or empty($nilai)){
		$sql="DELETE FROM tryout WHERE id_to='$idn'";
	}else{ 
		$sql = "UPDATE tryout SET nilai='$nilai' WHERE id_to='$idn'";
	};
}else{
	$sql = "INSERT INTO tryout VALUES('','$pdid','$toke','$mapel','$nilai')";
};
mysqli_query($koneksi, $sql) or die("database error:". mysqli_error($koneksi));
echo "saved";
?>