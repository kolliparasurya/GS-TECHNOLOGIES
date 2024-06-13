<?php

include "./connection.php";


$inventionId = isset($_GET['inventionId']) ? $_GET['inventionId'] : null;
$inventionId = stripcslashes($inventionId);
$inventionId = mysqli_real_escape_string($conn, $inventionId);

$response = array();
$response['chipName'] = "";
$response['scientistId'] =  "";
$response['scientistName'] =  "";
$response['chipId'] =  "";
$response['date'] =  "";
$response['place'] =  "";
$response['inventionId'] =  $inventionId;




$sql = "SELECT `scientist_ID`,`chip_ID`,`chip_name`,`scientist_name`,`added_date`,`invention_place` FROM `invention` WHERE invention_ID = '$inventionId'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $response['scientistId'] = $row['scientist_ID'];
    $response['scientistName'] =  $row['scientist_name'];
    $response['chipId'] = $row['chip_ID'];
    $response['date'] = $row['added_date'];
    $response['place'] = $row['invention_place'];
    $response['chipName'] =  $row['chip_name'];
}


echo json_encode($response);
