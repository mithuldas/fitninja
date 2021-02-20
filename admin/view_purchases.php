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
  <title> View Purchases - FuNinja </title>
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

<div class="container">
  <?php require ROOT_DIR."/admin/admin_subheader.php" ?>

<?php


  // similar to trials, we get all the session ids that have no assignments. Here, we check only sessions where sequence number is 1

  $unassignedSessionIDs=[];
  $unassignedSessions=[];

  $sql = "select s.id from sessions s, user_products up, products p where s.user_product_id=up.id and up.product_id=p.id and p.name<>'Trial' and s.sequence=1";

  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
    return "sqlerror";
  } else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes
      array_push($unassignedSessionIDs, $row['id']);
    }
      //echo("<pre>".json_encode($unassignedTrialIDs, JSON_PRETTY_PRINT))."</pre>";
  }

  // pass each trial session id and get an array of trial session objects

  foreach ($unassignedSessionIDs as $value) {
    array_push($unassignedSessions, new Session($value, $conn));
  }

  // display each trial session object in a table for viewing
  //echo("<pre>".json_encode($unassignedSessions, JSON_PRETTY_PRINT))."</pre>";


?>

<h4> Purchases </h4><br>
  <table id='users' class='display' style='width:100%'><thead>
    <tr>
    <th> Purchase date </th>
    <th> Product </th>
    <th> Name </th>
    <th> Phone </th>
    <th> Email </th>
    <th>  </th>
    <th>  </th>
    </tr><thead><tbody>

<?php
  foreach ($unassignedSessions as $value) {

    $sessionJSON = json_encode($value);

    $upid=$value->getUserProductId($conn);
    $up = new UserProduct($upid, $conn);
    if($up->customerDataCollected){
      $btnHighlight = "btn-success";
    } else {
      $btnHighlight="btn-danger";
    }



    $trainee = new Trainee($value->uid, $conn);
    echo "<tr>
        <td>" . $value->dateCreated .
        "</td>
        <td>" . $value->productName .
        "</td>
        <td>" . $trainee->firstName .
        "</td>
        <td>" . $trainee->phoneNumber .
        "</td>
        <td>" . $trainee->email .
        "</td>
        <td>
        <form action='/admin/assign_product.php' method='post'>
        <input type='hidden' name='session' value='". $sessionJSON."'>
        <button class='btn btn-sm btn-light' type='submit' name='schedule-trial'>Schedule</button>
        </form>
        </td>
        <td>
        <form action='/admin/data_collector_form.php' method='post'>
        <input type='hidden' name='session' value='". $sessionJSON."'>
        <button class='btn btn-sm $btnHighlight' type='submit' name='schedule-trial'>Form</button>
        </form>
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
