<?php

include "./connection.php";


$scientistId = isset($_GET['scientistId']) ? $_GET['scientistId'] : null;
$scientistId = stripcslashes($scientistId);
$scientistId = mysqli_real_escape_string($conn, $scientistId);

$response = array();
$response['name'] = "";
$response['phoneNumber'] =  "";
$response['email'] =  "";
$response['degree'] =  "";
$response['address'] =  "";
$response['dob'] =  "";
$response['scientistId'] = $scientistId;




$sql = "SELECT `name`,`phone_number`,`email`,`degree`,`address`,`dob` FROM `scientists` WHERE sc_ID = '$scientistId'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $response['name'] =  $row['name'];
    $response['phoneNumber'] = $row['phone_number'];
    $response['degree'] = $row['degree'];
    $response['address'] = $row['address'];
    $response['dob'] =  $row['dob'];
    $response['email'] = $row['email'];
}


echo json_encode($response);
