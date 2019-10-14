<?php	
  $file = 'hola'.$_GET['q'].'.pdf';
  $filename = 'filename.pdf';
  header('Content-type: application/pdf');
  header('Content-Disposition: inline; filename="' . $filename . '"');
  header('Content-Transfer-Encoding: binary');
  header('Content-Length: ' . filesize($file));
  header('Accept-Ranges: bytes');
  @readfile($file);

/*
$file = './path/to/the.pdf';
$filename = 'Custom file name for the.pdf';
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file));
header('Accept-Ranges: bytes');
@readfile($file);
*/