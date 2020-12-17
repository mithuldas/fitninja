<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

require_once ( ROOT_DIR.'/header.php' );

FlowControl::startSession();
FlowControl::redirectIfNotLoggedIn();
FlowControl::redirectIfWrongUserType("Trainee");

require "header.php";

  $userProductId=getUserProduct($conn);
  $userProduct = new UserProduct($userProductId, $conn);
  $product = new Product($userProduct->productName, $conn);

  $productValidFrom = date('d M Y', strtotime($userProduct->validFrom));
  $productValidTo = date('d M Y', strtotime($userProduct->validTo));

  function getUserProduct($conn){
    $extTransId=$_GET['gatewayResponse'];
    $sql="select up.id from transactions t, orders o, user_products up
          where t.order_id=o.id and up.order_id=o.id and t.external_id='$extTransId'";

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) {
      return $row['id'];
    }
  }



?>

<div class="container">
  <div class="row pt-3">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6 orderConfirmationContainer greyBorder ml-3 mr-3 userdropdown">
    <div class="row mt-1">
      <div class="col ">
    </div>
    </div>
    <div class="row">
      <div class="col mt-3 pb-4">
      <center><h5>YOUR ORDER IS CONFIRMED!</h5></center>
    </div>
    </div>

    <div class="row">
      <div class="col-4 tableTitle">
        Transaction
      </div>
      <div class="col-8">
        <?php echo $_GET['gatewayResponse'];
              echo "<BR>".$userProduct->validFrom;
        ?>
      </div>
    </div>
    <div class="row">
      <div class="col-4 tableTitle">
        Amount
      </div>
      <div class="col-8">
        <?php echo '₹ '.$product->currentPriceINR->amount;  ?>
      </div>
    </div>
    <div class="row">
      <div class="col-4 tableTitle">
        Plan Activated
      </div>
      <div class="col-8">
        <?php echo $product->productName;  ?>
      </div>
    </div>
    <div class="row pb-4">
      <div class="col-4 tableTitle">
        Validity
      </div>
      <div class="col-8">
        <?php echo $productValidFrom. ' to ' .$productValidTo;  ?>
      </div>
    </div>

    <div class="row pt-2 pb-3">
      <div class="col">
        <small> An e-mail has been sent to you with payment confirmation details. </small>
          <center><a href="trainee_dashboard.php" class="btn btn-primary mt-3">Continue</a></center>
      </div>
    </div>
    <div class="col-lg-3">
    </div>
    </div>

  </div>
</div>
