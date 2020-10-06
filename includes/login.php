<?php

if (isset($_POST['login-submit'])) {

  require 'dbh.php';

  $mailuid = $_POST['mailuid'];
  $password= $_POST['pwd'];

  if ( empty($mailuid) || empty($password)) {
    header("Location: ../?error=emptyfields");
  }
  else {
    $sql = "select * from users where username=? OR email=?; ";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../index.php?error=sqlerror");
    }
    else{
      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)){
        $pwdCheck = password_verify($password, $row['password']);
        if ($pwdCheck == false){
          header("Location: ../login.php?error=wrongpwd");
          exit();
        }
        else if($pwdCheck == true) {
          session_start();
          $_SESSION[uid] = $row['uid'];
          $_SESSION[username] = $row['username'];
          header("Location: ../index.php?login_success");
          exit();
        }

        else{
          header("Location: ../index.php?error=wrongpwd");

       }
      }
      else{
       header("Location: ../index.php?error=nouser");
       exit();
      }

    }
  }
}
else{
  header("Location: ../index.php");
  exit();

}