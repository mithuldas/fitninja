<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

require_once ( ROOT_DIR.'/header.php' );

use Razorpay\Api\Api;

FlowControl::startSession();
FlowControl::redirectIfNotLoggedIn();
FlowControl::redirectIfWrongUserType("Trainee");

if(isset($_SESSION['selectedProduct'])){ // unset this so that post_login_landing_controller.php works correctly
  unset($_SESSION['selectedProduct']);
}

// Plan form and product name mappings:
  // 1= Basic
  // 2= Ignite
  // 3= Level Up
  // 4= Duo Ninja

switch ($_GET['product']) {
  case '1':
    $product = new Product("Basic",$conn);
    break;
  case '2':
    $product = new Product("Standard",$conn);
    break;
  case '3':
    $product = new Product("Ultra",$conn);
    break;
  case '4':
    $product = new Product("Pair Up",$conn);
    break;
}


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

<div class="container">
  <div class="row pt-3">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6 orderConfirmationContainer greyBorder ml-3 mr-3 userdropdown">
    <div class="row mt-1">
      <div class="col ">
      <a href="/plans.php"> <small><< Back to Plans</small></a>
    </div>
    </div>
    <div class="row">
      <div class="col pb-4">
      <center><h5>Confirm Your Order To Proceed</h5></center>
    </div>
    </div>

    <div class="row">
      <div class="col-2 tableTitle">
        Plan
      </div>
      <div class="col-10">
        <?php echo $product->productName;  ?>
      </div>
    </div>
    <div class="row pb-4">
      <div class="col-2 tableTitle">
        Amount
      </div>
      <div class="col-10">
        <?php echo '₹ '.$product->currentPriceINR->amount; ?>
      </div>
    </div>
    <div class="row pt-3 pb-3">
      <div class="col">
          <center><button class="btn btn-primary" id="rzp-button1">Purchase</button></center>
      </div>
    </div>
    <div class="col-lg-3">
    </div>
    </div>

  </div>
</div>




<script> // pass order and details
var orderID = '<?php echo $orderID; ?>';
var orderAmount = '<?php echo $orderAmount; ?>';
var orderStatus = '<?php echo $orderStatus; ?>';
var uid = '<?php echo $trainee->uid; ?>';
</script>
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
