<?php
// menggunakan class phpExcelReader
include "excel_reader2.php";

// koneksi ke mysql
include '../inc/db.php';

// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['filetransaksi']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);

// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;

// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
for ($i=2; $i<=$baris; $i++)
{
  $tanggal     = $data->val($i, 1);
	$thn = substr($tanggal, 6, 4);
	$bln = substr($tanggal, 3, 2);
	$tgl   = substr($tanggal, 0, 2);
	$tgls=$thn."-".$bln."-".$tgl;
	$kode   = $data->val($i, 5);
	$nasabahid  = $data->val($i, 2);
	$masuk  = $data->val($i, 6);
	$keluar = $data->val($i, 7);

  // setelah data dibaca, sisipkan ke dalam tabel mhs
  mysqli_query($koneksi,"INSERT into tabungan values('','$tgls','$kode','$nasabahid','$masuk','$keluar')");

  // jika proses insert data sukses, maka counter $sukses bertambah
  // jika gagal, maka counter $gagal yang bertambah
  $sukses++;
}

// tampilan status sukses dan gagal
echo "<h3>Proses import data selesai.</h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
header("location:tabungan.php?berhasil=$berhasil");

?>