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
$query			= mysqli_fetch_array(mysqli_query($koneksi, 'SELECT * FROM siswa WHERE nisn = "'.$username.'" and status=1')); // Check the table 
$cek=$query['tanggal'];
$thn=substr($cek,0,4);
$bln=substr($cek,5,2);
$tgl=substr($cek,8,2);
$tm=$thn.$bln.$tgl;
if($username === $query['nisn']){
    if($password===""){
		$photo = "../images/siswa/".$query['avatar'];
		if(file_exists($photo)){
			$response = array(
				"namaLengkap"=>$query['nama'],
				"profilPicture"=>"../images/siswa/".$query['gambar']
			);
		}else{
			$response = array(
				"namaLengkap"=>$query['nama'],
				"profilPicture"=>"../images/user-default.png"
			);
		};
    }else if($password===$tm){
        $response = array("status"=>"login_sukses");
		$_SESSION['userid'] 	= $query['peserta_didik_id'];
		$_SESSION['siswa'] 		= 'siswa';
    }else{
        $response = array("status"=>"error_login");
    }
}else{
    $query			= mysqli_fetch_array(mysqli_query($koneksi, 'SELECT * FROM siswa WHERE nis = "'.$username.'" and status=1')); // Check the table 
    $cek=$query['tanggal'];
    $thn=substr($cek,0,4);
    $bln=substr($cek,5,2);
    $tgl=substr($cek,8,2);
    $tm=$thn.$bln.$tgl;
    if($username === $query['nis']){
        if($password===""){
    		$photo = "../images/siswa/".$query['avatar'];
    		if(file_exists($photo)){
    			$response = array(
    				"namaLengkap"=>$query['nama'],
    				"profilPicture"=>"../images/siswa/".$query['gambar']
    			);
    		}else{
    			$response = array(
    				"namaLengkap"=>$query['nama'],
    				"profilPicture"=>"../images/user-default.png"
    			);
    		};
        }else if($password===$tm){
            $response = array("status"=>"login_sukses");
    		$_SESSION['userid'] 	= $query['peserta_didik_id'];
    		$_SESSION['siswa'] 		= 'siswa';
        }else{
            $response = array("status"=>"error_login");
        }
    }else{
        $response = array("status"=>"error_login");
    };
};
echo json_encode($response);