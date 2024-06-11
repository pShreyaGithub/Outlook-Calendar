<?php
// delete_user.php
include "admin_connect.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM registeration_form WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "User ID not provided";
}

$conn->close();

?>
