<?php
include("../../../inc/db.php");
$idr=$_POST['rowid'];
$cek="SELECT * FROM tema WHERE id_tema='$idr'";
$hasil=mysqli_query($koneksi,$cek);
$utt=mysqli_fetch_array($hasil);
?>
						<div class="modal-body">
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Tema</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$utt['tema'];?>" name="notema">
								  <input type="hidden" id="id_tema" name="idtema" class="form-control" value="<?php echo $idr;?>">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama tema</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$utt['nama_tema'];?>" name="namatema">
								</div>
							</div>
						</div>