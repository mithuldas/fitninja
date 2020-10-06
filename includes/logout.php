<?php
  require "../header.php";
?>

<?php

session_start();
session_unset();

session_destroy();

header("Location: ../index.php");
?>

<?php
  require "../footer.php";
?>
