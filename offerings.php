
<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> Offerings and Workout Formats - FuNinja </title>
  <?php
  require ROOT_DIR."/includes/frameworks.php";
  ?>
</head>

<body>
<?php
include ROOT_DIR."/header.php";
?>

<script>
// add class to body tag so that white background can be set

$("body").addClass("whiteBackground");

</script>


<main>


<div class="container-fluid breadcrumbContiner">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="margin-bottom: 0px; padding-left:0px; padding-top:0px">
      <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Offerings</li>
    </ol>
  </nav>
</div>
  <div class="container ">


	<div class"row ">
    <div class"col ">

      <h5 class="mobileTitle mobCenterDiv mt-3 mt-md-4">Explore the various Workout Formats being offered below and find a <a href="/plans.php">membership plan</a> that works for you and your family.</h5>

      <?php
      // if user user isn't logged in, show the login and register buttons
      if(!isset($_SESSION['uid'])){ ?>
        <center><button type="button" class=" btn btn-lg btn-primary mb-4 bigSignUpButton offeringsTrialButton  hide-on-mobile" data-toggle="modal" data-target="#exampleModal" id ="registerButton1"> FREE TRIAL </button></center>
        <center><button type="button" class=" btn btn-primary mt-3 bigSignUpButton  hide-on-nonmobile" data-toggle="modal" data-target="#exampleModal" id ="registerButton2"> FREE TRIAL </button></center>
        <?php  ;
      } ?>
    </div>
  </div>


    <!-- Detailed offerings section -->
    <div class="row justify-content-center mb-3 mb-md-4 mt-4 mt-md-5">
      <div class="col-4 col-md-4 align-self-center text-center">
      <img class="offeringsPic picRef" id="picRef" src="/images/graphics/Yoga SVG.svg" width="50%"> </img>
      </div>
      <div class="col-8 col-md-4 align-self-center textMobileNormal ">
      <b class="miniOfferingHeader">Yoga</b><br>
      Build your foundation to a disciplined and healthy balanced life by training with our expert yoga trainers who will guide you through the training and offer customized training schedules to suit your fitness levels and needs.
      </div>
    </div>
    <div class="row justify-content-center mb-3 mb-md-4">
      <div class="col-4 col-md-4 text-center">
      <img class="offeringsPic" src="/images/graphics/Aerobics SVG.svg" width="50%"> </img>
      </div>
      <div class="col-8 col-md-4 align-self-center textMobileNormal" >
        <b class="miniOfferingHeader">Aerobics</b><br>
      Pump up your heart rate with the varied customized aerobic routines strengthening your muscles and seeing fitness levels increase as you work through the routines designed
      </div>
    </div>
    <div class="row justify-content-center mb-3 mb-md-4">
      <div class="col-4 col-md-4 align-self-center text-center">
      <img class="offeringsPic pt-4" src="/images/graphics/Push up_PNG.png" width="50%"> </img>
      </div>
      <div class="col-8 col-md-4 align-self-center textMobileNormal">
        <b class="miniOfferingHeader">Slimnastics</b><br>
      Condition , tone and work on getting lean as our trainers work to create workouts that are suited to your body type and fitness levels
      </div>
    </div>
    <div class="row justify-content-center pb-3 pb-md-4">
      <div class="col-4 col-md-4 text-center">
      <img class="offeringsPic" src="/images/graphics/Zumba SVG.svg" width="50%"> </img>
      </div>
      <div class="col-8 col-md-4 align-self-center textMobileNormal">
        <b class="miniOfferingHeader">Zumba</b><br>
      Have fun and up your fitness levels with the varied zumba routines that work to condition and tone the muscles in sessions that get your heart beat racing.
      </div>
    </div>




</div>

</main>

<script>
// set active link display in the menu bar
$('.offeringsLink').addClass("activeMenuLink");

var buttonWidth=140;
var picRef = $("#picRef");
console.log(buttonWidth);
var leftOffset = picRef.offset().left;
//var visibleHeight = window.innerHeight;
//var visibleWidth = window.innerWidth;
//var topPosition = (visibleHeight-modalHeight)/3;
var sidePosition = (leftOffset -buttonWidth)/2;
//var x= document.getElementsByClassName('modal-content');
$("#registerButton1").css({"left":sidePosition});

</script>



<?php
  require "footer.php";
?>
