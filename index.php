<?php

include "includes/autoloader.php";
require "header.php";

?>




<main>




  <div class="container ">

<!-- get fit section row -->
  <div class="row pt-3 pt-md-4 align-items-center pb-4 pb-md-5" >
    <div class="col-md-4 col-12 order-md-1 order-2 mobCenterDiv" id="topLeftDiv">
      <h2 class="mb-3 mt-3 mb-md-4 mt-md-4 mobHeader">Get Fit. Stay Fit.</h2>
      <p class="mobText pb-2 pb-md-0">Get into the best shape of your life with FuNinja's elite Online Personal Trainers as they masterfully guide you through fun, engaging and highly customized fitness 1 on 1 routines carefully tailored to fit your exact needs.</p>

      <?php
      // if user user isn't logged in, show the login and register buttons
      if(!isset($_SESSION['uid'])){ ?>
        <button type="button" class=" btn btn-lg btn-primary bigSignUpButton mt-0 mt-md-2 hide-on-mobile" data-toggle="modal" data-target="#exampleModal" id ="registerButton"> FREE TRIAL </button>
        <center><button type="button" class=" btn btn-primary bigSignUpButton mt-0 mt-md-2 hide-on-nonmobile" data-toggle="modal" data-target="#exampleModal" id ="registerButton"> FREE TRIAL </button></center>

        <?php  ;
      } ?>
    </div>
    <div class="col-md-8 col-12 order-md-2 order-1" id="womanImg" >
      <center><img src="/images/graphics/Illustration SVG.svg" width="80%" > </img></center>
    </div>

  </div>
</div>

<div class="container-fluid p-0" style="border-top: 1px solid #D5E8F3;">

  <div class="aditiBgrndDiv" style=" background: linear-gradient(rgba(255,255,255,.8), rgba(255,255,255,.8)), url(/images/bg1.png); background-size: 100%;">
<!-- short form of offerings row -->
<div class="container ">
  <div class="row pt-4 pt-md-5">
    <div class="col" >
      <center><h2 class="mobHeader">Offerings</h2></center>
    </div>
  </div>

<div class="row pt-3 pt-md-5 align-items-center justify-content-center" data-offset-top="200">
  <div class="col-md-4 col-6 text-center p-0">
    <b class="miniOfferingHeader fade">Yoga</b>
    <p class="mobText fade">Peace. Balance. Agility.</P>
      <a class="fade" href="/offerings.php"><img class="offeringsPic" src="/images/graphics/Yoga SVG.svg" width="60%"> </img><a>


  </div>
  <div class="col-md-4 col-6 text-center p-0 ">
    <b class="miniOfferingHeader fade">Aerobics</b><br>
    <p class="mobText fade">Strength. Cardio. Variation.</p>
    <a class="fade" href="/offerings.php"><img class="offeringsPic" src="/images/graphics/Aerobics SVG.svg" width="60%"> </img><a>
  </div>

</div>

<!-- know more separator button -->
<div class="row align-items-center mt-md-5 hide-on-mobile">
  <div class="col text-center">
    <a href="offerings.php" class="btn bigSignUpButton btn-lg userdropdown m-0 fade">KNOW MORE </a>
  </div>
</div>
<div class="row align-items-center mt-4 hide-on-nonmobile">
  <div class="col text-center">
    <a href="offerings.php" class="btn bigSignUpButton userdropdown m-0 fade">KNOW MORE </a>
  </div>
</div>

<div class="row align-items-center justify-content-center pb-md-4 pb-3" >

  <div class="col-md-4 col-6 text-center p-0">
    <a class="fade" href="/offerings.php"><img class="offeringsPic" src="/images/graphics/Push up SVG.svg" width="60%"> </img></a><br>
    <b class="miniOfferingHeader fade">Slimnastics</b>
    <p class="mobText fade">Conditioning. Toning. Lean.</p>
  </div>
  <div class="col-md-4 col-6 text-center p-0">
    <a class="fade" href="/offerings.php"><img class="offeringsPic" src="/images/graphics/Zumba SVG.svg" width="60%"> </img></a><br>
    <b class="miniOfferingHeader fade">Zumba</b>
    <p class="mobText fade"> Dance. Flexibility. Fun.</p>
  </div>

</div>


</div>
</div>
</div>
<div class="container-fluid" style="background-color: #263F97; ">
  <div class="container">
    <div class="row pt-4 pt-md-5">
      <div class="col" style="color:white">
        <center><h2 class="mobHeader">Reviews and testimonials</h2></center>
      </div>
    </div>
  <div class="row testimonialRowPadding" >
    <div class="col-12 col-md-6 pl-0 pl-md-3 pr-0 pr-md-3 testimonialMobileTopMargin" align="center">
      <div class="mt-3 testimonialCard ">
        <img class="testimonialPic" src="/images/testimonials/Nadia.png"></img><br>
        <p style="color:blue">Nadezhda Trapizonian</P>I recently had my first child and I had put on a few pounds. I wanted help with getting back in shape... Not quite there yet, but I appreciate the FuNinja team working closely with me and adjusting my training plan while keeping my demanding schedule in mind.
      </div>
    </div class="col">
    <div class="col-12 col-md-6 pl-0 pl-md-3 pr-0 pr-md-3 testimonialMobileTopMargin" align="center">
      <div class="mt-3 testimonialCard">
      <img class="testimonialPic" src="/images/testimonials/Rohin.png"></img><br>
      <p style="color:blue">Rohin Suresh<p> Their concept is pretty cool and they have top notch trainers. I recently moved to Australia. My routine took a hit and I had a hard time adjusting. The FuNinja trainers helped me adapt my lifestyle to the new environment by challenging me and helping me work towards my fitness goals.
    </div>
    </div>
  </div>

  <div class="row pb-md-5 testimonialRowMargin pb-3" >
    <div class="col-12 col-md-6 pl-0 pl-md-3 pr-0 pr-md-3 testimonialMobileTopMargin" align="center">
      <div class="mt-3 testimonialCard" >
        <img class="testimonialPic" src="/images/testimonials/Megha.png"></img><br>
        <p style="color:blue">Priya and Megha Gupta</P> I have been working out for a while but I wanted my mom to get fitter, so we bought the “Couple” package. Sessions like Zumba and Yoga have been way more fun with my mom there. FuNinja has been helping us achieve our individual goals while letting us have fun together.
      </div>
    </div class="col-12 col-md-6">
    <div class="col mb-3 pl-0 pl-md-3 pr-0 pr-md-3 testimonialMobileTopMargin" align="center">
      <div class="mt-3 testimonialCard" >
      <img class="testimonialPic" src="/images/testimonials/Mangal.png"></img><br>
      <p style="color:blue">Satya Das</P> Krishna and Raghavan (FuNinja yoga leads) were both bright students at Sivananda Asram and graduated from our Teacher’s Training Course. They are both passionate practitioners of Yoga and are excellent teachers.
    </div>
    </div>
  </div>

</div>
</div>
</div>

<div class="container">


<!-- how it works section -->

  <div class="row pt-md-5 pt-4 pb-3 pb-md-4">
    <div class="col">
      <center><h2 class="mobHeader fade">How It Works</h2></center>
    </div>
  </div>
  <div class="row ">
    <div class="col-lg-4 col-6 text-center p-0">
    <button type="button" class="stickyUserMenu fade" data-toggle="modal" data-target="#exampleModal" >
      <img title="Enroll" src="/images/graphics/Enroll with Text PNG.png" width="70%" class="largerHowItWorks"/>
    </button>
    </div>
    <div class="col-lg-4 col-6 text-center p-0">
    <a href="/plans.php"><img src="/images/graphics/Pick Membership with text PNG.png" width="70%" class="largerHowItWorks fade"></a>
    </div>
    <div class="col-lg-4 col-6 text-center p-0">
    <img src="/images/graphics/Get Connected with Text PNG.png" width="70%" class="largerHowItWorks fade"> </img>
    </div>
    <div class="col-lg-4 col-6 text-center p-0">
    <img src="/images/graphics/Customise with text PNG.png" width="70%" class="largerHowItWorks fade"> </img>
    </div>
    <div class="col-lg-4 col-6 text-center p-0">
    <img src="/images/graphics/Get Started with text PNG.png" width="70%" class="largerHowItWorks fade"> </img>
    </div>
    <div class="col-lg-4 col-6 text-center p-0">
    <img src="/images/graphics/Feedback with text PNG.png" width="70%" class="largerHowItWorks fade"> </img>
    </div>

  </div>

  <div class="row align-items-center hide-on-mobile pt-2 pb-5">
    <div class="col text-center">
      <a href="plans.php" class="btn bigSignUpButton btn-lg userdropdown m-0 fade">PICK YOUR PLAN </a>
    </div>
  </div>
  <div class="row align-items-center mt-2 pb-5 hide-on-nonmobile">
    <div class="col text-center">
      <a href="plans.php" class="btn bigSignUpButton userdropdown m-0 fade">PICK YOUR PLAN </a>
    </div>
  </div>


</div>

</main>
<script>
// add class to body tag so that white background can be set

$("body").addClass("whiteBackground");

$("#topLeftDiv").hide();
$("#topLeftDiv").fadeIn(1500);

$("#womanImg").css({"left":600});
$(document).ready(function(){
  $("#womanImg").animate({left: "-=600"}, 1000);
});


$(window).on("load",function() {
  $(window).scroll(function() {
    var windowBottom = $(this).scrollTop() + $(this).innerHeight();
    $(".fade").each(function() {
      /* Check the location of each desired element */
      var objectBottom = $(this).offset().top + $(this).outerHeight();

      /* If the element is completely within bounds of the window, fade it in */
      if (objectBottom < windowBottom) { //object comes into view (scrolling down)
        if ($(this).css("opacity")==0) {$(this).fadeTo(500,1);}
      } else { //object goes out of view (scrolling up)
        if ($(this).css("opacity")==1) {$(this).fadeTo(500,0);}
      }
    });
  }).scroll(); //invoke scroll-handler on page-load
});

</script>


<!--
<img src="/images/Icons/Enroll/Enroll with Text PNG.png" width="100%"> </img>
<img src="/images/Icons/Pick Membership/Pick Membership with text PNG.png" width="100%">  </img>
<img src="/images/Icons/Get Connected/Get Connected with Text PNG.png" width="100%"> </img>-->

<?php
  require "footer.php";
?>
