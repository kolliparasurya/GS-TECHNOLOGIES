<?php

include "./connection.php";

$rawmaterialId = isset($_GET['rawmaterialId']) ? $_GET['rawmaterialId'] : null;
$rawmaterialId = stripcslashes($rawmaterialId);
$rawmaterialId = mysqli_real_escape_string($conn, $rawmaterialId);


$sql0 = "SELECT `raw_material_ID` FROM `raw_materials`";
$result0 = mysqli_query($conn, $sql0);

$hello = 0;
while ($row = mysqli_fetch_assoc($result0)) {
    if ($hello < $row['raw_material_ID']) {
        $hello = $row['raw_material_ID'];
    }
}


if ($hello >= $rawmaterialId) {
    $sql = "DELETE FROM `raw_materials` WHERE (`raw_material_ID` = '$rawmaterialId');";
    $result = mysqli_query($conn, $sql);
    echo "Rawmaterial Deleted";
} else {
    echo "Batch Id out of range";
}
