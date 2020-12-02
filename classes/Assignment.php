<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );

class Assignment {
  public $id;
  public $sessionID;
  public $uid;
  public $type; // trainer, trainee etc, determines the fill to update in sessions table
  public $scheduledDateTime;
  public $activity;

  public function __construct($id, $conn){
    $this->id=$id;
    $this->initAssignmentData($conn);
    $this->setScheduledDateTime($conn);
    $this->setActivity($conn);
  }

  public function initAssignmentData($conn){
    $sql = "select * from user_assignments where id=".$this->id.";";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = $result->fetch_assoc()) {
      $this->sessionID=$row['session_id'];
      $this->uid=$row['uid'];
    }
    $this->setType($this->uid, $conn);
  }

  public function setScheduledDateTime($conn){
    $sql="select sch_dt_tm from sessions where id=".$this->sessionID.";";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = $result->fetch_assoc()) {
      $this->scheduledDateTime=$row['sch_dt_tm'];
    }
  }

  public function setActivity($conn){
    $sql="select activity_type_id from sessions where id=".$this->sessionID.";";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = $result->fetch_assoc()) {
      $this->activity=Activity::getName($row['activity_type_id'],$conn);
    }
  }

  public function setType($uid, $conn){
    $typeID;
    $sql = "select user_type_id from users u where uid=".$uid;
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = $result->fetch_assoc()) {
      $typeID=$row['user_type_id'];

      if($typeID=='1'){
        $this->type="trainer";
      } else if($typeID=='2'){
        $this->type="trainee";
      }
    }
  }

  public function setToNotified($conn){
    $sql = "update user_assignments ua set notified='Y' where id=".$this->id.";";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_affected_rows($stmt)<1){
      return 0;
    } else {
      return 1;
    }
  }
}
