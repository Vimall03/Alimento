<?php
session_start();
include 'partials/_dbconnect.php';
$rid = $_SESSION['r_id'];

// Check if the user is logged in or redirect to the login page
if (!isset($_SESSION['vendorloggedin']) || $_SESSION['vendorloggedin'] != true) {
    header("location: user_login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $m_del = $_POST['delete_item'];
    
        $sql = "DELETE FROM `menu` WHERE `m_id` = '$m_del'";
        $result = mysqli_query($conn, $sql);
    header('location: edit_menu.php');
}