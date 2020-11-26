<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

// call trial session's assign function, which will take time and trainer input
  // session fills to be updated, along with the scheduled time attribute
  // create assignment rows in assignments table for trainee and trainer

// send confirmation email to trainee and trainer (in the future, SMS)

$originalTrialSession = json_decode($_POST['trialSession']);

//echo("<pre>".json_encode($originalTrialSession, JSON_PRETTY_PRINT))."</pre>";

$finalTrialDate = $_POST['trialDate'];
$finalTrialTime = $_POST['time'];
$trainerUID = $_POST['trainerSelect'];
$traineeUID = $originalTrialSession->uid;
$trialType = $_POST['trialProduct'];

// insert trainee assignment
insertAssignmentToDB($originalTrialSession->id, $traineeUID, "trainee", $conn);
// insert trainer assignment
insertAssignmentToDB($originalTrialSession->id, $trainerUID, "trainer", $conn);

// update the scheduled date and time of the session
$trialSession = new TrialSession($originalTrialSession->id, $conn);
$dateAndTimeForDB = getDateTimeValue($finalTrialDate, $finalTrialTime);
$trialSession->setScheduledDateTime($dateAndTimeForDB, $conn);

// send confirmation e-mail to the trainer and trainee
$trainee = new Trainee($traineeUID, $conn);
$trainer = new User($trainerUID, $conn);

Email::sendTrialScheduledEmailtoTrainee($trainee->firstName, $trainer->firstName. ' '.$trainer->lastName, $trialType, $finalTrialDate, $finalTrialTime, $trainee->email, $trainee->phoneNumber, $conn);
Email::sendTrialScheduledEmailtoTrainer($trainer->firstName, $trainee->firstName. ' '.$trainee->lastName, $trialType, $finalTrialDate, $finalTrialTime, $trainer->email, $trainer->phoneNumber, $conn);

header("Location: /admin/view_trial_requests.php");

function getDateTimeValue($finalTrialDate, $finalTrialTime){

  $time24h= date("G:i", strtotime($finalTrialTime));

  $dateTime = $finalTrialDate.' '.$time24h;

  if(isset($_SERVER['HTTP_HOST']) and $_SERVER['HTTP_HOST']=="localhost"){
    $tzOffset = 0;
    $adjustedDateTime= (date('Y-m-d G:i',strtotime($dateTime. ' -'.$tzOffset.' minute')));
  } else {
    $tzOffset = 330; // 5h30 mins offset forward for AWS server that's on UTC TZ
    $adjustedDateTime= (date('Y-m-d G:i',strtotime($dateTime. ' -'.$tzOffset.' minute')));
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
