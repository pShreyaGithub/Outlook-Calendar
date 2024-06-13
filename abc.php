<?php
// // Database connection parameters
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "calendar";

// // Connect to the database
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check the connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
include 'dbconn.php';
session_start();
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign form values to variables
    $title = $_POST['title'];
    $location = $_POST['location'];
    $start_date = $_POST['Startdate'];
    $end_date = $_POST['Enddate'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $attendee_name = $_POST['attendeeName'];
    $attendee_email = $_POST['attendeeEmail'];
    $description = $_POST['description'];
    
    // Get the created_calendar_id from the URL (assuming it's passed via GET method)
    if (isset($_GET['id'])) {
        $created_calendar_id = $_GET['id'];
    } else {
        echo "Error: No id parameter found in the URL.";
        exit; // Terminate script execution if id parameter is not found
    }

    // Fetch user email from the database based on the user ID
    $sql_email = "SELECT email FROM created_calendar_details WHERE id='$created_calendar_id'";
    $result_email = mysqli_query($conn, $sql_email);

    if ($result_email && mysqli_num_rows($result_email) > 0) {
        $row_email = mysqli_fetch_assoc($result_email);
        $user_email = $row_email['email'];

        // Insert data into calendarevents table
        $sql = "INSERT INTO calendarevents (calendarid, title, location, start_date, end_date, start_time, end_time, attendee_name, attendee_email, description, email) 
            VALUES ('$created_calendar_id', '$title', '$location', '$start_date', '$end_date', '$start_time', '$end_time', '$attendee_name', '$attendee_email', '$description', '$user_email')";

    if ($conn->query($sql) === TRUE) {
        echo "Event added successfully.";
        echo "<script>";
        echo "const id = $created_calendar_id;\n";
        echo "location.replace('events.php?id=' + id);\n";
        echo "</script>";
        require_once 'storeToken.php';
        $email = $_SESSION['email'];
        $Secondsql = "SELECT generated_time,token FROM generatetoken WHERE email= '$email';";
        $result = mysqli_query($conn, $Secondsql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $generatedTime = $row['generated_time'];
                $currentDateTime = new DateTime();
                $generatedDateTime = new DateTime($generatedTime);
                $timeDifferenceInSeconds = $currentDateTime->getTimestamp() - $generatedDateTime->getTimestamp();
                if (isset($response['access_token'])) {
                    $response = json_decode($response, true);
                    $accessToken = $response['access_token'];
                    $sql = "INSERT INTO generatetoken ( generated_time, token) VALUES ( now(), '$accessToken');";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        // Insertion successful
                    }
                } elseif ($timeDifferenceInSeconds <= 3600) {
                    $accessToken = $row['token'];
                } else {
                    require_once 'storeToken.php';
                    $response = json_decode($response, true);
                    $accessToken = $response['access_token'];
                    $sql = "UPDATE generatetoken SET generated_time = now(), token = '$accessToken';";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        // Update successful
                    }
                }
                $email = $_SESSION['email'];
                $SelectEventsql = "SELECT `title`, `description`, `start_date`,`end_date`, `start_time`, `end_time`, `location`,`attendee_name`, `attendee_email`
                             FROM `calendarevents`
                             WHERE id = (SELECT MAX(id) FROM `calendarevents` WHERE `email` = '$email')";
                $result = mysqli_query($conn, $SelectEventsql);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row) {
                        $title = $row['title'];
                        $description = $row['description'];
                        $start_Time = $row['start_time'];
                        $end_Time = $row['end_time'];
                        $location = $row['location'];
                        $Startdate = $row['start_date'];
                        $Enddate = $row['end_date'];
                        $AttendeeName = $row['attendee_name'];
                        $AttendeeEmail = $row['attendee_email'];
                        $reqBody_arr = [
                            'subject' => $title,
                            'body' => [
                                'contentType' => 'HTML',
                                'content' => 'Does this date work for you?'
                            ],
                            'start' => [
                                'dateTime' => $Startdate . 'T' . $start_Time,
                                'timeZone' => 'Pacific Standard Time'
                            ],
                            'end' => [
                                'dateTime' => $Enddate . 'T' . $end_Time,
                                'timeZone' => 'Pacific Standard Time'
                            ],
                            'location' => [
                                'displayName' => $location
                            ],
                            'attendees' => [
                                [
                                    'emailAddress' => [
                                        'address' => $AttendeeEmail,
                                        'name' => $AttendeeName
                                    ],
                                    'type' => 'required'
                                ]
                            ],
                            'transactionId' => '',
                        ];
                        $req_body = json_encode($reqBody_arr);
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://graph.microsoft.com/v1.0/users/' . $email . '/calendar/events',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 20,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => $req_body,
                            CURLOPT_HTTPHEADER => array('Authorization: Bearer' . $accessToken, 'Content-Type: application/json'),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $decoded_response = json_decode($response, true);
                        if ($decoded_response === null) {
                            ?>
                            <script>
                                alert('Some error occurred, please try again once.');
                            </script>
                            <?php
                        } else {
                            if (isset($decoded_response['id'])) {
                                $eventid = $decoded_response['id'];
                                $Fifthsql = "UPDATE calendarEvents SET event_id = '$eventid' WHERE email='$email';";
                                $result = mysqli_query($conn, $Fifthsql);
                                if ($result) {
                                    ?>
                                    <script>
                                        // location.replace('opencalendar.php');
                                    </script>
                                    <?php
                                } else {
                                    // Failed to update data
                                }
                            } else {
                                // No event ID found in the response
                            }
                        }
                    }
                }
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: User email not found in the database.";
}
}

// Close the connection
$conn->close();
?>
