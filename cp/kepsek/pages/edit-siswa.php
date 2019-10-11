<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php 
$id=isset($_GET['id']) ? $_GET['id'] : 0;
$cfg=mysqli_fetch_array(mysqli_query($koneksi, "select * from konfigurasi"));
$smt=$cfg['semester'];
$tapel=$cfg['tapel'];
$bio = mysqli_fetch_array(mysqli_query($koneksi, "select * from siswa where id='$id'"));
$ids=$bio['peserta_didik_id'];
if(file_exists($_SERVER{'DOCUMENT_ROOT'} . "/images/siswa/".$bio['avatar'])){
	$avatar="../../../images/siswa/".$bio['avatar'];
}else{
	$avatar="../../../images/user-default.png";
};
?>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-3">
				<!-- Profile Image -->
				<div class="box box-primary">
					<div class="box-body box-profile">
						<form role="form" id="avatarForm" method="post" enctype="multipart/form-data">
							<input type="hidden" name="code" value="DSAFDSGFDGGFHFJ45245345^GFDGGSDFGDSDSFFHHQACFBHJGPOIUJ">
							<label class="avatar" for="uploadAvatar" style="display: inline-block; position: relative; overflow: hidden; width: 120px; height: 120px; border-radius: 50%; background-color: #f6f6f6; cursor: pointer">
								<span class="embed-avatar profile-user-img img-responsive img-circle" style="display: block; width: 100%; height: 100%; display: block; position: absolute; top: 0; left: 0;">
									<span class="img-avatar img-avatar-lg bg" style="display: block; width: 100%; height: 100%; background: url('<?=$avatar;?>') no-repeat center; background-size: 100% 100%;"></span>
								</span>
								<span class="camera" style="width: 100%;height: 100%;z-index: 9999;text-align: center;position: absolute;top: 0;left: 0;background: #F0F0F0;opacity: 0.5;padding: 0;padding-top: 43%;">
									<i class="fa fa-camera" style="color: blueviolet"></i>
								</span>
								<input type="file" name="uploadAvatar" id="uploadAvatar" class="upload-avatar" accept="image/*" style="display: none;">
							</label>
						</form>
					  
					  <h3 class="profile-username text-center"><?=$bio['nama'];?></h3>

					  
					  <a href="./siswa.php" class="btn btn-primary btn-block"><b>Kembali</b></a>
					</div>
					<!-- /.box-body -->
				</div>
				  <!-- /.box -->
			</div>
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs pull-right">
					  <li><a href="#settings" data-toggle="tab">Data Prestasi</a></li>
					  <li><a href="#timeline" data-toggle="tab">Data Kesehatan</a></li>
					  <li class="active"><a href="#activity" data-toggle="tab">Biodata</a></li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="activity">
							<form class="form-horizontal" autocomplete="off" action="../modul/siswa/simpanData.php" method="POST" id="bioForm">
							  <div class="form-group">
								<div class="col-sm-offset-10 col-sm-2">
								  <button type="submit" class="btn btn-danger">Simpan</button>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">N I S</label>

								<div class="col-sm-9">
								  <input type="text" name="nis" class="form-control"  value="<?=$bio['nis'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">N I S N</label>

								<div class="col-sm-9">
								  <input type="text" name="nisn" class="form-control"  value="<?=$bio['nisn'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" name="nama" value="<?=$bio['nama'];?>">
								  <input type="hidden" name="id" class="form-control" value="<?=$id;?>">
								  <input type="hidden" name="ids" class="form-control" value="<?=$ids;?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Jenis Kelamin</label>

								<div class="col-sm-9">
									<select class="form-control select2" name="jk" style="width: 100%;">
							  			<option value="L" <?php if($bio['jk']=='L') echo "selected"; ?>>Laki-laki</option>
										<option value="P" <?php if($bio['jk']=='P') echo "selected"; ?>>Perempuan</option>
									</select>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Tempat Tanggal Lahir</label>

								<div class="col-sm-3">
								  <input type="text" class="form-control" name="tempat" value="<?=$bio['tempat'];?>">
								</div>
								<div class="col-sm-3">
								  <input type="text" class="form-control" name="tanggal" value="<?=$bio['tanggal'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">N I K</label>

								<div class="col-sm-9">
								  <input type="text" name="nik" class="form-control"  value="<?=$bio['nik'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Agama</label>

								<div class="col-sm-9">
									<select class="form-control select2" name="agama" style="width: 100%;">
							  			<option value="0" <?php if($bio['agama']==0) echo "selected"; ?>>Belum Diisi</option>
										<?php 
										$sql_mk=mysqli_query($koneksi, "select * from agama");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option value="<?=$nk['id_agama'];?>" <?php if($bio['agama']==$nk['id_agama']) echo "selected"; ?>><?=$nk['nama_agama'];?></option>
										<?php };?>
									</select>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Pendidikan Sebelumnya</label>

								<div class="col-sm-9">
								  <input type="text" name="pend_seb" class="form-control"  value="<?=$bio['pend_sebelum'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Alamat Siswa</label>

								<div class="col-sm-9">
								  <textarea class="form-control" name="alamat"><?=$bio['alamat'];?></textarea>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama Ayah</label>

								<div class="col-sm-9">
								  <input type="text" name="ayah" class="form-control"  value="<?=$bio['nama_ayah'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama Ibu</label>

								<div class="col-sm-9">
								  <input type="text" name="ibu" class="form-control"  value="<?=$bio['nama_ibu'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Pekerjaan Ayah</label>

								<div class="col-sm-9">
								  <select class="form-control select2" name="pek_ayah" style="width: 100%;">
							  			<option value="0" <?php if($bio['pek_ayah']==0 || empty($bio['pek_ayah'])) echo "selected"; ?>>Belum Diisi</option>
										<?php 
										$sql_mk=mysqli_query($koneksi, "select * from pekerjaan");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option value="<?=$nk['id_pekerjaan'];?>" <?php if($bio['pek_ayah']==$nk['id_pekerjaan']) echo "selected"; ?>><?=$nk['nama_pekerjaan'];?></option>
										<?php };?>
									</select>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Pekerjaan Ibu</label>

								<div class="col-sm-9">
								  <select class="form-control select2" name="pek_ibu" style="width: 100%;">
							  			<option value="0" <?php if($bio['pek_ibu']==0 || empty($bio['pek_ibu'])) echo "selected"; ?>>Belum Diisi</option>
										<?php 
										$sql_mk=mysqli_query($koneksi, "select * from pekerjaan");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option value="<?=$nk['id_pekerjaan'];?>" <?php if($bio['pek_ibu']==$nk['id_pekerjaan']) echo "selected"; ?>><?=$nk['nama_pekerjaan'];?></option>
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
								  <textarea class="form-control" name="jalan"><?=$bio['jalan'];?></textarea>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Kelurahan</label>

								<div class="col-sm-9">
								  <input type="text" name="kelurahan" class="form-control"  value="<?=$bio['kelurahan'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Kecamatan</label>

								<div class="col-sm-9">
								  <select class="form-control select2" name="kecamatan" style="width: 100%;">
							  			<option value="0" <?php if($bio['kecamatan']==0 || empty($bio['kecamatan'])) echo "selected"; ?>>Belum Diisi</option>
										<?php 
										$sql_mk=mysqli_query($koneksi, "select * from kecamatan");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option value="<?=$nk['id_kecamatan'];?>" <?php if($bio['kecamatan']==$nk['id_kecamatan']) echo "selected"; ?>><?=$nk['nama_kecamatan'];?></option>
										<?php };?>
									</select>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Kabupaten</label>

								<div class="col-sm-9">
								  <select class="form-control select2" name="kabupaten" style="width: 100%;">
							  			<option value="0" <?php if($bio['kabupaten']==0 || empty($bio['kabupaten'])) echo "selected"; ?>>Belum Diisi</option>
										<?php 
										$sql_mk=mysqli_query($koneksi, "select * from kabupaten");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option value="<?=$nk['id_kabupaten'];?>" <?php if($bio['kabupaten']==$nk['id_kabupaten']) echo "selected"; ?>><?=$nk['nama_kabupaten'];?></option>
										<?php };?>
									</select>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Provinsi</label>

								<div class="col-sm-9">
								  <select class="form-control select2" name="provinsi" style="width: 100%;">
							  			<option value="0" <?php if($bio['provinsi']==0 || empty($bio['provinsi'])) echo "selected"; ?>>Belum Diisi</option>
										<?php 
										$sql_mk=mysqli_query($koneksi, "select * from provinsi");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option value="<?=$nk['id_provinsi'];?>" <?php if($bio['provinsi']==$nk['id_provinsi']) echo "selected"; ?>><?=$nk['nama_provinsi'];?></option>
										<?php };?>
									</select>
								</div>
							  </div>
							  
							</form>
						</div>
						<div class="tab-pane" id="timeline">
							<?php 
							$kes = mysqli_fetch_array(mysqli_query($koneksi, "select * from data_kesehatan where peserta_didik_id='$ids' and smt='$smt' and tapel='$tapel'"));
							?>
							<form class="form-horizontal" autocomplete="off" action="../modul/siswa/simpanKes.php" method="POST" id="kesForm">
							  <div class="form-group">
								<div class="col-sm-offset-10 col-sm-2">
								  <button type="submit" class="btn btn-danger">Simpan</button>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Tinggi Badan</label>

								<div class="col-sm-9">
								  <input type="text" name="tinggi" class="form-control"  value="<?=$kes['tinggi'];?>">
								  <input type="hidden" name="ids" class="form-control" value="<?=$ids;?>">
								  <input type="hidden" name="smt" class="form-control" value="<?=$smt;?>">
								  <input type="hidden" name="tapel" class="form-control" value="<?=$tapel;?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Berat Badan</label>

								<div class="col-sm-9">
								  <input type="text" name="berat" class="form-control"  value="<?=$kes['berat'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Pendengaran</label>

								<div class="col-sm-9">
								  <textarea class="form-control" name="pendengaran"><?=$kes['pendengaran'];?></textarea>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Penglihatan</label>

								<div class="col-sm-9">
								  <textarea class="form-control" name="penglihatan"><?=$kes['penglihatan'];?></textarea>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Gigi</label>

								<div class="col-sm-9">
								  <textarea class="form-control" name="gigi"><?=$kes['gigi'];?></textarea>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Lainnya</label>

								<div class="col-sm-9">
								  <textarea class="form-control" name="lainnya"><?=$kes['lainnya'];?></textarea>
								</div>
							  </div>
							  
							</form>
						</div>
						<div class="tab-pane" id="settings">
							<?php 
							$pres = mysqli_fetch_array(mysqli_query($koneksi, "select * from data_prestasi where peserta_didik_id='$ids' and smt='$smt' and tapel='$tapel'"));
							?>
							<form class="form-horizontal" autocomplete="off" action="../modul/siswa/simpanPres.php" method="POST" id="presForm">
							  <div class="form-group">
								<div class="col-sm-offset-10 col-sm-2">
								  <button type="submit" class="btn btn-danger">Simpan</button>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Kesenian</label>

								<div class="col-sm-9">
								  <textarea class="form-control" name="kesenian"><?=$pres['kesenian'];?></textarea>
								  <input type="hidden" name="ids" class="form-control" value="<?=$ids;?>">
								  <input type="hidden" name="smt" class="form-control" value="<?=$smt;?>">
								  <input type="hidden" name="tapel" class="form-control" value="<?=$tapel;?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Olahraga</label>

								<div class="col-sm-9">
								  <textarea class="form-control" name="olahraga"><?=$pres['olahraga'];?></textarea>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Akademik</label>

								<div class="col-sm-9">
								  <textarea class="form-control" name="akademik"><?=$pres['akademik'];?></textarea>
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
		
        <!-- /.modal -->
		
		<!--Tambah RB-->
		
        <!-- /.modal -->
		
		<!--Hapus SK-->
			
<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
    $(function () {
        $("input[name='uploadAvatar']").change(function () {
            if (this.files.length > 0) {
                if (!window.FormData) {
                    alert("Your browse does not support FormData object.");
                    return false;
                }
                //console.log(this.form); return;

                $.ajax({
                    url: "../../../images/avatar-upload.php?id=<?=$id;?>",
                    method: 'POST',
                    dataType: 'json',
                    data: new FormData(this.form),
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        //
                    },
                    success: function (data) {
                        if (data['status'] === 'ok') {
                            var uploaded_url = data['uploaded_url'];
                            $(".avatar .embed-avatar .img-avatar").css({"background-image": "url('" + uploaded_url + "')"});
                        }
                    },
                    complete: function () {
						
                        
                    },
                    error: function () {
                        //
                    }
                });
            }
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
			
			$("#kesForm").unbind('submit').bind('submit', function() {

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
			
			$("#presForm").unbind('submit').bind('submit', function() {

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
</script>
</body>
</html>
