<?php

include "./connection.php";

$patnershipId = isset($_GET['patnershipId']) ? $_GET['patnershipId'] : null;
$patnershipId = stripcslashes($patnershipId);
$patnershipId = mysqli_real_escape_string($conn, $patnershipId);;
$sql0 = "SELECT `patnership_ID` FROM `patnerships`";
$result0 = mysqli_query($conn, $sql0);

$hello = 0;
while ($row = mysqli_fetch_assoc($result0)) {
    if ($hello < $row['patnership_ID']) {
        $hello = $row['patnership_ID'];
    }
}


if ($hello >= $patnershipId) {
    $sql = "DELETE FROM `patnerships` WHERE (`patnership_ID` = '$patnershipId');";
    $result = mysqli_query($conn, $sql);
    echo "Patnership Deleted";
} else {
    echo "Batch Id out of range";
}
