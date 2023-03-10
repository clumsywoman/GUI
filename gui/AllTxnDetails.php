<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost:8082/bank/users',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$Decode = json_decode($response);

echo "<h1><b>Transaction Details </b></h1>";

foreach($Decode as $key => $value) {
  $index = $key + 1;
  echo "<br><b>Transaction ".$index."</b><br>";
  foreach($value as $newkey => $newvalue){
    echo " <br>" . $newkey . " : " . $newvalue . " ";
  }
  echo "<br>";
}
//print_r($Decode);


?>