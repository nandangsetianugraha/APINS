<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
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
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
$mpm=mysqli_fetch_array(mysqli_query($koneksi, "select * from mapel where id_mapel='$mpid'"));
?>
    <!-- Main content -->
    <section class="content">
		<?php if($level==98 or $level==97){ ?>
				
		<?php }else{ ?>
				<form class="form-horizontal" action="kkm.php?lihat" method="GET">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>
					<input type="hidden" name="tapel" class="form-control" value="<?php echo $tapel;?>">
					<input type="hidden" name="smt" class="form-control" value="<?php echo $smt;?>">
					<div class="col-sm-10">
					<select class="form-control" name="kelas" onchange="this.form.submit()">
					<?php 
					for($i = 1; $i < 7; $i++) {
					?>
						<option value="<?=$i;?>" <?php if($i==$romb){echo "selected";}; ?>>Kelas <?=$i;?></option>
					<?php };?>
					</select>
					</div>
				</div>
				</form>
		<?php };?>
		<div class="row">
		
			<?php 
			if(isset($_GET['lihat'])){
			?>
			<div class="col-lg-12 col-xs-12">
				<div class="box">
					<div class="box-body">
						<a href="kkm.php?tapel=<?=$tapel;?>&kelas=<?=$romb;?>" class="btn btn-social btn-bitbucket">
							<i class="fa fa-undo"></i> Kembali
						</a>
						<a href="../../cetak/cetakKKM.php?kelas=<?=$romb;?>&mapel=<?=$mpid;?>&tapel=<?=$tapel;?>" class="btn btn-social btn-bitbucket" target="_blank">
							<i class="fa fa-print"></i> Cetak
						</a>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Kriteria Ketuntasan Minimal <?=$mpm['nama_mapel'];?> Kelas <?=$romb;?></h3>
					</div>
					<div class="box-body">
						<table id="KKMTable" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
									<th>KD</th>
									<th>Kompetensi Dasar</th>
									<th>Karakteristik Muatan/Mata Pelajaran (Kompleksitas)</th>
									<th>Karakteristik Peserta Didik (Intake)</th>
									<th>Kondisi Satuan Pendidikan</th>
								</tr>
							</thead>
							<tbody>	
															
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php 
			}else{
			?>
			<div class="col-lg-9 col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Kriteria Ketuntasan Minimal Kelas <?=$romb;?></h3>
					</div>
					<div class="box-body">
						<table id="KKMTablek" class="table table-bordered table-hover table-responsive no-padding">
							<thead>
							   <tr>
									<th>Mata Pelajaran</th>
									<th>KKM</th>
									<th></th>
								</tr>
							</thead>
							<tbody>	
															
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-12">
				<?php 
				$mkkm=mysqli_fetch_array(mysqli_query($koneksi, "select min(nilai) as kkmkelas from kkm where kelas='$romb' and tapel='$tapel'"));
				if(empty($mkkm['kkmkelas'])){
					$kkmsaya=0;
				}else{
					$kkmsaya=$mkkm['kkmkelas'];
				}
				?>
				<div class="small-box bg-aqua">
					<div class="inner">
					  <h3><?=$kkmsaya;?></h3>

					  <p>KKM Kelas</p>
					</div>
					<div class="icon">
					  <i class="fa fa-users"></i>
					</div>
					<a href="#" class="small-box-footer">
					  <i class="fa fa-print"></i> Cetak
					</a>
				</div>
				<?php 
				$mkkm1=mysqli_fetch_array(mysqli_query($koneksi, "select min(nilai) as kkmsekolah from kkm where tapel='$tapel'"));
				if(empty($mkkm1['kkmsekolah'])){
					$kkmsaya1=0;
				}else{
					$kkmsaya1=$mkkm1['kkmsekolah'];
				}
				?>
				<div class="small-box bg-aqua">
					<div class="inner">
					  <h3><?=$kkmsaya1;?></h3>

					  <p>KKM Satuan Pendidikan</p>
					</div>
					<div class="icon">
					  <i class="fa fa-users"></i>
					</div>
					<a href="#" class="small-box-footer">
					  <i class="fa fa-print"></i> Cetak
					</a>
				</div>
			</div>
			<?php }; ?>
		</div>
	</section>
    <!-- /.content -->
<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
	<?php 
	if(isset($_GET['lihat'])){
	?>
	var KKMTable;
	$(document).ready(function() {
		KKMTable = $("#KKMTable").DataTable({
			"searching": false,
			"paging":   false,
			"ajax": "../modul/administrasi/kkmku.php?kelas=<?=$romb;?>&tapel=<?=$tpl_aktif;?>&mapel=<?=$mpid;?>",
			"order": []
		});
		$(document).on('submit', '#nilaiKKM', function(e){
			
			e.preventDefault();
			var form = $(this);
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json'
			})
			.done(function(response){
				console.log(response);	
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
								KKMTable.ajax.reload(null, false);

							} else {
								$.amaran({
									'theme'     :'awesome error',
									'content'   :{
										title:'Error!',
										message:response.messages,
										info:'',
										icon:'fa fa-check-square-o'
									},
									'position'  :'bottom right',
									'outEffect' :'slideBottom'
								});
							}  // /else		  // hide ajax loader	
			})
			.fail(function(){
				$.amaran({
									'theme'     :'awesome error',
									'content'   :{
										title:'error!',
										message:response.messages,
										info:'',
										icon:'fa fa-check-square-o'
									},
									'position'  :'bottom right',
									'outEffect' :'slideBottom'
								});
			});
			
		});	
	});
	function highlightEdit(editableObj) {
			$(editableObj).css("background","#FFF0000");
		} 
		function saveKKM(editableObj,column,kelas,tapel,mpid,kda,jenis) {
			// no change change made then return false
			if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
			return false;
			// send ajax to update value
			$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
			$.ajax({
				url: "../modul/administrasi/saveKKM.php",
				cache: false,
				data:'column='+column+'&value='+editableObj.innerHTML+'&kelas='+kelas+'&tapel='+tapel+'&mp='+mpid+'&kda='+kda+'&jenis='+jenis,
				success: function(response)  {
					console.log(response);
					// set updated value as old value
					$(editableObj).attr('data-old_value',editableObj.innerHTML);
					$(editableObj).css("background","#FDFDFD");	
					
				}          
		});
		};
	<?php }else{ ?>
	var KKMTablek;
	$(document).ready(function() {
		KKMTablek = $("#KKMTablek").DataTable({
			"searching": false,
			"paging":   false,
			"ajax": "../modul/administrasi/kkmk.php?kelas=<?=$romb;?>&tapel=<?=$tpl_aktif;?>&level=<?=$level;?>",
			"order": []
		});
	});
	<?php };?>
</script>
</body>
</html>