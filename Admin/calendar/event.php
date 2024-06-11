<?php

include 'dbconn.php'; // Include your database connection file
include 'createEventdb.php'; // Include file for creating event database (if needed)

session_start();

if (isset ($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $sql = "SELECT `start_date`,`title` FROM `created_event_details` WHERE `email`='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $events = array();

        // while ($row = mysqli_fetch_assoc($result)) {
        //     $events[] = $row;
        // }
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = [
                $row['start_date'] => $row['title'],

            ];
        }

        // Convert the events array to JSON format
        $events_json = json_encode($events);

        // Store the JSON data in localStorage using JavaScript

        echo "<script>";
        echo "const eventsData = JSON.parse('$events_json');\n";
        echo "localStorage.setItem('eventsData', JSON.stringify(eventsData));\n";
        echo "const data = JSON.parse(localStorage.getItem('eventsData'));\n";

        echo "function convertToObject(data) {\n";
        echo "  const result = {};\n";
        echo "  data.forEach((item) => {\n";
        echo "    const [date, event] = Object.entries(item)[0];\n";
        echo "    if (!result[date]) {\n";
        echo "      result[date] = [];\n";
        echo "    }\n";
        echo "    result[date].push(event);\n";
        echo "  });\n";
        echo "  localStorage.setItem('notes', JSON.stringify(result));\n";
        echo "  return result;\n";
        echo "}\n";

        echo "const resultObject = convertToObject(data);\n";
        echo "console.log(resultObject);\n";
        echo "window.location.href = 'http://localhost/new/admin/calendar/main1.php';\n";
        echo "</script>";




    } else {
        echo "Error fetching events from the database: " . mysqli_error($conn);
    }
} else {
    echo "Session email not set.";
}

?>
 <?php
if(isset($_POST['deleteButton'])) {
    $delete_id = $_POST['title'];

    // Perform the deletion query
    $query_delete = "DELETE FROM created_event_details WHERE title='$delete_id'";
    $delete_query_run = mysqli_query($conn, $query_delete);

    // Check if the deletion was successful
    if($delete_query_run) {
        ?>
        <script>
            alert("Event Deleted Successfully");
            window.location.replace("http://localhost/new/admin/calendar/main1.php");
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Failed");
            window.location.replace("http://localhost/new/admin/calendar/main1.php");
        </script>
        <?php
    }
}
?>