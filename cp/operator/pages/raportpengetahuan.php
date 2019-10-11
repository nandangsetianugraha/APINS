<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 2;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
	$ab=substr($romb, 0, 1);
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
				
			<?php 
			}else{
			?>
			
			<div class="col-lg-12 col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Generate Nilai Raport Pengetahuan Kelas <?=$romb;?></h3>
					  <div class="box-tools pull-right">
			
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
					  </div>
					</div>
					<div class="box-body">
						<table id="RaportTable" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
									<th>Mata Pelajaran</th>
									<th>Jumlah Siswa</th>
									<th>Sukses</th>
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
	<!--Edit Raport-->	
		<div class="modal fade" id="edit-raport">
          <div class="modal-dialog">
            <div class="modal-content">
              
                        <div class="modal-body">
							<div id="edit-loader-raport" style="display: none; text-align: center;">
								<img src="ajax-loader.gif">
							</div>
							<div id="edits-raport"></div>
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
		$(document).on('click', '#editRaport', function(e){
		
			e.preventDefault();
			
			var uid = $(this).data('id');
			
			$('#edits-raport').html(''); // leave it blank before ajax call
			$('#edit-loader-raport').show();      // load ajax loader
			
			$.ajax({
				url: '../modul/raport/Eraport.php',
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				console.log(data);	
				$('#edits-raport').html('');    
				$('#edits-raport').html(data); // load response 
				$('#edit-loader-raport').hide();		  // hide ajax loader
				Raportku.ajax.reload(null, false);
				$("#edit-raport").modal('hide');	
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
				$('#edits-raport').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
				$('#edit-loader-raport').hide();
			});
			
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
