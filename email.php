<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function newAccountMail($user, $email){
  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';

  $mail = new PHPMailer(true);              // Passing 'true' enables exceptions

  $mail->isSMTP();
  $mail->Mailer = "smtp";                   // Set mailer to use SMTP

  $mail->SMTPDebug = 1;                     // Enable verbose debug output
  $mail->SMTPAuth = TRUE;                   // Enable SMTP authentication
  $mail->SMTPSecure = "tls";                // Enable TLS encryption, 'ssl' (a predecessor to TSL) is also accepted
  $mail->Port = 587;                        // TCP port to connect to (587 is a standard port for SMTP)
  $mail->Host = "smtp.gmail.com";           // Specify main and backup SMTP servers
  $mail->Username = "schedulemaster10@gmail.com";  // SMTP username
  $mail->Password = "UpsornWithWebPL";         // SMTP password

  $mail->setFrom('schedulemaster10@gmail.com', 'ScheduleMaster');
  $mail->addAddress($email);

  $mail->isHTML(true);                      // Set email format to HTML
  $mail->Subject = 'New ScheduleMaster Account';
  $mail->Body    = 'Hello '.$user.'! You are receiving this because you registered a new ScheduleMaster account!';

  $mail->send();
}
?>
