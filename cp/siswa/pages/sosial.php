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
		<div class="row">
					<div class="col-lg-9 col-xs-12">
						<div class="box box-danger">
							<div class="box-header">
							  <h3 class="box-title">Pengamatan Sikap Sosial</h3>
							</div>
							<div class="box-body">
								<table id="nilaiHarian" class="table table-bordered table-hover">
									<thead>
									   <tr>
											<th>Catatan Perilaku</th>
											<th>Butir Sikap</th>
											<th>Nilai</th>
										</tr>
									</thead>
									<tbody>	
										
																	
									</tbody>
								</table>
							</div>
							<!-- /.box-body -->
							<!-- Loading (remove the following to stop the loading)-->
							
							<!-- end loading -->
						</div>
						  <!-- /.box -->
					</div>
					<div class="col-lg-3 col-xs-12">
						<div class="box box-danger">
						<div class="box-header">
						  <h3 class="box-title">Keterangan</h3>
						</div>
						<div class="box-body">
						  SB : Sangat Baik<br/>
						  PB : Perlu Bimbingan
						</div>
						<!-- /.box-body -->
						<!-- Loading (remove the following to stop the loading)-->
						
						<!-- end loading -->
					  </div>
					  <!-- /.box -->
					</div>
				</div>
    </section>
    <!-- /.content -->

<?php include "../inc/lte-script.php";?>
<script>
	
	var nilaiHarian;
	$(document).ready(function() {
		nilaiHarian = $('#nilaiHarian').DataTable( {
			"searching": false,
			"ajax": "../modul/dataSos.php?kelas=<?=$ab;?>&tapel=<?=$tapel;?>&smt=<?=$smt;?>&pdid=<?=$idku;?>",
			"order": []
		} );
	});
</script>
</body>
</html>
