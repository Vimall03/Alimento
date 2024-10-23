<?php
$server = "127.0.0.1";

$email = "root";
$password = "1@archan";
$database = "homemadedb";

$conn = mysqli_connect($server,$email, $password,$database, 3306);
if(!$conn){
    die("Error" . mysqli_connect_errno());
}
?>