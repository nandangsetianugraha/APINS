<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
?>
<?php 
if($level==98 or $level==97){
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Prestasi Siswa Semester <?=$smt;?>
        <small>Kelas <?=$kelas;?></small>
    </h1>
</section>
<?php 
};
?>
<!-- Main content -->
<section class="content">

<?php 
if($level==98 or $level==97){
?>


    
		
						<table id="manageMemberTable" class="table table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
												<th class="text-center">Nama Siswa</th>
												<th class="text-center">Kesenian</th>
												<th class="text-center">Olahraga</th>
												<th class="text-center">Akademik</th>
											</tr>
                                        </thead>
                                        <tbody>
										
                                        </tbody>
                                    </table>
		
		
		
		<!--Delete Tema-->
		
	
		
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
	var manageMemberTable;
	$(document).ready(function() {
		manageMemberTable = $("#manageMemberTable").DataTable({
			"ajax": "../modul/siswa/prestasi.php?kelas=<?=$kelas;?>&smt=<?=$smt_aktif;?>&tapel=<?=$tpl_aktif;?>",
			"order": []
		});
	});
	function highlightEdit(editableObj) {
		$(editableObj).css("background","#FFF0000");
	} 
	function simpankes(editableObj,column,id,smt,tapel) {
		// no change change made then return false
		if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
		return false;
		// send ajax to update value
		$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
		$.ajax({
			url: "../modul/siswa/savePres.php",
			cache: false,
			data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id+'&smt='+smt+'&tapel='+tapel,
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