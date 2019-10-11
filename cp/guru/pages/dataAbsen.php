<?php 
require_once '../../inc/db.php';
$bln=$_GET['bulan'];
$thn=$_GET['tahun'];
$tpl=$_GET['tapel'];
$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$sq2=mysqli_query($koneksi, "select * from penempatan JOIN siswa USING(peserta_didik_id) where siswa.jk='L' and penempatan.tapel='$tpl'");
				$sq3=mysqli_query($koneksi, "select * from penempatan JOIN siswa USING(peserta_didik_id) where siswa.jk='P' and penempatan.tapel='$tpl'");
				$juml=mysqli_num_rows($sq2);
				$jump=mysqli_num_rows($sq3);
				
				$total=$juml+$jump;
				if($total>0){
					$perlak=($juml/$total)*100;
					$perper=($jump/$total)*100;
				}else{
					$perlak=0;
					$perper=0;
				};
$sabsen=mysqli_query($koneksi, "select * from penempatan where tapel='$tpl'");
$sakit=0;
$ijin=0;
$alfa=0;
while($mk=mysqli_fetch_array($sabsen)){
	$pds=$mk['peserta_didik_id'];
	$snama=mysqli_query($koneksi, "select *,SUM(IF(absensi='S',1,0)) AS sakit,SUM(IF(absensi='I',1,0)) AS ijin,SUM(IF(absensi='A',1,0)) AS alfa from absensi where tanggal LIKE '$thn-$bln-%' and peserta_didik_id='$pds'");
	$jab=mysqli_fetch_array($snama);
	$sakit=$sakit+$jab['sakit'];
	$ijin=$ijin+$jab['ijin'];
	$alfa=$alfa+$jab['alfa'];
};
$jkeh=$sakit+$ijin+$alfa;
$hef=mysqli_query($koneksi,"select * from hari_efektif where bulan='$bln' and tapel='$tpl'");
$efek=mysqli_fetch_array($hef);
if($efek['hari']==0){
	$harim=23;
}else{
	$harim=$efek['hari'];
};
if($total==0){
	$ttl=1;
}else{
	$ttl=$total;
};
$hefek=round(($jkeh*100)/($harim*$ttl),2);
?>					
					<div class="row">
						<div class="col-lg-12 col-xs-6">
							<div class="small-box bg-red">
								<div class="inner">
								  <h3><?=$hefek;?>%</h3>

								  <p>Persentase Absen</p>
								</div>
								<div class="icon">
								  <i class="fa fa-bar-chart"></i>
								</div>
								
							 </div>
						</div>
						<div class="col-lg-4 col-xs-6">
							<div class="small-box bg-aqua">
								<div class="inner">
								  <h3><?=$sakit;?></h3>

								  <p>Sakit</p>
								</div>
								<div class="icon">
								  <i class="fa fa-users"></i>
								</div>
							 </div>
						</div>
						<div class="col-lg-4 col-xs-6">
							<div class="small-box bg-aqua">
								<div class="inner">
								  <h3><?=$ijin;?></h3>

								  <p>Ijin</p>
								</div>
								<div class="icon">
								  <i class="fa fa-users"></i>
								</div>
							 </div>
						</div>
						<div class="col-lg-4 col-xs-6">
							<div class="small-box bg-aqua">
								<div class="inner">
								  <h3><?=$alfa;?></h3>

								  <p>Tanpa Keterangan</p>
								</div>
								<div class="icon">
								  <i class="fa fa-users"></i>
								</div>
							 </div>
						</div>
					</div>