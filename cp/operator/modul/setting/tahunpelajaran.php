<?php
include("../../inc/db.php");
$idr=$_POST['rowid'];
$cek="SELECT * FROM konfigurasi WHERE id_conf='$idr'";
$hasil=mysqli_query($koneksi,$cek);
$utt=mysqli_fetch_array($hasil);
?>
						<div class="modal-body">
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Tahun Pelajaran</label>

								<div class="col-sm-9">
								  <select class="form-control" name="tapel" style="width: 100%;">
							  			<?php 
										$sql_tp=mysqli_query($koneksi, "select * from tapel order by id_tapel asc");
										while($np=mysqli_fetch_array($sql_tp)){
										?>
										<option value="<?=$np['nama_tapel'];?>" <?php if($utt['tapel']==$np['nama_tapel']) echo "selected"; ?>><?=$np['nama_tapel'];?></option>
										<?php };?>
									</select>
									<input type="hidden" name="idp" class="form-control" value="<?=$idr;?>">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Semester</label>

								<div class="col-sm-9">
									<select class="form-control select2" name="smt" style="width: 100%;">
							  			<option value="1" <?php if($utt['semester']==1) echo "selected"; ?>>Semester 1</option>
										<option value="2" <?php if($utt['semester']==2) echo "selected"; ?>>Semester 2</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Versi Aplikasi</label>

								<div class="col-sm-9">
									<input type="text" class="form-control" value="<?=$utt['versi'];?>" name="versi">
								</div>
							</div>
						</div>