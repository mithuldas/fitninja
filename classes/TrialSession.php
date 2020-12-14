<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );

class TrialSession extends Session {

  public $trialType;
  public $trialDate;
  public $trialTimeSlot;
  public $comments;

  function __construct($id, $conn) {
    parent::__construct($id, $conn);
    $this->addTrialSessionAttributes($id, $conn);
  }

  function addTrialSessionAttributes($id, $conn){
    $sql = "select attribute_name, attribute_value from sessions s, session_attributes sa,
    session_attribute_definitions sad where s.id=sa.session_id and sa.attribute_id=sad.attribute_id and s.id= ".$id.";";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes

        switch ($row['attribute_name']) {
          case "preferredTrialType":
            $this->trialType = $row['attribute_value'];
            break;
            case "trialRequestComments":
              $this->comments = $row['attribute_value'];
              break;
          case "preferredTrialDate":
            $date = date_create($row['attribute_value']);
            $dateString= date_format($date,"Y-m-d");
            $this->trialDate = $dateString;
            break;
          case "preferredTrialTimeSlot":
            $this->trialTimeSlot = $row['attribute_value'];
            break;
          }
      }
    }
  }

}
