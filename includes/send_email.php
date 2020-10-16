<?php

require '../vendor/autoload.php';
use Mailgun\Mailgun;

  function sendEmail($to, $subject, $text, $html){

    $mailgun_API_key='9dbf4c59884d274f6b2de94cb5c38b93-2fbe671d-a5d69610';
    $mailgun_domain='mail2.fitninja.in';
    $mg = Mailgun::create($mailgun_API_key);
    $from = 'FitNinja <no-reply@fitninja.in>';

    $mg->messages()->send($mailgun_domain, [
      'from'    => $from,
      'to'      => $to,
      'subject' => $subject,
      'text'    => $text,
      'html' => $html
    ]);

  }
?>
