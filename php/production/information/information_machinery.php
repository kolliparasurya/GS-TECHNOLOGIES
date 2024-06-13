<?php

include "./connection.php";


$machineryName = isset($_GET['machineryName']) ? $_GET['machineryName'] : null;
$machineryName = stripcslashes($machineryName);
$machineryName = mysqli_real_escape_string($conn, $machineryName);


if ($machineryName != "") {
    $response = array();
    $response['machineryId'] = "";
    $response['machineryName'] = $machineryName;
    $response['use'] =  "";



    $sql = "SELECT `machinery_ID`,`name`,`use` FROM `machinery` WHERE machinery_ID = '$machineryId'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $response['machineryId'] = $row['machinery_ID'];
        $response['machineryName'] =  $row['name'];
        $response['use'] = $row['use'];
    }


    echo json_encode($response);
}
