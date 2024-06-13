<?php
// Include database connection
include 'dbconn.php';
// Include PHPMailer
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; // Adjust the path as needed

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $message = $_POST["message"];
    // Validate and sanitize input data as needed

    // Insert response into database
    $sql = "INSERT INTO event_responses (email, response_message) VALUES ('$email', '$message')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Email notification to the event creator
        $to = $_SESSION['email']; // Assuming you have the event creator's email stored in session
        $subject = "New Response to Your Event";
        $body = "Hello,\n\nSomeone has responded to your event:\n\n";
        $body .= "Email: $email\n";
        $body .= "Response: $message\n";
        // Customize the email body as needed

        // Send email using PHPMailer
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        // Set up SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'rushvikkumarpatel@gmail.com'; // Your SMTP username
        $mail->Password = 'ytdi nnmq xurk pvhp'; // Your SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587; // Adjust the port if needed

        // Set email details
        $mail->setFrom($email, 'Your Name'); // Sender's email address and name
        $mail->addAddress($to); // Recipient's email address
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Send email
        if ($mail->send()) {
            echo "Email sent successfully";
           
        } else {
            echo " Email sending failed";
           
        }
    } else {
     echo "Handle database error";
        
    }
} else {
    echo  "Handle invalid form submission";
  
}
?>
