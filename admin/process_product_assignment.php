<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

// call session's assign function, which will take time and trainer input
  // session fills to be updated, along with the scheduled time attribute
  // create assignment rows in assignments table for trainee and trainer

// send confirmation email to trainee and trainer (in the future, SMS)


$firstSession = json_decode($_POST['firstSession']);
$scheduledDateTime = $_POST['date'].' '.$_POST['hour'].':'.$_POST['minute']; // date/time for next session
$activity=$_POST['activity'];
$trainerUID = $_POST['trainerSelect'];
$traineeUID = $firstSession->uid;
$sessionType = $_POST['sessionType'];

// insert trainee assignment
insertAssignmentToDB($firstSession->id, $traineeUID, "trainee", $conn);
// insert trainer assignment
insertAssignmentToDB($firstSession->id, $trainerUID, "trainer", $conn);

// update the scheduled date and time of the session
$session = new Session($firstSession->id, $conn);
$dateAndTimeForDB = getDateTimeValue($scheduledDateTime);
$session->setScheduledDateTime($dateAndTimeForDB, $conn);

// set activity of the session
$session->setActivity($activity, $conn);

// send confirmation e-mail to the trainer and trainee
$trainee = new Trainee($traineeUID, $conn);
$trainer = new User($trainerUID, $conn);

Email::sendFirstSessionScheduledEmailtoTrainee($trainee->firstName, $trainer->firstName. ' '.$trainer->lastName, $sessionType, $firstSessionDate, $firstSessionTime, $trainee->email, $trainee->phoneNumber, $conn);
Email::sendFirstSessionScheduledEmailtoTrainer($trainer->firstName, $trainee->firstName. ' '.$trainee->lastName, $sessionType, $firstSessionDate, $firstSessionTime, $trainer->email, $trainer->phoneNumber, $conn);

header("Location: /admin/view_unassigned_products.php");

function getDateTimeValue($scheduledDateTime){
  if(isset($_SERVER['HTTP_HOST']) and $_SERVER['HTTP_HOST']=="localhost"){
    $tzOffset = 0;
    $adjustedDateTime= (date('Y-m-d G:i',strtotime($scheduledDateTime. ' -'.$tzOffset.' minute')));
  } else {
    $tzOffset = 330; // 5h30 mins offset forward for AWS server that's on UTC TZ
    $adjustedDateTime= (date('Y-m-d G:i',strtotime($scheduledDateTime. ' -'.$tzOffset.' minute')));
  }
  return $adjustedDateTime;
}

function insertAssignmentToDB($sessionID, $uid, $type, $conn){
  // insert row into user_assignment table
  $sql = "INSERT INTO user_assignments (session_id, uid, delete_ind, notified) VALUES (" . $sessionID . ", " . $uid . ", 'N', 'N');";

  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)) {
    return 0;
    exit();
  }
  else{
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_affected_rows($stmt)<1){
      return 0;
      exit();
    }

    // determine whether to increment trainer or trainee fill
    $fillColumnName;
    if($type=="trainer"){
      $fillColumnName='filled_trainers';
    } else if ($type=="trainee"){
      $fillColumnName='filled_trainees';
    }
    // increment fill value appropriately in session
    if($type=="trainer"){
      $sql = "update sessions s set ". $fillColumnName . "=(select count(*) from user_assignments ua, users u where s.id=ua.session_id and ua.uid=u.uid and ua.delete_ind='N' and user_type_id=1) where id=". $sessionID.";";
    } else if ($type=="trainee"){
      $sql = "update sessions s set ". $fillColumnName . "=(select count(*) from user_assignments ua, users u where s.id=ua.session_id and ua.uid=u.uid and ua.delete_ind='N' and user_type_id=2) where id=". $sessionID.";";
    }

    if(!mysqli_stmt_prepare($stmt, $sql)) {
      return 0;
      exit();
    }
    else {
      mysqli_stmt_execute($stmt);
      if(mysqli_stmt_affected_rows($stmt)<1){
        return 0;
        exit();
      } else {
        return 1;
      }
    }

  }
}


 ?>
