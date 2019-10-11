<?php 
include "../inc/lte-head.php";
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
$idN=$bioku['nasabah_id'];
?>
<body class="hold-transition skin-blue sidebar-mini">

    <!-- Main content -->
    <section class="content">
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<div class="box">
				<div class="box-header">
				  <h3 class="box-title">Tabungan <?=$dayList[$hari];?>, <?=TanggalIndo($sekarang);?></h3>
				  <div class="box-tools pull-right">
				  </div>
				</div>
				<div class="box-body table-responsive">
					<table id="manageMemberTable" class="table table-bordered table-hover">
                        <thead>
                                           <tr>
												<th class="text-center">Tanggal</th>
												<th class="text-center">Kode</th>
												<th class="text-center">Setor</th>
												<th class="text-center">Ambil</th>
												<th class="text-center">Saldo</th>
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

	var manageMemberTable;
	$(document).ready(function() {
		manageMemberTable = $("#manageMemberTable").DataTable({
			"searching" : false,
			"paging": false,
			"ajax": "../modul/tabhariini.php?idN=<?=$idN;?>",
			"order": []
		});
	});
	
</script>
</body>
</html>
