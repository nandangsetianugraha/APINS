<?php include "../inc/lte-head.php";?>
<?php
	$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
	$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
	$bulan=isset($_GET['bulan']) ? $_GET['bulan'] : date("m");
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>
</head>
<body class="hold-transition skin-blue sidebar-mini">    

    <!-- Main content -->
    <section class="content">
			<form role="form" action="../pages/raport.php" method="GET">
				<div class="row">
					<div class="col-lg-3 col-xs-6">
						<div class="form-group">
							<select class="form-control" name="tapel" onchange="this.form.submit()">
							<?php 
							$sql2 = "select * from tapel";
							$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
							while($po=mysqli_fetch_array($qu3)){;
							?>
								<option value="<?=$po['nama_tapel'];?>" <?php if($po['nama_tapel']==$tapel){echo "selected";}; ?>>Tahun Pelajaran <?=$po['nama_tapel'];?></option>
							<?php };?>
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-xs-6">
						<div class="form-group">
							<select class="form-control" name="smt" onchange="this.form.submit()">
								<option value="1" <?php if($smt==1){echo "selected";}; ?>>Semester 1</option>
								<option value="2" <?php if($smt==2){echo "selected";}; ?>>Semester 2</option>
							</select>
						</div>
					</div>
				</div>
			</form>
		<?php 
		$rk1=mysqli_fetch_array(mysqli_query($koneksi, "select * from deskripsi_k13 where id_pd='$idku' and smt='$smt' and tapel='$tapel' and jns='k1'"));
		$rk2=mysqli_fetch_array(mysqli_query($koneksi, "select * from deskripsi_k13 where id_pd='$idku' and smt='$smt' and tapel='$tapel' and jns='k2'"));
		?>
		<!--Nilai Sikap-->
		<table class="table table-bordered table-responsive">
			<tr>
				<td style="width: 150px">Sikap Spiritual</td>
				<td><?=$rk1['deskripsi'];?></td>
			</tr>
			<tr>
				<td style="width: 150px">Sikap Sosial</td>
				<td><?=$rk2['deskripsi'];?></td>
			</tr>
		</table>
		<!--Nilai Raport-->
		<div class="table-responsive no-padding">
			<table class="table table-bordered">
				<tr>
					<th style="width: 10px" rowspan="2">No</th>
					<th rowspan="2">Muatan Pelajaran</th>
					<th colspan="3">Pengetahuan</th>
					<th colspan="3">Ketrampilan</th>
				</tr>
				<tr>
					<th>Nilai</th>
					<th>Predikat</th>
					<th>Deskripsi</th>
					<th>Nilai</th>
					<th>Predikat</th>
					<th>Deskripsi</th>
				</tr>
				<?php 
				$sql2 = "select * from mapel";
				$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
				$nomor=0;
				while($po=mysqli_fetch_array($qu3)){
					$mpid=$po['id_mapel'];
					$nomor++;
					$rk3=mysqli_fetch_array(mysqli_query($koneksi, "select * from raport_k13 where id_pd='$idku' and smt='$smt' and tapel='$tapel' and mapel='$mpid' and jns='k3'"));
					$ck1=mysqli_num_rows(mysqli_query($koneksi, "select * from raport_k13 where id_pd='$idku' and smt='$smt' and tapel='$tapel' and mapel='$mpid' and jns='k3'"));
					if($ck1>0){
						$nilai=$rk3['nilai'];
					}else{
						$rktsp=mysqli_fetch_array(mysqli_query($koneksi, "select * from raport where id_pd='$idku' and smt='$smt' and tapel='$tapel' and mapel='$mpid'"));
						$nilai=$rktsp['nilai'];
					}
					$rk4=mysqli_fetch_array(mysqli_query($koneksi, "select * from raport_k13 where id_pd='$idku' and smt='$smt' and tapel='$tapel' and mapel='$mpid' and jns='k4'"));
				?>
				<tr>
					<td><?=$nomor;?></td>
					<td><?=$po['nama_mapel'];?></td>
					<td><?=$nilai;?></td>
					<td><?=$rk3['predikat'];?></td>
					<td><?=$rk3['deskripsi'];?></td>
					<td><?=$rk4['nilai'];?></td>
					<td><?=$rk4['predikat'];?></td>
					<td><?=$rk4['deskripsi'];?></td>
				</tr>
				<?php }; ?>
				
			</table>
		</div>
    </section>
    <!-- /.content -->

<?php include "../inc/lte-script.php";?>

</body>
</html>
