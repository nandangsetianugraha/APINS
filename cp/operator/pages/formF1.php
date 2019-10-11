<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
	$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
	$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
	$kelas=isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
	$tipe=isset($_GET['tipe']) ? $_GET['tipe'] : 'PAT';
?>
    

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				
			</div>
			<div class="col-lg-12 col-xs-12">
				
						<div class="box box-primary">
							<div class="box-header">
							  <h3 class="box-title">Cetak Form F1 dan F2 <?=$tipe;?> Tahun Pelajaran <?=$tapel;?></h3>
							  <div class="box-tools pull-right">
								<button type="button" class="btn"><i class="fa fa-print"></i> F2-<?=$tipe;?></button>
							  </div>
							</div>
							<div class="box-body table-responsive">
								<table class="table table-bordered table-hover">
					<thead>
													   <tr>
															<th>Kelas</th>
															<th>Form F1-<?=$tipe;?></th>
														</tr>
													</thead>
					<tbody>	
					<?php 
									$sql_mk=mysqli_query($koneksi, "select * from rombel where tapel='$tpl_aktif' order by nama_rombel asc");
									while($nk=mysqli_fetch_array($sql_mk)){
									?>
						<tr>
							<td>Kelas <?=$nk['nama_rombel'];?></td>
							<td><a href="../../cetak/form-f1.php?kelas=<?=$nk['nama_rombel'];?>&smt=<?=$smt;?>&tapel=<?=$tapel;?>&tipe=<?=$tipe;?>" class="btn"><i class="fa fa-print"></i> F1-<?=$tipe;?></a></td>
						</tr>
									<?php }; ?>
													
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

</body>
</html>
