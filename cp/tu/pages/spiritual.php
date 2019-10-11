<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
$peta=1;
$sql_asp=mysqli_query($koneksi, "select * from aspek where kd_aspek='$peta'");
$nama_asp=mysqli_fetch_array($sql_asp);
?>

    <!-- Main content -->
    <section class="content">
		<div class="box box-primary">
			<div class="box-header">
              <h3 class="box-title">Penilaian Sikap Spiritual Kelas <?=$romb;?></h3>
			  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#tambahNilai" id="addNilaiModalBtn"><i class="fa fa-plus"></i> Spiritual</button>
					  </div>
            </div>
			<div class="box-body">
				<div class="row">
					<div class="col-lg-8 col-xs-12">
						<table id="sosTable" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
                                            <tr>
												<th class="text-center">Nama Siswa</th>
												<th class="text-center">Catatan Perilaku</th>
												<th class="text-center">Butir Sikap</th>
												<th class="text-center">&nbsp;</th>
											</tr>
                                        </thead>
							<tbody>	
															
							</tbody>
						</table>
					</div>
					<div class="col-lg-4 col-xs-12">
						<div class="box box-danger">
						<div class="box-header">
						  <h3 class="box-title">Bantuan</h3>
						</div>
						<div class="box-body">
							<form class="form" action="spiritual.php" method="GET">
									<div class="row show-grid">
										<div class="col-md-4">
											<div class="form-group">
												<label>Kelas</label>
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
									<table class="table table-bordered table-hover table-responsive no-padding">
									<thead>
										<tr>
											<th>Sikap</th>
											<th>Indikator</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Ketaatan Beribadah</td>
											<td>
												<ul>
													<li>perilaku patuh dalam melaksanakan ajaran agama yang dianutnya</li>
													<li>mau mengajak teman seagamnya untuk melakukan ibadah bersama</li>
													<li>mengikuti kegiatan keagamaan yang diselenggarakan sekolah</li>
													<li>melaksanakan ibadah sesuai ajaran agama, misalnya: shalat, puasa</li>
													<li>merayakan hari besar agama</li>
													<li>melaksanakan ibadah tepat waktu</li>
												</ul>
											</td>
										</tr>
										<tr>
											<td>Berprilaku Syukur</td>
											<td>
												<ul>
													<li>mengakui kebesaran Tuhan dalam menciptakan alam semesta</li>
													<li>menjaga kelestarian alam, tidak merusak tanaman</li>
													<li>tidak mengeluh</li>
													<li>selalu merasa gembira dalam segala hal</li>
													<li>tidak berkecil hati dengan keadaannya</li>
													<li>suka memberi atau menolong sesama</li>
													<li>selalu berterima kasih bila menerima pertolongan</li>
													<li>menerima perbedaan karakteristik sebagai anugerah Tuhan</li>
													<li>selalu menerima penugasan dengan sikap terbuka</li>
													<li>berterima kasih atas pemberian orang lain</li>
												</ul>
											</td>
										</tr>
										<tr>
											<td>Berdoa sebelum dan sesudah melakukan kegiatan</td>
											<td>
												<ul>
													<li>berdoa sebelum dan sesudah belajar</li>
													<li>berdoa sebelum dan sesudah makan</li>
													<li>mengajak teman berdoa saat memulai kegiatan</li>
													<li>mengingatkan teman untuk selalu berdoa</li>
												</ul>
											</td>
										</tr>
										<tr>
											<td>Toleransi dalam beribadah</td>
											<td>
												<ul>
													<li>tindakan yang menghargai perbedaan dalam beribadah</li>
													<li>menghormati teman yang berbeda agama</li>
													<li>bertemen tanpa membedakan agama</li>
													<li>tidak mengganggu teman yang sedang beribadah</li>
													<li>menghormati hari besar keagamaan lain</li>
													<li>tidak menjelekkan ajaran agama lain</li>
												</ul>
											</td>
										</tr>
									</tbody>
									</table>
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
  <!--tambah sikap-->
		<div class="modal fade" id="tambahNilai">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nilai Spiritual</h4>
              </div>
			  <form class="form" action="../modul/administrasi/tambahspi.php" method="POST" id="createSosForm">
                        <div class="modal-body">
							<div class="form-group">
							  <label for="input-device">Nama Siswa</label>
							  <input type="hidden" id="kelas" name="kelas" class="form-control" value="<?php echo $romb;?>">
							  <input type="hidden" id="smt" name="smt" class="form-control" value="<?php echo $smt_aktif;?>">
							  <input type="hidden" id="tapel" name="tapel" class="form-control" value="<?php echo $tpl_aktif;?>">
							  <select class="form-control select2" name="idsis" style="width: 100%;">
							  					<option>Pilih Siswa...</option>
													<?php 
													$sql_mk=mysqli_query($koneksi, "select * from penempatan where rombel='$romb' and tapel='$tapel' order by nama asc");
													while($nk=mysqli_fetch_array($sql_mk)){
													?>
													<option value="<?=$nk['peserta_didik_id'];?>"><?=$nk['nama'];?></option>
													<?php };?>
												</select>
							</div>
							<div class="form-group">
							  <label for="output-device">Pengamatan</label>
							  <textarea id="example-textarea-input" id="pengamatan" name="pengamatan" rows="7" class="form-control" placeholder="Pengamatan.."></textarea>
							</div>
							<div class="form-group">
							  <span class="form-label">Aspek</span>
							  <select class="form-control" name="aspek">
							  					<option>Pilih Aspek...</option>
													<?php 
													$cate = array("Ketaatan Beribadah", "Berdoa sebelum dan sesudah pembelajaran","Toleransi dalam beribadah","Berperilaku Syukur");
													for($i = 1; $i < 5; $i++) {
													?>
													<option value="<?=$i;?>"><?=$cate[$i-1];?></option>
													<?php };?>
												</select>
							</div>
							<div class="form-group">
							  <span class="form-label">Nilai</span>
							  <select class="form-control" name="nilai">
							  					<option>Pilih Nilai...</option>
													<option value="PB">Perlu Bimbingan</option>
													<option value="SB">Sangat Baik</option>
												</select>
							</div>
                        </div>
                        <div class="modal-footer">
                            <button id="simpan" type="submit" class="btn btn-danger waves-effect waves-light">Simpan</button>
                        </div>
			  </form>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<!--Delete Nilai-->
		<div class="modal fade" id="removeNilaiModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus</h4>
              </div>
                        <div class="modal-body">
							<p>Hapus Nilai Spiritual?</p>
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

<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" class="init">
	var sosTable;
	$(document).ready(function() {
		sosTable = $('#sosTable').DataTable( {
			"ajax": "../modul/administrasi/spiritual.php?kelas=<?=$romb;?>&smt=<?=$smt_aktif;?>&tapel=<?=$tpl_aktif;?>",
			"order": []
		} );
		$('.select2').select2();
		$("#addNilaiModalBtn").on('click', function() {
			// reset the form 
			$("#createSosForm")[0].reset();
			
			// submit form
			$("#createSosForm").unbind('submit').bind('submit', function() {

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
								
								// reload the datatables
								sosTable.ajax.reload(null, false);
								$("#createSosForm")[0].reset();
								// this function is built in function of datatables;
								$("#tambahNilai").modal('hide');

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

	});
	function removeSpi(id = null) {
		if(id) {
			// click on remove button
			$("#removeBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/administrasi/hapusspi.php',
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
							sosTable.ajax.reload(null, false);

							// close the modal
							$("#removeNilaiModal").modal('hide');

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
