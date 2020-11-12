<?php

require_once __DIR__.'/../config.php';
include ROOT_DIR."/includes/autoloader.php";
include ROOT_DIR."/includes/dbh.php";


// display request property in table at the top

// receive a trial session object in json format
// convert json to php object
$session = json_decode($_POST['trialSession']);

echo("<pre>".json_encode($session, JSON_PRETTY_PRINT))."</pre>";

$trainers = getTrainerList($conn);
$timeSlots = array('6AM', '7AM', '8AM', '9AM', '10AM', '11AM', '12PM', '1PM', '2PM', '3PM', '4PM', '5PM', '6PM', '7PM', '8PM', '9PM', '10PM', '11PM');



// admin to choose a final time and trainer (form inputs)
  // trainer list dropdown
  // datepicker (calendar) and time dropdowns (every hour of the day)

// call trial session's assign function, which will take time and trainer input
  // session fills to be updated, along with the scheduled time attribute
  // create assignment rows in assignments table for trainee and trainer

// send confirmation email to trainee and trainer (in the future, SMS)



function getTrainerList($conn){
  $trainerUidList=[];
  $trainerList=[];

  $sql='select uid from users where user_type_id=1';
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
    return "sqlerror";
  } else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes
      array_push($trainerUidList, $row['uid']);
    }
  }

  foreach ($trainerUidList as $value) {
    array_push($trainerList, new User($value, $conn));
  }

  return $trainerList;
}



?>
