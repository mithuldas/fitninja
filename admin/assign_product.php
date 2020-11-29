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

$date = date_create($session->trialDate);
$dateString= date_format($date,"Y-m-d");

$trainers = getTrainerList($conn);

$allMinutes = [];
$allHours = [];

for ($i=0; $i <60 ; $i++) {
  array_push($allMinutes,str_pad($i, 2, "0", STR_PAD_LEFT));
}

for ($i=0; $i <24 ; $i++) {
  array_push($allHours,str_pad($i, 2, "0", STR_PAD_LEFT));
}

$trainers = getTrainerList($conn);
?>

<div class="container">
  <h5> Assign Trainee to Trainer </h5><br>
<form action = "process_product_assignment.php" method="post">

  <div class="form-group">
    <fieldset class="form-inline">
      <input class="form-control" type="date"  id="date" name="date" value="<?php echo $dateString;?>">
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
  </div>
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
</select>
  4) Session type: <br>
<select class="form-control" name="sessionType">
  <?php
  foreach ($trialProductList as $value) {
    echo "<option>".$value."</option>";
  }
  ?>
</select>

<input type='hidden' name='firstSession' value='<?php echo $_POST['session']; ?>'>
<br><button class="btn-sm btn-primary mt-1" type="submit" name="scheduleFirstSession">Schedule the first session</button>
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
