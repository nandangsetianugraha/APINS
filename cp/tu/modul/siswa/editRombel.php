<?php
include("../../inc/db.php");
$idr=$_POST['id'];
$cek="select * from rombel where id_rombel='$idr'";
$hasil=mysqli_query($koneksi,$cek);
$utt=mysqli_fetch_array($hasil);
$tapel=$utt['tapel'];
$walinya=$utt['wali_kelas'];
$pendamping=$utt['pendamping'];
$kurikulum=$utt['kurikulum'];
?>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Tahun Pelajaran</label>
								<div class="col-sm-9">
									<input type="hidden" class="form-control" name="idrombel" value="<?=$idr;?>">
								  <select class="form-control" name="tapel">
									<option value="2016/2017" <?php if($tapel==="2016/2017"){echo "selected";};?>>2016/2017</option>
									<option value="2017/2018" <?php if($tapel==="2017/2018"){echo "selected";};?>>2017/2018</option>
									<option value="2018/2019" <?php if($tapel==="2018/2019"){echo "selected";};?>>2018/2019</option>
									<option value="2019/2020" <?php if($tapel==="2019/2020"){echo "selected";};?>>2019/2020</option>
									<option value="2020/2021" <?php if($tapel==="2020/2021"){echo "selected";};?>>2020/2021</option>
									<option value="2021/2022" <?php if($tapel==="2021/2022"){echo "selected";};?>>2021/2022</option>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama Rombel</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" name="rombel" value="<?=$utt['nama_rombel'];?>">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Kurikulum</label>
								<div class="col-sm-9">
								  <select class="form-control" name="kurikulum">
									<option value="KTSP" <?php if($kurikulum==="KTSP"){echo "selected";}; ?>>KTSP</option>
									<option value="Kurikulum 2013" <?php if($kurikulum==="Kurikulum 2013"){echo "selected";}; ?>>Kurikulum 2013</option>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Wali Kelas</label>
								<div class="col-sm-9">
								  <select class="form-control" name="walikelas">
									<option value="" <?php if (empty($walinya)){echo "selected";};?>>Belum Diisi</option>
								  <?php 
									$sql_mk=mysqli_query($koneksi, "select * from ptk");
									while($nk=mysqli_fetch_array($sql_mk)){
									?>
									<option value="<?=$nk['ptk_id'];?>" <?php if ($walinya==$nk['ptk_id']){echo "selected";};?>><?=$nk['nama'];?></option>
									<?php }; ?>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Pendamping</label>
								<div class="col-sm-9">
								  <select class="form-control" name="pendamping">
									<option value="" <?php if (empty($pendamping)){echo "selected";};?>>Belum Diisi</option>
								  <?php 
									$sql_mk=mysqli_query($koneksi, "select * from ptk");
									while($nk=mysqli_fetch_array($sql_mk)){
									?>
									<option value="<?=$nk['ptk_id'];?>" <?php if ($pendamping==$nk['ptk_id']){echo "selected";};?>><?=$nk['nama'];?></option>
									<?php }; ?>
								  </select>
								</div>
							</div>