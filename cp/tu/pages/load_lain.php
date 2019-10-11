<?php
include "../inc/db_connect.php";
$idsis=$_GET['id_sis'];
$sql = "select * from beban_pembayaran where peserta_didik_id='$idsis' and kode>1";
$query = $connect->query($sql);
$ada=$query->num_rows;
if($ada>0){
while ($pn = $query->fetch_assoc()) {
	$kodebayar=$pn['kode'];
	$nkode=$connect->query("select * from jenis_pembayaran where kode='$kodebayar'")->fetch_assoc();
	$sbayar=$connect->query("select sum(besaran) as sudah_bayar from pembayaran where peserta_didik_id='$idsis' and kode='$kodebayar'")->fetch_assoc();
?>
<tr>
	<td><?=$nkode['nama_pembayaran'];?></td>
	<td><?=$pn['besaran'];?></td>
	<td><?=$sbayar['sudah_bayar'];?></td>
	<td></td>
</tr>
<?php 
};
}else{
?>
<tr>
	<td colspan="4"><center>Belum Ada Beban</center></td>
</tr>
<?php 
}
?>