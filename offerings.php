
<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> How FuNinja Works </title>
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


<div class="container pb-md-3">


<!-- how it works section -->

  <div class="row pt-md-5 pt-5 pb-3 pb-md-4">
    <div class="col">
      <center><h2 class="subTitle mobNewHeader " style="font-weight: 700">HOW IT WORKS</h2></center>
    </div>
  </div>
  <div class="row pb-4 pb-md-0">
    <div class="col-lg-4 col-12 text-center p-0">

    <?php
          if(!isset($_SESSION['uid'])){
            echo
            '<button type="button" id="registerButton" class="stickyUserMenu" data-toggle="modal" data-target="#exampleModal">
            <img title="Enroll" src="/images/graphics/Enroll with Text PNG.png" width="70%" class="largerHowItWorks"/>
            </button>';
          } else {
            echo
            '<img title="Enroll" src="/images/graphics/Enroll with Text PNG.png" width="70%" class="largerHowItWorks"/>';
          }
      ?>
    </div>
    <div class="col-lg-4 col-12 text-center p-0">
    <a href="/plans.php"><img src="/images/graphics/Pick Membership with text PNG.png" width="70%" class="largerHowItWorks "></a>
    </div>
    <div class="col-lg-4 col-12 text-center p-0">
    <img src="/images/graphics/Get Connected with Text PNG.png" width="70%" class="largerHowItWorks "> </img>
    </div>
  </div>
</div>
  <div class="container-fluid " style="background-color:#fafafa">
    <div class="container pt-5 pt-md-5 pb-md-5">
  <div class="row mb-4 mb-md-5">
    <div class="col-12 text-center p-0 whatYouGetHeader" style="color:gray">
      Your Membership
    </div>
  </div>
  <div class="row ">
    <div class="col-lg-4 mb-4 mb-md-0 col-12 text-center ">
      <p class="miniOfferingHeader subTitle yourMemTitle pb-2">Instructor Led</p>
      Small classes and expert instructors, with flexible timings & formats ranging from Zumba to Yoga.
    </div>
    <div class="col-lg-4 mb-4 mb-md-0 col-12 text-center ">
      <p class="miniOfferingHeader subTitle yourMemTitle pb-2">You'll Eat Right</p>
      Your diet is 80% of your fitness. We will assess and offer routine guidance and diet optimization.
    </div>
    <div class="col-lg-4 mb-4 mb-md-0 col-12 text-center ">
      <p class="miniOfferingHeader subTitle yourMemTitle pb-2">Fitness @Home</p>
      See real results in your health and body without stepping out of your home.
    </div>

  </div>
  <?php  if(!isset($_SESSION['uid'])){ ?>
        <center><a class=" btn btn-lg btn-primary blueButton mainSgnBtn mt-md-5 mb-md-4 hide-on-mobile" href="/plans.php"> LET'S BEGIN </a></center>
      <center><a class=" btn btn-primary blueButton mainSgnBtn mt-md-5 mb-md-4 mt-3 mb-5 hide-on-nonmobile"  href="/plans.php"> LET'S BEGIN </a></center>
      <?php  ;
    } ?>
</div>
</div>



</main>

<script>
// set active link display in the menu bar
$('.offeringsLink').addClass("activeMenuLink");

var buttonWidth=140;
var picRef = $("#picRef");
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
