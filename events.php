<?php

include 'dbconn.php';
include 'calendarevent.php';

session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    // var_dump($email);

    if (isset($_GET['id'])) 
    {
        $Id = $_GET['id'];
        // var_dump($Id);


        $Fetchsql = "SELECT start_date, title FROM calendarEvents WHERE calendarid='$Id' AND email ='$email'";
        // echo  $Fetchsql;
        $result = mysqli_query($conn, $Fetchsql);
        // var_dump( $result); 
        if ($result) {
            $events = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
                $events[] = [
                    $row['start_date'] => $row['title'],
    
                ];
            }
    
            // Convert the events array to JSON format
            $events_json = json_encode($events);
    
            // Store the JSON data in localStorage using JavaScript
    
            echo "<script>";
            echo "const eventsData1 = JSON.parse('$events_json');\n";
            echo "localStorage.setItem('eventsData1', JSON.stringify(eventsData1));\n";
            echo "const data = JSON.parse(localStorage.getItem('eventsData1'));\n";
    
            echo "function convertToObject(data) {\n";
            echo "  const result = {};\n";
            echo "  data.forEach((item) => {\n";
            echo "    const [date, event] = Object.entries(item)[0];\n";
            echo "    if (!result[date]) {\n";
            echo "      result[date] = [];\n";
            echo "    }\n";
            echo "    result[date].push(event);\n";
            echo "  });\n";
            echo "  localStorage.setItem('books', JSON.stringify(result));\n";
            echo "  return result;\n";
            echo "}\n";
    
            echo "const resultObject = convertToObject(data);\n";
            echo "console.log(resultObject);\n";
            echo "const id = $Id;\n";
             echo "location.replace('opencalendar.php?id=' + id);\n";
            echo "</script>";

        } else 
        {
            echo 'Error fetching events from the database: ' . mysqli_error($conn);
        }
    }else
    {
        echo "Not found";
    }
} else
{
    echo 'Session email not set.';
}
?>