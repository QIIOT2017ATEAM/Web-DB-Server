<?php
function send_code($code,$email){
require 'signup_confirmation/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'rudtn521@gmail.com';                 // SMTP username
$mail->Password = 'gkdlfn~521';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('rudtn521@gmail.com', 'Ann');
$mail->addAddress($email);
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Confirmation Code';
$mail->Body    = "Thank you for joining us your confirmation Code Is: ".$code;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
}
