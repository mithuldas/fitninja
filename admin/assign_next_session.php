<?php
require_once __DIR__.'/../config.php';
include ROOT_DIR."/includes/autoloader.php";
include ROOT_DIR."/includes/dbh.php";
require ROOT_DIR."/header.php";
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

<?php

// convert json to php object
$session = json_decode($_POST['session']);

$date = date_create($session->scheduledDateTime);
$dateString= date_format($date,"Y-m-d");
$activities = Product::getActivities($conn);

$date = strtotime($session->scheduledDateTime);
$hours= date('H', $date);
$minutes = date('i', $date);

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
  <h5> Assign next session </h5><br>

<form action = "process_next_session_assignment.php" method="post">

<fieldset class="form-inline">
  <input class="form-control" type="date"  id="date" name="date">
<select class="form-control" name="hour">
  <?php
  foreach ($allHours as $value) {
    echo "<option>".$value."</option>";
  }
  ?>
</select>
<select class="form-control" name="minute">
  <?php
  foreach ($allMinutes as $value) {
    echo "<option>".$value."</option>";
  }
  ?>
</select>
</fieldset>
<select class="form-control" name="activity">
  <?php
  foreach ($activities as $value) {
    echo "<option>".$value."</option>";
  }
  ?>
</select>
<input type='hidden' name='session' value='<?php echo $_POST['session']; ?>'>
<br><button class="btn-sm btn-primary mt-1" type="submit" name="edit_session">Save changes</button>

</form>
