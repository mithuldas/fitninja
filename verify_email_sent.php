<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

require_once ( ROOT_DIR.'/header.php' );

FlowControl::startSession();

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
