<?php


  function getTokenStringForURL($userEmail, $tokenType, $tokenDuration){

    require 'dbh.php';

    // generate the token string to return
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $tokenForURL = "selector=" . $selector . "&validator=" . bin2hex($token);

    // delete existing tokens for the user and type

    $sql = "delete from tokens where email = ? and type = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "There was an error!";
      exit();
    } else {

      mysqli_stmt_bind_param($stmt, "ss", $userEmail, $tokenType);
      mysqli_stmt_execute($stmt);
    }

    // hash and save token

    $tokenExpiry = date("U") + $tokenDuration;

    $sql = "insert into tokens (email, selector, token, expiry, type)
              values (?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "There was an error!";
      exit();
    } else {
      $hashedToken = password_hash($token, PASSWORD_DEFAULT);

      mysqli_stmt_bind_param($stmt, "sssss", $userEmail, $selector, $hashedToken, $tokenExpiry, $tokenType);
      mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // return the token in URL format to be attached to
    return $tokenForURL;

  }

?>
