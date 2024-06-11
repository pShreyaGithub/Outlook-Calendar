<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendar"; // Updated database name

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("sorry not connected". mysqli_connect_error());
}
?>