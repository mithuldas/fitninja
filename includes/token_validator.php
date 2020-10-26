<?php

function tokenIsValid($selector, $validator, $tokenType, $conn){

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
      return false;
    }

    else {

      $tokenBin = hex2bin($validator);
      $tokenCheck = password_verify($tokenBin, $row["token"]);

      if ($tokenCheck===false) {
        return false;
      } elseif ($tokenCheck===true) {
        return true;
      }
    }
  }
}



?>
