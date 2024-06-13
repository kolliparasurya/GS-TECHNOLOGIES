<?php

include "./connection.php";

$machineryId = isset($_GET['machineryId']) ? $_GET['machineryId'] : null;
$machineryId = stripcslashes($machineryId);
$machineryId = mysqli_real_escape_string($conn, $machineryId);;
$sql0 = "SELECT `machinery_ID` FROM `machinery`";
$result0 = mysqli_query($conn, $sql0);

$hello = 0;
while ($row = mysqli_fetch_assoc($result0)) {
    if ($hello < $row['machinery_ID']) {
        $hello = $row['machinery_ID'];
    }
}


if ($hello >= $machineryId) {
    $sql = "DELETE FROM `machinery` WHERE (`machinery_ID` = '$machineryId');";
    $result = mysqli_query($conn, $sql);
    echo "Machinery Deleted";
} else {
    echo "Batch Id out of range";
}
