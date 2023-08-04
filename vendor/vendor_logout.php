<?php
session_start();

$_SESSION['loggedin'] = false;

session_unset();
session_destroy();

header("location: vendor_login.php");
?>