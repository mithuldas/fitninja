<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config.php';
require_once ROOT_DIR.'/includes/autoloader.php';
require_once ROOT_DIR.'/includes/dbh.php';

class Helper{

  static function deleteAllUsers($conn){
    $sql1 = "DELETE from user_interests;";
    $sql2 = "DELETE from session_attributes;";
    $sql3 = "DELETE from sessions;";
    $sql4 = "DELETE from user_products;";
    $sql5 = "DELETE from user_interests;";
    $sql6 = "DELETE from user_attributes;";
    $sql7 = "DELETE from tokens;";
    $sql8 = "DELETE from users where username<>'admin';";

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql1);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql2);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql3);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql4);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql5);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql6);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql7);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql8);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt)<1){
      return 0;
    } else {
      return 1;
    }
  }

  static function deleteUserProducts($conn){
    $sql1 = "DELETE from session_attributes;";
    $sql2 = "DELETE from user_assignments;";
    $sql3 = "DELETE from sessions;";
    $sql4 = "DELETE from user_products;";
    $sql5 = "DELETE from transactions;";
    $sql6 = "DELETE from orders;";

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql1);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql2);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql3);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql4);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql5);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql6);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt)<1){
      return 0;
    } else {
      return 1;
    }
  }

  static function makeMeAdmin($username, $conn){
    $sql =  "update users set user_type_id=3 where username='".$username."';";
    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt)<1){
      return "failed";
    } else {
      return "success";
    }
  }


  static function resetSessionTimes($conn){
    $sql1="update user_assignments set notified='N';";
    $sql2="delete from session_attributes where attribute_id in (4,5);";
    $sql3="update sessions set sch_dt_tm=date_add(sysdate(), interval 30 minute);";
    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql1);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql2);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, $sql3);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt)<1){
      return 0;
    } else {
      return 1;
    }
  }

  static function getProductLinkedToPaymentId($externalPaymentID, $conn){
    $sql = "select p.name from transactions t, orders o, product_prices pp, products p where t.order_id=o.id and o.product_price_id=pp.id and pp.product_id=p.id and t.external_id=?";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $externalPaymentID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) { // loop through the array and set all session properties
      $productName=$row['name'];
      $product = new Product($productName, $conn);
      return $product;
    }

    return 0;


  }
}
