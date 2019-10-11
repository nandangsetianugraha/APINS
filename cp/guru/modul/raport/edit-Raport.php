<?php
include("../../../inc/db.php");
$idr=$_POST['rowid'];
$cek="SELECT * FROM raport_k13 WHERE id_raport='$idr'";
$hasil=mysqli_query($koneksi,$cek);
$utt=mysqli_fetch_array($hasil);
$idsis=$utt['id_pd'];
$idmp=$utt['mapel'];
$nsiswa=mysqli_fetch_array(mysqli_query($koneksi,"select * from siswa where peserta_didik_id='$idsis'"));
$nmp=mysqli_fetch_array(mysqli_query($koneksi,"select * from mapel where id_mapel='$idmp'"));
?>
						<div class="modal-body">
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$nsiswa['nama'];?>" name="nama" readonly=true>
								  <input type="hidden" id="id_raport" name="idraport" class="form-control" value="<?php echo $utt['id_raport'];?>">
								  <input type="hidden" id="idsiswa" name="ids" class="form-control" value="<?php echo $nsiswa['peserta_didik_id'];?>">
								  <input type="hidden" id="kelas" name="kelas" class="form-control" value="<?php echo $utt['kelas'];?>">
								  <input type="hidden" id="smt" name="smt" class="form-control" value="<?php echo $utt['smt'];?>">
								  <input type="hidden" id="tapel" name="tapel" class="form-control" value="<?php echo $utt['tapel'];?>">
								  <input type="hidden" id="kelas" name="kelas" class="form-control" value="<?php echo $utt['kelas'];?>">
								  <input type="hidden" id="mapel" name="mapel" class="form-control" value="<?php echo $utt['mapel'];?>">
								  <input type="hidden" id="jns" name="jns" class="form-control" value="<?php echo $utt['jns'];?>">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Mata Pelajaran</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$nmp['nama_mapel'];?>" name="mp" readonly=true>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nilai</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=number_format($utt['nilai'],0);?>" name="nilai">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Predikat</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$utt['predikat'];?>" name="predikat">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Deskripsi Raport</label>

								<div class="col-sm-9">
									<textarea id="example-textarea-input" id="deskripsi" name="deskripsi" rows="7" class="form-control"><?=$utt['deskripsi'];?></textarea>
								</div>
							</div>
						</div>