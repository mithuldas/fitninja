<?php
require_once __DIR__.'/../config.php';

require_once ROOT_DIR.'/vendor/autoload.php';
require_once ROOT_DIR.'/includes/autoloader.php';
require_once ROOT_DIR.'/includes/dbh.php';

use Razorpay\Api\Api;

$paymentGatewayResponse = json_decode($_POST['paymentGatewayResponse']);
$uid = json_decode($_POST['uid']);
$trainee = new Trainee($uid, $conn);

// perform some checks with gateway API to make sure that payment has been captured

$api_key="rzp_live_cY4Rzp82rZKsDq";
$api_secret="E7W6UlNrI3ZTAJmf1HJnw65x";

$api = new Api($api_key, $api_secret);

$payment = $api->payment->fetch($paymentGatewayResponse->razorpay_payment_id);

if($payment->status!="captured"){
  echo "payment not captured";
  exit();
}

$externalPaymentID=$payment->id;
$externalOrderID=$payment->order_id;
$externalPaymentMethod=$payment->method;

// checks above pass - insert payment details into DB

$sql = "insert into transactions (order_id, type_id, external_id, method, date) values ((select id from orders where external_id=?), (select id from transaction_types where type='payment'), ?, ?, (select sysdate() from dual))";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "sss", $externalOrderID, $externalPaymentID, $externalPaymentMethod);

mysqli_stmt_execute($stmt);
if(mysqli_stmt_affected_rows($stmt)<1){
  echo "payment success, but sqlerror";
  exit();
}

if($trainee->addProduct($externalPaymentID, $conn)){
  echo "1";
} else {
  echo "0";
}


// if everything above executes successfully, return success response to confirm_plan.php AJAX function
// confim_plan.php will then direct user to the trainee dashboard
