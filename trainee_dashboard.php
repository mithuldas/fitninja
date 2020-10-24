<?php

include "includes/autoloader.php";

if(!isset($_SESSION)){
  session_start();
}

if(!isset($_SESSION['uid'])){
  header("Location: index.php?notLoggedIn");
  exit();
}

if($_SESSION['userType']!="Trainee"){
  header("Location: includes/post_login_landing_controller.php");
  exit();
}
?>

<?php
require "header.php";

echo "Welcome to the Dashboard.";
?>


<?php
  require "footer.php";
?>
