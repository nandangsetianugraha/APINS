<?php
//fetch.php;
if(isset($_POST["view"]))
{
 include("inc/db.php");
 session_start();
 $idku=$_SESSION['userid'];
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE chat SET status='terbaca' WHERE user_terima='$idku'";
  mysqli_query($koneksi, $update_query);
 }
 $query = "SELECT * FROM chat WHERE user_terima='$idku' and status='terkirim' group by user_kirim LIMIT 5";
 $result = mysqli_query($koneksi, $query);
 
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
		$user_kirim = $row['user_kirim'];
		$user_terima = $row['user_terima'];
		$nkirim = mysqli_fetch_array(mysqli_query($koneksi, "select * from ptk where ptk_id='$user_kirim'"));
		$nterima = mysqli_fetch_array(mysqli_query($koneksi, "select * from ptk where ptk_id='$user_terima'"));
		$namaku=$nterima['nama'];
		$isichat=$row['chat'];
		$tglkirim=$row['tanggal'];
		$time = date("H:i",strtotime($tglkirim));
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
   $output .= '
   <li>
							<a onclick="addTabs({id:\'77777\',title: \'Chat\',close: true,url: \'pages/chat.php?idsend='.$user_kirim.'\',urlType: \'relative\'});" href="#">
							  <div class="pull-left">
								<img src="../../images/ptk/'.$fotonya.'" class="img-circle" alt="User Image">
							  </div>
							  <h4>
								'.$namanya.'
								<small><i class="fa fa-clock-o"></i> '.$time.'</small>
							  </h4>
							  <p>'.$isichat.'</p>
							</a>
						</li>
   
   ';
  }
 }
 else
 {
  $output .= '
  ';
 }
 
 $query_1 = "SELECT * FROM chat WHERE user_terima='$idku' and status='terkirim'";
 $result_1 = mysqli_query($koneksi, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>