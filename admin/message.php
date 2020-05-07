<?php
session_start();

$field = array(
    "sender_id" => "FSTSMS",
    "language" => "english",
    "route" => "qt",
    "numbers" => $_POST['numbers'],
    "message" => "24650",
    "variables" => "{#BB#}",
    "variables_values" => $_POST['variable_values']
);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($field),
  CURLOPT_HTTPHEADER => array(
    "authorization: GW1lqYHSKLR8dmEoUbvy6hcF4OgZTpBajVwQXCnt2PIfi903NsS54ckhYmpxrQnus92LFjowRXdMiU1H",
    "cache-control: no-cache",
    "accept: */*",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
$msg =$field["variables_values"];
$id = 1;
//Database Connection
$conn = new mysqli('localhost', 'root', '', 'smartbikes');
if($conn-> connect_error){
    die('Connection Failed:'.$conn->connect_error);

}
else{
  $stmt = $conn->prepare("INSERT INTO `value`( `id`,`otp`) Values (?,?)");
        $stmt->bind_param("ii", $id,$msg);
        $stmt->execute();
        $stmt->close();
        $conn->close();
}
?>