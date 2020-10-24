
<?php

  include "includes/autoloader.php";

  if(!isset($_SESSION)){
    session_start();
  }

  if(!isset($_SESSION['uid'])){

    header("Location: ../index.php");
    exit();
  }
  else {
    header("Location: ../admin_dashboard.php");
    exit();
  }

?>
