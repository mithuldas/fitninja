<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> Premium Personal Training - FuNinja </title>
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
  <div class="row pt-3 pt-md-4 align-items-center pb-1 pb-md-5" >
    <div class="col-md-4 col-12 order-md-1 order-2 mobCenterDiv" id="topLeftDiv" align="center">
      <h2 class="mb-3 mt-3 mb-md-4 mt-md-4 mobHeader">Fitness at Home</h2>
      <p class="mobText">Train in the comfort of your home with FuNinja's elite Personal Trainers as they skillfully   guide you through fun, engaging and result oriented 1-on-1 virtual training sessions.</p>

    </div>
    <div class="col-md-8 col-12 order-md-2 order-1" id="womanImg" >
      <center><img src="/images/graphics/Illustration SVG.svg" width="60%" > </img></center>
    </div>

  </div>


</div>

<div class="container-fluid">
  <!-- core team section -->

  <div class="row mt-2 mb-3">
    <div class="col" align="center">
      <h2 class="mobHeader">  Our Core Team  </h2>
      <h5 class="mobileTitle mobCenterDiv mt-3 mt-md-4 mb-md-4">Our team is led by seasoned service minded veterans who have worked with thousands of clients and spent countless hours perfecting their art.</h5>
    </div>
  </div>

  <div class="row p-0 m-0 ml-md-5 mr-md-5">
    <div class="col coreTeamCardTop" align="center">
      Bharath
    </div>
    <div class="col coreTeamCardTop" align="center">
      Deepali
    </div>
    <div class="col coreTeamCardTop" align="center">
      Dr. Ashish
    </div>
  </div>

  <div class="row p-0 m-0 ml-md-5 mr-md-5">

    <div class="col coreTeamCardMain align-self-end " align="center" >
      <img class="coreTeamMember" src="/images/trainers/Bharath_no_bg.jpg" width="46%"> </img>
    </div>
    <div class="col coreTeamCardMain align-self-end mt-md-1" align="center" >
      <img class="coreTeamMember" src="/images/trainers/Dipali_new.jpg" width="45%"> </img>

    </div>
    <div class="col coreTeamCardMain mt-md-2" align="center" >
      <img class="coreTeamMember" src="/images/trainers/Ashish_no_bg.jpg" width="45%" style="transform: rotateY(180deg);"> </img>
    </div>
  </div>

  <div class="row  p-0 m-0 mb-4 ml-md-5 mr-md-5">
    <div class="col coreTeamCardBottom" align="center">
      Aerobics, Slimnastics<br>
      13 Yrs in Personal Training <br>
      Trained by Sucheta Pal <br>
      Co-owns BNF studio, Hyderabad
    </div>
    <div class="col coreTeamCardBottom" align="center">
      Aerobics, Zumba, Pilates<br>
      18 Yrs in Personal Training<br>
      Certified Reebok Master Trainer<br>
      Speciality: Fitness & Dance
    </div>
    <div class="col coreTeamCardBottom" align="center">
      Yoga Therapist <br>
      Homoeopathic physician<br>
      Ex Senior Yoga Instructor Singapore <br>
      Ex Yoga Teacher at <a href="https://sivananda.org.in/" target="_blank">Sivananda</a><br>
    </div>
  </div>

  <div class="row p-0 m-0 ml-md-5 mr-md-5 justify-content-center">
    <div class="col-4 coreTeamCardTop" align="center">
      Raghavan
    </div>
    <div class="col-4 coreTeamCardTop" align="center">
      Nani
    </div>
  </div>

  <div class="row p-0 m-0 ml-md-5 mr-md-5 justify-content-center">

    <div class="col-4 coreTeamCardMain align-self-end " align="center" >
      <img class="coreTeamMember" src="/images/trainers/Raghavan_no_bg.jpg" width="45%" > </img>
    </div>
    <div class="col-4 coreTeamCardMain align-self-end mt-md-1" align="center" >
      <img class="coreTeamMember" src="/images/trainers/Nani_no_bg.jpg" width="50%" style="transform: rotateY(180deg);"> </img>

    </div>
  </div>

  <div class="row  p-0 m-0 mb-4 ml-md-5 mr-md-5 justify-content-center">
    <div class="col-4 coreTeamCardBottom" align="center">
      Certified Yoga Acharya<br>
      9+ years as a Trainer <br>
      Ex Yoga Teacher at <a href="https://sivananda.org.in/" target="_blank">Sivananda</a> <br>
      Speciality: Kids Yoga, Stress Management
    </div>
    <div class="col-4 coreTeamCardBottom" align="center">
      Slimnastics, Aerobics, Zumba<br>
      9 Yrs in Personal Training<br>
      Trained by Sucheta Pal<br>
      Co-owns BNF studio, Hyderabad
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
        <center><h2 class="mobHeader">Customer Reviews and Testimonials</h2></center>
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
          <p style="font-family:lato-bold">Rohin Suresh<p> Their concept is pretty cool and they have top notch trainers. Having recently moved to a new timezone, my routine took a hit and I had a hard time adjusting. The FuNinja trainers helped me by constantly challenging me and helping me work towards my fitness goals.
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
                <p style="font-family:lato-bold">Rohin Suresh<p> Their concept is pretty cool and they have top notch trainers. Having recently moved to a new timezone, my routine took a hit and I had a hard time adjusting. The FuNinja trainers helped me by constantly challenging me and helping me work towards my fitness goals.
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
  interval: 5000
})

$('#desktopIpadCarousel').carousel({
    interval: 5000
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
