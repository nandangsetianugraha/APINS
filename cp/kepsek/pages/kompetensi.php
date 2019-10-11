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
				<form class="form-horizontal" action="kompetensi.php" method="GET">
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
				<form class="form-horizontal" action="kompetensi.php" method="GET">
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
					  <h3 class="box-title">KD Pengetahuan <?=$mpm['nama_mapel'];?> Kelas <?=$romb;?></h3>
					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#tambahKD" title="Contacts" id="addKDModalBtn"><i class="fa fa-plus"></i> KD</button>
					  </div>
					</div>
					<div class="box-body">
						<table id="KDTable" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
									<th>KD</th>
									<th>Deskripsi</th>
									<th></th>
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
					  <h3 class="box-title">KD Ketrampilan <?=$mpm['nama_mapel'];?> Kelas <?=$romb;?></h3>
					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#tambahKDk" title="Contacts" id="addKDModalBtnk"><i class="fa fa-plus"></i> KD</button>
				      </div>
					</div>
					<div class="box-body">
						<table id="KDTablek" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
									<th>KD</th>
									<th>Deskripsi</th>
									<th></th>
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
              <form class="form" action="../modul/administrasi/tambahKD.php" method="POST" id="createKDForm">
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
							  <label for="output-device">Kompetensi Dasar</label>
							  <input id="kd" name="kd" autocomplete=off type="text" class="form-control" value="3.">
							  <input type="hidden" id="aspek" name="aspek" class="form-control" value="3">
							</div>
							<div class="form-group">
							  <span class="form-label">Deskripsi</span>
							  <textarea id="example-textarea-input" id="deskripsi" name="deskripsi" rows="7" class="form-control" placeholder="Deskripsi KD.."></textarea>
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Simpan</button>
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
              <form class="form" action="../modul/administrasi/tambahKD.php" method="POST" id="createKDFormk">
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
							  <label for="output-device">Kompetensi Dasar</label>
							  <input id="kd" name="kd" autocomplete=off type="text" class="form-control" value="4.">
							  <input type="hidden" id="aspek" name="aspek" class="form-control" value="4">
							</div>
							<div class="form-group">
							  <span class="form-label">Deskripsi</span>
							  <textarea id="example-textarea-input" id="deskripsi" name="deskripsi" rows="7" class="form-control" placeholder="Deskripsi KD.."></textarea>
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Simpan</button>
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
							<p>Hapus KD ini dari Kelas <?=$ab;?>?</p>
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
		
		<!--Edit KD Pengetahuan-->
		<div class="modal fade" id="editKD">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Kompetensi Dasar</h4>
              </div>
                        <form class="form-horizontal" action="../modul/administrasi/updateKD.php" autocomplete="off" method="POST" id="updateKDForm">
						<div class="modal-body eKD">
							<div class="fetched-data"></div>
						</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Update</button>
                        </div>
						</form>
						
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
	var KDTable;
	var KDTablek;
	$(document).ready(function() {
		KDTable = $('#KDTable').DataTable( {
			"searching": false,
			"ajax": "../modul/administrasi/daftarKD.php?kelas=<?=$romb;?>&aspek=3&mp=<?=$mpid;?>",
			"order": []
		} );
		KDTablek = $('#KDTablek').DataTable( {
			"searching": false,
			"ajax": "../modul/administrasi/daftarKD.php?kelas=<?=$romb;?>&aspek=4&mp=<?=$mpid;?>",
			"order": []
		} );
		$("#addKDModalBtn").on('click', function() {
			// reset the form 
			$("#createKDForm")[0].reset();
			
			// submit form
			$("#createKDForm").unbind('submit').bind('submit', function() {

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
								$("#tambahKD").modal('hide');

								// reload the datatables
								KDTable.ajax.reload(null, false);
								$("#createKDForm")[0].reset();
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
		$("#addKDModalBtnk").on('click', function() {
			// reset the form 
			$("#createKDFormk")[0].reset();
			
			// submit form
			$("#createKDFormk").unbind('submit').bind('submit', function() {

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
								KDTablek.ajax.reload(null, false);
								$("#createKDFormk")[0].reset();
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
		
		//edit KD
		$('#editKD').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
			//menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : '../modul/administrasi/edit-kd.php',
                data :  'rowid='+ rowid,
				beforeSend: function()
						{	
							$(".fetched-data").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...');
						},
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
		 //Update Tema 
		 $("#updateKDForm").unbind('submit').bind('submit', function() {
						// remove error messages
						$(".text-danger").remove();

						var form = $(this);

							$.ajax({
								url: form.attr('action'),
								type: form.attr('method'),
								data: form.serialize(),
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

										// reload the datatables
										KDTable.ajax.reload(null, false);
										KDTablek.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
										$("#editKD").modal('hide');
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
								} // /success
							}); // /ajax

						return false;
					});

	});
	function removeKD(id = null) {
		if(id) {
			// click on remove button
			$("#removeBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/administrasi/hapusKD.php',
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
							KDTable.ajax.reload(null, false);
							KDTablek.ajax.reload(null, false);

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
