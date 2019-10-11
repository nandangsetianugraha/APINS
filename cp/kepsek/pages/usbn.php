<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
?>
    

    <!-- Main content -->
    <section class="content">

		<div class="box box-primary">
			<div class="box-header">
              <h3 class="box-title">Nilai Ujian Nasional</h3>
			  <div class="box-tools pull-right">
				
              </div>
            </div>
			<div class="box-body table-responsive">
				
				<table id="nilaiUN" class="table table-bordered table-hover">
					<thead>
													   <tr>
															<th>Nomor Peserta</th>
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
		nK3 = $("#nilaiUN").DataTable({
				"searching": false,
				"ajax": "../modul/usbn/dataUN.php?tapel=<?=$tapel;?>&kelas=<?=$kelas;?>",
				"order": []
			});
	});
	function highlightEdit(editableObj) {
		$(editableObj).css("background","#FFF0000");
	} 
	function saveUN(editableObj,column,id,mpid) {
		// no change change made then return false
		if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
		return false;
		// send ajax to update value
		$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
		$.ajax({
			url: "../modul/usbn/saveUSM.php",
			cache: false,
			data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id+'&mp='+mpid,
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
