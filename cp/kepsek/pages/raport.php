<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Main content -->
<section class="content">

				<?php if($level==98 or $level==97){ ?>
				
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
			  <div class="info-box bg-aqua">
				<span class="info-box-icon"><i class="fa fa-university"></i></span>

				<div class="info-box-content">
				  <span class="info-box-text">Generate</span>
				  <span class="info-box-number">Sikap Sosial</span>

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
				  <h3 class="box-title">Data Absensi Bulan <?=$BulanIndo[(int)$bln-1];?></h3>
				</div>
				<div class="box-body">
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
</body>
</html>
