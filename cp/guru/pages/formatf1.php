<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
$romb = isset($_GET['kelas']) ? $_GET['kelas'] : $kelas;
$ab=substr($romb, 0, 1);
$jns=isset($_GET['jns']) ? $_GET['jns'] : 'PTS';
?>
	
    <!-- Main content -->
    <section class="content">
		<div class="box box-primary">
			<div class="box-body">
				<form role="form" action="formatf1.php" method="GET">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<div class="form-group">
							<select class="form-control" name="jns" onchange="this.form.submit()">
								<option value="PTS" <?php if($jns=='PTS'){echo "selected";}; ?>>Penilaian Tengah Semester</option>
								<option value="PAS" <?php if($jns=='PAS'){echo "selected";}; ?>>Penilaian Akhir Semester</option>
							</select>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="row">
		
			
			<div class="col-lg-12 col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Laporan Pencapaian Target Kurikulum, Ketuntasan Belajar Dan Daya Serap Kurikulum Sekolah Dasar Kelas <?=$romb;?></h3>
					  <?php if($jns=='pts'){
						  ?>
					  <a href="../../cetak/form-f1.php?kelas=<?=$romb;?>&smt=<?=$smt;?>&tapel=<?=$tapel;?>&tipe=PTS" class="btn btn-social btn-bitbucket" target="_blank">
							<i class="fa fa-print"></i> Cetak
						</a>
					  <?php }else{ ?>
					  <a href="../../cetak/form-f1.php?kelas=<?=$romb;?>&smt=<?=$smt;?>&tapel=<?=$tapel;?>&tipe=PAS" class="btn btn-social btn-bitbucket" target="_blank">
							<i class="fa fa-print"></i> Cetak
						</a>
					  <?php }; ?>
					</div>
					<div class="box-body">
						<div class="loading-progress"></div>
						<table id="Raportku" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
								<tr>
									<th rowspan="3" class="text-center">Mata Pelajaran</th>
									<th rowspan="3" class="text-center">Target Kurikulum (%)</th>
									<th colspan="3" class="text-center">Nilai</th>
									<th colspan="5" class="text-center">Ketuntasan</th>
									<th rowspan="3" class="text-center">Tarap Serap Kurikulum</th>
									<th rowspan="3" class="text-center">Ket</th>
								</tr>
								<tr>
									<th colspan="3" class="text-center"><?php if($jns=="PTS"){echo "PTS";}else{echo "PAS/PAT";}; ?></th>
									<th rowspan="2" class="text-center">KKM</th>
									<th rowspan="2" class="text-center">Jumlah Siswa</th>
									<th colspan="2" class="text-center">Nilai</th>
									<th rowspan="2" class="text-center">%</th>
								</tr>
								<tr>
									<th class="text-center">NTT</th>
									<th class="text-center">NTR</th>
									<th class="text-center">RT2</th>
									<th class="text-center">>=KKM</th>
									<th class="text-center"><KKM</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
	</section>
    <!-- /.content -->
<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
	var Raportku;
	$(document).ready(function() {
		Raportku = $("#Raportku").DataTable({
			"searching": false,
			"ajax": "../modul/rekap/f1.php?tapel=<?=$tapel;?>&smt=<?=$smt;?>&kelas=<?=$romb;?>&jns=<?=$jns;?>",
			"order": []
		});
	});
</script>
</body>
</html>