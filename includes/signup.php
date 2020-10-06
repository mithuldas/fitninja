<?php

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

// check if user already exists
  else {
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
        header("Location: ../signup.php?error=userexists&email=".$email);
        exit();
      }

      else {
        $sql = "insert into users (username, email, user_type, password) values (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../signup.php?error=2sqlerror");
          exit();
        }
        else{

          $userType="C";
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $userType, $hashedPwd );
          mysqli_stmt_execute($stmt);
          header("Location: ../signup.php?signup=success");
          exit();
        }
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

}
else{
  header("Location: ../signup.php");
  exit();

}
