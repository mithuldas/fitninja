<<?php

if(isset($_POST['pwd-change'])){

  $selector = $_POST["selector"];
  $validator = $_POST["validator"];
  $password = $_POST["pwd"];
  $passwordRepeat = $_POST["pwd-repeat"];

  if(empty($password) || empty($passwordRepeat)) {
    header("Location: ../create-new-password.php?newpwd=empty&selector=" . $selector . "&validator=" . $validator);
    exit();
  } else if ($password != $passwordRepeat) {
    header("Location: ../create-new-password.php?newpwd=pwdnotsame&selector=" . $selector . "&validator=" . $validator);
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
      header("Location: ../forgot-password.php?invalidlink");
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

            $sql =  "update users set password = ? where email = ?";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
              echo "There was an error!";
              exit();
            } else {

              $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
              mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
              mysqli_stmt_execute($stmt);


              $sql = "delete from tokens where email = ? and type = 'pwd_reset';";
              $stmt = mysqli_stmt_init($conn);

              if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "There was an error!";
                exit();
              } else {

                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                mysqli_stmt_execute($stmt);
                header("Location: ../login.php?newpwd=passwordupdated");



              }
            }

          }

        }
      }
    }
  }

} else {
  header("Location: ../index.php");
}

?>
