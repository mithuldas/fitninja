<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> About - FuNinja </title>
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

<div class="container-fluid breadcrumbContiner">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="margin-bottom: 0px; padding-left:0px; padding-top:0px">
      <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">About FuNinja</li>
    </ol>
  </nav>
</div>

<div class="container">
  <div class="row pt-4 pt-md-4 pt-lg-0 pb-4 pb-md-0">
    <div class="col-md-7 align-self-center mobText order-md-1 order-1">
      <h5 class="subTitle mobCenterDiv pb-2">About Us</h5>
      <p class="normalFont largerFontMob mobCenterDiv"> FuNinja provides 1-on-1 Virtual Personal Training services. Our customers look to us to help them achieve their fitness, well-being and aesthetic goals. Our <a href="/offerings.php">offerings</a> are delivered Live via video conferencing by our trainers whose chief goal in life is to help our customers achieve results. &#x1F600</p>
    </div>
    <div class="col-md-5 order-md-2 order-2" align="center">
      <img src="/images/graphics/Diverse workout routines with text PNG.png" width="65%"> </img>
    </div>
  </div>
  <div class="row">
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
  </div>
  <div class="row">
    <div class="col-md-7 align-self-center mobText order-md-5 order-1 pt-4 pt-md-0 ">
<h5 class="subTitle mobCenterDiv pb-2 ">Why Choose Us</h5>
      <p class="normalFont largerFontMob mobCenterDiv">We combine the skills of top Personal Training talent along with our deep expertise in Virtual Training to help our customers set, meet and exceed their goals by customizing chosen packages with diverse workout formats.</P>
<br>


    </div>
    <div class="col-md-5 order-md-6 order-1" align="center">
      <img src="/images/graphics/Accessible Anywhere with text PNG.png" width="65%"> </img>

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
