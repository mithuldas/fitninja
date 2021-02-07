<?php
// class with helper functions for customer data forms

class Form {

  public $version;
  public $userProductId;
  public $answers=[];

  function __construct($userProductId, $conn) { // construct a session object (i.e a row in the session table, given an id )
    $this->userProductId = $userProductId;
    $this->setVersion($conn);
    $this->loadAnswerSet($conn);
  }

  function setVersion($conn){
    $sql = "select form_version from form_saved where user_product_id=$this->userProductId;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) { // loop through the array and set all session properties
      $this->version=$row['form_version'];
    }
  }

  function loadAnswerSet($conn){
    // get number of questions in the version

    $sql = "select max(seq_nr) as max from form_questions where form_version=$this->version;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) { // loop through the array and set all session properties
      $numQuestions=$row['max'];
    }

    for ($i=1; $i <=$numQuestions ; $i++) {
      $subQuery="select id from form_saved where user_product_id=$this->userProductId";
      $sql = "select answer from form_saved_data where saved_form_id in ($subQuery) and question_id=$i;";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all session properties
        $answer=$row['answer'];
      }

      array_push($this->answers, $answer);
    }
  }

  static function checkIfFormForUserProductExists($userProductId, $conn){
    $sql = "select id from form_saved where user_product_id=$userProductId";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) {
      return true;
    }


    return false;
  }

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

}
