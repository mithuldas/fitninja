<?php
class Password {
  public $password;
  public $repeatPassword;

  function __construct($password, $repeatPassword) {
    $this->password = $password;
    $this->repeatPassword = $repeatPassword;
  }

  function isLongEnough(){
    $length = strlen($this->password);
    if($length>=8){
      return true;
    }
    else {
      return false;
    }
  }

  function isComplexEnough(){
    // check if uppercase, lower case and a number exists
    $containsLowerCase  =   preg_match('/[a-z]/', $this->password);
    $containsUpperCase  =   preg_match('/[A-Z]/', $this->password);
    $containsDigit   =      preg_match('/\d/', $this->password);

    $containsAll = $containsLowerCase && $containsUpperCase && $containsDigit;
    if(!$containsAll){
      return false;
    } else {
      return true;
    }
  }

  function doesMatch(){
    if ($this->password != $this->repeatPassword){
      return false;
    } else {
      return true;
    }
  }

  function hasEmptyFields(){
    if(empty($this->password) || empty($this->repeatPassword)){
      return true;
    } else {
      return false;
    }
  }
}
?>
