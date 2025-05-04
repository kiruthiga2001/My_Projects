<?php
// db_connect.php

$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = "kiruthiga"; // Your database password
$dbname = "savory_haven"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set character set to UTF-8 for proper encoding
$conn->set_charset("utf8");

// Start a session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
