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
  public $trainerStats=[];

  function __construct($id, $conn) {
    $this->userProductId=$id;
    $this->setProperties($id, $conn);
    $this->setValidTo($conn);
    $this->setSessionStatistics($conn);
    $this->setCompleted($conn);
    $this->setTrainerStats($conn);

  }

  function setValidTo($conn){
    $product=new Product($this->productName, $conn);
    $validityDuration = $product->validityDuration;
    $validTo= date('Y-m-d', strtotime($this->$validFrom. " + $validityDuration days"));
    $this->validTo=$validTo;
  }

  function setProperties($id, $conn){
    // trials (where order id is null)
    $sql="select * from user_products up, products p where up.product_id=p.id and up.id=".$this->userProductId. " and up.order_id is null;";
    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) {
      $this->uid=$row['uid'];
      $this->productName=$row['name'];
      $this->validFrom=$row['valid_from'];
    }

    // purchased products where there's an order id - update purchased price, purchased currency and purchased date

    $sql="select up.id, up.uid, p.name, up.valid_from, up.valid_to, pp.currency, pp.amount,
    t.date as purchase_date, t.method from user_products up, products p, orders o, transactions t,
    product_prices pp where up.product_id=p.id and up.order_id=o.id and pp.id=o.product_price_id and o.id=t.order_id and up.id=".$this->userProductId.";";

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) {
      $this->uid=$row['uid'];
      $this->productName=$row['name'];
      $this->validFrom=$row['valid_from'];
      $this->validTo=$row['valid_to'];
      $this->purchaseCurrency=$row['currency'];
      $this->purchasePrice=$row['amount'];
      $this->purchaseMethod=$row['method'];
      $this->purchaseDate=$row['purchase_date'];
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

  function setTrainerStats($conn){
    //uid:
      //total: x
      //completed: y
    //...

    // first get list of trainer uids who are on the user product
    $trainerUids=[];
    $sql = "select distinct u.uid from user_products up, sessions s, user_assignments ua, users u
        where up.id=s.user_product_id and s.id=ua.session_id and u.uid=ua.uid and u.user_type_id=1 and up.id=$this->userProductId";
    $stmt = mysqli_stmt_init($conn); mysqli_stmt_prepare($stmt, $sql); mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = $result->fetch_assoc()) {
      array_push($trainerUids, $row['uid']);
    }

    // then cycle through each trainer uid, collecting stats and creating the final object and pushing to
    // $this->trainerStats array for each trainer uid


    foreach ($trainerUids as $trainerUid) {

      $trainerStat = new stdClass();
      $trainerStat->uid=$trainerUid;
      $trainerStat->totalSessions=0;
      $trainerStat->completedSessions=0;


      $sql= "select count(*) as total from sessions s, user_assignments ua
            where s.id=ua.session_id and ua.uid=$trainerUid and s.user_product_id=$this->userProductId";
      $stmt = mysqli_stmt_init($conn); mysqli_stmt_prepare($stmt, $sql); mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      while($row = $result->fetch_assoc()) {
        $trainerStat->totalSessions= $row['total'];
      }

      $sql= "select count(*) as completed from sessions s, user_assignments ua
            where s.id=ua.session_id and s.completed='Y' and ua.uid=$trainerUid and s.user_product_id=$this->userProductId";
      $stmt = mysqli_stmt_init($conn); mysqli_stmt_prepare($stmt, $sql); mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      while($row = $result->fetch_assoc()) {
        $trainerStat->completedSessions= $row['completed'];
      }

      array_push($this->trainerStats, $trainerStat);
    }
  }
}

 ?>
