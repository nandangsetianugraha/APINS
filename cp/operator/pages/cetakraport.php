<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 2;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
	$ab=substr($romb, 0, 1);
?>
	
    <!-- Main content -->
    <section class="content">
		
		<div class="row">
		
			
			<div class="col-lg-12 col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Cetak Raport Kelas <?=$romb;?></h3>
					  <div class="box-tools pull-right">
			
						<form class="form" action="cetakraport.php" method="GET">
							<div class="form-group">
								<select class="form-control" name="kelas" onchange="this.form.submit()">
								<?php 
								$sql_mk=mysqli_query($koneksi, "select * from rombel where tapel='$tapel' order by nama_rombel asc");
								while($nk=mysqli_fetch_array($sql_mk)){
								?>
								<option value="<?=$nk['nama_rombel'];?>" <?php if($nk['nama_rombel']==$romb){echo "selected";}; ?>>Kelas <?=$nk['nama_rombel'];?></option>
								<?php };?>
								</select>
							</div>
						</form>
					  </div>
					</div>
					<div class="box-body">
						<div class="loading-progress"></div>
						<table id="Raportku" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
									<th>Nama</th>
									<th></th>
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
			"ajax": "../modul/rekap/Scetak.php?kelas=<?=$romb;?>&tapel=<?=$tpl_aktif;?>&smt=<?=$smt;?>",
			"order": []
		});
	});
</script>
</body>
</html>
