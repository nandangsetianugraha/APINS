<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
$romb = isset($_GET['kelas']) ? $_GET['kelas'] : $kelas;
$ab=substr($romb, 0, 1);
$jns=isset($_GET['jns']) ? $_GET['jns'] : 'k3';
?>
	
    <!-- Main content -->
    <section class="content">
		<div class="box box-primary">
			<div class="box-body">
				<form role="form" action="rekapraport.php" method="GET">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<div class="form-group">
							<select class="form-control" name="jns" onchange="this.form.submit()">
								<option value="k3" <?php if($jns=='k3'){echo "selected";}; ?>>Pengetahuan</option>
								<option value="k4" <?php if($jns=='k4'){echo "selected";}; ?>>Ketrampilan</option>
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
					  <h3 class="box-title">Rekapitulasi Raport <?php if($jns=='k3'){echo "Pengetahuan";}else{echo "Ketrampilan";}; ?> Kelas <?=$romb;?></h3>
					  <?php if($jns=='k3'){
						  ?>
					  <a href="../../cetak/rekapnilai.php?kelas=<?=$romb;?>&smt=<?=$smt;?>&tapel=<?=$tapel;?>" class="btn btn-social btn-bitbucket" target="_blank">
							<i class="fa fa-print"></i> Cetak
						</a>
					  <?php }else{ ?>
					  <a href="../../cetak/rekapnilaik.php?kelas=<?=$romb;?>&smt=<?=$smt;?>&tapel=<?=$tapel;?>" class="btn btn-social btn-bitbucket" target="_blank">
							<i class="fa fa-print"></i> Cetak
						</a>
					  <?php }; ?>
					</div>
					<div class="box-body">
						<div class="loading-progress"></div>
						<table id="Raportku" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
								<tr>
									<th class="text-center">Nama Siswa</th>
									<th class="text-center">PAI</th>
									<th class="text-center">PKn</th>
									<th class="text-center">BIN</th>
									<th class="text-center">MTK</th>
									<th class="text-center">IPA</th>
									<th class="text-center">IPS</th>
									<th class="text-center">SBK</th>
									<th class="text-center">PJK</th>
									<th class="text-center">BID</th>
									<th class="text-center">BIG</th>
									<th class="text-center">PBP</th>
									<th class="text-center">KOM</th>
									<th class="text-center">Jumlah</th>
									<th class="text-center">Rerata</th>
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
			"ajax": "../modul/rekap/rekapnilai.php?tapel=<?=$tapel;?>&smt=<?=$smt;?>&kelas=<?=$romb;?>&jns=<?=$jns;?>",
			"order": []
		});
	});
</script>
</body>
</html>
