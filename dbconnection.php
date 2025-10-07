<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "prac8_connect_mysql";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>