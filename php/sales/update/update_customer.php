<?php
include "./connection.php";

$data = array();

$data['customerName'] = isset($_GET['batchId']) ? $_GET['batchId'] : null;
$data['address'] = isset($_GET['rawmaterialName']) ? $_GET['rawmaterialName'] : null;
$data['phoneNumber'] = isset($_GET['rawmaterialId']) ? $_GET['rawmaterialId'] : null;
$data['email'] = isset($_GET['email']) ? $_GET['email'] : null;
$data['panNumber'] = isset($_GET['panNumber']) ? $_GET['panNumber'] : null;


$data['customerName'] = stripcslashes($data['customerName']);
$data['address'] = stripcslashes($data['address']);
$data['phoneNumber'] = stripcslashes($data['phoneNumber']);
$data['email'] = stripcslashes($data['email']);
$data['panNumber'] = stripcslashes($data['panNumber']);


$customerName = mysqli_real_escape_string($conn, $data['customerName']);
$address = mysqli_real_escape_string($conn, $data['address']);
$phoneNumber = mysqli_real_escape_string($conn, $data['phoneNumber']);
$email = mysqli_real_escape_string($conn, $data['email']);
$panNumber = mysqli_real_escape_string($conn, $data['panNumber']);



if ($email != "") {
    $sql1 = "UPDATE `customers` SET `name` = '$customerName',`address` = '$address',`phone_number` = '$phoneNumber',`email` = '$email',`PAN_NUMBER` = '$panNumber' WHERE (`PAN_NUMBER` = '$panNumber');";
    $result = "";

    if (mysqli_multi_query($conn, $sql1)) {
        $result = "Customer Updated!";
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
