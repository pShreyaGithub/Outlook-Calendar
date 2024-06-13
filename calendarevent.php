<?php

include 'dbconn.php';

if ( isset( $_POST[ 'add' ] ) ) {
    session_start();
    if ( isset( $_SESSION[ 'email' ] ) ) {
        // Retrieve email from the session
        $email = $_SESSION[ 'email' ];

        $url = $_SERVER[ 'REQUEST_URI' ];

        // Parse the URL to extract query parameters
        $queryParams = parse_url( $url, PHP_URL_QUERY );

        // Parse the query parameters to extract id value
        parse_str( $queryParams, $params );

        // Check if 'id' parameter exists in the parsed parameters
        if ( isset( $params[ 'id' ] ) ) {
            // Get the id value
            $id = $params[ 'id' ];

            if ( $result ) {
                // Fetch the result row
                $row = mysqli_fetch_assoc( $result );

                // Check if a row is found
                if ( $row ) {
                    // Retrieve calendar ID from the result
                    $calendarId = $row[ $id ];

                    $Title = $_POST[ 'title' ];
                    $Location = $_POST[ 'location' ];
                    $startdate = $_POST[ 'Startdate' ];
                    $enddate = $_POST[ 'Enddate' ];
                    $StartTime = $_POST[ 'start_time' ];
                    $EndTime = $_POST[ 'end_time' ];
                    $Attendee_name = $_POST[ 'attendeeName' ];
                    $Attendee_email = $_POST[ 'attendeeEmail' ];
                    $Description = $_POST[ 'description' ];
                    $EventId = 'none';

                    $Firstsql = "INSERT INTO `calendarevents` (`calendarName`, `start_date`, `end_date`, `email`, `title`, `description`, `start_time`, `end_time`, `location`, `attendee_name`, `attendee_email`, `event_id`) VALUES ('$calendarId', '$startdate', '$enddate', '$email', '$Title', '$Description', '$StartTime', '$EndTime', '$Location', '$Attendee_name', '$Attendee_email', '$EventId')";

                    $result = mysqli_query( $conn, $Firstsql );

                    if ( $result )
                    {
                        // echo 'success'
                        ?>
                        <script>
                        location.replace( 'events.php' );
                        </script>
                        <?php
                        $curl = curl_init();

                        require_once 'storeToken.php';
                        $email = $_SESSION[ 'email' ];
                        $Secondsql = "SELECT generated_time,token FROM generatetoken WHERE email= '$email';";
                        // echo $sql;

                        $result = mysqli_query( $conn, $Secondsql );

                        if ( $result )
                        {
                            $row = mysqli_fetch_assoc( $result );

                            if ( $row )
                            {

                                $generatedTime = $row[ 'generated_time' ];

                                $currentDateTime = new DateTime();
                                $generatedDateTime = new DateTime( $generatedTime );

                                $timeDifferenceInSeconds = $currentDateTime->getTimestamp() - $generatedDateTime->getTimestamp();

                                if ( isset( $response[ 'access_token' ] ) )
                                {
                                    // echo '1';

                                    $response = json_decode( $response, true );
                                    $accessToken = $response[ 'access_token' ];
                                    $sql = "INSERT INTO generatetoken ( generated_time, token) VALUES ( now(), '$accessToken');";
                                    $result = mysqli_query( $conn, $sql );

                                    if ( $result )
                                   {
                                        // echo 'inserted';
                                    } else {
                                        // echo 'Error!!'. mysqli_error( $conn );
                                    }
                                } else if ( $timeDifferenceInSeconds <= 3600 )
                                 {
                                    // echo '2';

                                    $accessToken = $row[ 'token' ];
                                } else {
                                    // echo '3';
                                    require_once 'storeToken.php';
                                    $response = json_decode( $response, true );
                                    $accessToken = $response[ 'access_token' ];

                                    $sql = "UPDATE generatetoken SET generated_time = now(), token = '$accessToken';";
                                    $result = mysqli_query( $conn, $sql );

                                    if ( $result ) {
                                        // echo 'Updated';
                                    } else {
                                        // echo 'Error!!'. mysqli_error( $conn );
                                    }

                                }

                                $email = $_SESSION[ 'email' ];
                                $SelectEventsql = "SELECT `title`, `description`, `start_date`,`end_date`, `start_time`, `end_time`, `location`,`attendee_name`, `attendee_email`
                            FROM `calendarevents`
                            WHERE id = (SELECT MAX(id) FROM `calendarevents` WHERE `email` = '$email')";

                                //   echo $SelectEventsql;

                                $result = mysqli_query( $conn, $SelectEventsql );

                                if ( $result )
                                {
                                    $row = mysqli_fetch_assoc( $result );
                                    // var_dump( $row );
                                    if ( $row )
                                    {

                                        $title = $row[ 'title' ];
                                        $description = $row[ 'description' ];
                                        $start_Time = $row[ 'start_time' ];
                                        $end_Time = $row[ 'end_time' ];
                                        $location = $row[ 'location' ];
                                        $Startdate = $row[ 'start_date' ];
                                        $Enddate = $row[ 'end_date' ];
                                        $AttendeeName = $row[ 'attendee_name' ];
                                        $AttendeeEmail = $row[ 'attendee_email' ];

                                        $reqBody_arr = [
                                            'subject' => $title,
                                            'body' => [
                                                'contentType' => 'HTML',
                                                'content' => 'Does this dates work for you?'
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

                                        $req_body = json_encode( $reqBody_arr );

                                        curl_setopt_array( $curl, array(

                                            CURLOPT_URL => 'https://graph.microsoft.com/v1.0/users/' . $email . '/calendar/events',
                                            CURLOPT_RETURNTRANSFER => true,
                                            CURLOPT_ENCODING => '',
                                            CURLOPT_MAXREDIRS => 20,
                                            CURLOPT_TIMEOUT => 0,
                                            CURLOPT_FOLLOWLOCATION => true,
                                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                            CURLOPT_CUSTOMREQUEST => 'POST',
                                            CURLOPT_POSTFIELDS => $req_body,
                                            CURLOPT_HTTPHEADER => array( 'Authorization: Bearer' . $accessToken,
                                            'Content-Type: application/json' ),
                                        ) );

                                        $response = curl_exec( $curl );
                                        curl_close( $curl );
                                        // echo $response;

                                        $decoded_response = json_decode( $response, true );
                                        if ( $decoded_response === null ) {
                                            ?>
                                            <script>     alert( 'Some error occured, please try again once.' );
                                            </script>
                                            <?php
                                        } else {
                                            if ( isset( $decoded_response[ 'id' ] ) )
                                           {
                                                $eventid = $decoded_response[ 'id' ];
                                                $Fifthsql = "UPDATE calendarEvents SET event_id = '$eventid' WHERE email='$email';";

                                                $result = mysqli_query( $conn, $Fifthsql );
                                                if ( $result ) {
                                                    ?>
                                                    <script>
                                                    location.replace( 'opencalendar.php' );
                                                    </script>
                                                    <?php
                                                } else {
                                                    // echo 'Failed to update data: ' . mysqli_error( $conn );
                                                }
                                            } else {

                                                // echo 'Fail: No event ID found in the response';
                                            }
                                        }
                                    } else {
                                        alert( 'Error is fetching details, please try again.' );
                                    }
                                } else {
                                    alert( 'Error ,Please try again!!!.' );
                                }

                            } else {
                                alert( 'Their is some problem, please try again!!.' );
                            }

                        } else {
                            alert( 'Error ,Please try again!!.' ) . mysqli_error( $conn );
                        }
                    } else {
                        alert( 'Error fetching events details, Please try again.' ) . mysqli_error( $conn );
                    }
                } else {
                    echo 1;
                }
            } else {
                echo 2;
            }
        } else {
            echo 3;
        }

    } else {
        echo 'Email or calendarName not found in session.';
    }

} else {
    // alert( 'Oopss Error, Please try again.' ) . mysqli_error( $conn );
}

?>
