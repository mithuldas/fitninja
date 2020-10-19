<?php

require 'dbh.php';
require 'send_verification_email.php';

// username validation
if(isset($_POST['username_check'])){
  $username = $_POST['username'];



  // check if username exists
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
      echo "taken";
      exit();
    }
  }

  // check if username is too short
  $length = strlen($username);
  $validLength = false;

  if($length>=6){
    $validLength = true;
  }

  if($validLength == false){
    echo "invalidLength";
    exit();
  }

  // check if username has valid characters
  $validChars = false;
  if(preg_match("/^[a-zA-Z0-9._]*$/", $username)){
    $validChars = true;
  }

  if($validChars == false ){
    echo "invalidCharacters";
    exit();
  }
}

// e-mail validation
if(isset($_POST['email_check'])){
  $email = $_POST['email'];
  // basic validation

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "invalidEmail";
    exit();
  }

  $sql = "SELECT username from users where email=? and email_verified=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "sqlerror";
      exit();
    }
    else {
      $verified="Y";
      mysqli_stmt_bind_param($stmt, "ss", $email, $verified);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck=mysqli_stmt_num_rows($stmt);
      if($resultCheck > 0) {
        echo "emailExists";
        exit();
      }
	}
}

// Password validations
if(isset($_POST['password_check'])){

  $password = $_POST['password'];

  // check if min 8 characters
  $length = strlen($password);
  $validLength = false;
  if($length>=8){
    $validLength = true;
  }
  if($validLength == false){
    echo "invalidPasswordLength";
    exit();
  }

  // check if uppercase, lower case and a number exists
  $containsLowerCase  =   preg_match('/[a-z]/',       $password);
  $containsUpperCase  =   preg_match('/[A-Z]/',       $password);
  $containsDigit   =      preg_match('/\d/',          $password);

  $containsAll = $containsLowerCase && $containsUpperCase && $containsDigit;

  if(!$containsAll){
    echo "complexityFailed";
  }
}

// password repeat validation
if(isset($_POST['passwordRepeat_check'])){

  $passwordRepeat = $_POST['passwordRepeat'];
  $password = $_POST['password'];
  if ($passwordRepeat!=$password){
    echo "mismatch";
  }

}

// form submission
if(isset($_POST['save'])){
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // delete existing unverified user and any tokens first before inserting
  $sql = "delete from tokens where email=?";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)) {
    echo "sqlerror";
    exit();
  }
  else{
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
  }

  $sql = "delete from users where email=?";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)) {
    echo "sqlerror";
    exit();
  }
  else{
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
  }

  $sql = "insert into users (username, email, user_type_id, password, email_verified) values (?, ?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)) {
    echo "sqlerror";
    exit();
  }
  else{
    $emailVerified = "N";
    $userType="2";
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $userType, $hashedPwd, $emailVerified );
    mysqli_stmt_execute($stmt);

    sendVerificationEmail($email);
    echo "success";

  }
}

?>
