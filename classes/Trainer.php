<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();

class Trainer extends User{

  public $qualifiedActivities;
  public $qualifiedActivitiesString;

  function __construct($uid, $conn) {
    parent::__construct($uid, $conn);
    $this->setQualifiedActivities($conn);
    $this->setQualifiedActivitiesString($conn);
  }

  function getTraineeList($conn){
    $trainees=[];
    $sql="select distinct up.uid from user_assignments ua, sessions s, user_products up where s.id=ua.session_id and s.user_product_id=up.id and ua.uid='".$this->uid."' and s.completed is null;";
    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes
      $traineeUID=$row['uid'];
      array_push($trainees, new Trainee($traineeUID, $conn));
    }
    return $trainees;
  }

  function setQualifiedActivities($conn){
    $qualifiedActivities=[];
    $uid=$this->uid;
    $sql="select activity_type_id from qualifications where uid=$uid;";
    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes
      $activityName=Activity::getName($row['activity_type_id'],$conn);
      array_push($qualifiedActivities, $activityName);
    }
    $this->qualifiedActivities=$qualifiedActivities;
  }

  function setQualifiedActivitiesString(){
    $string = '';
    foreach ($this->qualifiedActivities as $qualifiedActivity) {
      if($string!==''){
        $string.=', '.$qualifiedActivity;
      } else {
        $string.=$qualifiedActivity;
      }
    }

    $this->qualifiedActivitiesString= $string;
  }
}

 ?>
