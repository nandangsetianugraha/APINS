<?php
require_once "../../inc/db.php";
session_start();
$idp=$_SESSION['userid'];
/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/
$imgUrl = "../../images/ptk/".$_POST['imgUrl'];
// original sizes
$imgInitW = $_POST['imgInitW'];
$imgInitH = $_POST['imgInitH'];
// resized sizes
$imgW = $_POST['imgW'];
$imgH = $_POST['imgH'];
// offsets
$imgY1 = $_POST['imgY1'];
$imgX1 = $_POST['imgX1'];
// crop box
$cropW = $_POST['cropW'];
$cropH = $_POST['cropH'];
// rotation angle
$angle = $_POST['rotation'];

$jpeg_quality = 100;

//$output_filename = "upload_crop/croppedImg_".rand();

// uncomment line below to save the cropped image in the same location as the original image.
$nama_file="avatar_".rand();
$output_filename = dirname($imgUrl). "/".$nama_file;

$what = getimagesize($imgUrl);

switch(strtolower($what['mime'])){
    case 'image/png':
        $img_r = imagecreatefrompng($imgUrl);
        $source_image = imagecreatefrompng($imgUrl);
        $type = '.png';
        break;
    case 'image/jpeg':
        $img_r = imagecreatefromjpeg($imgUrl);
        $source_image = imagecreatefromjpeg($imgUrl);
        error_log("jpg");
        $type = '.jpeg';
        break;
    case 'image/gif':
        $img_r = imagecreatefromgif($imgUrl);
        $source_image = imagecreatefromgif($imgUrl);
        $type = '.gif';
        break;
    default: die('image type not supported');
}


//Check write Access to Directory

if(!is_writable(dirname($output_filename))){
    $response = Array(
        "status" => 'error',
        "message" => 'Can`t write cropped File'
    );	
}
else{

//    // resize the original image to size of editor
//    $resizedImage = imagecreatetruecolor($imgW, $imgH);
//    imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
//    // rotate the rezized image
//    $rotated_image = imagerotate($resizedImage, -$angle, 0);
//    // find new width & height of rotated image
//    $rotated_width = imagesx($rotated_image);
//    $rotated_height = imagesy($rotated_image);
//    // diff between rotated & original sizes
//    $dx = $rotated_width - $imgW;
//    $dy = $rotated_height - $imgH;
//    // crop rotated image to fit into original rezized rectangle
//    $cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
//    imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
//    imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
//    // crop image into selected area
//    $final_image = imagecreatetruecolor($cropW, $cropH);
//    imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
//    imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
    
    
    // tilak script
    $newImgW = ($cropW*$imgInitW)/$imgW;
    $newImgH = ($cropH*$imgInitH)/$imgH;
    $final_image = imagecreatetruecolor($newImgW, $newImgH);
    imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
    
    $newimgX1 = ($imgInitW*$imgX1)/$imgW;
    $newimgY1 = ($imgInitH*$imgY1)/$imgH;
    
    imagecopyresampled($final_image, $source_image, 0, 0, $newimgX1, $newimgY1, $newImgW, $newImgH, $newImgW, $newImgH);
    
    
    // finally output png image
    // imagepng($final_image, $output_filename.$type, $png_quality);
    imagejpeg($final_image, $output_filename.$type, $jpeg_quality);
	$hapusFile1 = "../../images/ptk/".$imgUrl;
	if(file_exists($hapusFile1)){
		unlink($hapusFile1);
	};
	$sql_query = "SELECT * FROM pengguna WHERE ptk_id = '".mysqli_escape_string($koneksi, $idp)."'";		
		$resultset = mysqli_query($koneksi, $sql_query) or die("database error:". mysqli_error($koneksi));		
		if(mysqli_num_rows($resultset)) {     
			$ava=mysqli_fetch_array($resultset);
			$flama=$ava['gambar'];
			$hapusFile = "../../images/ptk/".$flama;
			if(file_exists($hapusFile)){
				unlink($hapusFile);
			};
			$sql_update = "UPDATE ptk set gambar='".mysqli_escape_string($koneksi,$nama_file.$type)."' WHERE ptk_id = '".mysqli_escape_string($koneksi, $idp)."'";
			mysqli_query($koneksi, $sql_update) or die("database error:". mysqli_error($koneksi));
			$sql_update1 = "UPDATE pengguna set gambar='".mysqli_escape_string($koneksi,$nama_file.$type)."' WHERE ptk_id = '".mysqli_escape_string($koneksi, $idp)."'";			
			mysqli_query($koneksi, $sql_update1) or die("database error:". mysqli_error($koneksi));
		};
    $response = Array(
        "status" => 'success',
        "url" => $output_filename.$type
    );
}
print json_encode($response);