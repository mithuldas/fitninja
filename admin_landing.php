<?php

  include "includes/autoloader.php";
  require "header.php";
  include "includes/dbh.php";

?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" class="init">


$(document).ready(function() {
	$('#users').DataTable();
} );

	</script>

<?php


  if(!isset($_SESSION['uid'])){
    header("Location: ../index.php");
  }

  $sql = 'select * from users a, user_types b where a.user_type_id=b.user_type_id';

  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../index.php?error=sqlerror");
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

         </td><td><a href='http://www.google.com'>" . $row['username'] .
         "</a><td>" . $row['email'] .
         "</td>

         <td>" . $row['user_type_desc'] .
         "</td>
         </tr>";
    }

    echo "</tbody></table>";

  }

?>
