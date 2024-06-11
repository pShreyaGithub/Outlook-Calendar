<?php
require_once 'admin_connect.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if userId is set and not empty
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Sanitize input to prevent SQL injection
        $userId = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);

        // Update user record in the database without changing the gender
        $stmt = $conn->prepare("UPDATE registeration_form SET fullname=?, email=?, phone=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $email, $phone, $userId);

        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "User ID is missing";
    }
} else {
    echo "Invalid request method";
}

// Close database connection
$conn->close();
?>
