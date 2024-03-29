<?php

include_once (__DIR__.'/../config.php');
require_once (ROOT_DIR.'/includes/dbh.php');
include_once (ROOT_DIR.'/includes/autoloader.php');

require 'send_email.php';
require 'dbh.php';

// check if the request is for a new trainer or a new admin
if (isset($_POST["new_trainer_admin"])){
  if($_POST["type"]=="Trainer"){
      $tokenType = 'onboard_trainer';
  } else if ($_POST["type"]=="Admin"){
      $tokenType = 'onboard_admin';
  }

  $zoomID = $_POST['zoomID'];
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
        header("Location: /admin/new_trainer_admin.php?status=emailtaken&email=" . $userEmail."&type=".$_POST["type"]);
        exit();
      }
      else {
        Email::sendTrainerAdminOnboardEmail($tokenType, $userEmail, $userType, $zoomID, $conn);
        // redirect user to the forgot password for further handling
        header("Location: /admin/admin_dashboard.php?status=onboard_sent&email=" . $userEmail);
        exit();
      }
	}
}

else{
  header("Location: ../post_login_landing_controller.php?status=badrequest");
  exit();
}
