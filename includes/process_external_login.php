<?php
require 'dbh.php';

if (isset($_POST['externalLogin'])){

  $emailReceived = $_POST['emailReceived'];
  $vendor = $_POST['vendor'];
  $email = $_POST['email'];
  $name = $_POST['name'];


  // facebook stream
  if($vendor =='facebook'){

    if($emailReceived =="true"){
      // check if user with this e-mail exists (ext email id)

        // if exists, log the user in and send to landing page

        // if not exists, create a new enter in users table and take them to the landing page
        $sql = "insert into users (username, email, user_type_id, password, email_verified, source, ext_email) values (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          echo "sqlerror";
          exit();
        }
        else{
          $dummyUsername = "fb";
          $dummyEmail = 'fb';
          $userType="2";
          $dummyPassword = "fb";
          $emailVerified = "Y";
          $source = "Facebook";
          $ext_email = $email;
          mysqli_stmt_bind_param($stmt, "sssssss", $dummyUsername, $dummyEmail, $userType, $dummyPassword, $emailVerified, $source, $ext_email);
          mysqli_stmt_execute($stmt);

          $sql = "select * from users, user_types where ext_email= ? and users.user_type_id=user_types.user_type_id; ";
          $stmt = mysqli_stmt_init($conn);

          if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "sqlerror";
            exit();
          }
          else{
            mysqli_stmt_bind_param($stmt, "s", $ext_email);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)){
              session_start();
              $_SESSION['uid'] = $row['uid'];
              $_SESSION['username'] = $name;
              $_SESSION['userType'] = $row['user_type_desc'];

              echo "loginSuccess";
            }
          }

        }

    }
    else {
      echo "email not received";
      //take the user back to login screen with message "facebook login is set to work only if email is provided,
      // please follow the normal registration steps"
    }
  }

  if($vendor =='google'){ // write later
    echo "hello google...";
  }
  // google stream

}
?>
