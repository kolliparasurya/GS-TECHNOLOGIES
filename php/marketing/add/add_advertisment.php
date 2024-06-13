<?php
include "./connection.php";

$data = array();

$data['platformName'] = isset($_GET['platformName']) ? $_GET['platformName'] : null;
$data['chipId'] = isset($_GET['chipId']) ? $_GET['chipId'] : null;
$data['chipName'] = isset($_GET['chipName']) ? $_GET['chipName'] : null;

$data['platformName'] = stripcslashes($data['platformName']);
$data['chipId'] = stripcslashes($data['chipId']);
$data['chipName'] = stripcslashes($data['chipName']);

$platformName = mysqli_real_escape_string($conn, $data['platformName']);
$chipId = mysqli_real_escape_string($conn, $data['chipId']);
$chipName = mysqli_real_escape_string($conn, $data['chipName']);




$sql = "SELECT MAX(advertisment_ID) as lastadid FROM `gs technologies`.advertisments;";
$result = mysqli_query($conn, $sql);
$recentadId = "";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $recentadId = $row['lastadid'];
}
$advertismentId = $recentadId + 1;

if ($platformName != "" && $chipName != "" && $chipId != "") {
    $sql1 = "INSERT INTO `advertisments` (`advertisment_ID`,`platform_name`,`chip_name`,`chip_ID`)
        VALUES ('$advertismentId','$platformName','$chipName','$chipId')";

    $result = "";

    if (mysqli_query($conn, $sql1)) {
        $result = "Advertisment Added!";
        echo $result;
    } else {
        if (mysqli_errno($conn) == 1062) {
            $result = "Enter different details";
            echo $result;
        } else {
            $result = "Database insertion error";
            echo $result;
        }
    }
}


$conn->close();
