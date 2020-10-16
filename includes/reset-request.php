<?php

require 'token_generator.php';
require 'send_email.php';

if (isset($_POST["resetpwd-submit"])){

  $tokenDuration =  7200; // seconds (2 hours)
  $tokenType = 'pwd_reset'; // store in DB as pwd_reset i.s.o email_verify
  $userEmail = $_POST["email"];

  // generate token and save it
  $tokenString = getTokenStringForURL($userEmail, $tokenType, $tokenDuration);
  $baseURL = "http://localhost/create-new-password.php";
  $url = $baseURL . "?" . $tokenString;

  // create the e-mail content
  $subject = 'Reset your FitNinja password';
  $message = '<p>Please click the link below to reset your password: </p>';
  $message .= '<p><a href="' . $url . '">' . $url . '</a> </p>';
  $message .= 'Regards,<br>' . 'The FitNinja Team';

  //  use mailgun.com API to send the e-mail
  sendEmail($userEmail, $subject, $message, $message);

  // redirect user to the forgot password for further handling
  header("Location: ../forgot-password.php?reset=success");
}

else{
  header("Location: ../forgot-password.php");
}
