<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendar";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Clear notifications from the database
$sql = "DELETE FROM created_event_details";

if ($conn->query($sql) === TRUE) {
    echo "Notifications cleared successfully.";
} else {
    echo "Error clearing notifications: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
