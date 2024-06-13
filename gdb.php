<?php
session_start(); // Start the session

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendar";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$groupName = $_POST['groupNameInput'];
$groupDescription = $_POST['groupDescriptionInput'];
$members = $_POST['memberNameInput'];

// Get email from session
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    // Handle the case where email is not set in session
    $email = ""; // You might want to provide a default value or redirect the user
}

// SQL to insert group into database
$sql_group = "INSERT INTO created_group_calendars (group_name, group_description, email) VALUES ('$groupName', '$groupDescription', '$email')";

if ($conn->query($sql_group) === TRUE) {
  $group_id = $conn->insert_id; // Get the ID of the inserted group

  // SQL to insert members into database
  foreach ($members as $member) {
    $sql_member = "INSERT INTO group_members (group_id, member_name) VALUES ('$group_id', '$member')";
    $conn->query($sql_member);
  }

  echo "Group created successfully!";
  header("Location: create_group.php");
  exit;
} else {
  echo "Error creating group: " . $conn->error;
}

$conn->close();
?>
