<?php

include "./connection.php";

$batchId = isset($_GET['batchId']) ? $_GET['batchId'] : null;
$batchId = stripcslashes($batchId);
$batchId = mysqli_real_escape_string($conn, $batchId);;
$sql0 = "SELECT `batch_ID` FROM `raw_material_stock`";
$result0 = mysqli_query($conn, $sql0);

$hello = 0;
while ($row = mysqli_fetch_assoc($result0)) {
    if ($hello < $row['batch_ID']) {
        $hello = $row['batch_ID'];
    }
}


if ($hello >= $batchId) {
    $sql = "DELETE FROM `raw_material_stock` WHERE (`batch_ID` = '$batchId');";
    $result = mysqli_query($conn, $sql);
    echo "Rawmaterial Stock Deleted";
} else {
    echo "Batch Id out of range";
}
