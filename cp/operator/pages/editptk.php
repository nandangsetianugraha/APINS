<?php 
include "../inc/lte-head.php";
?>
<link rel="stylesheet" href="../../../dist/css/croppie.css" />
<body class="hold-transition skin-blue sidebar-mini">
<?php 
$idp=isset($_GET['idp']) ? $_GET['idp'] : $idku;
$bio = mysqli_fetch_array(mysqli_query($koneksi, "select * from ptk where ptk_id='$idp'"));
$niy1=$bio['niy_nigk'];
$jns=$bio['jenis_ptk_id'];
$rm = mysqli_fetch_array(mysqli_query($koneksi, "select * from mengajar where ptk_id='$idp' and tapel='$tpl_aktif'"));
$kelas1=$rm['rombel'];
$ab1=substr($kelas1,0,1);
$jptk = mysqli_fetch_array(mysqli_query($koneksi, "select * from jenis_ptk where jenis_ptk_id='$jns'"));
if(file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/images/ptk/".$bio['gambar'])){
	$photo1="../../../images/ptk/".$bio['gambar'];
}else{
	$photo1="../../../images/user-default.png";
};

?>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-3">
				<!-- Profile Image -->
				<div class="box box-primary">
					<div class="box-body box-profile">
						<div id="uploaded_image"><img class="profile-user-img img-responsive img-circle" src="<?=$photo1;?>" alt="User profile picture"></div>
					  

					  <h3 class="profile-username text-center"><?=$bio['nama'];?></h3>

					  <p class="text-muted text-center">
					  <input type="file" name="upload_image" id="upload_image" />
					  <a data-toggle="modal" data-target="#tambahRB" class="btn btn-primary btn-xs" id="addRBBtn"><i class="fa fa-edit"></i></a>
					  </p>

					  <div id="hasilptk"></div>
					  <a href="./ptk.php" class="btn btn-primary btn-block"><b>Kembali</b></a>
					</div>
					<!-- /.box-body -->
				</div>
				  <!-- /.box -->
			</div>
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs pull-right">
					  <li><a href="#settings" data-toggle="tab">Settings</a></li>
					  <li><a href="#timeline" data-toggle="tab">SK Pengangkatan</a></li>
					  <li class="active"><a href="#activity" data-toggle="tab">Biodata</a></li>
					  <li class="pull-left header">Profil</li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="activity">
							<form class="form-horizontal" autocomplete="off" action="../modul/ptk/simpanPTK.php" method="POST" id="ptkForm">
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" name="nama" value="<?=$bio['nama'];?>">
								  <input type="hidden" name="ptkid" class="form-control" value="<?=$idp;?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Tempat Tanggal Lahir</label>

								<div class="col-sm-3">
								  <input type="text" class="form-control" name="tempat" value="<?=$bio['tempat_lahir'];?>">
								</div>
								<div class="col-sm-3">
								  <input type="text" class="form-control" name="tanggal" value="<?=$bio['tanggal_lahir'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">N I K</label>

								<div class="col-sm-9">
								  <input type="text" name="nik" class="form-control"  value="<?=$bio['nik'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nomor Induk Yayasan</label>

								<div class="col-sm-9">
								  <input type="text" name="niy" class="form-control"  value="<?=$bio['niy_nigk'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">N U P T K</label>

								<div class="col-sm-9">
								  <input type="text" name="nuptk" class="form-control"  value="<?=$bio['nuptk'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Alamat</label>

								<div class="col-sm-9">
								  <textarea class="form-control" name="alamat"><?=$bio['alamat_jalan'];?></textarea>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Email</label>

								<div class="col-sm-9">
								  <input type="text" name="email" class="form-control"  value="<?=$bio['email'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">No Telepon</label>

								<div class="col-sm-9">
								  <input type="text" name="hp" class="form-control"  value="<?=$bio['no_hp'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
								  <button type="submit" class="btn btn-danger">Simpan</button>
								</div>
							  </div>
							</form>
						</div>
						<div class="tab-pane" id="timeline">
							<p><a data-toggle="modal" data-target="#tambahSK" class="btn btn-primary" id="addSKBtn"><i class="fa fa-plus"></i> <b>Tambah SK</b></a></p>
							<div id="hasil"></div>
						</div>
						<div class="tab-pane" id="settings">
							<?php 
							$suser=mysqli_query($koneksi, "select * from pengguna where ptk_id='$idp'");
							$uptk=mysqli_fetch_array($suser);
							?>
							<form class="form-horizontal" autocomplete="off" action="../modul/ptk/simpanData.php" method="POST" id="ubahForm">
							  <div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">Username</label>

								<div class="col-sm-10">
									<input type="hidden" name="ptkid" class="form-control" value="<?=$idp;?>">
								  <input type="text" class="form-control" name="username" value="<?=$uptk['username'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">Password</label>

								<div class="col-sm-10">
								  <input type="password" class="form-control" name="password" value="<?=$uptk['password'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
								  <button type="submit" class="btn btn-danger">Simpan</button>
								</div>
							  </div>
							</form>
						</div>
					</div>
				</div>
			</div>
    </section>
    <!-- /.content -->
  
  <!--Tambah SK-->
		<div class="modal fade" id="tambahSK">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah SK - <?=$bio['nama'];?></h4>
              </div>
                <form class="form" action="../modul/ptk/tambahSK.php" autocomplete="off" method="POST" id="createSKForm">
                        <div class="modal-body">
							<div class="form-group">
								<label>Tanggal SK:</label>
								<div class="input-group date">
								  <div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								  </div>
								  <input type="text" name="tanggal" class="form-control pull-right" id="datepicker">
								</div>
							  <input type="hidden" id="kelas" name="ptkid" class="form-control" value="<?php echo $idp;?>">
							</div>
							<div class="form-group">
								<label>Nomor SK:</label>
								<div class="input-group date">
								  <div class="input-group-addon">
									<i class="fa fa-edit"></i>
								  </div>
								  <input type="text" name="nosk" class="form-control pull-right">
								</div>
							</div>
							<div class="form-group">
								<label>Pendidikan Terakhir:</label>
								<div class="input-group date">
								  <div class="input-group-addon">
									<i class="fa fa-edit"></i>
								  </div>
								  <input type="text" name="pendidikan" class="form-control pull-right">
								</div>
							</div>
							<div class="form-group">
								<label>Jenis PTK:</label>
								<div class="input-group date">
								  <div class="input-group-addon">
									<i class="fa fa-edit"></i>
								  </div>
								  <select class="form-control" name="jenis">
							  		<option>Pilih Jenis PTK...</option>
									<option value="Kepala Sekolah">Kepala Sekolah</option>
									<option value="Guru">Guru</option>
									<option value="Pegawai">Pegawai</option>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label>Jabatan:</label>
								<div class="input-group date">
								  <div class="input-group-addon">
									<i class="fa fa-edit"></i>
								  </div>
								  <select class="form-control" name="jabatan">
							  		<option>Pilih Jabatan...</option>
									<option value="Kepala Sekolah">Kepala Sekolah</option>
									<option value="Guru Kelas">Guru Kelas</option>
									<option value="Guru Pendamping">Guru Pendamping</option>
									<option value="Mata Pelajaran">Guru Mata Pelajaran</option>
									<option value="Tenaga Administrasi Sekolah">Tenaga Administrasi Sekolah</option>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label>Pejabat yang mengangkat:</label>
								<div class="input-group date">
								  <div class="input-group-addon">
									<i class="fa fa-edit"></i>
								  </div>
								  <input type="text" name="pengangkat" class="form-control pull-right">
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
		
		<!--Tambah RB-->
		<div class="modal fade" id="tambahRB">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Penempatan Kelas - <?=$bio['nama'];?></h4>
              </div>
                <form class="form" action="../modul/ptk/tambahRB.php" autocomplete="off" method="POST" id="createRBForm">
                        <div class="modal-body">
							<div class="form-group">
								<label>Rombel:</label>
								<div class="input-group date">
								  <div class="input-group-addon">
									<i class="fa fa-edit"></i>
								  </div>
								  <input type="hidden" name="ptkid" class="form-control" value="<?php echo $idp;?>">
								  <input type="hidden" name="tapel" class="form-control" value="<?php echo $tpl_aktif;?>">
								  <select class="form-control" name="kelas">
							  		<option value="0">Semua Kelas</option>
									<?php 
									$sql_mk=mysqli_query($koneksi, "select * from rombel where tapel='$tpl_aktif' order by nama_rombel asc");
									while($nk=mysqli_fetch_array($sql_mk)){
									?>
									<option value="<?=$nk['nama_rombel'];?>" <?php if($nk['nama_rombel']==$kelas1){echo "selected";}; ?>><?=$nk['nama_rombel'];?></option>
									<?php };?>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label>Jabatan:</label>
								<div class="input-group date">
								  <div class="input-group-addon">
									<i class="fa fa-edit"></i>
								  </div>
								  <select class="form-control" name="jenisptk">
							  		<option>Pilih Jabatan...</option>
									<?php 
									$sql_j=mysqli_query($koneksi, "select * from jenis_ptk");
									while($jk=mysqli_fetch_array($sql_j)){
									?>
									<option value="<?=$jk['jenis_ptk_id'];?>" <?php if($jk['jenis_ptk_id']==$jns){echo "selected";}; ?>><?=$jk['jenis_ptk'];?></option>
									<?php };?>
								  </select>
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
		
		<!--Hapus SK-->
			<div id="removeSKModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Hapus SK</h4>
                        </div>
                        <div class="modal-body">
							<p>Hapus SK Pengangkatan <?=$bio['nama'];?>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tidak</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light" id="removeBtn">Ya</button>
                        </div>
                    </div>
                </div>
            </div>
			<!--Modal Upload Foto-->
			<div id="uploadimageModal" class="modal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Upload & Crop Image</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-8 text-center">
									  <div id="image_demo" style="width:350px; margin-top:30px"></div>
								</div>
								<div class="col-md-4" style="padding-top:30px;">
									<br />
									<br />
									<br/>
									  <button class="btn btn-success crop_image">Crop & Upload Image</button>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!--end Modal-->
<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../../../dist/js/croppie.js"></script>

<script>
	$(document).ready(function() {
		$('#datepicker').datepicker({
		  autoclose: true
		});
		$image_crop = $('#image_demo').croppie({
			enableExif: true,
			viewport: {
			  width:200,
			  height:200,
			  type:'square' //circle
			},
			boundary:{
			  width:300,
			  height:300
			}
		});
		$('#upload_image').on('change', function(){
			var reader = new FileReader();
			reader.onload = function (event) {
			  $image_crop.croppie('bind', {
				url: event.target.result
			  }).then(function(){
				console.log('jQuery bind complete');
			  });
			}
			reader.readAsDataURL(this.files[0]);
			$('#uploadimageModal').modal('show');
		});
		$('.crop_image').click(function(event){
			$image_crop.croppie('result', {
			  type: 'canvas',
			  size: 'viewport'
			}).then(function(response){
			  $.ajax({
				url:"../../../images/upload.php?idp=<?=$idp;?>",
				type: "POST",
				data:{"image": response},
				success:function(data)
				{
				  $('#uploadimageModal').modal('hide');
				  $('#uploaded_image').html(data);
				}
			  });
			})
		});
		viewSK();
		function viewSK(){
				$.get("../modul/ptk/lihatSK.php?idp=<?=$idp;?>", function(data) {
					$("#hasil").html(data);
				});
		}
		viewPTK();
		function viewPTK(){
				$.get("../modul/ptk/lihatPTK.php?idp=<?=$idp;?>", function(data) {
					$("#hasilptk").html(data);
				});
		}
			$("#ubahForm").unbind('submit').bind('submit', function() {

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

								// reset the form
							
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
			
			$("#ptkForm").unbind('submit').bind('submit', function() {

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

								// reset the form
							
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
			$("#addSKBtn").on('click', function() {
				// reset the form 
				$("#createSKForm")[0].reset();
				
				// submit form
				$("#createSKForm").unbind('submit').bind('submit', function() {

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
									$("#tambahSK").modal('hide');

									// reload the datatables
									viewSK();
									$("#createSKForm")[0].reset();
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
			
			$("#addRBBtn").on('click', function() {
				
				// submit form
				$("#createRBForm").unbind('submit').bind('submit', function() {

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
									$("#tambahRB").modal('hide');

									// reload the datatables
									viewPTK();
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
	function removeSK(id = null) {
		if(id) {
			// click on remove button
			$("#removeBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/ptk/hapusSK.php',
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
							viewSK();
							function viewSK(){
								$.get("../modul/ptk/lihatSK.php?idp=<?=$idp;?>", function(data) {
									$("#hasil").html(data);
								});
							}
									

							// close the modal
							$("#removeSKModal").modal('hide');

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
