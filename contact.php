<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

FlowControl::startSession();

require "header.php";
?>

<div class="container-fluid">
  <nav aria-label="breadcrumb mb-0 pb-0">
    <ol class="breadcrumb" style="margin-bottom: 0px ; padding-left:0px; padding-top:0px">
      <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
    </ol>
  </nav>
</div>
<div class="container-fluid">

<center> <h5 class="m-0 p-0">We would <span style="color:red">♥</span> to hear from you</h5></center>
<center><small class="m-0 p-0">Support. Feedback. Enquiries</small></center>
<br>

<div class="row" >
  <div class="col-md-3 mb-4 justify-content-center align-self-center" align="center">

  <i class="far fa-envelope fa-lg mr-3"></i> hello@funinja.in <br>
  <i class="fas fa-phone fa-lg mr-2"> </i> +91 91088 06213 <br>
     <i class="fab fa-whatsapp fa-lg mr-2"></i> +91 91088 06213
  </div>
<div class="col-md-7">
<form action="/includes/contact_us_submit.php" method="post">
  <div class="form-group"><input id="subject" type="text" name="subject" class="form-control" placeholder="Subject" required >
  </div>
  <div class="form-group">
  <textarea class="form-control" id="message" rows="6" name="message" style="resize: none" placeholder="Your message" required></textarea>
  </div>
  <div class="form-group form-inline justify-content-center">
    <input id="name" type="text" name="name" class="form-control mr-1" placeholder="Name" required >
    <input id="email" type="email" name="email" class="form-control mr-1" placeholder="Email"  required>
    <input id="phone" type="number" name="phone" class="form-control mr-1" placeholder="Phone #"  required>
  </div>
  <div class="form-group ">
    <center><button class="btn btn-primary blueButton" type="submit" name="submit_contact">Submit</button></center>
  </div>
</form>
</div>

</div>

</center>
</div>

<?php
  require "footer.php";
?>
