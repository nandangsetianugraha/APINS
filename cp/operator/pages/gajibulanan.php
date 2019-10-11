<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$bln=isset($_GET['bln']) ? $_GET['bln'] : date("m");
$thn=isset($_GET['thn']) ? $_GET['thn'] : date("Y");
$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Gaji Bulan 
        <small>SD Islam Al-Jannah</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">
				<form class="form" action="gajibulanan.php" method="GET" id="tabID">
								<div class="row">
								<div class="col-lg-6 col-xs-6">
										<div class="form-group">
											<select class="form-control" name="bln" onchange="this.form.submit()">
												<option value="07" <?php if($bln==="07"){echo "selected";}; ?>>Juli</option>
												<option value="08" <?php if($bln==="08"){echo "selected";}; ?>>Agustus</option>
												<option value="09" <?php if($bln==="09"){echo "selected";}; ?>>September</option>
												<option value="10" <?php if($bln==="10"){echo "selected";}; ?>>Oktober</option>
												<option value="11" <?php if($bln==="11"){echo "selected";}; ?>>November</option>
												<option value="12" <?php if($bln==="12"){echo "selected";}; ?>>Desember</option>
												<option value="01" <?php if($bln==="01"){echo "selected";}; ?>>Januari</option>
												<option value="02" <?php if($bln==="02"){echo "selected";}; ?>>Februari</option>
												<option value="03" <?php if($bln==="03"){echo "selected";}; ?>>Maret</option>
												<option value="04" <?php if($bln==="04"){echo "selected";}; ?>>April</option>
												<option value="05" <?php if($bln==="05"){echo "selected";}; ?>>Mei</option>
												<option value="06" <?php if($bln==="06"){echo "selected";}; ?>>Juni</option>
											</select>
										</div>
								</div>
								<div class="col-lg-6 col-xs-6">
										<div class="form-group">
											<select class="form-control" name="thn" onchange="this.form.submit()">
											<?php
											$now=date('Y');
											for ($a=2012;$a<=$now;$a++){
											?>
												<option value="<?=$a;?>" <?php if(($thn)==$a){echo "selected";}; ?>><?=$a;?> </option>
											<?php 
											}
											?>
											</select>
										</div>
								</div>
								</div>
							</form>
			</h3>
			<div class="box-tools pull-right">
				<a href="../../cetak/rekapgaji.php?bln=<?=$bln;?>&thn=<?=$thn;?>" title="Cetak Rekap Gaji Bulan <?=$bulan[(int)$bln-1];?> <?=$thn;?>" class="btn" target="_blank">
						<i class="fa fa-print"></i> Cetak
					</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table id="manageMemberTable" class="table table-bordered table-hover table-responsive">
                <thead>
                    <tr>
						<th class="text-center">ID Pegawai</th>
						<th class="text-center">Nama Pegawai</th>
						<th class="text-center">Hari Kerja</th>
						<th class="text-center">Absen Kerja</th>
						<th class="text-center">Absen Ekskul</th>
						<th class="text-center">Terlambat</th>
						<th class="text-center">Pulang Cepat</th>
					</tr>
                </thead>
                <tbody>
										
                </tbody>
            </table>
		</div>
	</div>

		
						
		
		
		
		<!--Delete Tema-->
		
	
		

</section>
<!-- /.content -->

<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	
<script>
	var manageMemberTable;
	$(document).ready(function() {
		manageMemberTable = $("#manageMemberTable").DataTable({
			"ajax": "../modul/penggajian/bulanan.php?bln=<?=$bln;?>&thn=<?=$thn;?>",
			"order": []
		});
	});
	function highlightEdit(editableObj) {
		$(editableObj).css("background","#FFF0000");
	} 
	function simpankes(editableObj,column,id,bln,thn) {
		// no change change made then return false
		if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
		return false;
		// send ajax to update value
		$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
		$.ajax({
			url: "../modul/penggajian/saveBul.php",
			cache: false,
			data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id+'&bln='+bln+'&thn='+thn,
			success: function(response)  {
				console.log(response);
				// set updated value as old value
				$(editableObj).attr('data-old_value',editableObj.innerHTML);
				$(editableObj).css("background","#FDFDFD");	
				
			}          
	   });
	}
</script>
</body>
</html>	