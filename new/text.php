<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calendar</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    .time-column {
        min-width: 100px;
    }

    @media (max-width: 600px) {
        .time-column {
            display: none;
        }
    }
</style>
</head>
<body>
<table id="calendar">
    <thead>
        <tr>
            <th class="time-column"></th>
            <th>Sunday</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            <th>Saturday</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // Define hours
            $hours = [
                '', '1 AM', '2 AM', '3 AM', '4 AM',
                '5 AM', '6 AM', '7 AM', '8 AM',
                '9 AM', '10 AM','11 AM','12 PM',
                '1 PM','2 PM','3 PM','4 PM',
                '5 PM','6 PM','7 PM','8 PM',
                '9 PM','10 PM','11 PM','12 AM'
            ];

            // Define days
            $days = ['Sunday','Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            // Loop through hours to create rows
            foreach ($hours as $index => $hour) {
                echo "<tr>";
                echo "<td class='time-column'>$hour</td>";

                // Loop through days to create cells
                foreach ($days as $dayIndex => $day) {
                    echo "<td>";
                    if ($index === 0) {
                        $date = new DateTime();
                        $currentDay = $date->format('w');
                        $diff = $dayIndex - $currentDay;
                        $date->modify("+$diff days");
                        echo $date->format('j');
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
</body>
</html>
