<?php
include "db.php";
if(isset($_POST["username"]) or isset($_POST["password"])){
		sleep(1);
		$username 		= $_POST['username']; // Get the username
		$password 		= $_POST['password']; // Get the password and decrypt it
		$query			= mysqli_query($koneksi, 'SELECT * FROM pengguna WHERE username = "'.$username.'" AND password = "'.$password.'"'); // Check the table with posted credentials
		$num_rows		= mysqli_num_rows($query); // Get the number of rows
		if($num_rows == 0){ 
			echo 'error_login';	
		}else{
			session_start();
			$f = mysqli_fetch_array($query);
			$j = mysqli_fetch_array(mysqli_query($koneksi, "select * from jenis_ptk where jenis_ptk_id='".$f['level']."'"));
			$k = mysqli_fetch_array(mysqli_query($koneksi, "select * from ptk where ptk_id='".$f['ptk_id']."'"));
			//$m = mysqli_fetch_array(mysqli_query($koneksi, "select * from mengajar where ptk_id='".$f['ptk_id']."'"));
			$_SESSION['userid'] 	= $f['ptk_id'];
			$_SESSION['level'] 	= $f['level'];
			if($f['level']=="11"){
				echo "operator";
			}elseif($f['level']=="5"){
				echo "tu";
			}elseif($f['level']=="99"){
				echo "kepsek";
			}else{
				echo "guru";				
			};
		
		};  //end else
}
?>