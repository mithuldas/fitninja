<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );

class UserProduct{
  public $userProductId;
  public $uid;
  public $productName;
  public $validFrom;
  public $validTo;

  function __construct($id, $conn) {
    $this->userProductId=$id;
    $this->setProperties($id, $conn);
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
}

 ?>
