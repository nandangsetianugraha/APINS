<?php

$id_kab = $_GET['id_kabupaten'];

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/$id_kab/kecamatan",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;
}

$data = json_decode($response, true);
for ($i=0; $i < count($data['kecamatans']); $i++) {
  echo "<option value='".$data['kecamatans'][$i]['id']."'>".$data['kecamatans'][$i]['nama']."</option>";
}

?>