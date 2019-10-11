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
        Daftar Siswa 
        <small>Kelas <?=$kelas;?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#" data-toggle="modal" data-toggle="modal" data-target="#penempatan"><i class="fa fa-plus"></i> Penempatan</a></li>
    </ol>
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
												<th></th>
												<th class="text-center">NIS</th>
												<th class="text-center">NISN</th>
												<th class="text-center">Nama Siswa</th>
												<th class="text-center">Tempat Lahir</th>
												<th class="text-center">JK</th>
												<th>&nbsp;</th>
											</tr>
                                        </thead>
                                        <tbody>
										
                                        </tbody>
                                    </table>
			
<!--Modal -->
		<div class="modal fade" id="penempatan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Daftar Siswa</h4>
              </div>
              <div class="modal-body">
				<table id="managePenempatan" class="table table-bordered table-hover">
									<thead>
									   <tr>
											
											<th>NIS</th>
											<th>NISN</th>
											<th>Nama Siswa</th>
											<th>TTL</th>
											<th>JK</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
			  </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<div class="modal fade" id="penempatanMemberModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tempatkan Siswa</h4>
              </div>
                        <form class="form" action="../modul/siswa/penempatansiswa.php" method="POST" id="penempatanMemberForm">
						<div class="modal-body">
							<div class="form-group">
								<label for="output-device">Nama Siswa</label>
								<input type="text" class="form-control" id="penempatannama" name="penempatannama" placeholder="Nama Lengkap" autocomplete=off>
							</div>
							<div class="form-group">
								<label for="output-device">Kelas</label>
								<input type="hidden" class="form-control" id="tapel" name="tapel" value="<?=$tpl_aktif;?>">
								<select id="kelas" class="form-control" size="1" name="kelas">
									<?php 
									$sql_mk=mysqli_query($koneksi, "select * from rombel where tapel='$tpl_aktif' order by nama_rombel asc");
									while($nk=mysqli_fetch_array($sql_mk)){
									?>
									<option value="<?php echo $nk['nama_rombel']; ?>" <?php if($kelas==$nk['nama_rombel']){echo "selected";} ?>>Kelas <?php echo $nk['nama_rombel']; ?></option>
									<?php };?>
								</select>
							</div>
                        </div>
                        <div class="modal-footer penempatanMemberModal">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Ya</button>
                        </div>
						</form>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<!--Delete Tema-->
		<div class="modal fade" id="outMemberModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Keluar Rombel</h4>
              </div>
                        <div class="modal-body">
							<p>Keluarkan Siswa dari Kelas <?=$kelas;?>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light" id="outBtn">Ya</button>
                        </div>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	
		<div class="modal fade" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Biodata Siswa</h4>
              </div>
                        <form class="form-horizontal" action="../modul/siswa/simpanData.php" autocomplete="off" method="POST" id="updateSiswaForm">
						<div class="modal-body editSiswa">
							<div class="fetched-data"></div>
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
	var managePenempatan;
	$(document).ready(function() {
		manageMemberTable = $("#manageMemberTable").DataTable({
			"ajax": "../modul/siswa/kelasku.php?kelas=<?=$kelas;?>&smt=<?=$smt_aktif;?>&tapel=<?=$tpl_aktif;?>",
			"order": []
		});
		managePenempatan = $("#managePenempatan").DataTable({
			"ajax": "../modul/siswa/siswakosong.php?tapel=<?=$tpl_aktif;?>",
			"order": []
		});
		$('#myModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : '../modul/siswa/modal_edit.php',
                data :  'rowid='+ rowid,
				beforeSend: function()
						{	
							$(".fetched-data").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...');
						},
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
		 $("#updateSiswaForm").unbind('submit').bind('submit', function() {
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
											'theme'     :'awesome error',
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
										$("#myModal").modal('hide');
									} else {
										$.amaran({
											'theme'     :'awesome error',
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
	function penempatanMember(id = null) {
		if(id) {

			// remove the error 
			$(".form-group").removeClass('has-error').removeClass('has-success');
			$(".text-danger").remove();
			$("#penempatan").modal('hide');
			// remove the id
			$("#member_id").remove();

			// fetch the member data
			$.ajax({
				url: '../modul/siswa/lihatsiswa.php',
				type: 'post',
				data: {member_id : id},
				dataType: 'json',
				success:function(response) {
					$("#penempatannama").val(response.nama);

					// mmeber id 
					$(".penempatanMemberModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

					// here update the member data
					$("#penempatanMemberForm").unbind('submit').bind('submit', function() {
						// remove error messages
						$(".text-danger").remove();

						var form = $(this);

						// validation
						var kelas = $("#kelas").val();
						var tapel = $("#tapel").val();
							$.ajax({
								url: form.attr('action'),
								type: form.attr('method'),
								data: form.serialize(),
								dataType: 'json',
								success:function(response) {
									if(response.success == true) {
										$.amaran({
											'theme'     :'awesome error',
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
										managePenempatan.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
										$("#penempatanMemberModal").modal('hide');
										$("#penempatan").modal('show');
									} else {
										$.amaran({
											'theme'     :'awesome error',
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

				} // /success
			}); // /fetch selected member info

		} else {
			alert("Error : Refresh the page again");
		}
	}
	function outMember(id = null) {
		if(id) {
			// click on remove button
			$("#outBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '../modul/siswa/outsiswa.php',
					type: 'post',
					data: {member_id : id},
					dataType: 'json',
					success:function(response) {
						if(response.success == true) {						
							$.amaran({
											'theme'     :'awesome error',
											'content'   :{
												title:'Sukses!',
												message:response.messages,
												info:'',
												icon:'fa fa-check-square-o'
											},
											'position'  :'bottom right',
											'outEffect' :'slideBottom'
										});

							// refresh the table
							manageMemberTable.ajax.reload(null, false);
							managePenempatan.ajax.reload(null, false);

							// close the modal
							$("#outMemberModal").modal('hide');

						} else {
							$.amaran({
											'theme'     :'awesome error',
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
		};
		
		function editMember(id = null) {
			if(id) {
				// remove the error 
				$(".form-group").removeClass('has-error').removeClass('has-success');
				$(".text-danger").remove();
				// empty the message div
				$(".edit-messages").html("");
				// remove the id
				$("#member_id").remove();
				$.ajax({
					url: '../modul/siswa/lihatsiswa.php',
					type: 'post',
					data: {member_id : id},
					dataType: 'json',
					success:function(response) {
						$("#editnama").val(response.nama);
						$("#edittempat").val(response.tempat);
						$("#edittanggal").val(response.tanggal);
						$("#editjk").val(response.jk);	
						$("#editnis").val(response.nis);	
						$("#editnisn").val(response.nisn);	
						$("#editnik").val(response.nik);	
						$("#editalamat").val(response.alamat);	
						$("#editayah").val(response.nama_ayah);	
						$("#editibu").val(response.nama_ibu);	

						// mmeber id 
						$(".editMemberModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

						// here update the member data
						$("#editMemberForm").unbind('submit').bind('submit', function() {
							// remove error messages
							$(".text-danger").remove();

							var form = $(this);

							// validation
							var editnama = $("#editnama").val();
							var edittempat = $("#edittempat").val();
							var edittanggal = $("#edittanggal").val();
							var editjk = $("#editjk").val();
							var editnis = $("#editnis").val();
							var editnisn = $("#editnisn").val();
							var editnik = $("#editnik").val();
							var editalamat = $("#editalamat").val();
							var editayah = $("#editayah").val();
							var editibu = $("#editibu").val();
								$.ajax({
									url: form.attr('action'),
									type: form.attr('method'),
									data: form.serialize(),
									dataType: 'json',
									success:function(response) {
										if(response.success == true) {
											$.amaran({
											'theme'     :'awesome error',
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
											$("#editMemberModal").modal('hide');
										} else {
											$.amaran({
											'theme'     :'awesome error',
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

					} // /success
				}); // /fetch selected member info
			}else{
				alert("Error : Refresh the page again");
			}
		}
	}
</script>
</body>
</html>	