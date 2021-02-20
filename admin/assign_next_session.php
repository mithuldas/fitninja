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
  <title> Assign Next Session - FuNinja </title>
  <?php
  require ROOT_DIR."/includes/frameworks.php";
  ?>
</head>

<body>
<?php
include ROOT_DIR."/header.php";
?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" class="init">
  $(document).ready(function() {
  	$('#users').DataTable();
  } );
</script>

<?php

$trainers = getTrainerList($conn);

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


<div class="container">  <?php
  require ROOT_DIR."/admin/admin_subheader.php";
  ?>
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
<br>
<table id='users' class='display' style='width:100%'><thead>
  <tr>
  <th> First Name </th>
  <th> Last Name </th>
  <th> Email </th>
  <th> Phone </th>
  <th> Qualifications </th>
  <th> </th>
  </tr><thead><tbody>

<?php
foreach ($trainers as $value) {
  echo "<tr>
      <td>" . $value->firstName .
      "</td>
      <td>" . $value->lastName .
      "</td>
      <td>" . $value->email .
      "</td>
      <td>" . $value->phoneNumber .
      "</td>
      <td>" . $value->qualifiedActivitiesString .
      "</td>
      <td>
      <input class='form-check-input' type='radio' name='trainerSelect' id='trainerSelect' value='" . $value->uid . "' checked>
      </td>
      </tr>";
}

echo "</tbody></table>";
?>
<br>
<select class="form-control" name="activity">
  <?php
  foreach ($activities as $value) {
    echo "<option>".$value."</option>";
  }
  ?>
</select>


<input type='hidden' name='session' value='<?php echo $_POST['session']; ?>'>
<br><button class="btn btn-sm btn-primary mt-1" type="submit" name="edit_session">Save changes</button>

</form>

<?php

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
    array_push($trainerList, new Trainer($value, $conn));
  }

  return $trainerList;
}



?>
