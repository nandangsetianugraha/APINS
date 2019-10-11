<?php
include("../../inc/db.php");
$idr=$_POST['rowid'];
$hari=$_POST['hari'];
$utt=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM id_pegawai WHERE pegawai_id='$idr'"));
$idpeg=$utt['ptk_id'];
$ntt=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM ptk WHERE ptk_id='$idpeg'"));
?>
						<div class="modal-body">
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$ntt['nama'];?>" name="editnama" readonly=true>
								  <input type="text" class="form-control" value="<?=$hari;?>" name="edithari" readonly=true>
								  <input type="hidden" name="idp" class="form-control" value="<?=$idr;?>">
								  <input type="hidden" name="hari" class="form-control" value="<?=$hari;?>">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Status</label>

								<div class="col-sm-9">
								  <select class="form-control" name="status">
									<option value="">Pilih Status</option>
									<option value="I">Ijin</option>
									<option value="S">Sakit</option>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Keterangan</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" name="keterangan">
								</div>
							</div>
						</div>