<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

FlowControl::startSession();

require "header.php";
?>

<div class="container">


<center>Thanks for your inquiry. One of us will get in touch with you shortly.</center>

</center>
</div>

<?php
  require "footer.php";
?>
