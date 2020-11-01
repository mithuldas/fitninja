<?php

class Token {

  static function getTokenStringForURL($userEmail, $tokenType, $tokenDuration, $conn){
    // generate the token string to return
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $tokenStringForURL = "selector=" . $selector . "&validator=" . bin2hex($token);

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
    return $tokenStringForURL;

  }

  static function getTokenStringForCookie($userEmail, $tokenType, $conn){
    // generate the token string to return
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $tokenDuration = 7776000; // 90 days
    $tokenStringForCookie = $selector.":".bin2hex($token); // selector:bin2hex(validator) stored in login cookie

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
    return $tokenStringForCookie;
  }

  static function tokenIsValid($selector, $validator, $conn){

    $sql = "select * from tokens where selector=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "There was an error!";
      exit();
    } else {

      mysqli_stmt_bind_param($stmt, "s", $selector);
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

  static function deleteToken($selector, $conn){
    $email = self::getUserEmailFromSelector($selector, $conn);
    $sql = "delete from tokens where (email='".$email. "') and (selector='".$selector. "');" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "sqlerror";
      exit();
    } else{
      mysqli_stmt_execute($stmt);
    }
  }

  static function getRenewedToken($userEmail, $selector, $tokenType, $conn){
    self::deleteToken($selector, $conn);
    $newTokenString = self::getTokenStringForCookie($userEmail, $tokenType, $conn);
    return $newTokenString;
  }

  static function getUserEmailFromSelector($selector, $conn){

    $sql = "select * from tokens where selector= '".$selector. "';";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "sqlerror";
      exit();
    }
    else{
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)){
        return($row['email']);
      }
    }
  }

  static function getTokenType($selector, $conn){
    $sql = "select * from tokens where selector= '".$selector. "';";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "sqlerror";
      exit();
    }
    else{
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)){
        return($row['type']);
      }
    }
  }
}
?>
