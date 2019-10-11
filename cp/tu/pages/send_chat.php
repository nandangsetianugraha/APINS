<?php
    include '../inc/db.php';
    date_default_timezone_set("Asia/Bangkok");
	session_start();
    $user_kirim = $_SESSION['userid'];
    $user_terima = $_POST['id'];
    $chat = $_POST['msg'];
    $tanggal = date('Y-m-d H:i:s');
	$query = "INSERT INTO chat VALUES ('','$chat','$tanggal','terkirim','$user_kirim','$user_terima')";
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo 'Berhasil';
    } else {
        echo '';
    }
?>
