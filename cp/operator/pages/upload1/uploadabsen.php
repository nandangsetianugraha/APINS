<?php 

require_once 'koneksi.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	//$filed=$_POST['file'];
	$nama_file_baru = 'data.xlsx';
	if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
		unlink('tmp/'.$nama_file_baru); // Hapus file tersebut
		$ext = pathinfo($_FILES['fileupload']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
		$tmp_file = $_FILES['fileupload']['tmp_name'];
	if($ext == "xlsx"){
		move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);

		// Load librari PHPExcel nya
		require_once 'PHPExcel/PHPExcel.php';

		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		$numrow = 1;
		foreach($sheet as $row){
			// Ambil data pada excel sesuai Kolom
			$nis = $row['A']; // Ambil data NIS
			$nama = $row['B']; // Ambil data nama
			
			// Cek jika semua data tidak diisi
			if(empty($nis) && empty($nama))
				continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Buat query Insert
				$query = "INSERT INTO absensi_ptk VALUES('','$nis','$nama')";

				// Eksekusi $query
				mysqli_query($koneksi, $query);
			}

			$numrow++; // Tambah 1 setiap kali looping
		};
		$validator['success'] = true;
		$validator['messages'] = "Sukses Memasukkan ".$numrow." Data";
	}else{
		$validator['success'] = false;
		$validator['messages'] = "Hanya File Excel 2007 (.xlsx) yang diperbolehkan";
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}