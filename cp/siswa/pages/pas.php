<?php include "../inc/lte-head.php";?>
</head>
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
$mpid = isset($_GET['mp']) ? $_GET['mp'] : 1;
$peta=3;
$sql_mp=mysqli_query($koneksi, "select * from mapel where id_mapel='$mpid'");
$nama_mp=mysqli_fetch_array($sql_mp);
?>
<body class="hold-transition skin-blue sidebar-mini">    

    <!-- Main content -->
    <section class="content">
		<div class="box box-primary">
			<div class="box-body">
				<form role="form" action="../pages/pas.php" method="GET">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<div class="form-group">
							<input type="hidden" name="tapel" class="form-control" value="<?php echo $tapel;?>">
							<input type="hidden" name="smt" class="form-control" value="<?php echo $smt;?>">
							<select class="form-control" name="mp" onchange="this.form.submit()">
							<?php 
							$sql2 = "select * from mapel";
							$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
							while($po=mysqli_fetch_array($qu3)){;
							?>
								<option value="<?=$po['id_mapel'];?>" <?php if($po['id_mapel']==$mpid){echo "selected";}; ?>><?=$po['nama_mapel'];?></option>
							<?php };?>
							</select>
							
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-header">
              <h3 class="box-title"><?php 
								$mpm=mysqli_fetch_array(mysqli_query($koneksi, "select * from mapel where id_mapel='$mpid'"));
								?>
								Hasil Penilaian Akhir Semester (PAS) <?=$mpm['nama_mapel'];?></h3>
			  <div class="box-tools pull-right">
				
              </div>
            </div>
			<div class="box-body">
				<div class="row">
					<div class="col-lg-9 col-xs-12">
						<table id="nilaiHarian" class="table table-bordered table-hover">
							<thead>
							   <tr>
								<th>KD</th>
									<th>Deskripsi KD</th>
									<th>Nilai</th>
								</tr>
							</thead>
							<tbody>	
								
															
							</tbody>
						</table>
					</div>
					<div class="col-lg-3 col-xs-12">
						<div class="box box-danger">
						<div class="box-header">
						  <h3 class="box-title">Bantuan</h3>
						</div>
						<div class="box-body">
						  Hasil Penilaian Akhir Semester berdasarkan KD KD yang telah dipetakan.
						</div>
						<!-- /.box-body -->
						<!-- Loading (remove the following to stop the loading)-->
						
						<!-- end loading -->
					  </div>
					  <!-- /.box -->
					</div>
				</div>
				
				</div>
			</div>
		</div>
		
    </section>
    <!-- /.content -->


<?php include "../inc/lte-script.php";?>
<script type="text/javascript" language="javascript" class="init">
	var nilaiHarian;
	$(document).ready(function() {
		nilaiHarian = $("#nilaiHarian").DataTable({
				"searching": false,
				"ajax": "../modul/dataPAS.php?kelas=<?=$ab;?>&tapel=<?=$tapel;?>&smt=<?=$smt;?>&mp=<?=$mpid;?>&peta=4&pdid=<?=$idku;?>",
				"order": []
			});
	});
</script>
</body>
</html>
