<?php
$servername = "localhost"; // Change to your server details
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$dbname = "alimento"; // Change to your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
