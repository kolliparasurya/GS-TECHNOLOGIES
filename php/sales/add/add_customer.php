<?php
include "./connection.php";

$data = array();

$data['customerName'] = isset($_GET['customerName']) ? $_GET['customerName'] : null;
$data['phoneNumber'] = isset($_GET['phoneNumber']) ? $_GET['phoneNumber'] : null;
$data['address'] = isset($_GET['address']) ? $_GET['address'] : null;
$data['email'] = isset($_GET['email']) ? $_GET['email'] : null;
$data['panNumber'] = isset($_GET['panNumber']) ? $_GET['panNumber'] : null;

$data['customerName'] = stripcslashes($data['customerName']);
$data['phoneNumber'] = stripcslashes($data['phoneNumber']);
$data['address'] = stripcslashes($data['address']);
$data['email'] = stripcslashes($data['email']);
$data['panNumber'] = stripcslashes($data['panNumber']);


$customerName = mysqli_real_escape_string($conn, $data['customerName']);
$phoneNumber = mysqli_real_escape_string($conn, $data['phoneNumber']);
$address = mysqli_real_escape_string($conn, $data['address']);
$email = mysqli_real_escape_string($conn, $data['email']);
$panNumber = mysqli_real_escape_string($conn, $data['panNumber']);



if ($customerName != "" && $phoneNumber != "" && $address != "" && $email != "" && $panNumber != "") {
    $sql1 = "INSERT INTO `customers` (`name`,`address`,`phone_number`,`email`,`PAN_NUMBER`)
        VALUES ('$customerName','$address','$phoneNumber','$email','$panNumber')";

    $result = "";

    if (mysqli_query($conn, $sql1)) {
        $result = "Customer Added!";
        echo $result;
    } else {
        if (mysqli_errno($conn) == 1062) {
            $result = "Enter different details";
            echo $result;
        } else {
            $result = "Database insertion error";
            echo $result;
        }
    }
}


$conn->close();
