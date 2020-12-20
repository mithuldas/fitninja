<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

FlowControl::startSession();

?>

<?php
require "header.php";

$product1 = new Product("Basic",$conn);
$product2 = new Product("Ignite",$conn);
$product3 = new Product("Level Up",$conn);
$product4 = new Product("Duo Ninja",$conn);

?>

<div class="container">

<p class="pt-2"> STEP <b>1</b> OF <b>2</b></p>
<h5 class="pb-2"> Choose the plan that’s right for you </h5>

  <div class="row pb-3" id="headerDiv">
  <div class="col-3 hide-on-mobile">
  </div class="col">
  <div class="col centerButton">
  <button class="btn btn-primary planHeaderButton prod1Button"><?php echo $product1->productName; ?></button>
  </div class="col">
  <div class="col centerButton">
    <button class="btn btn-primary planHeaderButton prod2Button"><?php echo $product2->productName; ?></button>
  </div class="col">
  <div class="col centerButton">
    <button class="btn btn-primary planHeaderButton prod3Button"><?php echo $product3->productName; ?></button>
  </div class="col">
  <div class="col centerButton">
    <button class="btn btn-primary planHeaderButton prod4Button"><?php echo $product4->productName; ?></button>
  </div class="col">
  </div class = "row">



<div class="row hide-on-nonmobile plansMobileHeader ">
<div class="col">
<center>Fitness Routines</center>
</div class="col">
</div class="row">
<div class="row pt-1 pb-3 borderbottom">
<div class="col-3 hide-on-mobile"> Fitness Routines
</div class="col">
<div class="col prod1 plansMobileContent"> Any 1
</div class="col">
<div class="col prod2 plansMobileContent"> Any 2
</div class="col">
<div class="col prod3 plansMobileContent"> All Access
</div class="col">
<div class="col prod4 plansMobileContent"> All Access
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile plansMobileHeader">
<div class="col">
<center>Number of sessions per month</center>
</div class="col">
</div class="row">
<div class="row pt-3 pb-3 borderbottom">
<div class="col-3 hide-on-mobile"> Number of sessions per month
</div class="col">
<div class="col prod1 plansMobileContent"> 20
</div class="col">
<div class="col prod2 plansMobileContent"> 20
</div class="col">
<div class="col prod3 plansMobileContent"> 20
</div class="col">
<div class="col prod4 plansMobileContent"> 20
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile plansMobileHeader">
<div class="col">
<center>Dedicated Fitness Manager</center>
</div class="col">
</div class="row">
<div class="row pt-3 pb-3 borderbottom">
<div class="col-3 hide-on-mobile"> Dedicated Fitness Manager
</div class="col">
<div class="col prod1 plansMobileContent"> ✓
</div class="col">
<div class="col prod2 plansMobileContent"> ✓
</div class="col">
<div class="col prod3 plansMobileContent"> ✓
</div class="col">
<div class="col prod4 plansMobileContent"> ✓
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile plansMobileHeader">
<div class="col">
<center>Sessions with Fitness Manager</center>
</div class="col">
</div class="row">
<div class="row pt-3 pb-3 borderbottom">
<div class="col-3 hide-on-mobile"> Sessions with Fitness Manager
</div class="col">
<div class="col prod1 plansMobileContent"> 1/week
</div class="col">
<div class="col prod2 plansMobileContent"> 2/week
</div class="col">
<div class="col prod3 plansMobileContent"> On-Demand
</div class="col">
<div class="col prod4 plansMobileContent"> On-Demand
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile plansMobileHeader">
<div class="col">
<center>Customised Fitness Plans</center>
</div class="col">
</div class="row">
<div class="row pt-3 pb-3 borderbottom">
<div class="col-3 hide-on-mobile"> Customised Fitness Plans
</div class="col">
<div class="col prod1 plansMobileContent"> ✓
</div class="col">
<div class="col prod2 plansMobileContent"> ✓
</div class="col">
<div class="col prod3 plansMobileContent"> ✓
</div class="col">
<div class="col prod4 plansMobileContent"> ✓
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile plansMobileHeader">
<div class="col">
<center>Dedicated Personal Trainer</center>
</div class="col">
</div class="row">
<div class="row pt-3 pb-3 borderbottom">
<div class="col-3 hide-on-mobile"> Dedicated Personal Trainer
</div class="col">
<div class="col prod1 plansMobileContent"> ✓
</div class="col">
<div class="col prod2 plansMobileContent"> ✓
</div class="col">
<div class="col prod3 plansMobileContent"> ✓
</div class="col">
<div class="col prod4 plansMobileContent"> ✓
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile plansMobileHeader">
<div class="col">
<center>Flexible Scheduling</center>
</div class="col">
</div class="row">
<div class="row pt-3 pb-3 borderbottom">
<div class="col-3 hide-on-mobile"> Flexible Scheduling
</div class="col">
<div class="col prod1 plansMobileContent"> ✓
</div class="col">
<div class="col prod2 plansMobileContent"> ✓
</div class="col">
<div class="col prod3 plansMobileContent"> ✓
</div class="col">
<div class="col prod4 plansMobileContent"> ✓
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile plansMobileHeader">
<div class="col">
<center>Monthly Price</center>
</div class="col">
</div class="row">
<div class="row mt-2 mb-2">
<div class="col-3 hide-on-mobile">Monthly Price
</div class="col">
<div class="col prod1 plansMobileContent"> <?php echo "₹ ".$product1->currentPriceINR->amount; ?>
</div class="col">
<div class="col prod2 plansMobileContent"> <?php echo "₹ ".$product2->currentPriceINR->amount; ?>
</div class="col">
<div class="col prod3 plansMobileContent"> <?php echo "₹ ".$product3->currentPriceINR->amount; ?>
</div class="col">
<div class="col prod4 plansMobileContent"> <?php echo "₹ ".$product4->currentPriceINR->amount; ?>
</div class="col">
</div class = "row">

<div class="row">
<div class="col"> <center><button class="btn btn-primary btn mt-3 mb-2 continueBtn" id ="continueBtn"> Continue </button></center>
</div class="col">
</div class = "row">

hi<br>
hi<br>
hi<br>
hi<br>
hi<br>
hi<br>
hi<br>
hi<br>
hi<br>
</div>


<?php
  require "footer.php";
?>

<script>

var selectedProduct = 4;

$(".prod1,.prod2,.prod3,.prod4").addClass("greyfont");
$(".prod4").addClass("purpleFont");
$(".prod4Button").addClass("activeOpacity");

$(".prod1, .prod1Button").on("click", function(){
  selectedProduct = 1;
  $(".prod2,.prod3,.prod4").removeClass("purpleFont");
  $(".prod1").addClass("purpleFont plansSmallFont");
  $(".prod2Button,.prod3Button,.prod4Button").removeClass("activeOpacity");
  $(".prod1Button").addClass("activeOpacity");
});

$(".prod2, .prod2Button").on("click", function(){
  selectedProduct = 2;
  $(".prod1,.prod3,.prod4").removeClass("purpleFont");
  $(".prod2").addClass("purpleFont");
  $(".prod1Button,.prod3Button,.prod4Button").removeClass("activeOpacity");
  $(".prod2Button").addClass("activeOpacity");
});

$(".prod3, .prod3Button").on("click", function(){
  selectedProduct = 3;
  $(".prod1,.prod2,.prod4").removeClass("purpleFont");
  $(".prod3").addClass("purpleFont");
  $(".prod1Button,.prod2Button,.prod4Button").removeClass("activeOpacity");
  $(".prod3Button").addClass("activeOpacity");
});

$(".prod4, .prod4Button").on("click", function(){
  selectedProduct = 4;

  $(".prod1,.prod2,.prod3").removeClass("purpleFont");
  $(".prod4").addClass("purpleFont");
  $(".prod1Button,.prod2Button,.prod3Button").removeClass("activeOpacity");
  $(".prod4Button").addClass("activeOpacity");
});

$("#continueBtn").on("click", function(){
  window.location.href = '/confirm_plan.php?'+'product='+selectedProduct;
});

$(window).scroll(function(){
    if ($(this).scrollTop() > 100) {
        $('#headerDiv').addClass('fixed');
    } else {
        $('#headerDiv').removeClass('fixed');
    }
});
</script>
