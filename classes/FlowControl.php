<?php

require_once __DIR__.'/../config.php';
require_once ROOT_DIR.'/includes/autoloader.php' ;

class FlowControl {

  static function redirectIfNotLoggedIn(){
    if(!isset($_SESSION['uid'])){
      header("Location: /index.php?notLoggedIn");
      exit();
    }
  }

  static function redirectIfWrongUserType($userType){
    if(isset($_SESSION['userType']) and $_SESSION['userType']!=$userType){
      header("Location: includes/post_login_landing_controller.php");
      exit();
    }
  }

  static function startSession(){
    if(!isset($_SESSION)){
      session_start();
    }
  }

}
