<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Tunjangan Pegawai
        <small>SD Islam Al-Jannah</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">

		
						<table id="manageMemberTable" class="table table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
												<th class="text-center">ID Pegawai</th>
												<th class="text-center">Nama Pegawai</th>
												<th class="text-center">Insentif/Jam</th>
												<th class="text-center">Transport</th>
												<th class="text-center">Jabatan</th>
												<th class="text-center">Kepsek</th>
												<th class="text-center">Kehadiran</th>
												<th class="text-center">Ekskul</th>
											</tr>
                                        </thead>
                                        <tbody>
										
                                        </tbody>
                                    </table>
		
		
		
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
			"ajax": "../modul/penggajian/tunjangan.php",
			"order": []
		});
	});
	function highlightEdit(editableObj) {
		$(editableObj).css("background","#FFF0000");
	} 
	function simpankes(editableObj,column,id) {
		// no change change made then return false
		if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
		return false;
		// send ajax to update value
		$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
		$.ajax({
			url: "../modul/penggajian/saveTunj.php",
			cache: false,
			data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id,
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