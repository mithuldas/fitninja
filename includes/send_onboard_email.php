<?php

require 'token_generator.php';
require 'send_email.php';
require 'dbh.php';

if (isset($_POST["onboard_new"])){
  if($_POST["type"]=="Trainer"){
      $tokenType = 'onboard_trainer';
  } else if ($_POST["type"]=="Admin"){
      $tokenType = 'onboard_admin';
  }
  $tokenDuration =  7200; // seconds (2 hours)

  $userEmail = $_POST["email"];
  $userType = $_POST["type"];


  // generate token and save it
  $tokenString = getTokenStringForURL($userEmail, $tokenType, $tokenDuration);
  $baseURL = "http://localhost/onboard_landing.php";
  $url = $baseURL . "?" . $tokenString . "&email=" . $userEmail . "&type=" .$userType;

  // create the e-mail content
  $subject = 'Welcome to FitNinja!';
  $message = '<p>Click the link below to start your onboarding steps: </p>';
  $message .= '<p><a href="' . $url . '">' . $url . '</a> </p>';
  $message .= 'Regards,<br>' . 'The FitNinja Team';

  //  use mailgun.com API to send the e-mail
  sendEmail($userEmail, $subject, $message, $message);

  // redirect user to the forgot password for further handling
  header("Location: ../admin_landing.php?status=onboard_sent&email=" . $userEmail);
}

else{
  header("Location: ../index.php");
}
