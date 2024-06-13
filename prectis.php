<?php
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$phpmailer = new PHPMailer();

$phpmailer->isSMTP();
$phpmailer->Host = 'smtp.gmail.com';
$phpmailer->SMTPAuth = true;
$phpmailer->Port = 2525;
$phpmailer->Username = 'kenishpatel1123@gmail.com';
$phpmailer->Password = 'vqnf becn zrae oyjo';
$phpmailer->setFrom('kenishpatel1123@gmail.com', 'Your Name');
$phpmailer->addAddress('rushvikkumarpatel@gmail.com', 'Recipient Name');
$phpmailer->Subject = 'Subject of the email';
$phpmailer->Body = 'Body of the email';

// Function to establish database connection
function connect_to_database() {
    $host = 'localhost'; // Database host
    $username = 'root'; // Database username
    $password = ''; // Database password
    $dbname = 'calendar'; // Database name

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: '. $conn->connect_error);
    }

    return $conn;
}

// Function to fetch attendees' email IDs from database
function get_attendees_emails($conn) {
    $attendees = array();

    // Query to fetch email IDs
    $sql = "SELECT * FROM created_event_details"; // Replace 'created_event_details' with your actual table name
    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Fetch rows and add email IDs to array
        while ($row = $result->fetch_assoc()) {
            $attendees[] = $row['attendee_email'];
        }
    }

    return $attendees;
}

// Function to fetch event details from database
function get_event_details($conn) {
    $details = array();

    // Query to fetch event details
    $sql = "SELECT * FROM created_event_details"; // Replace 'created_event_details' with your actual table name
    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Fetch rows and add details to array
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
    }

    return $details;
}

// Function to send email notification to attendees
function send_notification($attendees, $event_details) {
    // Email Configuration
    $sender_email = 'patelkenish@realfreecrm.com'; // Apna email address daalein
    $subject = 'Notification for Event'; // Email ka subject
    
    // Email Content
    $body = '
    Dear Attendee,
    
    This is to inform you about the upcoming event. Please save the date and time.

    Event Details:
    ';

    foreach ($event_details as $detail) {
        $body .= "\nEvent Name: " . $detail['title'] . "\nDate: " . $detail['start_date'] . "\nTime: " . $detail['start_time'] . "\nLocation: " . $detail['location'] . "\n\n";
    }
    
    $body .= '
    Regards,
    Organizer';
    
    // Headers
    $headers = 'From: ' . $sender_email . "\r\n" .
               'Reply-To: ' . $sender_email . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
    
    // Loop through attendees and send email
    foreach ($attendees as $attendee) {
        // Send email
        mail($attendee, $subject, $body, $headers);
    }
}

if($phpmailer->send()) {
    echo 'Email sent successfully!';
} else {
    echo 'Error: ' . $phpmailer->ErrorInfo;
}

// Establish database connection
$conn = connect_to_database();

// Fetch attendees' email IDs from database
$attendees = get_attendees_emails($conn);

// Fetch event details from database
$event_details = get_event_details($conn);

// Close database connection
$conn->close();

// Send notification
send_notification($attendees, $event_details);
?>
