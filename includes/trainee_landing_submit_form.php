<?php

include_once __DIR__.'/../config.php';
require_once ROOT_DIR.'/includes/dbh.php';
include_once ROOT_DIR.'/includes/autoloader.php';

FlowControl::startSession();

if (isset($_POST['trainee_landing_submit'])) {

  // form DOB string

  $dateOfBirth = $_POST['dobDay'].'-'.$_POST['dobMonth'].'-'.$_POST['dobYear'];
  $uid = $_SESSION['uid'];
  $city = $_POST['city'];
  $phoneNumber = $_POST['phone'];
  $gender = $_POST['gender'];

// add user attributes

         //date of birth
  $sql= 'insert into user_attributes (uid, attribute_id, attribute_value, valid_from)
    values (?, (select attribute_id from user_attribute_definitions where attribute_name = "date_of_birth"), ?,(select date(sysdate()) from dual));';

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
  $sql= 'insert into user_attributes (uid, attribute_id, attribute_value, valid_from)
    values (?, (select attribute_id from user_attribute_definitions where attribute_name = "city"), ?,(select date(sysdate()) from dual));';

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
  $sql= 'insert into user_attributes (uid, attribute_id, attribute_value, valid_from)
    values (?, (select attribute_id from user_attribute_definitions where attribute_name = "phone_number"), ?,(select date(sysdate()) from dual));';

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
  $sql= 'insert into user_attributes (uid, attribute_id, attribute_value, valid_from)
    values (?, (select attribute_id from user_attribute_definitions where attribute_name = "gender"), ?,(select date(sysdate()) from dual));';

    $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../index.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "ss", $uid, $gender);
          mysqli_stmt_execute($stmt);
        }

  $sql= 'insert into user_attributes (uid, attribute_id, attribute_value, valid_from)
    values (?, (select attribute_id from user_attribute_definitions where attribute_name = "trainee_onboarding_completed"), ?,(select date(sysdate()) from dual));';

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

    header("Location: ../includes/post_login_landing_controller.php");
    exit();
}

 else {
  header("Location: ../index.php");
  exit();
}
