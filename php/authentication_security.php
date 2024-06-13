<?php
include('./connection.php');


$username = isset($_GET['uname']) ? $_GET['uname'] : null;
$teacher = isset($_GET['fteacher']) ? $_GET['fteacher'] : null;
$nickname = isset($_GET['nickname']) ? $_GET['nickname'] : null;

$username = stripcslashes($username);
$teacher = stripcslashes($teacher);
$nickname = stripcslashes($nickname);
$username = mysqli_real_escape_string($conn, $username);
$teacher = mysqli_real_escape_string($conn, $teacher);
$nickname = mysqli_real_escape_string($conn, $nickname);

$sql = "SELECT username FROM admins WHERE username='$username' and favouriteteacher='$teacher' and nickname='$nickname'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if ($count == 1) {
    echo "ok";
} else {
    echo "Answers not matched";
}

$conn->close();
