
<?php

  include "includes/autoloader.php";
  require "header.php";

  if(!isset($_SESSION['uid'])){
    header("Location: ../index.php");
  }


?>

You are a trainer
