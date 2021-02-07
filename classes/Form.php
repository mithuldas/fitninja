<?php
// class with helper functions for customer data forms

class Form {

  static function getCurrentFormVersion($conn){
    $sql = "select id from form_versions where current_version='Y'";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) { // loop through the array and set all session properties
      return $row['id'];
    }
  }

  public $version;

}
