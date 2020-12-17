<?php
include_once "../config.php";

require_once ( ROOT_DIR.'/classes/Token.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );


if (isset($_POST['login-submit'])) {

  $remember_me = $_POST['remember-me'];
  $mailuid = $_POST['mailuid'];
  $password= $_POST['password'];

  if ( empty($mailuid) || empty($password)) {
    echo "emptyfields";
    exit();
  }
  else {
    $sql = "select * from users, user_types where (username=? OR email=?) and source = ? and users.user_type_id=user_types.user_type_id; ";
    $stmt = mysqli_stmt_init($conn);


    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "sqlerror";
      exit();
    }
    else{
      $source = "Web";
      mysqli_stmt_bind_param($stmt, "sss", $mailuid, $mailuid, $source);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)){

        $email=$row['email'];
        $pwdCheck = password_verify($password, $row['password']);

        if ($pwdCheck == false){
          echo "wrongpassword";
          exit();
        }
        else if($pwdCheck == true) {
          $verificationStatus = $row['email_verified'];
          if($verificationStatus=="Y"){
            session_start();
            $_SESSION['uid'] = $row['uid'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['userType'] = $row['user_type_desc'];
            $_SESSION['authenticationType'] = "Web";
            echo "success";

            // if remember me is checked, then create a cookie and store it in the DB before returning control back
            if($remember_me=="true"){
              $cookieString = Token::getTokenStringForCookie($email, "funinja_login", $conn);
              setcookie("FuNinja", $cookieString, time() + 7776000, '/', null);
            }
            exit();
          } else {
            echo "verifyemail";
          }

        }

        else{
          echo "nomatch";

       }
      }
      else{
       echo "nouser";
       exit();
      }

    }
  }
}
else{
  echo "badrequest";
  exit();

}
