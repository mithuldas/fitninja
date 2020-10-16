<?php

if (isset($_POST['login-submit'])) {

  require 'dbh.php';

  $mailuid = $_POST['mailuid'];
  $password= $_POST['pwd'];

  if ( empty($mailuid) || empty($password)) {
    header("Location: ../?error=emptyfields");
  }
  else {
    $sql = "select * from users, user_types where (username=? OR email=?) and users.user_type_id=user_types.user_type_id; ";
    $stmt = mysqli_stmt_init($conn);


    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../index.php?error=sqlerror");
    }
    else{
      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)){

        $email=$row['email'];
        $pwdCheck = password_verify($password, $row['password']);

        if ($pwdCheck == false){
          header("Location: ../login.php?error=wrongpwd");
          exit();
        }
        else if($pwdCheck == true) {
          $verificationStatus = $row['email_verified'];
          if($verificationStatus=="Y"){
            session_start();
            $_SESSION[uid] = $row['uid'];
            $_SESSION[username] = $row['username'];
            $_SESSION[userType] = $row['user_type_desc'];
            header("Location: ../landing.php");
            exit();
          } else {
            header("Location: ../login.php?email=" . $email . "&status=verify_email");
          }

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
