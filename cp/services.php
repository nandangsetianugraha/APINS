<?php
/**
 * Created by PhpStorm.
 * User: Abu Dzakiyyah
 * Date: 3/27/2018
 * Time: 9:23 PM
 */
include "inc/db.php";
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$query			= mysqli_fetch_array(mysqli_query($koneksi, 'SELECT * FROM pengguna WHERE username = "'.$username.'"')); // Check the table 
if($username === $query['username']){
    if($password===""){
		$photo = "../images/ptk/".$query['gambar'];
		if(file_exists($photo)){
			$response = array(
				"namaLengkap"=>$query['nama_lengkap'],
				"profilPicture"=>"../images/ptk/".$query['gambar']
			);
		}else{
			$response = array(
				"namaLengkap"=>$query['nama_lengkap'],
				"profilPicture"=>"../images/user-default.png"
			);
		};
    }else if($password===$query['password']){
        $response = array("status"=>"login_sukses");
		$_SESSION['userid'] 	= $query['ptk_id'];
		$_SESSION['level'] 		= $query['level'];
    }else{
        $response = array("status"=>"error_login");
    }
}else{
    $response = array("status"=>"error_login");
};
echo json_encode($response);