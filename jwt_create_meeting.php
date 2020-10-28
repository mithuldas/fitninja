<?php
require __DIR__ . '/vendor/autoload.php';

use \Firebase\JWT\JWT;

$key = "mhWHl73oj9n5nU5gdEzTmty2nnNKECsfUdFC";
$payload = array(
    "iss" => "vMs6BwCXTciKkv5hoiWWag",
    "exp" => time()+36000, // expire in 10 hours
);

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */
$jwt = JWT::encode($payload, $key, 'HS256');
$decoded = JWT::decode($jwt, $key, array('HS256'));


//print_r($decoded);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.zoom.us/v2/users/mithuldas@gmail.com/meetings", //This is the Zoom API endpoint you'd hit to get a list of active users.
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"topic\":\"Integration test meeting 2\",\"type\":\"2\",\"start_time\":\"2020-10-28T14:00:00Z\",\"duration\":\"60\",\"timezone\":\"UTC\",\"agenda\":\"Session 1 between Test_Trainer and Test_Trainee\",\"settings\":{\"host_video\":\"true\",\"participant_video\":\"true\",\"join_before_host\":\"false\",\"mute_upon_entry\":\"false\",\"approval_type\":\"2\",\"audio\":\"both\",\"auto_recording\":\"none\",\"waiting_room\":\"false\"}}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer {$jwt}", // You provide your JWT token in the Authorization header.
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
$test = json_decode($response);
$prettyResponse = json_encode($test, JSON_PRETTY_PRINT);
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo "<pre>".$prettyResponse."</pre>";
}

?>
