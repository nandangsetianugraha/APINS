<?php 
require_once '../../inc/db_connect.php';
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
$bln=$_GET['bln'];
$thn=$_GET['thn'];
$output = array('data' => array());
$sql = "SELECT * FROM id_pegawai order by pegawai_id asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['pegawai_id'];
	$pegid=$row['ptk_id'];
	$namap = $connect->query("SELECT * FROM ptk WHERE ptk_id='$pegid'")->fetch_assoc();
	$pn = $connect->query("select * from potongan_gaji where pegawai_id='$idp' and bulan='$bln' and tahun='$thn'")->fetch_assoc();
	$tunj1 = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$pn['hari'].'"  onBlur="simpankes(this,\'hari\',\''.$idp.'\',\''.$bln.'\',\''.$thn.'\')" onClick="highlightEdit(this);">'.$pn['hari'].'</span>
		';
	$tunj2 = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$pn['absen'].'"  onBlur="simpankes(this,\'absen\',\''.$idp.'\',\''.$bln.'\',\''.$thn.'\')" onClick="highlightEdit(this);">'.$pn['absen'].'</span>
		';
	$tunj3 = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$pn['telat'].'"  onBlur="simpankes(this,\'ekskul\',\''.$idp.'\',\''.$bln.'\',\''.$thn.'\')" onClick="highlightEdit(this);">'.$pn['ekskul'].'</span>
		';
	$tunj4 = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$pn['telat'].'"  onBlur="simpankes(this,\'telat\',\''.$idp.'\',\''.$bln.'\',\''.$thn.'\')" onClick="highlightEdit(this);">'.$pn['telat'].'</span>
		';
	$tunj5 = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$pn['cepat'].'"  onBlur="simpankes(this,\'cepat\',\''.$idp.'\',\''.$bln.'\',\''.$thn.'\')" onClick="highlightEdit(this);">'.$pn['cepat'].'</span>
		';
	//$namasis=$pn['nama'];
	$output['data'][] = array(
		$idp,
		$namap['nama'],
		$tunj1,
		$tunj2,
		$tunj3,
		$tunj4,
		$tunj5
	);
}

// database connection close
$connect->close();

echo json_encode($output);