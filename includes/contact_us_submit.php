<?php
require_once __DIR__.'/../config.php';

require_once ROOT_DIR.'/vendor/autoload.php';
require_once ROOT_DIR.'/includes/autoloader.php';
require_once ROOT_DIR.'/includes/dbh.php';

$message = nl2br(htmlspecialchars($_POST['message']));
$message = "<b>Name:</b> ".$_POST['name']."<BR><b>Email:</b> ".$_POST['email']."<BR><b>Phone #:</b> ".$_POST['phone']."<BR><b>Message:</b><BR><BR> ".$message;

Email::sendContactEmail($_POST['subject'], $message, $_POST['name'], $_POST['email'], $_POST['phone']);

header("Location: /contact_sucess.php");
exit();

?>
