<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
	$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
	$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
	$kelas=isset($_GET['kelas']) ? $_GET['kelas'] : $kelas;	
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
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$tanggal1 = $tahun."-".$bulan."-".$tanggal;
	$day = date('D', strtotime($tanggal1));
	$dayList = array(
		'Sun' => 'Minggu',
		'Mon' => 'Senin',
		'Tue' => 'Selasa',
		'Wed' => 'Rabu',
		'Thu' => 'Kamis',
		'Fri' => 'Jumat',
		'Sat' => 'Sabtu'
	);
?>
    <!-- Main content -->

    <section class="content">
	<?php 
if($level==98 or $level==97){
?>
		<div class="box box-primary">
			<div class="box-body">
				<div class="row">
					<div class="col-lg-2 col-xs-3">
						Pilih Tanggal
					</div>
					<div class="col-lg-6 col-xs-6">
						<form class="form-horizontal" action="absensi.php" method="GET">
							<div class="form-group">
								<div class="input-group date">
								  <div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								  </div>
								  <input type="text" class="form-control pull-right" autocomplete=off name="tglbro" id="datepicker" value="<?=$tgl;?>" onchange="this.form.submit()">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Absensi Kelas <?=$kelas;?></h3>
					  <div class="box-tools pull-right">
					  <?php if($dayList[$day]==="Sabtu" || $dayList[$day]==="Minggu"){ ?>
					  <?php }else{ ?>
						<button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#tambahAbsen" id="addAbsenModalBtn"><i class="fa fa-plus"></i> Absensi</button>
					  <?php }; ?>
					  </div>
					</div>
					<div class="box-body">
						<p>Hari : <?=$dayList[$day];?>, <?=$tanggal;?> <?=$BulanIndo[(int)$bulan-1];?> <?=$tahun;?></p>
						<?php if($dayList[$day]==="Sabtu" || $dayList[$day]==="Minggu"){ ?>
						<div class="callout callout-success">
							<h4>Hari <?=$dayList[$day];?> Tidak bisa Absen ya :-)</h4>
						</div>
						<?php }else{ ?>
						<table id="absenTable" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
									<th>Nama Siswa</th>
									<th>Absensi</th>
									<th></th>
								</tr>
							</thead>
							<tbody>	
															
							</tbody>
						</table>
						<?php }; ?>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-xs-12">
				<div class="row">
					<div class="col-lg-12 col-xs-12">
						<div class="box box-primary">
							<div class="box-header">
							  <h3 class="box-title">Cetak Daftar Hadir</h3>
							</div>
							<div class="box-body">
								<form class="form-horizontal" action="../../cetak/cetakabsen.php" target="_blank" method="GET" id="cetakabsenForm">	
									<div class="form-group">
										<div class="col-sm-5">
											<input type="hidden" id="kelas" name="kelas" class="form-control" value="<?php echo $kelas;?>">
											<input type="hidden" id="tapel" name="tapel" class="form-control" value="<?php echo $tapel;?>">
											<select class="form-control" name="bulanku">
												<option value="">==Pilih Bulan==</option>
												<option value="07" <?php if($bulan==="07"){echo "selected";}; ?>>Juli</option>
												<option value="08" <?php if($bulan==="08"){echo "selected";}; ?>>Agustus</option>
												<option value="09" <?php if($bulan==="09"){echo "selected";}; ?>>September</option>
												<option value="10" <?php if($bulan==="10"){echo "selected";}; ?>>Oktober</option>
												<option value="11" <?php if($bulan==="11"){echo "selected";}; ?>>November</option>
												<option value="12" <?php if($bulan==="12"){echo "selected";}; ?>>Desember</option>
												<option value="01" <?php if($bulan==="01"){echo "selected";}; ?>>Januari</option>
												<option value="02" <?php if($bulan==="02"){echo "selected";}; ?>>Februari</option>
												<option value="03" <?php if($bulan==="03"){echo "selected";}; ?>>Maret</option>
												<option value="04" <?php if($bulan==="04"){echo "selected";}; ?>>April</option>
												<option value="05" <?php if($bulan==="05"){echo "selected";}; ?>>Mei</option>
												<option value="06" <?php if($bulan==="06"){echo "selected";}; ?>>Juni</option>
											</select>
										</div>
										<div class="col-sm-4">
											<select class="form-control" name="tahunku">
												<option value="">==Pilih Tahun==</option>
												<option value="2018" <?php if($tahun==="2018"){echo "selected";}; ?>>2018</option>
												<option value="2019" <?php if($tahun==="2019"){echo "selected";}; ?>>2019</option>
												<option value="2020" <?php if($tahun==="2020"){echo "selected";}; ?>>2020</option>
												<option value="2021" <?php if($tahun==="2021"){echo "selected";}; ?>>2021</option>
												<option value="2022" <?php if($tahun==="2022"){echo "selected";}; ?>>2022</option>
												<option value="2023" <?php if($tahun==="2023"){echo "selected";}; ?>>2023</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-6 control-label">
											<input type="checkbox" name="prev"> Print Preview
										</label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-danger waves-effect waves-light">Cetak</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-xs-12">
						<div class="box box-primary">
							<div class="box-header">
							  <h3 class="box-title">Hari Efektif</h3>
							  <div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#tambahHari" id="addHariModalBtn"><i class="fa fa-plus"></i> Efektif</button>
							  </div>
							</div>
							<div class="box-body table-responsive">
								<table id="hariTable" class="table table-bordered table-hover">
									<thead>
									   <tr>
											<th>Bulan</th>
											<th>Hari Efektif</th>
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
			</div>
		</div>
	
	<!--Modal -->
		<div class="modal fade" id="tambahAbsen">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Absensi Siswa</h4>
              </div>
              <form class="form" action="../modul/siswa/tambahabsen.php" method="POST" id="createAbsenForm">
                        <div class="modal-body">
							<div class="form-group">
							  <label for="input-device">Kelas</label>
							  <input type="hidden" id="kelas" name="kelas" class="form-control" value="<?php echo $kelas;?>">
							  <p class="form-control-static">Kelas <?php echo $kelas;?></p>
							</div>
							<div class="form-group">
							  <label for="output-device">Tanggal</label>
							  <input type="hidden" id="tanggals" name="tanggals" class="form-control" value="<?=$tahun;?>-<?=$bulan;?>-<?=$tanggal;?>">
							  <p class="form-control-static"><?=$tanggal;?> <?=$BulanIndo[(int)$bulan-1];?> <?=$tahun;?></p>
							</div>
							<div class="form-group">
							  <span class="form-label">Nama Siswa</span>
							  <select class="form-control select2" name="pdid" style="width: 100%;">
								<option value="">==Pilih Siswa==</option>
								<?php 
								$sql2 = "select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
								$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
								while($po=mysqli_fetch_array($qu3)){;
									$idps=$po['peserta_didik_id'];
									$sql21 = "SELECT * FROM siswa WHERE peserta_didik_id='$idps'";
									$qu31 = mysqli_query($koneksi,$sql21) or die("database error:". mysqli_error($koneksi));
									$pj=mysqli_fetch_array($qu31);
								?>
									<option value="<?=$po['peserta_didik_id'];?>"><?=$pj['nama'];?></option>
								<?php };?>
							  </select>
							</div>
							<div class="form-group">
							  <span class="form-label">Absensi</span>
							  <select class="form-control" name="jnabsen">
									<option value="">==Pilih Absensi==</option>
									<option value="S">Sakit</option>
									<option value="I">Ijin</option>
									<option value="A">Alpa</option>
							  </select>
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Simpan</button>
                        </div>
						</form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		<div class="modal fade" id="tambahHari">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hari Efektif</h4>
              </div>
              <form class="form" action="../modul/siswa/tambahhari.php" method="POST" id="createHariForm">
                        <div class="modal-body">
							<div class="form-group">
							  <label for="output-device">Bulan</label>
							  <select class="form-control" name="blne">
									<option value="">==Pilih Bulan==</option>
									<option value="07">Juli</option>
									<option value="08">Agustus</option>
									<option value="09">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
									<option value="01">Januari</option>
									<option value="02">Februari</option>
									<option value="03">Maret</option>
									<option value="04">April</option>
									<option value="05">Mei</option>
									<option value="06">Juni</option>
							  </select>
							</div>
							<div class="form-group">
							  <label for="output-device">Tahun Pelajaran</label>
							  <select class="form-control" name="thne">
									<option value="">==Pilih Tahun Pelajaran==</option>
									<option value="2016/2017">2016/2017</option>
									<option value="2017/2018">2017/2018</option>
									<option value="2018/2019">2018/2019</option>
									<option value="2019/2020">2019/2020</option>
									<option value="2020/2021">2020/2021</option>
									<option value="2021/2022">2021/2022</option>
									<option value="2022/2023">2022/2023</option>
							  </select>
							</div>
							<div class="form-group">
							  <span class="form-label">Jumlah Hari Efektif</span>
							  <input type="text" id="harie" name="harie" autocomplete=off class="form-control">
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Simpan</button>
                        </div>
						</form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<!--Delete Tema-->
		<div class="modal fade" id="removeAbsenModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus</h4>
              </div>
                        <div class="modal-body">
							<p>Hapus Absensi Siswa ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light" id="removeBtn">Ya</button>
                        </div>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<?php 
}else{
?>
<div class="error-page">
			<div class="error-content text-center" style="margin-left: 0;">
				<h3><i class="fa fa-info-circle text-primary"></i> Informasi </h3>
				<p>Halaman tidak dapat diakses<br>Silahkan hubungi Administrator</p>
			</div>
		</div>
<?php 
};
?>		
    </section>
    <!-- /.content -->
<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script>
	
	var absenTable;
	var hariTable;
	$(document).ready(function() {
		absenTable = $('#absenTable').DataTable( {
			"searching": false,
			"ajax": "../modul/siswa/absensiku.php?kelas=<?=$kelas;?>&tgl=<?=$tgl;?>&tapel=<?=$tapel;?>",
			"order": []
		} );
		hariTable = $('#hariTable').DataTable( {
			"searching": false,
			"ajax": "../modul/siswa/efektif.php?tapel=<?=$tapel;?>",
			"order": []
		} );
		$('#datepicker').datepicker({
		  autoclose: true
		})
		$('.select2').select2()
		$("#addAbsenModalBtn").on('click', function() {
			// reset the form 
			$("#createAbsenForm")[0].reset();
			
			// submit form
			$("#createAbsenForm").unbind('submit').bind('submit', function() {

				$(".text-danger").remove();

				var form = $(this);

				

					//submi the form to server
					$.ajax({
						url : form.attr('action'),
						type : form.attr('method'),
						data : form.serialize(),
						dataType : 'json',
						success:function(response) {

							// remove the error 
							$(".form-group").removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								$.amaran({
									'theme'     :'awesome ok',
									'content'   :{
										title:'Sukses!',
										message:response.messages,
										info:'',
										icon:'fa fa-check-square-o'
									},
									'position'  :'bottom right',
									'outEffect' :'slideBottom'
								});

								// reset the form
								$("#tambahAbsen").modal('hide');

								// reload the datatables
								absenTable.ajax.reload(null, false);
								$("#createAbsenForm")[0].reset();
								// this function is built in function of datatables;

							} else {
								$.amaran({
									'theme'     :'awesome ok',
									'content'   :{
										title:'Error!',
										message:response.messages,
										info:'',
										icon:'fa fa-check-square-o'
									},
									'position'  :'bottom right',
									'outEffect' :'slideBottom'
								});
							}  // /else
						} // success  
					}); // ajax subit 				
				


				return false;
			}); // /submit form for create member
		}); // /add modal
		
		$("#addHariModalBtn").on('click', function() {
			// reset the form 
			$("#createHariForm")[0].reset();
			
			// submit form
			$("#createHariForm").unbind('submit').bind('submit', function() {

				$(".text-danger").remove();

				var form = $(this);

				

					//submi the form to server
					$.ajax({
						url : form.attr('action'),
						type : form.attr('method'),
						data : form.serialize(),
						dataType : 'json',
						success:function(response) {

							// remove the error 
							$(".form-group").removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								Swal.fire({
										  position: 'center',
										  type: 'error',
										  title: response.messages,
										  showConfirmButton: false,
										  timer: 1500
										});

								// reset the form
								$("#tambahHari").modal('hide');

								// reload the datatables
								hariTable.ajax.reload(null, false);
								$("#createHariForm")[0].reset();
								// this function is built in function of datatables;

							} else {
								Swal.fire({
										  position: 'center',
										  type: 'error',
										  title: response.messages,
										  showConfirmButton: false,
										  timer: 1500
										});
							}  // /else
						} // success  
					}); // ajax subit 				
				


				return false;
			}); // /submit form for create member
		}); // /add modal

	});

	function removeAbsen(id = null) {
		if(id) {
			// click on remove button
			$("#removeBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/siswa/hapusabsen.php',
					type: 'post',
					data: {member_id : id},
					dataType: 'json',
					success:function(response) {
						if(response.success == true) {						
							Swal.fire({
										  position: 'center',
										  type: 'error',
										  title: response.messages,
										  showConfirmButton: false,
										  timer: 1500
										});

							// refresh the table
							absenTable.ajax.reload(null, false);

							// close the modal
							$("#removeAbsenModal").modal('hide');

						} else {
							Swal.fire({
										  position: 'center',
										  type: 'error',
										  title: response.messages,
										  showConfirmButton: false,
										  timer: 1500
										});
						}
					}
				});
			}); // click remove btn
		} else {
			alert('Error: Refresh the page again');
		}
	}
	function removeHari(id = null) {
		if(id) {
			// click on remove button
			$("#removeBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/siswa/hapushari.php',
					type: 'post',
					data: {member_id : id},
					dataType: 'json',
					success:function(response) {
						if(response.success == true) {						
							Swal.fire({
										  position: 'center',
										  type: 'error',
										  title: response.messages,
										  showConfirmButton: false,
										  timer: 1500
										});

							// refresh the table
							hariTable.ajax.reload(null, false);

							// close the modal
							$("#removeHariModal").modal('hide');

						} else {
							Swal.fire({
										  position: 'center',
										  type: 'error',
										  title: response.messages,
										  showConfirmButton: false,
										  timer: 1500
										});
						}
					}
				});
			}); // click remove btn
		} else {
			alert('Error: Refresh the page again');
		}
	}
</script>
</body>
</html>
