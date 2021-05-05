<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> Contact FuNinja </title>
  <?php
  require ROOT_DIR."/includes/frameworks.php";
  ?>
</head>

<body>
  <script>
  // add class to body tag so that white background can be set

  $("body").addClass("whiteBgd");

  </script>
<?php
include ROOT_DIR."/header.php";
?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<div class="container mt-3 mt-md-5">

<center><h5 class="m-0 p-0">We would <span style="color:red">♥</span> to hear from you</h5></center>
<br>

<!--<p> If you're having trouble, please check our <a href="/faq.php"><b>FAQs</b></a> (Frequently Asked Questions) page. </p>-->

<br>

<div class="row" >
  <div class="col-md-3 mb-4 justify-content-center " align="center">

  <i class="far fa-envelope fa-lg mr-3"></i>hello@funinja.in <br>
  <i class="fas fa-phone fa-lg mr-2"> </i>+91 91088 06213 <br>
     <i class="fab fa-whatsapp fa-lg mr-2"></i> +91 91088 06213
  </div>
<div class="col-md-7">
<form action="/includes/contact_us_submit.php" method="post">
  <div class="form-group"><input id="subject" type="text" name="subject" class="form-control contactForm" placeholder="Subject" required >
  </div>
  <div class="form-group">
  <textarea class="form-control contactForm" id="message" rows="6" name="message" style="resize: none" placeholder="Your message" required></textarea>
  </div>
  <div class="form-group justify-content-center">
    <input id="name" type="text" name="name" class="form-control mr-1 mb-2 contactForm" placeholder="Name" required >
    <input id="email" type="email" name="email" class="form-control mr-1 mb-2 contactForm" placeholder="Email"  required>
    <input id="phone" type="text" name="phone" class="form-control mr-1  mb-2 contactForm" placeholder="Phone #"  required>
  </div>
  <div class="form-group ">
    <center><div class="g-recaptcha" data-sitekey="6LcUPlYaAAAAANdAD-frTgF7yUWUoCe4aTqYKJLk" data-callback="enableBtn"></div></center>
      <br/>
    <center><button id="submitButton" class="btn btn-primary blueButton" type="submit" name="submit_contact" disabled="disabled">Submit</button></center>
  </div>
</form>
</div>

</div>

</center>
</div>

<?php
  require "footer.php";
?>

<script>
// set active link display in the menu bar
$('.contactLink').addClass("activeMenuLink");

function enableBtn(){
  document.getElementById("submitButton").disabled = false;
}
</script>
