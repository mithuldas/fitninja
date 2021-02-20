<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

use Razorpay\Api\Api;
?>

<?php

FlowControl::startSession();
FlowControl::redirectIfNotLoggedIn();
FlowControl::redirectIfWrongUserType("Trainee");

if(isset($_SESSION['selectedProduct'])){ // unset this so that post_login_landing_controller.php works correctly
  unset($_SESSION['selectedProduct']);
}
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> Confirm Plan - Membership - FuNinja </title>
  <?php
  require ROOT_DIR."/includes/frameworks.php";
  ?>
</head>

<body>
<?php
include ROOT_DIR."/header.php";

// Plan form and product name mappings:
  // 1= Focus
  // 2= Standard
  // 3= Ultra
  // 4= Pair Up

switch ($_GET['product']) {
  case '1':
    $product = new Product("Focus",$conn);
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

  if(isset($_GET['promo']) and $_GET['promo']=="FIRST10"){
    $amount = 100;
  } else {
    $amount = $product->currentPriceINR->amount*100;
  }



$order = $api->order->create(array(
  'amount' => $amount, // x 100 since Razorpay amount seems to be in paisas (wtf?)
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
    <div class="row mt-3">
      <div class="col ">
      <a href="/plans.php"> <small><< Back to Plans</small></a>
    </div>
    </div>
    <div class="row">
      <div class="col pb-4 pt-2">
      <center><h5>Confirm your purchase</h5></center>
    </div>
    </div>

    <div class="row">
      <div class="col-4 ">
        Plan Name
      </div>
      <div class="col-8">
        <?php echo $product->productName;  ?>
      </div>
    </div>
    <div class="row pt-2">
      <div class="col-4 ">
        Price
      </div>
      <div class="col-8">
        <?php echo '₹ '.$product->currentPriceINR->amount; ?>
      </div>
    </div>
    <?php
    if(!isset($_GET['promo'])){
      echo "    <div class='row pt-2 pb-0 mb-0'>
            <div class='col-12 pt-1' >

              <form class='inline' action='confirm_plan.php' method='get'>
                <input type='text' name=promo placeholder='Promotion Code' required> </input>
                <input hidden type='text' name=product  method='get' value=".$_GET['product']."> </input>
                <button type='submit' class='btn btn-sm btn-light'> Apply </button>
              </form>
            </div>
          </div>";
    }

    ?>

    <?php
    if(isset($_GET['promo']) and $_GET['promo']=="FIRST10"){
      echo "    <div class='row pt-2'>
            <div class='col-4 pt-1'>
              Discount
            </div>
            <div class='col-8'>
              -₹ ".($product->currentPriceINR->amount-1)."
            </div>
          </div>
          <div class='row'>
            <div class='col-4 pt-2'>
              Final amount
            </div>
            <div class='col-8 pt-2'>
              ₹ 1
            </div>
          </div>";
    }

    ?>

    <div class="row pt-4 pb-3">
      <div class="col">
        <center><button class="btn btn-primary" id="rzp-button1">Purchase</button></center>
      </div>
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
