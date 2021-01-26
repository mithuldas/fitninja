
<?php
include "includes/autoloader.php";
require "header.php";
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
  <div class"row ">
    <div class"col ">
      <center><h5 class="mobileTitle mobCenterDiv mt-3 mt-md-4">Who we are and what we stand for</h5></center>
At FuNinja, we strive to provide premium online personal training services.

    </div>
  </div>
  <div class"row ">
    <div class"col ">

      <center><h5 class="mobileTitle mobCenterDiv mt-3 mt-md-4">Our Strengths</h5></center>
    </div>
  </div>

  <!-- USP / product highlights section -->

  <div class="row pt-5">
    <div class="col-lg-4 col-6 text-center">
    <img src="/images/graphics/Customized plans with text PNG.png" width="60%"> </img>

    </div>
    <div class="col-lg-4 col-6 text-center">
    <img src="/images/graphics/Flexible Schedule with text PNG.png" width="60%">
    </div>
    <div class="col-lg-4 col-6 text-center">
    <img src="/images/graphics/Feedback Loop with text PNG.png" width="60%"> </img>
    </div>
    <div class="col-lg-4 col-6 text-center">
    <img src="/images/graphics/Top Tier Trainers with Text PNG.png" width="60%"> </img>
    </div>
    <div class="col-lg-4 col-6 text-center">
    <img src="/images/graphics/Accessible Anywhere with text PNG.png" width="60%"> </img>
    </div>
    <div class="col-lg-4 col-6 text-center">
    <img src="/images/graphics/Diverse workout routines with text PNG.png" width="60%"> </img>
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
