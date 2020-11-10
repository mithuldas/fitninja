<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );

class Trainee extends User{
  public $isNew;

  function __construct($uid, $conn) {
    parent::__construct($uid, $conn);
    $this->setIsNew();
  }

  function setIsNew(){ //
    $sql = "select * from user_products, products where user_products.product_id=products.id and
            uid=".$this->uid.";";

    $stmt = mysqli_stmt_init($this->conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)){
        $this->isNew = false;
      } else {
        $this->isNew= true;
      }
    }
  }

  function submitTrialRequest($trialType, $trialDate, $trialTimeSlot){
    // insert user_products entry for Trial
    $sql = "INSERT INTO user_products (id, uid, product_id, valid_from, valid_to) VALUES (NULL,".
       $this->uid .", '1', current_timestamp(), NULL);";
    $stmt = mysqli_stmt_init($this->conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
      return false;
      exit();
    }
    else{
      mysqli_stmt_execute($stmt);
      if(mysqli_stmt_affected_rows($stmt)<1){
        return false;
      }
    }

    // insert session but first get the user_product id first
    $sql = "select id from user_products where uid = ".$this->uid." and sysdate() between valid_from and IFNULL(valid_to,  DATE_ADD(sysdate(), INTERVAL 1 YEAR));";

    $stmt = mysqli_stmt_init($this->conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      return false;
      exit();
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      $userProductId=$row['id'];

    }
    // insert session attributes

    $sql = "INSERT INTO sessions (sequence, user_product_id, planned_trainers, planned_trainees, filled_trainers, filled_trainees)
            VALUES (1,".$userProductId.", 1, 1, 0, 0)";

    $stmt = mysqli_stmt_init($this->conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
      return false;
      exit();
    }
    else{
      mysqli_stmt_execute($stmt);
    }

    // now get the session id so that we can insert session attributes

    // insert session but first get the user_product id first
    $sql = "select id from sessions where user_product_id =".$userProductId;
    $stmt = mysqli_stmt_init($this->conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      return false;
      exit();
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      $sessionId=$row['id'];
    }

    // now that we have the session id, insert the session attributes (viewable by admin for assignment tips)

    $sql1 = "INSERT INTO session_attributes (session_id, attribute_id, attribute_value, valid_from, valid_to) VALUES (".$sessionId.", (select attribute_id from session_attribute_definitions where attribute_name='preferredTrialType'), '".$trialType."', current_timestamp(), NULL);";
    $sql2 = "INSERT INTO session_attributes (session_id, attribute_id, attribute_value, valid_from, valid_to) VALUES (".$sessionId.", (select attribute_id from session_attribute_definitions where attribute_name='preferredTrialDate'), '".$trialDate."', current_timestamp(), NULL);";
    $sql3 = "INSERT INTO session_attributes (session_id, attribute_id, attribute_value, valid_from, valid_to) VALUES (".$sessionId.", (select attribute_id from session_attribute_definitions where attribute_name='preferredTrialTimeSlot'), '".$trialTimeSlot."', current_timestamp(), NULL);";

    $stmt = mysqli_stmt_init($this->conn);

    mysqli_stmt_prepare($stmt, $sql1);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql2);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql3);
    mysqli_stmt_execute($stmt);

    return true;

  }
}

 ?>
