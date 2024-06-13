<?php

include "./connection.php";

$inventionId = isset($_GET['inventionId']) ? $_GET['inventionId'] : null;
$inventionId = stripcslashes($inventionId);
$inventionId = mysqli_real_escape_string($conn, $inventionId);;
$sql0 = "SELECT `invention_ID` FROM `invention`";
$result0 = mysqli_query($conn, $sql0);

$hello = 0;
while ($row = mysqli_fetch_assoc($result0)) {
    if ($hello < $row['invention_ID']) {
        $hello = $row['invention_ID'];
    }
}


if ($hello >= $inventionId) {
    $sql = "DELETE FROM `invention` WHERE (`invention_ID` = '$inventionId');";
    $result = mysqli_query($conn, $sql);
    echo "Invention Deleted";
} else {
    echo "Batch Id out of range";
}
