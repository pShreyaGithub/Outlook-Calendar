<?php
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "one";
    // Get form data
    $email = $_SESSION['email'];
    $title = $_POST['title'];
    $location = $_POST['location'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $attendeeName = $_POST['attendeeName'];
    $attendeeEmail = $_POST['attendeeEmail'];
    $description = $_POST['description'];

    // Predefined subject and body
    $predefinedSubject = 'New Event Created';
    $predefinedBody = "A new event has been created:\n\n";
    try {
    // Send email to attendee
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'kenishpatel1123@gmail.com';
    $mail->Password = 'evdn qnto ogyx dimw';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom($email, 'No name');
    $mail->addAddress($attendeeEmail, $attendeeName);
    $mail->Subject = $predefinedSubject;
    $mail->Body = "Hello". $attendeeName . $predefinedBody . "Event Title: $title\nLocation: $location\nStart Date: $startDate\nEnd Date: $endDate\nStart Time: $startTime\nEnd Time: $endTime\n\nDescription: $description\n\nRegards,\nYour Organization";

    
        $mail->send();
        echo "<script>alert('Event created successfully!\\nNotification sent to $attendeeEmail.');</script>";
        header("Location: event.php");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Send email to another address
    $mail->ClearAllRecipients();
    $mail->addAddress('kenishpatel1123@gmail.com', 'Kenish');
    $mail->Subject = $predefinedSubject;
    $mail->Body = $predefinedBody . "Event Title: $title\nLocation: $location\nStart Date: $startDate\nEnd Date: $endDate\nStart Time: $startTime\nEnd Time: $endTime\n\nDescription: $description\n\nRegards,\nYour Organization";

    try {
        $mail->send();
        // Redirect to event.php after sending emails
        header("Location: event.php");
        exit; // Make sure to exit after redirection
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
