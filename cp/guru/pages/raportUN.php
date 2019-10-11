<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
	$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
	$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
	$kelas=isset($_GET['kelas']) ? $_GET['kelas'] : '6A';	
	$mpid=isset($_GET['mp']) ? $_GET['mp'] : '1';
?>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<form class="form-horizontal" action="raportUN.php" method="GET">	
									<div class="form-group">
										<label for="inputName" class="col-sm-2 control-label">Kelas</label>
										<div class="col-sm-4">
											<input type="hidden" id="tapel" name="tapel" class="form-control" value="<?php echo $tapel;?>">
											<select class="form-control" name="kelas" onchange="this.form.submit()">
												<option value="6A" <?php if ($kelas==="6A"){echo "selected";}?>>Kelas 6A</option>
												<option value="6B" <?php if ($kelas==="6B"){echo "selected";}?>>Kelas 6B</option>
											</select>
										</div>
										<div class="col-sm-4">
											<select class="form-control" name="mp" onchange="this.form.submit()">
												<?php 
												$sql2 = "select * from mapel";
												$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
												while($po=mysqli_fetch_array($qu3)){;
												?>
												<option value="<?=$po['id_mapel'];?>" <?php if($mpid==$po['id_mapel']){echo "selected";}; ?>><?=$po['nama_mapel'];?></option>
												<?php };?>
											</select>
										</div>
									</div>
								</form>
			</div>
			<div class="col-lg-12 col-xs-12">
				
						<div class="box box-primary">
							<div class="box-header">
							  <h3 class="box-title">Kelengkapan Raport Kelas <?=$kelas;?></h3>
							  <div class="box-tools pull-right">
								<a href="../../../cetak/cetakraport.php?kelas=<?=$kelas;?>&tapel=<?=$tapel;?>&mapel=<?=$mpid;?>" target="_blank" type="button" class="btn btn-box-tool"><i class="fa fa-print"></i> Cetak</a>
							  </div>
							</div>
							<div class="box-body table-responsive">
								<table id="raportUN" class="table table-bordered table-hover">
					<thead>
													   <tr>
															<th>Nama Siswa</th>
															<th>Semester 7</th>
															<th>Semester 8</th>
															<th>Semester 9</th>
															<th>Semester 10</th>
															<th>Semester 11</th>
															<th>Semester 12</th>
															<th>Rerata</th>
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

<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" class="init">
	var nK3;
	$(document).ready(function() {
		nK3 = $("#raportUN").DataTable({
				"searching": false,
				"ajax": "../modul/usbn/dataRaport.php?kelas=<?=$kelas;?>&tapel=<?=$tapel;?>&mp=<?=$mpid;?>",
				"order": []
			});
	});
	function highlightEdit(editableObj) {
		$(editableObj).css("background","#FFF0000");
	} 
	function saveUA(editableObj,column,id,kelas,smt,mpid) {
		// no change change made then return false
		if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
		return false;
		// send ajax to update value
		$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
		$.ajax({
			url: "../modul/usbn/saveRaport.php",
			cache: false,
			data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id+'&kelas='+kelas+'&smt='+smt+'&mp='+mpid,
			success: function(response)  {
				console.log(response);
				// set updated value as old value
				$(editableObj).attr('data-old_value',editableObj.innerHTML);
				$(editableObj).css("background","#FDFDFD");	
				nK3.ajax.reload(null, false);	
				$.amaran({
					'theme'     :'awesome ok',
					'content'   :{
						title:'Sukses!',
						message:'Nilai Raport berhasil dimasukkan!',
						info:'',
						icon:'fa fa-check-square-o'
					},
					'position'  :'bottom right',
					'outEffect' :'slideBottom'
				});
			}          
	   });
	}
</script>
</body>
</html>
