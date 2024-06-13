<?php

include "./connection.php";


$rawmaterialId = isset($_GET['rawmaterialId']) ? $_GET['rawmaterialId'] : null;
$rawmaterialId = stripcslashes($rawmaterialId);
$rawmaterialId = mysqli_real_escape_string($conn, $rawmaterialId);

$rawmaterialName = isset($_GET['rawmaterialName']) ? $_GET['rawmaterialName'] : null;
$rawmaterialName = stripcslashes($rawmaterialName);
$rawmaterialName = mysqli_real_escape_string($conn, $rawmaterialName);

$response = array();
$response['rawmaterialName'] =  $rawmaterialName;
$response['rawmaterialId'] = $rawmaterialId;


if ($rawmaterialName == "" && $rawmaterialId != "") {
    $sql = "SELECT `name` FROM `raw_materials` WHERE raw_material_ID = '$rawmaterialId'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $response['rawmaterialName'] = $row['name'];
    }
    echo json_encode($response);
} else if ($rawmaterialName != "" && $rawmaterialId == "") {
    $sql = "SELECT `raw_material_ID` FROM `raw_materials` WHERE `name` = '$rawmaterialName'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $response['rawmaterialId'] = $row['raw_material_ID'];
    }
    echo json_encode($response);
}
