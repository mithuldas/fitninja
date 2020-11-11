<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );

class Session {


  public $id;
  public $sequence;
  public $productName;
  public $uid;
  public $plannedTrainers;
  public $plannedTrainees;
  public $filledTrainers;
  public $filledTrainees;
  public $notes;

  function __construct($id, $conn) { // construct a session object (i.e a row in the session table, given an id )
    $this->id = $id;
    $this->initSessionData($this->id, $conn);
  }

  function initSessionData($id, $conn){
    $sql = "select * from sessions s, user_products up, products p,
    users u where s.user_product_id=up.id and up.product_id=p.id and up.uid=u.uid and s.id='".$this->id."';";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes
        $this->productName=$row['name'];
        $this->uid=$row['uid'];
        $this->sequence=$row['sequence'];
        $this->plannedTrainers=$row['planned_trainers'];
        $this->plannedTrainees=$row['planned_trainees'];
        $this->filledTrainers=$row['filled_trainers'];
        $this->filledTrainees=$row['filled_trainees'];
        $this->notes=$row['notes'];
      }
    }
  }
}
?>