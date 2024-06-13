<?php
include "./connection.php";

$data = array();

$data['advertismentId'] = isset($_GET['advertismentId']) ? $_GET['advertismentId'] : null;
$data['platformName'] = isset($_GET['platformName']) ? $_GET['platformName'] : null;
$data['chipId'] = isset($_GET['chipId']) ? $_GET['chipId'] : null;
$data['chipName'] = isset($_GET['chipName']) ? $_GET['chipName'] : null;



$data['advertismentId'] = stripcslashes($data['advertismentId']);
$data['platformName'] = stripcslashes($data['platformName']);
$data['chipId'] = stripcslashes($data['chipId']);
$data['chipName'] = stripcslashes($data['chipName']);


$advertismentId = mysqli_real_escape_string($conn, $data['advertismentId']);
$platformName = mysqli_real_escape_string($conn, $data['platformName']);
$chipId = mysqli_real_escape_string($conn, $data['chipId']);
$chipName = mysqli_real_escape_string($conn, $data['chipName']);




if ($advertismentId != "") {
    $sql1 = "UPDATE `advertisments` SET `advertisment_ID` = '$advertismentId',`platform_name` = '$platformName',`chip_ID` = '$chipId',`chip_name` = '$chipName' WHERE (`advertisment_ID` = '$advertismentId');";
    $result = "";

    if (mysqli_multi_query($conn, $sql1)) {
        $result = "Advertisment Updated!";
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
