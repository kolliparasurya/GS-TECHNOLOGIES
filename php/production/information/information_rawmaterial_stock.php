<?php

include "./connection.php";


$batchId = isset($_GET['batchId']) ? $_GET['batchId'] : null;
$batchId = stripcslashes($batchId);
$batchId = mysqli_real_escape_string($conn, $batchId);

$stockedDate = isset($_GET['stockedDate']) ? $_GET['stockedDate'] : null;
$stockedDate = stripcslashes($stockedDate);
$stockedDate = mysqli_real_escape_string($conn, $stockedDate);

if ($batchId != "" && $stockedDate == "") {
    $response = array();
    $response['batchId'] = $batchId;
    $response['rawmaterialName'] =  "";
    $response['rawmaterialId'] =  "";
    $response['quantity'] =  "";
    $response['stockedDate'] =  "";



    $sql = "SELECT `raw_material_ID`,`name`,`quantity`,`stocked_date` FROM `raw_material_stock` WHERE batch_ID = '$batchId'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $response['rawmaterialName'] = $row['name'];
        $response['rawmaterialId'] =  $row['raw_material_ID'];
        $response['quantity'] = $row['quantity'];
        $response['stockedDate'] = $row['stocked_date'];
    }


    echo json_encode($response);
}
