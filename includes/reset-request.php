<?php

require_once('../PHPMailer-5.2-stable/PHPMailerAutoload.php');

if (isset($_POST["resetpwd-submit"])){

  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);


  $url = "localhost/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

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
  $subject = 'Reset your password for Fitninja.in';
  $message = '<p>Please click the link below to reset your password: </p>';
  $message .= '<p><a href="' . $url . '">' . $url . '</a> </p>';
  $message .= 'Regards,<br>' . 'The FitNinja Team';

  $headers = "From: FitNinja <mithuldas@gmail.com>\r\n";
  $headers .= "Reply-To: mithuldas@gmail.com\r\n";
  $headers .= "Content-type: text/html\r\n";

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
  $mail->Subject = $subject;
  $mail->Body = $message;
  $mail->AddAddress($to);

  $mail->Send();



  #mail($to, $subject, $message, $headers);

  header("Location: ../forgot-password.php?reset=success");

}

else{
  header("Location: ../forgot-password.php");
}
