<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ROOT_DIR.'/includes/autoloader.php';
require_once ROOT_DIR.'/includes/dbh.php';

require "header.php";

echo "Payment success.<BR> Payment ID: ".$_GET['gatewayResponse'];
echo "<BR>Add receipt / payment details and message that receipt has been sent to the user's email.<BR>";

echo "<a href='trainee_dashboard.php'>Continue</a>";

?>
