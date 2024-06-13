<?php

include "./connection.php";


$scientistId = isset($_GET['scientistId']) ? $_GET['scientistId'] : null;
$scientistId = stripcslashes($scientistId);
$scientistId = mysqli_real_escape_string($conn, $scientistId);

$chipName = isset($_GET['chipName']) ? $_GET['chipName'] : null;
$chipName = stripcslashes($chipName);
$chipName = mysqli_real_escape_string($conn, $chipName);

if ($scientistId != "" && $chipName != "") {
    $response = array();
    $response['chipName'] = $chipName;
    $response['scientistId'] = $scientistId;
    $response['scientistName'] =  "";
    $response['chipId'] =  "";
    $response['date'] =  "";
    $response['place'] =  "";
    $response['inventionId'] =  "";



    $sql = "SELECT `scientist_name`,`chip_ID`,`added_date`,`invention_place`,`invention_ID` FROM `invention` WHERE scientist_ID = '$scientistId' AND chip_name = '$chipName'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $response['scientistName'] =  $row['scientist_name'];
        $response['chipId'] = $row['chip_ID'];
        $response['date'] =  $row['added_date'];
        $response['place'] =  $row['invention_place'];
        $response['inventionId'] =  $row['invention_ID'];
    }


    echo json_encode($response);
}
