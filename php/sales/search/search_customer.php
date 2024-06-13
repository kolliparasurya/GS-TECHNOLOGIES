<?php

include "./connection.php";


$email = isset($_GET['email']) ? $_GET['email'] : null;
$email = stripcslashes($email);
$email = mysqli_real_escape_string($conn, $email);

$response = array();
$response['email'] = $email;
$response['customerName'] =  "";
$response['address'] =  "";
$response['phoneNumber'] =  "";
$response['panNumber'] =  "";



$sql = "SELECT `name`,`address`,`phone_number`,`PAN_NUMBER` FROM `customers` WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $response['customerName'] = $row['name'];
    $response['address'] =  $row['address'];
    $response['phoneNumber'] = $row['phone_number'];
    $response['panNumber'] = $row['PAN_NUMBER'];
}


echo json_encode($response);
