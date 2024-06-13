<?php
include 'dbconn.php';

session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the user's email from the session
    $email = $_SESSION['email'];

    // Validate input
    $fullname = $_POST["fullname"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $confpassword = $_POST["confpassword"];

    $session_email = $_SESSION['email'];
    // Perform input validation (e.g., check if passwords match)
    if ($password != $confpassword) {
        echo "Passwords do not match!";
        exit();
    }

    // Encrypt the password using MD5
    $encryptedPassword = md5($password);

    // Prepare SQL statement to update user's profile
    $sql = "UPDATE registeration_form SET fullname=$fullname , phone=$phone, password=$password WHERE email=$email";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $fullname, $phone, $encryptedPassword, $email);

    // Execute statement
    if ($stmt->execute()) {
        ?>
        <script>alert('Profile updated successfully!');</script>
        <?php
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, retrieve and display user's full name and phone number
    $email = $_SESSION['email'];

    // Prepare SQL statement to fetch user's full name and phone number
    $sql = "SELECT fullname, phone FROM registeration_form WHERE email=?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("s", $email);

    // Execute statement
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($fullname, $phone);

    // Fetch the result
    $stmt->fetch();

    // Close statement
    $stmt->close();
}
?>
