<?php
/**
 * Created by PhpStorm.
 * User: Abu Dzakiyyah
 * Date: 3/27/2018
 * Time: 9:23 PM
 */
include "../../inc/db.php";
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}
$idNasabah = $_POST['idNasabah'];
//$password = $_POST['password'];
$query			= mysqli_fetch_array(mysqli_query($koneksi, 'SELECT * FROM nasabah WHERE nasabah_id = "'.$idNasabah.'"')); // Check the table 
if($idNasabah === $query['nasabah_id']){
	$setor=mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(IF(kode='1',masuk,0)) as setoran FROM tabungan WHERE nasabah_id = '$idNasabah'"));
	$ambil=mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(IF(kode='2',keluar,0)) as penarikan FROM tabungan WHERE nasabah_id = '$idNasabah'"));
	$saldo=$setor['setoran']-$ambil['penarikan'];
    $response = array("status"=>"ada_nasabah","IDnasabah"=>$query['nasabah_id'],"namaLengkap"=>$query['nama'],"saldo"=>rupiah($saldo));
}else{
    $response = array("status"=>"no_nasabah","saldo"=>"-");
};
echo json_encode($response);