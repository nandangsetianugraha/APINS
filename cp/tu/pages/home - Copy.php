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
		<div class="col-lg-8 col-xs-12">
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
		<div class="col-lg-4 col-xs-12">
			<div class="box box-warning direct-chat direct-chat-warning">
				<div class="box-header with-border">
                  <h3 class="box-title">Pesan Masuk</h3>

                  <div class="box-tools pull-right">
					<?php 
						$pesan_baru=mysqli_query($koneksi, "SELECT * FROM pesan WHERE id_penerima='$idku' and sudah_dibaca=0");
						$jumlah_pesan_baru=mysqli_num_rows($pesan_baru);
						if($jumlah_pesan_baru>0){
					?>
					<span data-toggle="tooltip" title="<?=$jumlah_pesan_baru;?> Pesan baru" class="badge bg-red"><a href="pesan.php?id=<?=$idku;?>"><?=$jumlah_pesan_baru;?></a></span>
					<?php
						}else{

					?>
                    <span data-toggle="tooltip" title="Tidak ada Pesan baru" class="badge bg-red"><a href="pesan.php?id=<?=$idku;?>">0</a></span>
						<?php } ?>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts"
                            data-widget="chat-pane-toggle">
                      <i class="fa fa-comments"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
				<div class="box-body">
					<!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">
					<?php
								$query_daftar_pesan = mysqli_query($koneksi, "SELECT P.*, M.user_id, M.nama FROM pesan P, nasabah M WHERE P.id_pengirim=M.user_id AND P.id_penerima='$idku' ORDER BY P.id_pesan DESC limit 5");
								while ($daftar_pesan=mysqli_fetch_array($query_daftar_pesan)) {
									
							?>
					<div class="direct-chat-msg <?php if($daftar_pesan['sudah_dibaca']==0){ echo "right";};?>">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name <?php if($daftar_pesan['sudah_dibaca']==0){ echo "pull-right";}else{echo "pull-left";};?>"><?=$daftar_pesan['nama'];?></span>
                        <span class="direct-chat-timestamp <?php if($daftar_pesan['sudah_dibaca']==0){ echo "pull-left";}else{echo "pull-right";};?>"><?=TanggalIndo($daftar_pesan['tanggal']);?></span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <a href="read-mail.php?id=<?=$daftar_pesan['id_pesan'];?>"><img class="direct-chat-img" src="../../../images/user-default.png" alt="message user image"></a>
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        Perihal : <br/><?=$daftar_pesan['judul_pesan'];?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->
								<?php } ?>
					
					
                    </div>
                    <!-- /.direct-chat-msg -->
				  </div>
				  
                <!-- /.box-footer-->
				</div>
				
			</div>
	
		
	  </div>
</section>
<!-- /.content -->

<?php include "../inc/lte-script.php";?>
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

        </script>

</body>
</html>
