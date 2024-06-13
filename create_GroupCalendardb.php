<?php
include 'dbconn.php';
session_start();

if (isset($_POST['create'])) {
    // Check if email is set in session
    if (isset($_SESSION['email'])) {
        // Get email from session
        $email = $_SESSION['email'];
        
        // Get group name and description from form
        $group_Name = mysqli_real_escape_string($conn, $_POST['groupNameInput']);
        $group_Desc = mysqli_real_escape_string($conn, $_POST['groupDescriptionInput']);
        
        // Get member names from form
        $members = explode(",", $_POST['memberNameInput']);
        $group_members = array();

        // Iterate through member names and sanitize
        foreach ($members as $member) {
            $member = trim($member);
            $group_members[] = mysqli_real_escape_string($conn, $member);
        }
        
        // Prepare the SQL statement
        $insertSql = "INSERT INTO `created_group_calendars` (`email`, `g_name`, `g_desc`, `g_member`, `g_id`) VALUES ('$email', '$group_Name', '$group_Desc', '" . implode(",", $group_members) . "', 'none')";
                      
        // Execute the SQL query
        $result = mysqli_query($conn, $insertSql);

        // Check if query was successful
        if ($result) {
            echo "Success: Data inserted into database.";
            // Optionally, you can redirect the user to another page or display a success message here
        } else {
            // Handle the error
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Session email not set";
    }
} else {
    echo "Create not set";
}
?>
