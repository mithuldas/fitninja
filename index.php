<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> FuNinja Virtual Personal Training</title>
  <?php
  require ROOT_DIR."/includes/frameworks.php";
  ?>
</head>

<body>
<?php
include ROOT_DIR."/header.php";
?>


<main style="margin-bottom:0px!important">




  <div class="container pb-5 pb-md-4 pt-5 pt-md-4">

<!-- get fit section row -->
  <div class="row pt-3 pt-md-4 align-items-center pb-1 pb-md-5" >
    <div class="col-md-6 col-lg-6 col-12 order-md-1 order-2 mobCenterDiv" id="topLeftDiv" align="center" >
      <p class="mb-3 mt-3 mb-md-4 mt-md-4 mainTitle" style="font-weight:800">VIRTUAL PERSONAL TRAINING</p>
      <p class="pb-2 pb-md-3 normalFont">Train 1-on-1 with FuNinja Personal Trainers as they guide you through fun, engaging and result oriented Virtual Training sessions.</p>
      <?php
 // if user user isn't logged in, show the login and register buttons
 if(!isset($_SESSION['uid'])){ ?>
   <center><button type="button" class=" btn btn-lg btn-primary blueButton mainSgnBtn mt-0 mt-md-2 hide-on-mobile" data-toggle="modal" data-target="#exampleModal" id ="registerButton"> SIGN UP FOR A FREE TRIAL </button></center>
   <center><button type="button" class=" btn btn-primary blueButton mainSgnBtn mt-0 mt-md-2 mb-2 hide-on-nonmobile" data-toggle="modal" data-target="#exampleModal" id ="registerButton"> SIGN UP FOR A FREE TRIAL </button></center>

   <?php  ;
 } ?>

    </div>
    <div class="col-md-6 col-lg-6 col-12 order-md-2 order-1" id="womanImg">
      <center><img id="mainPic" src="/images/graphics/test.gif"> </img></center>
    </div>
  </div>


</div>

<div class="container-fluid pt-5 pb-5 pt-md-5 pb-md-5" style="background:linear-gradient(to right, #edf0f4, #ebeef2);box-shadow: inset 0 -3px 10px rgb(0 0 0 / 10%);">
  <!-- core team section -->

  <div class="row mb-2 pt-md-3">
    <div class="col" align="center">
        <p class="subTitle"> HEAD TRAINERS  </p>
      <h5 class="normalFont largerFontMob mt-3 mt-md-4 pb-md-5 pb-3">Our trainers are led by seasoned veterans who have spent countless hours perfecting their craft.</h5>
    </div>
  </div>


  <div class="row ml-1 mr-1">

    <div class="col-12 col-md-6 col-lg-3 mb-md-2 coreTeamCol pr-md-0" >

      <div class="row m-0 p-0 coreTeamCardMain coreTeamCol" style="height:100%">
        <div class="col-4 p-0 pl-2 pl-md-0 align-self-center " align="center">
          <img class="naniPic ml-1" src="/images/trainers/Nani_full_nobg.jpg"> </img>
        </div>
        <div class="col-8 align-self-center pr-md-1" align="center">
          <h5 class="trainerName m-0"> Nani </h5>
          <p class=" trgCat"> Slimnastics, Aerobics<br></p>
          <p class="slimText">9 Yrs in Personal Training<br>
          Trained by Sucheta Pal<br></p>
        </div>
      </div>

    </div>

    <div class="col-12 col-md-6 col-lg-3 mb-md-2 coreTeamCol pr-md-0">
      <div class="row m-0 p-0 coreTeamCardMain" style="height:100%">
        <div class="col-4 p-0 pl-2 pl-md-0 align-self-center" align="center">
          <img class="ashishPic ml-1" src="/images/trainers/Ashish_no_bg.jpg"> </img>
        </div>
        <div class="col-8 pl-md-2 p-0 align-self-center" align="center">
          <p class="trainerName m-0"> Ashish </p>
          <p class="trgCat"> Yoga Therapist<br></p>
          <p class="slimText">
          Homoeopathic physician<br>
          Ex Teacher, Sivananda<br></p>
        </div>
      </div>
    </div>


    <div class="col-12 col-md-6 col-lg-3 coreTeamCol pr-md-0">
      <div class="row m-0 p-0 coreTeamCardMain" style="height:100%">
        <div class="col-4 p-0 pl-2 pl-md-0 align-self-center " align="center">
          <img class="dipaliPic ml-md-2" src="/images/trainers/Dipali_new.jpg"> </img>
        </div>
        <div class="col-8 p-0  pr-3 pr-md-0 align-self-center" align="center">
          <h5 class="trainerName m-0"> Deepali </h5>
          <p class="trgCat"> Aerobics, Zumba, Pilates<br></p>
          <p class="slimText">18 Yrs in Personal Training<br>
          Speciality: Fitness & Dance</p>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3 coreTeamCol pr-md-0">
      <div class="row m-0 p-0 coreTeamCardMain" style="height:100%">
        <div class="col-4 p-0 pl-2 pl-md-0 align-self-center" align="center">
          <img class="raghavanPic ml-1" src="/images/trainers/Raghavan_no_bg.jpg"> </img>
        </div>
        <div class="col-8 p-0 align-self-center" align="center">
          <h5 class="trainerName m-0"> Raghavan </h5>
          <p class="trgCat"> Certified Yoga Acharya<br></p>
          <p class="slimText">9+ years as a Trainer<br>
          Kids Yoga, Stress Mgmt </p>
        </div>
      </div>
    </div>


  </div>

  <div class="pb-md-3">

  </div>

</div>



<div class="container-fluid ">

  <div class="aditiBgrndDiv pt-md-4 pb-md-4" style=" background: linear-gradient(rgba(255,255,255,.8), rgba(255,255,255,.8)), url(/images/bg1.png); background-size: 70%;">



<!-- short form of offerings row -->
<div class="container">


<div class="row pt-2 pt-md-2 align-items-center justify-content-center">
  <div class="col-md-4 col-6 text-center p-0">
    <p class="miniOfferingHeader">YOGA</p>
    <p class="m-0 hide-on-mobile">Peace. Balance. Agility.</P>
      <a class="" href="/offerings.php"><img class="offeringsPic" src="/images/graphics/Yoga SVG.svg" width="40%"> </img></a>
  </div>
  <div class="col-md-4 col-6 text-center p-0 ">
    <p class="miniOfferingHeader ">AEROBICS</p>
    <p class="m-0 hide-on-mobile">Strength. Cardio. Variation.</p>
    <a class="" href="/offerings.php"><img class="offeringsPic" src="/images/graphics/Aerobics SVG.svg" width="40%"> </img><a>
  </div>

</div>

<!-- know more separator button -->
<div class="row align-items-center mt-md-0 hide-on-mobile">
  <div class="col text-center">
    <a href="offerings.php" class="btn btn-primary btn-lg userdropdown mainSgnBtn m-0 ">KNOW MORE </a>
  </div>
</div>
<div class="row align-items-center mt-4 hide-on-nonmobile">
  <div class="col text-center">
    <a href="offerings.php" class="btn btn-primary userdropdown  mainSgnBtn m-0 ">KNOW MORE </a>
  </div>
</div>

<div class="row align-items-center justify-content-center pb-md-2 pb-2" >

  <div class="col-md-4 col-6 text-center p-0" >
    <a class="" href="/offerings.php"><img class="offeringsPic" src="/images/graphics/Push up SVG.svg" width="40%"> </img></a><br>
    <p class="miniOfferingHeader ">SLIMNASTICS</p>
    <p class="m-0 hide-on-mobile">Conditioning. Toning. Lean.</p>
  </div>
  <div class="col-md-4 col-6 text-center p-0">
    <a class="" href="/offerings.php"><img class="offeringsPic" src="/images/graphics/Zumba SVG.svg" width="40%"> </img></a><br>
    <p class="miniOfferingHeader ">ZUMBA</p>
    <p class="m-0 hide-on-mobile"> Dance. Flexibility. Fun.</p>
  </div>
</div>


</div>
</div>
</div>
<div class="container-fluid pt-3 pb-4" style="background: linear-gradient(to right, #3a7fd5, #6ebce2);box-shadow: inset 0 -3px 10px rgb(0 0 0 / 10%);">
  <div class="container">
    <div class="row pt-4 pt-md-2">
      <div class="col" style="color:white">

      </div>
    </div>

<!-- mobile carousel (one slide only) -->

<div id="mobileCarousel" class="carousel slide hide-on-nonmobile w-100 m-0 p-0" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" style="height:360px">
      <div class="col-12 col-md-12 pl-1 pl-md-3 pr-1 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
        <div class="mt-3 testimonialCard " style="height:270px">
          <img class="testimonialPic" src="/images/testimonials/Nadia.png"></img><br>
          <p class="testiNames">Nadia</P><p class="slimText"> I recently had my first child and I had put on a few pounds. I wanted help with getting back in shape. I appreciate the FuNinja team working closely with me and adjusting my training plan while keeping my demanding schedule in mind.</p>
        </div>
      </div>
    </div>

    <div class="carousel-item" style="height:360px">
      <div class="col-12 col-md-12 pl-1 pl-md-3 pr-1 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
        <div class="mt-3 testimonialCard " style="height:270px">
          <img class="testimonialPic" src="/images/testimonials/Rohin.png"></img><br>
          <p class="testiNames">Rohin</p> <p class="slimText"> The trainer I work with is top knotch. Having recently moved to a new timezone, my routine took a hit and I had a hard time adjusting. The FuNinja trainers helped me by challenging me and helping me work towards my fitness goals.</p>
        </div>
      </div >
    </div>

    <div class="carousel-item" style="height:360px">
      <div class="col-12 col-md-12 pl-1 pl-md-3 pr-1 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
        <div class="mt-3 testimonialCard " style="height:270px">
          <img class="testimonialPic" src="/images/testimonials/Megha.png"></img><br>
          <p class="testiNames">Priya and Megha</P> <p class="slimText">I've been working out for a while but I wanted my mom to get fitter, so we bought the "Pair Up" package. Sessions like Zumba and Yoga have been way more fun with my mom. FuNinja has been a lot of fun.</p>
        </div>
      </div >
    </div>

    <div class="carousel-item" style="height:360px">
      <div class="col-12 col-md-12 pl-1 pl-md-3 pr-1 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
        <div class="mt-3 testimonialCard " style="height:270px">
          <img class="testimonialPic" src="/images/testimonials/Mangal.png"></img><br>
          <p class="testiNames">Satya</P> <p class="slimText">Ashish and Raghavan were both bright students at Sivananda Ashram and graduated from our Yoga Teachers' Training Course. They are both passionate practitioners of Yoga and are excellent teachers.</p>
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

                  <div class="col-md-6 m-0 p-0 justify-content-center testiWrapper" >
                  <div class="col-12 col-md-12 pl-0 pl-md-3 pr-0 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
                    <div class="mt-3 testimonialCard ">
                      <img class="testimonialPic" src="/images/testimonials/Nadia.png"></img><br>
                      <p class="miniOfferingHeader">Nadia</P>I recently had my first child and I had put on a few pounds. I wanted help with getting back in shape... Not quite there yet, but I appreciate the FuNinja team working closely with me and adjusting my training plan while keeping my demanding schedule in mind.
                    </div>
                  </div >
                  </div>
                </div>

                <div class="carousel-item" >
                <div class="col-md-6 m-0 p-0 justify-content-center">
                <div class="col-12 col-md-12 pl-0 pl-md-3 pr-0 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
                  <div class="mt-3 testimonialCard ">
                    <img class="testimonialPic" src="/images/testimonials/Rohin.png"></img><br>
                <p class="miniOfferingHeader">Rohin<p> Their concept is pretty cool and they have top notch trainers. Having recently moved to a new timezone, my routine took a hit and I had a hard time adjusting. The FuNinja trainers helped me by constantly challenging me and helping me work towards my fitness goals.
                  </div>
                </div>
                  </div>
                </div>

                <div class="carousel-item" >
                <div class="col-md-6 m-0 p-0 justify-content-center">
                <div class="col-12 col-md-12 pl-0 pl-md-3 pr-0 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
                  <div class="mt-3 testimonialCard ">
                    <img class="testimonialPic" src="/images/testimonials/Megha.png"></img><br>
                <p class="miniOfferingHeader">Priya and Megha</P> I have been working out for a while but I wanted my mom to get fitter, so we bought the "Pair Up" package. Sessions like Zumba and Yoga have been way more fun with my mom there. FuNinja has been helping us achieve our individual goals while letting us have fun together.
                  </div>
                </div>
                  </div>
                </div>

                <div class="carousel-item" >
                <div class="col-md-6 m-0 p-0 justify-content-center">
                <div class="col-12 col-md-12 pl-0 pl-md-3 pr-0 pr-md-3 testimonialMobileTopMargin" align="center" style="position:absolute; bottom:0">
                  <div class="mt-3 testimonialCard ">
                    <img class="testimonialPic" src="/images/testimonials/Mangal.png"></img><br>
                <p class="miniOfferingHeader">Satya</P> Ashish and Raghavan were both bright students at Sivananda Ashram and graduated from our Yoga Teachers' Training Course. They are both passionate practitioners of Yoga and are excellent teachers.
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
