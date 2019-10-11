<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
$tema=isset($_GET['tema']) ? $_GET['tema'] : '1';
if($level==96){ //guru pai
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 1;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : 1;
}elseif($level==95){ //guru penjas
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 8;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : 1;
}elseif($level==94){ //guru bahasa inggris
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 10;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : 1;
}else{
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 2;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : $ab;
};
$ab=substr($romb,0,1);
$mpm=mysqli_fetch_array(mysqli_query($koneksi, "select * from mapel where id_mapel='$mpid'"));
?>

    <!-- Main content -->
    <section class="content">
		<?php if($level==98 or $level==97){ ?>
				<form class="form-horizontal" action="pemetaan.php" method="GET">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Mata Pelajaran</label>
					<input type="hidden" name="kelas" class="form-control" value="<?php echo $ab;?>">
					<input type="hidden" name="tapel" class="form-control" value="<?php echo $tapel;?>">
					<input type="hidden" name="smt" class="form-control" value="<?php echo $smt;?>">
					<input type="hidden" name="peta" class="form-control" value="3">
					<div class="col-sm-10">
					<select class="form-control" name="mp" onchange="this.form.submit()">
					<?php 
					$sql2 = "select * from mapel";
					$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
					while($po=mysqli_fetch_array($qu3)){;
					?>
						<option value="<?=$po['id_mapel'];?>" <?php if($po['id_mapel']==$mpid){echo "selected";}; ?>><?=$po['nama_mapel'];?></option>
					<?php };?>
					</select>
					</div>
				</div>
				</form>
		<?php }else{ ?>
				<form class="form-horizontal" action="pemetaan.php" method="GET">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>
					<input type="hidden" name="tapel" class="form-control" value="<?php echo $tapel;?>">
					<input type="hidden" name="smt" class="form-control" value="<?php echo $smt;?>">
					<input type="hidden" name="peta" class="form-control" value="3">
					<input type="hidden" name="mp" class="form-control" value="<?=$mpid;?>">
					<div class="col-sm-10">
					<select class="form-control" name="kelas" onchange="this.form.submit()">
					<?php 
					for($i = 1; $i < 7; $i++) {
					?>
						<option value="<?=$i;?>" <?php if($i==$romb){echo "selected";}; ?>>Kelas <?=$i;?></option>
					<?php };?>
					</select>
					</div>
				</div>
				</form>
		<?php };?>
		<div class="row">
			<div class="col-lg-6 col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Pemetaan KD Pengetahuan <?=$mpm['nama_mapel'];?> Kelas <?=$romb;?></h3>
					  <div class="box-tools pull-right">
						
					  </div>
					</div>
					<div class="box-body">
						<button type="button" class="btn btn-effect-ripple btn-xs btn-success" data-toggle="modal" data-target="#tambahKD" id="addKDModalBtn"><i class="fa fa-plus"></i> Pemetaan</button>
						<table id="petaTable" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
									<th>Tema/PB</th>
									<th>Pemetaan</th>
								</tr>
							</thead>
							<tbody>	
															
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Pemetaan KD Ketrampilan <?=$mpm['nama_mapel'];?> Kelas <?=$romb;?></h3>
					  <div class="box-tools pull-right">
						
				      </div>
					</div>
					<div class="box-body">
						<button type="button" class="btn btn-effect-ripple btn-xs btn-success" data-toggle="modal" data-target="#tambahKDk" id="addKDModalBtnk"><i class="fa fa-plus"></i> Pemetaan</button>
						<table id="petaTablek" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
									<th>Tema/PB</th>
									<th>Pemetaan</th>
								</tr>
							</thead>
							<tbody>	
															
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	
	<!--Modal -->
		<div class="modal fade" id="tambahKD">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">KD Pengetahuan</h4>
              </div>
              <form class="form" action="../modul/administrasi/tambahpeta.php" method="POST" id="createPetaForm">
                        <div class="modal-body">
							<div class="form-group">
							  <label for="input-device">Kelas</label>
							  <input type="hidden" id="kelas" name="kelas" class="form-control" value="<?php echo $ab;?>">
							  <p class="form-control-static">Kelas <?php echo $ab;?></p>
							</div>
							<div class="form-group">
								<span class="form-label">Mata Pelajaran</span>
								<input type="hidden" id="mapel" name="mapel" class="form-control" value="<?php echo $mpid;?>">
								<?php 
								$sql_mp=mysqli_query($koneksi, "select * from mapel where id_mapel='$mpid'");
								$nmp=mysqli_fetch_array($sql_mp);
								?>
								<p class="form-control-static"><?php echo $nmp['nama_mapel'];?></p>
							</div>
							<div class="form-group">
							  <label for="output-device">Semester</label>
							  <input type="hidden" id="smt" name="smt" class="form-control" value="<?php echo $smt_aktif;?>">
							  <p class="form-control-static">Semester <?php echo $smt_aktif;?></p>
							</div>
							<?php if($mpid==1 or ($mpid==4 and $ab>3) or ($mpid==8 and $ab>3) or $mpid==9 or $mpid==10 or $mpid==11 or $mpid==12){ ?>
							<?php 
							$sqap1=mysqli_query($koneksi, "select * from kd where kelas='$romb' and aspek='3' and mapel='$mpid'"); 
							$cekd1=mysqli_num_rows($sqap1);
							if($cekd1>0){
							?>
							<div class="form-group">
								<label for="output-device">Pembelajaran</label>
								<input type="text" id="temaku" name="temaku" class="form-control" autocomplete=false>
							</div>
							<?php }; ?>
							<?php }else{ ?>
							<div class="form-group">
								<label for="output-device">Tema</label>
								<select class="form-control" name="temaku" id="temaku" data-placeholder="Pilih Tema">
									<?php 
											$sql_tema=mysqli_query($koneksi, "select * from tema where kelas='$romb' and smt='$smt_aktif' order by tema asc");
											while($tma=mysqli_fetch_array($sql_tema)){
											?>
											<option value="<?=$tma['tema'];?>"><?=$tma['tema'];?>. <?=$tma['nama_tema'];?></option>
											<?php } ?>
								</select>
							</div>
							<?php }; ?>
							<div class="form-group">
							  <span class="form-label">Kompetensi Dasar</span>
							  <input type="hidden" id="aspek" name="aspek" class="form-control" value="3">
							  <?php 
							  $sqap=mysqli_query($koneksi, "select * from kd where kelas='$romb' and aspek='3' and mapel='$mpid'"); 
							  $cekd=mysqli_num_rows($sqap);
							  if($cekd>0){
							  ?>
								<select class="form-control select2" name="kd" data-placeholder="Pilih KD" style="width: 100%;">
								<?php while($apk=mysqli_fetch_array($sqap)){ ?>
								<option value="<?=$apk['kd'];?>"><?=$apk['kd'];?></option>
								<?php }; ?>
								</select>
							  <?php }else{ ?>
							    <p class="form-control-static">Belum ada Kompetensi Dasar</p>
							  <?php }; ?>
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
							<?php if($cekd>0){ ?>
                            <button id="simpan" type="submit" class="btn btn-danger waves-effect waves-light">Simpan</button>
							<?php };?>
                        </div>
						</form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<div class="modal fade" id="tambahKDk">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">KD Ketrampilan</h4>
              </div>
              <form class="form" action="../modul/administrasi/tambahpeta.php" method="POST" id="createPetaFormk">
                        <div class="modal-body">
							<div class="form-group">
							  <label for="input-device">Kelas</label>
							  <input type="hidden" id="kelas" name="kelas" class="form-control" value="<?php echo $romb;?>">
							  <p class="form-control-static">Kelas <?php echo $romb;?></p>
							</div>
							<div class="form-group">
								<span class="form-label">Mata Pelajaran</span>
								<input type="hidden" id="mapel" name="mapel" class="form-control" value="<?php echo $mpid;?>">
								<?php 
								$sql_mp=mysqli_query($koneksi, "select * from mapel where id_mapel='$mpid'");
								$nmp=mysqli_fetch_array($sql_mp);
								?>
								<p class="form-control-static"><?php echo $nmp['nama_mapel'];?></p>
							</div>
							<div class="form-group">
							  <label for="output-device">Semester</label>
							  <input type="hidden" id="smt" name="smt" class="form-control" value="<?php echo $smt_aktif;?>">
							  <p class="form-control-static">Semester <?php echo $smt_aktif;?></p>
							</div>
							<?php if($mpid==1 or ($mpid==4 and $ab>3) or ($mpid==8 and $ab>3) or $mpid==9 or $mpid==10 or $mpid==11 or $mpid==12){ ?>
							<?php 
							$sqap1=mysqli_query($koneksi, "select * from kd where kelas='$romb' and aspek='4' and mapel='$mpid'"); 
							$cekd1=mysqli_num_rows($sqap1);
							if($cekd1>0){
							?>
							<div class="form-group">
								<label for="output-device">Pembelajaran</label>
								<input type="text" id="temaku" name="temaku" class="form-control" autocomplete=false>
							</div>
							<?php }; ?>
							<?php }else{ ?>
							<div class="form-group">
								<label for="output-device">Tema</label>
								<select class="form-control" name="temaku" id="temaku" data-placeholder="Pilih Tema">
									<?php 
											$sql_tema=mysqli_query($koneksi, "select * from tema where kelas='$romb' and smt='$smt_aktif' order by tema asc");
											while($tma=mysqli_fetch_array($sql_tema)){
											?>
											<option value="<?=$tma['tema'];?>"><?=$tma['tema'];?>. <?=$tma['nama_tema'];?></option>
											<?php } ?>
								</select>
							</div>
							<?php }; ?>
							<div class="form-group">
							  <span class="form-label">Kompetensi Dasar</span>
							  <input type="hidden" id="aspek" name="aspek" class="form-control" value="4">
							  <?php 
							  $sqap=mysqli_query($koneksi, "select * from kd where kelas='$romb' and aspek='4' and mapel='$mpid'"); 
							  $cekd=mysqli_num_rows($sqap);
							  if($cekd>0){
							  ?>
							    <select class="form-control select2" name="kd" data-placeholder="Pilih KD" style="width: 100%;">
								<?php while($apk=mysqli_fetch_array($sqap)){ ?>
								<option value="<?=$apk['kd'];?>">4.<?=$apk['kd'];?></option>
								<?php }; ?>
								</select>
							  <?php }else{ ?>
							    <p class="form-control-static">Belum ada Kompetensi Dasar</p>
							  <?php }; ?>
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
							<?php if($cekd>0){ ?>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Simpan</button>
							<?php }; ?>
                        </div>
						</form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<!--Delete KD-->
		<div class="modal fade" id="removeKDModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus</h4>
              </div>
                        <div class="modal-body">
							<p>Hapus Pemetaan ini dari Kelas <?=$ab;?>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light" id="removeBtn">Ya</button>
                        </div>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	
    </section>
    <!-- /.content -->
<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
	var petaTable;
	var petaTablek;
	$(document).ready(function() {
	    $('.select2').select2();
		petaTable = $('#petaTable').DataTable( {
			"searching": false,
			"ajax": "../modul/administrasi/petaKD.php?kelas=<?=$romb;?>&smt=<?=$smt_aktif;?>&peta=3&mp=<?=$mpid;?>",
			"order": []
		} );
		petaTablek = $('#petaTablek').DataTable( {
			"searching": false,
			"ajax": "../modul/administrasi/petaKD.php?kelas=<?=$romb;?>&smt=<?=$smt_aktif;?>&peta=4&mp=<?=$mpid;?>",
			"order": []
		} );
		$("#addKDModalBtn").on('click', function() {
			// reset the form 
			$("#createPetaForm")[0].reset();
			
			// submit form
			$("#createPetaForm").unbind('submit').bind('submit', function() {

				$(".text-danger").remove();

				var form = $(this);

				

					//submi the form to server
					$.ajax({
						url : form.attr('action'),
						type : form.attr('method'),
						data : form.serialize(),
						dataType : 'json',
						beforeSend: function()
						{	
							$("#simpan").html('<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading…</span>');
						},
						success:function(response) {

							// remove the error 
							$(".form-group").removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								$.amaran({
									'theme'     :'awesome ok',
									'content'   :{
										title:'Sukses!',
										message:response.messages,
										info:'',
										icon:'fa fa-check-square-o'
									},
									'position'  :'bottom right',
									'outEffect' :'slideBottom'
								});

								// reset the form
								$("#tambahKD").modal('hide');

								// reload the datatables
								petaTable.ajax.reload(null, false);
								$("#createPetaForm")[0].reset();
								// this function is built in function of datatables;

							} else {
								$.amaran({
									'theme'     :'awesome error',
									'content'   :{
										title:'Sukses!',
										message:response.messages,
										info:'',
										icon:'fa fa-check-square-o'
									},
									'position'  :'bottom right',
									'outEffect' :'slideBottom'
								});
								$("#simpan").html('Simpan');
							}  // /else
								$("#simpan").html('Simpan');
						} // success  
					}); // ajax subit 				
				


				return false;
			}); // /submit form for create member
		}); // /add modal
		$("#addKDModalBtnk").on('click', function() {
			// reset the form 
			$("#createPetaFormk")[0].reset();
			
			// submit form
			$("#createPetaFormk").unbind('submit').bind('submit', function() {

				$(".text-danger").remove();

				var form = $(this);

				

					//submi the form to server
					$.ajax({
						url : form.attr('action'),
						type : form.attr('method'),
						data : form.serialize(),
						dataType : 'json',
						success:function(response) {

							// remove the error 
							$(".form-group").removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								$.amaran({
									'theme'     :'awesome ok',
									'content'   :{
										title:'Sukses!',
										message:response.messages,
										info:'',
										icon:'fa fa-check-square-o'
									},
									'position'  :'bottom right',
									'outEffect' :'slideBottom'
								});

								// reset the form
								$("#tambahKDk").modal('hide');

								// reload the datatables
								petaTablek.ajax.reload(null, false);
								$("#createPetaFormk")[0].reset();
								// this function is built in function of datatables;

							} else {
								$.amaran({
									'theme'     :'awesome error',
									'content'   :{
										title:'Sukses!',
										message:response.messages,
										info:'',
										icon:'fa fa-check-square-o'
									},
									'position'  :'bottom right',
									'outEffect' :'slideBottom'
								});
							}  // /else
						} // success  
					}); // ajax subit 				
				


				return false;
			}); // /submit form for create member
		}); // /add modal

	});
	function removeKD(id = null) {
		if(id) {
			// click on remove button
			$("#removeBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/administrasi/hapuspeta.php',
					type: 'post',
					data: {member_id : id},
					dataType: 'json',
					success:function(response) {
						if(response.success == true) {						
							$.amaran({
									'theme'     :'awesome ok',
									'content'   :{
										title:'Sukses!',
										message:response.messages,
										info:'',
										icon:'fa fa-check-square-o'
									},
									'position'  :'bottom right',
									'outEffect' :'slideBottom'
								});

							// refresh the table
							petaTable.ajax.reload(null, false);
							petaTablek.ajax.reload(null, false);

							// close the modal
							$("#removeKDModal").modal('hide');

						} else {
							$.amaran({
									'theme'     :'awesome error',
									'content'   :{
										title:'Sukses!',
										message:response.messages,
										info:'',
										icon:'fa fa-check-square-o'
									},
									'position'  :'bottom right',
									'outEffect' :'slideBottom'
								});
						}
					}
				});
			}); // click remove btn
		} else {
			alert('Error: Refresh the page again');
		}
	}
</script>
</body>
</html>
