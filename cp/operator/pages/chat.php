<?php 
include "../inc/db.php";
$sql_tahun=mysqli_query($koneksi, "select * from konfigurasi");
$esmanis=mysqli_fetch_array($sql_tahun);
$tpl_aktif=$esmanis['tapel'];
$smt_aktif=$esmanis['semester'];
$sekolah=$esmanis['nama_sekolah'];
$alamat=$esmanis['alamat_sekolah'];
$img_login=$esmanis['image_login'];
$maintenis=$esmanis['maintenis'];
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
$id_sender=isset($_GET['idsend']) ? $_GET['idsend'] : 'ada';
include "../inc/lte-head.php";
$idku=$_SESSION['userid'];
?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<section class="content-header">
      <h1>
        Chatting
      </h1>
      <ol class="breadcrumb">
        <li><a href="chat.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kotak Surat</li>
      </ol>
    </section>
<!-- Main content -->
<section class="content">
	<div class="row">
	<div class="col-lg-5 col-xs-12">
		<div class="box box-primary direct-chat direct-chat-primary">
			<div class="box-header with-border">
			</div>
			<div class="box-body">
				<div class="direct-chat-messages">
					<?php 
					$baca=mysqli_query($koneksi, "select * from ptk order by ptk_id asc");
					while($bku = mysqli_fetch_array($baca)){
						if($bku['ptk_id']==$idku){
							
						}else{
						if(file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/images/ptk/".$bku['gambar'])){
							$avatar="../../../images/ptk/".$bku['gambar'];
						}else{
							$avatar="../../../images/user-default.png";
						};
					?>
					<a href="chat.php?idsend=<?=$bku['ptk_id'];?>" class="direct-chat-msg">
					  
					  <!-- /.direct-chat-info -->
					  <img class="direct-chat-img" src="<?=$avatar;?>" alt="Message User Image"><!-- /.direct-chat-img -->
					  <!-- /.direct-chat-text -->
					  <div class="direct-chat-text"><?=$bku['nama'];?></div>
					</a>
					<?php }}; ?>
				</div>
			</div>
		</div>
		
                
	</div>
	<div class="col-lg-7 col-xs-12">
		<?php if($id_sender=="ada"){ ?>
		<div class="box direct-chat direct-chat-primary">
			<div class="box-body">
				<div class="error-page">
					<div class="error-content text-center" style="margin-left: 0;">
						<h3><i class="fa fa-info-circle text-info"></i> Informasi </h3>
						<p>Silahkan Pilih User yang Aktif disebelah kiri untuk memulai Chatting.</p>
					</div>
				</div>
			</div>
		</div>
		<?php }else{ ?>
		<div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
				<div class="user-block">
					<div id="title-img"></div>
					<span class="username"><a href="#"><div id="titleName" class="title-name"></div></a></span>
					<span class="description">Online</span>
				</div>
				
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <a href="chat.php" type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
			<div class="box-footer">
                <div class="input-group">
                  <input type="text" id="message" onkeydown="goSend(event);" autocomplete="off" name="message" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                        <button id="btnSend" onclick="clickSend();" class="btn btn-primary btn-flat">Send</button>
                      </span>
                </div>
            </div>
            <div class="box-body">
              <!-- Conversations are loaded here -->
			  
              <div class="direct-chat-messages">
				<div id="chat_content"></div>
              </div>
              <!--/.direct-chat-messages-->

              <!-- Contacts are loaded here -->
            </div>
            <!-- /.box-body -->
            
            <!-- /.box-footer-->
          </div>
          <!--/.direct-chat -->
		<?php } ?>
	</div>
	
	</div>
</section>
<?php include "../inc/lte-script.php";?>
<script type="text/javascript">
function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
};
		var pid = getUrlVars()['idsend'];
		function getTitle(){
			var id = pid;
			$.ajax({
				url 	: 'get_title.php',
				type 	: 'post',
				data 	: 'id='+id,
				success	: function(data){
					if (data != '' ){
						var arrData = data.split('~');
						var ttl_img = '<img class="img-circle" src="../../../images/ptk/'+arrData[1]+'" alt="User Image">';
						$('#title-img').html(ttl_img);
						$('#titleName').html(arrData[0]);
					}
				}
			});	
		}
		getTitle();
		<?php if($id_sender=="ada"){ 
		}else{
		?>
		function getChat(){
			setInterval(function(){
				var id = pid;
				$.ajax({
					url 	: 'get_chat.php',
					type 	: 'post',
					data 	: 'id='+id,
					success	: function(data){
						$('#chat_content').html(data);
					}
				});	
			},1000);
		}
		getChat();
		
		function goSend(event){
			var id = pid;
			if (event.keyCode == 13){
				var msg = $('#message').val();
				if (msg != ""){
					$.ajax({
						url 	: 'send_chat.php',
						type 	: 'post',
						data 	: 'msg='+msg+'&id='+id,
						success	: function(data){
							if (data != '' ){
								getChat();
								$('#message').val("");
								$('#message').focus();
							}
						}
					});
				} else {
					alert('Tulis Pesan ... ');
					$('#message').focus();
				}
			}
		}
		function clickSend(){
			var id = pid;
			var msg = $('#message').val();
			if (msg != ""){
				$.ajax({
					url 	: 'send_chat.php',
					type 	: 'post',
					data 	: 'msg='+msg+'&id='+id,
					success	: function(data){
						if (data != '' ){
							getChat();
							$('#message').val("");
							$('#message').focus();
						}
					}
				});
			} else {
				alert('Tulis Pesan ... ');
				$('#message').focus();
			}
		};
		<?php }; ?>
	</script>
</body>
</html>
