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

<script type="text/javascript" src="/scripts/admin_dashboard.js"> </script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" class="init">
$(document).ready(function() {
	$('#users').DataTable();
} );
</script>

<div class="container">
<div class="admin-header-div">
<?php
  if(isset($_GET['status'])){
    if($_GET['status']=='onboard_sent'){
        ?>
        <div class="alert alert-dismissible alert-secondary">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          An e-mail has been sent to <b><?php echo $_GET['email'] ?> </b>with the onboarding link
        </div>
        <?php
    }
  }
?>

<a href="new_trainer_admin.php?type=Trainer" class="btn-sm btn-light">New Trainer</a>
<a href="new_trainer_admin.php?type=Admin" class="btn-sm btn-light">New Admin</a>
<a href="new_trainer_admin.php?type=Admin" class="btn-sm btn-light active">User List</a>
<a href="trial_requests.php" class="btn-sm btn-light">Trial Requests</a>
<a href="new_trainer_admin.php?type=Admin" class="btn-sm btn-light">Unassigned Trainees</a>
</div>
<br>
<div class="admin-main-div">
<h4> User List </h4><br>
<?php
// full user list table

$sql = 'select * from users a, user_types b where a.user_type_id=b.user_type_id';
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)){
  header("Location: /index.php?error=sqlerror");
  exit();
}
else{
  mysqli_stmt_execute($stmt);

    echo "<table id='users' class='display' style='width:100%'><thead>
    <tr>
    <th> Username </th>
    <th> E-mail </th>
    <th> User type </th>
    </tr><thead><tbody>" ;
  $result = mysqli_stmt_get_result($stmt);
  while($row = mysqli_fetch_assoc($result))
  {
   echo "<tr>
       </td><td>" . $row['username'] .
       "<td>" . $row['email'] .
       "</td>
       <td>" . $row['user_type_desc'] .
       "</td>
       </tr>";
  }
  echo "</tbody></table>";
}

?>

</div>
<br>

<a href="debug_functions.php?action=deleteAllUsers" class="btn-sm btn-danger">Delete Users</a>
<a href="debug_functions.php?action=deleteUserProducts" class="btn-sm btn-danger">Delete User Products</a>
</div>

<?php
  require ROOT_DIR."/footer.php";
?>
