<?php

include "../classes/Password.php";

if(!isset($_SESSION)){
  session_start();
}

// called by "change password" option in the settings/profile screen for in-house account users
if(isset($_POST['changepwd-submit'])){

  $password = $_POST["oldpwd"];
  $newPassword = $_POST["newpwd"];
  $passwordRepeat = $_POST["newpwdrepeat"];

  $passwordObject = new Password($newPassword, $passwordRepeat);

  if($passwordObject->hasEmptyFields()) {
    header("Location: ../settings.php?status=emptyfields");
    exit();
  } else if (!$passwordObject->doesMatch()) {
    header("Location: ../settings.php?status=pwdMismatch");
    exit();
  } else if (!$passwordObject->isLongEnough()){
    header("Location: ../settings.php?status=tooShort");
    exit();
  }

  require 'dbh.php';

  // check if the old password matches (also adding source="Web" validation, don't want FB/Google users somehow putting a req in)
  $sql = "select * from users where uid=? and source = ?";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "sqlerror";
    exit();
  }
  else{
    $source = "Web";
    $uid = $_SESSION['uid'];

    mysqli_stmt_bind_param($stmt, "ss", $uid, $source);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)){

      $pwdCheck = password_verify($password, $row['password']);

      if ($pwdCheck == false){
        header("Location: ../settings.php?status=wrongPassword");
        exit();
      }
      else if($pwdCheck == true) {
        $sql =  "update users set password = ? where uid = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
          echo "There was an error!";
          exit();
        } else {
          $newPwdHash = password_hash($newPassword, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $uid);
          mysqli_stmt_execute($stmt);
          header("Location: ../settings.php?status=passwordupdated");
        }
      }
    }
  }
}

?>
