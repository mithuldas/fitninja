<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );

class Product {

  public $productName;
  public $conn;

  function __construct($name, $conn) {
    $this->productName = $name;
    $this->conn = $conn;
    $this->setProductAttributes();
  }

  function setProductAttributes(){
    $sql = "select pad.attribute_name, pa.attribute_value from products p, product_attribute_definitions pad, product_attributes pa
            where p.name = ".$this->productName." and p.id=pa.product_id and pa.attribute_id=pad.id and sysdate() BETWEEN pa.valid_from and
            IFNULL(pa.valid_to,  DATE_ADD(sysdate(), INTERVAL 1 YEAR) );";

    $stmt = mysqli_stmt_init($this->conn);

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
          }
      }
    }
  }

  static function getProductsAvailableForTrial($conn){
    $sql = "select p.name from products p, product_attribute_definitions pad, product_attributes pa
            where p.id=pa.product_id and pa.attribute_id=pad.id and sysdate() BETWEEN pa.valid_from and
            IFNULL(pa.valid_to,  DATE_ADD(sysdate(), INTERVAL 1 YEAR)) and pa.attribute_value=\"Y\" and pad.attribute_name=\"available_for_trial\";";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $productList = $result->fetch_all();
      return $productList;
    }

  }
}
?>
