<?php

include_once (__DIR__.'/../config.php');
require_once (ROOT_DIR.'/includes/dbh.php');
include_once (ROOT_DIR.'/includes/autoloader.php');

$currentUser = json_decode($_POST['currentUser']);

$trialType = $_POST['trialType'];
$trialDate = $_POST['trialDate'];
$trialTimeSlot = $_POST['trialTimeSlot'];
$comments = $_POST['comments'];

$user = new Trainee($currentUser->uid, $conn);

//($name, $trialType, $trialDate, $trialTimeSlot, $email, $phone, $conn)
if($user->submitTrialRequest($trialType, $trialDate, $trialTimeSlot, $comments, $conn)){
  Email::sendTrialRequestConfirmationEmail($currentUser->firstName, $trialType, $trialDate, $trialTimeSlot, $currentUser->email, $currentUser->phoneNumber, $conn);
  header("Location: /request_trial_success.php");

} else {
  echo "failure";
}
