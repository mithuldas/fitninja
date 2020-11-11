<?php

include_once __DIR__.'/../config.php';
require_once ROOT_DIR.'/includes/dbh.php';
include_once ROOT_DIR.'/includes/autoloader.php';
require_once ROOT_DIR."/header.php";
?>

<div class="container">
  <form class="form-signin" action="/includes/send_new_trainer_or_admin_onboard_email.php" method="post">
    <p id="statusMessage" style="color:red"> <p>
    <input type="hidden" name="type" value="<?php echo $_GET["type"]; ?>" />
    <input type="email" name="email" class="form-control" placeholder="E-Mail ID" required autofocus>
    <button class="btn btn-primary mt-2" type="submit" name="new_trainer_admin">Send a Link</button>
  </form>
</div>

<?php
  require_once ROOT_DIR."/footer.php";
?>

<script>
  var statusMessage = "<?php echo $_GET['status']; ?>";
  var email = "<?php echo $_GET['email']; ?>";
  console.log(statusMessage);

  if(statusMessage=="emailtaken"){
    $("#statusMessage").html(email + " is already an existing user. Get in touch with advanced support to resolve this.");
  }

</script>