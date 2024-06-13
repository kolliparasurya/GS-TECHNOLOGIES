<?php

include "./connection.php";

$scientistId = isset($_GET['scientistId']) ? $_GET['scientistId'] : null;
$scientistId = stripcslashes($scientistId);
$scientistId = mysqli_real_escape_string($conn, $scientistId);;
$sql0 = "SELECT `sc_ID` FROM `scientists`";
$result0 = mysqli_query($conn, $sql0);

$hello = 0;
while ($row = mysqli_fetch_assoc($result0)) {
    if ($hello < $row['sc_ID']) {
        $hello = $row['sc_ID'];
    }
}


if ($hello >= $scientistId) {
    $sql = "DELETE FROM `scientists` WHERE (`sc_ID` = '$scientistId');";
    $result = mysqli_query($conn, $sql);
    echo "Scientist Deleted";
} else {
    echo "Batch Id out of range";
}
