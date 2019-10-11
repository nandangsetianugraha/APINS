<?php 
include "../inc/lte-head.php";
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
};
if(isset($_GET['tglbro'])){
		$tahun = substr($_GET['tglbro'], 6, 4);
		$bulan = substr($_GET['tglbro'], 0, 2);
		$tanggal   = substr($_GET['tglbro'], 3, 2);
		$tgl=$bulan."/".$tanggal."/".$tahun;
	}else{
		$tahun=isset($_GET['tahun']) ? $_GET['tahun'] : date("Y");
		$tanggal=isset($_GET['tgl']) ? $_GET['tgl'] : date("d");
		$bulan=isset($_GET['bulan']) ? $_GET['bulan'] : date("m");
		$tgl=$bulan."/".$tanggal."/".$tahun;
	};
$sekarang=$tahun."-".$bulan."-".$tanggal;
$hari = date('D', strtotime($sekarang));
	$dayList = array(
		'Sun' => 'Minggu',
		'Mon' => 'Senin',
		'Tue' => 'Selasa',
		'Wed' => 'Rabu',
		'Thu' => 'Kamis',
		'Fri' => 'Jumat',
		'Sat' => 'Sabtu'
	);
?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?=$bioku['nama'];?>
        <small>Selamat Datang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
<?php
$tgl=isset($_GET['tanggal']) ? $_GET['tanggal'] : date("d");
$bln=isset($_GET['bulan']) ? $_GET['bulan'] : date("m");
$thn=isset($_GET['tahun']) ? $_GET['tahun'] : date("Y");
$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$pds=$idku;
$idN=$bioku['nasabah_id'];
					$snama=mysqli_query($koneksi, "select *,SUM(IF(absensi='S',1,0)) AS sakit,SUM(IF(absensi='I',1,0)) AS ijin,SUM(IF(absensi='A',1,0)) AS alfa from absensi where tanggal LIKE '$thn-$bln-%' and peserta_didik_id='$pds'");
					$jab=mysqli_fetch_array($snama);
					if(empty($jab['sakit'])){
						$sakit=0;
					}else{
						$sakit=$jab['sakit'];
					};
					if(empty($jab['ijin'])){
						$ijin=0;
					}else{
						$ijin=$jab['ijin'];
					};
					if(empty($jab['alfa'])){
						$alfa=0;
					}else{
						$alfa=$jab['alfa'];
					};
					$nabung=mysqli_fetch_array(mysqli_query($koneksi, "select * from tabungan where nasabah_id='$idN' and tanggal='$sekarang'"));
					$nabunggak=mysqli_num_rows(mysqli_query($koneksi, "select * from tabungan where nasabah_id='$idN' and tanggal='$sekarang'"));
					$jns=$nabung['kode'];
					if($jns==1){
						$st=rupiah($nabung['masuk']);
						$info="Menabung";
					}else{
						$st=rupiah($nabung['keluar']);
						$info="Mengambil";
					}
					$jTabs=mysqli_fetch_array(mysqli_query($koneksi, "select sum(masuk) as setoran from tabungan where nasabah_id='$idN'"));
					$jTaba=mysqli_fetch_array(mysqli_query($koneksi, "select sum(keluar) as penarikan from tabungan where nasabah_id='$idN'"));
					$saldo=$jTabs['setoran']-$jTaba['penarikan'];
				
?>
				
		<div class="row">
			<div class="col-sm-6 col-xs-6">
                  <div class="description-block border-right">
                    <?php 
					if($nabunggak>0){
					if($jns==1){
					?>
					<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> <?=$info;?></span>
					<?php }else{ ?>
					<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> <?=$info;?></span>
					<?php }; ?>
                    <h5 class="description-header"><?=$st;?></h5>
					<?php }else{ ?>
					<span class="description-percentage text-yellow"><i class="fa fa-caret-down"></i> Hari ini</span>
					<h5 class="description-header">Tidak Menabung</h5>
					<?php }; ?>
                    <span class="description-text"><?=$dayList[$hari];?>, <?=TanggalIndo($sekarang);?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
				<div class="col-sm-6 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> Total Saldo</span>
                    <h5 class="description-header"><?=rupiah($saldo);?></h5>
                    <span class="description-text">SALDO TABUNGAN</span>
                  </div>
                  <!-- /.description-block -->
                </div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-red">
					<div class="inner">
					  <h3><?=$kelas;?></h3>

					  <p>Kelas</p>
					</div>
					<div class="icon">
					  <i class="fa fa-users"></i>
					</div>
					<a href="#" class="small-box-footer">
					   <i class="fa fa-arrow-circle-right"></i>
					</a>
				 </div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-aqua">
					<div class="inner">
					  <h3><?=$sakit;?></h3>

					  <p>Sakit</p>
					</div>
					<div class="icon">
					  <i class="fa fa-users"></i>
					</div>
					<a href="#" class="small-box-footer">
					  Absensi Bulan <?=$BulanIndo[(int)$bln-1];?> <i class="fa fa-arrow-circle-right"></i>
					</a>
				 </div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-green">
					<div class="inner">
					  <h3><?=$ijin;?></h3>

					  <p>Ijin</p>
					</div>
					<div class="icon">
					  <i class="fa fa-female"></i>
					</div>
					<a href="#" class="small-box-footer">
					  Absensi Bulan <?=$BulanIndo[(int)$bln-1];?> <i class="fa fa-arrow-circle-right"></i>
					</a>
				 </div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
					<div class="inner">
					  <h3><?=$alfa;?></h3>

					  <p>Alpha</p>
					</div>
					<div class="icon">
					  <i class="fa fa-male"></i>
					</div>
					<a href="#" class="small-box-footer">
					  Absensi Bulan <?=$BulanIndo[(int)$bln-1];?> <i class="fa fa-arrow-circle-right"></i>
					</a>
				 </div>
			</div>
		</div>

      <!-- Default box -->
	  <div class="row">
	  <?php 
	  $wk=mysqli_fetch_array(mysqli_query($koneksi, "select * from rombel where nama_rombel='$kelas' and tapel='$tpl_aktif'"));
	  $idwk=$wk['wali_kelas'];
	  $namawk=mysqli_fetch_array(mysqli_query($koneksi, "select * from ptk where ptk_id='$idwk'"));
		?>
		<div class="col-lg-6 col-xs-12">
		  <div class="box">
			<div class="box-header with-border">
			  <h3 class="box-title">INFORMASI</h3>
			</div>
			<div class="box-body">
				<p>Kelas : <?=$kelas;?><br/>
				Wali Kelas : <?=$namawk['nama'];?></p>
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		</div>
		<div class="col-lg-6 col-xs-12">
		  <div class="box">
			<div class="box-header with-border">
			  <h3 class="box-title">SD ISLAM AL-JANNAH</h3>
			</div>
			<div class="box-body table-responsive no-padding">
				<table class="table">
					<tr>
					  <td>NPSN</td>
					  <td>20258088</td>
					</tr>
					<tr>
					  <td>Bentuk Pendidikan</td>
					  <td>SD</td>
					</tr>
					<tr>
					  <td>Status</td>
					  <td>Swasta</td>
					</tr>
					<tr>
					  <td>Kecamatan</td>
					  <td>Kec. Gabuswetan</td>
					</tr>
					<tr>
					  <td>Kabupaten</td>
					  <td>Kab. Indramayu</td>
					</tr>
					<tr>
					  <td>Provinsi</td>
					  <td>Jawa Barat</td>
					</tr>
					<tr>
					  <td>Kepala Sekolah</td>
					  <td>Umar Ali</td>
					</tr>
					
				</table>
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		</div>
	  </div>
</section>
<!-- /.content -->

<?php include "../inc/lte-script.php";?>
</body>
</html>
