<?php

require_once('PHPMailer-5.2-stable/PHPMailerAutoload.php');

$mail = new PHPMailer();

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML();

$mail->Username = 'mithuldas@gmail.com';
$mail->Password = 'aeh2kpst';

$mail->SetFrom('mithuldas@gmail.com');
$mail->Subject = 'Hello from FitNinja!';
$mail->Body = 'This is a test e-mail from Mithul @ FitNinja';
$mail->AddAddress('mithul.mangaldas@sabre.com');

$mail->Send();


?>
