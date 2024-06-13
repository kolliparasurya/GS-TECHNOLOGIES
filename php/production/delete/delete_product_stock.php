<?php

include "./connection.php";

$batchId = $_GET['batchId'];
$batchId = stripcslashes($batchId);
$batchId = mysqli_real_escape_string($conn, $batchId);;
$sql0 = "SELECT `batch_ID` FROM `product_stock`";
$result0 = mysqli_query($conn, $sql0);

$hello = 0;
while ($row = mysqli_fetch_assoc($result0)) {
    $hello = $row['batch_ID'];
}


if ($hello >= $batchId) {
    $sql = "DELETE FROM `production_labour` WHERE (`product_batch_ID` = '$batch_ID');
            DELETE FROM `production_rawmaterials` WHERE (`product_batch_ID` = '$batchId');
            DELETE FROM `production_machinery` WHERE (`product_batch_ID` = '$batchId');
            DELETE FROM `product_stock` WHERE (`batch_ID` = '$batchId');";
    $result = mysqli_multi_query($conn, $sql);
    echo "Chip Deleted";
} else {
    echo "Chip Id out of range";
}
