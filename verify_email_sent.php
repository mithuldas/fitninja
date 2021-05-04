<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> Home - Premium Personal Training - FuNinja </title>
  <?php
  require ROOT_DIR."/includes/frameworks.php";
  ?>
</head>

<body>
<?php
include ROOT_DIR."/header.php";
?>

<div class="container">
<div class="row text-center ml-1 mr-1 mt-4 pt-4 pb-4 userdropdown orderConfirmationContainer" style="background:white">
  <div class="col ">
    We've sent an email to <b><?php echo $_GET['email'];?></b>. Please click the link in the email to verify before proceeding.

  </div>
</div>

</div>


<?php
  require "footer.php";
?>
