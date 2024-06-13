<?php
// Start session
session_start();

// Dummy user database (replace this with a real database in production)
$users = array(
    "user1" => "password1",
    "user2" => "password2"
);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['Email'];
    $password = $_POST['pass'];

    // Check if username and password match
    if (isset($users[$Email]) && $users[$Email] == $pass) {
        // Authentication successful, set session variable
        $_SESSION['Email'] = $username;
        // Redirect to the next page
        header("Location: cal.php");
        exit();
    } else {
        // Authentication failed, redirect back to login page
        header("Location: index.php");
        exit();
    }
}
?>
