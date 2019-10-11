<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
if($level==96){ //guru pai
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 1;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
	$ab=substr($romb, 0, 1);
}elseif($level==95){ //guru penjas
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 8;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
	$ab=substr($romb, 0, 1);
}elseif($level==94){ //guru bahasa inggris
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 10;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
	$ab=substr($romb, 0, 1);
}else{
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 2;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : $kelas;
	$ab=substr($romb, 0, 1);
};
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
					  <h3 class="box-title">Generate Sikap Sosial Kelas <?=$romb;?></h3>
					</div>
					<div class="box-body">
						<div class="loading-progress"></div>
						<table id="Raportku" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
									<th>Nama</th>
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
		
		
		<!--Generate Raport-->
		<div class="modal fade" id="mod-raport">
          <div class="modal-dialog">
            <div class="modal-content">
              
                        <div class="modal-body">
							<div id="mod-loader-raport" style="display: none; text-align: center;">
								Jangan Tutup Jendela Ini!! <br/>Sedang Proses Generate Nilai Raport......
								<br/><img src="ajax-loader.gif">
							</div>
							<div id="dynamic-raport"></div>
                        </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	<!--Edit Raport-->	
		<div class="modal fade" id="editRaport">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Raport Sosial</h4>
              </div>
                        <form class="form-horizontal" action="../modul/raport/updateSikap.php" autocomplete="off" method="POST" id="updateSikapForm">
						<div class="modal-body eRS">
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
	var Raportku;
	$(document).ready(function() {
		Raportku = $("#Raportku").DataTable({
			"searching": false,
			"ajax": "../modul/raport/Ssosial.php?kelas=<?=$romb;?>&tapel=<?=$tpl_aktif;?>&smt=<?=$smt;?>&mp=<?=$mpid;?>",
			"order": []
		});
		$(document).on('click', '#getRaport', function(e){
		
			e.preventDefault();
			
			var ukelas = $(this).data('kelas');
			var utapel = $(this).data('tapel');			// it will get id of clicked row
			var usmt = $(this).data('smt');
			var updid = $(this).data('pdid');
			
			$('#dynamic-raport').html(''); // leave it blank before ajax call
			$('#mod-loader-raport').show();      // load ajax loader
			
			$.ajax({
				url: '../modul/raport/Gsosial.php',
				type: 'POST',
				data: 'kelas='+ukelas+'&tapel='+utapel+'&smt='+usmt+'&pdid='+updid,
				dataType: 'html'
			})
			.done(function(data){
				console.log(data);	
				$('#dynamic-raport').html('');    
				$('#dynamic-raport').html(data); // load response 
				$('#mod-loader-raport').hide();		  // hide ajax loader
				Raportku.ajax.reload(null, false);
				$("#mod-raport").modal('hide');	
				$.amaran({
					'theme'     :'awesome ok',
					'content'   :{
						title:'Sukses!',
						message:'Berhasil Men-Generate Nilai Raport',
						info:'',
						icon:'fa fa-check-square-o'
					},
					'position'  :'bottom right',
					'outEffect' :'slideBottom'
				});				
			})
			.fail(function(){
				$('#dynamic-raport').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
				$('#mod-loader-raport').hide();
			});
			
		});
		//edit Raport
		$('#editRaport').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
			//menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : '../modul/raport/edit-sikap.php',
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
		 //Update Raport 
		 $("#updateSikapForm").unbind('submit').bind('submit', function() {
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
										Raportku.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
										$("#editRaport").modal('hide');
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
</script>
</body>
</html>
