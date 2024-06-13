<?php
include('./connection.php');


$username = isset($_GET['uname']) ? $_GET['uname'] : null;
$newPwd = isset($_GET['newPassword']) ? $_GET['newPassword'] : null;
$confirmPassword = isset($_GET['confirmPassword']) ? $_GET['confirmPassword'] : null;

$username = stripcslashes($username);
$newPwd = stripcslashes($newPwd);
$confirmPassword = stripcslashes($confirmPassword);

$username = mysqli_real_escape_string($conn, $username);
$newPwd = mysqli_real_escape_string($conn, $newPwd);
$confirmPassword = mysqli_real_escape_string($conn, $confirmPassword);

$sql = "UPDATE admins SET password = '$confirmPassword' WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
// $count = mysqli_num_rows($result);

if ($result) {
    echo "Password Successfully Saved!";
} else {
    echo "Something happen";
}

$conn->close();
