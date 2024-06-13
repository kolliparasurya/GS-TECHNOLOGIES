<?php
include "./connection.php";

$data = array();

$data['labourId'] = isset($_GET['labourId']) ? $_GET['labourId'] : null;
$data['labourName'] = isset($_GET['labourName']) ? $_GET['labourName'] : null;
$data['division'] = isset($_GET['division']) ? $_GET['division'] : null;
$data['phoneNumber'] = isset($_GET['phoneNumber']) ? $_GET['phoneNumber'] : null;
$data['email'] = isset($_GET['email']) ? $_GET['email'] : null;
$data['address'] = isset($_GET['address']) ? $_GET['address'] : null;


$data['labourId'] = stripcslashes($data['labourId']);
$data['labourName'] = stripcslashes($data['labourName']);
$data['division'] = stripcslashes($data['division']);
$data['phoneNumber'] = stripcslashes($data['phoneNumber']);
$data['email'] = stripcslashes($data['email']);
$data['address'] = stripcslashes($data['address']);

$batchId = mysqli_real_escape_string($conn, $data['labourId']);
$rawmaterialId = mysqli_real_escape_string($conn, $data['labourName']);
$rawmaterialName = mysqli_real_escape_string($conn, $data['division']);
$quantity = mysqli_real_escape_string($conn, $data['phoneNumber']);
$stockedDate = mysqli_real_escape_string($conn, $data['email']);
$stockedDate = mysqli_real_escape_string($conn, $data['address']);



if ($labourId != "") {
    $sql1 = "UPDATE `labour` SET `labour_ID` = '$labourId',`name` = '$labourName',`division` = '$division',`phone_number` = '$phoneNumber',`email` = '$email',`address` = '$address' WHERE (`labour_ID` = '$labourId');";
    $result = "";

    if (mysqli_multi_query($conn, $sql1)) {
        $result = "Labour Updated!";
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
