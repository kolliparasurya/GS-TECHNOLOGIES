<?php

include "./connection.php";


$labourId = isset($_GET['labourId']) ? $_GET['labourId'] : null;
$labourId = stripcslashes($labourId);
$labourId = mysqli_real_escape_string($conn, $labourId);

$response = array();
$response['labourId'] = $labourId;
$response['labourName'] =  "";
$response['division'] =  "";
$response['phoneNumber'] =  "";
$response['email'] =  "";
$response['address'] =  "";


$sql = "SELECT `name`,`division`,`phone_number`,`email`,`address` FROM `labour` WHERE labour_ID = '$labourId'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $response['labourName'] = $row['name'];
    $response['division'] =  $row['division'];
    $response['phoneNumber'] = $row['phone_number'];
    $response['email'] = $row['email'];
    $response['address'] = $row['address'];
}


echo json_encode($response);
