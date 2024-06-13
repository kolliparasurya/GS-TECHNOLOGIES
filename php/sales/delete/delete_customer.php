<?php

include "./connection.php";

$email = isset($_GET['email']) ? $_GET['email'] : null;
$email = stripcslashes($email);
$email = mysqli_real_escape_string($conn, $email);;





if ($email != 0) {
    $sql = "DELETE FROM `customers` WHERE (`email` = '$email');";
    $result = mysqli_query($conn, $sql);
    echo "Rawmaterial Stock Deleted";
} else {
    echo "Email not matched";
}
