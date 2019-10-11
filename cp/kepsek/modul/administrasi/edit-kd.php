<?php
include("../../../inc/db.php");
$idr=$_POST['rowid'];
$cek="SELECT * FROM kd WHERE id_kd='$idr'";
$hasil=mysqli_query($koneksi,$cek);
$utt=mysqli_fetch_array($hasil);
$idmp=$utt['mapel'];
$mpl=mysqli_fetch_array(mysqli_query($koneksi,"select * from mapel where id_mapel='$idmp'"));
?>
						<div class="modal-body">
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Kelas</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$utt['kelas'];?>" name="kelas" readonly=true>
								  <input type="hidden" id="id_kd" name="idkd" class="form-control" value="<?php echo $idr;?>">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Mata Pelajaran</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$mpl['nama_mapel'];?>" name="idmp" readonly=true>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nomor KD</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$utt['kd'];?>" name="kd">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Deskripsi</label>

								<div class="col-sm-9">
									<textarea id="example-textarea-input" id="deskripsi" name="deskripsi" rows="7" class="form-control"><?=$utt['nama_kd'];?></textarea>
								</div>
							</div>
						</div>