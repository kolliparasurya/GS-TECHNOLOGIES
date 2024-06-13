<?php

include "./connection.php";


$rawmaterialId = isset($_GET['rawmaterialId']) ? $_GET['rawmaterialId'] : null;
$rawmaterialId = stripcslashes($rawmaterialId);
$rawmaterialId = mysqli_real_escape_string($conn, $rawmaterialId);

$response = array();
$response['rawmaterialName'] =  "";
$response['rawmaterialId'] =  $rawmaterialId;



$sql = "SELECT `name` FROM `raw_materials` WHERE raw_material_ID = '$rawmaterialId'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $response['rawmaterialName'] = $row['name'];
}


echo json_encode($response);
