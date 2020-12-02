<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );

class UserProduct{
  public $userProductId;
  public $uid;
  public $productName;
  public $validFrom;
  public $validTo;
  public $totalSessions;
  public $sessionsScheduled;
  public $sessionsCompleted;
  public $isActive;

  function __construct($id, $conn) {
    $this->userProductId=$id;
    $this->setProperties($id, $conn);
    $this->setSessionStatistics($conn);
    $this->setCompleted($conn);
  }

  function setProperties($id, $conn){
    $sql="select * from user_products up, products p where up.product_id=p.id and up.id=".$this->userProductId. ";";
    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) {
      $this->uid=$row['uid'];
      $this->productName=$row['name'];
      $this->validFrom=$row['valid_from'];
      $this->validTo=$row['valid_to'];
    }
  }

  function setSessionStatistics($conn){
    $product = new Product($this->productName, $conn);
    $this->totalSessions=$product->numberOfSessions; // set number of sessions in this user product
    $sql = "select count(*) as completed from sessions s
            where s.user_product_id='".$this->userProductId."' and completed='Y';"; // set number of completed sessions
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = $result->fetch_assoc()) {
      $this->sessionsCompleted=$row['completed'];
    }

    $sql = "select count(*) as scheduled from sessions s
            where s.user_product_id='".$this->userProductId."' and sch_dt_tm is not null;"; // // set number of sessions that have been scheduled
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while($row = $result->fetch_assoc()) {
              $this->sessionsScheduled=$row['scheduled'];
            }
  }

  function setCompleted($conn){
    if($this->totalSessions===$this->sessionsCompleted){
      $this->isActive=false;
    } else {
      $this->isActive=true;
    }
  }
}

 ?>
