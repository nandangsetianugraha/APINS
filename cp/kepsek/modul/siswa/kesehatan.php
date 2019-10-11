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
$output = array('data' => array());
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['peserta_didik_id'];
	$sqlp = "SELECT * FROM data_kesehatan WHERE peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'";
	$pn = $connect->query($sqlp)->fetch_assoc();
	$tng=$pn['tinggi'];
	$brt=$pn['berat'];
	$telinga=$pn['pendengaran'];
	$mata=$pn['penglihatan'];
	$gg=$pn['gigi'];
	$lain=$pn['lainnya'];
	$tinggi = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$tng.'"  onBlur="simpankes(this,\'tinggi\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$tng.'</span>
		';
	$berat = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$brt.'"  onBlur="simpankes(this,\'berat\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$brt.'</span>
		';
	$pendengaran = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$telinga.'"  onBlur="simpankes(this,\'pendengaran\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$telinga.'</span>
		';
	$penglihatan = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$mata.'"  onBlur="simpankes(this,\'penglihatan\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$mata.'</span>
		';
	$gigi = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$gg.'"  onBlur="simpankes(this,\'gigi\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$gg.'</span>
		';
	$lainnya = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$lain.'"  onBlur="simpankes(this,\'lainnya\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$lain.'</span>
		';
	//$namasis=$pn['nama'];
	$output['data'][] = array(
		$row['nama'],
		$tinggi,
		$berat,
		$pendengaran,
		$penglihatan,
		$gigi,
		$lainnya
	);
}

// database connection close
$connect->close();

echo json_encode($output);