<?php

include_once "dbh.php";

// if user isn't logged, check if a valid cookie exists and auto-login
if(!isset($_SESSION['uid']) && isset($_COOKIE['FuNinja'])){

  $extractDataFromCookie = explode(':', $_COOKIE["FuNinja"], 2);

  $selector = $extractDataFromCookie[0] ;
  $validator =  $extractDataFromCookie[1];

  $tokenType = Token::getTokenType($selector, $conn);


  if(Token::tokenIsValid($selector, $validator, $conn)){
    // fetch user data from DB and start a logged in session
    $email = Token::getUserEmailFromSelector($selector, $conn);

    if($tokenType=="funinja_login"){
      $sql = "select * from users, user_types where (email='".$email."') and users.user_type_id=user_types.user_type_id; ";

      $stmt = mysqli_stmt_init($conn);

      if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "sqlerror";
        exit();
      }
      else{
        $source = "Web";
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)){
          $email=$row['email'];
          $_SESSION['uid'] = $row['uid'];
          if($row['source']=="Web"){
            $_SESSION['username'] = $row['username'];
          } else {
            $_SESSION['username'] = $row['ext_name'];
          }

          $_SESSION['userType'] = $row['user_type_desc'];

          //renew the token - i.e: delete the current token and create a new one
          $newCookieString = Token::getRenewedToken($email, $selector, $tokenType, $conn); // passing existing selector
          setcookie("FuNinja", $newCookieString, time() + 7776000, '/', null);
        }
      }
    }
  }
}
?>
