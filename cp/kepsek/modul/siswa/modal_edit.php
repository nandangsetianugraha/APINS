<?php
include("../../inc/db.php");
$idr=$_POST['rowid'];
$cek="SELECT * FROM siswa WHERE id='$idr'";
$hasil=mysqli_query($koneksi,$cek);
$bio=mysqli_fetch_array($hasil);
$ids=$bio['peserta_didik_id'];
?>
						<div class="modal-body">
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs pull-right">
								  <li><a href="#orangtua" data-toggle="tab">Data Orang Tua</a></li>
								  <li class="active"><a href="#pribadi" data-toggle="tab">Biodata</a></li>
								</ul>
								<div class="tab-content">
									<div class="active tab-pane" id="pribadi">
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
											  <input type="hidden" name="id" class="form-control" value="<?=$idr;?>">
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
									</div>
									<div class="tab-pane" id="orangtua">
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
											<?php
											$curl = curl_init();
											curl_setopt_array($curl, array(
												CURLOPT_URL => "http://dev.farizdotid.com/api/daerahindonesia/provinsi",
												CURLOPT_RETURNTRANSFER => true,
												CURLOPT_ENCODING => "",
												CURLOPT_MAXREDIRS => 10,
												CURLOPT_TIMEOUT => 30,
												CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
												CURLOPT_CUSTOMREQUEST => "GET",
											));

											$response = curl_exec($curl);
											$err = curl_error($curl);
											
											 // echo $response;
											// $data = json_decode($response, true);
											?>
											<div class= "form-group">
											<label for="inputExperience" class="col-sm-3 control-label">Provinsi</label>
											<div class="col-sm-9">
											<select class="form-control" name="provinsi" id="provinsi">
											<option>Pilih Provinsi</option>
											<?php 
											$data = json_decode($response, true);
											for ($i=0; $i < count($data['semuaprovinsi']); $i++) {
												?>
											<option value="<?=$data['semuaprovinsi'][$i]['id'];?>" <?php if($bio['provinsi']==$data['semuaprovinsi'][$i]['id']){ echo "selected";} ?>><?=$data['semuaprovinsi'][$i]['nama'];?></option>
											<?php 
											}
											?>
											</select>
											</div>
											</div>
											<?php
											$prov_id=$bio['provinsi'];
											$curl = curl_init();
											curl_setopt_array($curl, array(
												CURLOPT_URL => "http://dev.farizdotid.com/api/daerahindonesia/provinsi/$prov_id/kabupaten",
												CURLOPT_RETURNTRANSFER => true,
												CURLOPT_ENCODING => "",
												CURLOPT_MAXREDIRS => 10,
												CURLOPT_TIMEOUT => 30,
												CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
												CURLOPT_CUSTOMREQUEST => "GET",
											));

											$response = curl_exec($curl);
											$err = curl_error($curl);
											
											 // echo $response;
											// $data = json_decode($response, true);
											?>
											<div class="form-group">
												<label for="inputExperience" class="col-sm-3 control-label">Kabupaten</label>
												<div class="col-sm-9">
												<select class="form-control" id="kabupaten" name="kabupaten">
												<?php 
											$data = json_decode($response, true);
											for ($i=0; $i < count($data['kabupatens']); $i++) {
												?>
											<option value="<?=$data['kabupatens'][$i]['id'];?>" <?php if($bio['kabupaten']==$data['kabupatens'][$i]['id']){ echo "selected";} ?>><?=$data['kabupatens'][$i]['nama'];?></option>
											<?php 
											}
											?>
											</select>
												</div>
											</div>
											<?php
											$id_kab=$bio['kabupaten'];
											$curl = curl_init();
											curl_setopt_array($curl, array(
												CURLOPT_URL => "http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/$id_kab/kecamatan",
												CURLOPT_RETURNTRANSFER => true,
												CURLOPT_ENCODING => "",
												CURLOPT_MAXREDIRS => 10,
												CURLOPT_TIMEOUT => 30,
												CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
												CURLOPT_CUSTOMREQUEST => "GET",
											));

											$response = curl_exec($curl);
											$err = curl_error($curl);
											
											 // echo $response;
											// $data = json_decode($response, true);
											?>
											<div class="form-group">
												<label for="inputExperience" class="col-sm-3 control-label">Kecamatan</label>
												<div class="col-sm-9">
												<select class="form-control" id="kecamatan" name="kecamatan">
												<?php 
											$data = json_decode($response, true);
											for ($i=0; $i < count($data['kecamatans']); $i++) {
												?>
											<option value="<?=$data['kecamatans'][$i]['id'];?>" <?php if($bio['kecamatan']==$data['kecamatans'][$i]['id']){ echo "selected";} ?>><?=$data['kecamatans'][$i]['nama'];?></option>
											<?php 
											}
											?></select>
												</div>
											</div>
											<?php
											$id_kec=$bio['kecamatan'];
											$curl = curl_init();
											curl_setopt_array($curl, array(
												CURLOPT_URL => "http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/kecamatan/$id_kec/desa",
												CURLOPT_RETURNTRANSFER => true,
												CURLOPT_ENCODING => "",
												CURLOPT_MAXREDIRS => 10,
												CURLOPT_TIMEOUT => 30,
												CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
												CURLOPT_CUSTOMREQUEST => "GET",
											));

											$response = curl_exec($curl);
											$err = curl_error($curl);
											
											 // echo $response;
											// $data = json_decode($response, true);
											?>
											<div class="form-group">
												<label for="inputExperience" class="col-sm-3 control-label">Kelurahan</label>
												<div class="col-sm-9">
												<select class="form-control" id="kelurahan" name="kelurahan">
												<?php 
											$data = json_decode($response, true);
											for ($i=0; $i < count($data['desas']); $i++) {
												?>
											<option value="<?=$data['desas'][$i]['id'];?>" <?php if($bio['kelurahan']==$data['desas'][$i]['id']){ echo "selected";} ?>><?=$data['desas'][$i]['nama'];?></option>
											<?php 
											}
											?></select>
												</div>
											</div>
									</div>
								</div>
							</div>
						</div>

<script type="text/javascript">

	$(document).ready(function(){
		$('#provinsi').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var prov = $('#provinsi').val();
			
			$.ajax({
				type : 'GET',
				url : 'kabupaten.php',
				data :  'prov_id=' + prov,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kabupaten").html(data);
				}
			});
		});

		$('#kabupaten').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var kab = $('#kabupaten').val();
			
			$.ajax({
				type : 'GET',
				url : 'kecamatan.php',
				data :  'id_kabupaten=' + kab,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kecamatan").html(data);
				}
			});
		});

		$('#kecamatan').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var desa = $('#kecamatan').val();
			
			$.ajax({
				type : 'GET',
				url : 'desa.php',
				data :  'id_kecamatan=' + desa,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kelurahan").html(data);
					// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
				}
			});
		});
	});
	</script>
