<?php

include_once (__DIR__.'/config.php');
require_once (ROOT_DIR.'/includes/dbh.php');
include_once (ROOT_DIR.'/includes/autoloader.php');

$selector = $_GET["selector"];
$validator = $_GET["validator"];

$currentDate = date("U");
$tokenType = "verify_email";

$sql = "select * from tokens where selector=? and type=?;";
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)){
  echo "There was an error!";
  exit();
} else {

  mysqli_stmt_bind_param($stmt, "ss", $selector, $tokenType);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  if (!$row = mysqli_fetch_assoc($result)) {
    header("Location: verify_email.php?invalidlink");
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

      $sql = "update users set email_verified='Y' where email=?;";
      $stmt = mysqli_stmt_init($conn);

      if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error!";
        exit();
      } else {
        mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
        mysqli_stmt_execute($stmt);



        $sql = "delete from tokens where email = ? and type = 'verify_email';";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
          echo "There was an error!";
          exit();
        } else {

          mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
          mysqli_stmt_execute($stmt);

          $sql = "select * from users, user_types where (email=?) and users.user_type_id=user_types.user_type_id";
          $stmt = mysqli_stmt_init($conn);

          if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "There was an error!";
            exit();
          } else {

            mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if (!$row = mysqli_fetch_assoc($result)) {
              header("Location: verify_email.php?invalidlink");
              exit();
            }
            else {
              session_start();
              $_SESSION['uid'] = $row['uid'];
              $_SESSION['username'] = $row['username'];
              $_SESSION['userType'] = $row['user_type_desc'];
            }

          $split_names = explode('@', $tokenEmail, 2);
          Email::sendTraineeWelcomeEmail($split_names[0], $tokenEmail);
          header("Location: ./includes/post_login_landing_controller.php");
          exit();



            }
          }
      }
    }
  }
}
?>
