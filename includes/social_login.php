<?php
require 'dbh.php';

if (isset($_POST['externalLogin'])){

  $emailReceived = $_POST['emailReceived'];
  $vendor = $_POST['vendor'];
  $ext_email = $_POST['email'];
  $name = $_POST['name'];
  $id = $_POST['id'];


  // facebook stream
  if($vendor =='facebook'){
    $username = "FB" . $id; // artifical id stored in the username, email and password fields
    if($emailReceived =="true"){
      // check if user with this e-mail exists (ext email id) and source =

      $sql = "select * from users, user_types where username= ? and source = ? and users.user_type_id=user_types.user_type_id; ";
      $stmt = mysqli_stmt_init($conn);

      if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "sqlerror";
        exit();
      }
      else{
        $source = "Facebook";
        mysqli_stmt_bind_param($stmt, "ss", $username, $source);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        // if exists, log the user in and send to landing page
        if ($row = mysqli_fetch_assoc($result)){
          session_start();
          $_SESSION['uid'] = $row['uid'];
          $_SESSION['username'] = $name;
          $_SESSION['userType'] = $row['user_type_desc'];

          echo "loggedInExisting";
        }

        else {

          // if not exists, create a new enter in users table and take them to the landing page
          $sql = "insert into users (username, email, user_type_id, password, email_verified, source, ext_email) values (?, ?, ?, ?, ?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
          if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo "sqlerror";
            exit();
          }
          else{
            $dummyUsername = $username;
            $dummyEmail = $username;
            $userType="2";
            $dummyPassword = $username;
            $emailVerified = "Y";
            $source = "Facebook";

            mysqli_stmt_bind_param($stmt, "sssssss", $dummyUsername, $dummyEmail, $userType, $dummyPassword, $emailVerified, $source, $ext_email);
            mysqli_stmt_execute($stmt);
            // retrieve the record to pull the uid
            $sql = "select * from users, user_types where username=? and users.user_type_id=user_types.user_type_id; ";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
              echo "sqlerror";
              exit();
            }
            else{
              mysqli_stmt_bind_param($stmt, "s", $username);
              mysqli_stmt_execute($stmt);

              $result = mysqli_stmt_get_result($stmt);
              if ($row = mysqli_fetch_assoc($result)){
                session_start();
                $_SESSION['uid'] = $row['uid'];
                $_SESSION['username'] = $name;
                $_SESSION['userType'] = $row['user_type_desc'];

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

    // check if user with this e-mail exists (ext email id) and source =

    $sql = "select * from users, user_types where username= ? and source = ? and users.user_type_id=user_types.user_type_id; ";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "sqlerror";
      exit();
    }
    else{
      $source = "Google";
      mysqli_stmt_bind_param($stmt, "ss", $username, $source);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);

      // if exists, log the user in and send to landing page
      if ($row = mysqli_fetch_assoc($result)){
        session_start();
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['username'] = $name;
        $_SESSION['userType'] = $row['user_type_desc'];

        echo "loggedInExisting";
      }

      else {

        // if not exists, create a new enter in users table and take them to the landing page
        $sql = "insert into users (username, email, user_type_id, password, email_verified, source, ext_email) values (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          echo "sqlerror";
          exit();
        }
        else{
          $dummyUsername = $username;
          $dummyEmail = $username;
          $userType="2";
          $dummyPassword = $username;
          $emailVerified = "Y";
          $source = "Google";

          mysqli_stmt_bind_param($stmt, "sssssss", $dummyUsername, $dummyEmail, $userType, $dummyPassword, $emailVerified, $source, $ext_email);
          mysqli_stmt_execute($stmt);
          // retrieve the record to pull the uid
          $sql = "select * from users, user_types where username=? and users.user_type_id=user_types.user_type_id; ";
          $stmt = mysqli_stmt_init($conn);

          if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "sqlerror";
            exit();
          }
          else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)){
              session_start();
              $_SESSION['uid'] = $row['uid'];
              $_SESSION['username'] = $name;
              $_SESSION['userType'] = $row['user_type_desc'];

              echo "loggedInNew";
            }
          }
        }
      }
    }
  }


}
?>
