<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );

class Product {

  public $id;
  public $productName;
  public $currentPriceINR;
  public $numberOfSessions;
  public $validityDuration;

  function __construct($name, $conn) {
    $this->productName = $name;
    $this->setCurrentPrices($conn);
    $this->setAttributes($conn);
  }

  function setAttributes($conn){
    $sql = "select pad.attribute_name, pa.attribute_value from products p, product_attribute_definitions pad, product_attributes pa
            where p.name = '".$this->productName."' and p.id=pa.product_id and pa.attribute_id=pad.id and sysdate() BETWEEN pa.valid_from and
            IFNULL(pa.valid_to,  DATE_ADD(sysdate(), INTERVAL 1 YEAR) );";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes

        switch ($row['attribute_name']) {
          case "number of sessions":
            $this->numberOfSessions = $row['attribute_value'];
            break;
          case "valid days":
            $this->validityDuration = $row['attribute_value'];
            break;
          }
      }
    }
  }

  static function getActivities($conn){
    $sql = "select * from activity_types;";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $productList = [];

      while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes
        array_push($productList, $row['name']);
      }

      return $productList;
    }

  }

  function setCurrentPrices($conn){
    $sql="select pp.id from products p, product_prices pp where p.id=pp.product_id and p.name=? and pp.currency=?";

    // Indian Rupees
    $currency="INR";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $this->productName, $currency);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$row = mysqli_fetch_assoc($result)) {
      return false;
    } else {
      $this->currentPriceINR=new ProductPrice($row["id"], $conn);
    }
  }
}
?>
