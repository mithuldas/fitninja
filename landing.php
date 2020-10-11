
<?php

  include "includes/autoloader.php";
  require "header.php";

  if(!isset($_SESSION['uid'])){
    header("Location: ../index.php");
  } else if ($_SESSION['userType']=="Trainee"){
    header("Location: ../trainee_landing.php");
  }
  else if ($_SESSION['userType']=="Trainer"){
    header("Location: ../trainer_landing.php");
  }
  else if ($_SESSION['userType']=="Admin"){
    header("Location: ../admin_landing.php");
  }

?>
