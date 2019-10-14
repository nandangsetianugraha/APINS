<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/cupertino/jquery-ui.css">
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.min.js"></script>
	<script type="text/javascript" src="http://github.com/malsup/media/raw/master/jquery.media.js?v0.92"></script> 
</head>
<body>
	<button onclick="javascript:loadFrame(1)">cargar1</button>
	<button onclick="javascript:loadFrame(2)">cargar2</button>	
	<a href="view_pdf.php?q=1" class="modal">PDFFILE</a>
<script>
$(function(){	

});

function loadFrame(id){	
	$('body').append('<div class="modal"><iframe src="view_pdf.php?q='+id+'" style="overflow:hidden;height:100%;width:100%"></iframe></div>');
	$('.modal').dialog({
		modal:true,
		autoOpen: true,
		close: limpiarFrame,
		width: 600,
		height: 400,
		position: 'center',
		resizable: true,
		draggable: true });
	$('.modal').media({width:500, height:400});
}

function limpiarFrame(){
	$('.modal').remove();	
}

</script>

</body>
</html>