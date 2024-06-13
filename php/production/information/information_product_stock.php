<?php

include "./connection.php";


$batchId = isset($_GET['batchId']) ? $_GET['batchId'] : null;;
$stockedDate = isset($_GET['stockedDate']) ? $_GET['stockedDate'] : null;;
$batchId = stripcslashes($batchId);
$stockedDate = stripcslashes($stockedDate);
$batchId = mysqli_real_escape_string($conn, $batchId);
$stockedDate = mysqli_real_escape_string($conn, $stockedDate);

$response = array();
$response['batchId'] =  $batchId;
$response['chipId'] =  "";
$response['name'] =  "";
$response['producedQuantity'] =  "";
$response['defectedQuantity'] =  "";
$response['netQuantity'] =  "";
$response['machineryNames'] =  "";
$response['labourIDs'] =  "";
$response['rawmaterials'] =  "";
$response['stockedDate'] =  $stockedDate;

if ($stockedDate == "" && $batchId != "") {

    $sql = "SELECT `chip_ID`,`name`,`produced_quantity`,`defected_quantity`,`net_quantity`,`stocked_date` FROM `product_stock` WHERE `batch_ID` = '$batchId'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $response['chipId'] =  $row['chip_ID'];
        $response['chipName'] =  $row['name'];
        $response['producedQuantity'] =  $row['produced_quantity'];
        $response['defectedQuantity'] =  $row['defected_quantity'];
        $response['netQuantity'] =  $row['net_quantity'];
        $response['stockedDate'] =  $row['stocked_date'];
    }

    $sql1 = "SELECT `rawmaterial_name` FROM `production_rawmaterials` WHERE `product_batch_ID` = '$batchId'";
    $result1 = mysqli_query($conn, $sql1);
    while ($row = mysqli_fetch_assoc($result1)) {
        if ($response['rawmaterials'] == "") {
            $response['rawmaterials'] = $response['rawmaterials'] . $row['rawmaterial_name'];
        } else {
            $response['rawmaterials'] = $response['rawmaterials'] . "," . $row['rawmaterial_name'];
        }
    }

    $sql2 = "SELECT `machinery_name` FROM `production_machinery` WHERE `product_batch_ID` = '$batchId'";
    $result2 = mysqli_query($conn, $sql2);
    while ($row = mysqli_fetch_assoc($result2)) {
        if ($response['machineryNames'] == "") {
            $response['machineryNames'] =  $response['machineryNames'] . $row['machinery_name'];
        } else {
            $response['machineryNames'] =  $response['machineryNames'] . "," . $row['machinery_name'];
        }
    }

    $sql3 = "SELECT `labour_ID` FROM `production_labour` WHERE `product_batch_ID` = '$batchId'";
    $result3 = mysqli_query($conn, $sql3);
    while ($row = mysqli_fetch_assoc($result3)) {
        if ($response['labourIDs'] == "") {
            $response['labourIDs'] =  $response['labourIDs'] . $row['labour_ID'];
        } else {
            $response['labourIDs'] =  $response['labourIDs'] . "," . $row['labour_ID'];
        }
    }
    echo json_encode($response);
} else if ($stockedDate != "" && $batchId == "") {
}
