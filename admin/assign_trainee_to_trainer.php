<?php

require_once __DIR__.'/../config.php';
include ROOT_DIR."/includes/autoloader.php";
include ROOT_DIR."/includes/dbh.php";

require ROOT_DIR."/header.php";

?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" class="init">
  $(document).ready(function() {
  	$('#users').DataTable();
  } );
</script>

<?php

// convert json to php object
$session = json_decode($_POST['session']);

$trainers = getTrainerList($conn);
$timeSlots = array('6AM', '7AM', '8AM', '9AM', '10AM', '11AM', '12PM', '1PM', '2PM', '3PM', '4PM', '5PM', '6PM', '7PM', '8PM', '9PM', '10PM', '11PM');
?>

<div class="container">
  <h5> Assign Trainee to Trainer </h5><br>
<form action = "assign_trial.php" method="post">
<div class="form-group">
  1) First session date:
<input class="form-control" type="date"  id="trialDate" name="trialDate">
  2) First session time:
<select class="form-control" name="time">
  <?php
  foreach ($timeSlots as $value) {
    echo "<option>".$value."</option>";
  }
  ?>
</select>
<br>
  3) Select a trainer: <br><br>

  <table id='users' class='display' style='width:100%'><thead>
    <tr>
    <th> First Name </th>
    <th> Last Name </th>
    <th> Email </th>
    <th> Phone </th>
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
        <td>
        <input class='form-check-input' type='radio' name='trainerSelect' id='trainerSelect' value='" . $value->uid . "' checked>
        </td>
        </tr>";
  }

  echo "</tbody></table>";
?>
  <br>

</select>

<input type='hidden' name='trialSession' value='<?php echo $_POST['trialSession']; ?>'>
<br><button class="btn-sm btn-primary mt-1" type="submit" name="scheduleTrial">Schedule the first session</button>
</div>
</form>
</div>

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
    array_push($trainerList, new User($value, $conn));
  }

  return $trainerList;
}



?>
