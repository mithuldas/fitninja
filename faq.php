<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

FlowControl::startSession();

require "header.php";
?>

<div class="container">

  <div class="row mt-2">
    <div class="col">
  <center><h4>Frequently Asked Questions</h4></center>
  <center><small>If your question isn't listed here, please <a href="contact.php"> contact us </a> </small></center>
    </div>
  </div>
<div class="row tableTitle mt-4 mb-1">
  <div class="col">
What is FuNinja?
  </div>
</div>
<div class="row">
  <div class="col">
FuNinja is an online platform that delivers personal training that is completely customized to suit your needs and schedule. FuNinja offers varied workout formats and membership plans for you to choose from.
  </div>
</div>


<div class="row tableTitle mt-4 mb-1">
  <div class="col">
Can I pick a Duo Ninja plan only with my spouse or can it be a friend/relative too?
  </div>
</div>
<div class="row">
  <div class="col">
The Duo Ninja plan can be picked with anyone you would like to train with, be it your spouse, friend or family member. As part of the package, you will be training at the same time in a single session with the same trainer. Feel free to <a href="contact.php"> contact us </a> incase you have any questions.
  </div>
</div>


<div class="row tableTitle mt-4 mb-1">
  <div class="col">
Is my personal data like Phone Number and Email ID secure on FuNinja?
  </div>
</div>
<div class="row">
  <div class="col">
Yes, all your personal data is encrypted and stored securely. We comply with industry regulatory requirements to ensure your personal details are safe.
  </div>
</div>


<div class="row tableTitle mt-4 mb-1">
  <div class="col">
What is the duration of each session?
  </div>
</div>
<div class="row">
  <div class="col">
Each session will be curated to suit your needs and will last 50 minutes.
  </div>
</div>


<div class="row tableTitle mt-4 mb-1">
  <div class="col">
Which Online platform is used to conduct the sessions online?
  </div>
</div>
<div class="row">
  <div class="col">
You will need the Zoom Application or a browser that supports Zoom to enter your Fitness Room once a session has been scheduled.
  </div>
</div>


<div class="row tableTitle mt-4 mb-1">
  <div class="col">
Do I need a Zoom account to attend the training sessions ?
  </div>
</div>
<div class="row">
  <div class="col">
No , you will not need a Zoom Account to attend the session. FuNinja will share a link to the Fitness Room 30 minutes prior to the scheduled session.
  </div>
</div>


<div class="row tableTitle mt-4 mb-1">
  <div class="col">
Is it possible for me to request for changes to my workout plan while my plan is active?
  </div>
</div>
<div class="row">
  <div class="col">
Yes, it is possible to change the workout plan at anytime during the validity of your package. The changes will be worked through with you, your assigned trainer and a FuNinja Fitness Manager.
  </div>
</div>

<div class="row tableTitle mt-4 mb-1">
  <div class="col">
Can I pick the days I would want to train or is that something the trainer will decide ?
  </div>
</div>
<div class="row">
  <div class="col">
You are free to decide your training days and timing since we offer customized schedules to suit your needs and requirements.
  </div>
</div>

<div class="row tableTitle mt-4 mb-1">
  <div class="col">
I bought a Basic package and would like to upgrade to the Level Up package. Can I do that?
  </div>
</div>
<div class="row">
  <div class="col">
Please <a href="contact.php"> contact us </a> to know more about upgrading packages.
  </div>
</div>

<div class="row tableTitle mt-4 mb-1">
  <div class="col">
Is my package valid for the duration of the plan mentioned while purchasing?
  </div>
</div>
<div class="row">
  <div class="col mb-3">
Yes, the package bought is valid for the duration of the plan mentioned at the time of purchase and the number of sessions will need to be consumed within the mentioned duration. For example, if you buy a monthly package on the 10th of Nov then the package with 20 sessions is valid till the 9th of Dec. Incase, you need further clarification, please feel free to <a href="contact.php"> contact us </a>.
  </div>
</div>



</div>

<?php
  require "footer.php";
?>
