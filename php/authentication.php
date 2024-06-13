<?php
include('./connection.php');


$username = isset($_GET['adminId']) ? $_GET['adminId'] : null;
$password = isset($_GET['password']) ? $_GET['password'] : null;


$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

$sql = "SELECT `password` FROM admins WHERE username='$username'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    if ($password == $row['password']) {
        echo "ok";
    } else {
        echo "AdminId and password not matched";
    }
}

$conn->close();
