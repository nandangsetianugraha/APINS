<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$kelas=isset($_GET['kelas']) ? $_GET['kelas'] : '6A';
$toke=isset($_GET['toke']) ? $_GET['toke'] : '1';
?>
    

    <!-- Main content -->
    <section class="content">
	<?php 
	if($ab<6){
	?>
		<div class="error-page">
			<div class="error-content text-center" style="margin-left: 0;">
				<h3><i class="fa fa-info-circle text-primary"></i> Informasi </h3>
				<p>Halaman tidak dapat diakses<br>Silahkan hubungi Administrator</p>
			</div>
		</div>
	<?php
	}else{
	?>
	
	
	<div class="row">
	<div class="col-lg-12 col-xs-12">
				<form class="form-horizontal" action="tryout.php" method="GET">	
									<div class="form-group">
										<label for="inputName" class="col-sm-2 control-label">Kelas</label>
										<div class="col-sm-4">
											<input type="hidden" id="tapel" name="tapel" class="form-control" value="<?php echo $tapel;?>">
											<select class="form-control" name="kelas" onchange="this.form.submit()">
												<option value="6A" <?php if ($kelas==="6A"){echo "selected";}?>>Kelas 6A</option>
												<option value="6B" <?php if ($kelas==="6B"){echo "selected";}?>>Kelas 6B</option>
											</select>
										</div>
										<label for="inputName" class="col-sm-2 control-label">Tryout ke </label>
										<div class="col-sm-4">
											<select class="form-control" name="toke" onchange="this.form.submit()">
												<option value="1" <?php if ($toke==="1"){echo "selected";}?>>Ke 1</option>
												<option value="2" <?php if ($toke==="2"){echo "selected";}?>>Ke 2</option>
												<option value="3" <?php if ($toke==="3"){echo "selected";}?>>Ke 3</option>
												<option value="4" <?php if ($toke==="4"){echo "selected";}?>>Ke 4</option>
											</select>
										</div>
									</div>
								</form>
			</div>
	</div>
		<div class="box box-primary">
			<div class="box-header">
              <h3 class="box-title">Nilai Latihan USBN</h3>
			  <div class="box-tools pull-right">
				
              </div>
            </div>
			<div class="box-body table-responsive">
				
				<table id="nilaiUN" class="table table-bordered table-hover">
					<thead>
													   <tr>
															<th>Nama Peserta</th>
															<th>BIN</th>
															<th>MTK</th>
															<th>IPA</th>
															<th>Total</th>
															<th>Rerata</th>
														</tr>
													</thead>
					<tbody>	
													
					</tbody>
				</table>
				
				
				</div>
			</div>
	<?php }; ?>		
    </section>
    <!-- /.content -->

<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" class="init">
	var nK3;
	$(document).ready(function() {
		nK3 = $("#nilaiUN").DataTable({
				"searching": false,
				"ajax": "../modul/usbn/dataTO.php?toke=<?=$toke;?>&tapel=<?=$tapel;?>&kelas=<?=$kelas;?>",
				"order": []
			});
	});
	function highlightEdit(editableObj) {
		$(editableObj).css("background","#FFF0000");
	} 
	function saveUN(editableObj,column,id,mpid,toke) {
		// no change change made then return false
		if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
		return false;
		// send ajax to update value
		$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
		$.ajax({
			url: "../modul/usbn/saveTO.php",
			cache: false,
			data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id+'&mp='+mpid+'&toke='+toke,
			success: function(response)  {
				console.log(response);
				// set updated value as old value
				$(editableObj).attr('data-old_value',editableObj.innerHTML);
				$(editableObj).css("background","#FDFDFD");	
				nK3.ajax.reload(null, false);	
			}          
	   });
	}
</script>
</body>
</html>
