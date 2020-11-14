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

$traineeAssignment = createAssignmentObject($originalTrialSession->id, $traineeUID, "trainee", $finalTrialDate.$finalTrialTime);
$trainerAssignment = createAssignmentObject($originalTrialSession->id, $trainerUID, "trainer", $finalTrialDate.$finalTrialTime);

//echo("<pre>".json_encode($traineeAssignment, JSON_PRETTY_PRINT))."</pre>";
//echo("<pre>".json_encode($trainerAssignment, JSON_PRETTY_PRINT))."</pre>";



// now that we have the assignment objects, save them to the DB
$traineeAssignment->insertToDB($conn);
$trainerAssignment->insertToDB($conn);

// update the scheduled date and time of the session
$trialSession = new TrialSession($originalTrialSession->id, $conn);
$dateAndTimeForDB = getDateTimeValue($finalTrialDate, $finalTrialTime);
$trialSession->setScheduledDateTime($dateAndTimeForDB, $conn);


// send confirmation e-mail to the trainer and trainee
$trainee = new Trainee($traineeUID, $conn);
$trainer = new User($trainerUID, $conn);

Email::sendTrialScheduledEmailtoTrainee($trainee->firstName, $trainer->firstName. ' '.$trainer->lastName, $trialType, $finalTrialDate, $finalTrialTime, $trainee->email, $trainee->phoneNumber, $conn);
Email::sendTrialScheduledEmailtoTrainer($trainer->firstName, $trainee->firstName. ' '.$trainee->lastName, $trialType, $finalTrialDate, $finalTrialTime, $trainer->email, $trainer->phoneNumber, $conn);

header("Location: /admin/trial_requests.php");

function createAssignmentObject($sessionID, $uid, $type){
  $assignment = new Assignment();

  $assignment->sessionID=$sessionID;
  $assignment->uid=$uid;
  $assignment->type=$type;

  return $assignment;
}

function getDateTimeValue($finalTrialDate, $finalTrialTime){
  $time24h= date("G:i", strtotime($finalTrialTime));

  return $finalTrialDate.' '.$time24h;
}


 ?>
