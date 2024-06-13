<?php
$servername = "localhost";
$username = "root";
$password = "Kolli@123";
$data_base = "gs technologies";

$conn = new mysqli($servername, $username, $password, $data_base);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
