<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
?>

    <!-- Main content -->
    <section class="content">
	<?php 
if($level==98 or $level==97){
?>
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Daftar Tema Kelas <?=$ab;?></h3>
					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#tambahTema" id="addTemaModalBtn"><i class="fa fa-plus"></i> Tema</button>
					  </div>
					</div>
					<div class="box-body">
						<table id="temaTable" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
									<th>Tema</th>
									<th>Nama Tema</th>
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
		<div class="modal fade" id="tambahTema">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Tema</h4>
              </div>
              <form class="form" action="../modul/administrasi/tambahtema.php" method="POST" id="createTemaForm">
                        <div class="modal-body">
							<div class="form-group">
							  <label for="input-device">Kelas</label>
							  <input type="hidden" id="kelas" name="kelas" class="form-control" value="<?php echo $kelas;?>">
							  <p class="form-control-static">Kelas <?php echo $kelas;?></p>
							</div>
							<div class="form-group">
							  <label for="output-device">Semester</label>
							  <input type="hidden" id="smt" name="smt" class="form-control" value="<?php echo $smt_aktif;?>">
							  <p class="form-control-static">Semester <?php echo $smt_aktif;?></p>
							</div>
							<div class="form-group">
							  <span class="form-label">Tema</span>
							  <input id="number-mask" name="tema" autocomplete=off type="text" class="form-control" placeholder="Tema">
							</div>
							<div class="form-group">
							  <span class="form-label">Nama Tema</span>
							  <input id="nama_tema" name="nama_tema" autocomplete=off type="text" class="form-control" placeholder="Nama Tema">
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
		
		<!--Delete Tema-->
		<div class="modal fade" id="removeTemaModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus</h4>
              </div>
                        <div class="modal-body">
							<p>Hapus Tema ini dari Kelas <?=$ab;?>?</p>
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
		
		<!--Edit Tema-->
		<div class="modal fade" id="editTema">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Tema</h4>
              </div>
                        <form class="form-horizontal" action="../modul/administrasi/updatetema.php" autocomplete="off" method="POST" id="updateTemaForm">
						<div class="modal-body eTema">
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

<script>
	var temaTable;
	$(document).ready(function() {
		temaTable = $('#temaTable').DataTable( {
			"searching": false,
			"ajax": "../modul/administrasi/temaku.php?kelas=<?=$ab;?>&smt=<?=$smt_aktif;?>",
			"order": []
		} );
		$("#addTemaModalBtn").on('click', function() {
			// reset the form 
			$("#createTemaForm")[0].reset();
			
			// submit form
			$("#createTemaForm").unbind('submit').bind('submit', function() {

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
								$("#tambahTema").modal('hide');

								// reload the datatables
								temaTable.ajax.reload(null, false);
								$("#createTemaForm")[0].reset();
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
		
		//edit tema 
		$('#editTema').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : '../modul/administrasi/edit-tema.php',
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
		 $("#updateTemaForm").unbind('submit').bind('submit', function() {
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
										temaTable.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
										$("#editTema").modal('hide');
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
	function removeTema(id = null) {
		if(id) {
			// click on remove button
			$("#removeBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/administrasi/hapustema.php',
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
							temaTable.ajax.reload(null, false);

							// close the modal
							$("#removeTemaModal").modal('hide');

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
