<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
$mpid = isset($_GET['mp']) ? $_GET['mp'] : 1;
$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
$ab=substr($romb, 0, 1);
?>
    <!-- Main content -->
    <section class="content">
		
		<div class="row">
		
			
			<div class="col-lg-12 col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Generate Sikap Spiritual Kelas <?=$romb;?></h3>
					  <div class="box-tools pull-right">
						
			
						<form class="form" action="raportspiritual.php" method="GET">
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
	</section>
    <!-- /.content -->
  
  <!--Generate Raport-->
		<div class="modal fade" id="mod-raport">
          <div class="modal-dialog">
            <div class="modal-content">
              
                        <div class="modal-body">
							<div id="mod-loader-raport" style="display: none; text-align: center;">
								<img src="ajax-loader.gif"><br/>Jangan Tutup Jendela Ini!! <br/>Sedang Proses Generate Nilai Raport......
								<br/>
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
	var Raportku;
	$(document).ready(function() {
		Raportku = $("#Raportku").DataTable({
			"searching": false,
			"ajax": "../modul/raport/Sspiritual.php?kelas=<?=$romb;?>&tapel=<?=$tpl_aktif;?>&smt=<?=$smt;?>&mp=<?=$mpid;?>",
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
				url: '../modul/raport/Gspiritual.php',
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
</script>
</body>
</html>
