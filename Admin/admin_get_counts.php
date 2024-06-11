<?php
// Database connection
$servername = "localhost"; // Change if your database is on a different server
$username = "root";
$password = "";
$database = "calendar";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total user count from the 'registeration_form' table
$sql_total_users = "SELECT COUNT(*) AS total_users FROM registeration_form";
$result_total_users = $conn->query($sql_total_users);
$row_total_users = $result_total_users->fetch_assoc();
$total_users = $row_total_users['total_users'];

// Fetch total events count from the 'calendar' table
$sql_total_events = "SELECT COUNT(*) AS total_events FROM calendar.created_event_details";
$result_total_events = $conn->query($sql_total_events);
$row_total_events = $result_total_events->fetch_assoc();
$total_events = $row_total_events['total_events'];

$conn->close();
?>
