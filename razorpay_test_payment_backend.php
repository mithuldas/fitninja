<?php

require __DIR__ . '/vendor/autoload.php';

use Razorpay\Api\Api;

$api_key="rzp_live_cY4Rzp82rZKsDq";
$api_secret="E7W6UlNrI3ZTAJmf1HJnw65x";

$api = new Api($api_key, $api_secret);

$order = $api->order->create(array(
  'amount' => 100,
  'currency' => 'INR'
  )
);

$orderID = $order->id;
$orderAmount = $order->amount;
$orderStatus = $order->status;
?>

<script> // pass order details
var orderID = '<?php echo $orderID; ?>';
var orderAmount = '<?php echo $orderAmount; ?>';
var orderStatus = '<?php echo $orderStatus; ?>';
</script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<button id="rzp-button1">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "rzp_live_cY4Rzp82rZKsDq", // Enter the Key ID generated from the Dashboard
    "amount": orderAmount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "FuNinja",
    "description": "Test Transaction",
    "order_id": orderID, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){ // add callback handler here
        alert(response.razorpay_payment_id);
        alert(response.razorpay_order_id);
        alert(response.razorpay_signature)
    },
    "prefill": {
        "name": "Test User",
        "email": "mithuldas@gmail.com",
        "contact": "9972166212"
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#F37254"
    }
};

console.log(options);
var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){
        alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata);
});
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>
