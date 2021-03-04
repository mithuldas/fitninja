<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> About - FuNinja </title>
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

$("body").addClass("whiteBackground");

</script>

<div class="container-fluid breadcrumbContiner">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="margin-bottom: 0px; padding-left:0px; padding-top:0px">
      <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">About FuNinja</li>
    </ol>
  </nav>
</div>

<div class="container">
  <div class="row">
    <div class="col pb-2" align="center"><h5> Terms and Conditions </h5>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <p>FuNinja is an online personal training platform that connects trainers with trainees in accordance with the package and workout chosen. This document covers the terms and conditions under which these services are provided.</p>

  <ul>
<li>Your registration as a member of FuNinja or the use of any of the features and services on FuNinja, either as a registered member or as a visitor constitutes automatic acceptance of these terms and conditions.</li>
<li>FuNinja reserves the right to update the terms, conditions and notices of this agreement without notice to you. It is your responsibility to periodically review the most current version of this Agreement.</li>
<li>By accessing or using the Sites, Content, or Services, you agree to be bound by these Terms of Service.</li>
<li>If you do not agree with any of the terms and conditions of FuNinja, do not register and you will not be authorized to use FuNinja services.</li>
<li>The views expressed on the website are not those of FuNinja, and any issues in them belong to the respective contributors.</li>
<li>Through the use of this site, you agree to hold FuNinja harmless and its sponsors, owners, shareholders or employees against any claims.</li>
<li>You are responsible for safeguarding the password that you use to access the Sites, Content and Services. You agree not to disclose your password to any third party. You agree to take sole responsibility for any activities or actions under your password, whether or not you have authorized such activities or actions.</li>
<li>In order to access our Materials, you may be required to provide certain information about yourself (such as identification, contact details, pictures, measurements, food preferences etc.) as part of the registration process, or as part of your ability to use the Materials. You agree that any information you provide will always be accurate, correct, and up to date.</li>
<li>Attempting to copy, duplicate, reproduce, sell, trade, or resell our Materials is strictly prohibited.</li>
<li>You agree to check with your doctor and have it cleared before beginning any new exercise or diet program. The services provided by FuNinja are opinion based and they do not claim to diagnose, treat, or cure any cause, condition or disease. All suggestions provided are for informational purposes only; they are not to be confused with medical advice.</li>
<li>All transactions are made through Razorpay payment gateway . These payment gateways are safe and secure for using all types of credit cards and debit cards in different countries and your details are not stored during this process.</li>
<li>Package sessions must be paid in full prior to having access to the trainer and customized workout plans.</li>
<li>Trainee Dashboard with updated session and schedule informatin is solely meant for the trainee consumption purpose and are not meant for distribution.</li>
<li>The Trainer will use his/her skills and knowledge to design a safe program of workout that will take into account your lifestyle, personal goals, fitness levels and medical history.</li>
<li>The Trainer will provide the coaching, supervision, advice and support that you will need to achieve your goals. Each personal training session will last approximately 55 minutes unless otherwise agreed</li>
<li>You understand that the results of any fitness program cannot be guaranteed. Your progress depends on your effort and co-operation in and outside of the Sessions/Classes</li>
<li>All Client information will be kept strictly private and confidential</li>
<li>It is understood between you and your Trainer that both must commit to your training program 100% in order for you to achieve results</li>
<li>You are required to arrive on time for each Session/Class so that the Trainer’s full training plan is achieved on each visit.</li>
<li>You are required to wear appropriate clothing and footwear.</li>
<li>You understand and agree that it is your responsibility to inform the Trainer of any conditions or changes to your health, now and ongoing, which might affect your ability to exercise safely and with minimal risk of injury.</li>
<li>If your Trainer requires further medical information from a practitioner, you must provide such details.</li>
<li>You understand that there are inherent risks in participating in a program of strenuous exercise. If you sustain or claim to sustain any injury while participating in training, you acknowledge that the Trainer and FuNinja are not responsible.</li>
<li>Your Trainer cannot be held liable in any way for undeclared or unknown medical conditions.</li>
<li>If you bring children or minors to the Session/Class they remain your responsibility throughout and the Trainer cannot be held liable.</li>
<li>Once purchased, your Sessions/Classes are non-refundable and non-transferable.</li>
<li>If the client is late to the Session/Class, FuNinja reserves the right to end the session at the originally scheduled end time.</li>
<li>If the Trainer is late, additional time will be added to the Session/Class or to subsequent Sessions/Classes.</li>
<li>You understand that only in the unlikely event your Trainer is unable to continue your training, you can request a full refund from FuNinja for any unfulfilled Sessions/Classes.</li>
<li>Your training may be filmed or pictures taken for marketing purposes. Your participation in a Session/Class means you consent to photography, filming and sound recording which may include you as a Client and its use in commercial distribution without payment or copyright.</li>
<li>If a trainer decides to leave the training in between due to unforeseen circumstances, you will be assigned a new trainer immediately.</li>
</ul>

    </div>
  </div>

  <div class="row pb-4 pt-4">
    <div class="col pb-2"><center><h5> Contact Information </h5></center>
    <p>If you have any questions or comments about our Terms of Service as outlined above, you can contact us at hello@funinja.in</p>
    </div>
  </div>

</div>

<?php
  require "footer.php";
?>

<script>
// set active link display in the menu bar
$('.aboutLink').addClass("activeMenuLink");


</script>
