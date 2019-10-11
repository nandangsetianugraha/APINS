<?php 
include "../inc/lte-head.php";
$id_mail=isset($_GET['id']) ? $_GET['id'] : 0;
?>
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
						$pesan_baru=mysqli_query($koneksi, "SELECT * FROM pesan WHERE id_penerima='$idku' and sudah_dibaca=0");
						$jumlah_pesan_baru=mysqli_num_rows($pesan_baru);
						

?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Content Header (Page header) -->
	<section class="content-header">
      <h1>
        Baca Surat
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Baca Surat</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">

	
	<div class="row">
		<div class="col-md-3">
			<div class="box box-solid">
				<div class="box-header with-border">
				  <h3 class="box-title">Folders</h3>
					
				  <div class="box-tools">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				  </div>
				</div>
				<div class="box-body no-padding">
				  <ul class="nav nav-pills nav-stacked">
					<li><a href="pesan.php?id=<?=$idku;?>"><i class="fa fa-inbox"></i> Pesan Masuk
					  <?php if($jumlah_pesan_baru>0){ ?><span class="label label-primary pull-right"><?=$jumlah_pesan_baru;?></span></a></li><?php };?>
					<li><a href="home.php"><i class="fa fa-trash-o"></i> Kembali</a></li>
				  </ul>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
		<div class="col-md-9">
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Pesan Masuk</h3>

				  <div class="box-tools pull-right">
					<div class="has-feedback">
					  <input type="text" class="form-control input-sm" placeholder="Search Mail">
					  <span class="glyphicon glyphicon-search form-control-feedback"></span>
					</div>
				  </div>
				  <!-- /.box-tools -->
				</div>
				<div class="box-body no-padding">
					<div class="mailbox-controls">
						<!-- Check all button -->
						<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
						</button>
						<div class="btn-group">
						  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
						  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
						  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
						</div>
						<!-- /.btn-group -->
						<button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Balas</button>
						<div class="pull-right">
						  
						</div>
						<!-- /.pull-right -->
					</div>
					<?php 
					$query_buka_pesan = mysqli_query($koneksi, "SELECT P.*, M.user_id, M.nama FROM pesan P, nasabah M WHERE id_pesan = $id_mail AND P.id_pengirim=M.user_id");
					$buka_pesan=mysqli_fetch_array($query_buka_pesan);
					$sudah_dibaca = mysqli_query($koneksi, "UPDATE pesan SET sudah_dibaca=1 WHERE id_pesan=$id_mail");
					?>
					<div class="mailbox-read-info">
						<h3></h3>
						<h5>dari: <?=$buka_pesan['nama'];?>
						  <span class="mailbox-read-time pull-right"><?=TanggalIndo($buka_pesan['tanggal']);?></span></h5>
					  </div>
					<!-- /.mailbox-controls -->
					<div class="mailbox-read-message">
						<?=$buka_pesan['isi_pesan'];?>
					</div>
					
					</div>
				</div>
			</div>
		</div>
	</div>
	  
</section>
<!-- /.content -->

<?php include "../inc/lte-script.php";?>
<script src="../../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>
</body>
</html>
