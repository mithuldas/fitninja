Order Summary


<br>
Product details
<br>
original price marked off with new price
<br><br>

<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

require_once ( ROOT_DIR.'/header.php' );

use Razorpay\Api\Api;

if(!isset($_SESSION)){
  session_start();
}

if(!isset($_SESSION['uid'])){
  header("Location: index.php?notLoggedIn");
  exit();
}

if($_SESSION['userType']!="Trainee"){
  header("Location: includes/post_login_landing_controller.php");
  exit();
}

// Plan form and product name mappings:
  // plan1= Basic
  // plan2= Standard
  // plan3= All Access
  // plan4= Couple

switch ($_POST['planChoice']) {
  case 'plan1':
    echo "You chose the Basic plan";
    $product = new Product("Basic",$conn);
    break;
  case 'plan2':
    echo "You chose the Standard plan";
    $product = new Product("Standard",$conn);
    break;
  case 'plan3':
    echo "You chose the All Access plan";
    $product = new Product("All Access",$conn);
    break;
  case 'plan4':
    echo "You chose the Couple plan";
    $product = new Product("Couple",$conn);
    break;
}

echo "<BR><BR>Price: ₹".$product->currentPriceINR->amount;



$api_key="rzp_live_cY4Rzp82rZKsDq";
$api_secret="E7W6UlNrI3ZTAJmf1HJnw65x";

$api = new Api($api_key, $api_secret);

$order = $api->order->create(array(
  'amount' => $product->currentPriceINR->amount*100, // x 100 since Razorpay amount seems to be in paisas (wtf?)
  'currency' => 'INR'
  )
);

$orderID = $order->id;
$orderAmount = ($order->amount);
$orderStatus = $order->status;

if($orderStatus=="created"){
  $trainee = new Trainee($_SESSION['uid'], $conn);
  $trainee->addNewOrder($product->currentPriceINR->id, $orderID, $conn);
}

?>

<script> // pass order and details
var orderID = '<?php echo $orderID; ?>';
var orderAmount = '<?php echo $orderAmount; ?>';
var orderStatus = '<?php echo $orderStatus; ?>';
var uid = '<?php echo $trainee->uid; ?>';
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
    "description": "Purchase <?php echo $product->productName; ?>",
    "order_id": orderID, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){ // add callback handler here (AJAX)
      paymentGatewayResponse=response.razorpay_payment_id;
      $.ajax({
        url: '/includes/add_product.php',
        type: 'post',
        data: {
          'uid' : uid,
          'paymentGatewayResponse' : JSON.stringify(response),
        },
        timeout:5000, //5 second timeout
        error: function(xmlhttprequest, textstatus, message){
          if(textstatus==="timeout"){
            $("#errorMsg").text("The server didn't respond. Try clicking submit again...");
          }
        },
        success: function(response){
          if(response==1){
            window.location.href = "/payment_confirmation.php?gatewayResponse="+paymentGatewayResponse;
          }
        }
      });


    },
    "prefill": {
        "name": "<?php echo $trainee->fullName; ?>",
        "email": "<?php echo $trainee->email; ?>",
        "contact": "<?php echo $trainee->phoneNumber; ?>"
    },
  //  "notes": {
    //    "address": "Razorpay Corporate Office"
    //},
    "theme": {
        "color": "#F37254"
    }
};

var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){
        alert(response);
});
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>
