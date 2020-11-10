<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

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

?>


plans page

<?php
  require "footer.php";
?>
