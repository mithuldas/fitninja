<?php

require_once __DIR__.'/../config.php';
include ROOT_DIR."/includes/autoloader.php";
include ROOT_DIR."/includes/dbh.php";

  if(!isset($_SESSION)){
    session_start();
  }

  if(!isset($_SESSION['uid'])){
    header("Location: /index.php?notLoggedIn");
    exit();
  }

  if($_SESSION['userType']!="Admin"){
    header("Location: /includes/post_login_landing_controller.php");
    exit();
  }

  require ROOT_DIR."/header.php";
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" class="init">
  $(document).ready(function() {
  	$('#users').DataTable();
  } );
</script>

<div class="container">
<?php


  // get all unassigned trial session ids from the sessions table

  $unassignedTrialIDs=[];
  $unassignedTrialSessions=[];

  $sql = "select s.id from sessions s, user_products up, products p where s.user_product_id=up.id and up.product_id=p.id and p.name='Trial' and s.filled_trainers=0 and s.filled_trainees=0";

  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
    return "sqlerror";
  } else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes
      array_push($unassignedTrialIDs, $row['id']);
    }
      //echo("<pre>".json_encode($unassignedTrialIDs, JSON_PRETTY_PRINT))."</pre>";
  }

  // pass each trial session id and get an array of trial session objects

  foreach ($unassignedTrialIDs as $value) {
    array_push($unassignedTrialSessions, new TrialSession($value, $conn));
  }
    //echo("<pre>".json_encode($unassignedTrialSessions, JSON_PRETTY_PRINT))."</pre>";

  // display each trial session object in a table for viewing

?>

<h4> Requests for Trial </h4><br>
  <table id='users' class='display' style='width:100%'><thead>
    <tr>
    <th> Date submitted </th>
    <th> Name </th>
    <th> Phone </th>
    <th> Email </th>
    <th> Type </th>
    <th> Date </th>
    <th> Time Slot </th>
    <th>  </th>
    </tr><thead><tbody>

<?php
  foreach ($unassignedTrialSessions as $value) {

    $trainee = new Trainee($value->uid, $conn);
    echo "<tr>
        <td>" . $value->dateCreated .
        "</td>
        <td>" . $trainee->firstName .
        "</td>
        <td>" . $trainee->email .
        "</td>
        <td>" . $trainee->phoneNumber .
        "</td>
        <td>" . $value->trialType .
        "</td>
        <td>" . $value->trialDate .
        "</td>
        <td>" . $value->trialTimeSlot .
        "</td>
        <td> <a href='new_trainer_admin.php?type=Admin' class='btn-sm btn-light active'>Process</a>
        </td>
        </tr>";
  }

  echo "</tbody></table>";

?>

<script type="text/javascript" src="/scripts/admin_dashboard.js"> </script>

</div>


<?php
  require ROOT_DIR."/footer.php";
?>
