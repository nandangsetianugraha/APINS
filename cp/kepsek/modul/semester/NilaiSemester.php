<?php 
require_once '../../inc/db_connect.php';
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$kelas=$_GET['kelas'];
$ab=substr($kelas,0,1);
$peta=$_GET['peta'];
$mpid=$_GET['mp'];
$kd=$_GET['kd'];
$ckkm=$connect->query("select * from kkmku where kelas='$ab' and tapel='$tapel' and mapel='$mpid'")->num_rows;
$ckkdp=$connect->query("select * from kd where kelas='$ab' and aspek=3 and mapel='$mpid' group by kd")->num_rows;
$ckkdk=$connect->query("select * from kd where kelas='$ab' and aspek=4 and mapel='$mpid' group by kd")->num_rows;
$jumkd=$ckkdp+$ckkdk;
if($ckkm==3*$jumkd){
	$boleh=true;
}else{
	$boleh=false;
};
$ab=substr($kelas, 0, 1);
$mpm=$connect->query("select * from mapel where id_mapel='$mpid'")->fetch_assoc();
if($kd==0){
	echo "<div class='alert alert-info alert-dismissible'><h4><i class='icon fa fa-info'></i> Informasi</h4>Silahkan Pilih Kompetensi Dasar (KD)</div>";
}else{
	if($boleh==false){
		?>
		<div class="error-page">
			<div class="error-content text-center" style="margin-left: 0;">
				<h3><i class="fa fa-info-circle text-danger"></i> Kesalahan </h3>
				<p>Belum Mengisi KKM <?=$mpm['nama_mapel'];?> Kelas <?=$ab;?>, silahkan isi terlebih dahulu dan lengkapi KKM <?=$mpm['nama_mapel'];?> Kelas <?=$ab;?>.</p>
			</div>
		</div>
	<?php 
	}else{	
		?>

		<div class="table-responsive no-padding">
		<table class="table table-bordered table-hover">
									<thead>
									   <tr>
										<th>Nama Siswa</th>
											<th>Nilai</th>
										</tr>
									</thead>
									<tbody>	
		<?php 
		$sql="select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
		$query = $connect->query($sql);
		while($s=$query->fetch_assoc()) {
			$idp=$s['peserta_didik_id'];
			$sql1 = "select * from nuts where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mpid' and kd='$kd'";
			$query1 = $connect->query($sql1);
			$m=$query1->fetch_assoc();
			$nPTS=$m['nilai'];
			if(empty($m['nilai'])){
				$nPTS='';
			}else{
				$nPTS=number_format($m['nilai'],0);
			};
			$nkd='
			<span class="input-group-addon" contenteditable="true" data-old_value="'.$nPTS.'"  onBlur="saveUT(this,\'nilai\',\''.$idp.'\',\''.$kelas.'\',\''.$smt.'\',\''.$tapel.'\',\''.$mpid.'\',\''.$kd.'\')" onClick="highlightEdit(this);">'.$nPTS.'</span>
			';
		?>
		<tr>
			<td><?=$s['nama'];?></td>
			<td><?=$nkd;?></td>
		</tr>
		<?php
		};
		?>
																	
									</tbody>
								</table>
								</div>
<?php };};?>