<?php

if(isset($_POST['signup-onboard-submit'])) {
require 'dbh.php';

$username = $_POST['uid'];
$email = $_POST['email'];
$password = $_POST['pwd'];
$passwordRepeat = $_POST['pwd-repeat'];
$userType = $_POST['type'];

  if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../new_trainer_or_admin_onboard_email_landing.php?error=emptyfields&uid=".$username."&email=".$email);
    exit();
  }

  else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../new_trainer_or_admin_onboard_email_landing.php?error=invalidemailusername");
    exit();
  }

  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../new_trainer_or_admin_onboard_email_landing.php?error=invalidemail&uid=".$username);
    exit();
  }

  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: ../new_trainer_or_admin_onboard_email_landing.php?error=invalidusername&email=".$email);
    exit();
  }

  else if ($password!==$passwordRepeat){
    header("Location: ../new_trainer_or_admin_onboard_email_landing.php?error=passwordcheck&uid=".$username."&email=".$email);
    exit();
  }

// check if username is taken, regardless of whether e-mail verification has been completed

    $sql = "SELECT username from users where username=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../new_trainer_or_admin_onboard_email_landing.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck=mysqli_stmt_num_rows($stmt);
      if($resultCheck > 0) {
        header("Location: ../new_trainer_or_admin_onboard_email_landing.php?error=username_taken&username=".$username);
        exit();
	     }
	}


// check if a user with verified e-mail ID already exists

    $sql = "SELECT username from users where email=? and email_verified=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../new_trainer_or_admin_onboard_email_landing.php?error=sqlerror");
      exit();
    }
    else {
      $verified="Y";
      mysqli_stmt_bind_param($stmt, "ss", $email, $verified);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck=mysqli_stmt_num_rows($stmt);
      if($resultCheck > 0) {
        header("Location: ../new_trainer_or_admin_onboard_email_landing.php?error=emailexists&email=".$email);
        exit();
      }

        // set the user type for the DB based on the type input
        $sql = "select * from user_types where user_type_desc=?";
        $stmt = mysqli_stmt_init($conn);


        if(!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: ../index.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "s", $userType);
          mysqli_stmt_execute($stmt);

          $result = mysqli_stmt_get_result($stmt);
          if ($row = mysqli_fetch_assoc($result)){

            $userTypeForDB=$row['user_type_id'];
          }


        // delete existing unverified user and any tokens first before inserting

        $sql = "delete from tokens where email=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../new_trainer_or_admin_onboard_email_landing.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "s", $email);
          mysqli_stmt_execute($stmt);
        }

        $sql = "delete from users where email=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../new_trainer_or_admin_onboard_email_landing.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "s", $email);
          mysqli_stmt_execute($stmt);
        }

        $sql = "insert into users (username, email, user_type_id, password, email_verified, source) values (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../new_trainer_or_admin_onboard_email_landing.php?error=sqlerror");
          exit();
        }
        else{
          $emailVerified = "Y";
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
          $source = "Web";
          mysqli_stmt_bind_param($stmt, "ssssss", $username, $email, $userTypeForDB, $hashedPwd, $emailVerified, $source );
          mysqli_stmt_execute($stmt);


          // get the newly created user's uid so that we can use it to start a new session and log the user in
          $sql = "select * from users where username=?";
          $stmt = mysqli_stmt_init($conn);


          if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
          }
          else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)){

              $uid=$row['uid'];
            }

          // start the session so that the landing page can forward appropriately
          session_start();
          $_SESSION['uid'] = $uid;
          $_SESSION['username'] = $username;
          $_SESSION['userType'] = $userType;

          header("Location: ../includes/post_login_landing_controller.php?status=onboarded");
          exit();
        }
        }
      }


    }


}
else{
  header("Location: ../new_trainer_or_admin_onboard_email_landing.php");
  exit();

}
