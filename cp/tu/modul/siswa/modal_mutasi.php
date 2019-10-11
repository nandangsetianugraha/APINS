<?php
include("../../inc/db.php");
$idr=$_POST['rowid'];
$tapel=$_POST['tapel'];
$cek="SELECT * FROM siswa WHERE id='$idr'";
$hasil=mysqli_query($koneksi,$cek);
$utt=mysqli_fetch_array($hasil);
?>
						<div class="modal-body">
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" value="<?=$utt['nama'];?>" name="editnama" readonly=true>
								  <input type="hidden" name="idp" class="form-control" value="<?=$idr;?>">
								  <input type="hidden" name="tapel" class="form-control" value="<?=$tapel;?>">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Jenis Kelamin</label>

								<div class="col-sm-9">
								  <select class="form-control select2" name="mutasi" style="width: 100%;">
							  			<?php 
										$sql_mk=mysqli_query($koneksi, "select * from jns_mutasi");
										while($nk=mysqli_fetch_array($sql_mk)){
										?>
										<option value="<?=$nk['id_mutasi'];?>" <?php if($utt['status']==$nk['id_mutasi']) echo "selected"; ?>><?=$nk['nama_mutasi'];?></option>
										<?php };?>
									</select>
								</div>
							</div>
						</div>