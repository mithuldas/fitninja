<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );

class ProductPrice {

  public $id;
  public $currency;
  public $amount;
  public $validFrom;
  public $validTo;

  function __construct($id, $conn) {
    $sql = "select * from product_prices where id=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$row = mysqli_fetch_assoc($result)) {
      return false;
    } else {
      $this->id=$row["id"];
      $this->currency=$row["currency"];
      $this->amount=$row["amount"];
      $this->validFrom=$row["valid_from"];
      $this->validTo=$row["valid_to"];
    }
  }
}
?>
