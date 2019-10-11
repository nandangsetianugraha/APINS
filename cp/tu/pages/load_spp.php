<?php
$data = json_decode($response, true);
for ($i=0; $i < count($data['desas']); $i++) {
  echo "<option value='".$data['desas'][$i]['nama']."'>".$data['desas'][$i]['nama']."</option>";
}

?>