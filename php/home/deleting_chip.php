<?php

include "./connection.php";

$chip_ID = $_GET['chip_ID'];
$chip_ID = stripcslashes($chip_ID);
$chip_ID = mysqli_real_escape_string($conn, $chip_ID);;
$sql0 = "SELECT `chip_ID` FROM `gpu_chips`";
$result0 = mysqli_query($conn, $sql0);

$hello = 0;
while ($row = mysqli_fetch_assoc($result0)) {
    if ($hello < $row['chip_ID']) {
        $hello = $row['chip_ID'];
    }
}


if ($hello >= $chip_ID) {
    $sql = "DELETE FROM `render_configs` WHERE (`chip_ID` = '$chip_ID');
            DELETE FROM `memory` WHERE (`chip_ID` = '$chip_ID');
            DELETE FROM `clock_speeds` WHERE (`chip_ID` = '$chip_ID');
            DELETE FROM `gpu_chips` WHERE (`chip_ID` = '$chip_ID');";
    $result = mysqli_multi_query($conn, $sql);
    echo "Chip Deleted";
} else {
    echo "Chip Id out of range";
}
