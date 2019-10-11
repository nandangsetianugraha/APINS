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
		<div class="col-lg-5 col-xs-12">
			<form class="form" action="tabungan.php" method="GET" id="tabID">
				<div class="form-group">
					<div class="row">
					<div class="col-sm-12">
						<div class="info-box">
							<span class="info-box-icon bg-aqua"><i class="icon fa fa-user"></i></span>

							<div class="info-box-content">
							  <span class="info-box-text"><h4 class="nama-nasabah">Masukkan ID Nasabah</h4></span>
							  <span class="info-box-number"><div class="saldosiswa"></div></span>
							</div>
							<!-- /.info-box-content -->
						</div>
						  <!-- /.info-box -->
						
						
					</div>
					<div class="col-sm-12">
						<div class="input-group date">
							<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
							<input type="text" class="form-control pull-right" autocomplete=off name="tglbro" id="datepicker" value="<?=$tgl;?>" onchange="this.form.submit()">
						</div>
					</div>
					
					</div>
				</div>
				<div class="form-group">
					<div class="row">
					<div class="col-sm-4">
						<label for="output-device">Transaksi</label>
					</div>
					<div class="col-sm-4">
						<label for="output-device">ID Nasabah</label>
					</div>
					<div class="col-sm-4">
						<label for="output-device">Setor (Rp.)</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<select class="form-control select2" name="jenis" style="width: 100%;">
							<option value="1">Setoran</option>
							<option value="2">Pengambilan</option>
						</select>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="idNasabah" name="idNasabah" placeholder="ID Nasabah" autocomplete=off autofocus="autofocus" />
						<span class="form-control-feedback loading"></span>
					</div>
					<div class="col-sm-4">
						<div class="input-group">
						<input type="text" class="form-control" name="pagu" id="rupiah" autocomplete=off />
						<span class="input-group-btn">
						  <button type="submit" id="simpanTab" class="btn btn-info btn-flat"><i class="fa fa-dollar"></i></button>
						</span>
						</div>
					</div>
					</div>
				</div>
            </form>
			
			<table class="table table-striped table-hover">
			  <thead>
				<tr>
				  <th>Tanggal</th>
				  <th>Kode</th>
				  <th>Setor</th>
				  <th>Ambil</th>
				  <th>Saldo</th>
				</tr>
			  </thead>
			  <tbody id="hasilsaldo">
				
				<tr>
				  <td colspan="5"><center>Belum Ada Data</center></td>
				</tr>
			  
			  </tbody>
			</table>
		</div>
		<div class="col-lg-7 col-xs-12">
			<div class="row">
				<div id="transaksi"></div>
			</div>
			<div class="box">
				<div class="box-header">
				  <h3 class="box-title"><?=$dayList[$hari];?>, <?=TanggalIndo($sekarang);?></h3>
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
												<th class="text-center">Nasabah</th>
												<th class="text-center">Kode</th>
												<th class="text-center">Setor</th>
												<th class="text-center">Ambil</th>
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
							<p>Hapus Data Transaksi?</p>
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
		<div class="modal fade" id="hapusTrans">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data</h4>
              </div>
                        <div class="modal-body">
							<p>Hapus Semua Transaksi pada Tanggal <?=TanggalIndo($sekarang);?>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light" id="hapusT">Ya</button>
                        </div>
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
<script type="text/javascript">
		
		var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, '');
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
		}
	</script>
	
<script>

	function usernameInitialization() {
      var timer;
      var doneTypingInterval = 1000;
      var $input = $('#idNasabah');

      $input.on('keyup', function () {
          clearTimeout(timer);
          if($(this).val().length>3 && $(this).val()!== ''){
              timer = setTimeout(doneTyping,doneTypingInterval);
              $("span.loading").addClass("fa fa-spinner fa-spin");
          }else{
              $("span.loading").removeClass("fa fa-spinner fa-spin");
          }
      });

      $input.on('keydown',function () {
          clearTimeout(timer);
      });
  }

  function doneTyping() {
      $.post("ceknasabah.php",$("#tabID").serialize(),function (res) {
          $("span.loading").removeClass("fa fa-spinner fa-spin");
          response = $.parseJSON(res);
          if(response.status!=="no_nasabah"){
              $(".nama-nasabah").html("["+response.IDnasabah+"] "+response.namaLengkap);
			  $(".saldosiswa").html(response.saldo);
			  //clearTimeout(timer);
			  $("#rupiah").focus();
			  
              // console.log(response);
          }else{
              $(".nama-nasabah").html("<div class='text-red animated infinite bounce'>Nasabah tidak terdaftar</div>");
			  $(".saldosiswa").html(response.saldo);
              $("#idNasabah").select();
              // console.log(response);
          }
      });
  }
  
	var manageMemberTable;
	$(document).ready(function() {
		$('#datepicker').datepicker({
		  autoclose: true
		});
		viewTr();
		function viewTr(){
				$.get("../modul/tabungan/transaksi.php?tgl=<?=$sekarang;?>", function(data) {
					$("#transaksi").html(data);
				});
		}
		$('#idNasabah').on('keyup', function() {
			if($(this).val().length>1 && $(this).val()!== ''){
			$.ajax({
			  type: 'POST',
			  url: '../modul/tabungan/lihatsaldo.php',
			  data: {
				search: $(this).val()
			  },
			  cache: false,
			  success: function(data) {
				$('#hasilsaldo').html(data);
			  }
			});
			};
		  });
		/*$('input[type=text]').on('keydown', function(e) {
			if (e.which == 13) {
				e.preventDefault();
				$('input[name="pagu"]').focus();
			}
		});*/
		manageMemberTable = $("#manageMemberTable").DataTable({
			"ajax": "../modul/tabungan/tabhariini.php?tanggal_now=<?=$sekarang;?>",
			"order": []
		});
		$('#datepicker').datepicker({
		  autoclose: true
		});
		$("#simpanTab").on('click', function() {
			// reset the form 
			
			// submit form
			$("#tabID").unbind('submit').bind('submit', function() {

				$(".text-danger").remove();

				var form = $(this);

				

					//submi the form to server
					$.ajax({
						url : "../modul/tabungan/simpan.php",
						type : form.attr('method'),
						data : form.serialize(),
						dataType : 'json',
						success:function(response) {

							// remove the error 
							$(".form-group").removeClass('has-error').removeClass('has-success');

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
								//$("#tambahAbsen").modal('hide');

								// reload the datatables
								viewTr();
								manageMemberTable.ajax.reload(null, false);
								$.ajax({
								  type: 'POST',
								  url: '../modul/tabungan/lihatsaldo.php',
								  data: {
									search: response.idN
								  },
								  cache: false,
								  success: function(data) {
									$('#hasilsaldo').html(data);
								  }
								});
								$(".saldosiswa").html(response.saldo);
								$("#tabID")[0].reset();
								$("#idNasabah").focus();
								// this function is built in function of datatables;

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
								$("#rupiah").select();
							}  // /else
						} // success  
					}); // ajax subit 				
				


				return false;
			}); // /submit form for create member
		}); // /add modal
		
		

		
		
	});
	function hapusTab(id = null) {
		if(id) {
			// click on remove button
			$("#hapusBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/tabungan/hapusdata.php',
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
							viewTr();
							function viewTr(){
									$.get("../modul/tabungan/transaksi.php?tgl=<?=$sekarang;?>", function(data) {
										$("#transaksi").html(data);
									});
							}
							$(".nama-nasabah").html("["+response.idN+"] "+response.nama);
							$(".saldosiswa").html(response.saldo);
							// close the modal
							$("#hapusTabModal").modal('hide');
							$.ajax({
								  type: 'POST',
								  url: '../modul/tabungan/lihatsaldo.php',
								  data: {
									search: response.idN
								  },
								  cache: false,
								  success: function(data) {
									$('#hasilsaldo').html(data);
								  }
								});

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
	function hapusTr(id = null) {
		if(id) {
			// click on remove button
			$("#hapusT").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/tabungan/hapus.php',
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
							viewTr();
							function viewTr(){
									$.get("../modul/tabungan/transaksi.php?tgl=<?=$sekarang;?>", function(data) {
										$("#transaksi").html(data);
									});
							}
							// close the modal
							$("#hapusTrans").modal('hide');
							

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
	
	
	$(function () {
      usernameInitialization();
      $("#idNasabah").focus();
  })
</script>
</body>
</html>
