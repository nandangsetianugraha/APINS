<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        ID Pegawai
    </h1>
    <ol class="breadcrumb">
		<li><a href="#" data-toggle="modal" data-toggle="modal" data-target="#NGuru"><i class="fa fa-plus"></i> Tambah</a></li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
   
		
						<table id="manageMemberTable" class="table table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
												<th class="text-center">ID Pegawai</th>
												<th class="text-center">Nama Pegawai</th>
												<th>&nbsp;</th>
											</tr>
                                        </thead>
                                        <tbody>
										
                                        </tbody>
                                    </table>
		
		<div class="modal fade" id="NGuru">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ID Pegawai</h4>
              </div>
                        <form class="form" action="../modul/ptk/simpanID.php" method="POST" id="guruForm">
						<div class="modal-body">
							<div class="form-group">
								<label for="output-device">ID Pegawai</label>
								<input type="text" class="form-control" id="idNasabah" name="idNasabah" placeholder="ID Nasabah" autocomplete=off>
							</div>
							<div class="form-group">
								<label for="output-device">Pilih Guru</label>
								<select id="idsis" class="form-control selectguru" style="width: 100%;" name="idsis">
									<option>Pilih Guru</option>
									<?php 
									$sql_mk=mysqli_query($koneksi, "select * from ptk where status_keaktifan_id=1 order by nama asc");
									while($nk=mysqli_fetch_array($sql_mk)){
									?>
									<option value="<?php echo $nk['ptk_id']; ?>"><?=$nk['nama']; ?></option>
									<?php };?>
								</select>
							</div>
                        </div>
                        <div class="modal-footer ptkModal">
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
		
		
<!--Mutasi Siswa-->

		<div class="modal fade" id="hapusData">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus ID Pegawai</h4>
              </div>
                        <div class="modal-body">
							<p>Hapus ID Pegawai?<br/>Jika ID Pegawai Dihapus, Otomatis semua data Absensi akan dihapus juga.</p>
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
	

</section>
<!-- /.content -->

<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	
<script>
    $(function () {
		//Initialize Select2 Elements
    $('.selectguru').select2()
		});
	var manageMemberTable;
	$(document).ready(function() {
		manageMemberTable = $("#manageMemberTable").DataTable({
			"ajax": "../modul/ptk/idpegawai.php",
			"order": []
		});
		
			$("#guruForm").unbind('submit').bind('submit', function() {
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
										$("#guruForm")[0].reset();
										$('#idsis').val(null).trigger('change');
										$("#NGuru").modal('hide');
										manageMemberTable.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
									} else {
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
									}
								} // /success
							}); // /ajax

						return false;
					});
	});
	function outMember(id = null) {
		if(id) {
			// click on remove button
			$("#outBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/ptk/hapusID.php',
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

							// close the modal
							$("#hapusData").modal('hide');

						} else {
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
						}
					}
				});
			}); // click remove btn
		} else {
			alert('Error: Refresh the page again');
		};
		
		
	}
</script>
</body>
</html>	