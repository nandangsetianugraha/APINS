<?php 
include "../inc/lte-head.php";
$kelas="1A";
?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
<?php
function rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
};
$tgl=isset($_GET['tanggal']) ? $_GET['tanggal'] : date("d");
$bln=isset($_GET['bulan']) ? $_GET['bulan'] : date("m");
$thn=isset($_GET['tahun']) ? $_GET['tahun'] : date("Y");
$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$sekarang=$thn."-".$bln."-".$tgl;
$hari = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
$namahari = date('D', strtotime($sekarang));
	$dayList = array(
		'Sun' => 'Minggu',
		'Mon' => 'Senin',
		'Tue' => 'Selasa',
		'Wed' => 'Rabu',
		'Thu' => 'Kamis',
		'Fri' => 'Jumat',
		'Sat' => 'Sabtu'
	);
$query = mysqli_query($koneksi, "SELECT * FROM tabungan");
  $jumlah=mysqli_num_rows($query);
  $query1 = mysqli_query($koneksi, "SELECT sum(IF(kode='1',masuk,0)) as setoran FROM tabungan");
  $setor=mysqli_fetch_array($query1);
  $query2 = mysqli_query($koneksi, "SELECT sum(IF(kode='2',keluar,0)) as penarikan FROM tabungan");
  $ambil=mysqli_fetch_array($query2);
  $sisa=$setor['setoran']-$ambil['penarikan'];
?>
		<div class="row">
			<div class="col-lg-3 col-xs-12">
				<div class="info-box">
				  <span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>

				  <div class="info-box-content">
					<span class="info-box-text"><?=$dayList[$namahari];?></span>
					<span class="info-box-number"><?=TanggalIndo($sekarang);?></span>
				  </div>
				  <!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<div class="col-lg-3 col-xs-12">
				<div class="info-box">
				  <span class="info-box-icon bg-aqua"><i class="fa fa-copy"></i></span>

				  <div class="info-box-content">
					<span class="info-box-text"><?=$jumlah;?> Transaksi</span>
					<span class="info-box-number"><?=rupiah($sisa);?></span>
				  </div>
				  <!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<div class="col-lg-3 col-xs-12">
				<div class="info-box">
				  <span class="info-box-icon bg-blue"><i class="fa fa-money"></i></span>

				  <div class="info-box-content">
					<span class="info-box-text">Pemasukan</span>
					<span class="info-box-number"><?=rupiah($setor['setoran']);?></span>
				  </div>
				  <!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<div class="col-lg-3 col-xs-12">
				<div class="info-box">
				  <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

				  <div class="info-box-content">
					<span class="info-box-text">Pengambilan</span>
					<span class="info-box-number"><?=rupiah($ambil['penarikan']);?></span>
				  </div>
				  <!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			
		</div>

      <!-- Default box -->
	  <div class="row">
		<div class="col-lg-7 col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Grafik Tabungan Bulan  <?=$BulanIndo[(int)$bln-1];?> Tahun <?=$thn;?></h3>
				</div>
				<div class="box-body">
					<div id='stats'></div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<div class="col-lg-5 col-xs-12">
			<div class="box box-warning direct-chat direct-chat-warning">
				<div class="box-header with-border">
                  <h3 class="box-title">Detail Transaksi</h3>

                  <div class="box-tools pull-right">
					
                  </div>
                </div>
                <!-- /.box-header -->
				<div class="box-body">
					<table id="transaksi" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
									<th>Tanggal</th>
									<th>Masuk</th>
									<th>Keluar</th>
								</tr>
							</thead>
							<tbody>	
															
							</tbody>
						</table>
                  
				  </div>
				  
                <!-- /.box-footer-->
				</div>
				
			</div>
	
		
	  </div>
</section>
<!-- /.content -->

<?php include "../inc/lte-script.php";?>
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="highcharts.js"></script>
<script src="exporting.js"></script>
<script type="text/javascript">
Highcharts.chart('stats', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'SD Islam Al-Jannah'
    },
    
    xAxis: {
        categories: [
		<?php 
		$notgl="";
		for($j = 1; $j < $hari+1; $j++) {
				$notgl=$notgl . "," . $j;
			};
			$notgl = substr( $notgl , 1 , strlen( $notgl ) );
		?>
        <?=$notgl;?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rupiah'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">Tanggal {point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
			<?php 
			$disetor="";
			$diambil="";
			for($j = 1; $j < $hari+1; $j++) {
				
				$nowtgl=$thn."-".$bln."-".$j;
				$data1=mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(IF(kode='1',masuk,0)) as setoran, sum(IF(kode='2',keluar,0)) as penarikan FROM tabungan where tanggal='$nowtgl'"));
				if(empty($data1['setoran'])){
					$dbt=0;
				}else{
					$dbt=$data1['setoran'];
				}
				if(empty($data1['penarikan'])){
					$krd=0;
				}else{
					$krd=$data1['penarikan'];
				}
				$disetor=$disetor . "," . $dbt;
				$diambil=$diambil . "," . $krd;
			};
			$disetor = substr( $disetor , 1 , strlen( $disetor ) );
			$diambil = substr( $diambil , 1 , strlen( $diambil ) );
            ?>
	{
        name: 'Pemasukan',
        data: [<?=$disetor;?>]

    }, {
        name: 'Penarikan',
        data: [<?=$diambil;?>]

    }
	]
});
var nK3;
	$(document).ready(function() {
		nK3 = $("#transaksi").DataTable({
				"searching": false,
				"ajax": "../modul/tabungan/datatransaksi.php",
				"order": []
			});
	});
        </script>

</body>
</html>