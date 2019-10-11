<?php 
require_once '../../inc/db_connect.php';
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$kelas=$_GET['kelas'];
$peta=$_GET['peta'];
$mpid=$_GET['mp'];
$kd=$_GET['kd'];
$tema=$_GET['tema'];
$ab=substr($kelas, 0, 1);
if($kd==0){}else{
?>

<div class="table-responsive no-padding">
<table class="table table-bordered table-hover">
							<thead>
							   <tr>
								<th>Nama Siswa</th>
									<th>Praktek</th>
									<th>Proyek</th>
									<th>Portofolio</th>
								</tr>
							</thead>
							<tbody>	
<?php 
$sql="select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$idp=$s['peserta_didik_id'];
	$sql1 = "select * from nk where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mpid' and tema='$tema' and kd='$kd' and jns='prak'";
	$nh = $connect->query($sql1);
	$sql2 = "select * from nk where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mpid' and tema='$tema' and kd='$kd' and jns='proy'";
	$nh1 = $connect->query($sql2);
	$sql3 = "select * from nk where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mpid' and tema='$tema' and kd='$kd' and jns='port'";
	$nh2 = $connect->query($sql3);
	$m=$nh->fetch_assoc();
	$m1=$nh1->fetch_assoc();
	$m2=$nh2->fetch_assoc();
		$nHar=$m['nilai'];
		$ntgs=$m1['nilai'];
		$nlsn=$m2['nilai'];
		$nh='
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$nHar.'"  onBlur="saveDK4(this,\'nilai\',\''.$idp.'\',\''.$ab.'\',\''.$smt.'\',\''.$tapel.'\',\''.$mpid.'\',\''.$kd.'\',\'prak\',\''.$tema.'\')" onClick="highlightEdit(this);">'.$nHar.'</span>
		';
		$ntg1='
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$ntgs.'"  onBlur="saveDK4(this,\'nilai\',\''.$idp.'\',\''.$ab.'\',\''.$smt.'\',\''.$tapel.'\',\''.$mpid.'\',\''.$kd.'\',\'proy\',\''.$tema.'\')" onClick="highlightEdit(this);">'.$ntgs.'</span>
		';
		$ntg2='
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$nlsn.'"  onBlur="saveDK4(this,\'nilai\',\''.$idp.'\',\''.$ab.'\',\''.$smt.'\',\''.$tapel.'\',\''.$mpid.'\',\''.$kd.'\',\'port\',\''.$tema.'\')" onClick="highlightEdit(this);">'.$nlsn.'</span>
		';
?>
<tr>
	<td><?=$s['nama'];?></td>
	<td><?=$nh;?></td>
	<td><?=$ntg1;?></td>
	<td><?=$ntg2;?></td>
</tr>
<?php
};
?>
															
							</tbody>
						</table>
						</div>
<?php };?>