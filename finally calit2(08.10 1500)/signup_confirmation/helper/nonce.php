<?php
function send_code($nonce,$user_id){
//require 'signup_confirmation/PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

//$mail->SMTPDebug = 2;                               // Enable verbose debug output

$mail->isMail();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'rudtn521@gmail.com';                 // SMTP username
$mail->Password = 'gkdlfn~521';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->Form = 'rudtn521@gmail.com';
$mail->FormName = 'Ann';
$mail->addAddress($user_id);
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Confirmation Link';
//http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'

$mail->Body    = "http://teama-iot.calit2.net/activation.php?&nonce=".$nonce."";
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) 
    {
        //echo 'Message could not be sent.';
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
        echo "<script>location.replace('../activation_send_fail_email.html');</script>";
    } 
    else 
    {
        //echo 'Message has been sent';
        echo "<script>location.replace('../activation_check_email.html');</script>";
    }
}

function send_code2($nonce,$user_id){
//require 'signup_confirmation/PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

//$mail->SMTPDebug = 2;                               // Enable verbose debug output

$mail->isMail();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'rudtn521@gmail.com';                 // SMTP username
$mail->Password = 'gkdlfn~521';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->Form = 'rudtn521@gmail.com';
$mail->FormName = 'Ann';
$mail->addAddress($user_id);
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Confirmation Link';
//http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'

$mail->Body    = "Your password is ".$nonce."";
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) 
    {
        //echo 'Message could not be sent.';
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
        echo json_encode(array('result1'=>true , 'result2'=>false));
    } 
    else 
    {
        //echo 'Message has been sent';
        echo json_encode(array('result1'=>true , 'result2'=>true));
    }
}

?>