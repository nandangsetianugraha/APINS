<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
$romb = isset($_GET['kelas']) ? $_GET['kelas'] : $kelas;
$peta=2;
$sql_asp=mysqli_query($koneksi, "select * from aspek where kd_aspek='$peta'");
$nama_asp=mysqli_fetch_array($sql_asp);
?>

    <!-- Main content -->
    <section class="content">
	<?php 
if($level==98 or $level==97){
?>
		<div class="box box-primary">
			<div class="box-header">
              <h3 class="box-title">Penilaian Sikap Sosial</h3>
			  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#tambahNilai" id="addNilaiModalBtn"><i class="fa fa-plus"></i> Sosial</button>
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
							<p>Perilaku Yang dinilai :</p>
							<div class="box-group" id="accordion">
								<div class="panel box box-primary">
								  <div class="box-header with-border">
									<h4 class="box-title">
									  <a data-toggle="collapse" data-parent="#accordion" href="#jujur">
										Jujur
									  </a>
									</h4>
								  </div>
								  <div id="jujur" class="panel-collapse collapse in">
									<div class="box-body">
									  <ul>
										<li>tidak berbohong</li>
										<li>tidak mencontek</li>
										<li>mengerjakan sendiri tugas yang diberikan tanpa menjiplak tugas orang lain</li>
										<li>mengerjakan soal penilaian tanpa mencontek</li>
										<li>mengatakan dengan sesungguhnya apa yang terjadi atau yang dialaminya dalam kehidupan sehari-hari</li>
										<li>mau mengakui kesalahan atau kekeliruan</li>
										<li>mengembalikan barang yang dipinjam atau ditemukan</li>
										<li>mengemukakan pendapat sesuai dengan apa yang diyakininya, walaupun berbeda dengan pendapat teman</li>
										<li>mengemukakan ketidaknyamanan belajar yang dirasakannya di sekolah</li>
										<li>membuat laporan kegiatan kelas secara terbuka (transparan)</li>
									  </ul>
									</div>
								  </div>
								</div>
								<div class="panel box box-primary">
								  <div class="box-header with-border">
									<h4 class="box-title">
									  <a data-toggle="collapse" data-parent="#accordion" href="#disiplin">
										Disiplin
									  </a>
									</h4>
								  </div>
								  <div id="disiplin" class="panel-collapse collapse">
									<div class="box-body">
										<ul>
											<li>mengikuti peraturan yang ada di sekolah</li>
											<li>tertib dalam melaksanakan tugas</li>
											<li>hadir di sekolah tepat waktu</li>
											<li>masuk kelas tepat waktu</li>
											<li>memakai pakaian seragam lengkap dan rapi</li>
											<li>tertib mentaati peraturan sekolah</li>
											<li>melaksanakan piket kebersihan kelas</li>
											<li>mengumpulkan tugas/pekerjaan rumah tepat waktu</li>
											<li>mengerjakan tugas/pekerjaan rumah dengan baik</li>
											<li>membagi waktu belajar dan bermain dengan baik</li>
											<li>mengambil dan mengembalikan peralatan belajar pada tempatnya</li>
											<li>tidak pernah terlambat masuk kelas</li>
										</ul>
									</div>
								  </div>
								</div>
								<div class="panel box box-primary">
								  <div class="box-header with-border">
									<h4 class="box-title">
									  <a data-toggle="collapse" data-parent="#accordion" href="#tanggung">
										Tanggung Jawab
									  </a>
									</h4>
								  </div>
								  <div id="tanggung" class="panel-collapse collapse">
									<div class="box-body">
									  <ul>
										<li>menyelesaikan tugas yang diberikan</li>
										<li>mengakui kesalahan</li>
										<li>melaksanakan tugas yang menjadi kewajibannya di kelas seperti piket kebersihan</li>
										<li>melaksanakan peraturan sekolah dengan baik</li>
										<li>mengerjakan tugas/pekerjaan rumah sekolah dengan baik</li>
										<li>mengumpulkan tugas/pekerjaan rumah tepat waktu</li>
										<li>mengakui kesalahan, tidak melemparkan kesalahan kepada teman</li>
										<li>berpartisipasi dalam kegiatan sosial di sekolah</li>
										<li>menunjukkan prakarsa untuk mengatasi masalah dalam kelompok di kelas/sekolah</li>
										<li>membuat laporan setelah selesai melakukan kegiatan</li>
									  </ul>
									</div>
								  </div>
								</div>
								<div class="panel box box-primary">
								  <div class="box-header with-border">
									<h4 class="box-title">
									  <a data-toggle="collapse" data-parent="#accordion" href="#santun">
										Santun
									  </a>
									</h4>
								  </div>
								  <div id="santun" class="panel-collapse collapse">
									<div class="box-body">
									  <ul>
										<li>menghormati orang lain dan menghormati cara bicara yang tepat</li>
										<li>menghormati pendidik, pegawai sekolah,penjaga kebun, dan orang yang lebih tua</li>
										<li>berbicara atau bertutur kata halus tidak kasar</li>
										<li>berpakaian rapi dan pantas</li>
										<li>dapat mengendalikan emosi dalam menghadapi masalah, tidak marah-marah</li>
										<li>mengucapkan salam ketika bertemu pendidik,teman, dan orang-orang di sekolah</li>
										<li>menunjukkan wajah ramah, bersahabat, dan tidak cemberut</li>
										<li>mengucapkan terima kasih apabila menerima bantuan dalam bentuk jasa atau barang dari orang lain</li>
									  </ul>
									</div>
								  </div>
								</div>
								<div class="panel box box-primary">
								  <div class="box-header with-border">
									<h4 class="box-title">
									  <a data-toggle="collapse" data-parent="#accordion" href="#peduli">
										Peduli
									  </a>
									</h4>
								  </div>
								  <div id="peduli" class="panel-collapse collapse">
									<div class="box-body">
									  <ul>
										<li>ingin tahu dan ingin membantu teman yang kesulitan dalam pembelajaran, perhatian kepada orang lain</li>
										<li>berpartisipasi dalam kegiatan sosial di sekolah,misal: mengumpulkan sumbangan untuk membantu yang sakit atau kemalangan</li>
										<li>meminjamkan alat kepada teman yang tidak membawa/memiliki</li>
										<li>menolong teman yang mengalami kesulitan</li>
										<li>menjaga keasrian,  keindahan, dan kebersihan lingkungan sekolah</li>
										<li>melerai teman yang berselisih (bertengkar)</li>
										<li>menjenguk teman atau pendidik yang sakit</li>
										<li>menunjukkan perhatian terhadap kebersihan kelas dan lingkungan sekolah</li>
									  </ul>
									</div>
								  </div>
								</div>
								<div class="panel box box-primary">
								  <div class="box-header with-border">
									<h4 class="box-title">
									  <a data-toggle="collapse" data-parent="#accordion" href="#percaya">
										Percaya Diri
									  </a>
									</h4>
								  </div>
								  <div id="percaya" class="panel-collapse collapse">
									<div class="box-body">
									  <ul>
										<li>berani tampil di depan kelas</li>
										<li>berani mengemukakan pendapat</li>
										<li>berani mencoba hal baru</li>
										<li>mengemukakan pendapat terhadap suatu topik atau masalah</li>
										<li>mengajukan diri menjadi ketua kelas atau pengurus kelas lainnya</li>
										<li>mengajukan diri untuk mengerjakan tugas atau soal di papan tulis</li>
										<li>mencoba hal-hal baru yang bermanfaat</li>
										<li>mengungkapkan kritikan membangun terhadap karya orang lain</li>
										<li>memberikan argumen yang kuat untuk mempertahankan pendapat</li>
									  </ul>
									</div>
								  </div>
								</div>
							</div>
							
									
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
		<!--tambah sikap-->
		<div class="modal fade" id="tambahNilai">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nilai Sosial</h4>
              </div>
			  <form class="form" action="../modul/administrasi/tambahsos.php" method="POST" id="createSosForm">
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
													$cate = array("Jujur", "Disiplin", "Tanggung Jawab", "Santun", "Peduli", "Percaya Diri");
													for($i = 1; $i < 7; $i++) {
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
							<p>Hapus Nilai Sosial?</p>
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
<?php 
}else{
?>
<div class="error-page">
			<div class="error-content text-center" style="margin-left: 0;">
				<h3><i class="fa fa-info-circle text-primary"></i> Informasi </h3>
				<p>Halaman tidak dapat diakses<br>Silahkan hubungi Administrator</p>
			</div>
		</div>
<?php 
};
?>			
    </section>
    <!-- /.content -->
  
<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" class="init">
	var sosTable;
	$(document).ready(function() {
		sosTable = $('#sosTable').DataTable( {
			"ajax": "../modul/administrasi/sosial.php?kelas=<?=$romb;?>&smt=<?=$smt_aktif;?>&tapel=<?=$tpl_aktif;?>",
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
	function removeSos(id = null) {
		if(id) {
			// click on remove button
			$("#removeBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/administrasi/hapussos.php',
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
