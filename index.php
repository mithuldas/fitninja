<?php

include "includes/autoloader.php";
require "header.php";

?>




<main>




  <div class="container ">

<!-- get fit section row -->
  <div class="row pt-4 align-items-center pb-4" >
    <div class="col-md-4 col-12 order-md-1 order-2 mobCenterDiv">
      <h2 class="mb-4 mobTopPadding mobHeader">Get Fit. Stay Fit.</h2>
      <p class="mobText">Get into the best shape of your life with FuNinja's elite Online Personal Trainers as they masterfully guide you through fun, engaging and highly customized fitness routines carefully tailored to fit your exact needs.</p>

      <?php
      // if user user isn't logged in, show the login and register buttons
      if(!isset($_SESSION['uid'])){ ?>
        <center><button type="button" class=" btn btn-lg btn-primary bigSignUpButton" data-toggle="modal" data-target="#exampleModal" id ="registerButton"> SIGN UP</button></center>

        <?php  ;
      } ?>
    </div>
    <div class="col-md-8 col-12 order-md-2 order-1" id="womanImg">
      <center><img src="/images/graphics/Illustration SVG.svg" width="80%"> </img></center>
    </div>

  </div>
</div>

<div class="container-fluid p-0">

  <div style="background-color:blue; background: linear-gradient(rgba(255,255,255,.8), rgba(255,255,255,.8)), url(/images/bg1.png); background-size: 100%; box-shadow: 0 0 8px 8px white inset;">
<!-- short form of offerings row -->
<div class="container">

<div class="row pt-5 align-items-center" data-offset-top="200">
  <div class="col-3 text-right p-0 textMobileNormal ">
  <b class="miniOfferingHeader">Yoga</b><br>
  Peace. Balance. Agility.
  </div>
  <div class="col-3 text-center p-0">
    <img src="/images/graphics/Yoga SVG.svg" width="60%"> </img><br>

  </div>
  <div class="col-3 text-center p-0 ">
    <img src="/images/graphics/Aerobics SVG.svg" width="60%"> </img><br>
  </div>
  <div class="col-3 text-left p-0 textMobileNormal">
    <b class="miniOfferingHeader">Aerobics</b><br>
    Strength. Cardio. Variation.
  </div>
</div>
<div class="row align-items-center pb-5" >
  <div class="col-3 text-right p-0 textMobileNormal">
    <b class="miniOfferingHeader">Slimnastics</b><br>
    Conditioning. Toning. Lean.
  </div>
  <div class="col-3 text-center p-0">
    <img src="/images/graphics/Push up SVG.svg" width="60%"> </img><br>
  </div>
  <div class="col-3 text-center p-0">
    <img src="/images/graphics/Zumba SVG.svg" width="60%"> </img><br>
  </div>
  <div class="col-3 text-left p-0 textMobileNormal">
  <b class="miniOfferingHeader">Zumba</b><br>
  Dance. Flexibility. Fun.
  </div>
</div>
</div>
</div>
</div>

<div class="container">

<!-- know more separator button -->
<div class="row align-items-center pt-4 pb-4">
  <div class="col text-center">
    <a href="offerings.php" class="btn  bigSignUpButton btn-lg userdropdown">LEARN MORE </a>
  </div>

</div>

<!-- how it works section -->

  <div class="row mt-2 pt-4 pb-4">
    <div class="col">
      <center><h2>How It Works</h2></center>
    </div>
  </div>
  <div class="row pb-4">
    <div class="col-lg-4 col-6 text-center">
    <img src="/images/graphics/Enroll with Text PNG.png" width="60%" class="largerHowItWorks"> </img>
    </div>
    <div class="col-lg-4 col-6 text-center">
    <img src="/images/graphics/Pick Membership with text PNG.png" width="60%" class="largerHowItWorks">
    </div>
    <div class="col-lg-4 col-6 text-center">
    <img src="/images/graphics/Get Connected with Text PNG.png" width="60%" class="largerHowItWorks"> </img>
    </div>
    <div class="col-lg-4 col-6 text-center">
    <img src="/images/graphics/Customise with text PNG.png" width="60%" class="largerHowItWorks"> </img>
    </div>
    <div class="col-lg-4 col-6 text-center">
    <img src="/images/graphics/Get Started with text PNG.png" width="60%" class="largerHowItWorks"> </img>
    </div>
    <div class="col-lg-4 col-6 text-center">
    <img src="/images/graphics/Feedback with text PNG.png" width="60%" class="largerHowItWorks"> </img>
    </div>

  </div>


</div>

</main>
<script>
// add class to body tag so that white background can be set

$("body").addClass("whiteBackground");

</script>


<!--
<img src="/images/Icons/Enroll/Enroll with Text PNG.png" width="100%"> </img>
<img src="/images/Icons/Pick Membership/Pick Membership with text PNG.png" width="100%">  </img>
<img src="/images/Icons/Get Connected/Get Connected with Text PNG.png" width="100%"> </img>-->

<?php
  require "footer.php";
?>
