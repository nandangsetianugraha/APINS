<?php
$archivo="hola1.pdf";
$img_path="/tmp"; //ruta temporal para guardar el jpg
$file_name=time();
$dir="/usr/bin/convert";
$comando="$dir {$archivo}[0] $img_path/$file_name.jpg";
exec($comando,$out);

$image=imagecreatefromjpeg("$img_path/$file_name.jpg");
header('Content-Type: image/jpeg');
imagejpeg($image);
unlink("$img_path/$file_name.jpg");