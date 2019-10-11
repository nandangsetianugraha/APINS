<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>APINS | Error Page</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../../../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../../../plugins/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../../../../plugins/core/css/AdminLTE.css">
  <link rel="stylesheet" href="../../../plugins/animate/animate.min.css">
  <link rel="stylesheet" href="../../../plugins/core/font/font.min.css">
  <style>
    .lockscreen{
      height: 400px;
    }

    .lockscreen-logo{
      margin-bottom: 10px;
    }

    .lockscreen-item{
      border-radius: 5px;
    }

    .lockscreen-image,.lockscreen-item{
      box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2), 0 1px 5px rgba(0, 0, 0, 0.2), 0 0 0 5px rgba(255, 255, 255, 0.4);
    }

    .lockscreen-credentials input#username, .lockscreen-credentials input#password{
      border-bottom-right-radius: 5px;
      border-top-right-radius: 5px;
      padding-right: 35px;
    }
    #btn-login{
      cursor: pointer;
      pointer-events: auto;
    }
	.register-box{
      margin:2% auto;
    }

    .register-box-body{
      border-radius: 5px;
      /*box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2), 0 1px 5px rgba(0, 0, 0, 0.2), 0 0 0 12px rgba(255, 255, 255, 0.4);*/
      box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2), 0 1px 5px rgba(0, 0, 0, 0.2), 0 0 0 5px rgba(255, 255, 255, 0.4);
    }
  </style>
</head>
<body class="hold-transition lockscreen animated bounceIn">

		<div class="lockscreen-wrapper">
		  <div class="lockscreen-logo">
			<a href="login.html"><b>AP</b>INS</a>
		  </div>
		  
		  <div class="lockscreen-user"></div>
		  
				  <div class="lockscreen-name">Error</div>
				  <div class="lockscreen-item">
					<div class="lockscreen-image">
					  <img src="../../../../images/user-default.png" alt="User Image">
					</div>
					<form id="login-info" class="lockscreen-credentials">
					  <div class="form-group has-feedback" id="frmUsername">
						<input type="text" id="username" name="username" class="form-control" placeholder="Username" autocomplete="off" readonly="true" value="Session anda sudah habis!!">
						<span class="form-control-feedback loading"></span>
					  </div>
					</form>

				  </div>
				  <!--<div class="help-block text-center">-->
					<!--Masukkan Username dan Password untuk Login-->
				  <!--</div>-->
				  <div class="text-center" id="loginSettings">
				   
				  </div>
		
		</div>
		
				<div class="lockscreen-footer text-center">
					Silahkan Login Ulang!!!
				</div>
		
<script src="../../../../plugins/jQuery/jquery.min.js"></script>
<script src="../../../../plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="../../../../bootstrap/js/bootstrap.min.js"></script>

</html>
