<?php
include "../inc/db.php";
function TanggalIndo($tanggal)
{
	$bulan = array ('Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1]-1 ] . ' ' . $split[0];
};
session_start();
if(!isset($_SESSION['userid'])){
	header('location:../login.html');
	exit();
};
$sql_tahun=mysqli_query($koneksi, "select * from konfigurasi");
$esmanis=mysqli_fetch_array($sql_tahun);
$tpl_aktif=$esmanis['tapel'];
$smt_aktif=$esmanis['semester'];
$sekolah=$esmanis['nama_sekolah'];
$alamat=$esmanis['alamat_sekolah'];
$img_login=$esmanis['logo'];
$maintenis=$esmanis['maintenis'];
$versi=$esmanis['versi'];
$level=$_SESSION['level'];
$idku=$_SESSION['userid'];
$bioku = mysqli_fetch_array(mysqli_query($koneksi, "select * from ptk where ptk_id='$idku'"));
$gbr = mysqli_fetch_array(mysqli_query($koneksi, "select * from pengguna where ptk_id='$idku'"));
if(file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/7.0.1/images/ptk/".$gbr['gambar'])){
	$avatar="../../images/ptk/".$gbr['gambar'];
}else{
	$avatar="../../images/user-default.png";
};?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>APINS | Beranda</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/all-skins.min.css">
	<!-- Cropper css -->
        <link href="../../dist/css/cropper.css" rel="stylesheet">
        <!-- Sweet alert -->
        <link href="../../dist/css/sweetalert.css" rel="stylesheet">

    <style type="text/css">
        html {
            overflow: hidden;
        }
    </style>
	<style type="text/css">
        * {
            margin: 0;
            box-sizing: border-box;
        }

        .avatar .camera {
            display: none;
        }

        .avatar:hover .camera {
            display: block;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="../plugins/ie9/html5shiv.min.js"></script>
    <script src="../plugins/ie9/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="./" class="logo">
		  <!-- mini logo for sidebar mini 50x50 pixels -->
		  <span class="logo-mini"><img src="../../images/logo.png" alt="User Image"></span>
		  <!-- logo for regular state and mobile devices -->
		  <span class="logo-lg"><img src="../../images/logo.png" alt="User Image"> <b>A P </b>I N S</span>
		</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
		  <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?=$tpl_aktif;?> <?php if($smt_aktif==1){echo "Ganjil";}else{echo "Genap";}; ?>
            </a>
          </li>
		  <li class="dropdown messages-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success count"></span>
            </a>
			<ul class="dropdown-menu">
				<li class="header">You have <span class="itung"></span> messages</li>
				<li>
					<ul class="menu pesanku">
						
					</ul>
				</li>
				<li class="footer"><a class="btn btn-default btn-flat" onclick="addTabs({id:'77777',title: 'Chat',close: true,url: 'pages/chat.php',urlType: 'relative'});">See All Messages</a></li>
			</ul>
		  </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=$avatar;?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$bioku['nama'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
				<img src="<?=$avatar;?>" class="img-circle" alt="User Image">
                
                <p>
                  <?=$bioku['nama'];?>
                  <small><?=$bioku['email'];?></small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a class="tabCreate btn btn-default btn-flat"
                     onclick="addTabs({id:'7777',title: 'Profil',close: true,url: 'pages/profil.php',urlType: 'relative'});"
                  >Profile</a>
                </div>
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
				<div class="pull-left image">
					<img src="<?=$avatar;?>" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
				  <p><?=$bioku['nama'];?></p>
				  <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-circle text-success"></i> Ganti Photo</a>
				</div>
			</div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="button" name="search" id="search-btn" class="btn btn-flat" onclick="search_menu()"><i
                        class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="content-wrapper" style="min-height: 421px;">
        <!--bootstrap tab风格 多标签页-->
        <div class="content-tabs">
            <button class="roll-nav roll-left tabLeft" onclick="scrollTabLeft()">
                <i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs menuTabs tab-ui-menu" id="tab-menu">
                <div class="page-tabs-content" style="margin-left: 0px;">

                </div>
            </nav>
            <button class="roll-nav roll-right tabRight" onclick="scrollTabRight()">
                <i class="fa fa-forward" style="margin-left: 3px;"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown tabClose" data-toggle="dropdown">
                    Option<i class="fa fa-caret-down" style="padding-left: 3px;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-right" style="min-width: 128px;">
                    <li><a class="tabReload" href="javascript:refreshTab();">Refresh</a></li>
                    <li><a class="tabCloseCurrent" href="javascript:closeCurrentTab();">Tutup Tab Sekarang</a></li>
                    <li><a class="tabCloseAll" href="javascript:closeOtherTabs(true);">Tutup Semua Tab</a></li>
                    <li><a class="tabCloseOther" href="javascript:closeOtherTabs();">Tutup Tab Lain</a></li>
                </ul>
            </div>
            <button class="roll-nav roll-right fullscreen" onclick="App.handleFullScreen()"><i
                    class="fa fa-arrows-alt"></i></button>
        </div>
        <div class="content-iframe " style="background-color: #ffffff; ">
            <div class="tab-content " id="tab-content">

            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
<!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            Upload image!
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="uploadImageMain">
                            <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                                <div id="image_preview">
                                    <img id="previewing" src="../../images/ptk/<?=$avatar;?>">
                                    <div class="clickHelpText">Klik pada gambar untuk mengunggah gambar.</div>
                                </div>
                                <div id="selectImage">
                                    <label>Pilih Gambar</label>
                                    <br>
                                    <input type="file" name="file" id="fileInput" required="">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="submitUploadNewImage">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> <?=$versi;?>
        </div>
        <strong>Copyright &copy; 2013-2019. <a href="http://sdi-aljannah.web.id">Nandang Setia Nugraha</a>.</strong>
    </footer>

    <!-- Control Sidebar -->
    
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<!--tabs-->
<script src="../../dist/js/app_iframe.js"></script>
<!-- Cropper js -->
<script src="../../dist/js/cropper.js"></script>
        <!-- Sweet alert js -->
<script src="../../dist/js/sweetalert.js"></script>
       <!-- Custom js -->

<!--<script src="../dist/js/jquery.blockui.min.js"></script>
<script src="../dist/js/appx.js"></script>
<script src="../dist/js/bootstrap-tab.js"></script>
<script src="../dist/js/sidebarMenu.js"></script>-->

<script src="menu.js"></script>
<script>
function console_log(temp){
    console.log(temp);
}

new_img_data = {};

$(document).ready(function (e) {
	load_unseen_notification();
	setInterval(function(){ 
	  load_unseen_notification();; 
	 }, 10000);
	 function load_unseen_notification(view = '')
	 {
	  $.ajax({
	   url:"fetch.php",
	   method:"POST",
	   data:{view:view},
	   dataType:"json",
	   success:function(data)
	   {
		$('.pesanku').html(data.notification);
		if(data.unseen_notification > 0)
		{
		 $('.count').html(data.unseen_notification);
		 $('.itung').html(data.unseen_notification);
		}else{
			$('.count').html('0');
		 $('.itung').html('0');
		}
	   }
	  });
	 }
	 
	
    $('.navbar-brand').attr('href', window.location.protocol+"//"+window.location.hostname+window.location.pathname);

    $('#submitUploadNewImage').unbind();
    $('#submitUploadNewImage').click(function(){
        var imgName = $(this).data('img-name');
        var form_data = new FormData();

        form_data.append('imgUrl', imgName);

        form_data.append('imgInitW', new_img_data.getImageData.naturalWidth);
        form_data.append('imgInitH', new_img_data.getImageData.naturalHeight);

        form_data.append('imgW', new_img_data.getImageData.width);
        form_data.append('imgH', new_img_data.getImageData.height);

        form_data.append('imgY1', ((new_img_data.getCropBoxData.top) - parseInt($('.cropper-canvas').css('top'))));
        form_data.append('imgX1', ((new_img_data.getCropBoxData.left) - parseInt($('.cropper-canvas').css('left'))));

        form_data.append('cropW', new_img_data.getCropBoxData.width);
        form_data.append('cropH', new_img_data.getCropBoxData.height);

        form_data.append('rotation', new_img_data.getImageData.rotate);

        $.ajax({
            url: "crop.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: form_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data){   // A function to be called if request succeeds
                var cropResult = $.parseJSON(data);
                console_log('crop done: '+cropResult);
                if(cropResult.status == "success"){
                    console_log('Image Name: '+ cropResult.url);

                    var uploadURL = window.location.protocol+"//"+window.location.hostname+window.location.pathname+cropResult.url;
                    console_log('the image url is: '+uploadURL);
                    $('h1').text('Your image link is here:');
                    $('button').hide();
                    $('.well').html('<a href="'+uploadURL+'" target="_blank">'+uploadURL+'</a>');
                    $('.well').fadeIn();
                    $('#myModal').modal('hide');
					setTimeout(function () {
                                      window.open("./","_self");
                                  },500)
                }
                else{
                    swal(
                        'Opps!',
                        'Something didnt go well! Please try again.',
                        'warning'
                    );
                }
            },
            timeout: function(){
                swal(
                    'Opps!',
                    'Connection Timed out. Please try again.',
                    'warning'
                );
            }
        });

    });

    // Function to preview image after validation
    $(function() {
        $("#fileInput").change(function(){
            $('#selectImage').fadeOut();
            console_log('Upload new Image');
            var file = this.files[0];
            console_log(file);
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
                console_log('Invalid image');
                $('#previewing').attr('src','assets/img/noimg43.jpg');

                swal(
                    'Opps!',
                    'Not a valid image file.',
                    'warning'
                );
                return false;
            }
            else{
                console_log('Valid Image');
                // upload to temp
                var form_data = new FormData();                  
                form_data.append('file', file);

                $.ajax({
                    url: "ajax_php_file.php", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: form_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    error: function(){
                        alert('Error!');
                    },
                    success: function(data){   // A function to be called if request succeeds
                        console_log(data);

                        var UploadResult = $.parseJSON(data);
                        console_log(UploadResult);
                        if(UploadResult.success == 'TRUE'){

                            // set preview
                            var reader = new FileReader();
                            reader.onload = imageIsLoaded;
                            reader.readAsDataURL(file);

                            // load Cropper js
                            setTimeout(function(){
                                console_log('@ Cropper js');
                                // cropper js assign
                                var image = document.querySelector('#previewing');
                                //var minAspectRatio = 0.5;
                                //var maxAspectRatio = 1.5;
                                cropper = new Cropper(image, {
                                    aspectRatio: 4 / 4,
                                    //preview: '#demo-image-holder',
                                    ready: function () {
                                        console_log('ready');
                                        var cropper = this.cropper;
                                        //var containerData = cropper.getContainerData();
                                        //var cropBoxData = cropper.getCropBoxData();
                                        //var aspectRatio = cropBoxData.width / cropBoxData.height;
                                        //var newCropBoxWidth;
                                        new_img_data.getImageData = cropper.getImageData();
                                        new_img_data.getCropBoxData = cropper.getCropBoxData();
                                    },
                                    cropmove: function () {
                                        //console_log('cropmove');
                                        var cropper = this.cropper;
                                        var cropBoxData = cropper.getImageData();
                                        //var aspectRatio = cropBoxData.width / cropBoxData.height;
                                    },
                                    crop: function(e) {
                                        console_log('crop');
                                    },
                                    cropend: function(e){
                                        //console_log('cropend');
                                        new_img_data.getImageData = cropper.getImageData();
                                        new_img_data.getCropBoxData = cropper.getCropBoxData();
                                        console_log(new_img_data);
                                    }
                                });

                                $('#submitUploadNewImage').fadeIn().css('display', 'initial');
                                $('.clickHelpText').fadeOut().css('display', 'none');
                                $('#submitUploadNewImage').data('img-name', UploadResult.name);
                            }, 2000);
                        }
                        else{
                            swal(
                                'Error!',
                                UploadResult.message,
                                'warning'
                            );
                        }
                    },
                    timeout: function(){
                        swal(
                            'Opps!',
                            'Connection time out.',
                            'warning'
                        );
                    }
                });
            }
        });

    });
    function imageIsLoaded(e) {
        //            $("#fileInput").css("color","green");
        //            $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '230px');
    };

    $('#previewing').unbind();
    $('#previewing').click(function(){
        $('#fileInput').click();
    });
});
</script>
</body>
</html>