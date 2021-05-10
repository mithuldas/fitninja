<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
FlowControl::redirectIfWrongUserType("Trainee");
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> Membership - FuNinja </title>
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

$("body").addClass("lgrayBg");

</script>
<div class="container-fluid  pb-md-1 pb-2" style="background:white" >

</div>
<div class="container pb-4">

  <div class="row p-0 pt-md-5 pb-md-5">
<div class="col-md-7 col-12 order-md-1 order-2" align="center">
<img src="/images/memberWoman.jpg" class="memShade" style="height:400px"></img>
</div>

  <div class="col-md-5 col-12 order-md-2 order-1 mt-4 pb-5" style="border-bottom:1px">



    <p class="whatYouGetHeader" style="font-weight:700; color:grey"> Membership Details </p>
    <i class="fas fa-check" style="color:#86b52d"></i> <span style="font-weight:600">Instructor Led, Personalized Sessions<br></span>
    <i class="fas fa-check" style="color:#86b52d"></i> <span style="font-weight:600">Optimized Diet and Nutrition <br></span>
    <i class="fas fa-check" style="color:#86b52d"></i> <span style="font-weight:600">15-day free trial <br></span>

    <?php if(!isset($_SESSION['uid'])){ ?>
        <button type="button" class=" btn btn-lg btn-primary blueButton mainSgnBtn mt-0 mt-md-4 hide-on-mobile" data-toggle="modal" data-target="#exampleModal" id ="registerButton"> START 15 DAY FREE TRIAL </button></center>
      <button type="button" class=" btn mainSgnBtn mt-4 mb-3 mt-md-4 hide-on-nonmobile" data-toggle="modal" data-target="#exampleModal" id ="registerButton"> START 15 DAY FREE TRIAL </button></center>
      <?php  ;
    } ?>
    <hr>
    <br>

    <i class="far fa-envelope fa-lg mr-3"></i><span style="font-weight:600">hello@funinja.in </span><br>
    <i class="fas fa-phone fa-lg mr-2"> </i><span style="font-weight:600">+91 91088 06213</span> <br>
       <i class="fab fa-whatsapp fa-lg mr-2"></i><span style="font-weight:600"> +91 91088 06213</span>

  </div>
</div>
</div>

<script>
// set active link display in the menu bar
$('.membershipLink').addClass("activeMenuLink");
</script>
<?php
  require "footer.php";
?>
