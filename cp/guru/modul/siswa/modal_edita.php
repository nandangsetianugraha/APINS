<?php
include("../../inc/db.php");
$idr=$_POST['rowid'];
$cek="SELECT * FROM siswa WHERE id='$idr'";
$hasil=mysqli_query($koneksi,$cek);
$bio=mysqli_fetch_array($hasil);
$ids=$bio['peserta_didik_id'];
?>
						<div class="modal-body">
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
								<label for="inputExperience" class="col-sm-3 control-label">Provinsi</label>

								<div class="col-sm-9">
								  <select id="provinsi" class="form-control" name="provinsi" style="width: 100%;">
							  			<option value="0" <?php if($bio['provinsi']==0 || empty($bio['provinsi'])) echo "selected"; ?>>Belum Diisi</option>
										<?php 
										$sql_mk=mysqli_query($koneksi, "SELECT * FROM provinsi ORDER BY id_provinsi");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option value="<?=$nk['id_provinsi'];?>" <?php if($bio['provinsi']==$nk['id_provinsi']) echo "selected"; ?>><?=$nk['nama_provinsi'];?></option>
										<?php };?>
									</select>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Kabupaten</label>

								<div class="col-sm-9">
								  <select id="kabupaten" class="form-control select2" name="kabupaten" style="width: 100%;">
							  			<option value="0" <?php if($bio['kabupaten']==0 || empty($bio['kabupaten'])) echo "selected"; ?>>Belum Diisi</option>
										<?php 
										$sql_mk=mysqli_query($koneksi, "SELECT * FROM kabupaten INNER JOIN provinsi ON kabupaten.id_provinsi_fk = provinsi.id_provinsi ORDER BY nama_kabupaten");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option id="kabupaten" class="<?=$nk['id_provinsi'];?>" value="<?=$nk['id_kabupaten'];?>" ><?=$nk['nama_kabupaten'];?></option>
										<?php };?>
									</select>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Kecamatan</label>

								<div class="col-sm-9">
								  <select id="kecamatan" class="form-control select2" name="kecamatan" style="width: 100%;">
							  			<option value="0" <?php if($bio['kecamatan']==0 || empty($bio['kecamatan'])) echo "selected"; ?>>Belum Diisi</option>
										<?php 
										$sql_mk=mysqli_query($koneksi, "SELECT * FROM kecamatan INNER JOIN kabupaten ON kecamatan.id_kota_fk = kabupaten.id_kabupaten ORDER BY nama_kecamatan");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option id="kecamatan" class="<?$nk['id_kabupaten'];?>" value="<?=$nk['id_kecamatan'];?>"><?=$nk['nama_kecamatan'];?></option>
										<?php };?>
									</select>
								</div>
							  </div>
							  
							  
                        </div>
<script src="../../../dist/js/jquery-chained.min.js"></script>
<script src="../../../dist/js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#kabupaten").chained("#provinsi");
                $("#kecamatan").chained("#kabupaten");
            });
        </script>