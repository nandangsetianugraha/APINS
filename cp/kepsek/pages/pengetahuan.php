<?php 
include "../inc/lte-head.php";
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
	$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
	
if($level==96){ //guru pai
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 1;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
	$ab=substr($romb, 0, 1);
};
if($level==95){ //guru penjas
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 8;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
	$ab=substr($romb, 0, 1);
};
if($level==94){ //guru bahasa inggris
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 10;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
	$ab=substr($romb, 0, 1);
};
if($level==97){ //guru pendamping
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 2;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : $kelas;
	$ab=substr($romb, 0, 1);
};
if($level==98){ //guru kelas
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 2;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : $kelas;
	$ab=substr($romb, 0, 1);
};
	
	if($smt==1){
		$tema=isset($_GET['tema']) ? $_GET['tema'] : '1';
	}else{
			if($ab>3){
			$tema=isset($_GET['tema']) ? $_GET['tema'] : '6';
		}else{
			$tema=isset($_GET['tema']) ? $_GET['tema'] : '5';
		};
	};
	$peta=3;
	$kd = isset($_GET['kd']) ? $_GET['kd'] : '0';										
	$sql_asp=mysqli_query($koneksi, "select * from aspek where kd_aspek='$peta'");
	$nama_asp=mysqli_fetch_array($sql_asp);
	$sqltema=mysqli_query($koneksi, "select * from tema where kelas='$ab' and smt='$smt'");
	$jtema=mysqli_num_rows($sqltema);
	$sqlkd=mysqli_query($koneksi, "select * from kd where kelas='$ab' and aspek='$peta' and mapel='$mpid'");
	$sql_mp=mysqli_query($koneksi, "select * from mapel where id_mapel='$mpid'");
	$nama_mp=mysqli_fetch_array($sql_mp);
	
?>
    <!-- Main content -->
    <section class="content">
		<div class="box box-primary">
			<div class="box-body">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<div class="form-group">
							<?php if($level==94 or $level==95 or $level==96){?>
							<select class="form-control" id="kelas" name="kelas">
							<?php 
													$sql_mk=mysqli_query($koneksi, "select * from rombel where tapel='$tapel' order by nama_rombel asc");
													while($nk=mysqli_fetch_array($sql_mk)){
													?>
													<option value="<?=$nk['nama_rombel'];?>" <?php if($nk['nama_rombel']==$romb){echo "selected";}; ?>><?=$nk['nama_rombel'];?></option>
													<?php };?>
							</select>
							<?php }else{ ?>
							<select class="form-control" id="kelas" name="kelas">
								<option value="<?=$romb;?>"><?=$romb;?></option>
							</select>
							<?php }; ?>
						</div>
					</div>
					<div class="col-lg-3 col-xs-12">
						<div class="form-group">
							<?php if($level==98 or $level==97){ ?>
							<select class="form-control" id="mp" name="mp">
								<option value="0">==Pilih Mapel==</option>
							<?php 
							$sql2 = "select * from mapel";
							$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));
							while($po=mysqli_fetch_array($qu3)){
								$idmp=$po['id_mapel'];
								if($idmp==1 or $idmp==10){
									
								}else{
									if($ab<4 and ($idmp==5 or $idmp==6)){
										
									}else{
										if($ab>3 and $idmp==8){
											
										}else{
							?>
								<option value="<?=$po['id_mapel'];?>"><?=$po['nama_mapel'];?></option>
							<?php };
							};
							};
							};?>
							</select>
							<?php }; ?>
							<?php if($level==96){ //mapel PAI ?>
							<select class="form-control" id="mp" name="mp">
								<option value="0">==Pilih Mapel==</option>
								<option value="1">Pendidikan Agama Islam</option>
							</select>
							<?php }; ?>
							<?php if($level==95){ //mapel PJOK ?>
							<select class="form-control" id="mp" name="mp">
								<option value="0">==Pilih Mapel==</option>
								<option value="8">Pend. Jasmani Olahraga dan Kesehatan</option>
							</select>
							<?php }; ?>
							<?php if($level==94){ //mapel Inggris ?>
							<select class="form-control" id="mp" name="mp">
								<option value="0">==Pilih Mapel==</option>
								<option value="10">Bahasa Inggris</option>
							</select>
							<?php }; ?>
							
						</div>
					</div>
					<div class="col-lg-3 col-xs-12">
						<div class="form-group">
							<select class="form-control" id="tema" name="tema">
							
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-xs-12">
						<div class="form-group">
							<select class="form-control" id="tapel" name="tapel">
								<option value="<?=$tapel;?>"><?=$tapel;?></option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-header">
              <h3 class="box-title"></h3>
			  <div class="box-tools pull-right">
				<div class="form-group">
					<?php 
											$tma1=mysqli_query($koneksi, "select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='3' and mapel='$mpid' and tema='$tema'");
											$jpet1=mysqli_num_rows($tma1);
											if($jpet1>0){
											$s=mysqli_fetch_array($tma1);
												$jpet=mysqli_num_rows($tma1);
												if($jpet>0){
											?>
					<select class="form-control" id="kd" name="kd">
					
					</select>
											<?php }}; ?>
				</div>
			  </div>
            </div>
			<div class="box-body">
				<div class="row">
					<div class="col-lg-12 col-xs-12 table-responsive">
						<div id="nilaiHarian">
							<div class="alert alert-info alert-dismissible">
								<h4><i class="icon fa fa-info"></i> Informasi</h4>
								Silahkan Pilih Mata Pelajaran
							</div>
						</div>
						<br/>
					</div>
					
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
	$(document).ready(function() {
		<?php if($level==98 or $level==97){ ?>
		$('#mp').change(function(){
			//Mengambil value dari option select mp kemudian parameternya dikirim menggunakan ajax
			var mp = $('#mp').val();
			var kelas=$('#kelas').val();
			var smt=<?=$smt;?>;
			var peta=<?=$peta;?>;
			
			$.ajax({
				type : 'GET',
				url : 'tm.php',
				data :  'mpid=' + mp+'&kelas='+kelas+'&smt='+smt+'&peta='+peta,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#tema").html(data);
					$("#kd").html('');
					$("#nilaiHarian").html('<div class="alert alert-info alert-dismissible"><h4><i class="icon fa fa-info"></i> Informasi</h4>Silahkan Pilih Tema/Pembelajaran</div>');
				}
			});
		});
		$('#tema').change(function(){
			//Mengambil value dari option select mp kemudian parameternya dikirim menggunakan ajax
			var mp = $('#mp').val();
			var kelas=$('#kelas').val();
			var smt=<?=$smt;?>;
			var peta=<?=$peta;?>;
			var tema=$('#tema').val();
			
			$.ajax({
				type : 'GET',
				url : 'mp.php',
				data :  'mpid=' + mp+'&kelas='+kelas+'&smt='+smt+'&peta='+peta+'&tema='+tema,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#kd").html(data);
					$("#nilaiHarian").html('<div class="alert alert-info alert-dismissible"><h4><i class="icon fa fa-info"></i> Informasi</h4>Silahkan Pilih Kompetensi Dasar (KD)</div>');
				}
			});
		});
		$('#kd').change(function(){
			//Mengambil value dari option select kd kemudian parameternya dikirim menggunakan ajax
			var kd = $('#kd').val();
			var mp = $('#mp').val();
			var kelas=$('#kelas').val();
			var smt=<?=$smt;?>;
			var peta=<?=$peta;?>;
			var tema=$('#tema').val();
			var tapel=$('#tapel').val();
			var boleh=<?=$boleh;?>
			
			$.ajax({
				type : 'GET',
				url : '../modul/harian/NilaiPeng.php',
				data :  'mp=' + mp+'&kelas='+kelas+'&smt='+smt+'&peta='+peta+'&tema='+tema+'&tapel='+tapel+'&kd='+kd,
				beforeSend: function()
				{	
					$("#nilaiHarian").html('<center><img src="facebook-1.gif"><br/>Memuat Data Nilai Harian....Harap Bersabar.</center>');
				},
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kd
					$("#nilaiHarian").html(data);
				}
			});
		});
		
		<?php }else{ ?>
		$('#kelas').change(function(){
			//Mengambil value dari option select kd kemudian parameternya dikirim menggunakan ajax
			var kelas=$('#kelas').val();
			var level=<?=$level;?>;
			
			$.ajax({
				type : 'GET',
				url : 'mpl.php',
				data :  'kelas=' +kelas+'&level='+level,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#mp").html(data);
					$("#tema").html('');
					$("#kd").html('');
					$("#nilaiHarian").html('<div class="alert alert-info alert-dismissible"><h4><i class="icon fa fa-info"></i> Informasi</h4>Silahkan Pilih Mata Pelajaran</div>');
				}
			});
		});
		$('#mp').change(function(){
			//Mengambil value dari option select mp kemudian parameternya dikirim menggunakan ajax
			var mp = $('#mp').val();
			var kelas=$('#kelas').val();
			var smt=<?=$smt;?>;
			var peta=<?=$peta;?>;
			
			$.ajax({
				type : 'GET',
				url : 'tm.php',
				data :  'mpid=' + mp+'&kelas='+kelas+'&smt='+smt+'&peta='+peta,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#tema").html(data);
					$("#nilaiHarian").html('<div class="alert alert-info alert-dismissible"><h4><i class="icon fa fa-info"></i> Informasi</h4>Silahkan Pilih Tema/Pembelajaran</div>');
				}
			});
		});
		$('#tema').change(function(){
			//Mengambil value dari option select mp kemudian parameternya dikirim menggunakan ajax
			var mp = $('#mp').val();
			var kelas=$('#kelas').val();
			var smt=<?=$smt;?>;
			var peta=<?=$peta;?>;
			var tema=$('#tema').val();
			
			$.ajax({
				type : 'GET',
				url : 'mp.php',
				data :  'mpid=' + mp+'&kelas='+kelas+'&smt='+smt+'&peta='+peta+'&tema='+tema,
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
					$("#kd").html(data);
					$("#nilaiHarian").html('<div class="alert alert-info alert-dismissible"><h4><i class="icon fa fa-info"></i> Informasi</h4>Silahkan Pilih Kompetensi Dasar (KD)</div>');
				}
			});
		});
		$('#kd').change(function(){
			//Mengambil value dari option select kd kemudian parameternya dikirim menggunakan ajax
			var kd = $('#kd').val();
			var mp = $('#mp').val();
			var kelas=$('#kelas').val();
			var smt=<?=$smt;?>;
			var peta=<?=$peta;?>;
			var tema=$('#tema').val();
			var tapel=$('#tapel').val();
			
			$.ajax({
				type : 'GET',
				url : '../modul/harian/NilaiPeng.php',
				data :  'mp=' + mp+'&kelas='+kelas+'&smt='+smt+'&peta='+peta+'&tema='+tema+'&tapel='+tapel+'&kd='+kd,
				beforeSend: function()
				{	
					$("#nilaiHarian").html('<center><img src="facebook-1.gif"><br/>Memuat Data Nilai Harian....Harap Bersabar.</center>');
				},
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kd
					$("#nilaiHarian").html(data);
				}
			});
		});
		<?php }; ?>
	});
	function highlightEdit(editableObj) {
		$(editableObj).css("background","#FFF0000");
	} 
	function saveHarian(editableObj,column,id,kelas,smt,tapel,mpid,kd,jns,tema) {
		// no change change made then return false
		if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
		return false;
		// send ajax to update value
		$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
		$.ajax({
			url: "../modul/harian/saveHarian.php",
			cache: false,
			data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id+'&kelas='+kelas+'&smt='+smt+'&tapel='+tapel+'&mp='+mpid+'&kd='+kd+'&jns='+jns+'&tema='+tema,
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