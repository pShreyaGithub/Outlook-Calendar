<?php

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendar";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all users
$sql = "SELECT * FROM registeration_form";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<div>";
        while($row = $result->fetch_assoc()) {
            echo "<p>Name: " . htmlspecialchars($row["fullname"]). " - Email: " . htmlspecialchars($row["email"]). " - Phone: " . htmlspecialchars($row["phone"]). "</p>";
        }
        echo "</div>";
    } else {
        echo "0 results";
    }
} else {
    echo "Error: " . $conn->error;
}

// Close connection
$conn->close();
?>



