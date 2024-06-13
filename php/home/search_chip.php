<?php

include "./connection.php";


$chipId = $_GET['chipId'];
$chipId = stripcslashes($chipId);
$chipId = mysqli_real_escape_string($conn, $chipId);

$response = array();
$response['chip_ID'] = $chipId;
$response['name'] =  "";
$response['stage'] =  "";
$response['application'] =  "";
$response['gpu_type'] =  "";
$response['process_size'] =  "";
$response['transistors'] =  "";
$response['die_size'] =  "";
$response['foundry'] =  "";
$response['added_date'] =  "";
$response['shading_units'] =  "";
$response['TMUs'] =  "";
$response['cores'] =  "";
$response['memory_bus'] =  "";
$response['memory_type'] =  "";
$response['band_width'] =  "";
$response['base_clock'] =  "";
$response['memory_clock'] = "";



$sql = "SELECT `name`,`stage`,`application`,`gpu_type`,`process_size`,`transistors`,`die_size`,`foundry`,`added_date` FROM `gpu_chips` WHERE chip_ID = '$chipId'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $response['name'] = $row['name'];
    $response['stage'] =  $row['stage'];
    $response['application'] = $row['application'];
    $response['gpu_type'] = $row['gpu_type'];
    $response['process_size'] = $row['process_size'];
    $response['transistors'] = $row['transistors'];
    $response['die_size'] = $row['die_size'];
    $response['foundry'] = $row['foundry'];
    $response['added_date'] = $row['added_date'];
}

$sql1 = "SELECT `shading_units`,`TMUs`,`cores` FROM `render_configs` WHERE chip_ID = '$chipId'";
$result1 = mysqli_query($conn, $sql1);
while ($row = mysqli_fetch_assoc($result1)) {
    $response['shading_units'] = $row['shading_units'];
    $response['TMUs'] = $row['TMUs'];
    $response['cores'] = $row['cores'];
}

$sql2 = "SELECT `memory_type`,`memory_bus`,`band_width` FROM `memory` WHERE chip_ID = '$chipId'";
$result2 = mysqli_query($conn, $sql2);
while ($row = mysqli_fetch_assoc($result2)) {
    $response['memory_bus'] = $row['memory_bus'];
    $response['memory_type'] = $row['memory_type'];
    $response['band_width'] = $row['band_width'];
}

$sql3 = "SELECT `base_clock`,`memory_clock` FROM `clock_speeds` WHERE chip_ID = '$chipId'";
$result3 = mysqli_query($conn, $sql3);
while ($row = mysqli_fetch_assoc($result3)) {
    $response['base_clock'] =  $row['base_clock'];
    $response['memory_clock'] = $row['memory_clock'];
}


echo json_encode($response);
