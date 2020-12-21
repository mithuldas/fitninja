<?php

include_once (__DIR__.'/../config.php');
require_once (ROOT_DIR.'/includes/dbh.php');
include_once (ROOT_DIR.'/includes/autoloader.php');

FlowControl::startSession();
$_SESSION['selectedProduct']=$_POST['product'];

if(isset($_SESSION['uid'])){ // logged in
  echo "loggedIn";
} else {
  echo "notLoggedIn";
}
