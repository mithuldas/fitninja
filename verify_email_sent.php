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
<div class="row text-center ml-1 mr-1 userdropdown orderConfirmationContainer" style="background:white">
  <div class="col ">
    <br><br>We've sent you an email at <b><u><?php echo $_GET['email'];?></b></u> to make sure that you own the email account. Please click the link in it to login!
    <br><br><br>
  </div>
</div>

</div>


<?php
  require "footer.php";
?>
