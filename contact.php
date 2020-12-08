<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

FlowControl::startSession();

require "header.php";
?>

<div class="container">

<br><br>
<center>We would <span style="color:red">♥</span> to hear from you</center>
<center><small>Support. Feedback. Enquiries</small></center></p>
<br>

<div class="row">
  <div class="col-md-3 mb-4">
    <strong>Phone:</strong> +91 9972 166212<br>
    <strong>Email:</strong> hello@funinja.in<br>
  </div>
<div class="col-md-7">
<form action="/includes/contact_us_submit.php" method="post">
  <div class="form-group"><input id="subject" type="text" name="subject" class="form-control" placeholder="Subject" required >
  </div>
  <div class="form-group">
  <textarea class="form-control" id="message" rows="6" name="message" style="resize: none" required></textarea>
  </div>
  <div class="form-group form-inline justify-content-center">
    <input id="name" type="text" name="name" class="form-control mr-1" placeholder="Name" required >
    <input id="email" type="email" name="email" class="form-control mr-1" placeholder="Email"  required>
    <input id="phone" type="number" name="phone" class="form-control mr-1" placeholder="Phone #"  required>
  </div>
  <div class="form-group ">
    <center><button class="btn btn-sm btn-primary" type="submit" name="submit_contact">Submit</button></center>
  </div>
</form>
</div>

</div>

</center>
</div>

<?php
  require "footer.php";
?>
