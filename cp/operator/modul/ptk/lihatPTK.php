<?php
include '../../inc/db.php';
$idp=isset($_GET['idp']) ? $_GET['idp'] : $idku;
$bio = mysqli_fetch_array(mysqli_query($koneksi, "select * from ptk where ptk_id='$idp'"));
$niy1=$bio['niy_nigk'];
$jns=$bio['jenis_ptk_id'];
$rm = mysqli_fetch_array(mysqli_query($koneksi, "select * from mengajar where ptk_id='$idp'"));
$kelas1=$rm['rombel'];
$ab1=substr($kelas1,0,1);
$jptk = mysqli_fetch_array(mysqli_query($koneksi, "select * from jenis_ptk where jenis_ptk_id='$jns'"));
?>
<ul class="list-group list-group-unbordered">
	<li class="list-group-item">
	  <b><?=$jptk['jenis_ptk'];?></b> <div class="pull-right"><?php if($kelas1=="0"){echo "Semua Kelas";}else{echo $kelas1;} ?></div>
	</li>
</ul>
