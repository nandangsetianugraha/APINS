<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">

    <!-- Main content -->
    <section class="content">
	<?php 
	if(isset($_GET['status'])) {
		if($_GET['status']==='kosong'){
	?>
		<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Error</h4>
            Isi Yang benar Bung
        </div>
	<?php
			
		};
		if($_GET['status']==='sukses'){
	?>
		<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Sukses</h4>
            Artikel sudah ditambahkan
        </div>
	<?php
			
		};
		if($_GET['status']==='gagal'){
	?>
		<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Error</h4>
            Gagal Bung!!
        </div>
	<?php
			
		};
	};
	?>
				<div class="box">
					<div class="box-header">
					  <h3 class="box-title">Daftar Artikel</h3>
					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#penempatan"><i class="fa fa-plus"></i> Artikel Baru</button>
					  </div>
					</div>
					<div class="box-body table-responsive">
						<table id="manageMemberTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
												<th class="text-center" width="15%">Tanggal</th>
												<th class="text-center" width="29%">Judul</th>
												<th class="text-center" width="50%">Isi</th>
												<th width="6%">&nbsp;</th>
											</tr>
                                        </thead>
                                        <tbody>
										
                                        </tbody>
                                    </table>
					</div>
				</div>
	
	<!--Modal -->
		<div class="modal fade" id="penempatan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Artikel Baru</h4>
              </div>
			  <form class="form-horizontal" action="../modul/blog/tambahblog.php" autocomplete="off" method="POST" id="tambahArtikelForm">
              <div class="modal-body">
				<div class="form-group">
					<label for="inputName" class="col-sm-2 control-label">Tanggal</label>
					<div class="col-sm-10">
						<div class="input-group date">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						  <input type="text" class="form-control pull-right" name="tanggal" id="datepicker">
						</div>
					</div>
					<!-- /.input group -->
				</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">Judul</label>
								<div class="col-sm-10">
								  <input type="text" class="form-control" name="judul">
								</div>
							</div>
							<div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">Isi Artikel</label>
								<div class="col-sm-10">
								  <textarea id="editor1" name="isi" rows="10" cols="80"></textarea>
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
		
		<!--Delete Tema-->
		<div class="modal fade" id="outMemberModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Artikel</h4>
              </div>
                        <div class="modal-body">
							<p>Anda yakin akan menghapus artikel ini?<br/>Data yang telah dihapus tidak bisa dikembalikan lagi.</p>
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
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  });
	var manageMemberTable;
	$(document).ready(function() {
		manageMemberTable = $("#manageMemberTable").DataTable({
			"ajax": "../modul/blog/daftarblog.php",
			"order": []
		});
		$('#datepicker').datepicker({
		  autoclose: true
		})

		
		
	});
	
	function outMember(id = null) {
		if(id) {
			// click on remove button
			$("#outBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/blog/hapusblog.php',
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
