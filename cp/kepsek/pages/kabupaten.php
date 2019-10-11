<?php

$provinsi_id = $_GET['prov_id'];

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://dev.farizdotid.com/api/daerahindonesia/provinsi/$provinsi_id/kabupaten",
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
for ($i=0; $i < count($data['kabupatens']); $i++) {
  echo "<option value='".$data['kabupatens'][$i]['id']."'>".$data['kabupatens'][$i]['nama']."</option>";
}

?>