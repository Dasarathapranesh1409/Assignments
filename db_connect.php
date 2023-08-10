<?php
$servername = "localhost";
$dbusername = "root";
$dbPassword = "Pranesh@1409";
$dbname = "users";
$conn = new mysqli($servername, $dbusername, $dbPassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
