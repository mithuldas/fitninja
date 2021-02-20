<?php
require_once __DIR__.'/../config.php';
include ROOT_DIR."/includes/autoloader.php";
include ROOT_DIR."/includes/dbh.php";

FlowControl::startSession();
FlowControl::redirectIfNotLoggedIn();
FlowControl::redirectIfWrongUserType("Admin");

include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> Edit Session - FuNinja </title>
  <?php
  require ROOT_DIR."/includes/frameworks.php";
  ?>
</head>

<body>
<?php
include ROOT_DIR."/header.php";
?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

<?php

// convert json to php object
$session = json_decode($_POST['session']);

$date = date_create($session->scheduledDateTime);
$dateString= date_format($date,"Y-m-d");

$date = strtotime($session->scheduledDateTime);
$hours= date('H', $date);
$minutes = date('i', $date);

$activities = Product::getActivities($conn);

$allMinutes = [];
$allHours = [];

for ($i=0; $i <60 ; $i++) {
  array_push($allMinutes,str_pad($i, 2, "0", STR_PAD_LEFT));
}

for ($i=0; $i <24 ; $i++) {
  array_push($allHours,str_pad($i, 2, "0", STR_PAD_LEFT));
}

?>

<script>

var dateTimeString = '<?php echo $session->scheduledDateTime; ?>';
var date = new Date(dateTimeString);
var hours = date.getHours();
var minutes = date.getMinutes();



var completedFlag = '<?php echo $session->completed; ?>';
$(document).ready(function(){
  if(completedFlag=="Y"){
    console.log("hi");
    $("#completed").attr('checked', 'checked');
  }
});
</script>


<div class="container">
  <h5> Edit a session </h5><br>

<form action = "process_edit_session.php" method="post">


  <div class="form-check pb-2">
    <input class="form-check-input" type="checkbox" value="Y" id="completed" name="completedFlag">
    <label class="form-check-label" for="completed">Session completed</label>
  </div>

<div class="form-group">
<fieldset class="form-inline">
  <input class="form-control" type="date"  id="date" name="date" value = <?php echo $dateString; ?>>
<select class="form-control" name="hour">
  <?php
  foreach ($allHours as $value) {
    if($value==$hours){
      echo "<option selected>".$value."</option>";
    } else {
      echo "<option>".$value."</option>";
    }

  }
  ?>
</select>
<select class="form-control" name="minute">
  <?php
  foreach ($allMinutes as $value) {
    if($value==$minutes){
      echo "<option selected>".$value."</option>";
    } else {
      echo "<option>".$value."</option>";
    }
  }
  ?>
</select>
</fieldset>
</div>
<div class="form-group">
<select class="form-control" name="activity" value='<?php echo $session->activity; ?>'>
  <?php
  foreach ($activities as $value) {
    if($value==$session->activity){
      echo "<option selected>".$value."</option>";
    } else {
      echo "<option>".$value."</option>";
    }
  }
  ?>
</select>
</div>
<label for="duration">Duration</label>
<input class="form-control" type='number' name='duration' id='duration' value='<?php echo $session->duration; ?>'>
<br>
<input type='hidden' name='session' value='<?php echo $_POST['session']; ?>'>
<button class="btn btn-sm btn-primary mt-1" type="submit" name="edit_session">Save changes</button>

</form>
