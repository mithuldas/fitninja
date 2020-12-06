<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );

Controller::startSession();

class Trainee extends User{

  public $plans=[];
  public $activePlan;
  public $isNew;

  function __construct($uid, $conn) {
    parent::__construct($uid, $conn);
    $this->setIsNew($conn);
    $this->loadPlans($conn);
    $this->setActivePlan($conn);
  }

  function setIsNew($conn){ //
    $sql = "select * from user_products, products where user_products.product_id=products.id and
            uid=".$this->uid.";";

    $stmt = mysqli_stmt_init($conn);

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

  function submitTrialRequest($trialType, $trialDate, $trialTimeSlot, $conn){
    // insert user_products entry for Trial
    $sql = "INSERT INTO user_products (id, uid, product_id, valid_from, valid_to) VALUES (NULL,".
       $this->uid .", '1', (select date(sysdate()) from dual), NULL);";
    $stmt = mysqli_stmt_init($conn);
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

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      return false;
      exit();
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      $userProductId=$row['id'];

    }
    // insert sessions

    $sql = "INSERT INTO sessions (sequence, user_product_id, planned_trainers, planned_trainees, filled_trainers, filled_trainees)
            VALUES (1,".$userProductId.", 1, 1, 0, 0)";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
      return false;
      exit();
    }
    else{
      mysqli_stmt_execute($stmt);
    }

    // now get the session id so that we can insert session attributes

    // insert session attributes but first get the session id first
    $sql = "select id from sessions where user_product_id =".$userProductId;
    $stmt = mysqli_stmt_init($conn);
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

    $sql1 = "INSERT INTO session_attributes (session_id, attribute_id, attribute_value, valid_from, valid_to) VALUES (".$sessionId.", (select attribute_id from session_attribute_definitions where attribute_name='preferredTrialType'), '".$trialType."', (select date(sysdate()) from dual), NULL);";
    $sql2 = "INSERT INTO session_attributes (session_id, attribute_id, attribute_value, valid_from, valid_to) VALUES (".$sessionId.", (select attribute_id from session_attribute_definitions where attribute_name='preferredTrialDate'), '".$trialDate."', (select date(sysdate()) from dual), NULL);";
    $sql3 = "INSERT INTO session_attributes (session_id, attribute_id, attribute_value, valid_from, valid_to) VALUES (".$sessionId.", (select attribute_id from session_attribute_definitions where attribute_name='preferredTrialTimeSlot'), '".$trialTimeSlot."', (select date(sysdate()) from dual), NULL);";

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql1);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql2);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql3);
    mysqli_stmt_execute($stmt);

    return true;

  }

  function getUnassignedProducts($conn){ // return a list of UserProduct objects containing at least product name and from date
    $unassignedProducts = [];

    $sql = "select up.id from user_products up, sessions s, products p where p.id=up.product_id and up.id=s.user_product_id and s.sequence=1 and s.filled_trainers=0 and up.uid=".$this->uid.";";
    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) {
      $userProductId=$row['id'];
      array_push($unassignedProducts, new UserProduct($userProductId, $conn));
    }

    return $unassignedProducts;
  }

  function addNewOrder($productPriceID, $externalOrderID, $conn){ // function only called when successful order object received from payment gateway
    // insert order details into order table

    $sql = "insert into orders (uid, product_price_id, date, external_id) values (?, ?, (select sysdate() from dual), ?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $this->uid, $productPriceID, $externalOrderID);

    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_affected_rows($stmt)<1){
      return 0;
      exit();
    } else {
      return 1;
    }
  }

  function addProduct($externalPaymentID, $conn){
    // determine the product to be added as well as start date and, //add the product to user_products
    $sql = "insert into user_products (uid, product_id, order_id, valid_from) (select o.uid, pp.product_id, o.id, t.date from transactions t, orders o, product_prices pp, products p where t.order_id=o.id and o.product_price_id=pp.id and pp.product_id=p.id and t.external_id=?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $externalPaymentID);

    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_affected_rows($stmt)<1){
      echo "couldn't add user product";
      exit();
    }

    // get number of sessions to add

    $product = Helper::getProductLinkedToPaymentId($externalPaymentID, $conn);
    $sessionCount = $product->numberOfSessions;

    // insert sessions
    for ($i=1; $i <= $sessionCount; $i++) {
      $sql = "insert into sessions (sequence, user_product_id, planned_trainers, planned_trainees, filled_trainers, filled_trainees)
              (select $i, up.id, 1, 1, 0, 0 from transactions t, orders o, user_products up where t.order_id=o.id and up.order_id=o.id and t.external_id=?)";

      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
        exit();
      }
      else{
        mysqli_stmt_bind_param($stmt, "s", $externalPaymentID);
        mysqli_stmt_execute($stmt);
      }
    }

    return true;
  }

  function loadPlans($conn){
    $sql="select * from user_products where uid=" .$this->uid. " and product_id<>'1';";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes
      $userProductId=$row['id'];
      array_push($this->plans, new UserProduct($userProductId, $conn));
    }
  }

  function setActivePlan($conn){
    foreach ($this->plans as $value) {
      if($value->isActive){
        $this->activePlan=$value;
      }
    }
  }

  function getTrainerList($conn){
    $trainers=[];
    $sql="select distinct ua.uid from user_products up,  sessions s, user_assignments ua where up.id=s.user_product_id and ua.session_id=s.id and ua.uid<>$this->uid and up.uid=$this->uid;";
    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes
      $trainerUID=$row['uid'];
      array_push($trainers, new Trainer($trainerUID, $conn));
    }
    return $trainers;
  }
}

 ?>
