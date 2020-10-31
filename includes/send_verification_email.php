<?php
require 'send_email.php';
include "../config.php";
require_once ( ROOT_DIR.'/classes/Token.php' );


function sendVerificationEmail($email){
  include "dbh.php";
  // generate token and save it
  $tokenDuration =  7200; // seconds (2 hours)
  $tokenType = 'verify_email'; // store in DB as pwd_reset i.s.o email_verify
  $tokenString = Token::getTokenStringForURL($email, $tokenType, $tokenDuration, $conn);
  $baseURL = "https://FuNinja.in/verify_email.php";
  $url = $baseURL . "?" . $tokenString;

  // create the e-mail content
  $subject = 'Confirm Your Email and Get Started ';
  $message = '<p>Let us know if this is really your email address, to help us keep your account secure.<br><br>Confirm your email and let’s get started! </p>';
  $message .= '<p><a href="' . $url . '">' . $url . '</a> </p>';
  $message .= 'Regards,<br>' . 'The FuNinja Team';

  $to = $email;

  sendEmail($to, $subject, $message, $message);

  exit();
}

?>
