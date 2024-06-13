<?php
// require 'vendor/autoload.php'; 
// Include PHPMailer autoload file if using Composer
// Or include PHPMailer manually if you downloaded it directly
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true); // Passing true enables exceptions
$mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com'; // Specify SMTP server
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'kenishpatel1123@gmail.com'; // SMTP username
$mail->Password   = 'vqnf becn zrae oyjo'; // SMTP password
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, ssl also accepted
$mail->Port = 587; // TCP port to connect to

$mail->setFrom('kenishpatel1123@gmail.com', 'kenish');
$mail->addAddress('rushvikkumarpatel@gmail.com', 'rushvik');
$mail->Subject = 'Subject of the email';
$mail->Body = 'Body of the email';

try {
    $mail->send();
    echo 'Email sent successfully';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


?>