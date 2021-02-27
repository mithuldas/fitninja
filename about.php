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
      <h5 class="mobileTitle mobCenterDiv">About Us</h5>
      <p class="mobCenterDiv"> FuNinja is a premium 1-on-1 Virtual Personal Training service provider. Our customers rely on us to help them meet and exceed their fitness, well-being and aesthetic goals. Our <a href="/offerings.php">Offerings</a> are conducted Live via the latest in video conferencing technology by Trainers who are passionate about their craft, and who are firmly set on their mission to help customers achieve results.</p>
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
      <h5 class="mobileTitle mobCenterDiv">Our Philosophy</h5>
      <p class="mobCenterDiv">


We believe that "one size fits all" group workout formats limit trainers from providing the care and attention that each individual needs to quickly and effectively achieve results.
 At FuNinja, we try to solve for this by coming up with engaging and effective offerings that cater to individual needs.
 </p>


    </div>
  </div>
  <div class="row">
    <div class="col-md-7 align-self-center mobText order-md-5 order-1 pt-4 pt-md-0 ">
<h5 class="mobileTitle mobCenterDiv">Why Choose Us</h5>
      <p class="mobCenterDiv">We combine the skills of top Personal Training talent along with our deep expertise in Virtual Training to help our customers set, meet and exceed their goals by customizing chosen packages with diverse workout formats. Let's face it, exercise is mostly a boring affair. We seek to change that.</P>
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
