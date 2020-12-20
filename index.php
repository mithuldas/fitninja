

<?php

include "includes/autoloader.php";
?>

<?php
  if(isset($_GET['status'])){
    if($_GET['status']=='verification-sent'){
        ?>
        <div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          We've sent you an email to make sure that you own the email account. Please click the link in it to login!
        </div>
        <?php
    }
  }
?>

<?php
  require "header.php";
?>

<script>
// add indexPage class to body tag so that white background can be set

$("body").addClass("indexPage");

</script>


<main>




  <div class="container ">

<!-- get fit section row -->
  <div class="row pt-4 align-items-center" >
    <div class="col-md-4 col-6">
      <h2 class="mb-4">Get Fit</h2>
      Elite personal training tailored to your individual needs, wherever and whenever you need. Enjoy the benefits of personalized workouts with the best trainers via live zoom sessions.
    </div>
    <div class="col-md-8 col-6">
      <center><img src="/images/graphics/Illustration SVG.svg" width="80%"> </img></center>
    </div>
  </div>

<!-- short form of offerings row -->

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
<div class="row align-items-center" >
  <div class="col-3 text-right p-0 textMobileNormal">
    <b class="miniOfferingHeader">Slimnastics</b><br>
    Conditioning. Toning. Lean.
  </div>
  <div class="col-3 text-center p-0">
    <img src="/images/graphics/Push Up SVG.svg" width="60%"> </img><br>
  </div>
  <div class="col-3 text-center p-0">
    <img src="/images/graphics/Zumba SVG.svg" width="60%"> </img><br>
  </div>
  <div class="col-3 text-left p-0 textMobileNormal">
  <b class="miniOfferingHeader">Zumba</b><br>
  Dance. Flexibility. Fun.
  </div>
</div>


<!-- know more separator button -->
<div class="row align-items-center pt-4 pb-4">
  <div class="col text-center">
    <a href="offerings.php" class="btn btn-primary btn-sm btn userdropdown">KNOW MORE </a>
  </div>

</div>

<!-- how it works section -->

  <div class="row mt-2 pt-4 pb-4">
    <div class="col">
      <center><h2>How it works</h2></center>
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


<!--
<img src="/images/Icons/Enroll/Enroll with Text PNG.png" width="100%"> </img>
<img src="/images/Icons/Pick Membership/Pick Membership with text PNG.png" width="100%">  </img>
<img src="/images/Icons/Get Connected/Get Connected with Text PNG.png" width="100%"> </img>-->

<?php
  require "footer.php";
?>
