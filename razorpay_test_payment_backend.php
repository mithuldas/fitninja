<?php

require __DIR__ . '/vendor/autoload.php';

use Razorpay\Api\Api;

$api_key="rzp_live_cY4Rzp82rZKsDq";
$api_secret="E7W6UlNrI3ZTAJmf1HJnw65x";

$api = new Api($api_key, $api_secret);

/*$order = $api->order->create(array(
  'receipt' => '123',
  'amount' => 100,
  'currency' => 'INR'
  )
); */

$orders = $api->order->all();

print "<pre>";
print_r($orders);
print "</pre>";
?>
