<?php

include "./connection.php";


$chipName = isset($_GET['chipName']) ? $_GET['chipName'] : null;
$chipName = stripcslashes($chipName);
$chipName = mysqli_real_escape_string($conn, $chipName);

$email = isset($_GET['email']) ? $_GET['email'] : null;
$email = stripcslashes($email);
$email = mysqli_real_escape_string($conn, $email);


if ($chipName != "" && $email != "") {
    $response = array();
    $response['patnershipId'] = "";
    $response['chipId'] =  "";
    $response['chipName'] =  $chipName;
    $response['companyName'] =  "";
    $response['patnershipSector'] = "";
    $response['phoneNumber'] =  "";
    $response['email'] =  $email;
    $response['panNumber'] =  "";
    $response['address'] =  "";




    $sql = "SELECT `patnership_ID`,`company_PAN_NUMBER`,`chip_ID`,`patnership_sector`,`company_name`,`company_phone_number`,`company_address` FROM `advertisments` WHERE chip_ID = '$chipId' AND email = '$email'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $response = array();
        $response['patnershipId'] = $row['patnership_ID'];
        $response['chipId'] =  $row['company_PAN_NUMBER'];
        $response['companyName'] =  $row['chip_ID'];
        $response['patnershipSector'] = $row['patnership_sector'];
        $response['phoneNumber'] =  $row['company_name'];
        $response['panNumber'] =  $row['company_phone_number'];
        $response['address'] =  $row['company_address'];
    }


    echo json_encode($response);
}
