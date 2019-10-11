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
function namahari($tanggal){
    
    //fungsi mencari namahari
    //format $tgl YYYY-MM-DD
    //harviacode.com
    
    $tgl=substr($tanggal,8,2);
    $bln=substr($tanggal,5,2);
    $thn=substr($tanggal,0,4);

    $info=date('w', mktime(0,0,0,$bln,$tgl,$thn));
    
    switch($info){
        case '0': return "Minggu"; break;
        case '1': return "Senin"; break;
        case '2': return "Selasa"; break;
        case '3': return "Rabu"; break;
        case '4': return "Kamis"; break;
        case '5': return "Jumat"; break;
        case '6': return "Sabtu"; break;
    };
    
};
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../../inc/db_connect.php';
 $bulan1 = array ('Januari',
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
	$bulan=isset($_GET['bulanku']) ? $_GET['bulanku'] : '';
	$tahun=isset($_GET['tahunku']) ? $_GET['tahunku'] : '';
	$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : '';
	$pdf=new exFPDF('L','mm',array(330,215));
	$pdf->AddPage(); 
	$pdf->SetFont('helvetica','',12);
	if(empty($bulan) || empty($tahun)){
	}else{
		$hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
		//$namafilenya="Absensi Kelas ".$kelas." Bulan ".$bulan1[(int)$bulan-1].".pdf";
		$table2=new easyTable($pdf, '{150,65}');
		$table2->rowStyle('font-size:14');
		$table2->easyCell('SD ISLAM AL-JANNAH','align:L;font-style:B');
		$table2->rowStyle('font-size:10');
		$table2->easyCell('REKAPITULASI GAJI BULAN : '.$bulan1[(int)$bulan].' '.$tahun,'rowspan:2;valign:M;align:C;font-style:B;border:1');
		$table2->printRow();
		$table2->rowStyle('font-size:8');
		$table2->easyCell('Jl. Raya Gabuswetan No. 1 Desa Gabuswetan Kec. Gabuswetan','align:L;');
		$table2->printRow();
		$table2->rowStyle('font-size:8');
		$table2->easyCell('Indramayu - Jawa Barat 45263 Telp. (0234) 5508501','align:L');
		$table2->easyCell('','align:L');
		$table2->printRow();
		$table2->rowStyle('font-size:8');
		$table2->easyCell('Website: http://sdi-aljannah.web.id Email: sdi.aljannah@gmail.com');
		$table2->easyCell('','align:L');
		$table2->printRow();
		$table2->endTable();
		
		$table2=new easyTable($pdf, '{10,47,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,30}','border:1');
		$table2->rowStyle('font-size:8');
		$table2->easyCell('ID','rowspan:2;align:C;font-style:B');
		$table2->easyCell('Nama PTK','rowspan:2;align:C;font-style:B');
		$table2->easyCell('GAJI POKOK','colspan:6;align:C;font-style:B');
		$table2->easyCell('TOTAL','rowspan:2;align:C;font-style:B');
		$table2->easyCell('POTONGAN GAJI','colspan:4;align:C;font-style:B');
		$table2->easyCell('TOTAL','rowspan:2;align:C;font-style:B');
		$table2->easyCell('GAJI BERSIH','rowspan:2;align:C;font-style:B');
		$table2->easyCell('ABSENSI','colspan:5;align:C;font-style:B');
		$table2->easyCell('Tanda Tangan','colspan:2;rowspan:2;valign:M;align:C;font-style:B');
		$table2->printRow();
		$table2->rowStyle('font-size:8');
		$table2->easyCell('Gaji','align:C;font-style:B');
		$table2->easyCell('Transport','align:C;font-style:B');
		$table2->easyCell('Tunj. Jabatan','align:C;font-style:B');
		$table2->easyCell('Tunj. Lain','align:C;font-style:B');
		$table2->easyCell('Kehadiran','align:C;font-style:B');
		$table2->easyCell('Pemb. Ekskul','align:C;font-style:B');
		$table2->easyCell('Late','align:C;font-style:B');
		$table2->easyCell('Early','align:C;font-style:B');
		$table2->easyCell('Absen','align:C;font-style:B');
		$table2->easyCell('Ketidakhadiran','align:C;font-style:B');
		$table2->easyCell('Ekskul','align:C;font-style:B');
		$table2->easyCell('Normal','align:C;font-style:B');
		$table2->easyCell('Kehadiran','align:C;font-style:B');
		$table2->easyCell('Absensi','align:C;font-style:B');
		$table2->easyCell('Late','align:C;font-style:B');
		$table2->easyCell('Early','align:C;font-style:B');
		$table2->printRow(true);
		
		
		//Pengulangan Guru
		$skl = "select * from id_pegawai order by pegawai_id asc";
		$qkl = $connect->query($skl);
		$ssakit=0;$sijin=0;$salfa=0;
		$bhari=$connect->query("select * from hari_efektif where bulan='$bulan' and tapel='$tapel'")->fetch_assoc();
		while($sis=$qkl->fetch_assoc()){
			$idptk=$sis['ptk_id'];
			$idpeg=$sis['pegawai_id'];
			$namaptk=$connect->query("select * from ptk where ptk_id='$idptk'")->fetch_assoc();
			$hab = $connect->query("SELECT pegawai_id,DATE_FORMAT(tanggal,'%Y-%m-%d') tgl,min(left(RIGHT(tanggal, 8), 5)) jam1,MAX(left(right(tanggal, 8), 5)) jam2,
if(LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '07:00:00'))))>0,LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '07:00:00'))))/60,'') diff1, 
if(LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('16:00:00', MAX(left(right(tanggal, 8), 5))))))>0,LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('16:00:00', MAX(left(right(tanggal, 8), 5))))))/60,'') diff2
FROM absensi_ptk where pegawai_id='$idpeg' and DATE_FORMAT(tanggal,'%Y-%m-%d') like '$tahun-%$bulan-%' group by tgl");
			$jumLate=0;
			$jumEarly=0;
			while($absen=$hab->fetch_assoc()){
				$jtlt=$absen['jam1'];
				$jcpt=$absen['jam2'];
				$jumLate=$jumLate+$absen['diff1'];
				if($jtlt===$jcpt){
					$jumEarly=$jumEarly+120;
				}else{
					$jumEarly=$jumEarly+$absen['diff2'];
				};
			};
			$jhadir=0;
			$jhari=0;
			for ($i=1; $i < $hari+1; $i++) { 
				if($i>9){
					$ab=$i;
				}else{
					$ab="0".$i;
				};
				$ttt=$tahun."-".$bulan."-".$ab;
				if(namahari($ttt)==="Sabtu" || namahari($ttt)==="Minggu"){
					
				}else{
					$jhari=$jhari+1;
					$hadir=$connect->query("select * from absensi_ptk where pegawai_id='$idpeg' and DATE_FORMAT(tanggal,'%Y-%m-%d')='$ttt'")->num_rows;
					if($hadir>0){
						$jhadir=$jhadir+1;
					}else{
						$jhadir=$jhadir;
					};
				};
			};
			if($bhari['hari']==0){
				$hae=$jhari;
			}else{
				$hae=$bhari['hari'];
			};
			$table2->rowStyle('font-size:8;min-height:10');
			$table2->easyCell($idpeg,'valign:M;align:C;font-style:B');
			$table2->easyCell($namaptk['nama'],'valign:M;align:L;font-style:B');
			$table2->easyCell($hae,'valign:M;align:C;font-style:B');
			$table2->easyCell($jhadir,'valign:M;align:C;font-style:B');
			$table2->easyCell($hae-$jhadir,'valign:M;align:C;font-style:B');
			$table2->easyCell($jumLate,'valign:M;align:C;font-style:B');
			$table2->easyCell($jumEarly,'valign:M;align:C;font-style:B');
			$table2->easyCell('','valign:M;align:C;font-style:B');
			$table2->easyCell('','valign:M;align:C;font-style:B');
			$table2->easyCell('','valign:M;align:C;font-style:B');
			$table2->easyCell('','valign:M;align:C;font-style:B');
			$table2->easyCell('','valign:M;align:C;font-style:B');
			$table2->easyCell('','valign:M;align:C;font-style:B');
			$table2->easyCell('','valign:M;align:C;font-style:B');
			$table2->easyCell('','valign:M;align:C;font-style:B');
			$table2->easyCell('','valign:M;align:C;font-style:B');
			$jkerja=Round(($jhadir*9*60-$jumLate-$jumEarly)/60,0);
			$table2->easyCell($jkerja,'valign:M;align:C;font-style:B');
			$prosen=round((($jhadir*9*60-$jumLate-$jumEarly)/($hae*9*60))*100,0);
			$table2->easyCell($prosen,'valign:M;align:C;font-style:B');
			$table2->printRow();
			
		};
		$table2->endTable();
		
		$table2=new easyTable($pdf, '{200,97}');
		$table2->rowStyle('font-size:12');
		$table2->easyCell('','valign:M;align:C');
		$table2->easyCell('Gabuswetan, '.$hari.' '.$bulan1[(int)$bulan-1].' '.$tahun,'align:L');
		$table2->printRow();
		$table2->easyCell('','valign:M;align:C');
		$table2->easyCell('Kepala Sekolah','align:L');
		$table2->printRow();
		$table2->easyCell('','valign:M;align:C;font-style:B');
		$table2->easyCell('','align:L;font-style:B');
		$table2->printRow();
		$table2->easyCell('','valign:M;align:C;font-style:B');
		$table2->easyCell('','align:L;font-style:B');
		$table2->printRow();
		$table2->easyCell('','valign:M;align:C;font-style:B');
		$table2->easyCell('','align:L;font-style:B');
		$table2->printRow();
		$table2->easyCell('','valign:M;align:C;font-style:B');
		$table2->easyCell('','align:L;font-style:B');
		$table2->printRow();
		$table2->easyCell('','valign:M;align:C;font-style:B');
		$table2->easyCell('','align:L;font-style:B');
		$table2->printRow();
		$table2->easyCell('','valign:M;align:C;font-style:B');
		$table2->easyCell('','align:L;font-style:B');
		$table2->printRow();
		$table2->easyCell('','valign:M;align:C;font-style:B');
		$table2->easyCell('','align:L;font-style:B');
		$table2->printRow();
		$table2->easyCell('','valign:M;align:C;font-style:B');
		$table2->easyCell('','align:L;font-style:B');
		$table2->printRow();
		$table2->easyCell('','valign:M;align:C;font-style:B');
		$table2->easyCell('','align:L;font-style:B');
		$table2->printRow();
		$table2->easyCell('','valign:M;align:C;font-style:B');
		$table2->easyCell('UMAR ALI, BA.','align:L;font-style:B');
		$table2->printRow();
		$table2->endTable();
	};
	$pdf->Output();



 

?>