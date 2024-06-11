<?php
// Establish connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendar";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate if new password matches confirm password
    if ($newPassword != $confirmPassword) {
        echo "New password and confirm password do not match.";
    } else {
        // Update password in the database
        $sql = "UPDATE administrator SET password = '$newPassword' WHERE password = '$currentPassword'";
        if ($conn->query($sql) === TRUE) {
            echo "Password updated successfully.";
            // Redirect to admin_dashboard.php
            header("Location: http://localhost/new/admin/admin_dashboard.php");
            exit(); // Ensure no further code execution after redirect
        } else {
            echo "Error updating password: " . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_style.css">
    <title>userPage</title>
</head>
<body>
 <!-- Include Navbar -->
    <?php include 'admin_index.php'; ?>
    <!-- Main Content Section -->
    
 <section class="main-section">

 <div class="containerr-wrapper">
      <a class="hd1">Change Password </a>

 <form action="" method="post" class="form">
    <div class="input-group">
        <label class="label-text" for="current_password">Current password</label>
        <input id="current_password" name="current_password" class="input-field" type="password" required>
    </div>
    <div class="input-group">
        <label class="label-text" for="new_password">New password</label>
        <input id="new_password" name="new_password" class="input-field" type="password" required>
    </div>
    <div class="input-group">
        <label class="label-text" for="confirm_password">Confirm password</label>
        <input id="confirm_password" name="confirm_password" class="input-field" type="password" required>
    </div>
    <button type="submit" class="submit-button">Change</button>
</form>




</div>
  <script>
    $('input').focus(function(){
      $(this).parents('.input-group').addClass('focused');
    });

    $('input').blur(function(){
      var inputValue = $(this).val();
      if ( inputValue == "" ) {
        $(this).removeClass('filled');
        $(this).parents('.input-group').removeClass('focused');  
      } else {
        $(this).addClass('filled');
      }
    })  
    </script>
</body>
</html>
