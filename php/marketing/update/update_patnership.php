<?php
include "./connection.php";

$data = array();

$data['patnershipId'] = isset($_GET['patnershipId']) ? $_GET['patnershipId'] : null;
$data['chipId'] = isset($_GET['chipId']) ? $_GET['chipId'] : null;
$data['chipName'] = isset($_GET['chipName']) ? $_GET['chipName'] : null;
$data['companyName'] = isset($_GET['companyName']) ? $_GET['companyName'] : null;
$data['patnershipSector'] = isset($_GET['patnershipSector']) ? $_GET['patnershipSector'] : null;
$data['phoneNumber'] = isset($_GET['phoneNumber']) ? $_GET['phoneNumber'] : null;
$data['email'] = isset($_GET['email']) ? $_GET['email'] : null;
$data['panNumber'] = isset($_GET['panNumber']) ? $_GET['panNumber'] : null;
$data['address'] = isset($_GET['address']) ? $_GET['address'] : null;


$data['patnershipId'] = stripcslashes($data['patnershipId']);
$data['chipId'] = stripcslashes($data['chipId']);
$data['chipName'] = stripcslashes($data['chipName']);
$data['companyName'] = stripcslashes($data['companyName']);
$data['patnershipSector'] = stripcslashes($data['patnershipSector']);
$data['phoneNumber'] = stripcslashes($data['phoneNumber']);
$data['email'] = stripcslashes($data['email']);
$data['panNumber'] = stripcslashes($data['panNumber']);
$data['address'] = stripcslashes($data['address']);


$patnershipId = mysqli_real_escape_string($conn, $data['patnershipId']);
$chipId = mysqli_real_escape_string($conn, $data['chipId']);
$chipName = mysqli_real_escape_string($conn, $data['chipName']);
$companyName = mysqli_real_escape_string($conn, $data['companyName']);
$patnershipSector = mysqli_real_escape_string($conn, $data['patnershipSector']);
$phoneNumber = mysqli_real_escape_string($conn, $data['phoneNumber']);
$email = mysqli_real_escape_string($conn, $data['email']);
$panNumber = mysqli_real_escape_string($conn, $data['panNumber']);
$address = mysqli_real_escape_string($conn, $data['address']);





if ($patnershipId != "") {
    $sql1 = "UPDATE `patnerships` SET `patnership_ID` = '$patnershipId',`chip_ID` = '$chipId',`chip_name` = '$chipName',`company_name` = '$companyName',`patnership_sector` = '$patnershipSector',`company_phone_number` = '$phoneNumber',`company_email` = '$email',`company_PAN_NUMBER` = '$panNumber',`company_address` = '$address' WHERE (`patnership_ID` = '$patnershipId');";
    $result = "";

    if (mysqli_multi_query($conn, $sql1)) {
        $result = "Patnership Updated!";
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
