<?php
include 'dbconn.php';

if(isset($_POST['register_update_btn'])) {
    $id = $_POST['id'];
    $calendarName = $_POST['calendarName'];

    $sql = "UPDATE created_calendar_details SET calendarName='$calendarName' WHERE id='$id'";
    if(mysqli_query($conn, $sql)) {
        echo "Calendar updated successfully.";
    } else {
        echo "Error updating calendar: " . mysqli_error($conn);
    }
} else {
    echo "ID or calendarName not provided.";
}
?>
