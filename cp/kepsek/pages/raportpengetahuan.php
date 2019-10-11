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
$mpm=mysqli_fetch_array(mysqli_query($koneksi, "select * from mapel where id_mapel='$mpid'"));
?>
	
    <!-- Main content -->
    <section class="content">
		
		<div class="row">
		
			<?php 
			if(isset($_GET['generate'])){
				$ckkm=mysqli_num_rows(mysqli_query($koneksi, "select * from kkm where kelas='$ab' and tapel='$tapel' and mapel='$mpid'"));
			?>
			<div class="col-lg-12 col-xs-12">
				<div class="box">
					<div class="box-body">
						<a href="raportpengetahuan.php" class="btn btn-social btn-bitbucket">
							<i class="fa fa-undo"></i> Kembali
						</a>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-xs-12">
				<?php if($ckkm>0){ ?>
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Generate Raport Pengetahuan <?=$mpm['nama_mapel'];?> Kelas <?=$romb;?></h3>
					</div>
					<div class="box-body">
						<div class="loading-progress"></div>
						<table id="Raportku" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
									<th>Nama</th>
									<th>Nilai</th>
									<th>Pred</th>
									<th>Deskripsi</th>
									<th></th>
								</tr>
							</thead>
							<tbody>	
															
							</tbody>
						</table>
					</div>
				</div>
				<?php }else{ ?>
				<div class="box">
					<div class="box-body">
						<div class="alert alert-warning alert-dismissible">
							<h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
							<p>Mata Pelajaran <?=$mpm['nama_mapel'];?> belum mempunyai KKM.</p>
						</div>
						<a href="kkm.php?kelas=<?=$ab;?>&mp=<?=$mpid;?>&tapel=<?=$tapel;?>&lihat" class="btn btn-app">
							<i class="fa fa-edit"></i> Isi KKM
						</a>
					</div>
				</div>
				<?php }; ?>
			</div>
			<!--Edit Raport-->	
			<div class="modal fade" id="editRaport">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Raport Pengetahuan</h4>
				  </div>
							<form class="form-horizontal" action="../modul/raport/updateRaport.php" autocomplete="off" method="POST" id="updateRaportForm">
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
			
			<div class="col-lg-12 col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Generate Nilai Raport Pengetahuan Kelas <?=$romb;?></h3>
					  <div class="box-tools pull-right">
						<?php 
			if($level==96 or $level==95 or $level==94){ //guru pai
			?>
			
						<form class="form" action="raportpengetahuan.php" method="GET">
							<div class="form-group">
								<select class="form-control" name="kelas" onchange="this.form.submit()">
								<?php 
								$sql_mk=mysqli_query($koneksi, "select * from rombel where tapel='$tapel' order by nama_rombel asc");
								while($nk=mysqli_fetch_array($sql_mk)){
								?>
								<option value="<?=$nk['nama_rombel'];?>" <?php if($nk['nama_rombel']==$romb){echo "selected";}; ?>>Kelas <?=$nk['nama_rombel'];?></option>
								<?php };?>
								</select>
							</div>
						</form>
			<?php };?>
					  </div>
					</div>
					<div class="box-body">
						<table id="RaportTable" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
									<th>Mata Pelajaran</th>
									<th>Jumlah Siswa</th>
									<th>Sukses</th>
									<th>Status</th>
									<th></th>
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
	</section>
    <!-- /.content -->
  
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
	

<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
	<?php 
	if(isset($_GET['generate'])){
	?>
	var Raportku;
	$(document).ready(function() {
		Raportku = $("#Raportku").DataTable({
			"searching": false,
			"ajax": "../modul/raport/Sraports.php?kelas=<?=$romb;?>&tapel=<?=$tpl_aktif;?>&smt=<?=$smt;?>&mp=<?=$mpid;?>",
			"order": []
		});
		$(document).on('click', '#getRaport', function(e){
		
			e.preventDefault();
			
			var ukelas = $(this).data('kelas');
			var utapel = $(this).data('tapel');			// it will get id of clicked row
			var usmt = $(this).data('smt');
			var ump = $(this).data('mp');
			var updid = $(this).data('pdid');
			
			$('#dynamic-raport').html(''); // leave it blank before ajax call
			$('#mod-loader-raport').show();      // load ajax loader
			
			$.ajax({
				url: '../modul/raport/Graports.php',
				type: 'POST',
				data: 'kelas='+ukelas+'&tapel='+utapel+'&smt='+usmt+'&mp='+ump+'&pdid='+updid,
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
                url : '../modul/raport/edit-Raport.php',
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
		 $("#updateRaportForm").unbind('submit').bind('submit', function() {
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
	
	<?php }else{ ?>
	var RaportTable;
	
	$(document).ready(function() {
		RaportTable = $("#RaportTable").DataTable({
			"searching": false,
			"ajax": "../modul/raport/Sraport.php?kelas=<?=$romb;?>&tapel=<?=$tpl_aktif;?>&smt=<?=$smt;?>",
			"order": []
		});
	});
	<?php };?>
</script>
</body>
</html>
