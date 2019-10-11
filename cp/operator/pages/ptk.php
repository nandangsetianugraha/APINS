<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
$kelas=isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
?>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Daftar PTK</h3>
					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#penempatan"><i class="fa fa-plus"></i> PTK Baru</button>
					  </div>
					</div>
					<div class="box-body table-responsive">
						<table id="manageMemberTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
												<th></th>
												<th class="text-center">Nama Guru</th>
												<th class="text-center">NIK</th>
												<th class="text-center">NIY</th>
												<th class="text-center">NUPTK</th>
												<th class="text-center">Mengajar</th>
												<th>&nbsp;</th>
											</tr>
                                        </thead>
                                        <tbody>
										
                                        </tbody>
                                    </table>
					</div>
				</div>
			</div>
		</div>
	
	<!--Modal -->
		<div class="modal fade" id="penempatan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">PTK Baru</h4>
              </div>
			  <form class="form-horizontal" action="../modul/ptk/tambahPTK.php" autocomplete="off" method="POST" id="tambahPTKForm">
              <div class="modal-body">
				
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama Lengkap</label>
								<div class="col-sm-6">
								  <input type="text" class="form-control" name="nama">
								</div>
								<div class="col-sm-3">
								  <input type="text" class="form-control" name="gelar">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Jenis Kelamin</label>
								<div class="col-sm-9">
								  <select class="form-control" name="jk">
									<option value="L">Laki-laki</option>
									<option value="P">Perempuan</option>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
								<div class="col-sm-6">
								  <input type="text" class="form-control" name="tempat">
								</div>
								<div class="col-sm-3">
								  <input type="text" class="form-control" id="datepicker" name="tanggal">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">NIK</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" name="nik">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">NIY</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" name="niy">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">NUPTK</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" name="nuptk">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Status Kepegawaian</label>
								<div class="col-sm-9">
								  <select class="form-control" name="status_peg">
								  <?php 
									$sql_mk=mysqli_query($koneksi, "select * from status_kepegawaian");
									while($nk=mysqli_fetch_array($sql_mk)){
									?>
									<option value="<?=$nk['status_kepegawaian_id'];?>"><?=$nk['nama'];?></option>
									<?php }; ?>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Jenis Kepegawaian</label>
								<div class="col-sm-9">
								  <select class="form-control" name="jenisptk">
								  <?php 
									$sql_mk1=mysqli_query($koneksi, "select * from jenis_ptk");
									while($nk1=mysqli_fetch_array($sql_mk1)){
									?>
									<option value="<?=$nk1['jenis_ptk_id'];?>"><?=$nk1['jenis_ptk'];?></option>
									<?php }; ?>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Alamat</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" name="alamat">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" name="email">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">No HP</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" name="nohp">
								</div>
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
		<div class="modal fade" id="outMemberModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data Guru</h4>
              </div>
                        <div class="modal-body">
							<p>Anda yakin akan menghapus data guru ini?<br/>Data yang telah dihapus tidak bisa dikembalikan lagi.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light" id="outBtn">Ya</button>
                        </div>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	
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
			"ajax": "../modul/ptk/daftarguru.php?tapel=<?=$tpl_aktif;?>",
			"order": []
		});
		$('#datepicker').datepicker({
		  autoclose: true
		})

		$("#tambahPTKForm").unbind('submit').bind('submit', function() {

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
								$("#tambahPTKForm")[0].reset();		

								// reload the datatables
								$("#penempatan").modal('hide');
								manageMemberTable.ajax.reload(null, false);
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
		
	});
	
	function outMember(id = null) {
		if(id) {
			// click on remove button
			$("#outBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/ptk/hapusguru.php',
					type: 'post',
					data: {member_id : id},
					dataType: 'json',
					success:function(response) {
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

							// refresh the table
							manageMemberTable.ajax.reload(null, false);
							
							// close the modal
							$("#outMemberModal").modal('hide');

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
