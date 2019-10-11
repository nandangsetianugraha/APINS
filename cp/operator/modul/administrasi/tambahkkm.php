<?php 

require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$kelas=$_POST['kelas'];
	$tapel=$_POST['tapel'];
	$mapel=$_POST['mapel'];
	$kd=$_POST['kd'];
	$jns=$_POST['jns'];
	$nilai=$_POST['nilai'];
	$sql = "select * from kkmku where kelas='$kelas' AND tapel='$tapel' AND mapel='$mapel' and kd='$kd'";
	$query = $connect->query($sql);
	$cks = $query->fetch_assoc();
	$ada = $query->num_rows;
	if($ada>0){
		if($jns=="k1"){
			$idn=$cks['id_kkm'];
			$cr1=$nilai;
			$cr2=$cks['k2'];
			$cr3=$cks['k3'];
			if($cr1==0){
				if($cr2==0){
					if($cr3==0){
						$nkkm=0;
					}else{
						$nkkm=$cr3;
					}
				}else{
					if($cr3==0){
						$nkkm=$cr2;
					}else{
						$nkkm=round(($cr2+$cr3)/2);
					}
				}
			}else{
				if($cr2==0){
					if($cr3==0){
						$nkkm=$cr1;
					}else{
						$nkkm=round(($cr1+$cr3)/2);
					}
				}else{
					if($cr3==0){
						$nkkm=round(($cr1+$cr2)/2);
					}else{
						$nkkm=round(($cr1+$cr2+$cr3)/3);
					}
				}
			};
			$sqln = "UPDATE kkmku SET k1='$nilai',rk='$nkkm' WHERE id_kkm='$idn'";
			$queryn = $connect->query($sqln);
			if($queryn === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Sukses";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the member information";
			};
		};
		if($jns=="k2"){
			$idn=$cks['id_kkm'];
			$cr1=$cks['k1'];
			$cr2=$nilai;
			$cr3=$cks['k3'];
			if($cr1==0){
				if($cr2==0){
					if($cr3==0){
						$nkkm=0;
					}else{
						$nkkm=$cr3;
					}
				}else{
					if($cr3==0){
						$nkkm=$cr2;
					}else{
						$nkkm=round(($cr2+$cr3)/2);
					}
				}
			}else{
				if($cr2==0){
					if($cr3==0){
						$nkkm=$cr1;
					}else{
						$nkkm=round(($cr1+$cr3)/2);
					}
				}else{
					if($cr3==0){
						$nkkm=round(($cr1+$cr2)/2);
					}else{
						$nkkm=round(($cr1+$cr2+$cr3)/3);
					}
				}
			};
			$sqln = "UPDATE kkmku SET k2='$nilai',rk='$nkkm' WHERE id_kkm='$idn'";
			$queryn = $connect->query($sqln);
			if($queryn === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Sukses";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the member information";
			};
		};
		if($jns=="k3"){
			$idn=$cks['id_kkm'];
			$cr1=$cks['k1'];
			$cr2=$cks['k2'];
			$cr3=$nilai;
			if($cr1==0){
				if($cr2==0){
					if($cr3==0){
						$nkkm=0;
					}else{
						$nkkm=$cr3;
					}
				}else{
					if($cr3==0){
						$nkkm=$cr2;
					}else{
						$nkkm=round(($cr2+$cr3)/2);
					}
				}
			}else{
				if($cr2==0){
					if($cr3==0){
						$nkkm=$cr1;
					}else{
						$nkkm=round(($cr1+$cr3)/2);
					}
				}else{
					if($cr3==0){
						$nkkm=round(($cr1+$cr2)/2);
					}else{
						$nkkm=round(($cr1+$cr2+$cr3)/3);
					}
				}
			};
			$sqln = "UPDATE kkmku SET k3='$nilai',rk='$nkkm' WHERE id_kkm='$idn'";
			$queryn = $connect->query($sqln);
			if($queryn === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Sukses";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the member information";
			};
		};
	}else{
		if($jns=="k1"){
			$sql1 = "INSERT INTO kkmku VALUES('','$kelas','$tapel','$mapel','$kd','$nilai','','','$nilai')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Sukses berhasil diinput!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the member information";
			};
		};
		if($jns=="k2"){
			$sql1 = "INSERT INTO kkmku VALUES('','$kelas','$tapel','$mapel','$kd','','$nilai','','$nilai')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Sukses berhasil diinput!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the member information";
			};
		};
		if($jns=="k3"){
			$sql1 = "INSERT INTO kkmku VALUES('','$kelas','$tapel','$mapel','$kd','','','$nilai','$nilai')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Sukses berhasil diinput!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the member information";
			};
		}
	};	
	$sql2 = "select AVG(rk) as ratarata from kkmku where kelas='$kelas' AND tapel='$tapel' AND mapel='$mapel'";
	$query2 = $connect->query($sql2);
	$cks2 = $query2->fetch_assoc();
	$kkmbeneran=$cks2['ratarata'];
		
	$sql12 = "select * from kkm where kelas='$kelas' AND tapel='$tapel' AND mapel='$mapel'";
	$query12 = $connect->query($sql12);
	$cks1 = $query12->fetch_assoc();
	$ada1 = $query12->num_rows;
	if($ada1>0){
		$idk=$cks1['id_kkm'];
		$sqln = "UPDATE kkm SET nilai='$kkmbeneran' WHERE id_kkm='$idk'";
		$queryn = $connect->query($sqln);
	}else{
		$sql11 = "INSERT INTO kkm VALUES('','$kelas','$tapel','$mapel','$kkmbeneran')";
		$query11 = $connect->query($sql11);
	}
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}