<?php
require_once __DIR__.'/../config.php';

require_once ROOT_DIR.'/vendor/autoload.php';
require_once ROOT_DIR.'/includes/autoloader.php';
require_once ROOT_DIR.'/includes/dbh.php';

$message = nl2br(htmlspecialchars($_POST['message']));
$message = "<b>Name:</b> ".$_POST['name']."<BR><b>Email:</b> ".$_POST['email']."<BR><b>Phone #:</b> ".$_POST['phone']."<BR><b>Message:</b><BR><BR> ".$message;

$captcha=$_POST['g-recaptcha-response'];

        $secretKey = "6LcUPlYaAAAAAMdUF6HzPfJTCWSdisssvZSvRB7D";
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        // should return JSON with success as true
        if($responseKeys["success"]) {
                Email::sendContactEmail($_POST['subject'], $message, $_POST['name'], $_POST['email'], $_POST['phone']);
                header("Location: /contact_sucess.php");
                exit();
        } else {
                header("Location: /contact.php");
        }


?>
