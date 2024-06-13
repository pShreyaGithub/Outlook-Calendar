<?php
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';
require 'vendor/autoload.php'; // Composer autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use League\OAuth2\Client\Provider\Google;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Generate a random password reset token
    $token = bin2hex(random_bytes(20));

    // Save the token in the database along with the user's email address and an expiry time
    // For demonstration purposes, I'm assuming you have a database connection already set up

    // Configure OAuth 2.0 authentication
    $provider = new Google([
        'clientId'     => 'YOUR_CLIENT_ID',
        'clientSecret' => 'YOUR_CLIENT_SECRET',
    ]);

    // Fetch access token
    $accessToken = $provider->getAccessToken('refresh_token', [
        'refresh_token' => 'YOUR_REFRESH_TOKEN',
    ]);

    // Send password reset email
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setOAuth(
        new PHPMailer\PHPMailer\OAuth(
            [
                'clientId' => 'YOUR_CLIENT_ID',
                'clientSecret' => 'YOUR_CLIENT_SECRET',
                'refreshToken' => $accessToken->getToken(),
                'userName' => 'kenishpatel1123@gmail.com', // Your Gmail address
            ]
        )
    );

    $mail->setFrom("$email", 'Kenish');
    $mail->addAddress($email);
    $mail->Subject = 'Password Reset';
    $mail->Body = "Click the following link to reset your password: <a href='https://www.example.com/reset_password.php?token=$token'>Reset Password</a>";

    try {
        $mail->send();
        echo "<script>alert('Password reset link sent to $email.');</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
