<?php

include_once (__DIR__.'/../config.php');
require_once (ROOT_DIR.'/includes/dbh.php');
include_once (ROOT_DIR.'/includes/autoloader.php');

if (isset($_POST['externalLogin'])){

  $emailReceived = $_POST['emailReceived'];
  $vendor = $_POST['vendor'];
  $email = $_POST['email'];
  $name = $_POST['name'];
  $id = $_POST['id'];
  $split_names = explode(' ', $name, 2);
  $firstName = $split_names[0];


  // facebook stream
  if($vendor =='facebook'){
    $username = "FB" . $id; // artifical id stored in the username, email and password fields

    if($emailReceived =="true"){
      // check if user with this e-mail exists (ext email id) and source =

      $sql = "select * from users, user_types where email=? and users.user_type_id=user_types.user_type_id; ";
      $stmt = mysqli_stmt_init($conn);

      if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "sqlerror";
        exit();
      }
      else{
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        // if exists, log the user in and send to landing page
        if ($row = mysqli_fetch_assoc($result)){
          session_start();
          $_SESSION['uid'] = $row['uid'];
          $_SESSION['username'] = $firstName;
          $_SESSION['userType'] = $row['user_type_desc'];
          $_SESSION['authenticationType'] = "Facebook";

          // set cookie
          $cookieString = Token::getTokenStringForCookie($email, "funinja_login", $conn);
          setcookie("FuNinja", $cookieString, time() + 7776000, '/', null);

          echo "loggedInExisting";
        }

        else {

          // if not exists, create a new enter in users table and take them to the landing page
          $sql = "insert into users (username, email, user_type_id, password, email_verified, ext_name) values (?, ?, ?, ?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
          if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo "sqlerror";
            exit();
          }
          else{
            $dummyUsername = $username;
            $userType="2";
            $dummyPassword = $username;
            $emailVerified = "Y";

            mysqli_stmt_bind_param($stmt, "ssssss", $dummyUsername, $email, $userType, $dummyPassword, $emailVerified, $firstName);
            mysqli_stmt_execute($stmt);
            // retrieve the record to pull the uid
            $sql = "select * from users, user_types where email=? and users.user_type_id=user_types.user_type_id; ";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
              echo "sqlerror";
              exit();
            }
            else{
              mysqli_stmt_bind_param($stmt, "s", $email);
              mysqli_stmt_execute($stmt);

              $result = mysqli_stmt_get_result($stmt);
              if ($row = mysqli_fetch_assoc($result)){
                session_start();
                $_SESSION['uid'] = $row['uid'];
                $split_names = explode(' ', $name, 2);
                $_SESSION['username'] = $firstName;
                $_SESSION['userType'] = $row['user_type_desc'];
                $_SESSION['authenticationType'] = "Facebook";

                // set cookie
                $cookieString = Token::getTokenStringForCookie($email, "funinja_login", $conn);
                setcookie("FuNinja", $cookieString, time() + 7776000, '/', null);

                Email::sendTraineeWelcomeEmail($firstName, $email);

                echo "loggedInNew";
              }
            }
          }
        }
      }
    }
    else {
      echo "noEmail";
      //take the user back to login screen with message "facebook login is set to work only if email is provided,
      // please follow the normal registration steps"
    }
  }

  // google stream
  if($vendor =='google'){

    $username = "GO" . $id; // artifical id stored in the username, email and password fields

    // check if user with this e-mail exists ( email id) and source =

    $sql = "select * from users, user_types where email=? and users.user_type_id=user_types.user_type_id; ";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "sqlerror";
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);

      // if exists, log the user in and send to landing page
      if ($row = mysqli_fetch_assoc($result)){
        session_start();
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['username'] = $firstName;
        $_SESSION['userType'] = $row['user_type_desc'];
        $_SESSION['authenticationType'] = "Google";
        // set cookie
        $cookieString = Token::getTokenStringForCookie($email, "funinja_login", $conn);
        setcookie("FuNinja", $cookieString, time() + 7776000, '/', null);

        echo "loggedInExisting";
      }

      else {

        // if not exists, create a new enter in users table and take them to the landing page
        $sql = "insert into users (username, email, user_type_id, password, email_verified, ext_name) values (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          echo "sqlerror";
          exit();
        }
        else{
          $dummyUsername = $username;
          $userType="2";
          $dummyPassword = $username;
          $emailVerified = "Y";

          mysqli_stmt_bind_param($stmt, "ssssss", $dummyUsername, $email, $userType, $dummyPassword, $emailVerified, $firstName);
          mysqli_stmt_execute($stmt);
          // retrieve the record to pull the uid
          $sql = "select * from users, user_types where email=? and users.user_type_id=user_types.user_type_id; ";
          $stmt = mysqli_stmt_init($conn);

          if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "sqlerror";
            exit();
          }
          else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)){
              session_start();
              $_SESSION['uid'] = $row['uid'];
              $_SESSION['username'] = $firstName;
              $_SESSION['userType'] = $row['user_type_desc'];
              $_SESSION['authenticationType'] = "Google";

              // set cookie
              $cookieString = Token::getTokenStringForCookie($email, "funinja_login", $conn);
              setcookie("FuNinja", $cookieString, time() + 7776000, '/', null);

              Email::sendTraineeWelcomeEmail($firstName, $email);

              echo "loggedInNew";
            }
          }
        }
      }
    }
  }


}
?>
