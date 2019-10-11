<?php
include("../../inc/db.php");
$idr=$_POST['rowid'];
$cek="SELECT * FROM siswa WHERE id='$idr'";
$hasil=mysqli_query($koneksi,$cek);
$utt=mysqli_fetch_array($hasil);
?>
						<div class="modal-body">
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$utt['nama'];?>" name="editnama" readonly=true>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Jenis Kelamin</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$utt['jk'];?>" name="editjk" readonly=true>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Tempat Tanggal Lahir</label>

								<div class="col-sm-5">
								  <input type="text" class="form-control" value="<?=$utt['tempat'];?>" name="edittempat">
								</div>
								<div class="col-sm-4">
								  <input type="text" class="form-control" value="<?=$utt['tanggal'];?>" name="edittanggal">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">NIK</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$utt['nik'];?>" name="editnik">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">NIS</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$utt['nis'];?>" name="editnis">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">NISN</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$utt['nisn'];?>" name="editnisn" readonly=true>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Alamat</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$utt['alamat'];?>" name="editalamat">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama Ayah</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$utt['nama_ayah'];?>" name="editayah">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama Ibu</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$utt['nama_ibu'];?>" name="editibu">
								</div>
							</div>
                        </div>