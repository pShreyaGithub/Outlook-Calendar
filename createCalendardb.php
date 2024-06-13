<?php
include 'dbconn.php';

if (isset($_POST['create'])) {
    session_start();
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
      
        $name = $_POST['calendarname'];
       
        $calendar = 'NONE';

        // Check if the name already exists
        $check_sql = "SELECT * FROM created_calendar_details WHERE calendarName = '$name' AND email = '$email'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            echo '<script>alert("Name already exists!");'; 
            echo 'window.location.href = "dashboard.php";</script>';
        } else {
            $sql = "INSERT INTO `created_calendar_details`(`calendarName`,`email`,`calendarId`) VALUES ('$name','$email', '$calendar');";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo 'success';
                header('location:main.php');
                
                // echo "The name is" . $name;
                $_SESSION['calendarName'] = $name;
                // // echo $name;
                $curl = curl_init();
                require_once 'storeToken.php';

                $email = $_SESSION['email'];
                $Firstsql = "SELECT generated_time,token FROM generatetoken WHERE email= '$email';";
                $result = mysqli_query($conn, $Firstsql);

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
                            $Secondsql = "INSERT INTO generatetoken ( generated_time, token) VALUES ( now(), '$accessToken');";
                            $result = mysqli_query($conn, $Secondsql);

                            if ($result) {
                                echo 'inserted';
                            } else {
                                echo 'Error connection Failed' . mysqli_error($conn);
                            }
                        } else if ($timeDifferenceInSeconds <= 3600) {
                            $accessToken = $row['token'];
                        } else {
                            require_once 'storeToken.php';
                            $response = json_decode($response, true);
                            $accessToken = $response['access_token'];
                            $Thirdsql = "UPDATE generatetoken SET generated_time = now(), token = '$accessToken' WHERE email = '$email';";
                            $result = mysqli_query($conn, $Thirdsql);

                            if ($result) {
                                echo '';
                            } else {
                                echo 'Error 3' . mysqli_error($conn);
                            }
                        }

                        // Query to fetch calendar name
                        $Fourthsql = "SELECT calendarName 
                        FROM created_calendar_details 
                        WHERE id = (
                            SELECT MAX(id) 
                            FROM created_calendar_details 
                            WHERE email = '$email'
                        )";
                        $result = mysqli_query($conn, $Fourthsql);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            if ($row) {
                                $name = $row['calendarName'];
                                // echo "The name is" . $name;
                                // $_SESSION['calendarName'] = $name;
                                // var_dump($name); // Storing calendarName in session
                                // // echo $name;
                                $reqBody_arr = [
                                    'name' => $name,
                                ];
                                $req_body = json_encode($reqBody_arr);

                                // CURL request
                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => 'https://graph.microsoft.com/v1.0/users/' . $email . '/calendars',
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => '',
                                    CURLOPT_MAXREDIRS => 20,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => 'POST',
                                    CURLOPT_POSTFIELDS => $req_body,
                                    CURLOPT_HTTPHEADER => array('Authorization: Bearer ' . $accessToken, 'Content-Type: application/json'),
                                ));
                                $response = curl_exec($curl);
                                $curl_error = curl_error($curl);
                                curl_close($curl);

                                if ($curl_error) {
                                    echo 'cURL Error: ' . $curl_error;
                                } else {
                                    echo 'cURL Executed Successfully';
                                    echo '<pre>';
                                    var_dump($response);
                                    echo '</pre>';

                                    $decoded_response = json_decode($response, true);
                                    if ($decoded_response === null) {
                                        echo 'Error decoding JSON: ' . json_last_error_msg();
                                    } else {
                                        if (isset($decoded_response['id'])) {
                                            $calendarid = $decoded_response['id'];
                                            $Fifthsql = "UPDATE created_calendar_details SET calendarId = '$calendarid' WHERE email='$email';";
                                            $result = mysqli_query($conn, $Fifthsql);

                                            if ($result) {
                                                echo 'Successfully updated data';
                                                header('location:main.php');
                                            } else {
                                                echo 'Failed to update data: ' . mysqli_error($conn);
                                            }
                                        } else {
                                            echo 'Fail: No calendar ID found in the response';
                                        }
                                    }
                                }
                            } else {
                                echo 'Error 4';
                            }
                        } else {
                            echo 'Error 5: ' . mysqli_error($conn);
                        }
                    } else {
                        echo 'No data Found';
                    }
                } else {
                    echo 'Query execution error: ' . mysqli_error($conn);
                }
            } else {
                echo 'Error 1' . mysqli_error($conn);
            }
        }
    } else {
        echo 'Error inserting data: ' . mysqli_error($conn);
    }
} else {
    echo 'Error: Session not found';
}
?>
