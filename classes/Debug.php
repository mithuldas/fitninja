<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config.php';
require_once ROOT_DIR.'/includes/autoloader.php';
require_once ROOT_DIR.'/includes/dbh.php';

class Debug{

  static function deleteAllUsers($conn){
    $sql1 = "DELETE from user_interests;";
    $sql2 = "DELETE from session_attributes;";
    $sql3 = "DELETE from sessions;";
    $sql4 = "DELETE from user_products;";
    $sql5 = "DELETE from user_interests;";
    $sql6 = "DELETE from user_attributes;";
    $sql7 = "DELETE from tokens;";
    $sql8 = "DELETE from users;";

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
    $sql2 = "DELETE from sessions;";
    $sql3 = "DELETE from user_products;";

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
}
