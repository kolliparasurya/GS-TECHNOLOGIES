<?php

include "./connection.php";

$advertismentId = isset($_GET['advertismentId']) ? $_GET['advertismentId'] : null;
$advertismentId = stripcslashes($advertismentId);
$advertismentId = mysqli_real_escape_string($conn, $advertismentId);;
$sql0 = "SELECT `advertisment_ID` FROM `advertisments`";
$result0 = mysqli_query($conn, $sql0);

$hello = 0;
while ($row = mysqli_fetch_assoc($result0)) {
    if ($hello < $row['advertisment_ID']) {
        $hello = $row['advertisment_ID'];
    }
}


if ($hello >= $advertismentId) {
    $sql = "DELETE FROM `advertisments` WHERE (`advertisment_ID` = '$advertismentId');";
    $result = mysqli_query($conn, $sql);
    echo "Advertisment Deleted";
} else {
    echo "Batch Id out of range";
}
