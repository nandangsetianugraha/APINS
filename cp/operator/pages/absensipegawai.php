<?php 
include "../inc/lte-head.php";
if(isset($_GET['tglbro'])){
		$tahun = substr($_GET['tglbro'], 6, 4);
		$bulan = substr($_GET['tglbro'], 0, 2);
		$tanggal   = substr($_GET['tglbro'], 3, 2);
		$tgl=$bulan."/".$tanggal."/".$tahun;
	}else{
		$tahun=isset($_GET['tahun']) ? $_GET['tahun'] : date("Y");
		$tanggal=isset($_GET['tgl']) ? $_GET['tgl'] : date("d");
		$bulan=isset($_GET['bulan']) ? $_GET['bulan'] : date("m");
		$tgl=$bulan."/".$tanggal."/".$tahun;
	};
$sekarang=$tahun."-".$bulan."-".$tanggal;
$hari = date('D', strtotime($sekarang));
	$dayList = array(
		'Sun' => 'Minggu',
		'Mon' => 'Senin',
		'Tue' => 'Selasa',
		'Wed' => 'Rabu',
		'Thu' => 'Kamis',
		'Fri' => 'Jumat',
		'Sat' => 'Sabtu'
	);
?>
<body class="hold-transition skin-blue sidebar-mini">

    <!-- Main content -->
    <section class="content">
	<div class="row">
		<div class="col-lg-12 col-xs-12">
				
			<div class="box">
				<div class="box-header">
				  <h3 class="box-title">
					<div class="row">
						<div class="col-sm-2">
							<form class="form" action="absensipegawai.php" method="GET" id="tabID">
								<div class="input-group date">
										<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
										<input type="text" class="form-control pull-right" autocomplete=off name="tglbro" id="datepicker" value="<?=$tgl;?>" onchange="this.form.submit()">
									</div>
							</form>
						</div>
						<div class="col-sm-10">
							<?=$dayList[$hari];?>, <?=TanggalIndo($sekarang);?>
						</div>	
					</div>
				  </h3>
				  <div class="box-tools pull-right">
				    <a href="#" class="btn" title="Hapus Semua Transaksi Tanggal <?=TanggalIndo($sekarang);?>" type="button" data-toggle="modal" data-target="#hapusTrans" onclick="hapusTr('<?=$sekarang;?>')"><i class="fa fa-trash"></i></a>
					<a href="upload/form.php" title="Upload Data Transaksi" class="btn">
						<i class="fa fa-upload"></i>
					</a>
					<a href="../../cetak/tabunganharian.php?tanggal=<?=$sekarang;?>" title="Cetak Data Transaksi Tanggal <?=TanggalIndo($sekarang);?>" class="btn" target="_blank">
						<i class="fa fa-print"></i>
					</a>
				  </div>
				</div>
				<div class="box-body table-responsive">
					<table id="manageMemberTable" class="table table-bordered table-hover">
                        <thead>
                                           <tr>
												<th class="text-center">ID</th>
												<th class="text-center">Nama</th>
												<th class="text-center">Absen Masuk</th>
												<th class="text-center">Absen Keluar</th>
												<th class="text-center">Telat</th>
												<th class="text-center">Pulang Cepat</th>
												<th class="text-center"></th>
											</tr>
                                        </thead>
                                        <tbody>
										
                                        </tbody>
                    </table>
				</div>
			</div>
		</div>
	</div>
		<!--Delete Tabungan-->
		<div class="modal fade" id="hapusTabModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data</h4>
              </div>
                        <div class="modal-body">
							<p>Hapus Data Absen?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light" id="hapusBtn">Ya</button>
                        </div>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<!--Delete Transaksi-->
		
        <!-- /.modal -->
		
		<div class="modal fade" id="absenmanual">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Absen Manual</h4>
              </div>
                        <form class="form-horizontal" action="../modul/ptk/absenmanual.php" autocomplete="off" method="POST" id="absenmanualForm">
						<div class="modal-body absenmanual">
							<div class="absenmanual-data"></div>
						</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Update</button>
                        </div>
						</form>
						
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<div class="modal fade" id="ijinmanual">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ijin Pegawai</h4>
              </div>
                        <form class="form-horizontal" action="../modul/ptk/ijinmanual.php" autocomplete="off" method="POST" id="ijinmanualForm">
						<div class="modal-body ijinmanual">
							<div class="ijinmanual-data"></div>
						</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Update</button>
                        </div>
						</form>
						
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		
				
	
    </section>
    <!-- /.content -->
<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
	var manageMemberTable;
	$(document).ready(function() {
		$('#datepicker').datepicker({
		  autoclose: true
		});
		manageMemberTable = $("#manageMemberTable").DataTable({
			"ajax": "../modul/ptk/dataAbsen.php?tanggal_now=<?=$sekarang;?>",
			"order": []
		});
		$('#absenmanual').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
			var hari = $(e.relatedTarget).data('tgl');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : '../modul/ptk/modal_absen.php',
                data :  'rowid='+ rowid + '&hari='+ hari,
				beforeSend: function()
						{	
							$(".absenmanual-data").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...');
						},
                success : function(data){
                $('.absenmanual-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
		 $("#absenmanualForm").unbind('submit').bind('submit', function() {
						// remove error messages
						$(".text-danger").remove();

						var form = $(this);

							$.ajax({
								url: form.attr('action'),
								type: form.attr('method'),
								data: form.serialize(),
								dataType: 'json',
								success:function(response) {
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
										// reload the datatables
										manageMemberTable.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
										$("#absenmanual").modal('hide');
									} else {
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
									}
								} // /success
							}); // /ajax

						return false;
					});
			$('#ijinmanual').on('show.bs.modal', function (e) {
				var rowid = $(e.relatedTarget).data('ids');
				var hari = $(e.relatedTarget).data('tgls');
				//menggunakan fungsi ajax untuk pengambilan data
				$.ajax({
					type : 'post',
					url : '../modul/ptk/modal_ijin.php',
					data :  'rowid='+ rowid + '&hari='+ hari,
					beforeSend: function()
							{	
								$(".ijinmanual-data").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...');
							},
					success : function(data){
					$('.ijinmanual-data').html(data);//menampilkan data ke dalam modal
					}
				});
			 });
			$("#ijinmanualForm").unbind('submit').bind('submit', function() {
						// remove error messages
						$(".text-danger").remove();

						var form = $(this);

							$.ajax({
								url: form.attr('action'),
								type: form.attr('method'),
								data: form.serialize(),
								dataType: 'json',
								beforeSend: function()
								{	
									$(".ijinmanual-data").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...');
								},
								success:function(response) {
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
										// reload the datatables
										manageMemberTable.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
										$("#ijinmanual").modal('hide');
									} else {
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
									}
								} // /success
							}); // /ajax

						return false;
					});
	});
	function hapusTab(id = null) {
		if(id) {
			// click on remove button
			$("#hapusBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/ptk/hapusabsen.php',
					type: 'post',
					data: {member_id : id},
					dataType: 'json',
					success:function(response) {
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
							manageMemberTable.ajax.reload(null, false);
							// close the modal
							$("#hapusTabModal").modal('hide');
						} else {
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
						}
					}
				});
			}); // click remove btn
		} else {
			alert('Error: Refresh the page again');
		}
	}
	
</script>
</body>
</html>
