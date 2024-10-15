<?php
$server = "localhost";

$email = "root";
$password = "";
$database = "homemadedb";

$conn = mysqli_connect($server,$email, $password,$database, 3306);
if(!$conn){
    die("Error" . mysqli_connect_errno());
}
?>