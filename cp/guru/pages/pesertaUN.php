<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
	$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
	$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
	$kelas=isset($_GET['kelas']) ? $_GET['kelas'] : '6A';	
	$mpid=isset($_GET['mp']) ? $_GET['mp'] : '1';
?>
    

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				
						<div class="box box-primary">
							<div class="box-header">
							  <h3 class="box-title">Daftar Peserta US/M Tahun Pelajaran <?=$tapel;?></h3>
							  <div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#tambahAbsen" id="addAbsenModalBtn" data-backdrop="false"><i class="fa fa-plus"></i> Peserta US/M</button>
							  </div>
							</div>
							<div class="box-body table-responsive">
								<table id="pesertaUN" class="table table-bordered table-hover">
					<thead>
													   <tr>
															<th>Nomor Peserta</th>
															<th>NIS</th>
															<th>NISN</th>
															<th>Nama Peserta</th>
															<th>Tempat Tanggal Lahir</th>
															<th>Nama Ayah</th>
															<th>Nama Ibu</th>
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
  
  <div class="modal fade" id="tambahAbsen">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Peserta US/M</h4>
              </div>
              <form class="form" action="../modul/usbn/tambahpeserta.php" method="POST" id="createAbsenForm">
                        <div class="modal-body">
							<div class="form-group">
							  <span class="form-label">Nama Siswa</span>
							  <input type="hidden" id="tapel" name="tapel" class="form-control" value="<?php echo $tapel;?>">
							  <select class="form-control select2" name="pdid" style="width: 100%;">
								<option value="">==Pilih Siswa==</option>
								<?php 
								$sql2 = "SELECT * FROM penempatan WHERE NOT EXISTS (SELECT * FROM pesertaun WHERE pesertaun.peserta_didik_id=penempatan.peserta_didik_id and pesertaun.tapel='$tapel') AND tapel='$tapel' AND rombel like '6%' order by nama asc";
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
							  <span class="form-label">Nomor Peserta US/M</span>
							  <input type="text" class="form-control" name="nopes" data-inputmask="'mask': '1-99-02-18-883-999-9'" data-mask>
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
<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" class="init">
	var nK3;
	$(document).ready(function() {
		nK3 = $("#pesertaUN").DataTable({
				"searching": false,
				"ajax": "../modul/usbn/pesertaUN.php?tapel=<?=$tapel;?>",
				"order": []
			});
		$('[data-mask]').inputmask();
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
								nK3.ajax.reload(null, false);
								$("#createAbsenForm")[0].reset();
								// this function is built in function of datatables;

							} else {
								$.amaran({
									'theme'     :'awesome error',
									'content'   :{
										title:'Sukses!',
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
	});
</script>
</body>
</html>
