<?php

include_once (__DIR__.'/../config.php');
require_once (ROOT_DIR.'/includes/dbh.php');
include_once (ROOT_DIR.'/includes/autoloader.php');


$currentUser = (object) $_POST['currentUser'];

$trialType = $_POST['trialType'];
$trialDate = $_POST['trialDate'];
$trialTimeSlot = $_POST['trialTimeSlot'];


// insert into user_products first with product name = trial
// insert into session
//

$user = new Trainee($currentUser->uid, $conn);

if($user->submitTrialRequest($trialType, $trialDate, $trialTimeSlot)){
  echo "success";
} else {
  echo "failure";
}



?>
