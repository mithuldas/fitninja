<?php

include "../classes/Password.php";

if(isset($_POST['pwd-change'])){

  $selector = $_POST["selector"];
  $validator = $_POST["validator"];
  $password = $_POST["pwd"];
  $passwordRepeat = $_POST["pwd-repeat"];

  $passwordObject = new Password($password, $passwordRepeat);

  if($passwordObject->hasEmptyFields()) {
    header("Location: ../create-new-password.php?status=emptyfields=" . $selector . "&validator=" . $validator);
    exit();
  } else if (!$passwordObject->doesMatch()) {
    header("Location: ../create-new-password.php?status=pwdMismatch&selector=" . $selector . "&validator=" . $validator);
    exit();
  } else if (!$passwordObject->isLongEnough()){
    header("Location: ../create-new-password.php?status=tooShort&selector=" . $selector . "&validator=" . $validator);
    exit();
  }

  $currentDate = date("U");

  require 'dbh.php';

  $sql = "select * from tokens where selector=? and expiry >= ?";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "There was an error!";
    exit();
  } else {

    mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate );
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if (!$row = mysqli_fetch_assoc($result)) {
      header("Location: ../create-new-password.php?status=invalidlink");
      exit();
    }

    else {
      $tokenBin = hex2bin($validator);
      $tokenCheck = password_verify($tokenBin, $row["token"]);

      if ($tokenCheck===false) {
        echo "You need to resubmit your reset request";
        exit();
      } elseif ($tokenCheck===true) {
        $tokenEmail = $row['email'];

        $sql = "select * from users where email=?;";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
          echo "There was an error!";
          exit();
        } else {
          mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
          mysqli_stmt_execute($stmt);

          $result = mysqli_stmt_get_result($stmt);
          if (!$row = mysqli_fetch_assoc($result)) {
            echo "There was an error!";
            exit();
          } else {
            $sql =  "update users set password = ?, email_verified = ? where email = ?";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
              echo "There was an error!";
              exit();
            } else {
              $emailVerified = "Y";
              $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
              mysqli_stmt_bind_param($stmt, "sss", $newPwdHash, $emailVerified, $tokenEmail);
              mysqli_stmt_execute($stmt);


              $sql = "delete from tokens where email = ? and type in ('pwd_reset', 'verify_email');";
              $stmt = mysqli_stmt_init($conn);

              if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "There was an error!";
                exit();
              } else {

                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                mysqli_stmt_execute($stmt);
                header("Location: ../create-new-password.php?status=passwordupdated");
                exit();



              }
            }

          }

        }
      }
    }
  }

} else {
  header("Location: ../index.php");
  exit();
}

?>
