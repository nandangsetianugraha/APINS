<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Main content -->
<section class="content">
<?php
$tgl=isset($_GET['tanggal']) ? $_GET['tanggal'] : date("d");
$bln=isset($_GET['bulan']) ? $_GET['bulan'] : date("m");
$thn=isset($_GET['tahun']) ? $_GET['tahun'] : date("Y");
$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
if($level==98 or $level==97){
				$sq2=mysqli_query($koneksi, "select * from penempatan JOIN siswa USING(peserta_didik_id) where siswa.jk='L' and penempatan.rombel='$kelas' and penempatan.tapel='$tpl_aktif'");
				$sq3=mysqli_query($koneksi, "select * from penempatan JOIN siswa USING(peserta_didik_id) where siswa.jk='P' and penempatan.rombel='$kelas' and penempatan.tapel='$tpl_aktif'");
				$juml=mysqli_num_rows($sq2);
				$jump=mysqli_num_rows($sq3);
				$jtot=mysqli_query($koneksi, "select * from siswa where status=1");
				$jjum=mysqli_num_rows($jtot);
				$jper=mysqli_query($koneksi, "select * from siswa where jk='P' and status=1");
				$jjper=mysqli_num_rows($jper);
				$jlak=mysqli_query($koneksi, "select * from siswa where jk='L' and status=1");
				$jjlak=mysqli_num_rows($jlak);
				
				$total=$juml+$jump;
				if($total>0){
					$perlak=($juml/$total)*100;
					$perper=($jump/$total)*100;
				}else{
					$perlak=0;
					$perper=0;
				};
				
				$sabsen=mysqli_query($koneksi, "select * from penempatan where rombel='$kelas' and tapel='$tpl_aktif'");
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
				$hef=mysqli_query($koneksi,"select * from hari_efektif where bulan='$bln' and tapel='$tpl_aktif'");
				$efek=mysqli_fetch_array($hef);
				if($efek['hari']==0){
					$harim=23;
				}else{
					$harim=$efek['hari'];
				};
				$hefek=round(($jkeh*100)/($harim*$total),2);
				
				}else{
				$sqlsisw = mysqli_query($koneksi, "siswa where status=1");
				$sq2=mysqli_query($koneksi, "select * from siswa where status=1 and jk='L'");
				$sq3=mysqli_query($koneksi, "select * from siswa where status=1 and jk='P'");
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
				};
?>
			<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i> Versi <?=$versi;?></h4>
			</div>
				<?php if($level==98 or $level==97){ ?>
				
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
			  <div class="info-box bg-aqua">
				<span class="info-box-icon"><i class="fa fa-university"></i></span>

				<div class="info-box-content">
				  <span class="info-box-text">Rombel</span>
				  <span class="info-box-number"><?=$kelas;?></span>

				  <div class="progress">
					<div class="progress-bar" style="width: 9%"></div>
				  </div>
					  <span class="progress-description">
						12 Rombel
					  </span>
				</div>
				<!-- /.info-box-content -->
			  </div>
			  <!-- /.info-box -->
			</div>
			<!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
			  <div class="info-box bg-aqua">
				<span class="info-box-icon"><i class="fa fa-users"></i></span>

				<div class="info-box-content">
				  <span class="info-box-text">Jumlah Siswa</span>
				  <span class="info-box-number"><?=$total;?></span>

				  <div class="progress">
					<div class="progress-bar" style="width: <?=($total/$jjum)*100;?>%"></div>
				  </div>
					  <span class="progress-description">
						dari <?=$jjum;?> Siswa
					  </span>
				</div>
				<!-- /.info-box-content -->
			  </div>
			  <!-- /.info-box -->
			</div>
			<!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
			  <div class="info-box bg-aqua">
				<span class="info-box-icon"><i class="fa fa-male"></i></span>

				<div class="info-box-content">
				  <span class="info-box-text">Laki-laki</span>
				  <span class="info-box-number"><?=$juml;?></span>

				  <div class="progress">
					<div class="progress-bar" style="width: <?=($juml/$jjlak)*100;?>%"></div>
				  </div>
					  <span class="progress-description">
						dari <?=$jjlak;?> Siswa
					  </span>
				</div>
				<!-- /.info-box-content -->
			  </div>
			  <!-- /.info-box -->
			</div>
			<!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
			  <div class="info-box bg-aqua">
				<span class="info-box-icon"><i class="fa fa-female"></i></span>

				<div class="info-box-content">
				  <span class="info-box-text">Perempuan</span>
				  <span class="info-box-number"><?=$jump;?></span>

				  <div class="progress">
					<div class="progress-bar" style="width: <?=($jump/$jjper)*100;?>%"></div>
				  </div>
					  <span class="progress-description">
						dari <?=$jjper;?> Siswa
					  </span>
				</div>
				<!-- /.info-box-content -->
			  </div>
			  <!-- /.info-box -->
			</div>
			<!-- /.col -->
			
			
		</div>
		<?php }; ?>

      <!-- Default box -->
	  <div class="row">
	  <?php if($level==98 or $level==97){ ?>
		<div class="col-lg-6 col-xs-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Data Absensi</h3>
					<div class="box-tools pull-right">
						<div class="form-group">
							<div class="col-sm-5">
								<select class="form-control" id="bulan" name="bulan">
									<option value="">==Pilih Bulan==</option>
									<option value="07" <?php if($bln==="07"){echo "selected";}; ?>>Juli</option>
									<option value="08" <?php if($bln==="08"){echo "selected";}; ?>>Agustus</option>
									<option value="09" <?php if($bln==="09"){echo "selected";}; ?>>September</option>
									<option value="10" <?php if($bln==="10"){echo "selected";}; ?>>Oktober</option>
									<option value="11" <?php if($bln==="11"){echo "selected";}; ?>>November</option>
									<option value="12" <?php if($bln==="12"){echo "selected";}; ?>>Desember</option>
									<option value="01" <?php if($bln==="01"){echo "selected";}; ?>>Januari</option>
									<option value="02" <?php if($bln==="02"){echo "selected";}; ?>>Februari</option>
									<option value="03" <?php if($bln==="03"){echo "selected";}; ?>>Maret</option>
									<option value="04" <?php if($bln==="04"){echo "selected";}; ?>>April</option>
									<option value="05" <?php if($bln==="05"){echo "selected";}; ?>>Mei</option>
									<option value="06" <?php if($bln==="06"){echo "selected";}; ?>>Juni</option>
								</select>
							</div>
							<div class="col-sm-4">
								<select class="form-control" id="tahun" name="tahun">
									<option value="">==Pilih Tahun==</option>
									<option value="2018" <?php if($thn==="2018"){echo "selected";}; ?>>2018</option>
									<option value="2019" <?php if($thn==="2019"){echo "selected";}; ?>>2019</option>
									<option value="2020" <?php if($thn==="2020"){echo "selected";}; ?>>2020</option>
									<option value="2021" <?php if($thn==="2021"){echo "selected";}; ?>>2021</option>
									<option value="2022" <?php if($thn==="2022"){echo "selected";}; ?>>2022</option>
									<option value="2023" <?php if($thn==="2023"){echo "selected";}; ?>>2023</option>
									<option value="2024" <?php if($thn==="2024"){echo "selected";}; ?>>2024</option>
									<option value="2025" <?php if($thn==="2025"){echo "selected";}; ?>>2025</option>
									<option value="2026" <?php if($thn==="2026"){echo "selected";}; ?>>2026</option>
								</select>
								<input type="hidden" id="tapel" value="<?=$tpl_aktif;?>">
							</div>
						</div>
					</div>
				</div>
				<div class="box-body">
					<div id="dataAbsen"></div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	  <?php }else{ ?>
		<div class="col-lg-6 col-xs-12">
		  <div class="box">
			<div class="box-header with-border">
			  <h3 class="box-title">INFORMASI</h3>
			</div>
			<div class="box-body">
				<p>Masih Tahap Pengembangan untuk Guru Mata Pelajaran</p>
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		</div>
	  <?php }; ?>
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
<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
		viewTr();
		function viewTr(){
				$.get("dataAbsen.php?bulan=<?=$bln;?>&tahun=<?=$thn;?>&tapel=<?=$tpl_aktif;?>", function(data) {
					$("#dataAbsen").html(data);
				});
		};
		$('#bulan').change(function(){
			//Mengambil value dari option select mp kemudian parameternya dikirim menggunakan ajax
			var bulan = $('#bulan').val();
			var tahun=$('#tahun').val();
			var tapel=$('#tapel').val();
			
			$.ajax({
				type : 'GET',
				url : 'dataAbsen.php',
				data :  'bulan=' + bulan+'&tahun='+tahun+'&tapel='+tapel,
				beforeSend: function()
				{	
					$("#dataAbsen").html('<center><img src="facebook-1.gif"><br/>Memuat Data Absensi</center>');
				},
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#dataAbsen").html(data);
				}
			});
		});
		$('#tahun').change(function(){
			//Mengambil value dari option select mp kemudian parameternya dikirim menggunakan ajax
			var bulan = $('#bulan').val();
			var tahun=$('#tahun').val();
			var tapel=$('#tapel').val();
			
			$.ajax({
				type : 'GET',
				url : 'dataAbsen.php',
				data :  'bulan=' + bulan+'&tahun='+tahun+'&tapel='+tapel,
				beforeSend: function()
				{	
					$("#dataAbsen").html('<center><img src="facebook-1.gif"><br/>Memuat Data Absensi</center>');
				},
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#dataAbsen").html(data);
				}
			});
		});
	});
</script>
</body>
</html>
