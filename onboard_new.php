<?php

  include "includes/autoloader.php";
  require "header.php";
  include "includes/dbh.php";
?>

<div class="container">
  <form class="form-signin" action="includes/send_onboard_email.php" method="post">
    <input type="hidden" name="type" value="<?php echo $_GET["type"]; ?>" />
    <input type="email" name="email" class="form-control" placeholder="E-Mail ID" required autofocus>
    <button class="btn btn-primary mt-2" type="submit" name="onboard_new">Send a Link</button>
  </form>
</div>

<?php
  require "footer.php";
?>
