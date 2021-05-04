<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> About FuNinja </title>
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

<div class="container pt-4">
  <div class="row pt-4 pt-md-4 pt-lg-0 pb-4 pb-md-0">
    <div class="col-md-7 align-self-center mobText order-md-1 order-1">
      <h5 class="subTitle mobCenterDiv pb-2">About Us</h5><br>
      <p class="normalFont largerFontMob mobCenterDiv"> FuNinja offers end to end services for those seeking to get stronger, fitter and healthier. All our <a href="/offerings.php"><b> offerings</b></a> are rendered online.</p>
    </div>
    <div class="col-md-5 order-md-2 order-2" align="center">
      <img src="/images/graphics/Diverse workout routines with text PNG.png" width="65%"> </img>
    </div>
  </div>
    <!--<div class="row">
    <div class="col-md-5 order-md-3 order-4 mobCenterDiv">
      <img src="/images/graphics/Top Tier Trainers with Text PNG.png" width="65%"> </img>

    </div>
  <div class="col-md-7 align-self-center mobText order-md-4 order-3">
      <h5 class="subTitle mobCenterDiv pb-2">Our Philosophy</h5>
      <p class="normalFont largerFontMob mobCenterDiv">


"One size fits all" group workout sessions make it very hard for trainers to give the time and attention needed by their trainees to see real results.
 At FuNinja, we believe we've solved this by coming up with offerings that cater to individuals instead of groups.
 </p>


</div>
  </div>-->
  <div class="row">
    <div class="col-md-5 order-md-5 order-2" align="center">
      <img src="/images/graphics/Accessible Anywhere with text PNG.png" width="65%"> </img>

    </div>
    <div class="col-md-7 align-self-center mobText order-md-6 order-1 pt-4 pt-md-0 ">
      <p class="normalFont largerFontMob mobCenterDiv">Our experienced trainers and skilled nutritionists help our customers set and exceed their goals by optimizing diets and motivating through live, guided workout sessions.</P>


    </div>
  </div>

</div>

<?php
  require "footer.php";
?>

<script>
// set active link display in the menu bar
$('.aboutLink').addClass("activeMenuLink");


</script>
