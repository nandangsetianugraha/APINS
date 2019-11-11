<?php

//index.php - CSV import using AJAX progress bar in PHP

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Import Data Absensi Pegawai</title>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		
		<br />
		<br />
		<div class="container">
			<h1 align="center">Import Data Absensi Pegawai</h1>
			<br />
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Import Excel File Data</h3>
				</div>
  				<div class="panel-body">
  					<span id="message"></span>
  					<form id="sample_form" method="POST" enctype="multipart/form-data" class="form-horizontal">
  						<div class="form-group">
  							<label class="col-md-4 control-label">Select Excel File</label>
  							<input type="file" name="file" id="file" />
  						</div>
  						<div class="form-group" align="center">
  							<input type="hidden" name="hidden_field" value="1" />
  							<input type="submit" name="import" id="import" class="btn btn-info" value="Import" />
  						</div>
  					</form>
  					<div class="form-group" id="process" style="display:none;">
  						<div class="progress">
  							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
  								<span id="process_data">0</span> - <span id="total_data">0</span>
  							</div>
  						</div>
  					</div>
  				</div>
  			</div>
		</div>
	</body>
</html>

<script>
	
	$(document).ready(function(){

		var clear_timer;

		$('#sample_form').on('submit', function(event){
			$('#message').html('');
			event.preventDefault();
			$.ajax({
				url:"upload.php",
				method:"POST",
				data: new FormData(this),
				dataType:"json",
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$('#import').attr('disabled','disabled');
					$('#import').val('Importing');
				},
				success:function(data)
				{
					if(data.success)
					{
						$('#total_data').text(data.total_line);

						start_import();

						clear_timer = setInterval(get_import_data, 2000);

						//$('#message').html('<div class="alert alert-success">CSV File Uploaded</div>');
					}
					if(data.error)
					{
						$('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
						$('#import').attr('disabled',false);
						$('#import').val('Import');
					}
				}
			})
		});

		function start_import()
		{
			$('#process').css('display', 'block');
			$.ajax({
				url:"import.php",
				success:function()
				{

				}
			})
		}

		function get_import_data()
		{
			$.ajax({
				url:"process.php",
				success:function(data)
				{
					var total_data = $('#total_data').text();
					var width = Math.round((data/total_data)*100);
					$('#process_data').text(data);
					$('.progress-bar').css('width', width + '%');
					if(width >= 100)
					{
						clearInterval(clear_timer);
						$('#process').css('display', 'none');
						$('#file').val('');
						$('#message').html('<div class="alert alert-success">Data Successfully Imported</div>');
						$('#import').attr('disabled',false);
						$('#import').val('Import');
					}
				}
			})
		}

	});
</script>

