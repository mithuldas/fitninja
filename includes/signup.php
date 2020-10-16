<?php

require 'send_verification_email.php';

error_reporting(E_ALL);
ini_set('display_errors', 'On');



if(isset($_POST['signup-submit'])) {
require 'dbh.php';

$username = $_POST['uid'];
$email = $_POST['email'];
$password = $_POST['pwd'];
$passwordRepeat = $_POST['pwd-repeat'];

  if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../signup.php?error=emptyfields&uid=".$username."&email=".$email);
    exit();
  }

  else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?error=invalidemailusername");
    exit();
  }

  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidemail&uid=".$username);
    exit();
  }

  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: ../signup.php?error=invalidusername&email=".$email);
    exit();
  }

  else if ($password!==$passwordRepeat){
    header("Location: ../signup.php?error=passwordcheck&uid=".$username."&email=".$email);
    exit();
  }

// check if username is taken, regardless of whether e-mail verification has been completed

    $sql = "SELECT username from users where username=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../signup.php?error=1sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck=mysqli_stmt_num_rows($stmt);
      if($resultCheck > 0) {
        header("Location: ../signup.php?error=username_taken&username=".$username);
        exit();
	}
	}


// check if a user with verified e-mail ID already exists

    $sql = "SELECT username from users where email=? and email_verified=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../signup.php?error=1sqlerror");
      exit();
    }
    else {
      $verified="Y";
      mysqli_stmt_bind_param($stmt, "ss", $email, $verified);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck=mysqli_stmt_num_rows($stmt);
      if($resultCheck > 0) {
        header("Location: ../signup.php?error=emailexists&email=".$email);
        exit();
      }

      else {



        // delete existing unverified user and any tokens first before inserting

        $sql = "delete from tokens where email=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "s", $email);
          mysqli_stmt_execute($stmt);
        }

        $sql = "delete from users where email=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "s", $email);
          mysqli_stmt_execute($stmt);
        }

        $sql = "insert into users (username, email, user_type_id, password, email_verified) values (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }
        else{
          $emailVerified = "N";
          $userType="2";
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $userType, $hashedPwd, $emailVerified );
          mysqli_stmt_execute($stmt);

          sendVerificationEmail($email);

        }
      }


    }


}
else{
  header("Location: ../signup.php");
  exit();

}
