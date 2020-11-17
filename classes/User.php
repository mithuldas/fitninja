<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );

class User {
  public $uid;
  public $firstName;
  public $lastName;
  public $dateOfBirth;
  public $phoneNumber;
  public $gender;
  public $email;
  public $type;
  public $zoomID;

  function __construct($uid, $conn) {
    $this->uid = $uid;
    $this->setUserAttributes($conn);
    $this->setEmailId($conn);
    $this->setUserType($conn);
  }

  function setEmailId($conn){
    $sql = "select email from users where uid = ".$this->uid.";";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes
        $this->email=$row['email'];
      }
    }
  }

  function setUserType($conn){

    $sql = "select ut.user_type_desc from users u, user_types ut where u.user_type_id=ut.user_type_id and u.uid= ".$this->uid.";";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes
        $this->type=$row['user_type_desc'];
      }
    }
  }

  function setUserAttributes($conn){
    $sql = "select uad.attribute_name, ua.attribute_value from users u, user_attribute_definitions uad, user_attributes ua
            where u.uid = ".$this->uid." and u.uid=ua.uid and ua.attribute_id=uad.attribute_id and sysdate() BETWEEN ua.valid_from and
            IFNULL(ua.valid_to,  DATE_ADD(sysdate(), INTERVAL 1 YEAR) );";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes

        switch ($row['attribute_name']) {
          case "first_name":
            $this->firstName = $row['attribute_value'];
            break;
          case "last_name":
            $this->lastName = $row['attribute_value'];
            break;
          case "date_of_birth":
            $this->dateOfBirth = $row['attribute_value'];
            break;
          case "phone_number":
            $this->phoneNumber = $row['attribute_value'];
            break;
          case "gender":
            $this->gender = $row['attribute_value'];
            break;
          case "Zoom ID":
            $this->zoomID = $row['attribute_value'];
            break;
          }
      }
    }
  }

  function getUpcomingSessions($numberOfSessions, $conn){
    $upcomingSessions=[];
    $sql = "select * from user_assignments where delete_ind='N' and uid = " .$this->uid. ";";
    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $count=0;

    while($row = $result->fetch_assoc() and $count<$numberOfSessions) { // loop through the array and set all user attributes
      $sessionID=$row['session_id'];
      array_push($upcomingSessions, new Session($sessionID, $conn));
      $count=$count+1;
    }

    return $upcomingSessions;
  }
}
?>
