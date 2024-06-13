<?php
include "./connection.php";

$data = array();

$data['batchId'] = isset($_GET['batchId']) ? $_GET['batchId'] : null;
$data['rawmaterialName'] = isset($_GET['rawmaterialName']) ? $_GET['rawmaterialName'] : null;
$data['rawmaterialId'] = isset($_GET['rawmaterialId']) ? $_GET['rawmaterialId'] : null;
$data['quantity'] = isset($_GET['quantity']) ? $_GET['quantity'] : null;
$data['stockedDate'] = isset($_GET['stockedDate']) ? $_GET['stockedDate'] : null;


$data['batchId'] = stripcslashes($data['batchId']);
$data['rawmaterialId'] = stripcslashes($data['rawmaterialId']);
$data['rawmaterialName'] = stripcslashes($data['rawmaterialName']);
$data['quantity'] = stripcslashes($data['quantity']);
$data['stockedDate'] = stripcslashes($data['stockedDate']);


$batchId = mysqli_real_escape_string($conn, $data['batchId']);
$rawmaterialId = mysqli_real_escape_string($conn, $data['rawmaterialId']);
$rawmaterialName = mysqli_real_escape_string($conn, $data['rawmaterialName']);
$quantity = mysqli_real_escape_string($conn, $data['quantity']);
$stockedDate = mysqli_real_escape_string($conn, $data['stockedDate']);



if ($rawmaterialId != "") {
    $sql1 = "UPDATE `raw_material_stock` SET `raw_material_ID` = '$rawmaterialId',`name` = '$rawmaterialName',`quantity` = '$quantity',`stocked_date` = '$stockedDate' WHERE (`batch_ID` = '$batchId');";
    $result = "";

    if (mysqli_multi_query($conn, $sql1)) {
        $result = "Rawmaterial Stock Updated!";
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
