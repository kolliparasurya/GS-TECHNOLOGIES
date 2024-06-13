<?php

include "./connection.php";


$machineryId = isset($_GET['machineryId']) ? $_GET['machineryId'] : null;
$machineryId = stripcslashes($machineryId);
$machineryId = mysqli_real_escape_string($conn, $machineryId);

$response = array();
$response['machineryId'] = $machineryId;
$response['machineryName'] =  "";
$response['use'] =  "";


$sql = "SELECT `name`,`use` FROM `machinery` WHERE machinery_ID = '$machineryId'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $response['machineryId'] = $row['machineryId'];
    $response['machineryName'] =  $row['machineryName'];
    $response['use'] = $row['use'];
}


echo json_encode($response);
