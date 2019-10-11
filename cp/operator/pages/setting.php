<?php 
include "../inc/lte-head.php";
$kelas="1A";
?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-sm-6">
			<section class="panel">
				<header class="panel-heading">
					<h4> <strong>Pengaturan</strong></h4>
					<label class="color">Tahun Pelajaran dan Semester Aktif</label>
				</header>
				<div class="panel-tools" align="left">
					<button type="button" data-toggle="modal" data-target="#pengaturan" data-id="1" class="btn btn-primary btn-transparant"><i class="fa fa-gear"></i> Tahun Pelajaran</button>
					
				</div>
				<div class="panel-body">
					
				</div>
			</section>
			
		</div>
		<div class="col-sm-6">
			<section class="panel">
				<header class="panel-heading">
					<h4> <strong>Pengaturan</strong></h4>
					<label class="color">Tahun Pelajaran dan Semester Aktif</label>
				</header>
				<div class="panel-body">
					<h5>Informasi Halaman</h5>
					Tahun Pelajaran Aktif = <?=$tpl_aktif; ?><br/>
					Semester Aktif = <?=$smt_aktif; ?><br/>
					Maintenance = <?php if($maintenis==0){echo "Tidak";}else{echo "Ya";} ?><br/>
					Versi = <?=$versi;?>
				</div>
			</section>
		</div>
	</div>
	<!--Modal-->
	<div class="modal fade" id="pengaturan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pengaturan</h4>
              </div>
                        <form class="form-horizontal" action="../modul/setting/simpantapel.php" autocomplete="off" method="POST" id="pengaturanForm">
						<div class="modal-body pengaturan">
							<div class="pengaturan-data"></div>
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
</section>
<!-- /.content -->

<?php include "../inc/lte-script.php";?>
<script>
$(document).ready(function() {
	$('#pengaturan').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : '../modul/setting/tahunpelajaran.php',
                data :  'rowid='+ rowid,
				beforeSend: function()
						{	
							$(".mutasi-data").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...');
						},
                success : function(data){
                $('.pengaturan-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
	$("#pengaturanForm").unbind('submit').bind('submit', function() {
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
										
										$("#pengaturan").modal('hide');
									} else {
										$.amaran({
											'theme'     :'awesome ok',
											'content'   :{
												title:'Error!',
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
</script>
</body>
</html>
