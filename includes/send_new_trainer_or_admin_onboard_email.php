<?php

include "../config.php";
require_once( ROOT_DIR.'/classes/Token.php' );

require 'send_email.php';
require 'dbh.php';

// check if the request is for a new trainer or a new admin
if (isset($_POST["onboard_new_trainer_or_admin"])){
  if($_POST["type"]=="Trainer"){
      $tokenType = 'onboard_trainer';
  } else if ($_POST["type"]=="Admin"){
      $tokenType = 'onboard_admin';
  }
  $tokenDuration =  7200; // seconds (2 hours)

  $userEmail = $_POST["email"];
  $userType = $_POST["type"];

  // check if the e-mail has already been taken

  $sql = "SELECT username from users where email=? and email_verified=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "sqlerror";
      exit();
    }
    else {
      $verified="Y";
      mysqli_stmt_bind_param($stmt, "ss", $userEmail, $verified);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck=mysqli_stmt_num_rows($stmt);
      if($resultCheck > 0) {
        header("Location: ../onboard_new_trainer_or_admin.php?status=emailtaken&email=" . $userEmail."&type=".$_POST["type"]);
        exit();
      } else {
        // generate token and save it

        $tokenString = Token::getTokenStringForURL($userEmail, $tokenType, $tokenDuration, $conn);
        $baseURL = "https://FuNinja.in/new_trainer_or_admin_onboard_email_landing.php";
        $url = $baseURL . "?" . $tokenString . "&email=" . $userEmail . "&type=" .$userType;

        // create the e-mail content
        $subject = 'Welcome to FuNinja!';
        $message = '<p>Click the link below to start your onboarding steps: </p>';
        $message .= '<p><a href="' . $url . '">' . $url . '</a> </p>';
        $message .= 'Regards,<br>' . 'The FuNinja Team';

        //  use mailgun.com API to send the e-mail
        sendEmail($userEmail, $subject, $message, $message);

        // redirect user to the forgot password for further handling
        header("Location: ../admin_dashboard.php?status=onboard_sent&email=" . $userEmail);
        exit();
      }
	}
}

else{
  header("Location: ../post_login_landing_controller.php?status=badrequest");
  exit();
}
