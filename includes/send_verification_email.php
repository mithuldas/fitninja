<?php
require 'send_email.php';
require 'token_generator.php';

function sendVerificationEmail($email){

  // generate token and save it
  $tokenDuration =  7200; // seconds (2 hours)
  $tokenType = 'verify_email'; // store in DB as pwd_reset i.s.o email_verify
  $tokenString = getTokenStringForURL($email, $tokenType, $tokenDuration);
  $baseURL = "http://localhost/verify_email.php";
  $url = $baseURL . "?" . $tokenString;

  // create the e-mail content
  $subject = 'Confirm Your Email and Get Started ';
  $message = '<p>Let us know if this is really your email address, to help us keep your account secure.<br><br>Confirm your email and let’s get started! </p>';
  $message .= '<p><a href="' . $url . '">' . $url . '</a> </p>';
  $message .= 'Regards,<br>' . 'The FitNinja Team';

  $to = $email;

  sendEmail($to, $subject, $message, $message);

  header("Location: ../signup.php?status=verify_email");
  exit();
}

?>
