<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
$status = isset($_GET['status']) ? $_GET['status'] : '1';
$st=mysqli_fetch_array(mysqli_query($koneksi, "select * from jns_mutasi where id_mutasi='$status'"));
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Daftar Siswa 
        <small>
		<form role="form" action="siswa.php" method="GET">
			<div class="form-group">
									<select class="form-control" name="status" onchange="this.form.submit()">
									<?php 
									$sql2 = "select * from jns_mutasi";
									$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
									while($po=mysqli_fetch_array($qu3)){;
									?>
										<option value="<?=$po['id_mutasi'];?>" <?php if($po['id_mutasi']==$status){echo "selected";}; ?>><?=$po['nama_mutasi'];?></option>
									<?php };?>
									</select>
									
								</div>
		</form>
		</small>
    </h1>
    <ol class="breadcrumb">
		<?php if($status==1){ ?>
        <li><a href="#" data-toggle="modal" data-toggle="modal" data-target="#penempatan"><i class="fa fa-plus"></i> Penempatan</a></li> 
		<?php }; ?>
		<li><a href="#" data-toggle="modal" data-toggle="modal" data-target="#tambahSiswaModal"><i class="fa fa-plus"></i> Siswa Baru</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
   
		
						<table id="manageMemberTable" class="table table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
												<th></th>
												<th class="text-center">NIS</th>
												<th class="text-center">NISN</th>
												<th class="text-center">Nama Siswa</th>
												<th class="text-center">Tempat Lahir</th>
												<th class="text-center"><?php if($status==1){ ?>Kelas<?php }else{ ?>Status<?php }; ?></th>
												<th>&nbsp;</th>
											</tr>
                                        </thead>
                                        <tbody>
										
                                        </tbody>
                                    </table>
			
<!--Modal -->
		<div class="modal fade" id="penempatan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Daftar Siswa</h4>
              </div>
              <div class="modal-body">
				<table id="managePenempatan" class="table table-bordered table-hover">
									<thead>
									   <tr>
											<th>NIS</th>
											<th>NISN</th>
											<th>Nama Siswa</th>
											<th>TTL</th>
											<th>JK</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
			  </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<div class="modal fade" id="penempatanMemberModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tempatkan Siswa</h4>
              </div>
                        <form class="form" action="../modul/siswa/penempatansiswa.php" method="POST" id="penempatanMemberForm">
						<div class="modal-body">
							<div class="form-group">
								<label for="output-device">Nama Siswa</label>
								<input type="text" class="form-control" id="penempatannama" name="penempatannama" placeholder="Nama Lengkap" autocomplete=off>
							</div>
							<div class="form-group">
								<label for="output-device">Kelas</label>
								<input type="hidden" class="form-control" id="tapel" name="tapel" value="<?=$tpl_aktif;?>">
								<select id="kelas" class="form-control" size="1" name="kelas">
									<?php 
									$sql_mk=mysqli_query($koneksi, "select * from rombel where tapel='$tpl_aktif' order by nama_rombel asc");
									while($nk=mysqli_fetch_array($sql_mk)){
									?>
									<option value="<?php echo $nk['nama_rombel']; ?>" <?php if($kelas==$nk['nama_rombel']){echo "selected";} ?>>Kelas <?php echo $nk['nama_rombel']; ?></option>
									<?php };?>
								</select>
							</div>
                        </div>
                        <div class="modal-footer penempatanMemberModal">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Ya</button>
                        </div>
						</form>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<div class="modal fade" id="tambahSiswaModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Siswa Baru</h4>
              </div>
                        
						<form class="form-horizontal" autocomplete="off" action="../modul/siswa/tambahSiswa.php" method="POST" id="bioForm">
							  
							  
						<div class="modal-body">
							
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">N I S</label>

								<div class="col-sm-9">
								  <input type="text" name="nis" class="form-control">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">N I S N</label>

								<div class="col-sm-9">
								  <input type="text" name="nisn" class="form-control">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" name="nama">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Jenis Kelamin</label>

								<div class="col-sm-9">
									<select class="form-control select2" name="jk" style="width: 100%;">
							  			<option value="L">Laki-laki</option>
										<option value="P">>Perempuan</option>
									</select>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Tempat Tanggal Lahir</label>

								<div class="col-sm-3">
								  <input type="text" class="form-control" name="tempat">
								</div>
								<div class="col-sm-3">
								  <input type="text" class="form-control" name="tanggal">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">N I K</label>

								<div class="col-sm-9">
								  <input type="text" name="nik" class="form-control">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Agama</label>

								<div class="col-sm-9">
									<select class="form-control select2" name="agama" style="width: 100%;">
							  			<?php 
										$sql_mk=mysqli_query($koneksi, "select * from agama");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option value="<?=$nk['id_agama'];?>"><?=$nk['nama_agama'];?></option>
										<?php };?>
									</select>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Pendidikan Sebelumnya</label>

								<div class="col-sm-9">
								  <input type="text" name="pend_seb" class="form-control">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Alamat Siswa</label>

								<div class="col-sm-9">
								  <textarea class="form-control" name="alamat"></textarea>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama Ayah</label>

								<div class="col-sm-9">
								  <input type="text" name="ayah" class="form-control">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama Ibu</label>

								<div class="col-sm-9">
								  <input type="text" name="ibu" class="form-control">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Pekerjaan Ayah</label>

								<div class="col-sm-9">
								  <select class="form-control select2" name="pek_ayah" style="width: 100%;">
							  			<?php 
										$sql_mk=mysqli_query($koneksi, "select * from pekerjaan");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option value="<?=$nk['id_pekerjaan'];?>"><?=$nk['nama_pekerjaan'];?></option>
										<?php };?>
									</select>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Pekerjaan Ibu</label>

								<div class="col-sm-9">
								  <select class="form-control select2" name="pek_ibu" style="width: 100%;">
							  			<?php 
										$sql_mk=mysqli_query($koneksi, "select * from pekerjaan");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option value="<?=$nk['id_pekerjaan'];?>"><?=$nk['nama_pekerjaan'];?></option>
										<?php };?>
									</select>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Alamat Orang Tua</label>

								<div class="col-sm-9">
								  
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Jalan</label>

								<div class="col-sm-9">
								  <textarea class="form-control" name="jalan"></textarea>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Kelurahan</label>

								<div class="col-sm-9">
								  <input type="text" name="kelurahan" class="form-control">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Kecamatan</label>

								<div class="col-sm-9">
								  <select class="form-control select2" name="kecamatan" style="width: 100%;">
							  			<?php 
										$sql_mk=mysqli_query($koneksi, "select * from kecamatan");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option value="<?=$nk['id_kecamatan'];?>"><?=$nk['nama_kecamatan'];?></option>
										<?php };?>
									</select>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Kabupaten</label>

								<div class="col-sm-9">
								  <select class="form-control select2" name="kabupaten" style="width: 100%;">
							  			<?php 
										$sql_mk=mysqli_query($koneksi, "select * from kabupaten");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option value="<?=$nk['id_kabupaten'];?>"><?=$nk['nama_kabupaten'];?></option>
										<?php };?>
									</select>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Provinsi</label>

								<div class="col-sm-9">
								  <select class="form-control select2" name="provinsi" style="width: 100%;">
							  			<?php 
										$sql_mk=mysqli_query($koneksi, "select * from provinsi");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option value="<?=$nk['id_provinsi'];?>"><?=$nk['nama_provinsi'];?></option>
										<?php };?>
									</select>
								</div>
							  </div>
                        </div>
                        <div class="modal-footer penempatanMemberModal">
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
                <h4 class="modal-title">Hapus Siswa</h4>
              </div>
                        <div class="modal-body">
							<p>Hapus Data Siswa?<br/>Jika Siswa tersebut Mutasi/Lulus/Meninggal/Dikeluarkan sebaiknya anda ubah Statusnya.</p>
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
	
<!--Mutasi Siswa-->

		<div class="modal fade" id="mutasiSiswa">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mutasi Siswa</h4>
              </div>
                        <form class="form-horizontal" action="../modul/siswa/mutasisiswa.php" autocomplete="off" method="POST" id="mutasiSiswaForm">
						<div class="modal-body mutasiSiswa">
							<div class="mutasi-data"></div>
						</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Update</button>
                        </div>
						</form>
						
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
	var managePenempatan;
	$(document).ready(function() {
		manageMemberTable = $("#manageMemberTable").DataTable({
			"ajax": "../modul/siswa/kelasku.php?status=<?=$status;?>&tapel=<?=$tapel;?>",
			"order": []
		});
		managePenempatan = $("#managePenempatan").DataTable({
			"ajax": "../modul/siswa/siswakosong.php?tapel=<?=$tapel;?>",
			"order": []
		});
		$('#mutasiSiswa').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
			var tpl = $(e.relatedTarget).data('tapel');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : '../modul/siswa/modal_mutasi.php',
                data :  'rowid='+ rowid + '&tapel='+ tpl,
				beforeSend: function()
						{	
							$(".mutasi-data").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...');
						},
                success : function(data){
                $('.mutasi-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
		 $("#mutasiSiswaForm").unbind('submit').bind('submit', function() {
						// remove error messages
						$(".text-danger").remove();

						var form = $(this);

							$.ajax({
								url: form.attr('action'),
								type: form.attr('method'),
								data: form.serialize(),
								dataType: 'json',
								success:function(response) {
									if(response.success == true) {
										Swal.fire({
										  position: 'center',
										  type: 'success',
										  title: response.messages,
										  showConfirmButton: false,
										  timer: 1500
										});
										// reload the datatables
										manageMemberTable.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
										$("#mutasiSiswa").modal('hide');
									} else {
										Swal.fire({
										  position: 'center',
										  type: 'error',
										  title: response.messages,
										  showConfirmButton: false,
										  timer: 1500
										});
									}
								} // /success
							}); // /ajax

						return false;
					});

	});
	$("#bioForm").unbind('submit').bind('submit', function() {

				var form = $(this);

				

					//submi the form to server
					$.ajax({
						url : form.attr('action'),
						type : form.attr('method'),
						data : form.serialize(),
						dataType : 'json',
						success:function(response) {

							// remove the error 
							
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
								// reload the datatables
										manageMemberTable.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
										$("#tambahSiswaModal").modal('hide');
							
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

	function penempatanMember(id = null) {
		if(id) {

			// remove the error 
			$(".form-group").removeClass('has-error').removeClass('has-success');
			$(".text-danger").remove();
			$("#penempatan").modal('hide');
			// remove the id
			$("#member_id").remove();

			// fetch the member data
			$.ajax({
				url: '../modul/siswa/lihatsiswa.php',
				type: 'post',
				data: {member_id : id},
				dataType: 'json',
				success:function(response) {
					$("#penempatannama").val(response.nama);

					// mmeber id 
					$(".penempatanMemberModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

					// here update the member data
					$("#penempatanMemberForm").unbind('submit').bind('submit', function() {
						// remove error messages
						$(".text-danger").remove();

						var form = $(this);

						// validation
						var kelas = $("#kelas").val();
						var tapel = $("#tapel").val();
							$.ajax({
								url: form.attr('action'),
								type: form.attr('method'),
								data: form.serialize(),
								dataType: 'json',
								success:function(response) {
									if(response.success == true) {
										Swal.fire({
										  position: 'center',
										  type: 'success',
										  title: response.messages,
										  showConfirmButton: false,
										  timer: 1500
										});

										// reload the datatables
										manageMemberTable.ajax.reload(null, false);
										managePenempatan.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
										$("#penempatanMemberModal").modal('hide');
										$("#penempatan").modal('show');
									} else {
										Swal.fire({
										  position: 'center',
										  type: 'success',
										  title: response.messages,
										  showConfirmButton: false,
										  timer: 1500
										});
									}
								} // /success
							}); // /ajax

						return false;
					});

				} // /success
			}); // /fetch selected member info

		} else {
			alert("Error : Refresh the page again");
		}
	}
	function outMember(id = null) {
		if(id) {
			// click on remove button
			$("#outBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/siswa/hapussiswa.php',
					type: 'post',
					data: {member_id : id},
					dataType: 'json',
					success:function(response) {
						if(response.success == true) {						
							Swal.fire({
										  position: 'center',
										  type: 'success',
										  title: response.messages,
										  showConfirmButton: false,
										  timer: 1500
										});

							// refresh the table
							manageMemberTable.ajax.reload(null, false);
							managePenempatan.ajax.reload(null, false);

							// close the modal
							$("#outMemberModal").modal('hide');

						} else {
							Swal.fire({
										  position: 'center',
										  type: 'success',
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
		};
		
		
	}
</script>
</body>
</html>	