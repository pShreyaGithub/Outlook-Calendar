<!-- PHP code in delete_event.php -->
<?php
// Connect to the database (assuming you have already established a database connection)
include 'conn.php'; // assuming your connection details are in this file

if(isset($_POST['deleteButton'])) {
    $delete_id = $_POST['title']; // Assuming you pass the title via AJAX

    // Perform the deletion query
    $query_delete = "DELETE FROM created_event_details WHERE title='$delete_id'";
    $delete_query_run = mysqli_query($conn, $query_delete);

    // Check if the deletion was successful
    if($delete_query_run) {
        echo "Event Deleted Successfully";
    } else {
        echo "Failed";
    }
}
?>
