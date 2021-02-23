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
  <title> View Assigned Sessions - FuNinja </title>
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

<div class="container-fluid pb-2">
  <?php
  require ROOT_DIR."/admin/admin_subheader.php";
  ?>
<?php


  // similar to trials, we get all the session ids that have no assignments. Here, we check only sessions where sequence number is 1

  $assignedSessionIDs=[];
  $assignedSessions=[];

  $sql = "select s.id from sessions s, user_products up, products p where s.user_product_id=up.id and up.product_id=p.id and (s.filled_trainers>0 or s.filled_trainees>0)";

  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
    return "sqlerror";
  } else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes
      array_push($assignedSessionIDs, $row['id']);
    }
      //echo("<pre>".json_encode($assignedSessionIDs, JSON_PRETTY_PRINT))."</pre>";
  }

  // pass each trial session id and get an array of trial session objects

  foreach ($assignedSessionIDs as $value) {
    array_push($assignedSessions, new Session($value, $conn));
  }

  // display each trial session object in a table for viewing
  //echo("<pre>".json_encode($assignedSessions, JSON_PRETTY_PRINT))."</pre>";
?>

<h4> Assigned Sessions </h4><br>
  <table id='users' class='display' style='width:100%'><thead>
    <tr>
    <th> Scheduled for </th>
    <th> Duration </th>
    <th> Name </th>
    <th> Product </th>
    <th> Session # </th>
    <th> Activity </th>
    <th> Completed </th>
    <th> Next Sch</th>
    <th> Edit </th>
    <th> Assign Next </th>
    </tr><thead><tbody>

<?php
  $nextScheduled;
  $completed;

  foreach ($assignedSessions as $value) {
    $prettyDateTime = date('jS M y @ g:i A', strtotime($value->scheduledDateTimeLocal));
    if( $value->nextSessionScheduled){
      $nextScheduled="Yes";
    } else {
      $nextScheduled="No";
    }

    if( is_null($value->completed )){
      $completed="No";
    } else {
      $completed="Yes";
    }

    $sessionJSON = json_encode($value);

    $trainee = new Trainee($value->uid, $conn);
    $a = "<tr>
        <td>" . $prettyDateTime .
        "</td>
        <td>" . $value->duration .
        "</td>
        <td>" . $trainee->firstName .
        "</td>
        <td>" . $value->productName .
        "</td>
        <td>" . $value->sequence .
        "</td>
        <td>" . $value->activity .
        "</td>
        <td>" . $completed .
        "</td>
        <td>" . $nextScheduled .
        "</td>

        <td>
        <form action='/admin/edit_session.php' method='post'>
        <input type='hidden' name='session' value='". $sessionJSON."'>
        <button class='btn btn-sm btn-light' type='submit' name='edit_session'>Edit</button>
        </form>
        </td>";
    if(is_null($value->nextSessionId)){
      $b="<td></td>";
    }
    else if (!is_null($value->assignments) and $nextScheduled=="Yes"){
      $b="<td></td>";
    }
    else {
      $b = "<td>
      <form action='/admin/assign_next_session.php' method='post'>
      <input type='hidden' name='session' value='". $sessionJSON."'>
      <button class='btn btn-sm btn-light' type='submit' name='assign_next'>Assign Next</button>
      </form>
      </td>";
    }
      $c = "</tr>";

      echo $a.$b.$c;
  }

  echo "</tbody></table>";

?>

<script type="text/javascript" src="/scripts/admin_dashboard.js"> </script>

</div>


<?php
  require ROOT_DIR."/footer.php";
?>
