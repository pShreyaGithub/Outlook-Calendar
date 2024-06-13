<?php
$servername = "localhost";
$username ="root";
$password ="";
$database="calendar";

// session_start();
// Creating connection
$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("sorry not connected". mysqli_connect_error());
}
?>