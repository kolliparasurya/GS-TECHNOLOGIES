<?php
include "./connection.php";

$data = array();

$data['rawmaterialId'] = isset($_GET['rawmaterialId']) ? $_GET['rawmaterialId'] : null;
$data['rawmaterialName'] = isset($_GET['rawmaterialName']) ? $_GET['rawmaterialName'] : null;

$data['rawmaterialId'] = stripcslashes($data['rawmaterialId']);
$data['rawmaterialName'] = stripcslashes($data['rawmaterialName']);

$rawmaterialId = mysqli_real_escape_string($conn, $data['rawmaterialId']);
$rawmaterialName = mysqli_real_escape_string($conn, $data['rawmaterialName']);


if ($rawmaterialId != "" && $rawmaterialName != "") {
    $sql1 = "UPDATE `raw_materials` SET `raw_material_ID` = '$rawmaterialId',`name` = '$rawmaterialName' WHERE (`raw_material_ID` = '$rawmaterialId');";
    $result = "";

    if (mysqli_multi_query($conn, $sql1)) {
        $result = "Rawmaterial Updated!";
        echo $result;
    } else {
        if (mysqli_errno($conn) == 1062) {
            $result = "Enter different details";
            echo $result;
        } else {
            $result = "Database insertion error";
            echo $result;
        }
    }
}



$conn->close();
