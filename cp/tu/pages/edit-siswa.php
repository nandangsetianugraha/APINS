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
$st=$bio['status'];
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
						<img class="profile-user-img img-responsive img-circle" id="profile_picture" src="<?=$avatar;?>" alt="User profile picture">
					  <h3 class="profile-username text-center"><?=$bio['nama'];?></h3>
						<a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal"><i class="fa fa-image text-success"></i> Ganti Photo</a>
					  
					  <a href="./siswa.php?status=<?=$st;?>&tapel=<?=$tapel;?>" class="btn btn-primary btn-block"><b>Kembali</b></a>
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
		
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            Upload image!
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="uploadImageMain">
                            <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                                <div id="image_preview">
                                    <img id="previewing" src="../../images/siswa/<?=$avatar;?>">
                                    <div class="clickHelpText">Klik pada gambar untuk mengunggah gambar.</div>
                                </div>
                                <div id="selectImage">
                                    <label>Pilih Gambar</label>
                                    <br>
                                    <input type="file" name="file" id="fileInput" required="">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="submitUploadNewImage">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
			
<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
function console_log(temp){
    console.log(temp);
}

new_img_data = {};
$(document).ready(function (e) {
	$('#submitUploadNewImage').unbind();
    $('#submitUploadNewImage').click(function(){
        var imgName = $(this).data('img-name');
        var form_data = new FormData();

        form_data.append('imgUrl', imgName);

        form_data.append('imgInitW', new_img_data.getImageData.naturalWidth);
        form_data.append('imgInitH', new_img_data.getImageData.naturalHeight);

        form_data.append('imgW', new_img_data.getImageData.width);
        form_data.append('imgH', new_img_data.getImageData.height);

        form_data.append('imgY1', ((new_img_data.getCropBoxData.top) - parseInt($('.cropper-canvas').css('top'))));
        form_data.append('imgX1', ((new_img_data.getCropBoxData.left) - parseInt($('.cropper-canvas').css('left'))));

        form_data.append('cropW', new_img_data.getCropBoxData.width);
        form_data.append('cropH', new_img_data.getCropBoxData.height);

        form_data.append('rotation', new_img_data.getImageData.rotate);

        $.ajax({
            url: "../../../images/crop2.php?idp=<?=$ids;?>", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: form_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data){   // A function to be called if request succeeds
                var cropResult = $.parseJSON(data);
                console_log('crop done: '+cropResult);
                if(cropResult.status == "success"){
                    console_log('Image Name: '+ cropResult.url);

                    var uploadURL = window.location.protocol+"//"+window.location.hostname+window.location.pathname+cropResult.url;
                    console_log('the image url is: '+uploadURL);
                    $('h1').text('Your image link is here:');
                    $('button').hide();
                    $('.well').html('<a href="'+uploadURL+'" target="_blank">'+uploadURL+'</a>');
                    $('.well').fadeIn();
                    $('#myModal').modal('hide');
					setTimeout(function () {
                                      window.open("./edit-siswa.php?id=<?=$id;?>","_self");
                                  },500)
                }
                else{
                    swal(
                        'Opps!',
                        'Something didnt go well! Please try again.',
                        'warning'
                    );
                }
            },
            timeout: function(){
                swal(
                    'Opps!',
                    'Connection Timed out. Please try again.',
                    'warning'
                );
            }
        });

    });
	// Function to preview image after validation
    $(function() {
        $("#fileInput").change(function(){
            $('#selectImage').fadeOut();
            console_log('Upload new Image');
            var file = this.files[0];
            console_log(file);
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
                console_log('Invalid image');
                $('#previewing').attr('src','assets/img/noimg43.jpg');

                swal(
                    'Opps!',
                    'Not a valid image file.',
                    'warning'
                );
                return false;
            }
            else{
                console_log('Valid Image');
                // upload to temp
                var form_data = new FormData();                  
                form_data.append('file', file);

                $.ajax({
                    url: "../../../images/ajax_php_file2.php", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: form_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    error: function(){
                        alert('Error!');
                    },
                    success: function(data){   // A function to be called if request succeeds
                        console_log(data);

                        var UploadResult = $.parseJSON(data);
                        console_log(UploadResult);
                        if(UploadResult.success == 'TRUE'){

                            // set preview
                            var reader = new FileReader();
                            reader.onload = imageIsLoaded;
                            reader.readAsDataURL(file);

                            // load Cropper js
                            setTimeout(function(){
                                console_log('@ Cropper js');
                                // cropper js assign
                                var image = document.querySelector('#previewing');
                                //var minAspectRatio = 0.5;
                                //var maxAspectRatio = 1.5;
                                cropper = new Cropper(image, {
                                    aspectRatio: 4 / 4,
                                    //preview: '#demo-image-holder',
                                    ready: function () {
                                        console_log('ready');
                                        var cropper = this.cropper;
                                        //var containerData = cropper.getContainerData();
                                        //var cropBoxData = cropper.getCropBoxData();
                                        //var aspectRatio = cropBoxData.width / cropBoxData.height;
                                        //var newCropBoxWidth;
                                        new_img_data.getImageData = cropper.getImageData();
                                        new_img_data.getCropBoxData = cropper.getCropBoxData();
                                    },
                                    cropmove: function () {
                                        //console_log('cropmove');
                                        var cropper = this.cropper;
                                        var cropBoxData = cropper.getImageData();
                                        //var aspectRatio = cropBoxData.width / cropBoxData.height;
                                    },
                                    crop: function(e) {
                                        console_log('crop');
                                    },
                                    cropend: function(e){
                                        //console_log('cropend');
                                        new_img_data.getImageData = cropper.getImageData();
                                        new_img_data.getCropBoxData = cropper.getCropBoxData();
                                        console_log(new_img_data);
                                    }
                                });

                                $('#submitUploadNewImage').fadeIn().css('display', 'initial');
                                $('.clickHelpText').fadeOut().css('display', 'none');
                                $('#submitUploadNewImage').data('img-name', UploadResult.name);
                            }, 2000);
                        }
                        else{
                            swal(
                                'Error!',
                                UploadResult.message,
                                'warning'
                            );
                        }
                    },
                    timeout: function(){
                        swal(
                            'Opps!',
                            'Connection time out.',
                            'warning'
                        );
                    }
                });
            }
        });

    });
    function imageIsLoaded(e) {
        //            $("#fileInput").css("color","green");
        //            $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '230px');
    };

    $('#previewing').unbind();
    $('#previewing').click(function(){
        $('#fileInput').click();
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
