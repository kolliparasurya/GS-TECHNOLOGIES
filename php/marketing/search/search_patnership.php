
<?php

include "./connection.php";


$patnershipId = isset($_GET['patnershipId']) ? $_GET['patnershipId'] : null;
$patnershipId = stripcslashes($patnershipId);
$patnershipId = mysqli_real_escape_string($conn, $patnershipId);

$response = array();
$response['patnershipId'] = $patnershipId;
$response['chipId'] =  "";
$response['chipName'] =  "";
$response['patnershipSector'] =  "";
$response['companyName'] =  "";
$response['phoneNumber'] =  "";
$response['email'] =  "";
$response['address'] =  "";
$response['panNumber'] =  "";




$sql = "SELECT `patnership_ID`,`company_PAN_NUMBER`,`chip_ID`,`chip_name`,`patnership_sector`,`company_name`,`company_phone_number`,`company_email`,`company_address` FROM `patnerships` WHERE `patnership_ID` = '$patnershipId'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $response['chipId'] =  $row['chip_ID'];
    $response['chipName'] =  $row['chip_name'];
    $response['patnershipSector'] =  $row['patnership_sector'];
    $response['companyName'] =  $row['company_name'];
    $response['phoneNumber'] =  $row['company_phone_number'];
    $response['email'] =  $row['company_email'];
    $response['address'] =  $row['company_address'];
    $response['panNumber'] =  $row['company_PAN_NUMBER'];
}


echo json_encode($response);
