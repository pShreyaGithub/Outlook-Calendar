<?php

include 'dbconn.php'; // Include your database connection file
include 'createEventdb.php'; // Include file for creating event database (if needed)

session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $sql = "SELECT `start_date`, `end_date`, `start_time`, `end_time`, `title` FROM `created_event_details` WHERE `email`='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $events = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = [
                'start_date' => $row['start_date'],
                'end_date' => $row['end_date'],
                'start_time' => $row['start_time'],
                'end_time' => $row['end_time'],
                'title' => $row['title']
            ];
        }

        // Convert the events array to JSON format
        $eventsJSON = json_encode($events);

        // Store the JSON data in localStorage using JavaScript
        echo "<script>";
        echo "const weekevent = JSON.parse('$eventsJSON');\n";
        echo "localStorage.setItem('weekevent', JSON.stringify(weekevent));\n";
        echo "const eventEventData = JSON.parse(localStorage.getItem('weekevent'));\n";
        echo "function convertToNotes(eventEventData) {\n";
        echo "  const notes = {};\n";
        echo "  eventEventData.forEach((event) => {\n";
        echo "    const { start_date, end_date, start_time, end_time, title } = event;\n";
        echo "    if (!notes[start_date]) {\n";
        echo "      notes[start_date] = [];\n";
        echo "    }\n";
        echo "    notes[start_date].push({ title, end_date, start_time, end_time });\n";
        echo "  });\n";
        echo "  localStorage.setItem('weekevent1', JSON.stringify(notes));\n";
        echo "  return notes;\n";
        echo "}\n";

        echo "const notesObject = convertToNotes(eventEventData);\n";
        echo "console.log(notesObject);\n";
        echo "window.location.href = 'main.php';\n";
        echo "</script>";
    } else {
        echo "Error fetching events from the database: " . mysqli_error($conn);
    }
} else {
    echo "Session email not set.";
}

?>
