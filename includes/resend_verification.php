<?php
require 'send_verification_email.php';

$email = $_GET['email'];
sendVerificationEmail($email);

?>
