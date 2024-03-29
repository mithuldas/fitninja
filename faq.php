<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> Frequently Asked Questions - FuNinja </title>
  <?php
  require ROOT_DIR."/includes/frameworks.php";
  ?>
</head>

<body>
<?php
include ROOT_DIR."/header.php";
?>

<div class="container pb-4">

  <div class="row mt-3">
    <div class="col">
  <center><h4>Frequently Asked Questions</h4></center>
  <center><small>If your question isn't listed here, please <a href="contact.php"> contact us</a> directly.</small></center>
    </div>
  </div>



    <div class="row mt-4">

        <div class="col-lg-12 pb-4">
            <div class="tab-content" id="faq-tab-content">
                <div class="tab-pane show active dashCard" id="tab1" role="tabpanel" aria-labelledby="tab1">
                    <div class="accordion" id="accordion-tab-1">
                        <div class="card">
                            <div class="card-header faqHeader" id="accordion-tab-1-heading-1">
                                <h5>
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-1" aria-expanded="false" aria-controls="accordion-tab-1-content-1">What is FuNinja?</button>
                                </h5>
                            </div>
                            <div class="collapse" id="accordion-tab-1-content-1" aria-labelledby="accordion-tab-1-heading-1" data-parent="#accordion-tab-1">
                                <div class="card-body faqBody">
                                    FuNinja is an online platform that delivers personal training that is completely customized to suit your needs and schedule. FuNinja offers varied workout formats and membership plans for you to choose from.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header faqHeader" id="accordion-tab-1-heading-2">
                                <h5>
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-2" aria-expanded="false" aria-controls="accordion-tab-1-content-2">Can I pick a Couple plan only with my spouse or can it be a friend/relative too?</button>
                                </h5>
                            </div>
                            <div class="collapse" id="accordion-tab-1-content-2" aria-labelledby="accordion-tab-1-heading-2" data-parent="#accordion-tab-1">
                                <div class="card-body faqBody">
                                    The Couple plan can be picked with anyone you would like to train with, be it your spouse, friend or family member. As part of the package, you will be training at the same time in a single session with the same trainer. Feel free to <a href="contact.php"> contact us </a> incase you have any questions.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header faqHeader" id="accordion-tab-1-heading-3">
                                <h5>
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-3" aria-expanded="false" aria-controls="accordion-tab-1-content-3">Is my personal data like Phone Number and Email ID secure on FuNinja?</button>
                                </h5>
                            </div>
                            <div class="collapse" id="accordion-tab-1-content-3" aria-labelledby="accordion-tab-1-heading-3" data-parent="#accordion-tab-1">
                                <div class="card-body faqBody">
                                    Yes, all your personal data is encrypted and stored securely. We comply with industry regulatory requirements to ensure your personal details are safe.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header faqHeader" id="accordion-tab-1-heading-4">
                                <h5>
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-4" aria-expanded="false" aria-controls="accordion-tab-1-content-4">What is the duration of each session?</button>
                                </h5>
                            </div>
                            <div class="collapse" id="accordion-tab-1-content-4" aria-labelledby="accordion-tab-1-heading-4" data-parent="#accordion-tab-1">
                                <div class="card-body faqBody">
                                    Each session will be curated to suit your needs and will last 55 minutes.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header faqHeader" id="accordion-tab-1-heading-5">
                                <h5>
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-5" aria-expanded="false" aria-controls="accordion-tab-1-content-5">Which Online platform is used to conduct the sessions online?</button>
                                </h5>
                            </div>
                            <div class="collapse" id="accordion-tab-1-content-5" aria-labelledby="accordion-tab-1-heading-5" data-parent="#accordion-tab-1">
                                <div class="card-body faqBody">
                                    You will need the Zoom Application or a browser that supports Zoom to enter your Fitness Room once a session has been scheduled.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header faqHeader" id="accordion-tab-1-heading-6">
                                <h5>
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-6" aria-expanded="false" aria-controls="accordion-tab-1-content-6">Do I need a Zoom account to attend the training sessions?</button>
                                </h5>
                            </div>
                            <div class="collapse" id="accordion-tab-1-content-6" aria-labelledby="accordion-tab-1-heading-6" data-parent="#accordion-tab-1">
                                <div class="card-body faqBody">
                                    No , you will not need a Zoom Account to attend the session. FuNinja will share a link to the Fitness Room 30 minutes prior to the scheduled session.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header faqHeader" id="accordion-tab-1-heading-7">
                                <h5>
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-7" aria-expanded="false" aria-controls="accordion-tab-1-content-7">Is it possible for me to request for changes to my workout plan while my plan is active?</button>
                                </h5>
                            </div>
                            <div class="collapse" id="accordion-tab-1-content-7" aria-labelledby="accordion-tab-1-heading-7" data-parent="#accordion-tab-1">
                                <div class="card-body faqBody">
                                    Yes, it is possible to change the workout plan at anytime during the validity of your package. The changes will be worked through with you, your assigned trainer and a FuNinja Fitness Manager.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header faqHeader" id="accordion-tab-1-heading-8">
                                <h5>
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-8" aria-expanded="false" aria-controls="accordion-tab-1-content-8">Can I pick the days I would want to train or is that something the trainer will decide?</button>
                                </h5>
                            </div>
                            <div class="collapse" id="accordion-tab-1-content-8" aria-labelledby="accordion-tab-1-heading-8" data-parent="#accordion-tab-1">
                                <div class="card-body faqBody">
                                    You are free to decide your training days and timing since we offer customized schedules to suit your needs and requirements.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header faqHeader" id="accordion-tab-1-heading-9">
                                <h5>
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-9" aria-expanded="false" aria-controls="accordion-tab-1-content-9">I bought a Basic package and would like to upgrade to the Level Up package. Can I do that?</button>
                                </h5>
                            </div>
                            <div class="collapse" id="accordion-tab-1-content-9" aria-labelledby="accordion-tab-1-heading-9" data-parent="#accordion-tab-1">
                                <div class="card-body faqBody">
                                    Please <a href="contact.php"> contact us </a> to know more about upgrading packages..
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header faqHeader" id="accordion-tab-1-heading-10">
                                <h5>
                                    <button class="btn" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-10" aria-expanded="false" aria-controls="accordion-tab-1-content-10">Is my package valid for the duration of the plan mentioned while purchasing?</button>
                                </h5>
                            </div>
                            <div class="collapse" id="accordion-tab-1-content-10" aria-labelledby="accordion-tab-1-heading-10" data-parent="#accordion-tab-1">
                                <div class="card-body faqBody">
                                    Yes, the package bought is valid for the duration of the plan mentioned at the time of purchase and the number of sessions will need to be consumed within the mentioned duration. For example, if you buy a monthly package on the 10th of Nov then the package with 20 sessions is valid till the 9th of Dec. Incase, you need further clarification, please feel free to <a href="contact.php"> contact us </a>.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>


    </div>
    </div>

    <script>
    // set active link display in the menu bar
    $('.faqLink').addClass("activeMenuLink");
    </script>
<?php
  require "footer.php";
?>
