<?php
function send_code($nonce,$user_id){

require 'signup_confirmation/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 2;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'rudtn521@gmail.com';                 // SMTP username
$mail->Password = 'gkdlfn~521';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('rudtn521@gmail.com', 'Ann');
$mail->addAddress($user_id);
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Confirmation Code';
//http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'
$mail->Body    = 'http://192.168.33.66/verify.php?user_id='.$user_id.'&nonce='.$nonce.'';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
}
