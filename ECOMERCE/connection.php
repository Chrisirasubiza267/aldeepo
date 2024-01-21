<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "ecommerce";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Failed to connect " . $conn->connect_error);
}

?>