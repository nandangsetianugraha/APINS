<?php 
include "../inc/lte-head.php";
$idp=isset($_GET['idp']) ? $_GET['idp'] : 0;
$bio = mysqli_fetch_array(mysqli_query($koneksi, "select * from berita where id='$idp'"));
$tanggal=$bio['tanggal'];
$tgl=substr($tanggal,8,2);
$bln=substr($tanggal,5,2);
$thn=substr($tanggal,0,4);
$waktu=$bln."/".$tgl."/".$thn;
?>
<body class="hold-transition skin-blue sidebar-mini">


    <!-- Main content -->
    <section class="content">
	<?php 
	if(isset($_GET['status'])) {
		if($_GET['status']==='kosong'){
	?>
		<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Error</h4>
            Isi Yang benar Bung
        </div>
	<?php
			
		};
		if($_GET['status']==='sukses'){
	?>
		<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Sukses</h4>
            Artikel sudah diperbaharui
        </div>
	<?php
			
		};
		if($_GET['status']==='gagal'){
	?>
		<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Error</h4>
            Gagal Bung!!
        </div>
	<?php
			
		};
	};
	?>
		<div class="row">
			<div class="col-md-12">
<?php 

?>
			<form class="form-horizontal" autocomplete="off" action="../modul/blog/simpanblog.php" method="POST" id="artikelForm">
					<div class="form-group">
						<label for="inputName" class="col-sm-2 control-label">Tanggal</label>
						<div class="col-sm-10">
							<div class="input-group date">
							  <div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							  </div>
							  <input type="text" class="form-control pull-right" name="tanggal" id="datepicker" value="<?=$waktu;?>">
							  <input type="hidden" name="id" class="form-control" value="<?=$idp;?>">
							</div>
						</div>
						<!-- /.input group -->
					</div>
					<div class="form-group">
						<label for="inputName" class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="judul" value="<?=$bio['judul'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="inputName" class="col-sm-2 control-label">Isi Artikel</label>
						<div class="col-sm-10">
						  <textarea id="editor1" name="isiartikel" rows="10" cols="80"><?=$bio['isi'];?></textarea>
						</div>
					</div>
					<div class="form-group">
					<div class="col-sm-2">
					</div>
						<div class="col-sm-8">
						  <a href="./blog.php" class="btn btn-primary"><b>Kembali</b></a>
						</div>
						<div class="col-sm-2">
						  <button type="submit" class="btn btn-danger">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
    </section>
    <!-- /.content -->
  
		
<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../../../dist/js/croppie.js"></script>

<script>
$(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  });
	$(document).ready(function() {
		$('#datepicker').datepicker({
		  autoclose: true
		});
			
	});
</script>
</body>
</html>
