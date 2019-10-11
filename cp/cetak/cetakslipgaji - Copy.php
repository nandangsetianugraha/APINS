<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../../inc/db_connect.php';
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
	$idpeg=$_GET['idpeg'];
	$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$namafilenya="Slip Gaji ".$bulan[(int)$bln]." ".$thn.".pdf";
		$pdf=new exFPDF('P','mm',array(215,330));
		$pdf->AddPage(); 
		$pdf->SetFont('helvetica','',10);

		$table2=new easyTable($pdf, 1);
		$table2->rowStyle('font-size:14');
		$table2->easyCell('SD ISLAM AL-JANNAH','align:L;font-style:B');
		$table2->printRow();
		$table2->rowStyle('font-size:8');
		$table2->easyCell('Jl. Raya Gabuswetan No. 1 Desa Gabuswetan Kec. Gabuswetan','align:L;');
		$table2->printRow();
		$table2->rowStyle('font-size:8');
		$table2->easyCell('Indramayu - Jawa Barat 45263 Telp. (0234) 5508501','align:L');
		$table2->printRow();
		$table2->rowStyle('font-size:8;border:B');
		$table2->easyCell('Website: http://sdi-aljannah.web.id Email: sdi.aljannah@gmail.com');
		$table2->printRow();
		$table2->endTable();
		
		$table2=new easyTable($pdf, 1);
		$table2->rowStyle('font-size:14');
		$table2->easyCell('SLIP GAJI','align:C;font-style:B');
		$table2->printRow();
		$table2->rowStyle('font-size:9');
		$table2->easyCell('BULAN : '.$bulan[(int)$bln].' '.$thn,'align:C;font-style:B');
		$table2->printRow();
		$table2->endTable();
		
		$table2=new easyTable($pdf, '{33,5,33,33,5,33,25,5,50}');
		$table2->easyCell('Pegawai ID','align:L;font-style:B;border:T');
		$table2->easyCell(':','align:L;font-style:B;border:T');
		$table2->easyCell($idpeg,'align:L;font-style:B;border:T');
		$table2->easyCell('','align:L;font-style:B;border:T');
		$table2->easyCell('','align:L;font-style:B;border:T');
		$table2->easyCell('','align:L;font-style:B;border:T');
		$table2->easyCell('Sekolah','align:L;font-style:B;border:T');
		$table2->easyCell(':','align:L;font-style:B;border:T');
		$table2->easyCell('SD ISLAM AL-JANNAH','align:L;font-style:B;border:T');
		$table2->printRow();
		
		$ptk=$connect->query("select * from id_pegawai where pegawai_id='$idpeg'")->fetch_assoc();
		$idptk=$ptk['ptk_id'];
		$nptk=$connect->query("select * from ptk where ptk_id='$idptk'")->fetch_assoc();
		$jnsptk=$nptk['jenis_ptk_id'];
		$jptk=$connect->query("select * from jenis_ptk where jenis_ptk_id='$jnsptk'")->fetch_assoc();
		$table2->easyCell('Nama','align:L;font-style:B');
		$table2->easyCell(':','align:L;font-style:B');
		$table2->easyCell($nptk['nama'],'colspan:4;align:L;font-style:B');
		$table2->easyCell('Jabatan','align:L;font-style:B');
		$table2->easyCell(':','align:L;font-style:B');
		$table2->easyCell($jptk['jenis_ptk'],'align:L;font-style:B');
		$table2->printRow();
		
		$table2->easyCell('RINCIAN GAJI','colspan:3;align:L;font-style:B;border:T');
		$table2->easyCell('POTONGAN','colspan:3;align:L;font-style:B;border:T');
		$table2->easyCell('KEHADIRAN','colspan:3;align:L;font-style:B;border:T');
		$table2->printRow();
		
		$gp=$connect->query("select * from gajipokok where pegawai_id='$idpeg'")->fetch_assoc();
		$po=$connect->query("select * from potongan_gaji where pegawai_id='$idpeg' and bulan='$bln' and tahun='$thn'")->fetch_assoc();
		$ada=$connect->query("select * from potongan_gaji where pegawai_id='$idpeg' and bulan='$bln' and tahun='$thn'")->num_rows;
		if($ada>0){
			$table2->easyCell('Gaji Pokok','align:L;font-style:B;border:T');
			$table2->easyCell(':','align:L;font-style:B;border:T');
			$table2->easyCell('Rp. '.number_format($gp['insentif']*9*20,0,",","."),'align:R;font-style:B;border:T');
			$table2->easyCell('Datang Telat','align:L;font-style:B;border:T');
			$table2->easyCell(':','align:L;font-style:B;border:T');
			$table2->easyCell('Rp. '.number_format(round(($po['telat']/60)*$gp['insentif']),0,",","."),'align:R;font-style:B;border:T');
			$table2->easyCell('Hari Kerja','align:L;font-style:B;border:T');
			$table2->easyCell(':','align:L;font-style:B;border:T');
			$table2->easyCell($po['hari'].' Hari','align:R;font-style:B;border:T');
			$table2->printRow();
			
			$table2->easyCell('Transport','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format($gp['transport'],0,",","."),'align:R;font-style:B');
			$table2->easyCell('Cepat Pulang','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format(round(($po['cepat']/60)*$gp['insentif']),0,",","."),'align:R;font-style:B');
			$table2->easyCell('Kehadiran','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell($po['hari']-$po['absen'].' Hari','align:R;font-style:B');
			$table2->printRow();
			
			$table2->easyCell('Tunj. Jabatan','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format($gp['tunj_walikelas'],0,",","."),'align:R;font-style:B');
			$table2->easyCell('Absen','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format(round($po['absen']*9*$gp['insentif']),0,",","."),'align:R;font-style:B');
			$table2->easyCell('Absensi','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell($po['absen'].' Hari','align:R;font-style:B');
			$table2->printRow();
			
			$totalgaji=$gp['insentif']*9*20+$gp['transport']+$gp['tunj_walikelas']+$gp['tunj_kepsek']+$gp['tunj_kehadiran']+$gp['tunj_ekskul'];
			if($po['absen']==0){
				$takhadir=0;
			}else{
				$takhadir=$gp['tunj_kehadiran'];
			};
			$totalpotong=round(($po['telat']/60)*$gp['insentif'])+round(($po['cepat']/60)*$gp['insentif'])+round($po['absen']*9*$gp['insentif'])+$takhadir;
			
			$table2->easyCell('Tunj. Lain','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format($gp['tunj_kepsek'],0,",","."),'align:R;font-style:B');
			$table2->easyCell('Ketidakhadiran','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format($takhadir,0,",","."),'align:R;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			
			$table2->easyCell('Kehadiran','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format($gp['tunj_kehadiran'],0,",","."),'align:R;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('Late','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell($po['telat'].' menit','align:R;font-style:B');
			$table2->printRow();
			
			$table2->easyCell('Ekstrakurikuler','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format($gp['tunj_ekskul'],0,",","."),'align:R;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('Early','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell($po['cepat'].' menit','align:R;font-style:B');
			$table2->printRow();
			
			
			$table2->easyCell('Total Gaji','align:L;font-style:B;border:T');
			$table2->easyCell(':','align:L;font-style:B;border:T');
			$table2->easyCell('Rp. '.number_format($totalgaji,0,",","."),'align:R;font-style:B;border:T');
			$table2->easyCell('Total Potongan','align:L;font-style:B;border:T');
			$table2->easyCell(':','align:L;font-style:B;border:T');
			$table2->easyCell('Rp. '.number_format($totalpotong,0,",","."),'align:R;font-style:B;border:T');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			
			$table2->easyCell('Gaji Bersih','align:L;font-style:B;border:T');
			$table2->easyCell(':','align:L;font-style:B;border:T');
			$table2->easyCell('Rp. '.number_format($totalgaji-$totalpotong,0,",","."),'colspan:4;align:R;font-style:B;border:T');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
		}else{
			$table2->easyCell('Belum Ada Gaji Bulan '.$bulan[(int)$bln].' '.$thn,'colspan:9;align:C;font-style:B;border:TB');
			$table2->printRow();
		}
		$table2->endTable(2);
		
		//$hari = cal_days_in_month(CAL_GREGORIAN, (int)$bln, $thn);
		$hab = $connect->query("SELECT pegawai_id,DATE_FORMAT(tanggal,'%Y-%m-%d') tgl,min(left(RIGHT(tanggal, 8), 5)) jam1,MAX(left(right(tanggal, 8), 5)) jam2,
if(LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '07:00:00'))))>0,LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '07:00:00'))))/60,'') diff1, 
if(LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('16:00:00', MAX(left(right(tanggal, 8), 5))))))>0,LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('16:00:00', MAX(left(right(tanggal, 8), 5))))))/60,'') diff2
FROM absensi_ptk where pegawai_id='$idpeg' and DATE_FORMAT(tanggal,'%Y-%m-%d') like '$thn-%$bln-%' group by tgl");
		$table2=new easyTable($pdf, 5,'border:1');
		$table2->easyCell('Tanggal','align:C;font-style:B');
		$table2->easyCell('Absen Masuk','align:C;font-style:B');
		$table2->easyCell('Absen Keluar','align:C;font-style:B');
		$table2->easyCell('Telat (Menit)','align:C;font-style:B');
		$table2->easyCell('Cepat Pulang (Menit)','align:C;font-style:B');
		$table2->printRow();
		while($sis=$hab->fetch_assoc()){
			$table2->easyCell($sis['tgl'],'align:C;font-style:B');
			$table2->easyCell($sis['jam1'],'align:C;font-style:B');
			$table2->easyCell($sis['jam2'],'align:C;font-style:B');
			$table2->easyCell($sis['diff1'],'align:C;font-style:B');
			$table2->easyCell($sis['diff2'],'align:C;font-style:B');
			$table2->printRow();
		};
		$table2->endTable(2);
		
		//Tanda Tangan
		$table2=new easyTable($pdf, '{33,5,33,33,5,33,25,5,50}');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('Kepala Sekolah','align:C;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:8');
			$table2->easyCell('Catatan:','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:6');
			$table2->easyCell('1. Slip Gaji ini merupakan Bukti Pengambilan Gaji','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:6');
			$table2->easyCell('2. Slip Gaji ini sah apabila ada Tanda Tangan dan Cap Sekolah','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:6');
			$table2->easyCell('3. Daftar Hadir diambil dari Data Fingerprint','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:8');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:8');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:8');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('UMAR ALI, BA.','align:C;font-style:B;border:B');
			$table2->printRow();
		$table2->endTable();
		
		
		
			$pdf->Output();
			//$pdf->Output('D',$namafilenya);
		 


 

?>