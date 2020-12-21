<?php

include "dbh.php";

if(!isset($_SESSION)){
  session_start();
}

// send them back to the login screen
if(!isset($_SESSION['uid'])){
  header("Location: ../index.php?notLoggedIn");
  exit();
}

// trainee controller
if ($_SESSION['userType']=="Trainee" and isset($_SESSION['selectedProduct'])){
  header("Location: /confirm_plan.php?"."product=".$_SESSION['selectedProduct']);
  exit();
} else if ($_SESSION['userType']=="Trainee"){
  header("Location: ../trainee_landing.php");
  exit();
}


// trainer controller
if ($_SESSION['userType']=="Trainer"){
  header("Location: ../trainer_landing.php");
  exit();
}

// admin controller
if ($_SESSION['userType']=="Admin"){
  header("Location: /admin/admin_landing.php");
  exit();
}
?>
