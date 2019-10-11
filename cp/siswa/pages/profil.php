<?php 
include "../inc/lte-head.php";
if(file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/images/siswa/".$bioku['avatar'])){
	$avatar="../../../images/siswa/".$bioku['avatar'];
}else{
	$avatar="../../../images/user-default.png";
};
?>
<body class="hold-transition skin-blue sidebar-mini">

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-3">
				<!-- Profile Image -->
				<div class="box box-primary">
					<div class="box-body box-profile">
					  <img class="profile-user-img img-responsive img-circle" id="profile_picture" src="<?=$avatar;?>" alt="User profile picture">

					  <h3 class="profile-username text-center"><?=$bioku['nama'];?></h3>

					  
					  <div id="hasilptk"></div>
					  
					</div>
					<!-- /.box-body -->
				</div>
				  <!-- /.box -->
			</div>
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs pull-right">
					  <li><a href="#settings" data-toggle="tab">Settings</a></li>
					  <li><a href="#timeline" data-toggle="tab">Prestasi</a></li>
					  <li class="active"><a href="#activity" data-toggle="tab">Biodata</a></li>
					  <li class="pull-left header"><img src="<?=$avatar;?>" class="img-circle" alt="User Image" height="30px"> Profil</li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="activity">
							<form class="form-horizontal">
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nama</label>

								<div class="col-sm-9">
								  <input type="text" class="form-control" name="nama" value="<?=$bioku['nama'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Tempat Tanggal Lahir</label>

								<div class="col-sm-3">
								  <input type="text" class="form-control" name="tempat" value="<?=$bioku['tempat'];?>">
								</div>
								<div class="col-sm-3">
								  <input type="text" class="form-control" name="tanggal" value="<?=TanggalIndo($bioku['tanggal']);?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">N I S</label>

								<div class="col-sm-9">
								  <input type="text" name="nik" class="form-control"  value="<?=$bioku['nis'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">N I S N</label>

								<div class="col-sm-9">
								  <input type="text" name="niy" class="form-control"  value="<?=$bioku['nisn'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">N I K</label>

								<div class="col-sm-9">
								  <input type="text" name="nuptk" class="form-control"  value="<?=$bioku['nik'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputExperience" class="col-sm-3 control-label">Alamat</label>

								<div class="col-sm-9">
								  <textarea class="form-control" name="alamat"><?=$bioku['alamat'];?></textarea>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Ayah</label>

								<div class="col-sm-9">
								  <input type="text" name="email" class="form-control"  value="<?=$bioku['nama_ayah'];?>">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Ibu</label>

								<div class="col-sm-9">
								  <input type="text" name="hp" class="form-control"  value="<?=$bioku['nama_ibu'];?>">
								</div>
							  </div>
							  
							</form>
						</div>
						<div class="tab-pane" id="timeline">
							<div id="hasil"></div>
						</div>
						<div class="tab-pane" id="settings">
							
						</div>
					</div>
				</div>
			</div>
    </section>
    <!-- /.content -->
  
  
		<!--Tambah RB-->
		
        <!-- /.modal -->
		
		<!--Hapus SK-->
			
<?php include "../inc/lte-script.php";?>
<!-- DataTables -->
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
	$(document).ready(function() {
		$('#datepicker').datepicker({
		  autoclose: true
		});
	});
</script>
</body>
</html>
