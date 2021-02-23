<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> Home - Premium Personal Training - FuNinja </title>
  <?php
  require ROOT_DIR."/includes/frameworks.php";
  ?>
</head>

<body>
<?php
include ROOT_DIR."/header.php";
?>


<main style="margin-bottom:0px!important">




  <div class="container ">

<!-- get fit section row -->
  <div class="row pt-3 pt-md-4 align-items-center pb-4 pb-md-5" >
    <div class="col-md-4 col-12 order-md-1 order-2 mobCenterDiv" id="topLeftDiv" align="center">
      <h2 class="mb-3 mt-3 mb-md-4 mt-md-4 mobHeader">Get Fit. Stay Fit.</h2>
      <p class="mobText pb-2 pb-md-0">Get into the best shape of your life with FuNinja's elite Online Personal Trainers as they masterfully guide you through fun, engaging and highly customized fitness 1 on 1 routines carefully tailored to fit your exact needs.</p>

      <?php
      // if user user isn't logged in, show the login and register buttons
      if(!isset($_SESSION['uid'])){ ?>
        <center><button type="button" class=" btn btn-lg btn-primary bigSignUpButton mt-0 mt-md-2 hide-on-mobile" data-toggle="modal" data-target="#exampleModal" id ="registerButton"> FREE TRIAL </button></center>
        <center><button type="button" class=" btn btn-primary bigSignUpButton mt-0 mt-md-2 hide-on-nonmobile" data-toggle="modal" data-target="#exampleModal" id ="registerButton"> FREE TRIAL </button></center>

        <?php  ;
      } ?>
    </div>
    <div class="col-md-8 col-12 order-md-2 order-1" id="womanImg" >
      <center><img src="/images/graphics/Illustration SVG.svg" width="80%" > </img></center>
    </div>

  </div>
</div>

<div class="container-fluid">
  <!-- core team section -->

  <div class="row mt-2 mb-4">
    <div class="col">
      <center><h2 class="mobHeader"> Meet The Core Team  </h2></center>
    </div>
  </div>

  <div class="row">
    <div class="col-4" align="center">
      Dipali
    </div>
    <div class="col-4" align="center">
      Ashish
    </div>
    <div class="col-4" align="center">
      Bharath
    </div>
  </div>

  <div class="row p-0 m-0">

    <div class="col-4" align="center" >
      <img class="" src="/images/trainers/Dipali_new.jpg" width="45%"> </img>
    </div>
    <div class="col-4" align="center" >
      <img class="" src="/images/trainers/Ashish_no_bg.jpg" width="45%" style="transform: rotateY(180deg);"> </img>
    </div>
    <div class="col-4" align="center" >
      <img class="" src="/images/trainers/Bharath_no_bg.jpg" width="45%"> </img>
    </div>
  </div>

  <div class="row">
    <div class="col-4" align="center">
      18 Yrs of Zumba Instruction

    </div>
    <div class="col-4" align="center">
      BHMS (Homoeopathic physician)<br>
      MSc. Yoga <br>
      Ex Senior Yoga Instructor Singapore
    </div>
    <div class="col-4" align="center">
      13 Yrs of Aerobics Instruction
    </div>
  </div>


</div>


<div class="container-fluid" style="border-top: 1px solid #D5E8F3;">

  <div class="aditiBgrndDiv" style=" background: linear-gradient(rgba(255,255,255,.8), rgba(255,255,255,.8)), url(/images/bg1.png); background-size: 70%;">



<!-- short form of offerings row -->
<div class="container ">


<div class="row pt-3 pt-md-5 align-items-center justify-content-center" data-offset-top="200">
  <div class="col-md-4 col-6 text-center p-0" style="color:black">
    <b class="miniOfferingHeader">Yoga</b>
    <p class="mobText">Peace. Balance. Agility.</P>
      <a class="" href="/offerings.php"><img class="offeringsPic" src="/images/graphics/Yoga SVG.svg" width="60%"> </img><a>


  </div>
  <div class="col-md-4 col-6 text-center p-0 " style="color:black">
    <b class="miniOfferingHeader ">Aerobics</b><br>
    <p class="mobText">Strength. Cardio. Variation.</p>
    <a class="" href="/offerings.php"><img class="offeringsPic" src="/images/graphics/Aerobics SVG.svg" width="60%"> </img><a>
  </div>

</div>

<!-- know more separator button -->
<div class="row align-items-center mt-md-5 hide-on-mobile">
  <div class="col text-center">
    <a href="offerings.php" class="btn bigSignUpButton btn-lg userdropdown m-0 ">KNOW MORE </a>
  </div>
</div>
<div class="row align-items-center mt-4 hide-on-nonmobile">
  <div class="col text-center">
    <a href="offerings.php" class="btn bigSignUpButton userdropdown m-0 ">KNOW MORE </a>
  </div>
</div>

<div class="row align-items-center justify-content-center pb-md-4 pb-3" >

  <div class="col-md-4 col-6 text-center p-0" style="color:black">
    <a class="" href="/offerings.php"><img class="offeringsPic" src="/images/graphics/Push up SVG.svg" width="60%"> </img></a><br>
    <b class="miniOfferingHeader ">Slimnastics</b>
    <p class="mobText ">Conditioning. Toning. Lean.</p>
  </div>
  <div class="col-md-4 col-6 text-center p-0" style="color:black">
    <a class="" href="/offerings.php"><img class="offeringsPic" src="/images/graphics/Zumba SVG.svg" width="60%"> </img></a><br>
    <b class="miniOfferingHeader ">Zumba</b>
    <p class="mobText "> Dance. Flexibility. Fun.</p>
  </div>
</div>


</div>
</div>
</div>
<div class="container-fluid" style="background-color: #263F97; ">
  <div class="container">
    <div class="row pt-4 pt-md-5">
      <div class="col" style="color:white">
        <center><h2 class="mobHeader">Reviews</h2></center>
      </div>
    </div>

<!-- mobile carousel (one slide only) -->

<div id="mobileCarousel" class="carousel slide hide-on-nonmobile w-100 m-0 p-0" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" style="height:360px">
      <div class="col-12 col-md-12 pl-1 pl-md-3 pr-1 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
        <div class="mt-3 testimonialCard " style="height:270px">
          <img class="testimonialPic" src="/images/testimonials/Nadia.png"></img><br>
          <p style="font-family:lato-bold">Nadezhda Trapizonian</P>I recently had my first child and I had put on a few pounds. I wanted help with getting back in shape... Not quite there yet, but I appreciate the FuNinja team working closely with me and adjusting my training plan while keeping my demanding schedule in mind.
        </div>
      </div>
    </div>

    <div class="carousel-item" style="height:360px">
      <div class="col-12 col-md-12 pl-1 pl-md-3 pr-1 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
        <div class="mt-3 testimonialCard " style="height:270px">
          <img class="testimonialPic" src="/images/testimonials/Rohin.png"></img><br>
          <p style="font-family:lato-bold">Rohin Suresh<p> Their concept is pretty cool and they have top notch trainers. I recently moved to Australia. My routine took a hit and I had a hard time adjusting. The FuNinja trainers helped me adapt my lifestyle to the new environment by challenging me and helping me work towards my fitness goals.
        </div>
      </div >
    </div>

    <div class="carousel-item" style="height:360px">
      <div class="col-12 col-md-12 pl-1 pl-md-3 pr-1 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
        <div class="mt-3 testimonialCard " style="height:270px">
          <img class="testimonialPic" src="/images/testimonials/Megha.png"></img><br>
          <p style="font-family:lato-bold">Priya and Megha Gupta</P> I have been working out for a while but I wanted my mom to get fitter, so we bought the "Pair Up" package. Sessions like Zumba and Yoga have been way more fun with my mom there. FuNinja has been helping us achieve our individual goals while letting us have fun together.
        </div>
      </div >
    </div>

    <div class="carousel-item" style="height:360px">
      <div class="col-12 col-md-12 pl-1 pl-md-3 pr-1 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
        <div class="mt-3 testimonialCard " style="height:270px">
          <img class="testimonialPic" src="/images/testimonials/Mangal.png"></img><br>
          <p style="font-family:lato-bold">Satya Das</P> Ashish and Raghavan were both bright students at Sivananda Ashram and graduated from our Yoga Teachers' Training Course. They are both passionate practitioners of Yoga and are excellent teachers.
        </div>
      </div >
    </div>

    </div>
  </div>


<!-- desktop testimonial carousel (two slides)-->
    <div class="row mx-auto my-auto pb-5">
        <div id="desktopIpadCarousel" class="desktopIpadCarousel carousel slide w-100 m-0 p-0" data-ride="carousel" >

            <div class="carousel-inner w-100 m-0 p-0" role="listbox" >
                <div class="carousel-item active" >

                  <div class="col-md-6 m-0 p-0 justify-content-center testiWrapper">
                  <div class="col-12 col-md-12 pl-0 pl-md-3 pr-0 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
                    <div class="mt-3 testimonialCard ">
                      <img class="testimonialPic" src="/images/testimonials/Nadia.png"></img><br>
                      <p style="font-family:lato-bold">Nadezhda Trapizonian</P>I recently had my first child and I had put on a few pounds. I wanted help with getting back in shape... Not quite there yet, but I appreciate the FuNinja team working closely with me and adjusting my training plan while keeping my demanding schedule in mind.
                    </div>
                  </div >
                  </div>
                </div>

                <div class="carousel-item" >
                <div class="col-md-6 m-0 p-0 justify-content-center">
                <div class="col-12 col-md-12 pl-0 pl-md-3 pr-0 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
                  <div class="mt-3 testimonialCard ">
                    <img class="testimonialPic" src="/images/testimonials/Rohin.png"></img><br>
                <p style="font-family:lato-bold">Rohin Suresh<p> Their concept is pretty cool and they have top notch trainers. I recently moved to Australia. My routine took a hit and I had a hard time adjusting. The FuNinja trainers helped me adapt my lifestyle to the new environment by challenging me and helping me work towards my fitness goals.
                  </div>
                </div>
                  </div>
                </div>

                <div class="carousel-item" >
                <div class="col-md-6 m-0 p-0 justify-content-center">
                <div class="col-12 col-md-12 pl-0 pl-md-3 pr-0 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
                  <div class="mt-3 testimonialCard ">
                    <img class="testimonialPic" src="/images/testimonials/Megha.png"></img><br>
                <p style="font-family:lato-bold">Priya and Megha Gupta</P> I have been working out for a while but I wanted my mom to get fitter, so we bought the "Pair Up" package. Sessions like Zumba and Yoga have been way more fun with my mom there. FuNinja has been helping us achieve our individual goals while letting us have fun together.
                  </div>
                </div>
                  </div>
                </div>

                <div class="carousel-item" >
                <div class="col-md-6 m-0 p-0 justify-content-center">
                <div class="col-12 col-md-12 pl-0 pl-md-3 pr-0 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
                  <div class="mt-3 testimonialCard ">
                    <img class="testimonialPic" src="/images/testimonials/Mangal.png"></img><br>
                <p style="font-family:lato-bold">Satya Das</P> Ashish and Raghavan were both bright students at Sivananda Ashram and graduated from our Yoga Teachers' Training Course. They are both passionate practitioners of Yoga and are excellent teachers.
                  </div>
                </div>
                  </div>
                </div>


            </div>

        </div>
    </div>



</div>
</div>



</main>
<script>
// add class to body tag so that white background can be set

$("body").addClass("whiteBackground");

$("#topLeftDiv").hide();
$("#topLeftDiv").fadeIn(2000);

$("#womanImg").css({"left":600});
$(document).ready(function(){
  $("#womanImg").animate({left: "-=600"}, 1000);
});

</script>

<script>

$('#mobileCarousel').carousel({
  interval: 3000
})

$('#desktopIpadCarousel').carousel({
    interval: 3000
})

$('.desktopIpadCarousel .carousel-item').each(function() {
    var minPerSlide = 2;
    var next = $(this).next();

    // if you reach the end, set next to the first element
    if (!next.length) {
        next = $(this).siblings(':first');
    }

    next.children(':first-child').clone().appendTo($(this));

    for (var i = 0; i < minPerSlide; i++) {
        next = next.next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }

        next.children(':first-child').clone().appendTo($(this));
    }
});

</script>

<!--
<img src="/images/Icons/Enroll/Enroll with Text PNG.png" width="100%"> </img>
<img src="/images/Icons/Pick Membership/Pick Membership with text PNG.png" width="100%">  </img>
<img src="/images/Icons/Get Connected/Get Connected with Text PNG.png" width="100%"> </img>-->

<?php
  require "footer.php";
?>
