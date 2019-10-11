<?php include "../inc/lte-head.php";?>
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
$kelas=isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<?php if(isset($_GET['kelas'])){ ?>
			<div class="col-lg-9 col-xs-12">
				<a href="../pages/rombel.php" type="button" class="btn"><i class="fa fa-plus"></i> Kembali</a>
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Daftar Siswa Kelas <?=$kelas;?></h3>
					  
					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-toggle="modal" data-toggle="modal" data-target="#penempatan"><i class="fa fa-plus"></i> Penempatan</button>
					  </div>
					</div>
					<div class="box-body table-responsive">
						<table id="manageMemberTable" class="table table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
												<th></th>
												<th class="text-center">NIS</th>
												<th class="text-center">NISN</th>
												<th class="text-center">Nama Siswa</th>
												<th class="text-center">Tempat Lahir</th>
												<th class="text-center">JK</th>
												<th>&nbsp;</th>
											</tr>
                                        </thead>
                                        <tbody>
										
                                        </tbody>
                                    </table>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Informasi Kelas</h3>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-bordered table-hover">
								<?php 
									$nwali=mysqli_fetch_array(mysqli_query($koneksi, "select * from rombel where nama_rombel='$kelas' and tapel='$tapel'"));
									$idg=$nwali['wali_kelas'];
									$sq2=mysqli_query($koneksi, "select * from penempatan JOIN siswa USING(peserta_didik_id) where siswa.jk='L' and penempatan.rombel='$kelas' and penempatan.tapel='$tapel'");
									$sq3=mysqli_query($koneksi, "select * from penempatan JOIN siswa USING(peserta_didik_id) where siswa.jk='P' and penempatan.rombel='$kelas' and penempatan.tapel='$tapel'");
									$juml=mysqli_num_rows($sq2);
									$jump=mysqli_num_rows($sq3);
									$nguru=mysqli_fetch_array(mysqli_query($koneksi, "select * from ptk where ptk_id='$idg'"));
								?>
                            <tbody>
								<tr>
									<td>Nama Kelas</td>
									<td><?=$kelas;?></td>
								</tr>
								<tr>
									<td>Wali Kelas</td>
									<td><?=$nguru['nama'];?></td>
								</tr>
								<tr>
									<td>Laki-Laki</td>
									<td><?=$juml;?></td>
								</tr>
								<tr>
									<td>Perempuan</td>
									<td><?=$jump;?></td>
								</tr>
                            </tbody>
                        </table>
					</div>
				</div>
			</div>
			<?php }else{ ?>
			<div class="col-lg-12 col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Daftar Rombel Tahun Pelajaran <?=$tapel;?></h3>
					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-toggle="modal" data-toggle="modal" data-target="#prombel"><i class="fa fa-plus"></i> Rombel</button>
					  </div>
					</div>
					<div class="box-body table-responsive">
						<table id="rombelTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
												<th class="text-center">Rombel</th>
												<th class="text-center">Kurikulum</th>
												<th class="text-center">Wali Kelas</th>
												<th>&nbsp;</th>
											</tr>
                                        </thead>
                                        <tbody>
										
                                        </tbody>
                                    </table>
					</div>
				</div>
			</div>
			
			<?php }; ?>
		</div>
	
	<!--Modal -->
		<div class="modal fade" id="penempatan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Daftar Siswa</h4>
              </div>
              <div class="modal-body">
				<table id="managePenempatan" class="table table-bordered table-hover">
									<thead>
									   <tr>
											<th>NIS</th>
											<th>NISN</th>
											<th>Nama Siswa</th>
											<th>TTL</th>
											<th>JK</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
			  </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		
		<!--Tambah Rombel-->
		<div class="modal fade" id="prombel">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Buat Rombel</h4>
              </div>
						<form class="form-horizontal" action="../modul/siswa/tambahwalikelas.php" autocomplete="off" method="POST" id="createWKForm">
                        <div class="modal-body">
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Tahun Pelajaran</label>
								<div class="col-sm-9">
								  <select class="form-control" name="tapel">
									<option value="2016/2017" <?php if($tpl_aktif==="2016/2017"){echo "selected";};?>>2016/2017</option>
									<option value="2017/2018" <?php if($tpl_aktif==="2017/2018"){echo "selected";};?>>2017/2018</option>
									<option value="2018/2019" <?php if($tpl_aktif==="2018/2019"){echo "selected";};?>>2018/2019</option>
									<option value="2019/2020" <?php if($tpl_aktif==="2019/2020"){echo "selected";};?>>2019/2020</option>
									<option value="2020/2021" <?php if($tpl_aktif==="2020/2021"){echo "selected";};?>>2020/2021</option>
									<option value="2021/2022" <?php if($tpl_aktif==="2021/2022"){echo "selected";};?>>2021/2022</option>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama Rombel</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" name="rombel">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Kurikulum</label>
								<div class="col-sm-9">
								  <select class="form-control" name="kurikulum">
									<option value="KTSP">KTSP</option>
									<option value="Kurikulum 2013">Kurikulum 2013</option>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Wali Kelas</label>
								<div class="col-sm-9">
								  <select class="form-control" name="walikelas">
								  <?php 
									$sql_mk=mysqli_query($koneksi, "select * from ptk");
									while($nk=mysqli_fetch_array($sql_mk)){
									?>
									<option value="<?=$nk['ptk_id'];?>"><?=$nk['nama'];?></option>
									<?php }; ?>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Pendamping</label>
								<div class="col-sm-9">
								  <select class="form-control" name="pendamping">
								  <?php 
									$sql_mk=mysqli_query($koneksi, "select * from ptk");
									while($nk=mysqli_fetch_array($sql_mk)){
									?>
									<option value="<?=$nk['ptk_id'];?>"><?=$nk['nama'];?></option>
									<?php }; ?>
								  </select>
								</div>
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
		
		
		
		<div class="modal fade" id="penempatanMemberModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tempatkan Siswa</h4>
              </div>
                        <form class="form" action="../modul/siswa/penempatansiswa.php" method="POST" id="penempatanMemberForm">
						<div class="modal-body">
							<div class="form-group">
								<label for="output-device">Nama Siswa</label>
								<input type="text" class="form-control" id="penempatannama" name="penempatannama" placeholder="Nama Lengkap" autocomplete=off>
							</div>
							<div class="form-group">
								<label for="output-device">Kelas</label>
								<input type="hidden" class="form-control" id="tapel" name="tapel" value="<?=$tpl_aktif;?>">
								<select id="kelas" class="form-control" size="1" name="kelas">
									<?php 
									$sql_mk=mysqli_query($koneksi, "select * from rombel where tapel='$tpl_aktif' order by nama_rombel asc");
									while($nk=mysqli_fetch_array($sql_mk)){
									?>
									<option value="<?php echo $nk['nama_rombel']; ?>" <?php if($kelas==$nk['nama_rombel']){echo "selected";} ?>>Kelas <?php echo $nk['nama_rombel']; ?></option>
									<?php };?>
								</select>
							</div>
                        </div>
                        <div class="modal-footer penempatanMemberModal">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Ya</button>
                        </div>
						</form>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<!--Delete Tema-->
		<div class="modal fade" id="outMemberModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Keluar Rombel</h4>
              </div>
                        <div class="modal-body">
							<p>Keluarkan Siswa dari Kelas <?=$kelas;?>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light" id="outBtn">Ya</button>
                        </div>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<!--Edit Rombel-->
		<div class="modal fade" id="editRombelModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Rombel</h4>
              </div>
                        <form class="form-horizontal" action="../modul/siswa/updaterombel.php" autocomplete="off" method="POST" id="updateRombelForm">
						<div class="modal-body editRombel">
							
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
		
		<!--Edit Siswa-->
		<div class="modal fade" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Siswa</h4>
              </div>
                        <form class="form-horizontal" action="../modul/siswa/updatesiswa.php" autocomplete="off" method="POST" id="updateSiswaForm">
						<div class="modal-body editSiswa">
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
	var manageMemberTable;
	var managePenempatan;
	var rombelTable;
	$(document).ready(function() {
		manageMemberTable = $("#manageMemberTable").DataTable({
			"ajax": "../modul/siswa/kelas.php?kelas=<?=$kelas;?>&smt=<?=$smt_aktif;?>&tapel=<?=$tpl_aktif;?>",
			"order": []
		});
		managePenempatan = $("#managePenempatan").DataTable({
			"ajax": "../modul/siswa/siswakosong.php?tapel=<?=$tpl_aktif;?>",
			"order": []
		});
		rombelTable = $("#rombelTable").DataTable({
			"ajax": "../modul/siswa/daftarrombel.php?tapel=<?=$tpl_aktif;?>",
			"order": []
		});
		$('#datepicker').datepicker({
		  autoclose: true
		});
		$("#createWKForm").unbind('submit').bind('submit', function() {
						// remove error messages
						$(".text-danger").remove();

						var form = $(this);

						// validation
						var rombel = $("#rombel").val();
						var tapel = $("#tapel").val();
						var kurikulum = $("#kurikulum").val();
						var walikelas = $("#walikelas").val();
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
										rombelTable.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
										$("#prombel").modal('hide');
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
			$("#updateRombelForm").unbind('submit').bind('submit', function() {
						// remove error messages
						$(".text-danger").remove();

						var form = $(this);

						// validation
						var rombel = $("#rombel").val();
						var tapel = $("#tapel").val();
						var kurikulum = $("#kurikulum").val();
						var walikelas = $("#walikelas").val();
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
										rombelTable.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
										$("#editRombelModal").modal('hide');
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
					$("#updateSiswaForm").unbind('submit').bind('submit', function() {
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
										manageMemberTable.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
										$("#myModal").modal('hide');
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
			$(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#editRombelModal").modal('show');
                $.post('../modul/siswa/editRombel.php',
                    {id:$(this).attr('data-id')},
                    function(html){
                        $(".editRombel").html(html);
                    }   
                );
            });
			$('#myModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : '../modul/siswa/editSiswa.php',
                data :  'rowid='+ rowid,
				beforeSend: function()
						{	
							$('.fetched-data').html('<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading…</span>');
						},
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
			

	});
	function penempatanMember(id = null) {
		if(id) {

			// remove the error 
			$(".form-group").removeClass('has-error').removeClass('has-success');
			$(".text-danger").remove();
			$("#penempatan").modal('hide');
			// remove the id
			$("#member_id").remove();

			// fetch the member data
			$.ajax({
				url: '../modul/siswa/lihatsiswa.php',
				type: 'post',
				data: {member_id : id},
				dataType: 'json',
				success:function(response) {
					$("#penempatannama").val(response.nama);

					// mmeber id 
					$(".penempatanMemberModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

					// here update the member data
					$("#penempatanMemberForm").unbind('submit').bind('submit', function() {
						// remove error messages
						$(".text-danger").remove();

						var form = $(this);

						// validation
						var kelas = $("#kelas").val();
						var tapel = $("#tapel").val();
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
										manageMemberTable.ajax.reload(null, false);
										managePenempatan.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
										$("#penempatanMemberModal").modal('hide');
										$("#penempatan").modal('show');
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

				} // /success
			}); // /fetch selected member info

		} else {
			alert("Error : Refresh the page again");
		}
	}
	function outMember(id = null) {
		if(id) {
			// click on remove button
			$("#outBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/siswa/outsiswa.php',
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
							manageMemberTable.ajax.reload(null, false);
							managePenempatan.ajax.reload(null, false);

							// close the modal
							$("#outMemberModal").modal('hide');

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
