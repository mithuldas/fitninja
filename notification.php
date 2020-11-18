<?php

// will be hooked up to cron and will poll the database for any user assignments coming up within
// now and $pollingWindow minutes and then handle each qualifying session by sending Zoom links to users

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

use \Firebase\JWT\JWT;

$pollingWindow = 30; // polling window - i.e, determines how many minutes before a session an email / sms will be sent


$sql = "select * from sessions s where s.sch_dt_tm between sysdate() and date_add(sysdate(), interval 30 minute)
      and exists (select 1 from user_assignments ua where s.id=ua.session_id and ua.delete_ind='N' and notified='N');";

$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$sessionsToBeProcessed=[];

while($row = $result->fetch_assoc()) {
  array_push($sessionsToBeProcessed, new Session($row['id'],$conn)); // create list of sessions that need zoom meetings created and notifications sent out
}

foreach ($sessionsToBeProcessed as $session) { // for each session to be processed, create the zoom meeting
  echo (processSession($session, $conn));
}

function processSession($session, $conn){ // attempt to create a zoom meeting and then send notifications. 1 = success, 0 = failed
  if($session->createZoomMeeting($conn)==1){ // if zoom meeting successfull created and session attributes updated, proceed
    // notify all participants
    foreach($session->assignments as $assignment){
      // if trainee assignment, send trainee email, if trainer, send trainer email
      $updatedSession = new Session($session->id, $conn);
      if($assignment->type=="trainer"){
        Email::sendZoomStartLinktoTrainer($updatedSession, $assignment->uid, $conn);
        $assignment->setToNotified($conn);
      } else if ($assignment->type=="trainee"){
        Email::sendZoomJoinLinktoTrainee($updatedSession, $assignment->uid, $conn);
        $assignment->setToNotified($conn);
      }
    }
    return 1;
  } else {
    return 0; // failure
  }
}
?>
