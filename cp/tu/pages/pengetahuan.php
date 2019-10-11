<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
	$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 2;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
	$ab=substr($romb, 0, 1);
	
	if($smt==1){
		$tema=isset($_GET['tema']) ? $_GET['tema'] : '1';
	}else{
			if($ab>3){
			$tema=isset($_GET['tema']) ? $_GET['tema'] : '6';
		}else{
			$tema=isset($_GET['tema']) ? $_GET['tema'] : '5';
		};
	};
	$peta=3;
	$kd = isset($_GET['kd']) ? $_GET['kd'] : '0';										
	$sql_asp=mysqli_query($koneksi, "select * from aspek where kd_aspek='$peta'");
	$nama_asp=mysqli_fetch_array($sql_asp);
	$sqltema=mysqli_query($koneksi, "select * from tema where kelas='$ab' and smt='$smt'");
	$jtema=mysqli_num_rows($sqltema);
	$sqlkd=mysqli_query($koneksi, "select * from kd where kelas='$ab' and aspek='$peta' and mapel='$mpid'");
	$sql_mp=mysqli_query($koneksi, "select * from mapel where id_mapel='$mpid'");
	$nama_mp=mysqli_fetch_array($sql_mp);
	
?>
    <!-- Main content -->
    <section class="content">
		<div class="box box-primary">
			<div class="box-body">
				<form role="form" action="pengetahuan.php" method="GET">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<div class="form-group">
							<select class="form-control" name="mp" onchange="this.form.submit()">
							<?php 
							$sql2 = "select * from mapel";
							$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
							while($po=mysqli_fetch_array($qu3)){
								$idmp=$po['id_mapel'];
								if($idmp==1 or $idmp==10){
									
								}else{
									if($ab<4 and ($idmp==5 or $idmp==6)){
										
									}else{
										if($ab>3 and $idmp==8){
											
										}else{
							?>
								<option value="<?=$po['id_mapel'];?>" <?php if($po['id_mapel']==$mpid){echo "selected";}; ?>><?=$po['nama_mapel'];?></option>
							<?php };
							};
							};
							};?>
							</select>
							
						</div>
					</div>
					<div class="col-lg-3 col-xs-12">
						<div class="form-group">
							<?php if(($ab>3 and $mpid==8) or ($ab>3 and $mpid==4) or ($ab>3 and $mpid==9) or ($ab>3 and $mpid==10) or ($ab>3 and $mpid==11)){?>
							<select class="form-control" name="tema" onchange="this.form.submit()">
							<?php 
							$sql2 = "select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='$peta' and mapel='$mpid' group by tema order by tema asc";
					$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
					while($po=mysqli_fetch_array($qu3)){;
															?>
								<option value="<?=$po['tema'];?>" <?php if($po['tema']==$tema){echo "selected";} ?>>Pembelajaran <?=$po['tema'];?></option>
							<?php };?>
							</select>
							<?php }else{ ?>
							<select class="form-control" name="tema" onchange="this.form.submit()">
							<?php 
													$sql_tema=mysqli_query($koneksi, "select * from tema where kelas='$ab' and smt='$smt'");
													while($tmaku=mysqli_fetch_array($sql_tema)){
													?>
								<option value="<?=$tmaku['tema'];?>" <?php if($tmaku['tema']==$tema){echo "selected";} ?>>Tema <?=$tmaku['tema'];?></option>
							<?php };?>
							</select>
							<?php }; ?>
						</div>
					</div>
					<div class="col-lg-3 col-xs-12">
						<div class="form-group">
							<select class="form-control" name="kelas" onchange="this.form.submit()">
							<?php 
													$sql_mk=mysqli_query($koneksi, "select * from rombel where tapel='$tapel' order by nama_rombel asc");
													while($nk=mysqli_fetch_array($sql_mk)){
													?>
													<option value="<?=$nk['nama_rombel'];?>" <?php if($nk['nama_rombel']==$romb){echo "selected";}; ?>><?=$nk['nama_rombel'];?></option>
													<?php };?>
							</select>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-header">
              <h3 class="box-title"><?php 
								$mpm=mysqli_fetch_array(mysqli_query($koneksi, "select * from mapel where id_mapel='$mpid'"));
								?>
								Penilaian Aspek Pengetahuan <?=$mpm['nama_mapel'];?> Kelas <?=$romb;?> <?php if(($ab>3 and $mpid==8) or ($ab>3 and $mpid==4) or ($ab>3 and $mpid==9) or ($ab>3 and $mpid==10) or ($ab>3 and $mpid==11)){ ?> Pembelajaran <?php }else{ ?> Tema <?php }; ?> <?=$tema;?></h3>
			  <div class="box-tools pull-right">
				<form role="form" action="pengetahuan.php" method="GET">
				<div class="form-group">
					<input type="hidden" name="kelas" class="form-control" value="<?php echo $romb;?>">
					<input type="hidden" name="tapel" class="form-control" value="<?php echo $tapel;?>">
					<input type="hidden" name="smt" class="form-control" value="<?php echo $smt;?>">
					<input type="hidden" name="mp" class="form-control" value="<?php echo $mpid;?>">
					<input type="hidden" name="tema" class="form-control" value="<?php echo $tema;?>">
					<input type="hidden" name="peta" class="form-control" value="3">
					<?php 
											$tma1=mysqli_query($koneksi, "select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='$peta' and mapel='$mpid' group by nama_peta order by nama_peta asc");
											$jpet1=mysqli_num_rows($tma1);
											if($jpet1>0){
												$jpet=mysqli_num_rows($tma1);
												if($jpet>0){
											?>
					<select class="form-control" name="kd" onchange="this.form.submit()">
					<option value="">Pilih KD</option>
					<?php 
					$sql2 = "select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='$peta' and mapel='$mpid' group by nama_peta order by nama_peta asc";
					$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
					while($po=mysqli_fetch_array($qu3)){;
					?>
						<option value="<?=$po['nama_peta'];?>" <?php if($kd===$po['nama_peta']){echo "selected";}; ?>>KD <?=$po['nama_peta'];?></option>
					<?php };?>
					
					</select>
											<?php }}; ?>
				</div>
				</form>
              </div>
            </div>
			<div class="box-body">
				<div class="row">
					<div class="col-lg-9 col-xs-12">
						<?php 
											if(!empty($kd)){
						?>
						<table id="nilaiHarian" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
								<th>Nama Siswa</th>
									<th>Ulangan</th>
									<th>Tugas 1</th>
									<th>Tugas 2</th>
								</tr>
							</thead>
							<tbody>	
															
							</tbody>
						</table>
						<?php }else{ ?>
							<div class="callout callout-success">
								<h4>Silahkan Pilih KD</h4>
							</div>
						<?php }; ?>
					</div>
					<div class="col-lg-3 col-xs-12">
						<div class="box box-danger">
						<div class="box-header">
						  <h3 class="box-title">Bantuan</h3>
						</div>
						<div class="box-body">
						  Harian : Hasil Ulangan Harian berdasarkan KD yang telah dipetakan<br>
						  Tugas 1, Tugas 2 : Nilai Tugas yang diberikan pada KD yang dipetakan
						</div>
						<!-- /.box-body -->
						<!-- Loading (remove the following to stop the loading)-->
						
						<!-- end loading -->
					  </div>
					  <!-- /.box -->
					</div>
				</div>
				
				</div>
			</div>
		</div>
		
    </section>
    <!-- /.content -->
<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" class="init">
	var nK3;
	$(document).ready(function() {
		nK3 = $("#nilaiHarian").DataTable({
				"searching": false,
				"ajax": "../modul/harian/dataHarian.php?kelas=<?=$romb;?>&tapel=<?=$tapel;?>&smt=<?=$smt;?>&mp=<?=$mpid;?>&peta=3&kd=<?=$kd;?>&tema=<?=$tema;?>",
				"order": []
			});
	});
	function highlightEdit(editableObj) {
		$(editableObj).css("background","#FFF0000");
	} 
	function saveHarian(editableObj,column,id,kelas,smt,tapel,mpid,kd,jns,tema) {
		// no change change made then return false
		if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
		return false;
		// send ajax to update value
		$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
		$.ajax({
			url: "../modul/harian/saveHarian.php",
			cache: false,
			data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id+'&kelas='+kelas+'&smt='+smt+'&tapel='+tapel+'&mp='+mpid+'&kd='+kd+'&jns='+jns+'&tema='+tema,
			success: function(response)  {
				console.log(response);
				// set updated value as old value
				$(editableObj).attr('data-old_value',editableObj.innerHTML);
				$(editableObj).css("background","#FDFDFD");	
				Swal.fire({
										  position: 'center',
										  type: 'success',
										  title: 'Nilai berhasil disimpan',
										  showConfirmButton: false,
										  timer: 1500
										});
			}          
	   });
	}
</script>
</body>
</html>
