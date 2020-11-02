<?php

include_once (__DIR__.'/../config.php');
require_once (ROOT_DIR.'/includes/dbh.php');
include_once (ROOT_DIR.'/includes/autoloader.php');

// username validation
if(isset($_POST['username_check'])){
  $username = $_POST['username'];



  // check if username exists
  $sql = "SELECT username from users where username=? and email_verified='Y'";
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

  $sql = "SELECT username from users where email=? and email_verified=? and source='Web'";
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
}


// password repeat validation
if(isset($_POST['passwordRepeat_check'])){

  $passwordRepeat = $_POST['passwordRepeat'];
  $password = $_POST['password'];
  if ($passwordRepeat!=$password){
    echo "mismatch";
  }

}

if(isset($_POST['save'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // if the email already exists (i.e, user had already logged in via fb or google)
    // don't actually create a new user, BUT, change the username, password and source

    $sql = "SELECT * from users, user_types where email=? and (source is null or source<>'Web') and users.user_type_id=user_types.user_type_id;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "sqlerror";
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)){ // i.e non facebook or google login user already exists

        // merge the accounts
          //update username to actual username
          // set a proper password
          // set source to Web
          // login

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users set username=?, password=?, source='Web' where email=? and (source is null or source<>'Web')";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          echo "sqlerror";
          exit();
        }
        else {
          mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $email);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);

          // set the user sessions before transferring control back to the register form for redirection
          if(!isset($_SESSION)){
            session_start();
          }
          $_SESSION['uid'] = $row['uid'];
          $_SESSION['username'] = $username;
          $_SESSION['userType'] = $row['user_type_desc'];
          // remember login
          $cookieString = Token::getTokenStringForCookie($email, "funinja_login", $conn);
          setcookie("FuNinja", $cookieString, time() + 7776000, '/', null);
          echo "mergeSuccess";
          exit();
        }

      } else {
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

        $sql = "insert into users (username, email, user_type_id, password, email_verified, source) values (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          echo "sqlerror";
          exit();
        }
        else{
          $emailVerified = "N";
          $userType="2";
          $source = "Web";
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "ssssss", $username, $email, $userType, $hashedPwd, $emailVerified, $source );
          mysqli_stmt_execute($stmt);

          Email::sendVerificationEmail($email);
          echo "success";

        }
      }
  }
}

?>
