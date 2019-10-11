<?php
include("../../../inc/db.php");
$idr=$_POST['rowid'];
$cek="SELECT * FROM deskripsi_k13 WHERE id_raport='$idr'";
$hasil=mysqli_query($koneksi,$cek);
$utt=mysqli_fetch_array($hasil);
$idsis=$utt['id_pd'];
$nsiswa=mysqli_fetch_array(mysqli_query($koneksi,"select * from siswa where peserta_didik_id='$idsis'"));
?>
						<div class="modal-body">
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$nsiswa['nama'];?>" name="nama" readonly=true>
								  <input type="hidden" id="id_raport" name="idraport" class="form-control" value="<?php echo $utt['id_raport'];?>">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Deskripsi Sikap Spiritual</label>

								<div class="col-sm-9">
									<textarea id="example-textarea-input" id="deskripsi" name="deskripsi" rows="7" class="form-control"><?=$utt['deskripsi'];?></textarea>
								</div>
							</div>
						</div>