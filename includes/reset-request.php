<?php

# Include the Autoloader (see "Libraries" for install instructions)
require '../vendor/autoload.php';
use Mailgun\Mailgun;


if (isset($_POST["resetpwd-submit"])){

  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);


  $url = "http://localhost/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

  $expires = date("U") + 1800;

  require 'dbh.php';

  $userEmail = $_POST["email"];

  $sql = "delete from pwdreset where pwdresetemail = ?;";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "There was an error!";
    exit();
  } else {

    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
  }

  $sql = "insert into pwdreset (pwdresetemail, pwdresetselector, pwdresettoken, pwdresetexpires)
            values (?, ?, ?, ?);";

  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "There was an error!";
    exit();
  } else {
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
    mysqli_stmt_execute($stmt);
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);

  $to = $userEmail;

  $subject = 'Reset your FitNinja password';
  $message = '<p>Please click the link below to reset your password: </p>';
  $message .= '<p><a href="' . $url . '">' . $url . '</a> </p>';
  $message .= 'Regards,<br>' . 'The FitNinja Team';

  // First, instantiate the SDK with your API credentials
  $mg = Mailgun::create('9dbf4c59884d274f6b2de94cb5c38b93-2fbe671d-a5d69610'); // For US servers

  // Now, compose and send your message.
  // $mg->messages()->send($domain, $params);
  $mg->messages()->send('mail2.fitninja.in', [
    'from'    => 'FitNinja <no-reply@fitninja.in>',
    'to'      => $to,
    'subject' => $subject,
    'text'    => $message,
    'html' => $message
  ]);


  #mail($to, $subject, $message, $headers);

  header("Location: ../forgot-password.php?reset=success");

}

else{
  header("Location: ../forgot-password.php");
}
