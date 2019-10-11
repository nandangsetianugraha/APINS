<?php 
include "../inc/lte-head.php";
$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$idpegs = mysqli_fetch_array(mysqli_query($koneksi, "select * from id_pegawai where ptk_id='$idku'"));
$idpeg=$idpegs['pegawai_id'];
$bln=isset($_GET['bln']) ? $_GET['bln'] : date("m");
$thn=isset($_GET['thn']) ? $_GET['thn'] : date("Y");
$absen = mysqli_query($koneksi, "SELECT pegawai_id,
DATE_FORMAT(tanggal,'%Y-%m-%d') tgl,
min(left(RIGHT(tanggal, 8), 5)) jam1,
MAX(left(right(tanggal, 8), 5)) jam2,
if(LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '07:00:00'))))>0,LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '07:00:00'))))/60,'') diff1, 
if(LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('16:00:00', MAX(left(right(tanggal, 8), 5))))))>0,LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('16:00:00', MAX(left(right(tanggal, 8), 5))))))/60,'') diff2
FROM absensi_ptk where pegawai_id='$idpeg' and DATE_FORMAT(tanggal,'%Y-%m-%d') like '$thn-%$bln-%' group by tgl");
$telat=0;
$cepat=0;
while($nk=mysqli_fetch_array($absen)){
	$telat=$telat+$nk['diff1'];
	$cepat=$cepat+$nk['diff2'];
};
?>
<body class="hold-transition skin-blue sidebar-mini">

    <!-- Main content -->
    <section class="content">
	<div class="row">
		<div class="col-lg-12 col-xs-12">
				
			<div class="box">
				<div class="box-header">
				  <h3 class="box-title">
							<form class="form" action="myabsen.php" method="GET" id="tabID">
								<div class="row">
								<div class="col-lg-6 col-xs-6">
										<div class="form-group">
											<select class="form-control" name="bln" onchange="this.form.submit()">
												<option value="07" <?php if($bln==="07"){echo "selected";}; ?>>Juli</option>
												<option value="08" <?php if($bln==="08"){echo "selected";}; ?>>Agustus</option>
												<option value="09" <?php if($bln==="09"){echo "selected";}; ?>>September</option>
												<option value="10" <?php if($bln==="10"){echo "selected";}; ?>>Oktober</option>
												<option value="11" <?php if($bln==="11"){echo "selected";}; ?>>November</option>
												<option value="12" <?php if($bln==="12"){echo "selected";}; ?>>Desember</option>
												<option value="01" <?php if($bln==="01"){echo "selected";}; ?>>Januari</option>
												<option value="02" <?php if($bln==="02"){echo "selected";}; ?>>Februari</option>
												<option value="03" <?php if($bln==="03"){echo "selected";}; ?>>Maret</option>
												<option value="04" <?php if($bln==="04"){echo "selected";}; ?>>April</option>
												<option value="05" <?php if($bln==="05"){echo "selected";}; ?>>Mei</option>
												<option value="06" <?php if($bln==="06"){echo "selected";}; ?>>Juni</option>
											</select>
										</div>
								</div>
								<div class="col-lg-6 col-xs-6">
										<div class="form-group">
											<select class="form-control" name="thn" onchange="this.form.submit()">
											<?php
											$now=date('Y');
											for ($a=2012;$a<=$now;$a++){
											?>
												<option value="<?=$a;?>" <?php if(($thn)==$a){echo "selected";}; ?>><?=$a;?> </option>
											<?php 
											}
											?>
											</select>
										</div>
								</div>
								</div>
							</form>
				  </h3>
				  <div class="box-tools pull-right">
				    <a href="../../cetak/cetakslipgaji.php?idpeg=<?=$idpeg;?>&bln=<?=$bln;?>&thn=<?=$thn;?>" title="Cetak Slip Gaji Bulan <?=$bulan[(int)$bln-1];?> <?=$thn;?>" class="btn" target="_blank">
						<i class="fa fa-print"></i> Cetak Slip Gaji
					</a>
				  </div>
				</div>
				<div class="box-body table-responsive">
					<div class="alert alert-success alert-dismissible">
					<i class="icon fa fa-check"></i> Data Absensi bulan <?=$bulan[(int)$bln];?> <?=$thn;?> diambil dari Finger Print<br/>
					Telat : <?=$telat;?> Menit<br/>
					Pulang Cepat : <?=$cepat;?> Menit
					</div>
					<table id="manageMemberTable" class="table table-bordered table-hover">
                        <thead>
                                           <tr>
												<th class="text-center">Tanggal</th>
												<th class="text-center">Absen Masuk</th>
												<th class="text-center">Absen Keluar</th>
												<th class="text-center">Telat (Menit)</th>
												<th class="text-center">Pulang Cepat (Menit)</th>
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
		$('#datepicker').datepicker({
		  autoclose: true
		});
		manageMemberTable = $("#manageMemberTable").DataTable({
			"ajax": "../modul/ptk/dataAbsen.php?idpeg=<?=$idpeg;?>&bln=<?=$bln;?>&thn=<?=$thn;?>",
			"paging":false,
			"order": []
		});
	});
</script>
</body>
</html>
