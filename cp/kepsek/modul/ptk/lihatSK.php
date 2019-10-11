<?php
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
include '../../../inc/db.php';
$idp=isset($_GET['idp']) ? $_GET['idp'] : $idku;
$sqsk=mysqli_query($koneksi, "select * from sk where ptk_id='$idp' order by tanggal_sk desc");
?>
<ul class="timeline timeline-inverse">
<?php 
while($skk=mysqli_fetch_array($sqsk)){
?>
	<li class="time-label">
		<span class="bg-red">
		  <?=TanggalIndo($skk['tanggal_sk']);?>
		</span>
	</li>
	<li>
		<i class="fa fa-envelope bg-blue"></i>
		<div class="timeline-item">
		  <h3 class="timeline-header"><?=$skk['no_sk'];?></h3>
		  <div class="timeline-body">
			Jabatan : <?=$skk['jabatan'];?><br/>
			Pengangkat : <?=$skk['pengangkat'];?><br/>
		  </div>
		  <div class="timeline-footer">
			<a href="../../cetak/cetakSK.php?id=<?=$skk['id_sk'];?>&idptk=<?=$idp;?>" class="btn btn-primary btn-xs" target="_blank"><i class="fa fa-print"></i> Print</a>
		  </div>
		</div>
	</li>
<?php }; ?>
	<li>
		<i class="fa fa-clock-o bg-gray"></i>
	</li>
</ul>