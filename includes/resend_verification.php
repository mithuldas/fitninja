<?php
include_once (__DIR__.'/../config.php');
require_once (ROOT_DIR.'/includes/dbh.php');
include_once (ROOT_DIR.'/includes/autoloader.php');

$email = $_GET['email'];
Email::sendVerificationEmail($email, $conn);

?>
