<?php

include "./connection.php";


$advertismentId = isset($_GET['advertismentId']) ? $_GET['advertismentId'] : null;
$advertismentId = stripcslashes($advertismentId);
$advertismentId = mysqli_real_escape_string($conn, $advertismentId);

$response = array();
$response['advertismentId'] = $advertismentId;
$response['platformName'] =  "";
$response['chipId'] =  "";
$response['chipName'] =  "";




$sql = "SELECT `advertisment_ID`,`platform_name`,`chip_ID`,`chip_name` FROM `advertisments` WHERE advertisment_ID = '$advertismentId'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $response['platformName'] =  $row['platform_name'];
    $response['chipId'] = $row['chip_ID'];
    $response['chipName'] = $row['chip_name'];
}


echo json_encode($response);
