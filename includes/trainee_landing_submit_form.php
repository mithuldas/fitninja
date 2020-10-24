<?php

require 'dbh.php';
session_start();

if (isset($_POST['trainee_landing_submit'])) {

  $uid = $_SESSION['uid'];

  $firstName = $_POST['fname'];
  $lastName = $_POST['lname'];
  $dateOfBirth = $_POST['dob'];
  $city = $_POST['city'];
  $phoneNumber = $_POST['phonenumber'];
  $gender = $_POST['gender'];
  $activities = $_POST['activities'];

    // insert activities into user_interests table
    foreach($_POST['activities'] as $activity) {

         $sql=
            'insert into user_interests (uid, interest_id, str_dt, end_dt)
            values (?, (select id from interests where interest = ?), sysdate(), null);';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../index.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "ss", $uid, $activity);
          mysqli_stmt_execute($stmt);
        }
    }

    // add personal data to user data table

        //first_name
  $sql= 'insert into user_attributes (uid, attribute_id, attribute_value)
    values (?, (select attribute_id from user_attribute_definitions where attribute_name = "first_name"), ?);';

    $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../index.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "ss", $uid, $firstName);
          mysqli_stmt_execute($stmt);
        }

        //last_name
  $sql= 'insert into user_attributes (uid, attribute_id, attribute_value)
    values (?, (select attribute_id from user_attribute_definitions where attribute_name = "last_name"), ?);';

    $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../index.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "ss", $uid, $lastName);
          mysqli_stmt_execute($stmt);
        }

         //date of birth
  $sql= 'insert into user_attributes (uid, attribute_id, attribute_value)
    values (?, (select attribute_id from user_attribute_definitions where attribute_name = "date_of_birth"), ?);';

    $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../index.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "ss", $uid, $dateOfBirth);
          mysqli_stmt_execute($stmt);
        }


         //city
  $sql= 'insert into user_attributes (uid, attribute_id, attribute_value)
    values (?, (select attribute_id from user_attribute_definitions where attribute_name = "city"), ?);';

    $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../index.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "ss", $uid, $city);
          mysqli_stmt_execute($stmt);
        }

         //phone number
  $sql= 'insert into user_attributes (uid, attribute_id, attribute_value)
    values (?, (select attribute_id from user_attribute_definitions where attribute_name = "phone_number"), ?);';

    $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../index.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "ss", $uid, $phoneNumber);
          mysqli_stmt_execute($stmt);
        }

         //gender
  $sql= 'insert into user_attributes (uid, attribute_id, attribute_value)
    values (?, (select attribute_id from user_attribute_definitions where attribute_name = "gender"), ?);';

    $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../index.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "ss", $uid, $gender);
          mysqli_stmt_execute($stmt);
        }

  $sql= 'insert into user_attributes (uid, attribute_id, attribute_value)
    values (?, (select attribute_id from user_attribute_definitions where attribute_name = "trainee_onboarding_completed"), ?);';

    $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../index.php?error=sqlerror");
          exit();
        }
        else{
          $complete = "Y";
          mysqli_stmt_bind_param($stmt, "ss", $uid, $complete);
          mysqli_stmt_execute($stmt);
        }

    header("Location: ../dashboard.php");
    exit();
}

 else {
  header("Location: ../index.php");
  exit();
}
