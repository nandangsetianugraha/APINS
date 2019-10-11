<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
	$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
	$tema=isset($_GET['tema']) ? $_GET['tema'] : '1';
	
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 2;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
	$ab=substr($romb, 0, 1);
	
	if($smt==1){
		$tema=isset($_GET['tema']) ? $_GET['tema'] : '1';
	}else{
			if($ab>3){
			$tema=isset($_GET['tema']) ? $_GET['tema'] : '5';
		}else{
			$tema=isset($_GET['tema']) ? $_GET['tema'] : '1';
		};
	};
	$peta=3;
	$sql_asp=mysqli_query($koneksi, "select * from aspek where kd_aspek='$peta'");
	$nama_asp=mysqli_fetch_array($sql_asp);
	$sqltema=mysqli_query($koneksi, "select * from tema where kelas='$ab' and smt='$smt'");
	$jtema=mysqli_num_rows($sqltema);
	$sqlkd=mysqli_query($koneksi, "select * from kd where kelas='$ab' and aspek='$peta' and mapel='$mpid'");
	$sql_mp=mysqli_query($koneksi, "select * from mapel where id_mapel='$mpid'");
	$nama_mp=mysqli_fetch_array($sql_mp);
	$sql2 = "select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='$peta' and mapel='$mpid' group by nama_peta limit 0,1";
	$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
	$jw=mysqli_num_rows($qu3);
	$po=mysqli_fetch_array($qu3);
	$kd = isset($_GET['kd']) ? $_GET['kd'] : $po['nama_peta'];										
	$mpm=mysqli_fetch_array(mysqli_query($koneksi, "select * from mapel where id_mapel='$mpid'"));
?>

    <!-- Main content -->
    <section class="content">
				<form class="form-horizontal" action="pts.php" method="GET">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Mata Pelajaran</label>
					<input type="hidden" name="kelas" class="form-control" value="<?php echo $romb;?>">
					<input type="hidden" name="tapel" class="form-control" value="<?php echo $tapel;?>">
					<input type="hidden" name="smt" class="form-control" value="<?php echo $smt;?>">
					<input type="hidden" name="peta" class="form-control" value="3">
					<div class="col-sm-10">
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
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>
					<input type="hidden" name="tapel" class="form-control" value="<?php echo $tapel;?>">
					<input type="hidden" name="smt" class="form-control" value="<?php echo $smt;?>">
					<input type="hidden" name="peta" class="form-control" value="3">
					<input type="hidden" name="mp" class="form-control" value="<?=$mpid;?>">
					<div class="col-sm-10">
					<select class="form-control" name="kelas" onchange="this.form.submit()">
					<?php 
					$sql2 = "select * from rombel where tapel='$tapel' order by nama_rombel asc";
					$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
					while($po=mysqli_fetch_array($qu3)){;
					?>
						<option value="<?=$po['nama_rombel'];?>" <?php if($po['nama_rombel']==$romb){echo "selected";}; ?>><?=$po['nama_rombel'];?></option>
					<?php };?>
					</select>
					</div>
				</div>
				</form>
		<div class="box box-primary">
			<div class="box-header">
              <h3 class="box-title">Penilaian Tengah Semester <?=$mpm['nama_mapel'];?> Kelas <?=$romb;?></h3>
			  <div class="box-tools pull-right">
				<?php if($jw>0){ ?>
				<form role="form" action="pts.php" method="GET">
				<div class="form-group">
					<input type="hidden" name="kelas" class="form-control" value="<?php echo $romb;?>">
					<input type="hidden" name="tapel" class="form-control" value="<?php echo $tapel;?>">
					<input type="hidden" name="smt" class="form-control" value="<?php echo $smt;?>">
					<input type="hidden" name="mp" class="form-control" value="<?php echo $mpid;?>">
					<input type="hidden" name="peta" class="form-control" value="3">
					<select class="form-control" name="kd" onchange="this.form.submit()">
					<?php 
					$sql2 = "select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='$peta' and mapel='$mpid' group by nama_peta order by nama_peta asc";
					$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
					while($po=mysqli_fetch_array($qu3)){;
					?>
						<option value="<?=$po['nama_peta'];?>" <?php if($kd===$po['nama_peta']){echo "selected";}; ?>>KD <?=$po['nama_peta'];?></option>
					<?php };?>
					</select>
				</div>
				</form>
				<?php }; ?>
              </div>
            </div>
			<div class="box-body">
				<?php 
											
											
											if($jw>0){
				?>
				<table id="nilaiPTS" class="table table-bordered table-hover table-responsive no-padding">
					<thead>
													   <tr>
															<th>Nama Siswa</th>
															<th>KD <?=$kd;?></th>
														</tr>
													</thead>
					<tbody>	
													
					</tbody>
				</table>
											<?php }else{ ?>
				<div class="callout callout-success">
					<h4>Belum mempunyai Kompetensi Dasar</h4>
				</div>
											<?php };?>
				
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
		nK3 = $("#nilaiPTS").DataTable({
				"searching": false,
				"ajax": "../modul/semester/dataK3.php?kelas=<?=$romb;?>&tapel=<?=$tapel;?>&smt=<?=$smt;?>&mp=<?=$mpid;?>&peta=3&kd=<?=$kd;?>",
				"order": []
			});
	});
	function highlightEdit(editableObj) {
		$(editableObj).css("background","#FFF0000");
	} 
	function saveUT(editableObj,column,id,kelas,smt,tapel,mpid,kd) {
		// no change change made then return false
		if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
		return false;
		// send ajax to update value
		$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
		$.ajax({
			url: "../modul/semester/saveNPTS.php",
			cache: false,
			data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id+'&kelas='+kelas+'&smt='+smt+'&tapel='+tapel+'&mp='+mpid+'&kd='+kd,
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
