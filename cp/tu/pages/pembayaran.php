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
		<div class="col-lg-6 col-xs-12">
				<div class="form-group">
					<div class="row">
					<div class="col-sm-12">
						<div class="info-box">
							<span class="info-box-icon bg-aqua"><i class="icon fa fa-user"></i></span>

							<div class="info-box-content">
							  <span class="info-box-text"><h4 class="nama-nasabah">Masukkan Nama Siswa</h4></span>
							  <span class="info-box-number">
								<select id="idsis" class="form-control  selectsiswa" style="width: 100%;" name="idsis">
									<option>Pilih Siswa</option>
									<?php 
									$sql_mk=mysqli_query($koneksi, "select * from siswa where status=1 order by nama asc");
									while($nk=mysqli_fetch_array($sql_mk)){
									?>
									<option value="<?php echo $nk['peserta_didik_id']; ?>"><?=$nk['nama']; ?></option>
									<?php };?>
								</select>
							  </span>
							</div>
							<!-- /.info-box-content -->
						</div>
						  <!-- /.info-box -->
						
						
					</div>
					<div class="col-sm-12">
						<div class="input-group date">
							<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
							<input type="text" class="form-control pull-right" autocomplete=off name="tglbro" id="datepicker" value="<?=$tgl;?>">
						</div>
					</div>
					
					</div>
				</div>
			<div class="box">
				<div class="box-header">
					<div class="box-tools pull-right">
					</div>
				</div>
				<div class="box-body table-responsive">
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
			</div>
			
			<!-- Detail Transaksi-->
			<div class="box">
				<div class="box-header">
					<div class="box-tools pull-right">
					</div>
				</div>
				<div class="box-body table-responsive">
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
			</div>
		</div>
		<div class="col-lg-6 col-xs-12">
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
			
			<!--Transaksi Sekarang-->
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
	$('.selectsiswa').select2();
	$(document).ready(function(){
		$('#prov').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var prov = $('#provinsi').val();
			
			$.ajax({
				type : 'GET',
				url : 'kabupaten.php',
				data :  'prov_id=' + prov,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kabupaten").html(data);
				}
			});
		});

		$('#kab').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var kab = $('#kabupaten').val();
			
			$.ajax({
				type : 'GET',
				url : 'kecamatan.php',
				data :  'id_kabupaten=' + kab,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kecamatan").html(data);
				}
			});
		});

		$('#kec').change(function(){
			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var desa = $('#kecamatan').val();
			
			$.ajax({
				type : 'GET',
				url : 'desa.php',
				data :  'id_kecamatan=' + desa,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#kel").html(data);
					// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
				}
			});
		});
	});
	</script>
</body>
</html>
