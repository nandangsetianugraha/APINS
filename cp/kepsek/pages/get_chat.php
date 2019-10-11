<?php
	include '../inc/db.php';
	function TanggalIndo($tanggal)
	{
		$bulan = array ('Januari',
					'Februari',
					'Maret',
					'April',
					'Mei',
					'Juni',
					'Juli',
					'Agustus',
					'September',
					'Oktober',
					'November',
					'Desember'
				);
		$split = explode('-', $tanggal);
		return $split[2] . ' ' . $bulan[ (int)$split[1]-1 ] . ' ' . $split[0];
	};
	session_start();
	$id_user = $_POST['id'];
	$user_login = $_SESSION['userid'];

	$query = "SELECT id_chat,chat,user_kirim,user_terima,status,tanggal FROM chat 
			  WHERE (user_kirim='$user_login' AND user_terima='$id_user') OR (user_kirim='$id_user' AND user_terima='$user_login') order by id_chat desc";
	$result = mysqli_query($koneksi, $query);
	while ($data=mysqli_fetch_array($result)) {
		$id_chat = $data['id_chat'];
		$chat = $data['chat'];
		$user_kirim = $data['user_kirim'];
		$user_terima = $data['user_terima'];
		$nkirim = mysqli_fetch_array(mysqli_query($koneksi, "select * from ptk where ptk_id='$user_kirim'"));
		$nterima = mysqli_fetch_array(mysqli_query($koneksi, "select * from ptk where ptk_id='$user_terima'"));
		$namaku=$nterima['nama'];
		if(file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/images/ptk/".$nterima['gambar'])){
							$fotoku = $nterima['gambar'];
						}else{
							$fotoku = "user-default.png";
						};
		$namanya=$nkirim['nama'];
		if(file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/images/ptk/".$nkirim['gambar'])){
							$fotonya = $nkirim['gambar'];
						}else{
							$fotonya = "user-default.png";
						};
		$status = $data['status'];
		$tanggal = $data['tanggal'];
		$time = date("H:i",strtotime($tanggal));
		$waktu = date("Y-m-d",strtotime($tanggal));
		if ($user_kirim == $id_user) {
			$qry = "UPDATE chat SET status='terbaca' WHERE id_chat='$id_chat'";
			$res = mysqli_query($koneksi, $qry);
			echo '
				<div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">'.$namanya.'</span>
                    <span class="direct-chat-timestamp pull-right">'.TanggalIndo($waktu).' <i class="fa fa-clock-o"></i> '.$time.'</span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="../../../images/ptk/'.$fotonya.'" alt="Message User Image"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">'.$chat.'</div>
                  <!-- /.direct-chat-text -->
                </div>
				';
		} else {
				echo '
				<div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right">'.$namanya.'</span>
                    <span class="direct-chat-timestamp pull-left">'.TanggalIndo($waktu).' <i class="fa fa-clock-o"></i> '.$time.'</span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="../../../images/ptk/'.$fotonya.'" alt="Message User Image"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">'.$chat.'</div>
                  <!-- /.direct-chat-text -->
                </div>
				';
		}
	};
?>
