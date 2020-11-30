<?php

require_once __DIR__.'/../config.php';
require_once ROOT_DIR.'/includes/autoloader.php' ;
require ROOT_DIR . '/vendor/autoload.php';

use \Firebase\JWT\JWT;

class Activity {
  static function getName($activityId, $conn){
    $sql = "select name from activity_types where id='".$activityId."';";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all session properties
        return $row['name'];
      }
      return 0;
    }
  }

  static function getId($activityName, $conn){
    $sql = "select id from activity_types where name='".$activityName."';";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all session properties
        return $row['id'];
      }
      return 0;
    }
  }
}
?>
