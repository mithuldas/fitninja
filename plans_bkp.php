<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
FlowControl::redirectIfWrongUserType("Trainee");
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> Plans - Membership - FuNinja </title>
  <?php
  require ROOT_DIR."/includes/frameworks.php";
  ?>
</head>

<body>
<?php
include ROOT_DIR."/header.php";
?>

<?php

$product1 = new Product("Focus",$conn);
$product2 = new Product("Standard",$conn);
$product3 = new Product("Ultra",$conn);
$product4 = new Product("Pair Up",$conn);

?>

<script>
// add class to body tag so that white background can be set

$("body").addClass("whiteBackground");

</script>

<div class="container pt-2 pt-md-3">

<p class="pt-2"> STEP <b>1</b> OF <b>2</b></p>
<h5 class="pb-3 pb-md-4"> Choose the plan that’s right for you </h5>

  <div class="row pb-3 sticky">
  <div class="col-3 hide-on-mobile">
  </div class="col">
  <div class="col centerButton">
  <button id="prod1Button" class="btn btn-primary blueButton planHeaderButton prod1Button"><?php echo $product1->productName; ?></button>
  </div class="col">
  <div class="col centerButton">
    <button class="btn btn-primary blueButton planHeaderButton prod2Button"><?php echo $product2->productName; ?></button>
  </div class="col">
  <div class="col centerButton">
    <button class="btn btn-primary blueButton planHeaderButton prod3Button"><?php echo $product3->productName; ?></button>
  </div class="col">
  <div class="col centerButton">
    <button class="btn btn-primary blueButton planHeaderButton prod4Button"><?php echo $product4->productName; ?></button>
  </div class="col">
  </div class = "row">



<div class="row hide-on-nonmobile plansMobileHeader pt-2">
<div class="col" align="center">
<center style="display:inline-block; margin-right:5px">Workout Formats</center> <i style="display:inline-block" class="far fa-question-circle infoButton" data-toggle="tooltip" data-html="true" title="Know more about the exciting Workout Formats you can choose from by heading over to our <a href='offerings.php' class='lightgreyfont'> Offerings</a> page"></i>
</div class="col">
</div class="row">
<div class="row pt-3 pb-3 borderbottom">
<div class="col-3 hide-on-mobile" > Workout Formats <i style="margin-left:5px" class="far fa-question-circle infoButton" data-toggle="tooltip" data-html="true" title="Know more about the exciting Workout Formats you can choose from by heading over to our <a href='offerings.php' class='lightgreyfont'> Offerings</a> page"></i>
</div class="col">
<div class="col prod1 plansMobileContent"> Any 1
</div class="col">
<div class="col prod2 plansMobileContent"> Any 2
</div class="col">
<div class="col prod3 plansMobileContent"> All
</div class="col">
<div class="col prod4 plansMobileContent"> All
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile plansMobileHeader pt-2">
<div class="col">
<center>Number of Trainees</center>
</div class="col">
</div class="row">
<div class="row pt-3 pb-3 borderbottom">
<div class="col-3 hide-on-mobile"> Number of Trainees
</div class="col">
<div class="col prod1 plansMobileContent"> 1
</div class="col">
<div class="col prod2 plansMobileContent"> 1
</div class="col">
<div class="col prod3 plansMobileContent"> 1
</div class="col">
<div class="col prod4 plansMobileContent"> 2
</div class="col">
</div class = "row">

<div class="row hide-on-nonmobile plansMobileHeader pt-2">
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


<div class="row hide-on-nonmobile plansMobileHeader pt-2">
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

<div class="row hide-on-nonmobile plansMobileHeader pt-2">
<div class="col" align="center">
<center style="display:inline-block; margin-right:5px">Dedicated Personal Trainers</center> <i style="display:inline-block" class="far fa-question-circle infoButton" data-toggle="tooltip" data-html="true" title="Depending upon the package you choose, up to a total of 4 FuNinja Personal Trainers will be assigned to you, 1 for each chosen Workout Format!"></i>
</div class="col">
</div class="row">
<div class="row pt-3 pb-3 borderbottom">
<div class="col-3 hide-on-mobile" > Dedicated Personal Trainers <i style="margin-left:5px" class="far fa-question-circle infoButton" data-toggle="tooltip" data-html="true" title="Depending upon the package you choose, up to a total of 4 FuNinja Personal Trainers will be assigned to you, 1 for each chosen Workout Format!"></i>
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

<div class="row hide-on-nonmobile plansMobileHeader pt-2">
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

<div class="row hide-on-nonmobile plansMobileHeader pt-2">
<div class="col">
<center>Monthly Price</center>
</div class="col">
</div class="row">
<div class="row pt-3 mb-2">
<div class="col-3 hide-on-mobile">Monthly Price
</div class="col">
<div class="col prod1 plansMobileContent"> <strike>₹ 12,000 </strike> <br> <small><?php echo "₹ ".substr($product1->currentPriceINR->amount, 0,1).','.substr($product1->currentPriceINR->amount, 1,4); ?></small>
</div class="col">
<div class="col prod2 plansMobileContent"> <strike>₹ 14,000 </strike> <br><small><?php echo "₹ ".substr($product2->currentPriceINR->amount, 0,2).','.substr($product1->currentPriceINR->amount, 1,5); ?></small>
</div class="col">
<div class="col prod3 plansMobileContent"> <strike>₹ 16,000 </strike> <br><small><?php echo "₹ ".substr($product3->currentPriceINR->amount, 0,2).','.substr($product1->currentPriceINR->amount, 1,5); ?></small>
</div class="col">
<div class="col prod4 plansMobileContent"> <strike>₹ 18,000 </strike> <br><small><?php echo "₹ ".substr($product4->currentPriceINR->amount, 0,2).','.substr($product1->currentPriceINR->amount, 1,5); ?></small>
</div class="col">
</div class = "row">

<div class="row">
<div class="col"> <center><button class="btn btn-primary mt-4 mb-4 continueBtn blueButton" id ="continueBtn"> Next </button></center>
</div class="col">
</div class = "row">
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

  $.ajax({
    url: 'includes/plan_select.php',

    type: 'post',
    data: {
      'product' : selectedProduct,
    },
    timeout:5000, //5 second timeout
    error: function(xmlhttprequest, textstatus, message){
      if(textstatus==="timeout"){
        //do nothing?
      }

    },
    success: function(response){
      if(response=="loggedIn"){
        window.location.href = '/confirm_plan.php?'+'product='+selectedProduct;
      } else if(response=="notLoggedIn"){
        $("#registerButton").click();
      }
    }
  });

});

</script>

<script>
$(document).ready(function(){
  //$('[data-toggle="tooltip"]').tooltip();
  $('.infoButton').tooltip({delay: {show: 0, hide: 1000}});

});
</script>

<script>
// set active link display in the menu bar
$('.membershipLink').addClass("activeMenuLink");
</script>
