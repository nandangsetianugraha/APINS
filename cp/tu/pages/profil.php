<?php 
include "../inc/lte-head.php";
?>
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
if(file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/1data/images/ptk/".$gbr['gambar'])){
	$photo1="../../../images/ptk/".$gbr['gambar'];
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
					  <img class="profile-user-img img-responsive img-circle" id="profile_picture" src="<?=$photo1;?>" alt="User profile picture">

					  <h3 class="profile-username text-center"><?=$bio['nama'];?></h3>

					  
					  <div id="hasilptk"></div>
					  
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
					  <li class="pull-left header"><img src="<?=$photo1;?>" class="img-circle" alt="User Image" height="30px"> Profil</li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="activity">
							<form class="form-horizontal" id="ptkForm">
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
							  
							</form>
						</div>
						<div class="tab-pane" id="timeline">
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
  
  <!--Ubah Profil Gambar-->
		<div id="profile_pic_modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				   <h3>Change Profile Picture</h3>
				</div>
				<div class="modal-body">
					<form id="cropimage" method="post" enctype="multipart/form-data" action="../../upload/change_pic.php">
						<strong>Upload Image:</strong> <br><br>
						<input type="file" name="profile-pic" id="profile-pic" />
						<input type="hidden" name="hdn-profile-id" id="hdn-profile-id" value="<?=$idku;?>" />
						<input type="hidden" name="hdn-x1-axis" id="hdn-x1-axis" value="" />
						<input type="hidden" name="hdn-y1-axis" id="hdn-y1-axis" value="" />
						<input type="hidden" name="hdn-x2-axis" value="" id="hdn-x2-axis" />
						<input type="hidden" name="hdn-y2-axis" value="" id="hdn-y2-axis" />
						<input type="hidden" name="hdn-thumb-width" id="hdn-thumb-width" value="" />
						<input type="hidden" name="hdn-thumb-height" id="hdn-thumb-height" value="" />
						<input type="hidden" name="action" value="" id="action" />
						<input type="hidden" name="image_name" value="" id="image_name" />
						
						<div id='preview-profile-pic'></div>
					<div id="thumbs" style="padding:5px; width:600p"></div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" id="save_crop" class="btn btn-primary">Crop & Save</button>
				</div>
			</div>
		</div>
	</div>
        <!-- /.modal -->
		
		<!--Tambah RB-->
		
        <!-- /.modal -->
		
		<!--Hapus SK-->
			
<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
	$(document).ready(function() {
		$('#datepicker').datepicker({
		  autoclose: true
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
