<?php

require_once (__DIR__.'/../config.php');
require_once (ROOT_DIR.'/includes/dbh.php');
require_once (ROOT_DIR.'/includes/autoloader.php');

if(isset($_POST['signup-onboard-submit'])) {

$username = $_POST['uid'];
$email = $_POST['email'];
$password = $_POST['pwd'];
$passwordRepeat = $_POST['pwd-repeat'];
$userType = $_POST['type'];
$selector = $_POST['selector'];
$validator = $_POST['validator'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phoneNumber = $_POST['phone'];
$dateOfBirth = $_POST['dobDay'].'-'.$_POST['dobMonth'].'-'.$_POST['dobYear'];
$gender = $_POST['gender'];
$city = $_POST['city'];
$zoomID= $_POST['zoomID'];
$selectedActivitiesList=[];


if($userType=="Admin"){
  $tokenType = "onboard_admin";
} else if ($userType=="Trainer"){
  $tokenType = "onboard_trainer";
}



$currentDate = date("U");

$queryGiveBack = "&selector=".$selector."&validator=".$validator."&type=".$userType."&zoomID=".$zoomID;

// check if at least one activity is selected

$activityNames = Activity::getAllActivityNames($conn);
$selectedActivitiesCount=0;
foreach ($activityNames as $activityName) {
  foreach ($_POST as $postVariable) {
    if($activityName===$postVariable){
      $selectedActivitiesCount+=1;
      array_push($selectedActivitiesList, $activityName);
    }
  }
}

if($selectedActivitiesCount===0){
  header("Location: /admin/new_trainer_admin_landing.php?status=noactivities&uid=".$username."&email=".$email.$queryGiveBack);
  exit();
}

// check for empty fields
  if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    header("Location: /admin/new_trainer_admin_landing.php?status=emptyfields&uid=".$username."&email=".$email.$queryGiveBack);
    exit();
  }

// check if both email and username are invalid
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9._]*$/", $username.$queryGiveBack)) {
    header("Location: /admin/new_trainer_admin_landing.php?status=invalidemailuid");
    exit();
  }

// check if email is invalid
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: /admin/new_trainer_admin_landing.php?status=invalidemail&uid=".$username.$queryGiveBack);
    exit();
  }

// check if username has valid characters
  else if (!preg_match("/^[a-zA-Z0-9_]*$/", $username)){
    header("Location: /admin/new_trainer_admin_landing.php?status=invalidUsernameChars&email=".$email.$queryGiveBack);
    exit();
  }

// check if username is long enough
//  else if (strlen($username)<=6){
//    header("Location: /admin/new_trainer_admin_landing.php?status=usernameTooShort&email=".$email.$queryGiveBack);
  //  exit();
//  }


// password checks

  $passwordObject = new Password($password, $passwordRepeat);

  if (!$passwordObject->doesMatch()) {
    header("Location: /admin/new_trainer_admin_landing.php?status=pwdMismatch&email=".$email. "&uid=".$username.$queryGiveBack);
    exit();
  } else if (!$passwordObject->isLongEnough()){
    header("Location: /admin/new_trainer_admin_landing.php?status=tooShort&email=".$email. "&uid=".$username.$queryGiveBack);
    exit();
  }


// check if username is taken, regardless of whether e-mail verification has been completed

    $sql = "SELECT username from users where username=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: /admin/new_trainer_admin_landing.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck=mysqli_stmt_num_rows($stmt);
      if($resultCheck > 0) {
        header("Location: /admin/new_trainer_admin_landing.php?status=username_taken&email=".$email. "&uid=".$username.$queryGiveBack);
        exit();
	     }
	}



// check if a user with verified e-mail ID already exists

    $sql = "SELECT username from users where email=? and email_verified=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: /admin/new_trainer_admin_landing.php?status=sqlerror");
      exit();
    }
    else {
      $verified="Y";
      mysqli_stmt_bind_param($stmt, "ss", $email, $verified);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck=mysqli_stmt_num_rows($stmt);
      if($resultCheck > 0) {
        header("Location: /admin/new_trainer_admin_landing.php?status=emailexists&email=".$email.$queryGiveBack);
        exit();
      }


// token validation


      // if token is valid, proceed, otherwise, return invalidlink erro

      if(Token::tokenIsValid($selector, $validator, $conn)){
		          // set the user type for the DB based on the type input
        $sql = "select * from user_types where user_type_desc=?";
        $stmt = mysqli_stmt_init($conn);


        if(!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: ../index.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "s", $userType);
          mysqli_stmt_execute($stmt);

          $result = mysqli_stmt_get_result($stmt);
          if ($row = mysqli_fetch_assoc($result)){

            $userTypeForDB=$row['user_type_id'];


          }



        // delete existing unverified user and any tokens first before inserting

        $sql = "delete from tokens where email=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: /admin/new_trainer_admin_landing.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "s", $email);
          mysqli_stmt_execute($stmt);
        }

        $sql = "delete from users where email=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: /admin/new_trainer_admin_landing.php?error=sqlerror");
          exit();
        }
        else{
          mysqli_stmt_bind_param($stmt, "s", $email);
          mysqli_stmt_execute($stmt);
        }

        $sql = "insert into users (username, email, user_type_id, password, email_verified, source) values (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: /admin/new_trainer_admin_landing.php?error=sqlerror");
          exit();
        }
        else{
          $emailVerified = "Y";
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
          $source = "Web";
          mysqli_stmt_bind_param($stmt, "ssssss", $username, $email, $userTypeForDB, $hashedPwd, $emailVerified, $source );
          mysqli_stmt_execute($stmt);


          // get the newly created user's uid so that we can use it to start a new session and log the user in
          $sql = "select * from users where username=?";
          $stmt = mysqli_stmt_init($conn);


          if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: /admin/new_trainer_admin_landing.php?error=sqlerror");
            exit();
          }
          else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)){
              $uid=$row['uid'];
            }


          // start the session so that the landing page can forward appropriately
          session_start();
          $_SESSION['uid'] = $uid;
          $_SESSION['username'] = $username;
          $_SESSION['userType'] = $userType;

          $split_names = explode('@', $email, 2);

          // insert user attributes

          //first_name
          $sql= 'insert into user_attributes (uid, attribute_id, attribute_value, valid_from)
            values (?, (select attribute_id from user_attribute_definitions where attribute_name = "first_name"), ?,(select date(sysdate()) from dual));';

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
          $sql= 'insert into user_attributes (uid, attribute_id, attribute_value, valid_from)
            values (?, (select attribute_id from user_attribute_definitions where attribute_name = "last_name"), ?,(select date(sysdate()) from dual));';

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

             //Zoom ID
            $sql= 'insert into user_attributes (uid, attribute_id, attribute_value, valid_from)
              values (?, (select attribute_id from user_attribute_definitions where attribute_name = "Zoom ID"), ?,(select date(sysdate()) from dual));';

            $stmt = mysqli_stmt_init($conn);
              if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../index.php?error=sqlerror");
                exit();
              }
              else{
                mysqli_stmt_bind_param($stmt, "ss", $uid, $zoomID);
                mysqli_stmt_execute($stmt);
              }

            // insert selected activities to the qualifications table
            foreach ($selectedActivitiesList as $selectedActivity) {
              $activityId = Activity::getId($selectedActivity, $conn);
              $sql="insert into qualifications (uid, activity_type_id, valid_from) values ($uid, $activityId, date(sysdate()) );";
              $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                  header("Location: ../index.php?error=sqlerror");
                  exit();
                }
                else{
                  mysqli_stmt_execute($stmt);
                }
            }

          Email::sendTrainerWelcomeEmail($split_names[0], $email);

          header("Location: ../includes/post_login_landing_controller.php?status=onboarded");
          exit();
        }
        }
      }

    } else {
      header("Location: /admin/new_trainer_admin_landing.php?status=invalidlink&email=".$email. "&uid=".$username.$queryGiveBack);
    }






    }


}
else{
  header("Location: /admin/new_trainer_admin_landing.php");
  exit();

}
