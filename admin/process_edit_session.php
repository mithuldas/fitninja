<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );


$session = json_decode($_POST['session']); // convert this to an actual session object next
$session = new Session($session->id, $conn);

$date = strtotime($session->scheduledDateTime)  ;

$oldDateTime= date('Y-m-d H:i', $date);
$newDateTime = $_POST['date'].' '.$_POST['hour'].':'.$_POST['minute'];

$completedInDB = $session->completed;

if(!isset($_POST['completedFlag'])){
  $completedFormInput = null;
} else {
  $completedFormInput = $_POST['completedFlag'];
}

// update completed status in sessions table if needed
if($completedFormInput!=$completedInDB){
  if($completedFormInput=="Y"){ // update session with Y completed flag
    $sql = "update sessions set completed='Y' where id=".$session->id.";";
  } else if($completedFormInput!="Y"){ // update sessoin with null completed flag
    $sql = "update sessions set completed=null where id=".$session->id.";";
  }

  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_execute($stmt);
  if(mysqli_stmt_affected_rows($stmt)==1){
    echo "success";
  } else {
    echo "failed";
  }

}

// update scheduled date time in sessions table if needed
if($oldDateTime!=$newDateTime){
  $sql = "update sessions set sch_dt_tm='".$newDateTime."' where id=".$session->id.";";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_execute($stmt);
  if(mysqli_stmt_affected_rows($stmt)==1){
    echo "success";
  } else {
    echo "failed";
  }
}

if($session->activity!==$_POST['activity']){

  $activityId = Activity::getId($_POST['activity'], $conn);

  $sql = "update sessions set activity_type_id='".$activityId."' where id=".$session->id.";";

  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_execute($stmt);
  if(mysqli_stmt_affected_rows($stmt)==1){
    echo "success";
  } else {
    echo "failed";
  }
}

header("Location: /admin/view_assigned_sessions.php");


 ?>
