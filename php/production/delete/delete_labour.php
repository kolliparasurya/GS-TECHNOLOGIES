<?php

include "./connection.php";

$labourId = isset($_GET['labourId']) ? $_GET['labourId'] : null;
$labourId = stripcslashes($labourId);
$labourId = mysqli_real_escape_string($conn, $labourId);;
$sql0 = "SELECT `labour_ID` FROM `labour`";
$result0 = mysqli_query($conn, $sql0);

$hello = 0;
while ($row = mysqli_fetch_assoc($result0)) {
    if ($hello < $row['labour_ID']) {
        $hello = $row['labour_ID'];
    }
}


if ($hello >= $labourId) {
    $sql = "DELETE FROM `labour` WHERE (`labour_ID` = '$labourId');";
    $result = mysqli_query($conn, $sql);
    echo "Labour Deleted";
} else {
    echo "Batch Id out of range";
}
