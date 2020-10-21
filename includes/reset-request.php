<?php

require 'token_generator.php';
require 'send_email.php';
require 'dbh.php';

if (isset($_POST["resetpwd-submit"])){

  $tokenDuration =  7200; // seconds (2 hours)
  $tokenType = 'pwd_reset'; // store in DB as pwd_reset i.s.o email_verify
  $mailuid = $_POST["mailuid"];

  // check if the e-mail / userid exists

  $sql = "select * from users, user_types where (username=? OR email=?) and users.user_type_id=user_types.user_type_id; ";
  $stmt = mysqli_stmt_init($conn);


  if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "sqlerror";
    exit();
  }
  else{
    mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // user exists, proceed, else go to else block
    if ($row = mysqli_fetch_assoc($result)){
      // generate token and save it
      $email = $row['email'];;
      $username = $row['username'];;
      $tokenString = getTokenStringForURL($email, $tokenType, $tokenDuration);
      $baseURL = "http://localhost/create-new-password.php";
      $url = $baseURL . "?" . $tokenString;

      // create the e-mail content
      $subject = 'Reset your FitNinja password';
      $message =  '<p> Hello, </p>';
      $message .= '<p>Please click the link below to reset your password: </p>';
      $message .= '<p><a href="' . $url . '">' . $url . '</a> </p>';
      $message .= 'Regards,<br>' . 'The FitNinja Team';

      //  use mailgun.com API to send the e-mail
      sendEmail($email, $subject, $message, $message);

      // redirect user to the forgot password for further handling
      header("Location: ../forgot-password.php?reset=success&email=" . $email . "&username=" . $username);

    } else {
      header("Location: ../forgot-password.php?reset=nouser&mailuid=" . $mailuid);
    }
  }
}
